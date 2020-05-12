<?php
/*
 * Products parent class
 */

trait products
{
  public function catalog_massaction($conn, $data, $table, ...$func)
  {

    $data = json_decode($data);
    

    

    if (isset($func[1])) {
      $exist = true;
    } else {
      $exist = false;
    }

    if ($exist) {
      $ID = $func[1];

      $combined = $func[0]($data);


      foreach ($combined as $k => $v) {
        if ($v) {
          $stmt = $conn->prepare("UPDATE $table SET $k=? WHERE UUID=?");
          $stmt->bind_param('ss', $v, $ID);
          $stmt->execute();
          $stmt->close();
        }
      }
    } else {
      //generate ID
      $ID = $this->generateUUID();

      //pass the ID
      $stmt = $conn->prepare("INSERT INTO $table (UUID) VALUES (?)");
      $bind = $stmt->bind_param("s", $ID);
      $stmt->execute();
      $stmt->close();

      $combined = $func[0]($data);

      // insert data
      foreach ($combined as $k => $v) {
        if ($v) {
          $stmt = $conn->prepare("UPDATE $table SET $k=? WHERE UUID=?");
          $stmt->bind_param('ss', $v, $ID);
          $stmt->execute();
          $stmt->close();
        }
      }
    }

    $obj = $this->getitemsbyref($ID, $table, 'UUID', $conn);

    return $obj;
  }

  public function getProduct()
  {
    # code...
  }
}
