<?php
include_once '../../Php/modal.php';

$exist = false;
$user =  $moderator->getitemsbyref($_SESSION['CURRENT_USER'], "tbl_moderators", "userEmailAddress", $moderator->getConnection());
if ($user[0]) {
    $exist = true;
}
?>

<div class="head_panel">
    <div class="bread_crums">
        <?php echo $user[1][0]['Role'] ?>
    </div>
    <div style="margin-bottom:10px;" class="subnavigator">
        <div class="current">
            <p><?php echo $user[1][0]['userName'] ?></p>
        </div>
        <div class="menucontrols">

        </div>
    </div>

    <div class="splashboard">
        <!-- content -->
        <div class="addItem">

            <div class="reg_det">
                <h5><?php echo $user[1][0]['Role'] ?> Contact Details</h5>
                <div class="field_holder">

                    <p>E-mail</p>
                    <input disabled type="Email" name="Email" id="Email" value="<?php if ($exist) {
                                                                            echo $user[1][0]['userEmailAddress'];
                                                                        } ?>">
                </div>
                <div class="field_holder">
                    <p>Phone Number</p>
                    <input disabled type="tel" name="P_Number" id="P_Number" value="<?php if ($exist) {
                                                                                echo $user[1][0]['userPhoneNumber'];
                                                                            } ?>">
                </div>
                <div class="field_holder">
                    <p>Address</p>
                    <input disabled type="address" name="Address" id="Address" value="<?php if ($exist) {
                                                                                    echo $user[1][0]['Address'];
                                                                                } ?>">
                </div>
            </div>

            <div class="reg_det">
                <h5>Change Password</h5>

                <div class="field_holder">
                    <p>Current Password</p>
                    <input type="password" name="currentPassword" class="userPassword" placeholder="Enter the current password">
                    <button class="showPassword" onclick="toggle_password()"><img src="<?php echo SYS_IMAGES . "/hide" ?>" alt=""></button>
                </div>

                <div class="field_holder">
                    <p>New Password</p>
                    <input type="password" name="newPassword" class="userPassword" placeholder="Enter new password">
                    <button class="showPassword" onclick="toggle_password()"><img src="<?php echo SYS_IMAGES . "/hide" ?>" alt=""></button>
                </div>

                <div class="field_holder">
                    <p>Confirm Password</p>
                    <input type="password" name="confirmPassword" class="userPassword" placeholder="Confirm password">
                    <button class="showPassword" onclick="toggle_password()"><img src="<?php echo SYS_IMAGES . "/hide" ?>" alt=""></button>
                </div>

            </div>

            <div class="Submition">
                <button onclick="pass_moderator()">Submit</button>
            </div>

        </div>


    </div>
</div>