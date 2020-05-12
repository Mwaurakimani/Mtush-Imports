<?php
require_once 'User.php';
require_once 'SecureUserConnection.php';

  /**
   * Administartor
   */
  class ModeratorUser
  {
    use secureUserBbConnecton;
    use appUser;


    function __construct()
    {
      $this->conn();
    }
  public function getrelatedattributevalues($table, $fields, $conn)
  {
    $REF = "'".$_SESSION['ATT_ID']."'";
    $gen = implode(",", $fields);
    $sql = "SELECT $gen FROM $table WHERE `att_Bond` = $REF ";
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
  }
