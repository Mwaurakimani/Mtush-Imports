<?php
include_once '../Php/modal.php';
?>

<?php
$exist = false;
$fields = [
    "UUID",
    "productName",
    "Product_type",
    "Status",
    "dateModified",
    "ListOrder"
];
$count = 0;
$active = $count;

$array_active = array();

$resp = $moderator->getselectitems("tbl_products", $fields, $moderator->getConnection());

if ($resp[0] == true) {


    $exist = true;

    $count = count($resp[1]);

    foreach ($resp[1] as $val) {
        foreach ($val as $key => $value) {
            if ($key == 'Status' && $value == 1) {
                array_push($array_active, 1);
            }
        }
    }

    $active = count($array_active);
} else {
?>
    <style>
        table {
            display: none;
        }
    </style>
<?php
}


?>
<div class="head_panel">
    <div class="bread_crums">
        <span>Catalogue</span>
    </div>
    <div style="margin-bottom:10px;" class="subnavigator">
        <div class="current">
            <p>Catalogue</p>
        </div>
        <div class="menucontrols">
            <div class="addNew" onclick="open_product('')">
                <img style="margin-top:-4px;margin-left:5px;" width="30px;" src="<?php echo SYS_IMAGES ?>addNew.png" alt="">
                <span style="padding-left:1px;font-weight:600;color:white;line-height:35px;">Add New</span>
            </div>
        </div>
    </div>
</div>
<div class="sub_menucontrol">
    <ul>
        <li><button onclick="renderContent('Catalog')">All Products</button></li>
        <li><button onclick="loadform('category','splashboard')">Categories</button></li>
        <li><button onclick="loadform('tags','splashboard')">Tags</button></li>
        <li><button onclick="loadform('attributes','splashboard')">Attributes</button></li>
    </ul>
</div>

<div class=" filter_pannel">
    <div class="top_pannel">
        <ul>
            <li><button>All <span>(<?php echo $count ?>)</span></button> </li>
            <li><button>Active <span>(<?php echo $active ?>)</span></button> </li>
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
        <div style="font-weight:600" class="cardtitle">
            Catalogue
        </div>
        <div class="salesListdash2">
            <?php
            if ($count > 0) {
            ?>
                <table class="table table-hover" id="products_tbl">
                    <thead>
                        <tr>
                            <th>
                                <label class="c_container">
                                    <input type="checkbox" onchange="checkall()">
                                    <span class="checkmark"></span>
                                </label>
                            </th>
                            <th>Images</th>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Date Modified</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < $count; $i++) {
                        ?>
                            <tr onclick="open_product('<?php echo $resp[1][$i]['UUID']; ?>')">
                                <td>
                                    <label class="c_container" onclick="event.stopPropagation()">
                                        <input type="checkbox" onchange="changing(event)">
                                        <span class="checkmark"></span>
                                    </label>
                                </td>
                                <td><img src="
                                    <?php
                                    //get list ID
                                    $id = $resp[1][$i]['ListOrder'];
                                    $image = $moderator->getitemsbyref($id, 'image_prod_domain', 'product_id', $moderator->getConnection());
                                    if($image[0] == true){
                                        $img_obj = $moderator->getitemsbyref($image[1][0]['image_id'], 'tbl_image_db', 'UUID', $moderator->getConnection());

                                        if ($image[0] == true) {
                                            echo $img_obj[1][0]['path_from_root'];
                                        } else {
                                            echo "http://test.local/res/images/productsImages/default.png";
                                        }
                                    }else{
                                        echo "http://test.local/res/images/productsImages/default.png";
                                    }
                                    ?>
                                " alt="">

                                </td>
                                <td><?php if ($exist) {
                                        echo $resp[1][$i]['productName'];
                                    } ?></td>
                                <td><?php if ($exist) {
                                        echo $resp[1][$i]['Product_type'];
                                    } ?></td>
                                <td><?php if ($exist) {
                                        echo $resp[1][$i]['dateModified'];
                                    } ?></td>
                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            <?php
            } else {
            ?>
                <div class="noVendors">
                    <img src="<?php echo SYS_IMAGES . "bale.png" ?>" alt="">
                    <br>
                    <br>
                    <p>No Products Found</p>
                    <button onclick="open_product('')">Add New</button>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>