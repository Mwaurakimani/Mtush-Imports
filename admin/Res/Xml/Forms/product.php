 <?php
    include_once '../../Php/modal.php';
    include_once '../../Php/View.php';
    ?>

 <?php
    $exist = false;
    $exist1 = false;
    if (isset($_SESSION['CURRENT_PRODUCT'])) {
        $resp = $moderator->getitemsbyref($_SESSION['CURRENT_PRODUCT'], "tbl_products", "UUID", $moderator->getConnection());
        if ($resp[0] == true) {
            $id = $moderator->getitemsbyref($_SESSION['CURRENT_PRODUCT'], "tbl_products", "UUID", $moderator->getConnection());

            $myid = $id[1][0]['ListOrder'];

            $exist = true;

            $fields = "*";

            $table = "tbl_simple_product";

            $ref = [
                array("pod_ref", $myid),
            ];

            $type = "s";

            $simple = $moderator->get_by_ref($fields, $table, $moderator->getConnection(), $ref, $type);

            if ($simple[0] == true) {
                $exist1 = true;
            }
        }
    }

    ?>
 <div class="splashboard">
     <div class="action_description">
         Edit Product
     </div>
     <div class="content_edit">
         <div class="right_edit">
             <div class="product_name_elem">
                 <input type="text" name="product_name" value="<?php if ($exist == true) {
                                                                    echo $resp[1][0]["productName"];
                                                                } ?>"></input>
             </div>
             <div class="product_short_description">
                 <div class="elem_header_prod">
                     <div class="elem_name">Short Description</div>
                     <div class="dropdown" onclick="openelem()" data-open=true><span class=""></span></div>
                 </div>
                 <div class="product_conf" id="editor">
                 </div>
             </div>
             <div class="SKU_data">
                 <div class="elem_header_prod">
                     <div class="elem_name">SKU-Details</div>
                     <div class="prod_type">
                         <select name="product_type" id="product_type_select">
                             <optgroup label="Product Type">
                                 <option selected="selected" value="Single">Single</option>
                                 <option value="Bale">Bale</option>
                             <optgroup>
                         </select>
                     </div>
                     <div class="sale_location">sale</div>
                     <div class="dropdown" onclick="render_sku()" data-open=true><span class=""></span></div>
                 </div>
                 <div class="sku_panel">
                     <div class="left_selection" onclick="set_prod_propertirs()">
                         <ul>
                             <ul>General</ul>
                             <ul>Inventory</ul>
                             <!-- <ul>Link</ul> -->
                             <!-- <ul>Attributes</ul> -->
                             <ul>Details</ul>
                             <!-- <ul>Options</ul> -->
                         </ul>
                     </div>
                     <div class=" right_selection">
                         <div id="General" class="sku_btn_nav">
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Regular Price (Ksh)</p>
                                 <input type="number" name="Regular_price" value="<?php if ($exist && $exist1) {
                                                                                        echo $simple[1][0]['regular_price'];
                                                                                    }
                                                                                    ?>">
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Sale Price</p>
                                 <input disabled type="number" placeholder="Disbled" name="Sale_price">
                             </div>
                             <div class="add_info">
                                 <p onclick="add_more()">View more</p>
                                 <div class="content_area" data-height='150' data-toggle="false">
                                     <div class="input_text_prptotype">
                                         <p class="Input_title">From</p>
                                         <input name="st_data" type="datetime-local" placeholder="From" value="">
                                     </div>
                                     <div class="input_text_prptotype">
                                         <p class="Input_title">To</p>
                                         <input name="end_data" type="datetime-local" placeholder="To" value="">
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div id="Inventory" class="sku_btn_nav">
                             <div class="input_text_prptotype">
                                 <p class="Input_title">SKU</p>
                                 <input data-id="<?php if ($exist && $exist1) {
                                                        echo $resp[1][0]["UUID"];
                                                    } ?>" type="text" name="SKU_val" value=" <?php if ($exist && $exist1) {
                                                                                                    echo $simple[1][0]['SKU'];
                                                                                                } ?>">
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Vendor</p>
                                 <input autocomplete="off" type="text" name="vendor" onkeyup="show_vendors()" data-id='<?php if ($exist && $exist1) {
                                                                                                                            echo $resp[1][0]["Supplier_ID"];
                                                                                                                        } ?>' value="<?php
                                                                                                                                        if ($exist && $exist1) {
                                                                                                                                            $vendor_id = $resp[1][0]['Supplier_ID'];

                                                                                                                                            $other_resp = $moderator->getitemsbyref($vendor_id, "tbl_vendor", "UUID", $moderator->getConnection());

                                                                                                                                            if ($other_resp[0] == true) {
                                                                                                                                                echo $other_resp[1][0]['vendorName'];
                                                                                                                                            }
                                                                                                                                        }

                                                                                                                                        ?>">
                                 <div class="vendor_sadgestion" id="vendor_sadgestion">
                                     <ul>
                                     </ul>
                                 </div>
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Stock Quantity</p>
                                 <input type="number" name="Stock_Quantity" value="<?php if ($exist && $exist1) {
                                                                                        echo $simple[1][0]['stock_quantity'];
                                                                                    } ?>">
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Low stock threshold</p>
                                 <input type="number" name="Low_stock_threshhold" value="<?php if ($exist && $exist1) {
                                                                                                echo $simple[1][0]['low_stock_quantity'];
                                                                                            } ?>">
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Sold alone</p>
                                 <select name="Sold_alone" id="">
                                     <option value="Yes">Yes</option>
                                     <option selected="selected" value="No">No</option>
                                 </select>
                             </div>
                         </div>
                         <div id="Link" class="sku_btn_nav">
                             <div class="upsell_container">
                                 <div class="title_container">
                                     <p>Upsell</p>
                                 </div>
                                 <div class="usell_item_container">
                                     <div class="sell_display" onclick="focus_on_input()">
                                         <?php
                                            for ($i = 0; $i < 3; $i++) {
                                            ?>
                                             <p><span>x</span>Jordan</p>
                                             <p><span>x</span>Sandles</p>
                                             <p><span>x</span>Jogging tranks</p>
                                         <?php
                                            }
                                            ?>
                                     </div>
                                     <input type="text" name="" id="upsell_input" autocomplete="off">
                                     <div class="search_display">

                                     </div>
                                 </div>

                             </div>
                             <div class="upsell_container">
                                 <div class="title_container">
                                     <p>Cross-sell</p>
                                 </div>
                                 <div class="usell_item_container" onclick="focus_on_input()">
                                     <div class="sell_display" style="z-index:30">
                                         <?php
                                            for ($i = 0; $i < 10; $i++) {
                                            ?>
                                             <p><span>x</span>Jordan</p>
                                             <p><span>x</span>Sandles</p>
                                             <p><span>x</span>Jogging tranks</p>
                                         <?php
                                            }
                                            ?>
                                     </div>
                                     <input type="text" name="" id="crosssell_input" autocomplete="off">
                                     <div class="search_display">
                                         <div class="srch_cont">

                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div id="Attributes" class="sku_btn_nav">
                             <div class="element_add_attribute" id="ref_add_att">
                                 <div class="selection">
                                     <input id="add_product_attribute" type="text" onkeyup="search_attribute()" onblur="setTimeout(hide_attributeselect, 1000)">
                                     <div class="sudgestion" id="attribute_sudgestions">

                                     </div>
                                 </div>
                                 <button onclick="confirm_add_attribute()">Add</button>
                             </div>
                             <?php
                                // attribute_component('78ce3a40-a63c-4e3f-bbf9-36b0077ef468',$moderator);
                                ?>

                         </div>
                         <div id="Details" class="sku_btn_nav">
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Condition</p>
                                 <input type="text" name="Condition" value="<?php if ($exist && $exist1) {
                                                                                echo $simple[1][0]['prod_condition'];
                                                                            }
                                                                            ?>">
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Packaging</p>
                                 <input type="text" name="Packaging" value="<?php if ($exist && $exist1) {
                                                                                echo $simple[1][0]['package'];
                                                                            }
                                                                            ?>">
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Estimate Pieces</p>
                                 <input type="Number" name="Estimate" value="<?php if ($exist && $exist1) {
                                                                                    echo $simple[1][0]['estimated_count'];
                                                                                }
                                                                                ?>">
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Price Category</p>
                                 <input type="text" name="pricecat" value="<?php if ($exist && $exist1) {
                                                                                echo $simple[1][0]['price_cat'];
                                                                            }
                                                                            ?>">
                             </div>
                             <div class="input_text_prptotype">
                                 <p class="Input_title">Card Description</p>
                                 <textarea name="cardDescription" id="cardDescription" cols="30" rows="10" style="text-align: left" maxlength="150"><?php if ($exist && $exist1) {
                                                                                                                                                        echo $simple[1][0]['cardDescription'];
                                                                                                                                                    } ?></textarea>
                             </div>
                         </div>
                         <div id="Options" class="sku_btn_nav">
                             <p>Options</p>
                         </div>

                     </div>
                 </div>
             </div>

             <div class="product_short_description">
                 <div class="elem_header_prod">
                     <div class="elem_name">Full Description</div>
                     <div class="dropdown" onclick="openelem()" data-open=true><span class=""></span></div>
                 </div>
                 <div class="product_conf" id="editor2">

                 </div>
             </div>
         </div>
         <div class="left_edit">
             <div class="product_update">
                 <div class="elem_header_prod">
                     <div class="elem_name">Product Settings</div>
                     <div class="dropdown" onclick="openleftpan(250)" data-open=true><span class=""></span></div>
                 </div>
                 <div class="product_settings" id="prod_settings">
                     <div class="input_text_prptotype">
                         <p class="Input_title">Status</p>
                         <select name="product_active" id="">
                             <option <?php
                                        if ($exist) {
                                            if ($resp[1][0]["Status"] == "Active") {
                                                echo "selected";
                                            }
                                        } else {
                                            echo "selected";
                                        }
                                        ?> value="Active">Active</option>
                             <option <?php
                                        if ($exist) {
                                            if ($resp[1][0]["Status"] == "Inactive") {
                                                echo "selected";
                                            }
                                        }
                                        ?> value="Inactive">Inactive</option>
                         </select>
                     </div>
                     <div class="input_text_prptotype">
                         <p class="Input_title">Visibility</p>
                         <select name="Product_visibility" id="">
                             <option <?php
                                        if ($exist) {
                                            if ($resp[1][0]["Visibility"] == "All") {
                                                echo "selected";
                                            }
                                        } else {
                                            echo "selected";
                                        }
                                        ?> value="All">All</option>
                             <option <?php
                                        if ($exist) {
                                            if ($resp[1][0]["Visibility"] == "shop_only") {
                                                echo "selected";
                                            }
                                        }
                                        ?> value="shop_only">Shop</option>
                             <option <?php
                                        if ($exist) {
                                            if ($resp[1][0]["Visibility"] == "Search_only") {
                                                echo "selected";
                                            }
                                        }
                                        ?> value="Search_only">Search only</option>
                             <option <?php
                                        if ($exist) {
                                            if ($resp[1][0]["Visibility"] == "None") {
                                                echo "selected";
                                            }
                                        }
                                        ?> value="None">None</option>
                         </select>
                     </div>
                     <?php
                        if ($_SESSION['SESSION_TYPE'] === "Admin") {
                        ?>
                         <div class="input_text_prptotype">
                             <p class="Input_title">Enable Edit</p>
                             <select name="eneable_edit" id="">
                                 <option <?php
                                            if ($exist) {
                                                if ($resp[1][0]["enable_edit"] == "Yes") {
                                                    echo "selected";
                                                }
                                            } else {
                                                echo "selected";
                                            }
                                            ?> value="Yes">Yes</option>
                                 <option <?php
                                            if ($exist) {
                                                if ($resp[1][0]["enable_edit"] == "No") {
                                                    echo "selected";
                                                }
                                            }
                                            ?> value="No">No</option>
                             </select>
                         </div>
                     <?php
                        }
                        ?>
                     <div class="conf_update">
                         <button onclick="update_product(template,quill,quill2)">
                             Update
                         </button>
                         <button>
                             Cancel
                         </button>
                     </div>
                 </div>
             </div>
             <?php
                if ($exist == true) {
                ?>

                 <div class="product_update">
                     <div class="elem_header_prod">
                         <div class="elem_name">Product Categories</div>
                         <div class="dropdown" onclick="openleftpan(250)" data-open=true><span class=""></span></div>
                     </div>
                     <div class="product_settings" id="prod_settings">

                         <?php

                            $fields = "*";

                            $table = "products_category_domain";

                            $ref = [
                                array("products_id", $resp[1][0]['ListOrder'])
                            ];

                            $type = "s";

                            $included_categories = $moderator->get_by_ref($fields, $table, $moderator->getConnection(), $ref, $type);

                            $selected_categories = array();



                            if ($included_categories[0] = true) {
                                foreach ($included_categories[1] as $value) {
                                    foreach ($value as $key => $val) {
                                        if ($key == "category_id") {
                                            array_push($selected_categories, $val);
                                        }
                                    }
                                }
                            }



                            $res = $moderator->getitemsbyref("None", "tbl_category", "cat_parent", $moderator->getConnection());


                            if ($res[0] == true) {
                                $max = count($res[1]);

                                for ($iter = 0; $iter < $max; $iter++) {



                            ?>
                                 <ul onclick="set_product_category()">
                                     <li>
                                         <div class="parent_category" data-id="<?php echo $res[1][$iter]['ListOrder']; ?>">
                                             <label class="c_container">
                                                 <input type="checkbox" <?php
                                                                        if (in_array($res[1][$iter]['ListOrder'], $selected_categories)) {
                                                                            echo "checked";
                                                                        }
                                                                        ?>>
                                                 <span class="checkmark"></span>
                                             </label>
                                             <p><?php echo $res[1][$iter]['cat_name'] ?> </p>
                                         </div>


                                         <?php
                                            //get name of parent
                                            $parent_name = $res[1][$iter]['cat_name'];

                                            $fields = "*";

                                            $table = "tbl_category";

                                            $ref = [
                                                array("cat_parent", $parent_name),
                                            ];

                                            $type = "s";

                                            $res1 = $moderator->get_by_ref($fields, $table, $moderator->getConnection(), $ref, $type);


                                            if ($res1[0] == true) {
                                                $max1 = count($res1[1]);
                                                for ($iter1 = 0; $iter1 < $max1; $iter1++) {

                                            ?>
                                                 <div class="child_category" data-id="<?php echo $res1[1][$iter1]['ListOrder']; ?>">
                                                     <label class="c_container">
                                                         <input type="checkbox" <?php
                                                                                if (in_array($res1[1][$iter1]['ListOrder'], $selected_categories)) {
                                                                                    echo "checked";
                                                                                }
                                                                                ?>>
                                                         <span class="checkmark"></span>
                                                     </label>
                                                     <p><?php echo $res1[1][$iter1]['cat_name'] ?></p>
                                                 </div>
                                         <?php
                                                }
                                            }
                                            ?>




                                     </li>
                                 </ul>
                         <?php
                                }
                            } else {
                                echo "No Category";
                            }

                            ?>

                     </div>
                 </div>

                 <div class="product_update">
                     <div class="elem_header_prod">
                         <div class="elem_name">Product Tags</div>
                         <div class="dropdown" onclick="openleftpan(250)" data-open=true><span class=""></span></div>
                     </div>
                     <div class="product_settings" id="prod_settings">
                         <div class="tag_entry">
                             <div class="search_tag_display">
                                 <!--  -->
                                 <input onkeyup="get_all_tags()" type="text" id="add_prod_tag" onblur="setTimeout(hide_tagselect, 1000)">
                                 <div class="tag_disp" id="tag_helper">
                                 </div>
                             </div>
                             <button onclick="add_tag()">Add</button>
                         </div>
                         <div class="tad_listing" id="tag_select">
                         </div>
                     </div>
                 </div>

                 <div class="product_update">
                     <div class="elem_header_prod">
                         <div class="elem_name">Product Image</div>
                         <div class="dropdown" onclick="openleftpan(250)" data-open=true><span class=""></span></div>
                     </div>
                     <div class="product_settings" id="prod_settings">
                         <div class="upload_image_elem">
                             <?php
                                $image = $moderator->getitemsbyref($myid, 'image_prod_domain', 'product_id', $moderator->getConnection());

                                if ($image[0] == false) {
                                ?>

                                 <div class="product_primary_image">
                                     <div class="imag_element_holder">
                                         <img id="showProdImg" src="" alt="">
                                     </div>
                                     <div id="update_overlay">
                                         <button>View</button>
                                         <button>Edit</button>
                                     </div>
                                 </div>

                                 <form enctype="multipart/form-data" action="#" class="select_file" onsubmit="send_file();event.preventDefault()">
                                     <input onchange="file_selected()" class="mediai" name="media[]" type="file" multiple />
                                     <input class="button" type="submit" alt="Upload" value="Upload" />
                                     <div class="progress_bar">
                                         <div class="progress">
                                             <div class="progress-bar bg-danger" style="width:0%"></div>
                                         </div>
                                     </div>
                                 </form>
                             <?php
                                } else {
                                    $img_obj = $moderator->getitemsbyref($image[1][0]['image_id'], 'tbl_image_db', 'UUID', $moderator->getConnection());
                                ?>
                                 <div class="product_primary_image" style="display:block">
                                     <div class="imag_element_holder">
                                         <img id="showProdImg" src="<?php echo $img_obj[1][0]['path_from_root'] ?>" alt="">
                                     </div>
                                     <div id="update_overlay">
                                         <button>View</button>
                                         <button>Edit</button>
                                     </div>
                                 </div>
                             <?php
                                }
                                ?>
                         </div>
                     </div>
                 </div>

                 <div class="product_update">
                     <div class="elem_header_prod">
                         <div class="elem_name">Product Gallery</div>
                         <div class="dropdown" onclick="openleftpan(250)" data-open=true><span class=""></span></div>
                     </div>
                     <div class="product_settings" id="prod_settings">

                     </div>
                 </div>
             <?php
                }
                ?>
         </div>
     </div>
 </div>