<?php
include "../res/src/php/modal.php";
passheader();
?>
<link rel="stylesheet" href="<?php echo ROOT; ?>/libs/css/main.css">
<script data-main="../libs/js/main" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>
<title>Document</title>
</head>

<body>
    <?php
    pass_menu();
    ?>

    <div class="spanner"></div>
    <div style="margin-bottom:10px;"></div>

    <div class=" container item_label">
        <p>Men Khaki Bale</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-lg-8 item_long_description">
                <div class="image_holder">
                    <img src="<?php echo PROD_IMAGES . "shoe.jpg" ?>" alt="">
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
                    <p class="light">Good condition</p>
                    <p class="dark">Average price</p>
                    <p class="light">Packed in 45Kg bag</p>
                    <p class="dark">Contains around 70 pieces</p>
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
    pass_footer()
    ?>
</body>