<?php
include_once '../../Php/Modal.php';

$exist = false;
if (isset($_SESSION['CURRENT_VENDOR'])) {
    $resp = $moderator->getitemsbyref($_SESSION['CURRENT_VENDOR'], "tbl_vendor", "UUID", $moderator->getConnection());

    $exist = $resp[0];

    $val = $resp[1][0];
} else {
}
?>
<div class="splashboard">
    <div class="add_supplier">
        <div class="reg_det">
            <h5>Vendor Profile</h5>
            <div class="field_holder">
                <p>Company Name</p>
                <input type="Text" name="vendor_name" id="V_name" value="<?php if ($exist) {
                                                                                echo $val['vendorName'];
                                                                            } ?>">
            </div>
            <div class="company_profile_edit">
                <div class="company_details">
                    <h5>Details</h5>
                    <div class="field_holder">
                        <p>City</p>
                        <input type="text" name="city1" id="V_city1" value="<?php if ($exist) {
                                                                                echo $val['city1'];
                                                                            } ?>">
                    </div>
                    <div class="field_holder">
                        <p>Address 1</p>
                        <input type="text" name="Address1" id="V_Address1" value="<?php if ($exist) {
                                                                                        echo $val['address1'];
                                                                                    } ?>">
                    </div>
                    <div class="field_holder">
                        <p>City 2</p>
                        <input type="text" name="city2" id="V_city2" value="<?php if ($exist) {
                                                                                echo $val['city2'];
                                                                            } ?>">
                    </div>
                    <div class="field_holder">
                        <p>Address 2</p>
                        <input type="text" name="Address2" id="V_Address2" value="<?php if ($exist) {
                                                                                        echo $val['address2'];
                                                                                    } ?>">
                    </div>
                    <div class="field_holder">
                        <p>Postal Code</p>
                        <input type="Text" name="POBox" id="postal_code" value="<?php if ($exist) {
                                                                                    echo $val['postalCode'];
                                                                                } ?>">
                    </div>

                </div>
                <div class="company_contact">
                    <h5>Contact</h5>
                    <div class="field_holder">
                        <p>Contact Name</p>
                        <input type="text" name="contact_name" id="contact_name" value="<?php if ($exist) {
                                                                                            echo $val['contactName'];
                                                                                        } ?>">
                    </div>
                    <div class="field_holder">
                        <p>Contuct Title</p>
                        <input type="text" name="contact_title" id="contact_title" value="<?php if ($exist) {
                                                                                                echo $val['contactTitle'];
                                                                                            } ?>">
                    </div>

                    <div class="field_holder">
                        <p>Phone number</p>
                        <input type="tel" name="Phone" id="Phone" value="<?php if ($exist) {
                                                                                echo $val['Phone'];
                                                                            } ?>">
                    </div>
                    <div class="field_holder">
                        <p>Email</p>
                        <input type="Email" name="Email" id="Email" value="<?php if ($exist) {
                                                                                echo $val['Email'];
                                                                            } ?>">
                    </div>
                    <div class="field_holder">
                        <p>Website</p>
                        <input type="url" name="website" id="website" value="<?php if ($exist) {
                                                                                    echo $val['Url'];
                                                                                } ?>">
                    </div>
                </div>
            </div>
        </div>
        <div class="reg_det">
            <h5>Extras</h5>
            <div class="field_holder note">
                <p>Company logo</p>
                <div class="comp_log">
                    <div class="elem_display_image">
                        <div class="elem_logo_placeholder">
                            <div class="elem_vendor_image">
                                <img id="vendor_id_img" src="<?php echo SYS_IMAGES . "/login_short.jpeg" ?>" alt="">
                            </div>
                        </div>
                        <div class="edit_place_holder"></div>
                    </div>

                    <div class="elem_add_image">

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" name="V_image" onchange="load_file()">
                                <label class="custom-file-label" for="inputGroupFile01" id="vendor_image_name">Choose file</label>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="field_holder note">
                <p>Notes</p>
                <textarea name="Notes" id="Notes" cols="30" rows="10"><?php if ($exist) {
                                                                            echo html_entity_decode($val['Note']);
                                                                        } ?></textarea>
            </div>
        </div>
        <div class="Submition">
            <button onclick="update_vendor()">Submit</button>
        </div>
    </div>
</div>