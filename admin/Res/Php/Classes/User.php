<?php
  /**
   * User Parent Class
   */
  trait  appUser
  {
  use products;
  use vendor;
  use fileCrud;
  
  //SignUp users
  public function userpassdata($var,$conn){
    // decode json assign it to data
    $data = json_decode($var);
    
    if(isset($data->Email)){
      $exist = $this->ifItemExist($data->Email, "tbl_moderators", "userEmailAddress", $conn);
    }else{
      $exist = false;
      exit;
    }

    if(!$exist){
      $ID = $this->generateUUID();

      $stmt = $conn->prepare("INSERT INTO tbl_moderators (UUID) VALUES (?)");
      $bind = $stmt->bind_param("s", $ID);
      $stmt->execute();
      $stmt->close();

      $filednames = [
        'userFirstName',
        'userLastName',
        'userOtherName',
        'nationalID',
        'userName',
        'gender',
        'userEmailAddress',
        'userPhoneNumber',
        'Address',
        'Role',
        'accountStatus',
      ];

      $values = [
        $data->F_name,
        $data->L_name,
        $data->O_name,
        $data->NID,
        $data->U_name,
        $data->Gender,
        $data->Email,
        $data->P_Number,
        $data->Address,
        $data->Role,
        $data->Status,
      ];

      $combined  = array_combine($filednames, $values);

      foreach ($combined as $k => $v) {
        if ($v) {
          $stmt = $conn->prepare("UPDATE tbl_moderators SET $k=? WHERE UUID=?");
          $stmt->bind_param('ss', $v, $ID);
          $stmt->execute();
          $stmt->close();
        }
      }


      $password = password_hash("password", PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE tbl_moderators SET password=? WHERE UUID=?");
      $stmt->bind_param('ss', $password, $ID);
      $stmt->execute();
      $stmt->close();


    }else{
      $obj = $this->getitemsbyref($data->Email, "tbl_moderators", "userEmailAddress", $conn);

      $ID = $obj[1][0]['UUID'];

      $filednames = [
        'userFirstName',
        'userLastName',
        'userOtherName',
        'userName',
        'gender',
        'userEmailAddress',
        'userPhoneNumber', 
        'Address',
        'Role',
        'accountStatus',
      ];

      $values = [
        $data->F_name,
        $data->L_name,
        $data->O_name,
        $data->U_name,
        $data->Gender,
        $data->Email,
        $data->P_Number,
        $data->Address,
        $data->Role,
        $data->Status,
      ];

      $combined  = array_combine($filednames, $values);

      foreach ($combined as $k => $v) {
        if ($v) {
          $stmt = $conn->prepare("UPDATE tbl_moderators SET $k=? WHERE UUID=?");
          $stmt->bind_param('ss', $v, $ID);
          $stmt->execute();
          $stmt->close();
        }
      }
    }
    $obj = $this->getitemsbyref($ID, "tbl_moderators", "UUID", $conn);

    return $obj;
  }
  public function getConnection(){
    return $this->connection;
  }

  //generate a Universal Unique ID
  public function generateUUID(){
    return sprintf(
      '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
      // 32 bits for "time_low"
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),

      // 16 bits for "time_mid"
      mt_rand(0, 0xffff),

      // 16 bits for "time_hi_and_version",
      // four most significant bits holds version number 4
      mt_rand(0, 0x0fff) | 0x4000,

      // 16 bits, 8 bits for "clk_seq_hi_res",
      // 8 bits for "clk_seq_low",
      // two most significant bits holds zero and one for variant DCE1.1
      mt_rand(0, 0x3fff) | 0x8000,

      // 48 bits for "node"
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff),
      mt_rand(0, 0xffff)
    );
  }

  //if item exist
  public function ifItemExist($item,$table,$field,$conn){
    $sql = "SELECT * FROM $table WHERE $field = '$item'";
    $result = mysqli_query($conn, $sql);
    $resaultnumber = mysqli_num_rows($result);

    if ($resaultnumber > 0) {
      return true;
    } else {
      return false;
    }
    
  }

  //return all items
  public function getselectitems($table, $fields, $conn){
    $gen = implode(",", $fields);
    $sql = "SELECT $gen FROM $table";
    $result = mysqli_query($conn, $sql);
    $resaultnumber = mysqli_num_rows($result);

    $return_arry = [];

    if ($resaultnumber > 0) {
      $return_arry[0] = true;
      $return_arry[1] = [];
      while ($row = $result->fetch_assoc()) {
        array_push($return_arry[1], $row);
      }
    } else {
      $return_arry[0] = false;
    }

    return $return_arry;
  }


  //getitem by ref
  public function getitemsbyref($ref, $table, $field, $conn){
    $sql = "SELECT * FROM $table WHERE $field = '$ref'";
    
    $result = mysqli_query($conn, $sql);
    $resaultnumber = mysqli_num_rows($result);

    $return_arry = [];

    if ($resaultnumber > 0) {
      $return_arry[0] = true;
      $return_arry[1] = [];
      while ($row = $result->fetch_assoc()) {
        array_push($return_arry[1], $row);
      }
    } else {
      $return_arry[0] = false;
    }

    return $return_arry;
  }

  public function managerLogIn($var,$conn){
    $data = json_decode($var);

    $user = $this->getitemsbyref($data->email, "tbl_moderators", "userEmailAddress",$conn);
    
    $res_email = $user[1][0]['userEmailAddress'];
    $res_username = $user [1][0]['userName'];
    $res_password = $user[1][0]['password'];

    if (password_verify($data->password, $res_password)) {
      if($res_username == $data->username){
        $user = $this->getitemsbyref($data->email, "tbl_moderators", "userEmailAddress", $conn);
        return $user;
      }
    } else {
      $return_arry[] = "";
      $return_arry[0] = false;
      return $return_arry;
    }
  }

  public function userlogout(){
    session_start();
    session_unset();
    session_destroy();

    return ROOT;
    exit();
  }

  public function search($ref, $table, $field, $conn){
    $sql = "SELECT * FROM $table WHERE upper($field) LIKE '%$ref%'";

    $result = mysqli_query($conn, $sql);
    $resaultnumber = mysqli_num_rows($result);

    $return_arry = [];

    if ($resaultnumber > 0) {
      $return_arry[0] = true;
      $return_arry[1] = [];
      while ($row = $result->fetch_assoc()) {
        array_push($return_arry[1], $row);
      }
    } else {
      $return_arry[0] = false;
    }

    return $return_arry;
  }

  public function search_att_val($ref, $ref2, $table, $field, $conn){
    $sql = "SELECT * FROM $table WHERE upper($field) LIKE '%$ref%' AND upper(att_Bond) = '$ref2'";

    $result = mysqli_query($conn, $sql);
    $resaultnumber = mysqli_num_rows($result);

    $return_arry = [];

    if ($resaultnumber > 0) {
      $return_arry[0] = true;
      $return_arry[1] = [];
      while ($row = $result->fetch_assoc()) {
        array_push($return_arry[1], $row);
      }
    } else {
      $return_arry[0] = false;
    }

    return $return_arry;
  }

  public function get_by_ref($fields, $table,$conn, $ref = null , $type = null){
    $is_array = is_array($fields);
    $Responce = [
      false,
    ];
    $temp_arry = array();

    if($is_array){
      $array_count = count($fields);

      if($array_count > 0){
        $fields_combined = implode(",", $fields);

        if(isset($ref)){
          $keys = [];
          $values = [];

          foreach ($ref as &$val) {
            array_push($keys, $val[0]." = ?");
            $myval = $val[1];
            array_push($values, $myval);
          }

          $keys_combined = implode(" AND ", $keys);

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
        }else{
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
    }else{
      if($fields == "*"){

        if (isset($ref)) {
          $keys = [];
          $values = [];

          foreach ($ref as &$val) {
            array_push($keys, $val[0] . " = ?");
            $myval = $val[1];
            array_push($values, $myval);
          }

          $keys_combined = implode(" AND ", $keys);

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
        } else {
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
        }

      }
    }
    
    return $Responce;
  }

  public function add_to_database($dataset,$table,$conn,$type = null,$val = null){
    $fields = array();
    $values = array();

    foreach($dataset as $key => $value){
      array_push($fields, $key);
      array_push($values, $value); 
    }

    if(isset($val)){
      $val = $val;
    }else{
      $val = "(?,?)";
    }

    $statement = implode("`,`", $fields);

    if ($stmt = $conn->prepare("INSERT INTO $table (`$statement`) VALUES $val")) {
      $stmt->bind_param($type, ...$values);
      $stmt->execute();

      return true;
    }

    return false;
  }

  public function delete_from_database($dataset, $table, $conn, $type = null){
    $fields = array();
    $values = array();

    foreach ($dataset as $key => $value) {
      array_push($fields, $key.' = ?');
      array_push($values, $value);
    }

    $statement = implode(" AND ", $fields);


    if ($stmt = $conn->prepare("DELETE FROM $table WHERE $statement")) {
      $stmt->bind_param($type, ...$values);
      $stmt->execute();

      return true;
    }

    return false;
  }

  public function update_database($dataset, $table, $conn, $condition , $type = null)
  {
    $fields = array();
    $values = array();
    $valueFields = array();

    foreach ($dataset as $key => $value) {
      array_push($fields, $key);
      array_push($values, $value);
    }

    foreach ($condition[1] as $value) {
      array_push($valueFields, $value);
    }

    $statement = implode("=?,", $fields);
    $statement2 = $condition[0];

    $statement = $statement."=?";

    $sql = "UPDATE $table SET $statement WHERE $statement2";
    $binder = array();
    $binder = array_merge($values,$valueFields);

    if ($stmt = $conn->prepare($sql)) {
      $stmt->bind_param($type, ...$binder);
      $stmt->execute();

      return true;
    }

    // return false;
  }
}