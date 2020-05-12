 <?php
    include_once '../../Php/modal.php';
    ?>

 <div class="action_description">
     Edit Tags
 </div>
 <div class="search_cat">
     <div class="elem_wrapper">
         <button onclick="loadform('tags','splashboard')">
             Add Tag
         </button>
     </div>
     <div class="elem_wrapper">
         <select name="" id="mass_action_apply">
             <option value="">Delete</option>
             <option value="">Disable</option>
         </select>
         <button onclick="variance_mass_action('tag')">Apply</button>
     </div>
     <div class="elem_wrapper">
         <input type="search" name="" id="" placeholder="Search category">
     </div>

 </div>
 <div id="left_cat_description">
     <p style="margin-bottom:25px">
         Product Tags for your store can be managed here.
         To change the order of categories on the front-end you
         can drag and drop to sort them. To see more categories
         listed click the "screen options" link at the top-right
         of this page.
     </p>
     <div class="add_item_pannel">
         <h5>Add new category</h5>
         <p class="entry_title">Name</p>
         <input type="text" name="name">

         <p class="entry_title">Slug</p>
         <input type="text" name="slung">

         <p class="entry_title">Description</p>
         <textarea name="description" id="" cols="30" rows="10"></textarea>

         <button id="Add_variance" onclick="add_product_variance('adding_tag')">
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
                    "tag_name",
                    "tag_description",
                ];

                $obj = $moderator->getselectitems('tbl_tags', $fields, $moderator->getConnection());

                if ($obj[0]) {
                    $initializer = 0;
                    $max = count($obj[1]);
                    for ($initializer; $initializer < $max; $initializer++) {
                ?>
                     <tr data-id=<?php echo $obj[1][$initializer]['UUID']  ?> onclick="select_variance('tag')">
                         <td>
                             <label onclick="event.stopPropagation();" class=" c_container">
                                 <input type="checkbox" onchange="changing(event)">
                                 <span class="checkmark"></span>
                             </label>
                         </td>
                         <td><?php echo $obj[1][$initializer]['tag_name'] ?></td>
                         <td><?php echo $obj[1][$initializer]['tag_description'] ?></td>
                         <td>5</td>
                     </tr>


             <?php
                    }
                }
                ?>
         </tbody>
     </table>
 </div>