<?php
require_once 'modal.php';

function passheader()
{
?>
  <!DOCTYPE html>
  <html lang="en" dir="ltr">

  <head>

    <meta http-equiv="refresh" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="HandheldFriendly" content="true">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital@1&display=swap" rel="stylesheet">
  <?php
}

function pass_menu()
{
  ?>
    <noscript>
      <p>Javascript is needed to run this site correctly</p>
    </noscript>
    <div class="desktop_nav"></div>
    <div class="mobile_nav">
      <div class="mobile_log">
        <img src="<?php echo SYSTEM_IMAGES . "Logo.png" ?>" alt="">
      </div>
      <div class="menu_burger" onclick="toggle_menu()">
        <ul>
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </div>
      <nav>
        <ul>
          <li><a href="<?php echo ROOT ?>">Home</a></li>
          <li><a href="<?php echo ROOT . '/products' ?>">Products</a></li>
          <li><a href="<?php echo ROOT . '' ?>">How to Order</a></li>
          <li><a href="<?php echo ROOT . '' ?>">About Us</a></li>
          <li><a href="<?php echo ROOT . '' ?>">Contact Us</a></li>
          <li><a href="<?php echo ROOT . '' ?>">FAQs</a></li>
        </ul>
      </nav>
    </div>
    <div class="menu_panel" onclick="toggle_menu()">
      <div class="menu_items">
        <ul>
          <li style="margin-left:0px;"><a href="">Home</a></li>
          <li><a href="<?php echo ROOT . '' ?>">Products</a></li>
          <li><a href="<?php echo ROOT . '' ?>">How to Order</a></li>
          <li><a href="<?php echo ROOT . '' ?>">About Us</a></li>
          <li><a href="<?php echo ROOT . '' ?>">Contact Us</a></li>
          <li><a href="<?php echo ROOT . '' ?>">FAQs</a></li>
        </ul>
      </div>
    </div>
  <?php

}

function pass_footer()
{
  ?>
    <footer>
      <div class="mobile_footer">
        <div class="footer_log">
          <img src="<?php echo SYSTEM_IMAGES . 'Logo.png'; ?> " alt="">
        </div>

        <div class="nav_elem">
          <ul>
            <li><a href="">Home</a></li>
            <li><a href="">Products</a></li>
            <li><a href="">How to Order</a></li>
            <li><a href="">About Us</a></li>
            <li><a href="">Contact</a></li>
            <li><a href="">FAQs</a></li>
          </ul>
        </div>

        <div class="socila_media">
          <ul>
            <li><a href=""><img src="<?php echo ICONS . 'fb_icon.png'  ?>" alt=""></a></li>
            <li><a href=""><img src="<?php echo ICONS . 'ig_icon.png'  ?>" alt=""></a></li>
            <li><a href=""><img src="<?php echo ICONS . 'twitter_icon.png'  ?>" alt=""></a></li>
            <li><a href=""><img src="<?php echo ICONS . 'linked_in.png'  ?>" alt=""></a></li>
          </ul>
        </div>

        <div class="news_letter">
          <p>Get all the latest news,tips and updates From Mtush Imports</p>
          <form action="">
            <input type="Email">
            <button type="submit">Sign Up</button>
          </form>
        </div>
      </div>
      <div class="container-fluid desktop_footer">
        <div class="row">
          <div class="col-md-5 col-lg-4">
            <div class="footer_section">
              <div class="footer_log">
                <img src="<?php echo SYSTEM_IMAGES . 'Logo.png'; ?> " alt="">
              </div>
              <p style="padding: 0px 30px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde dolores quas cupiditate adipisci consequuntur, aliquam quod repellat corrupti. Consectetur, eaque placeat et ad nemo maxime fugit libero optio earum rem!</p>
              <div class="news_letter">
                <form action="">
                  <input type="Email">
                  <button type="submit">Sign Up</button>
                </form>
              </div>
              <div class="socila_media">
                <ul>
                  <li><a href=""><img src="<?php echo ICONS . 'fb_icon.png'  ?>" alt=""></a></li>
                  <li><a href=""><img src="<?php echo ICONS . 'ig_icon.png'  ?>" alt=""></a></li>
                  <li><a href=""><img src="<?php echo ICONS . 'twitter_icon.png'  ?>" alt=""></a></li>
                  <li><a href=""><img src="<?php echo ICONS . 'linked_in.png'  ?>" alt=""></a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-4 col-lg-3">
            <div class="footer_section">
              <h5>About Us?</h5>
              <p style="padding: 0px 10px">Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde dolores quas cupiditate adipisci consequuntur, aliquam quod repellat corrupti. Consectetur, eaque placeat et ad nemo maxime fugit libero optio earum rem!</p>

              <h5>Contact</h5>
              <ul>
                <li style="list-style: disc">support (+254) 792 783 603</li>
                <li style="list-style: disc">info@mtushimports.com</li>
                <br>
                <li style="list-style: disc">Moi South Lake Road</li>
                <li>Naivasha</li>


              </ul>
            </div>
          </div>
          <div class="col-md-3 col-lg-2">
            <div class="footer_section">
              <h5>Navigation</h5>
              <div class="nav_elem">
                <ul>
                  <li><a href="">Home</a></li>
                  <li><a href="">Products</a></li>
                  <li><a href="">How to Order</a></li>
                  <li><a href="">About Us</a></li>
                  <li><a href="">Contact</a></li>
                  <li><a href="">FAQs</a></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-0 col-lg-3">
            <div class="footer_section">
              <h5>Categories</h5>
              <div class="cat_disp">
                <ul>
                  <li>
                    <a href="">
                      <div class="img_cat_holder">
                        <img src="<?php echo SYSTEM_IMAGES . 'male.jpg' ?>" alt="">
                      </div>
                      <span>Men</span>
                    </a>
                  </li>
                  <li>
                    <a href="">
                      <div class="img_cat_holder">
                        <img src="<?php echo SYSTEM_IMAGES . 'ladies.jpg' ?>" alt="">
                      </div>
                      <span>Ladies</span>
                    </a>
                  </li>
                  <li>
                    <a href="">
                      <div class="img_cat_holder">
                        <img src="<?php echo SYSTEM_IMAGES . 'kids.jpg' ?>" alt="">
                      </div>
                      <span>Kids</span>
                    </a>
                  </li>
                  <li>
                    <a href="">
                      <div class="img_cat_holder">
                        <img src="<?php echo SYSTEM_IMAGES . 'duvet.jfif' ?>" alt="">
                      </div>
                      <span>House hold</span>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="copy_rights">
        <p> &copy; <?php echo (date("Y")) ?> <span> Mtush Imports </span></p>
      </div>
    </footer>
  <?php
}
