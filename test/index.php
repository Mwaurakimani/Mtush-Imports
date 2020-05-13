<?php
include "res/src/php/modal.php";
passheader();
?>
<link rel="stylesheet" href="libs/css/main.css">
<script data-main="libs/js/main" src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.3.6/require.min.js"></script>
<title>Document</title>
</head>

<body>
  <?php
  pass_menu();
  ?>
  <div class="mobile_banner">
    <div class="banner_frame">
      <h1>SECOND HAND CLOTHES DISTRIBUTORS</h1>
      <a href="">Make an Order</a>
      <a href="">View Products</a>
    </div>
  </div>
  <div class="container definer">
    <h4>About Us</h4>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta beatae natus, debitis libero eius placeat veniam, ut explicabo culpa perferendis iusto dicta deleniti necessitatibus enim sit magnam totam, voluptatum aspernatur.</p>
    <div class="row">
      <div class="col-sm about_us_cards">
        <div class="card_image" style="border-color: #E74C3C">
          <img src="<?php echo ICONS . "info.png" ?>" alt="">
        </div>
        <div class="card_description">
          <div style="border-color: #E74C3C">
            <h5>What we do</h5>
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
        </div>
      </div>
      <div class="col-sm about_us_cards">
        <div class="card_image" style="border-color: #3498DB">
          <img src="<?php echo ICONS . "trust.png" ?>" alt="">
        </div>
        <div class="card_description">
          <div style="border-color: #3498DB">
            <h5>Efficient</h5>
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
        </div>
      </div>
      <div class="col-sm about_us_cards">
        <div class="card_image" style="border-color: #E67E22">
          <img src="<?php echo ICONS . "trendy.png" ?>" alt="">
        </div>
        <div class="card_description">
          <div style="border-color: #E67E22">
            <h5>Trendy</h5>
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
        </div>
      </div>
      <div class="col-sm about_us_cards">
        <div class="card_image" style="border-color: #2ECC71">
          <img src="<?php echo ICONS . "afordable.png" ?>" alt="">
        </div>
        <div class="card_description">
          <div style="border-color: #2ECC71">
            <h5>Affordable</h5>
          </div>
          <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. </p>
        </div>
      </div>
    </div>
  </div>


  <div class="container catalog">
    <h4>Featured</h4>
    <div class="row" style="padding-top: 20px">
      <?php
      $count = 3;

      for ($i = 0; $i < $count; $i++) {
      ?>
        <div class="col-sm col-md-4 prod_card">
          <div class="product_cards">
            <div class="img_el">
              <img src="<?php echo PROD_IMAGES . "default.png" ?>" alt="">
            </div>
            <h6>PRODUCT NAME PRODUCT NAME PRODUCT NAME
              PRODUCT NAME
            </h6>
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

  <div class="container p-0  category">
    <h4>Reach Out</h4>
    <div class="row">
      <div class="col-md card_elem">
        <h5>Contact Form</h5>
        <form action="">
          <input type="text" placeholder="Name">
          <input type="Email" placeholder="Email">
          <textarea name="" id="" cols="30" rows="10" placeholder="Message"></textarea>
          <button type="submit">Submit</button>
        </form>
      </div>
      <div class="col-md card_elem">
        <a href="https://www.google.com/maps/place/Mtush+Imports/@-0.7027855,36.425071,16.5z/data=!4m5!3m4!1s0x182917a9501a42b5:0x6bba1f033836e37f!8m2!3d-0.7032291!4d36.4269514">
          <img src="<?php echo SYSTEM_IMAGES . "map.jpg" ?>" alt="">
        </a>
      </div>
    </div>
  </div>

  <?php
  pass_footer();
  ?>
</body>

</html>
