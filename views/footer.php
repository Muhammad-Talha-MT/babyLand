<div class="footer pt_60">
  <div class="container">
    <div class="row">
      <div class="col-md-3 footer-block">
        <div class="content_footercms_right">
          <div class="footer-contact">
            <div class="footer-logo mb_40"> <a href="index.html">
                <h1><?php echo $setting_list->bannerName; ?></h1>
              </a> </div>
            <ul>
              <li><?php echo $setting_list->address; ?></li>
              <li><?php echo $setting_list->contact; ?></li>
              <li><?php echo $setting_list->email; ?></li>
            </ul>
            <div class="social_icon">
              <ul>
                <li><a href="<?php echo $setting_list->facebook; ?>"><i class="fa fa-facebook"></i></a></li>
                <li><a href<?php echo $setting_list->email; ?>i class="fa fa-google"></i></a></li>
                <li><a href="<?php echo $setting_list->linkedin; ?>"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="<?php ?>"><i class="fa fa-twitter"></i></a></li>
                <li><a href="<?php echo $setting_list->facebook; ?>"><i class="fa fa-rss"></i></a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-2 footer-block">
        <h6 class="footer-title ptb_20">Categories</h6>
        <ul>
          <?php
          $count = 0;
          foreach ($category_list as $category) {
            if ($category->ParentCategoryId == 0 && $count < 7) {
              ?>
              <li><a href="<?php echo base_url() . 'category/CategoryProduct/' . $category->Id; ?>"><?php echo $category->Name; ?></a></li>
              <?php $count++;
            }
          } ?>


        </ul>
      </div>
      <div class="col-md-2 footer-block">
        <h6 class="footer-title ptb_20">Information</h6>
        <ul>
          <li><a href="<?php echo base_url(); ?>Page/contactus">Contact Us</a></li>
          <?php foreach ($page_list as $page) { ?>
            <li><a href="<?php echo base_url(); ?>Page/showpage/<?php echo $page->id; ?>"><?php echo $page->title ?></a></li>
          <?php } ?>

        </ul>
      </div>
      <div class="col-md-2 footer-block">
        <h6 class="footer-title ptb_20">My Account</h6>
        <ul>
          <li><a href="#">Checkout</a></li>
          <li><a href="<?php
                        if (isset($_SESSION['userid'])) {
                          echo base_url() . 'customer/showprofile/' . $_SESSION['userid'];
                        }
                        ?>">
              My Account</a></li>
          <li><a href="<?php
                        if (isset($_SESSION['userid'])) {
                          echo base_url() . 'customer/myorder/' . $_SESSION['userid'];
                        }
                        ?>">My Orders</a></li>
          <li><a href="#">My Credit Slips</a></li>
          <li><a href="#">My Addresses</a></li>
          <li><a href="<?php
                        if (isset($_SESSION['userid'])) {
                          echo base_url() . 'customer/showprofile/' . $_SESSION['userid'];
                        }
                        ?>">My Personal Info</a></li>
        </ul>
      </div>
      <div class="col-md-3">
        <h6 class="ptb_20">SIGN UP OUR NEWSLETTER</h6>
        <p class="mt_10 mb_20">For get offers from our favorite brands & get 20% off for next </p>
        <div class="form-group">
          <input class="mb_20" type="text" placeholder="Enter Your Email Address">
          <button class="btn">Subscribe</button>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom mt_60 ptb_10">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <div class="copyright-part">@ 2019 All Rights Reserved Baby Land</div>
        </div>
        <div class="col-sm-6">
          <div class="payment-icon text-right">
            <ul>
              <li><i class="fa fa-cc-paypal "></i></li>
              <li><i class="fa fa-cc-stripe"></i></li>
              <li><i class="fa fa-cc-visa"></i></li>
              <li><i class="fa fa-cc-discover"></i></li>
              <li><i class="fa fa-cc-mastercard"></i></li>
              <li><i class="fa fa-cc-amex"></i></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>