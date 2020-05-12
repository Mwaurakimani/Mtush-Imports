<?php
include_once '../Php/modal.php';
?>
<div class="head_panel">
  <div class="bread_crums">
    Managers
  </div>
  <div style="margin-bottom:10px;" class="subnavigator">
    <div class="current">
      <p>Managers</p>
    </div>
    <div class="menucontrols">
      <div class="addNew" onclick="addnewUser()">
        <img style="margin-top:-4px;margin-left:5px;" width="30px;" src="<?php echo SYS_IMAGES ?>addNew.png" alt="">
        <span style="padding-left:1px;font-weight:600;color:white;line-height:35px;">Add New</span>
      </div>
    </div>
  </div>

  <div class="splashboard">
    <div class="mainactivities4">
      <div style="font-weight:600" class="cardtitle">
        Managers
      </div>
      <div class="salesListdash2">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Phone Number</th>
            </tr>
          </thead>
          <tbody>
            <tr id="rendermng" onclick="rendermanagers()">
              <td>
                <div>
                  <input type="text" name="customerlistID" value="">
                </div>
              </td>
              <td>
                <div>
                  <input type="text" name="customerlistFname" value="">
                </div>
              </td>
              <td>
                <div>
                  <input type="text" name="customerlistLname" value="">
                </div>
              </td>
              <td>
                <div>
                  <input type="text" name="customerlistEmail" value="">
                </div>
              </td>
            </tr>
            <?php
            $fields = [
              "nationalID",
              "userFirstName",
              "userOtherName",
              "userLastName",
              "userEmailAddress",
              "userPhoneNumber"
            ];

            $items = $moderator->getselectitems('tbl_moderators', $fields, $moderator->getConnection());

            if (!$items[0]) {
            ?>
              -
              <?php
            } else {
              $initializer = 0;
              $max = count($items[1]);

              for ($initializer; $initializer < $max; $initializer++) {

              ?>
                <tr data-email="<?php echo  $items[1][$initializer]['userEmailAddress'];  ?>" onclick="selectmanager()">
                  <?php
                  $id = $items[1][$initializer]['nationalID'];
                  $name = $items[1][$initializer]['userFirstName'] . " " . $items[1][$initializer]['userOtherName'] . " " . $items[1][$initializer]['userLastName'];
                  $email = $items[1][$initializer]['userEmailAddress'];
                  $Phone = $items[1][$initializer]['userPhoneNumber'];
                  ?>
                  <td><?php echo $id ?></td>
                  <td><?php echo $name ?></td>
                  <td><?php echo $email ?></td>
                  <td><?php echo $Phone ?></td>
                  <?php

                  ?>
                </tr>
            <?php
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>