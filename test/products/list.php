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


    <div class=" container product_label">
        <h4>Male</h4>
    </div>
    <div class="container catalog products_categories">
        <div class="row">
            <?php
                if(isset($_GET['id'])){
                    echo $_GET['id'];
                }else{
                    echo "No ID";
                }
                $products_exist = false;
                $fields = '*';
                $table = "product_category_domain";
                $ref = [
                    array('category_id',$_GET['id'])
                ];
                $type ="s";
                $User->__set('set_strict', true);

                $res = $User->get_by_ref($fields, $table,$ref,$type);

                if ($res[0] == true) {
                    $categories_exist = true;
                    
                }
            ?>
                <div class="col-sm col-md-4 col-lg-3 prod_card">
                    <div class="product_cards">
                        <div class="img_el">
                            <img src="<?php echo PROD_IMAGES . "shoe.jpg" ?>" alt="">
                        </div>
                        <h6>Male</h6>
                        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Accusamus, aspernatur cumque voluptate architecto deserunt commodi vitae Fuga amet dignissimos vel quo!</p>
                        <button>
                            View
                        </button>
                    </div>
                </div>
            <?php
              
            ?>
        </div>
    </div>

    <?php
    pass_footer()
    ?>
</body>