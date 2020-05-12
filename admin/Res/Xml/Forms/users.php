<?php
include_once '../../Php/modal.php';
$exist = false;
if (isset($_SESSION['REG_EMAIL'])) {
    $exist = $moderator->ifItemExist($_SESSION['REG_EMAIL'], "tbl_moderators", "userEmailAddress", $moderator->getConnection());
    if ($exist) {
        $user = $moderator->getitemsbyref($_SESSION['REG_EMAIL'], "tbl_moderators", "userEmailAddress", $moderator->getConnection());
    }
}
?>

<div class="addItem">
    <div class="reg_det">
        <h5>Manager Personal Details</h5>
        <div class="field_holder">
            <p>First Name</p>
            <input type="text" name="F_name" id="F_name" value="<?php if ($exist) {
                                                                    echo $user[1][0]['userFirstName'];
                                                                } ?>">
        </div>
        <div class="field_holder">
            <p>Last Name</p>
            <input type="text" name="L_name" id="L_name" value="<?php if ($exist) {
                                                                    echo $user[1][0]['userLastName'];
                                                                } ?>">
        </div>
        <div class="field_holder">
            <p>Other Name</p>
            <input type="text" name="O_name" id="O_name" value="<?php if ($exist) {
                                                                    echo $user[1][0]['userOtherName'];
                                                                } ?>">
        </div>
        <div class="field_holder">
            <p>User Name</p>
            <input type="text" name="U_name" id="U_name" value="<?php if ($exist) {
                                                                    echo $user[1][0]['userName'];
                                                                } ?>">
        </div>
        <div class="field_holder">
            <p>User Password</p>
            <input type="password" name="password" id="password" placeholder="Enter value to change password">
            <button id="showpassword" onclick="toggle_password()"><img src="<?php echo SYS_IMAGES . "/hide" ?>" alt=""></button>
        </div>
        <div class="field_holder">
            <p>User ID Number</p>
            <input type="text" name="NID" id="UID" value="<?php if ($exist) {
                                                                echo $user[1][0]['nationalID'];
                                                            } ?>">
        </div>
        <div class="field_holder">
            <p>Gender</p>
            <select name="Gender" id="Gender">
                <option value="None" <?php
                                        if ($exist) {
                                            $gender =  $user[1][0]['gender'];
                                            if ($gender == "Male") {
                                                echo "None";
                                            }
                                        }
                                        ?>>None</option>
                <option value="Male" <?php
                                        if ($exist) {
                                            $gender =  $user[1][0]['gender'];
                                            if ($gender == "Male") {
                                                echo "selected";
                                            }
                                        }
                                        ?>>Male</option>
                <option value="Female" <?php
                                        if ($exist) {
                                            $gender =  $user[1][0]['gender'];
                                            if ($gender == "Female") {
                                                echo "selected";
                                            }
                                        }
                                        ?>>Female</option>
            </select>
        </div>

    </div>

    <div class="reg_det">
        <h5>Manager Contacts Details</h5>
        <div class="field_holder">
            <p>E-mail</p>
            <input type="Email" name="Email" id="Email" value="
            <?php
                if ($exist) {
                echo $user[1][0]['userEmailAddress'];
                } 
            ?>
            ">
        </div>
        <div class="field_holder">
            <p>Phone Number</p>
            <input type="tel" name="P_Number" id="P_Number" value="<?php if ($exist) {
                                                                        echo $user[1][0]['userPhoneNumber'];
                                                                    } ?>">
        </div>
        <div class="field_holder">
            <p>Address</p>
            <input type="address" name="Address" id="Address" value="<?php if ($exist) {
                                                                            echo $user[1][0]['Address'];
                                                                        } ?>">
        </div>
    </div>

    <div class="reg_det">
        <h5>Account Details</h5>
        <div class="field_holder">
            <p>Role</p>
            <select name="Role" id="Role">
                <option value="Manager" <?php
                                        if ($exist) {
                                            $Role =  $user[1][0]['Role'];
                                            if ($Role == "Manager") {
                                                echo "selected";
                                            }
                                        }
                                        ?>>Manager</option>
                <option value="Admin" <?php
                                        if ($exist) {
                                            $Role =  $user[1][0]['Role'];
                                            if ($Role == "Admin") {
                                                echo "selected";
                                            }
                                        }
                                        ?>>Admin</option>
                <option value="Moderator" <?php
                                            if ($exist) {
                                                $Role =  $user[1][0]['Role'];
                                                if ($Role == "Moderator") {
                                                    echo "selected";
                                                }
                                            }
                                            ?>>Moderator</option>
            </select>
        </div>
        <div class="field_holder">
            <p>Status</p>
            <select name="Status" id="Status">
                <option value="Active" <?php
                                        if ($exist) {
                                            $Status =  $user[1][0]['accountStatus'];
                                            if ($Status == "Active") {
                                                echo "selected";
                                            }
                                        }
                                        ?>>Active</option>
                <option value="Suspended" <?php
                                            if ($exist) {
                                                $Status =  $user[1][0]['accountStatus'];
                                                if ($Status == "Suspended") {
                                                    echo "selected";
                                                }
                                            }
                                            ?>>Suspended</option>
                <option value="Terminated" <?php
                                            if ($exist) {
                                                $Status =  $user[1][0]['accountStatus'];
                                                if ($Status == "Terminated") {
                                                    echo "selected";
                                                }
                                            }
                                            ?>>Terminated</option>
            </select>
        </div>
        <div class="field_holder">
            <p>Date Created</p>
            <p class="value"><?php if ($exist) {
                                    echo $user[1][0]['regDate'];
                                } ?></p>
        </div>
        <div class="field_holder">
            <p>Last Modified</p>
            <p class="value"><?php if ($exist) {
                                    echo $user[1][0]['lastModified'];
                                } ?></p>
        </div>
    </div>

    <div class="Submition">
        <button onclick="pass_user()">Submit</button>
    </div>

</div>