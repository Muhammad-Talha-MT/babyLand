<div id="column-left" class="col-sm-4 col-md-4 col-lg-3 ">
  <div id="category-menu" class="navbar collapse mb_40 hidden-sm-down in" aria-expanded="true" role="button">
    <div class="nav-responsive">
      <ul class="nav  main-navigation collapse in ">
        <?php
        foreach ($category_list as $category) {
          if ($category->ParentCategoryId == 0) {
            ?>
            <li><a href="<?php echo base_url() . 'category/CategoryProduct/' . $category->Id; ?>"><?php echo $category->Name; ?></a></li>
          <?php }
        } ?>


      </ul>
    </div>
  </div>
  <div class="left_banner left-sidebar-widget mt_30 mb_50"> <a href="#"><img src="<?php echo base_url(); ?>/images/left-banner-img-1.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
  <div class="left-cms left-sidebar-widget mb_50">
    <ul>
      <li>
        <div class="feature-i-left ptb_40">
          <div class="icon-right Shipping"></div>
          <h6>Free Shipping</h6>
          <p>Free delivery worldwide</p>
        </div>
      </li>
      <li>
        <div class="feature-i-left ptb_40">
          <div class="icon-right Order"></div>
          <h6>Order Online</h6>
          <p>Hours : 8am - 11pm</p>
        </div>
      </li>
      <li>
        <div class="feature-i-left ptb_40">
          <div class="icon-right Save"></div>
          <h6>Shop And Save</h6>
          <p>For All Spices & Herbs</p>
        </div>
      </li>
      <li>
        <div class="feature-i-left ptb_40">
          <div class="icon-right Safe"></div>
          <h6>Safe Shoping</h6>
          <p>Ensure genuine 100%</p>
        </div>
      </li>
    </ul>
  </div>
  <div class="left-special left-sidebar-widget mb_50">
    <div class="heading-part mb_20 ">
      <h2 class="main_title">Top Products</h2>
    </div>
    <div id="left-special" class="owl-carousel">
      <ul class="row ">

        <?php
        $Counter = 0;
        foreach ($product_list as $product) {

          $pic = json_decode($product->Picture);
          ?>
          <li class="item product-layout-left mb_20">
            <div class="product-list col-xs-4">
              <div class="product-thumb">
                <div class="image product-imageblock"> <a href="product_detail_page.html"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="<?php echo base_url('upload/' . $pic[0]); ?>"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="<?php echo base_url('upload/' . $pic[0]); ?>"> </a> </div>
              </div>
            </div>
            <div class="col-xs-8">
              <div class="caption product-detail">
                <h6 class="product-name"><a href="#"><?php echo $product->Name; ?></a></h6>
                <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $product->Price; ?></span>
                </span>
              </div>
            </div>

          </li>
          <?php
          $Counter++;
          if ($Counter == 2) {
            echo '</ul><ul  class="row">';
            $Counter = 0;
          }
        } ?>


      </ul>

    </div>
  </div>
  <div class="left_banner left-sidebar-widget mb_50"> <a href="#"><img src="images/left-banner-img-01.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
  <div class="Testimonial left-sidebar-widget mb_50">
    <div class="heading-part mb_20 ">
      <h2 class="main_title">Testimonial</h2>
    </div>
    <div class="client owl-carousel text-center pt_10">
      <div class="item client-detail">
        <div class="client-avatar"> <img alt="" src="images/Agent-avatar-img-1.png"> </div>
        <div class="client-title  mt_30"><strong>joseph Lui</strong></div>
        <div class="client-designation mb_10">php Developer</div>
        <p><i class="fa fa-quote-left" aria-hidden="true"></i>Lorem ipsum dolor sit amet, volumus oporteat his at sea in Rem ipsum dolor sit amet, sea in odio ..</p>
      </div>
      <div class="item client-detail">
        <div class="client-avatar"> <img alt="" src="images/Agent-avatar-img-2.png"> </div>
        <div class="client-title  mt_30"><strong>joseph Lui</strong></div>
        <div class="client-designation mb_10">php Developer</div>
        <p><i class="fa fa-quote-left" aria-hidden="true"></i>Lorem ipsum dolor sit amet, volumus oporteat his at sea in Rem ipsum dolor sit amet, sea in odio ..</p>
      </div>
      <div class="item client-detail">
        <div class="client-avatar"> <img alt="" src="images/Agent-avatar-img-3.png"> </div>
        <div class="client-title  mt_30"><strong>joseph Lui</strong></div>
        <div class="client-designation mb_10">php Developer</div>
        <p><i class="fa fa-quote-left" aria-hidden="true"></i>Lorem ipsum dolor sit amet, volumus oporteat his at sea in Rem ipsum dolor sit amet, sea in odio ..</p>
      </div>
    </div>
  </div>
  <div class="Tags left-sidebar-widget mb_50">
    <div class="heading-part mb_20 ">
      <h2 class="main_title">Tags</h2>
    </div>
    <ul>
      <?php foreach ($tag_list as $tag) { ?>
        <li><a href="<?php echo base_url() . 'product/productbytags/' . $tag->Id; ?>"><?php echo $tag->Name; ?></a></li>
      <?php } ?>
    </ul>
  </div>
</div>