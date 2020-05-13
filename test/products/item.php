<?php
include "../res/src/php/modal.php";
passheader();
?>
<link rel="stylesheet" href="<?php echo ROOT; ?>/libs/css/main.css">
<script data-main="../libs/js/main" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>

<link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@700&display=swap" rel="stylesheet">
<title>Document</title>
</head>

<body>
    <?php
    pass_menu();
    ?>

    <div class="spanner"></div>
    <div style="margin-bottom:10px;"></div>
    <?php
    $product = null;

    if (!isset($_GET['product'])) {
    ?>

        <?php
    } else {
        $fields = '*';
        $table = "v_show_product";
        $ref = [
            array('ListOrder', $_GET['product'])
        ];
        $type = "i";
        $User->__set('set_strict', true);

        $res = $User->get_by_ref($fields, $table, $ref, $type);

        if ($res[0] == false) {
        ?>
            <div class="container product_display_none">
                <div class="row">
                    <div class="noItemsFound">
                        <p>SORRY!</p>
                        <p>We could not find the product selected.</p>
                        <p>You could try <a href="#">this</a> instead.</p>
                    </div>
                </div>
            </div>
        <?php
        } else {
            $product = $res[1][0];

            $ID = $product['ListOrder'];
            $UUID = $product['ProductID'];

            $Name = $product['productName'];
            $image = $product['path_from_root'];
            $description = $product['Short_description'];

            $condition = $product['prod_condition'];
            $Price = $product['regular_price'];
            $PriceCategory = $product['price_cat'];
            $package = $product['package'];
            $Estimate = $product['estimated_count'];
        ?>
            <div class=" container item_label">
                <p><?php echo $Name ?></p>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-lg-8 item_long_description" id="<?php echo $ID ?>">
                        <div class="image_holder">
                            <img src="
                                <?php
                                if ($image == null) {
                                    $image =  $image = PROD_IMAGES . "default.png";
                                }
                                echo $image;
                                ?>
                                 " alt="">
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.
                            Quo rem sed molestiae, maiores sit sunt sequi error laborum
                            praesentium placeat blanditiis corrupti nam cumque illum,
                            deserunt fuga eum nihil impedit.
                        </p>
                    </div>
                    <div class="col-sm-12 col-md-4 col-lg-4 item_short_description">
                        <div class="stat_description">
                            <h5>Product Stats</h5>
                            <p class="light"><?php echo $condition ?></p>
                            <p class="dark"><?php echo $package ?></p>
                            <p class="light"><?php echo $Estimate ?></p>
                            <p class="dark"><?php echo $PriceCategory; ?></p>
                            <p class="light"><?php echo $Price ?></p>
                            <div class="btn_holder">
                                <button>
                                    Buy
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <?php
        }
    }
    ?>


    <?php
    pass_footer()
    ?>
</body>