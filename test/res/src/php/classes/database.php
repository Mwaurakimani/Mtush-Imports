<?php

/**
 * this class performs most general data base connections
 * 
 * @param booleen $set_strict- use true for '=' and false for 'LIKE'
 * 
 */
trait  database
{
    private $set_strict = false;

    /**
     * This method gets items based on the reference
     * @param array|string $fields-the fields of @example ['UUID','Product_ID'] for spesific fields to check or ['*'] for all
     * @param string $table-the table to check of @example 'tbl_Users'
     * @param array $ref-the field and value to look for respectively.The fields should be the same as the $fields section of @example [array('UUID',$var)]
     * @param string $type-the value holders.The characters should be equal to the number of values in $ref of @example "sss" for 3 strings "ii" for 2 int 
     * 
     * @return array $Responce-test $Responce[0] for true or false and if true check $Responce[1] for values
     */
    public function get_by_ref($fields, $table, $ref = null, $type = null)
    {
        //get Connection
        $conn = $this->conn();

        //test for '*' or array of fields
        $is_array = is_array($fields);

        //declare responce
        $Responce = [
            false,
        ];

        //tempolary values holder for loops
        $temp_arry = array();


        if ($is_array) {
            //is the fileds hold an array
            $array_count = count($fields);


            if ($array_count > 0) {
                //some fields were specified

                //prepare fields to pass them to prepared statement
                $fields_combined = implode(",", $fields);


                if (isset($ref)) {
                    //ref has values to compare


                    //declara variablaes
                    $keys = [];
                    $values = [];

                    //formating the $ref to pass to the prepared statament

                    if($this->set_strict == true){
                        foreach ($ref as &$val) {
                            array_push($keys, $val[0] . " = ?");
                            $myval = $val[1];
                            array_push($values, $myval);
                        }
                    }else{
                        foreach ($ref as &$val) {
                            array_push($keys, $val[0] . " LIKE CONCAT('%',?,'%')");
                            $myval = $val[1];
                            array_push($values, $myval);
                        }
                    }


                    $keys_combined = implode(" AND ", $keys);

                    //pass values to the database
                    if ($stmt = $conn->prepare("SELECT $fields_combined FROM $table WHERE $keys_combined ")) {

                        $stmt->bind_param($type, ...$values);

                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($data = $result->fetch_assoc()) {
                            array_push($temp_arry, $data);
                            $Responce[0] = true;
                        }
                        $stmt->close();



                        array_push($Responce, $temp_arry);
                    }

                    //if the binding is not posible the action will return the
                    //function to the return statement and return responce of 
                    // bool false as the first parameter

                } else {
                    //no ref 

                    //pass all values in the table
                    if ($stmt = $conn->prepare("SELECT $fields_combined FROM $table")) {
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($data = $result->fetch_assoc()) {
                            array_push($temp_arry, $data);
                            $Responce[0] = true;
                        }
                        $stmt->close();


                        array_push($Responce, $temp_arry);
                    }
                }
            }
        } else {
            //the fields variable is not an arrar

            //test if '*' to mean get all items
            if ($fields == "*") {

                //test if there is a value in $ref meaning reference
                if (isset($ref)) {
                    //values found

                    //declara variablaes
                    $keys = [];
                    $values = [];

                    //formating the $ref to pass to the prepared statament

                    if ($this->set_strict) {
                        foreach ($ref as &$val) {
                            array_push($keys, $val[0] . " = ?");
                            $myval = $val[1];
                            array_push($values, $myval);
                        }
                    } else {
                        foreach ($ref as &$val) {
                            array_push($keys, $val[0] . " LIKE CONCAT('%',?,'%')");
                            $myval = $val[1];
                            array_push($values, $myval);
                        }
                    }

                    $keys_combined = implode(" AND ", $keys);

                    // exit();
                    //pass values to the database
                    if ($stmt = $conn->prepare("SELECT * FROM $table WHERE $keys_combined ")) {

                        $stmt->bind_param($type, ...$values);

                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($data = $result->fetch_assoc()) {
                            array_push($temp_arry, $data);
                            $Responce[0] = true;
                        }
                        $stmt->close();

                        array_push($Responce, $temp_arry);
                    }

                    //if the binding is not posible the action will return the
                    //function to the return statement and return responce of 
                    // bool false as the first parameter

                } else {
                    //there was no value in ref

                    //this will select all values from the table
                    if ($stmt = $conn->prepare("SELECT * FROM $table")) {
                        $stmt->execute();
                        $result = $stmt->get_result();

                        while ($data = $result->fetch_assoc()) {
                            array_push($temp_arry, $data);
                            $Responce[0] = true;
                        }
                        $stmt->close();


                        array_push($Responce, $temp_arry);
                    }
                    //if the binding is not posible the action will return the
                    //function to the return statement and return responce of 
                    // bool false as the first parameter
                }
            }
        }

        return $Responce;
    }



    //
    // property handlers

    /**
     * get the value of object
     * 
     * @param string $name -name of the value to get
     * 
     * @return mixed retuns item or null
     */
    public function __get($name)
    {

        if (isset($this->$name)) {
            return ($this->$name);
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
                ' in ' . $trace[0]['file'] .
                ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );
        return null;
    }


    /**
     * set object variables
     * @param string $name - name of the variable to set
     * 
     * @return null
     */
    public function __set($name, $value)
    {
        $this->$name = $value;
    }
}
