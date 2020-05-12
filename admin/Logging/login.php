<?php
require_once '../Res/Php/Modal.php';

$errorCode = "";
$solution = "";

if (isset($_POST['Submit'])) {

  $conn = $moderator->getConnection();

  $username = $_POST["Username"];
  $email = $_POST["Email"];
  $password = $_POST["Password"];

  if (empty($username) || empty($email) || empty($password)) {
    $errorCode = "Some fields were empty";
  } else {
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      echo "invalid email";
      exit();
    } else {
      $exist = $moderator->ifItemExist($email, "tbl_moderators", "userEmailAddress", $conn);
      if ($exist) {
        $email = encodeToHTML($email);
        $username = encodeToHTML($username);

        $UserData = array('email' => $email, 'username' => $username, 'password' => $password);
        $UserData = json_encode($UserData);
        $currentUser = $moderator->managerLogIn($UserData, $conn);

        if ($currentUser[0]) {
          $_SESSION['CURRENT_USER'] = $currentUser[1][0]['userEmailAddress'];
          $_SESSION['SESSION_TYPE'] = $currentUser[1][0]['Role'];

          header("location:" . ROOT);
          exit();
        } else {
          $errorCode = "Invalid User Credentials";
        }
      } else {
        $errorCode = "Invalid User Credentials";
      }
    }
  }
} else {
  $errorCode = "Invalid Request.";
  $solution = "";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <!-- <meta http-equiv="refresh" content="3"> -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="css/main.css">
  <script src="index.js"></script>
  <title>Log_in Error</title>
</head>

<body>
  <div class="wrapper_main">
    <div class="error_box">
      <h3>Log In Error</h3>
      <img src="<?php echo SYS_IMAGES . "/warning.png" ?>" alt="">
      <p class="issue"><?php echo $errorCode ?></p>
      <p class="Solution"><?php echo $solution ?> <a href="<?php echo ROOT . "/Logging"  ?>">try again</a></p>
    </div>
  </div>
</body>

</html>
*/