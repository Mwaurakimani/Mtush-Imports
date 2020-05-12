 <?php
    include_once '../../Php/modal.php';
    ?>

 <div class="action_description">
     Edit Category
 </div>
 <div class="search_cat">
     <div class="elem_wrapper">
         <button onclick="loadform('category','splashboard')">
             Add Category
         </button>
     </div>

     <div class="elem_wrapper">
         <select name="" id="mass_action_apply">
             <option value="">Delete</option>
             <option value="">Disable</option>
         </select>
         <button onclick="variance_mass_action('Category')">Apply</button>
     </div>
     <div class="elem_wrapper">
         <input type="search" name="" id="" placeholder="Search category">
     </div>

 </div>
 <div id="left_cat_description">
     <p style="margin-bottom:25px">Product categories for your store can be managed here.The
        Default category should not be deleted. All products without an assigned category will 
        be assigned the default category.
    </p>
     <div class="add_item_pannel">
         <h5>Add new category</h5>
         <p class="entry_title">Name</p>
         <input type="text" placeholder="Should not be empty" name="name">

         <p class="entry_title">Slug</p>
         <input type="text" placeholder="Add space to leave empty" name="slung">

         <p class="entry_title">Parent</p>
         <select name="" id="category_parent" name="category_parent">
             
         </select>
         <p class="entry_title">Description</p>
         <textarea name="description" id="" cols="30" rows="10"></textarea>

         <button id="Add_variance" onclick="add_product_variance('adding_category')">
             Add
         </button>

     </div>
 </div>
 <div id="right_cat_description">
     <table class="table table-hover" id="category_tbl">
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
                 <th>Parent</th>
                 <th>Count</th>
             </tr>
         </thead>
         <tbody>
             <?php
                $fields = [
                    "UUID",
                    "cat_name",
                    "cat_description",
                    "cat_parent"
                ];

                $obj = $moderator->getselectitems('tbl_category', $fields, $moderator->getConnection());

                if (!$obj[0]) {
                    echo "-";
                } else {

                    $initializer = 0;
                    $max = count($obj[1]);
                    for ($initializer; $initializer < $max; $initializer++) {
                ?>
                     <tr data-id=<?php echo $obj[1][$initializer]['UUID']  ?> onclick="select_variance('category')">
                         <td>
                             <label onclick="event.stopPropagation();" class="c_container">
                                 <input type="checkbox" onchange="changing(event)">
                                 <span class="checkmark"></span>
                             </label>
                         </td>
                         <td><?php echo $obj[1][$initializer]['cat_name'] ?></td>
                         <td><?php echo $obj[1][$initializer]['cat_description'] ?></td>
                         <td><?php
                                $string = "none";
                                if ($string == $obj[1][$initializer]['cat_parent']) {
                                    echo " ";
                                } else {
                                    echo $obj[1][$initializer]['cat_parent'];
                                }

                                ?></td>
                         <td>5</td>
                     </tr>


             <?php
                    }
                }
                ?>
         </tbody>
     </table>
 </div>