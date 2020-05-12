 <?php
    include_once '../../Php/modal.php';
    ?>

 <div class="action_description">
     Product
     <?php
        $obj = $moderator->getitemsbyref($_SESSION["ATT_ID"], "tbl_attributes", "UUID", $moderator->getConnection());
        if ($obj[0] == true) {
            echo " " . $obj[1][0]['att_name'];
        }
        ?>
 </div>
 <div class="search_cat">
     <div class="elem_wrapper">
         <button onclick="add_this_value('product_attributes')">
             Add Value
         </button>
     </div>
     <div class="elem_wrapper">
         <select name="" id="mass_action_apply">
             <option value="">Delete</option>
             <option value="">Disable</option>
         </select>
         <button onclick="variance_mass_action('attribute_val')">Apply</button>
     </div>
     <div class="elem_wrapper">
         <input type="search" name="" id="" placeholder="Search category">
     </div>

 </div>
 <div id="left_cat_description">
     <p style="margin-bottom:25px">
         Add attribute variations here.Note if an attribute value is deleted
         ,it will be removed from all the associated products.Adding it again
         will not reassign all related products.
     </p>
     <div class="add_item_pannel">
         <h5>Add new category</h5>
         <p class="entry_title">Name</p>
         <input type="text" name="name">

         <p class="entry_title">Value</p>
         <input type="text" name="slung">

         <p class="entry_title">Description</p>
         <textarea name="description" id="" cols="30" rows="10"></textarea>

         <button id="Add_variance" onclick="add_product_variance('adding_attributes_val')">
             Add
         </button>

     </div>
 </div>
 <div id="right_cat_description">
     <table class="table table-hover" id="tag_tbl" style="display:block">
         <thead>
             <tr>
                 <th>
                     <label class="c_container">
                         <input type="checkbox" onchange="checkall()">
                         <span class="checkmark"></span>
                     </label>
                 </th>
                 <th>Name</th>
                 <th>value</th>

                 <th>Count</th>
             </tr>
         </thead>
         <tbody>
             <?php
                $fields = [
                    "UUID",
                    "value_name",
                    "value_slung",
                ];

                $obj = $moderator->getrelatedattributevalues('tbl_attributes_values', $fields, $moderator->getConnection());

                if (!$obj[0]) {
                    echo "-";
                } else {

                    $initializer = 0;
                    $max = count($obj[1]);
                    for ($initializer; $initializer < $max; $initializer++) {
                ?>
                     <tr data-id=<?php echo $obj[1][$initializer]['UUID']  ?> onclick="select_variance('attribute_val')">
                         <td>
                             <label onclick=" event.stopPropagation();" class="c_container">
                                 <input type="checkbox" onchange="changing(event)">
                                 <span class="checkmark"></span>
                             </label>
                         </td>
                         <td><?php echo $obj[1][$initializer]['value_name'] ?></td>
                         <td><?php echo $obj[1][$initializer]['value_slung'] ?></td>
                         <td>5</td>
                     </tr>


             <?php
                    }
                }
                ?>
         </tbody>
     </table>
 </div>