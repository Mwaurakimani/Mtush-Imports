 <?php
    include_once '../../Php/modal.php';
    ?>

 <div class="action_description">
     Edit Attributes
 </div>
 <div class="search_cat">
     <div class="elem_wrapper">
         <button onclick="loadform('attributes','splashboard')">
             Add Attribute
         </button>
     </div>
     <div class="elem_wrapper">
         <select name="" id="mass_action_apply">
             <option value="">Delete</option>
             <option value="">Disable</option>
         </select>
         <button onclick="variance_mass_action('attribute')">Apply</button>
     </div>
     <div class="elem_wrapper">
         <input type="search" name="" id="" placeholder="Search category">
     </div>

 </div>
 <div id="left_cat_description">
     <p style="margin-bottom:25px">
         Product attributes can be managed here. To view more
         listing orders select from the dropdown options above
         the table.Please note, deleting the attribute will result
         in delition of accosiated values. Including child values.
         products will not be deleted but will lose accosiation to the
         attribute.
     </p>
     <div class="add_item_pannel">
         <h5>Add new category</h5>
         <p class="entry_title">Name</p>
         <input type="text" name="name">

         <p class="entry_title">Slug</p>
         <input type="text" name="slung">

         <p class="entry_title">Description</p>
         <textarea name="description" id="" cols="30" rows="10"></textarea>

         <button id="Add_variance" onclick="add_product_variance('adding_attributes')">
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
                 <th>description</th>

                 <th>Count</th>
             </tr>
         </thead>
         <tbody>
             <?php
                $fields = [
                    "UUID",
                    "att_name",
                    "att_description",
                ];

                $obj = $moderator->getselectitems('tbl_attributes', $fields, $moderator->getConnection());

                if (!$obj[0]) {
                } else {

                    $initializer = 0;
                    $max = count($obj[1]);
                    for ($initializer; $initializer < $max; $initializer++) {
                ?>
                     <tr data-id=<?php echo $obj[1][$initializer]['UUID']  ?> onclick="select_variance('attribute')" ondblclick="open_product_attribute('<?php echo $obj[1][$initializer]['UUID']  ?>')">
                         <td>
                             <label onclick=" event.stopPropagation();" class="c_container">
                                 <input type="checkbox" onchange="changing(event)">
                                 <span class="checkmark"></span>
                             </label>
                         </td>
                         <td><?php echo $obj[1][$initializer]['att_name'] ?></td>
                         <td><?php echo $obj[1][$initializer]['att_description'] ?></td>
                         <td>5</td>
                     </tr>


             <?php
                    }
                }
                ?>
         </tbody>
     </table>
 </div>