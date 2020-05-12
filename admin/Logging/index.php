<?php
include_once "../Res/Php/modal.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="refresh" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha256-Uv9BNBucvCPipKQ2NS9wYpJmi8DTOEfTA/nH2aoJALw=" crossorigin="anonymous"></script>

    <title>Log In</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="index.js"></script>
</head>

<body>
    <div class="darken">
        <div class="wrapper">
            <div class="left_banner">
                <div class="bg_login">
                    <img src="<?php echo SYS_IMAGES ?>/logo.png" alt="">
                </div>
            </div>
            <div class="right_banner">
                <form action="login.php" method="POST">
                    <h5>Log In</h5>
                    <div class="input_holders">
                        <img src=" <?php echo SYS_IMAGES ?>/user.png" alt="">
                        <input type="text" name="Username" placeholder="Username" id="username">
                    </div>
                    <div class="input_holders">
                        <img src=" <?php echo SYS_IMAGES ?>/email.png" alt="">
                        <input type="email" name="Email" placeholder="Email" id="Email">
                    </div>
                    <div class="input_holders">
                        <img src=" <?php echo SYS_IMAGES ?>/key.png" alt="">
                        <input type="password" name="Password" placeholder="Password" id="Password">
                    </div>
                    <div class="submit">
                        <button type="submit" name="Submit">
                            Submit
                        </button>
                        <button type="reset">
                            Reset
                        </button>
                    </div>
                    <div class="reset_account">
                      <a href="">Forgot Password</a>
                    <div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>