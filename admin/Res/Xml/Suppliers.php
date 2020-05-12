<?php
include_once '../Php/modal.php';

$fields = [
  "UUID",
  "Logo",
  "vendorName",
  "contactName",
  "Phone",
];

$res = $moderator->getselectitems("tbl_vendor", $fields, $moderator->getConnection());
$status = false;
$count = 0;
if ($res[0]) {
  $status = $res[0];
  $vendors_arry = $res[1];
  $count = count($vendors_arry);
}


?>
<div class="head_panel">
  <div class="bread_crums">
    Suppliers
  </div>
  <div style="margin-bottom:10px;" class="subnavigator">
    <div class="current">
      <p>Suppliers</p>
    </div>
    <div class="menucontrols">
      <div style="float:right;margin-right:20px;" class="addNew" onclick="new_vendor()">
        <img style="margin-top:-4px;margin-left:5px;" width="30px;" src="<?php echo SYS_IMAGES ?>addNew.png" alt="">
        <span style="padding-left:1px;font-weight:600;color:white;line-height:35px;">Add New</span>
      </div>
    </div>
  </div>

  <div class=" filter_pannel">
    <div class="top_pannel">
      <ul>
        <li><button>All <span><?php echo $count ?></span></button> </li>
      </ul>
    </div>
    <div class="lower_pannel">
      <ul>
        <li>
          <select name="" id="">
            <option value="">Category</option>
          </select>
        </li>
        <li>
          <select name="" id="">
            <option value="">Product Type</option>
          </select>
        </li>
        <li>
          <select name="" id="">
            <option value="">Stock</option>
          </select>
        </li>
        <li>
          <select name="" id="">
            <option value="">Sort</option>
          </select>
        </li>
        <li>
          <input type="text">
          <!-- <div class="search_results">

        </div> -->
        </li>

      </ul>
    </div>
  </div>

  <div class="splashboard">
    <div class="mainactivities4">
      <div style="font-weight:600;height:33px;padding:3px;" class="cardtitle">
        Vendors <span style="padding:1px 3px 1px 3px;border:2px solid grey;border-radius:8px;"><?php echo $count ?></span>
      </div>
      <div class="salesListdash2">
        <?php
        if ($count > 0) {
        ?>
          <table class="table table-hover" id="vendor_table">
            <thead>
              <tr>
                <th>#</th>
                <th>Company Logo</th>
                <th>Name</th>
                <th>Contact Name</th>
                <th>Phone</th>
              </tr>
            </thead>
            <tbody>
              <?php

              if ($status == true) {

                for ($i = 0; $i < $count; $i++) {

              ?>
                  <tr onclick="open_vendor('<?php echo $res[1][$i]['UUID']; ?>')">
                    <td><?php echo ($p = $i + 1) ?></td>
                    <td><img style="height:30px;" src="<?php echo SYS_IMAGES ?>logo.png" alt=""></td>
                    <td><?php echo $res[1][$i]['vendorName'] ?></td>
                    <td><?php echo $res[1][$i]['contactName'] ?></td>
                    <td><?php echo $res[1][$i]['Phone'] ?></td>
                  </tr>
                <?php

                }
              } else {
                ?>
                <style>
                  #vendor_table {
                    display: none;
                  }
                </style>
              <?php

              }
              ?>

            </tbody>
          </table>
        <?php
        } else {
        ?>
          <div class="noVendors">
            <img src="<?php echo SYS_IMAGES . "noVendor.png" ?>" alt="">
            <br>
            <br>
            <p>No Vendors Found</p>
            <button onclick="new_vendor()">Add New</button>
          </div>
        <?php
        }
        ?>

      </div>
    </div>
  </div>
</div>