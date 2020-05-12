<?php
  include_once '../Php/modal.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $conn = $moderator->getConnection();
  $action = isset($_REQUEST['action']) ?  ( $_REQUEST['action']) : $action = "";
  if (empty($action)) {
    echo "F_name";
    exit;
  }
  if (!preg_match("/^[a-zA-Z]*$/", $action)) {
    echo "error";
    exit;
  }

  $action = encodeToHTML($action);

  switch ($action) {
    case "General":
      echo "Your favorite color is red!";
      break;
    case "Inventory":
      echo "Your favorite color is blue!";
      break;
    case "Link":
      echo "Your favorite color is green!";
      break;
    case "Attributes":
      echo "Your favorite color is green!";
      break;
    case "Advanced":
      echo "Your favorite color is green!";
      break;
    case "Options":
      echo "Your favorite color is green!";
      break;
    default:
      echo "Your favorite color is neither red, blue, nor green!";
  }

  exit;
}else {
  echo "not POst";
}

/*
JS connector
    if (elemclick.is("ul")) {
        elemclick.addClass("active");
        var action = elemclick.text();

        $.post("Res/Handlers/render_sku_panel.php", {
                action: action
            })
            .done(function(data) {
                console.log(data);
            });
    }
*/
