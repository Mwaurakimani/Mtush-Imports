<?php
require_once 'products.php';

/**
 * Administartor
 */
class product
{
  use products;

  function __construct()
  {

  }
  public function product_add($product_data, $conn)
  {
    $data = json_decode($product_data);

    $ID = $this->generateUUID();

    $stmt = $conn->prepare("INSERT INTO tbl_products (UUID) VALUES (?)");
    $bind = $stmt->bind_param("s", $ID);
    $stmt->execute();
    $stmt->close();

    $user = $this->getitemsbyref($_SESSION['CURRENT_USER'], 'tbl_moderators', 'userEmailAddress', $conn);

    if($user[0] == true){
      $added_by = $user[1][0]['UUID'];
      $modified_by = $user[1][0]['UUID'];
    }


    $filednames = [
      'productName',
      'Short_description',
      'long_description',
      'Status',
      'Visibility',
      'enable_edit',
      'Product_type',
      'addedby',
      'Modified_by',
      'Supplier_ID'
    ];

    $values = [
      $data->name,
      json_encode($data->short_description),
      json_encode($data->long_description),
      $data->status,
      $data->Visibility,
      $data->Editable,
      $data->product_type,
      $added_by,
      $modified_by,
      $data->vendor
    ];


    $combined  = array_combine($filednames, $values);

    foreach ($combined as $k => $v) {
      if ($v) {
        $stmt = $conn->prepare("UPDATE tbl_products SET $k=? WHERE UUID=?");
        $stmt->bind_param('ss', $v, $ID);
        $stmt->execute();
        $stmt->close();
      }
    }

    return $this->getitemsbyref($ID, "tbl_products", "UUID", $conn);
  }


  public function update_add($product_data, $conn)
  {
    $data = json_decode($product_data);

    $user = $this->getitemsbyref($_SESSION['CURRENT_USER'], 'tbl_moderators', 'userEmailAddress', $conn);

    if ($user[0] == true) {
      $added_by = $user[1][0]['UUID'];
      $modified_by = $user[1][0]['UUID'];
    }


    $filednames = [
      'productName',
      'Short_description',
      'long_description',
      'Status',
      'Visibility',
      'enable_edit',
      'Product_type',
      'addedby',
      'Modified_by',
      'Supplier_ID'
    ];

    $values = [
      $data->name,
      json_encode($data->short_description),
      json_encode($data->long_description),
      $data->status,
      $data->Visibility,
      $data->Editable,
      $data->product_type,
      $added_by,
      $modified_by,
      $data->vendor
    ];

    $combined  = array_combine($filednames, $values);

    $ID = $_SESSION['CURRENT_PRODUCT'];

    foreach ($combined as $k => $v) {
      if ($v) {
        $stmt = $conn->prepare("UPDATE tbl_products SET $k=? WHERE UUID=?");
        $stmt->bind_param('ss', $v, $ID);
        $stmt->execute();
        $stmt->close();
      } else {
        $stmt = $conn->prepare("UPDATE tbl_products SET $k=? WHERE UUID=?");
        $v = Null;
        $stmt->bind_param('ss', $v, $ID);
        $stmt->execute();
        $stmt->close();
      }
    }

    return $this->getitemsbyref($ID, "tbl_products", "UUID", $conn);
  }


//generate a Universal Unique ID
public function generateUUID()
{
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


//getitem by ref
public function getitemsbyref($ref, $table, $field, $conn)
{
  $sql = "SELECT * FROM $table WHERE $field = '$ref'";

  // echo $sql;
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

  public function simple_p_add($product_data,$prod_ref, $conn){
    $data = json_decode($product_data);

      $ID = $this->generateUUID();

      try{
        $stmt = $conn->prepare("INSERT INTO `tbl_simple_product` (`UUID`,`pod_ref`) VALUES (?,?)");
        $stmt->bind_param("si",$ID,$prod_ref);
        $stmt->execute();
        $stmt->close();

        if($stmt == false){
          throw new Exception("Error inserting");
        }


        $filednames = [
          'SKU',
          'stock_quantity',
          'low_stock_quantity',
          'sold_alone',
          'regular_price',
          'prod_condition',
          'package',
          'estimated_count',
          'price_cat'
        ];

        $values = [
          $data->SKU,
          $data->Stock_Quantity,
          $data->Low_stock_threshhold,
          $data->Sold_alone,
          $data->regular_price,
          $data->condition,
          $data->package,
          $data->estimated_count,
          $data->price_cat
        ];

        

        $combined  = array_combine($filednames, $values);

        foreach ($combined as $k => $v) {
          if ($v) {
            echo $v;
            $stmt = $conn->prepare("UPDATE tbl_simple_product SET $k=? WHERE UUID=?");
            $stmt->bind_param('ss', $v, $ID);
            $stmt->execute();
            $stmt->close();
          }
        }

        return $this->getitemsbyref($ID, "tbl_products", "UUID", $conn);



      } catch (Exception $e){

        if($stmt){
          $stmt->close();
        }

        die($e->getMessage());
      }


  }

  public function simple_p_update($product_data, $id, $conn){
    $data = json_decode($product_data);

    $filednames = [
      'SKU',
      'stock_quantity',
      'low_stock_quantity',
      'sold_alone',
      'regular_price',
      'prod_condition',
      'package',
      'estimated_count',
      'price_cat',
      'cardDescription'
    ];

    $values = [
      $data->SKU,
      $data->Stock_Quantity,
      $data->Low_stock_threshhold,
      $data->Sold_alone,
      $data->regular_price,
      $data->condition,
      $data->package,
      $data->estimated_count,
      $data->price_cat,
      $data->cardDescription
    ];

    $combined  = array_combine($filednames, $values);

    foreach ($combined as $k => $v) {
      if ($v) {
        $stmt = $conn->prepare("UPDATE tbl_simple_product SET $k=? WHERE UUID=?");
        $stmt->bind_param('ss', $v, $id);
        $stmt->execute();
        $stmt->close();
      } else {
        $stmt = $conn->prepare("UPDATE tbl_simple_product SET $k=? WHERE UUID=?");
        $v = Null;
        $stmt->bind_param('ss', $v, $id);
        $stmt->execute();
        $stmt->close();
      }
    }

    return $this->getitemsbyref($id, "tbl_simple_product", "UUID", $conn);
  }


}
