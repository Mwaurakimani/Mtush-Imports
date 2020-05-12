<?php
header('Set-Cookie: cross-site-cookie=name; SameSite=None; Secure');

include_once 'Modal.php';

function htmlHeader()
{
  echo '<!DOCTYPE html>
    <html lang="en" dir="ltr">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="refresh" content="">
        <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="HandheldFriendly" content="true">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>'.
        
        // <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        // <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


        '<link rel="stylesheet" href="libs/css/bootstrap/node_modules/bootstrap/dist/css/bootstrap.min.css">
        <script src="libs/css/bootstrap/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
        <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />

        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">'.

    // <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>


    '<!-- main site atributes -->
            
            <link href="libs/js/quill/quill.snow.css" rel="stylesheet"> 
            <script src="libs/js/quill/quill.js"></script>
            <script src="quill-resize/image-resize.min.js"></script>

        

        <script data-main = "libs/main" src = "https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>
        <link rel="stylesheet" href="' . ROOT . '/libs/css/main.css">';

}

function attribute_component($data, $moderator)
{
  $res = $moderator->getitemsbyref($data, "tbl_attributes", "UUID", $moderator->getConnection());

  if ($res[0] == true) {
?>
    <div class="set_attribute_value" data-toggle=true>
      <div class="attribute_head" onclick="minimize_attribute('all')">
        <p><?php echo $res[1][0]['att_name'] ?></p>
        <div class="elem_control">
          <p>Remove</p>
        </div>
      </div>
      <div class="attribute_body">
        <div class="name_column">
          <div class="label_item">
            Name
          </div>
          <h6><?php echo $res[1][0]['att_name'] ?></h6>
        </div>
        <div class="values_column">
          <div class="label_item">
            Value
          </div>
          <div class="input_section">
            <div class="selected" id="att_selected">
            </div>
            <input autocomplete="off" type="text" onkeyup="search_att_val('<?php echo $res[1][0]['UUID'] ?>')" onfocus="add_att()" onblur="setTimeout(att_blurred(),1000)">
            <ul onclick="select_attr()" id="att_select_helpre">
            </ul>
          </div>
        </div>
      </div>
    </div>
<?php
  } else {
    echo $data;
    echo "error in view attribute does not exist";
  }
}


// <link href="https://cdn.quilljs.com/1.2.2/quill.snow.css" rel="stylesheet">
        // <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.core.js"></script>
