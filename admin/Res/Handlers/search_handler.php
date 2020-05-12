<?php
// header('Content-Type: application/json');
include_once '../Php/modal.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $data = isset($_REQUEST['data']) ? $_REQUEST['data'] : "none";
    $conn = $moderator->getConnection();
    if($data){
        
        //#data
            // 1 table
            // 2 reference
            // 3 extras
            // 4 fields
                // a) caller id
                // b) action  

        $tables = $data[0];

        $responce = array(
            "caller_id" => $data[3]['caller_id'],
            "search_for" => $data[1],
            "status"=> false,
            "results"=> array()
        );
        $temp_resp = array();

        $temp_resp2 = array();

        
        if($data[3]['action'] == "search_tag" || $data[3]['action'] == "search_attribute" || $data[3]['action'] == "search_vendor" ){
            //get all items
            foreach ($tables as $value) {
                if (!array_key_exists($value, $tables_ref)) {
                    continue;
                    echo "continued";
                } else {
                    $table = $tables_ref[$value]["table_name"];

                    $fields = $tables_ref[$value]["table_fields"];

                    $temp = array();



                    foreach ($data[2] as $field) {
                        if (array_key_exists($field, $tables_ref[$value]['table_fields'])) {
                            // echo $table." ".$field."<br>";
                            $target_field = $tables_ref[$value]['table_fields'][$field];


                            $item = $moderator->search($data[1], $table, $target_field, $conn);

                            if ($item[0] == true) {
                                foreach ($item[1] as $variable) {
                                    $responce['status'] = true;
                                    $uuid = $variable["UUID"];

                                    if (!in_array($uuid, $temp)) {
                                        array_push($temp, $variable["UUID"]);
                                    }
                                }
                            }
                        }
                    }
                    $temp_resp[$table] = $temp;
                }
            }
        }else if($data[3]['action'] == "search_val_by_ref"){
            //get all items
            foreach ($tables as $value) {
                if (!array_key_exists($value, $tables_ref)) {
                    continue;
                } else {
                    $table = $tables_ref[$value]["table_name"];

                    $fields = $tables_ref[$value]["table_fields"];

                    $temp = array();



                    foreach ($data[2] as $field) {
                        if (array_key_exists($field, $tables_ref[$value]['table_fields'])) {
                            // echo $table." ".$field."<br>";
                            $target_field = $tables_ref[$value]['table_fields'][$field];


                            $item = $moderator->search_att_val($data[1][0],$data[1][1],$table, $target_field, $conn);

                            if ($item[0] == true) {
                                foreach ($item[1] as $variable) {
                                    $responce['status'] = true;
                                    $uuid = $variable["UUID"];

                                    if (!in_array($uuid, $temp)) {
                                        array_push($temp, $variable["UUID"]);
                                    }
                                }
                            }
                        }
                    }
                    $temp_resp[$table] = $temp;
                }
            }
        }

        


        //bind data
        foreach($temp_resp as $key1 => $IDs){
            foreach($tables_ref as $key2 => $val){

                if($val['table_name'] == $key1){
                    $table = $key1;
                    $id_name = $val['table_fields']['id'];
                    $name =  $val['table_fields']['name'];

                    foreach($IDs as $value1){

                        $resp = $moderator->getitemsbyref($value1, $table, $id_name, $conn);

                        if($resp[0] == true){

                            $name1 = $resp[1][0][$name];

                            $item = array(
                                $table,
                                $value1,
                                $name1
                            );

                            array_push($temp_resp2, $item);
                        }

                       

                        
                    }

                }
            }
        }

        array_push($responce['results'],$temp_resp2);

        // var_dump($data);

        if($data[3]['unique'] == "false"){
            echo json_encode($responce);
        }
    }else{
        echo "data is not available";
    }
} else {
    echo "Not Post";
    exit();
}

