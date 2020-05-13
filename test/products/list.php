<?php
include "../res/src/php/modal.php";
passheader();
?>
<link rel="stylesheet" href="<?php echo ROOT; ?>/libs/css/main.css">
<script data-main="../libs/js/main" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Passion+One:wght@700&display=swap" rel="stylesheet">
<title>Document</title>
</head>

<body>
    <?php
    pass_menu();
    ?>

    <div class="spanner"></div>
    <div style="margin-bottom:10px;"></div>


    <div class=" container product_label">
        <h4>Male</h4>
    </div>
    <div class="container catalog products_categories">
        <div class="row">
            <?php

            $category = null;
            $Products_response = array();
            $simple_products_response = array();
            $bind_product = array();

            if (!isset($_GET['category'])) {
            ?>
                <div class="noItemsFound">
                    <p>SORRY!</p>
                    <p>We could not find any products matching your category.</p>
                    <p>You could try <a href="#">this</a> instead.</p>
                </div>
                <?php
            } else {
                $category = $_GET['category'];

                $fields = [
                    'ListOrder',
                    'path_from_root',
                    'productName',
                    'cardDescription'
                ];
                $table = "v_list_products";
                $ref = [
                    array('category_id', $_GET['category'])
                ];
                $type = "i";
                $User->__set('set_strict', true);

                $res = $User->get_by_ref($fields, $table, $ref, $type);

                if ($res[0] == true) {
                    foreach ($res[1] as $product) {
                        $id = $product['ListOrder'];
                        $name = $product['productName'];
                        $description = $product['cardDescription'];
                        $image = $product['path_from_root'];

                        if($image ==  null){
                            $image = PROD_IMAGES."default.png";
                        }
                ?>
                    <div class="col-sm col-md-4 col-lg-3 prod_card" id="<?php echo $id ?>">
                        <div class="product_cards">
                            <div class="img_el">
                                <img src="<?php echo $image?>" alt="">
                            </div>
                            <h6><?php echo $name ?></h6>
                            <p><?php echo $description ?></p>
                            <button>
                                View
                            </button>
                        </div>
                    </div>
                    <?php
                    }
                } else {
                    ?>
                    <div class="noItemsFound">
                        <p>SORRY!</p>
                        <p>We could not find any products matching your category.</p>
                        <p>You could try <a href="#">this</a> instead.</p>
                    </div>
            <?php
                }
            }
            ?>


            <?php

            ?>

        </div>
    </div>

    <?php
    pass_footer()
    ?>
</body>