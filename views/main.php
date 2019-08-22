<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<?php require("head.php"); ?>

<body>
  <!-- =====  LODER  ===== -->
  <div class="loder"></div>
  <div class="wrapper">
    <?php require("subscribeme.php"); ?>
    <!-- =====  HEADER START  ===== -->
    <?php require("header.php"); ?>
    <!-- =====  HEADER END  ===== -->
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <div class="row ">
        <?php require("left.php"); ?>
        <div id="column-right" class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
          <div class="banner">
            <div class="main-banner owl-carousel">
              <div class="item"><a href="#"><img src="images/Baby_Gear_Banner.jpg" alt="Main Banner" class="img-responsive" /></a></div>
              <div class="item"><a href="#"><img src="images/Toys_For_Girls_1.jpg" alt="Main Banner" class="img-responsive" /></a></div>
            </div>
          </div>
          <!-- =====  BANNER END  ===== -->
          <!-- =====  SUB BANNER  STRAT ===== -->
          <div class="row">
            <div class="cms_banner mt_10">
              <div class="col-xs-6 col-sm-12 col-md-6 mt_20">
                <div id="subbanner1" class="sub-hover"> <a href="#"><img src="images/Toys_For_Girls.jpg" alt="Sub Banner1" class="img-responsive"></a>
                  <div class="bannertext">
                    <h2>Full HD Camera</h2>
                    <p class="mt_10">Different Resolutions</p>
                  </div>
                </div>
              </div>
              <div class="col-xs-6 col-sm-12 col-md-6 mt_20">
                <div id="subbanner2" class="sub-hover"> <a href="#"><img src="images/Toys_For_Boys.jpg" alt="Sub Banner2" class="img-responsive"></a>
                  <div class="bannertext">
                    <h2>smart watches</h2>
                    <p class="mt_10">Most Popular Brands</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- =====  SUB BANNER END  ===== -->
          <!-- =====  PRODUCT TAB  ===== -->
          <div id="product-tab" class="mt_40">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">TOYS</h2>
            </div>
            <ul class="nav text-right">
              <li class="active"> <a href="#nArrivals" data-toggle="tab">New Arrivals</a> </li>
              <li><a href="#Bestsellers" data-toggle="tab">Bestsellers</a> </li>
              <li><a href="#Featured" data-toggle="tab">Featured</a> </li>
            </ul>
            <div class="tab-content clearfix box">
              <?php
              if (isset($_SESSION['cartAdded'])) {
                echo "<div class='alert alert-success'>" . $_SESSION['cartAdded'] . "</div>";
              }
              ?>
              <div class="tab-pane active" id="nArrivals">
                <div class="nArrivals owl-carousel">

                  <div class="product-grid">
                    <?php
                    $Counter = 0;
                    foreach ($product_list as $product) {
                      $pic = json_decode($product->Picture);
                      ?>

                      <div class="item">
                        <div class="product-thumb mb_30">

                          <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                          <div class="caption product-detail text-left">
                            <h6 data-name="product_name" class="product-name mt_20"><a href="<?php echo base_url() . 'product/productdetail' ?>" title="Casual Shirt With Ruffle Hem"><?php echo $product->Name; ?></a></h6>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                            <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $product->Price; ?></span>
                            </span>
                            <div class="button-group text-center">
                              <a href="#" id="wishlist">
                                <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                                        echo $_SESSION['userid'];
                                                                                      } ?>">
                                <input type="hidden" name="productid" id="productid" value="<?php if (isset($product->Id)) {
                                                                                              echo $product->Id;
                                                                                            } ?>">
                                <div class="wishlist"><span>wishlist</span>
                                </div>
                              </a>
                              <a href="#">
                                <div class="quickview"><span>Quick View</span></div>
                              </a>
                              <a href="#">
                                <div class="compare"><span>Compare</span>
                                </div>
                              </a>
                              <a href="<?php echo base_url() . 'cart/addCart/' . $product->Id ?>">
                                <div class="add-to-cart"><span>Add to cart</span></div>
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>

                      <?php
                      $Counter++;
                      if ($Counter == 2) {
                        echo '</div><div class="product-grid">';
                        $Counter = 0;
                      }
                    } ?>
                  </div>

                </div>

              </div>
              <div class="tab-pane" id="Bestsellers">
                <div class="Bestsellers owl-carousel">
                  <div class="product-grid">
                    <?php
                    $Counter = 0;
                    foreach ($product_list as $product) {
                      if ($product->BestSeller) {
                        $pic = json_decode($product->Picture);
                        ?>

                        <div class="item">
                          <div class="product-thumb mb_30">

                            <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                            <div class="caption product-detail text-left">
                              <h6 data-name="product_name" class="product-name mt_20"><a href="<?php echo base_url() . 'product/productdetail' ?>" title="Casual Shirt With Ruffle Hem"><?php echo $product->Name; ?></a></h6>
                              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                              <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $product->Price; ?></span>
                              </span>
                              <div class="button-group text-center">
                                <a href="#" id="wishlist">
                                  <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                                          echo $_SESSION['userid'];
                                                                                        } ?>">
                                  <input type="hidden" name="productid" id="productid" value="<?php if (isset($product->Id)) {
                                                                                                echo $product->Id;
                                                                                              } ?>">
                                  <div class="wishlist"><span>wishlist</span>
                                  </div>
                                </a>
                                <a href="#">
                                  <div class="quickview"><span>Quick View</span></div>
                                </a>
                                <a href="#">
                                  <div class="compare"><span>Compare</span>
                                  </div>
                                </a>
                                <a href="<?php echo base_url() . 'cart/addCart/' . $product->Id ?>">
                                  <div class="add-to-cart"><span>Add to cart</span></div>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <?php
                        $Counter++;
                        if ($Counter == 2) {
                          echo '</div><div class="product-grid">';
                          $Counter = 0;
                        }
                      }
                    } ?>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="Featured">
                <div class="Featured owl-carousel">
                  <div class="product-grid">
                    <?php
                    $Counter = 0;
                    foreach ($product_list as $product) {
                      if ($product->Featured) {
                        $pic = json_decode($product->Picture);
                        ?>

                        <div class="item">
                          <div class="product-thumb mb_30">

                            <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                            <div class="caption product-detail text-left">
                              <h6 data-name="product_name" class="product-name mt_20"><a href="<?php echo base_url() . 'product/productdetail' ?>" title="Casual Shirt With Ruffle Hem"><?php echo $product->Name; ?></a></h6>
                              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                              <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $product->Price; ?></span>
                              </span>
                              <div class="button-group text-center">
                                <a href="#" id="wishlist">
                                  <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                                          echo $_SESSION['userid'];
                                                                                        } ?>">
                                  <input type="hidden" name="productid" id="productid" value="<?php if (isset($product->Id)) {
                                                                                                echo $product->Id;
                                                                                              } ?>">
                                  <div class="wishlist"><span>wishlist</span>
                                  </div>
                                </a>
                                <a href="#">
                                  <div class="quickview"><span>Quick View</span></div>
                                </a>
                                <a href="#">
                                  <div class="compare"><span>Compare</span>
                                  </div>
                                </a>
                                <a href="<?php echo base_url() . 'cart/addCart/' . $product->Id ?>">
                                  <div class="add-to-cart"><span>Add to cart</span></div>
                                </a>
                              </div>
                            </div>
                          </div>
                        </div>

                        <?php
                        $Counter++;
                        if ($Counter == 2) {
                          echo '</div><div class="product-grid">';
                          $Counter = 0;
                        }
                      }
                    } ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- =====  PRODUCT TAB  END ===== -->
          <!-- =====  SUB BANNER  STRAT ===== -->
          <!-- <div class="row">
            <div class="cms_banner mt_40 mb_50">
              <div class="col-xs-12">
                <div id="subbanner3" class="banner sub-hover"> <a href="#"><img src="images/sub-img-3-ducks.jpg" alt="Sub Banner3" class="img-responsive"></a> </div>
              </div>
            </div>
          </div> -->
          <!-- =====  SUB BANNER END  ===== -->
          <!-- =====  sale product  ===== -->
          <div id="sale-product">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">TOYS</h2>
            </div>
            <div class="Specials owl-carousel">
              <div class="item product-layout product-list">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="images/teddybear.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="images/teedy-img-1.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
                    <p class="product-desc mt_20"> More room to move. With 80GB or 160GB of storage and up to 40 hours of battery life, the new iPod classic lets you enjoy up to 40,000 songs or up to 200 hours of video or any combination wherever you go.Cover Flow. Browse through your music collection by flipping..</p>
                    <div class="timer mt_80">
                      <div class="days"></div>
                      <div class="hours"></div>
                      <div class="minutes"></div>
                      <div class="seconds"></div>
                    </div>
                    <div class="button-group text-center">
                      <div class="wishlist"><a href="#"><span>wishlist</span></a></div>
                      <div class="quickview"><a href="#"><span>Quick View</span></a></div>
                      <div class="compare"><a href="#"><span>Compare</span></a></div>
                      <div class="add-to-cart"><a href="#"><span>Add to cart</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item product-layout product-list">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="images/fish-img-01.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="images/fish-img-1.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
                    <p class="product-desc mt_20"> More room to move. With 80GB or 160GB of storage and up to 40 hours of battery life, the new iPod classic lets you enjoy up to 40,000 songs or up to 200 hours of video or any combination wherever you go.Cover Flow. Browse through your music collection by flipping..</p>
                    <div class="timer mt_80">
                      <div class="days"></div>
                      <div class="hours"></div>
                      <div class="minutes"></div>
                      <div class="seconds"></div>
                    </div>
                    <div class="button-group text-center">
                      <div class="wishlist"><a href="#"><span>wishlist</span></a></div>
                      <div class="quickview"><a href="#"><span>Quick View</span></a></div>
                      <div class="compare"><a href="#"><span>Compare</span></a></div>
                      <div class="add-to-cart"><a href="#"><span>Add to cart</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item product-layout product-list">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="images/elephant-img-01.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="images/elephant-img-1.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
                    <p class="product-desc mt_20"> More room to move. With 80GB or 160GB of storage and up to 40 hours of battery life, the new iPod classic lets you enjoy up to 40,000 songs or up to 200 hours of video or any combination wherever you go.Cover Flow. Browse through your music collection by flipping..</p>
                    <div class="timer mt_80">
                      <div class="days"></div>
                      <div class="hours"></div>
                      <div class="minutes"></div>
                      <div class="seconds"></div>
                    </div>
                    <div class="button-group text-center">
                      <div class="wishlist"><a href="#"><span>wishlist</span></a></div>
                      <div class="quickview"><a href="#"><span>Quick View</span></a></div>
                      <div class="compare"><a href="#"><span>Compare</span></a></div>
                      <div class="add-to-cart"><a href="#"><span>Add to cart</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- =====  sale product end ===== -->
          <!-- =====  SUB BANNER  STRAT ===== -->
          <!-- <div class="row">
            <div class="cms_banner mt_60 mb_50">
              <div class="col-xs-12">
                <div id="subbanner4" class="banner sub-hover"> <a href="#"><img src="images/Main-New-Arrival-Banner-4_compressed.jpg" alt="Sub Banner4" class="img-responsive"></a>
                  <div class="bannertext"> </div>
                </div>
              </div>
            </div>
          </div> -->
          <!-- =====  SUB BANNER END  ===== -->
          <!-- =====  product ===== -->
          <div class="row">
            <div class="col-md-4">
              <div class="heading-part mb_20 ">
                <h2 class="main_title">Featured</h2>
              </div>
              <div id="featu-pro" class="owl-carousel">
                <ul class="row ">
                  <?php
                  $Counter = 0;
                  foreach ($product_list as $product) {
                    $pic = json_decode($product->Picture);
                    if ($product->Featured == 1) {
                      ?>
                      <li class="item product-layout-left mb_20">
                        <div class="product-list col-xs-4">
                          <div class="product-thumb">
                            <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="<?php echo base_url('upload/' . $pic[0]); ?>"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="<?php echo base_url('upload/' . $pic[0]); ?>"> </a> </div>
                          </div>
                        </div>
                        <div class="col-xs-8">
                          <div class="caption product-detail">
                            <h6 class="product-name"><a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"><?php echo $product->Name; ?></a></h6>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                            <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $product->Price; ?></span>
                            </span>
                          </div>
                        </div>
                      </li>
                      <?php
                      $Counter++;
                      if ($Counter == 3) {
                        echo '</ul><ul  class="row">';
                        $Counter = 0;
                      }
                    }
                  } ?>

                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="heading-part mb_20 ">
                <h2 class="main_title">Bestseller</h2>
              </div>
              <div id="bests-pro" class="owl-carousel">
                <ul class="row ">
                  <?php
                  $Counter = 0;
                  foreach ($product_list as $product) {
                    $pic = json_decode($product->Picture);
                    if ($product->BestSeller == 1) {
                      ?>
                      <li class="item product-layout-left mb_20">
                        <div class="product-list col-xs-4">
                          <div class="product-thumb">
                            <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="<?php echo base_url('upload/' . $pic[0]); ?>"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="<?php echo base_url('upload/' . $pic[0]); ?>"> </a> </div>
                          </div>
                        </div>
                        <div class="col-xs-8">
                          <div class="caption product-detail">
                            <h6 class="product-name"><a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"><?php echo $product->Name; ?></a></h6>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                            <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $product->Price; ?></span>
                            </span>
                          </div>
                        </div>
                      </li>
                      <?php
                      $Counter++;
                      if ($Counter == 3) {
                        echo '</ul><ul  class="row">';
                        $Counter = 0;
                      }
                    }
                  } ?>

                </ul>
              </div>
            </div>
            <div class="col-md-4">
              <div class="heading-part mb_20 ">
                <h2 class="main_title">New Item’s</h2>
              </div>
              <div id="new-pro" class="owl-carousel">
                <ul class="row ">
                  <?php
                  $Counter = 0;
                  foreach ($latest_product as $product) {
                    $pic = json_decode($product->Picture);
                    ?>
                    <li class="item product-layout-left mb_20">
                      <div class="product-list col-xs-4">
                        <div class="product-thumb">
                          <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="<?php echo base_url('upload/' . $pic[0]); ?>"> <img class="img-responsive" title="iPod Classic" alt="iPod Classic" src="<?php echo base_url('upload/' . $pic[0]); ?>"> </a> </div>
                        </div>
                      </div>
                      <div class="col-xs-8">
                        <div class="caption product-detail">
                          <h6 class="product-name"><a href="<?php echo base_url() . 'product/productdetail/' . $product->Id; ?>"><?php echo $product->Name; ?></a></h6>
                          <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                          <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $product->Price; ?></span>
                          </span>
                        </div>
                      </div>
                    </li>
                    <?php
                    $Counter++;
                    if ($Counter == 3) {
                      echo '</ul><ul  class="row">';
                      $Counter = 0;
                    }
                  } ?>

                </ul>
              </div>
            </div>
          </div>
          <!-- =====  product end  ===== -->
          <!-- =====  Blog ===== -->
          <div id="Blog" class="mt_40">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Latest from the Blog</h2>
            </div>
            <div class="blog-contain box">
              <div class="blog owl-carousel ">
                <?php foreach ($blog_list as $blog) {
                  $pic = json_decode($blog->picture);
                  ?>
                  <div class="item">
                    <div class="box-holder">
                      <div class="thumb post-img"><a href="#"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="HealthCare"> </a> </div>
                      <div class="post-info mtb_20 ">
                        <h6 class="mb_10 text-uppercase"> <a href="<?php echo base_url().'Blog/blogdetail/'. $blog->id; ?>"><?php echo $blog->name; ?></a> </h6>
                        <p><?php echo $blog->description; ?></p>
                        <div class="date-time">
                          <div class="day"><?php $unixtime = strtotime($blog->createdDate); echo date('D', $unixtime); ?></div>
                          <div class="month"><?php echo date('m', $unixtime); ?></div>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php } ?>


                <!-- <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="#"> <img src="images/Main-New-Arrival-Banner-4_compressed.jpg" alt="HealthCare"> </a></div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="single_blog.html">Unknown printer took a galley book.</a> </h6>
                      <p>Aliquam egestas pellentesque est. Etiam a orci Nulla id enim feugiat ligula ullamcorper scelerisque. Morbi eu luctus nisl.</p>
                      <div class="date-time">
                        <div class="day"> 11</div>
                        <div class="month">Aug</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="#"> <img src="images/blog-img-02.jpg" alt="HealthCare"> </a></div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="single_blog.html">Unknown printer took a galley book.</a> </h6>
                      <p>Aliquam egestas pellentesque est. Etiam a orci Nulla id enim feugiat ligula ullamcorper scelerisque. Morbi eu luctus nisl.</p>
                      <div class="date-time">
                        <div class="day"> 11</div>
                        <div class="month">Aug</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="#"> <img src="images/Summer-Banner_compressed.jpg" alt="HealthCare"> </a></div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="single_blog.html">Unknown printer took a galley book.</a> </h6>
                      <p>Aliquam egestas pellentesque est. Etiam a orci Nulla id enim feugiat ligula ullamcorper scelerisque. Morbi eu luctus nisl.</p>
                      <div class="date-time">
                        <div class="day"> 11</div>
                        <div class="month">Aug</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="#"> <img src="images/Main-New-Arrival-Banner-4_compressed.jpg" alt="HealthCare"> </a></div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="single_blog.html">Unknown printer took a galley book.</a> </h6>
                      <p>Aliquam egestas pellentesque est. Etiam a orci Nulla id enim feugiat ligula ullamcorper scelerisque. Morbi eu luctus nisl.</p>
                      <div class="date-time">
                        <div class="day"> 11</div>
                        <div class="month">Aug</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="item">
                  <div class="box-holder">
                    <div class="thumb post-img"><a href="#"> <img src="images/Toys_For_Girls_1.jpg" alt="HealthCare"> </a></div>
                    <div class="post-info mtb_20 ">
                      <h6 class="mb_10 text-uppercase"> <a href="single_blog.html">Unknown printer took a galley book.</a> </h6>
                      <p>Aliquam egestas pellentesque est. Etiam a orci Nulla id enim feugiat ligula ullamcorper scelerisque. Morbi eu luctus nisl.</p>
                      <div class="date-time">
                        <div class="day"> 11</div>
                        <div class="month">Aug</div>
                      </div>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
            <!-- =====  Blog end ===== -->
          </div>
        </div>
      </div>
    </div>
    <!-- =====  CONTAINER END  ===== -->
    <!-- =====  FOOTER START  ===== -->
    <?php require("footer.php"); ?>
    <!-- =====  FOOTER END  ===== -->
  </div>
  <?php require("bottom.php"); ?>
</body>

</html>