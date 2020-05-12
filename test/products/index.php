<?php
include "../res/src/php/modal.php";
passheader();
?>
<link rel="stylesheet" href="<?php echo ROOT; ?>/libs/css/main.css">
<script data-main="../libs/js/main" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>
<meta http-equiv="refresh" content="3">
<title>Document</title>
</head>

<body>
    <?php
    pass_menu();
    ?>
    <div class="spanner"></div>
    <div style="margin-bottom:10px;"></div>

    <div class=" container product_label">
        <h4>Products Categories</h4>
    </div>
    <div class="container catalog products_categories">
        <div class="row">
            <div class="col-sm col-md-4 prod_card">
                <div class="product_cards">
                    <div class="img_el">
                        <img src="<?php echo SYSTEM_IMAGES . "male.jpg" ?>" alt="">
                    </div>
                    <h6>Male</h6>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, aspernatur cumque voluptate architecto deserunt commodi vitae Fuga amet dignissimos vel quo!</p>
                    <button>
                        View
                    </button>
                </div>
            </div>
            <div class="col-sm col-md-4 prod_card">
                <div class="product_cards">
                    <div class="img_el">
                        <img src="<?php echo SYSTEM_IMAGES . "ladies.jpg" ?>" alt="">
                    </div>
                    <h6>Female</h6>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, aspernatur cumque voluptate architecto deserunt commodi vitae Fuga amet dignissimos vel quo!</p>
                    <button>
                        View
                    </button>
                </div>
            </div>
            <div class="col-sm col-md-4 prod_card">
                <div class="product_cards">
                    <div class="img_el">
                        <img src="<?php echo SYSTEM_IMAGES . "kids.jpg" ?>" alt="">
                    </div>
                    <h6>Kids</h6>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, aspernatur cumque voluptate architecto deserunt commodi vitae Fuga amet dignissimos vel quo!</p>
                    <button>
                        View
                    </button>
                </div>
            </div>
            <div class="col-sm col-md-4 prod_card">
                <div class="product_cards">
                    <div class="img_el">
                        <img src="<?php echo SYSTEM_IMAGES . "duvet.jfif" ?>" alt="">
                    </div>
                    <h6>House Hold</h6>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, aspernatur cumque voluptate architecto deserunt commodi vitae Fuga amet dignissimos vel quo!</p>
                    <button>
                        View
                    </button>
                </div>
            </div>
            <div class="col-sm col-md-4 prod_card">
                <div class="product_cards">
                    <div class="img_el">
                        <img src="<?php echo SYSTEM_IMAGES . "shoes.jpg" ?>" alt="">
                    </div>
                    <h6>House Hold</h6>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, aspernatur cumque voluptate architecto deserunt commodi vitae Fuga amet dignissimos vel quo!</p>
                    <button>
                        View
                    </button>
                </div>
            </div>
            <div class="col-sm col-md-4 prod_card">
                <div class="product_cards">
                    <div class="img_el">
                        <img src="<?php echo SYSTEM_IMAGES . "accesories.jpg" ?>" alt="">
                    </div>
                    <h6>House Hold</h6>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, aspernatur cumque voluptate architecto deserunt commodi vitae Fuga amet dignissimos vel quo!</p>
                    <button>
                        View
                    </button>
                </div>
            </div>
            <div class="col-12 show_all">
            <button>View All</button>
            </div>
        </div>
    </div>


    <div class=" container product_label">
        <h4>Popular</h4>
    </div>
    <div class="container catalog products_categories">
        <div class="row">
            <?php
            $count = 6;

            for ($i = 0; $i < $count; $i++) {
            ?>
                <div class="col-sm col-md-4 prod_card">
                    <div class="product_cards">
                        <div class="img_el">
                            <img src="<?php echo PROD_IMAGES . "default.png" ?>" alt="">
                        </div>
                        <h6>Male</h6>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, aspernatur cumque voluptate architecto deserunt commodi vitae Fuga amet dignissimos vel quo!</p>
                        <button>
                            View
                        </button>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>

    <?php
      pass_footer();
    ?>
</body>