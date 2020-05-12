<?php
require_once 'Res/Php/Configuration/Config.php';
require_once 'Res/Php/View.php';



if (!isset($_SESSION['CURRENT_USER'])) {
  header('Location: ' . ROOT . '/Logging');
  exit();
} else {
  $tester = false;
  $user =  $moderator->getitemsbyref($_SESSION['CURRENT_USER'], "tbl_moderators", "userEmailAddress", $moderator->getConnection());


  //load instance
  $instance = new dashBoardLoader();

  //ran background checks
  $instance->onCreate($user);

  //set instances
  $passTest = $instance->passwordTest;
}

htmlHeader();

?>

<title>Mtushimports</title>
</head>

<body onload="">
  <?php
  if (!($passTest)) {
    $tester = true;
  }
  ?>
  <!-- onclick="toggle_overlay()" -->
  <div id="overlaymain" class="app_overlay" data-visible="<?php echo $tester ?>">
    <div class="console" onclick="toggle_overlay()">
      <div class="visual" id="visual" onclick="event.stopPropagation()">
        <div class="account_notifications"></div>
        <div class="system_notifications">
          <?php
          if (!$passTest) {
            echo '<div class="system_error"> <p>Please Update your Password</p> <div> X </div> </div>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <nav>
    <div class="logo_panel" onclick="toggle_overlay()">
      <img height="50" src="<?php echo SYS_IMAGES . "Logo.png" ?>" alt="">
    </div>
    <div class="search_nav">
      <form class="searchbar" action="index.html" method="post">
        <input type="search" placeholder="Search" name="" value="">
        <button type="submit" name="button"><img width="25" src="<?php echo SYS_IMAGES . "search.png" ?>" alt=""></button>
      </form>
    </div>
    <div class="accountdrpdwn" onclick="toggleAccount()">
      <img width="50" src="<?php echo SYS_IMAGES . "account.png" ?>" alt="">
      <div class="dropper">
        <div class="linkwrapper">
          <div class="dpic_holder">
            <img src="<?php echo SYS_IMAGES . "account.png" ?>" alt="">
          </div>
          <p>Welcome back</p>
          <p style="margin-bottom: 10px;font-weight:600"><?php echo $user[1][0]['userName'] ?></p>
          <?php
          if ($user[1][0]['Role'] == "Admin") {
            
          } else {
          ?>
            <div class="Edit" onclick="renderContent('moderator','<?php echo $user[1][0]['userEmailAddress'] ?>')">
              Edit Account
            </div>
          <?php
          }
          ?>

          <div class="Edit" onclick="logout()">
            Log out
          </div>
        </div>
      </div>
    </div>
  </nav>



  <div class="wrapper">
    <div id="hidenavi" class="navi" data-mini='false'>
      <div class="navi_holder">
        <div id='hidenav' class="hideorshow" onclick="toggle_left_navigation()">
          <img height="30" src=" <?php echo SYS_IMAGES . "double_arrow_left.png" ?>" alt="">
        </div>
        <div id='shownav' class="hideorshow" onclick="toggle_left_navigation()">
          <img height="30" src=" <?php echo SYS_IMAGES . "double_arrow_right.png" ?>" alt="">
        </div>
      </div>
      <div class="dashboardbtn " onclick="renderContent('Dashboard')">
        <img width="25" src="<?php echo SYS_IMAGES . "dashbrd.png" ?>" alt="">
        <p class="navhidden">Dashboard</p>
      </div>
      <div class="nav_splitter navhidden">
        <p>Store</p>
      </div>
      <div class="cardBtn">
        <div class="presssidedbtn" onclick="renderContent('Customers')">
          <img width="25" src="<?php echo SYS_IMAGES . "customer.png" ?>" alt="">
          <p class="navhidden">Customers</p>
        </div>
        <div class="presssidedbtn" onclick="renderContent('Orders')">
          <img width="25" src="<?php echo SYS_IMAGES . "basket.png" ?>" alt="">
          <p class="navhidden">Orders</p>
        </div>
        <div class="presssidedbtn" onclick="renderContent('Catalog')">
          <img width="25" src="<?php echo SYS_IMAGES . "catalog.png" ?>" alt="">
          <p class="navhidden">Catalog</p>
        </div>
        <div class="presssidedbtn" onclick="renderContent()">
          <img width="25" src="<?php echo SYS_IMAGES . "stat.png" ?>" alt="">
          <p class="navhidden">Statistics</p>
        </div>
      </div>
      <div class="nav_splitter navhidden">
        <p>Management</p>
      </div>
      <div class="cardBtn">
        <div class="presssidedbtn" data-active='true' onclick="renderContent('Suppliers')">
          <img width="25" src="<?php echo SYS_IMAGES . "sup.png" ?>" alt="">
          <p class="navhidden">Vendor</p>
        </div>
        <div class="presssidedbtn" onclick="renderContent('Customers')">
          <img width=" 25" src="<?php echo SYS_IMAGES . "transaction.png" ?>" alt="">
          <p class="navhidden">Transactions</p>
        </div>
        <div class="presssidedbtn" onclick="renderContent('Customers')">
          <img width="25" src="<?php echo SYS_IMAGES . "notification.png" ?>" alt="">
          <p class="navhidden">Notifications</p>
        </div>
        <div class="presssidedbtn" onclick="renderContent('Customers')">
          <img width=" 25" src="<?php echo SYS_IMAGES . "report.png" ?>" alt="">
          <p class="navhidden">Reports</p>
        </div>
      </div>
      <?php

      // $_SESSION['SESSION_TYPE'] = "Admin";

      if ($_SESSION['SESSION_TYPE'] === "Admin") {

      ?>
        <div class="nav_splitter navhidden">
          <p>Admin</p>
        </div>
        <div class="cardBtn">
          <div class="presssidedbtn" onclick="renderContent('Managers')">
            <img width="27" src="<?php echo SYS_IMAGES . "manager.png" ?>" alt="">
            <p class="navhidden">Manager</p>
          </div>
        </div>
      <?php
      }
      ?>
      <div class="cardBtn">
        <div class="presssidedbtn" onclick="renderContent('moderator','<?php echo $user[1][0]['userEmailAddress'] ?>')">
          <img width="27" src="<?php echo SYS_IMAGES . "moderator.png" ?>" alt="">
          <p class="navhidden">Manager</p>
        </div>
      </div>
    </div>

    <div id="content" class="content">


    </div>
  </div>


</body>

</html>