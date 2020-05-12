<?php
  session_start();
  require_once 'Configuration/Config.php';
  require_once 'Classes/classloader.php';
  require_once 'Metaconfig/metaData.php';
  require_once 'Metaconfig/metaFunction.php';

$tables_ref = array(
  "tags" => array(

      "table_name"=>"tbl_tags",

      "table_fields"=>array(
          "id"=>"UUID",
          "name"=>"tag_name",
          "slung"=>"tag_slung",
          "description"=>"tag_description"
      )

  ),

  "attributes" => array(

    "table_name" => "tbl_attributes",

    "table_fields" => array(
      "id" => "UUID",
      "name" => "att_name",
      "slung" => "att_slung",
      "description" => "att_description"
    )

  ),
  "attributes_values" => array(

    "table_name" => "tbl_attributes_values",

    "table_fields" => array(
      "id" => "UUID",
      "name" => "value_name",
      "slung" => "att_slung",
      "description" => "att_description"
    )

  ),

  "vendors" => array(

    "table_name" => "tbl_vendor",

    "table_fields" => array(
      "id" => "UUID",
      "name" => "vendorName"
    )

  ),

  "category" => array(

    "table_name" => "tbl_category",

    "table_fields" => array(
      "id" => "UUID",
      "name" => "cat_name",
      "slung" => "cat_slung",
      "description" => "cat_description",
      "parent" => "cat_parent"
    )

  ),
);

  $admin = new AdminUser();
  $manager = new ManagerUser();
  $moderator = new ModeratorUser();
  $currentUser;
