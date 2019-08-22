<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">
<!--<![endif]-->

<?php require("head.php"); ?>

<body>
  <!-- =====  LODER  ===== -->
  <div class="loder"></div>
  <div class="wrapper">

    <!-- =====  HEADER START  ===== -->
    <?php require("header.php"); ?>
    <!-- =====  HEADER END  ===== -->
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <div class="row ">
        <?php require("left.php"); ?>
        <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
          <div class="breadcrumb ptb_20">
            <h1>Search Results</h1>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li class="active">Searched Products</li>
            </ul>
          </div>
          <!-- =====  SUB BANNER END  ===== -->
          <!-- =====  PRODUCT TAB  ===== -->
          <div id="product-tab" class="mt_40">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Products By Name</h2>
            </div>
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
                    foreach ($searchByName as $productByName) {
                      $pic = json_decode($productByName->Picture);
                      ?>

                      <div class="item">
                        <div class="product-thumb mb_30">

                          <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $productByName->Id; ?>"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                          <div class="caption product-detail text-left">
                            <h6 data-name="product_name" class="product-name mt_20"><a href="<?php echo base_url() . 'product/productdetail' ?>" title="Casual Shirt With Ruffle Hem"><?php echo $productByName->Name; ?></a></h6>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                            <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $productByName->Price; ?></span>
                            </span>
                            <div class="button-group text-center">
                              <a href="#" id="wishlist">
                                <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                                        echo $_SESSION['userid'];
                                                                                      } ?>">
                                <input type="hidden" name="productid" id="productid" value="<?php if (isset($productByName->Id)) {
                                                                                              echo $productByName->Id;
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
                              <a href="<?php echo base_url() . 'cart/addCart/' . $productByName->Id ?>">
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

            </div>
          </div>
          <div id="product-tab" class="mt_40">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Products By Category</h2>
            </div>
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
                    foreach ($searchByCategory as $productByCategory) {
                      $pic = json_decode($productByCategory->Picture);
                      ?>

                      <div class="item">
                        <div class="product-thumb mb_30">

                          <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $productByCategory->Id; ?>"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                          <div class="caption product-detail text-left">
                            <h6 data-name="product_name" class="product-name mt_20"><a href="<?php echo base_url() . 'product/productdetail' ?>" title="Casual Shirt With Ruffle Hem"><?php echo $productByCategory->Name; ?></a></h6>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                            <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $productByCategory->Price; ?></span>
                            </span>
                            <div class="button-group text-center">
                              <a href="#" id="wishlist">
                                <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                                        echo $_SESSION['userid'];
                                                                                      } ?>">
                                <input type="hidden" name="productid" id="productid" value="<?php if (isset($productByCategory->Id)) {
                                                                                              echo $productByCategory->Id;
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
                              <a href="<?php echo base_url() . 'cart/addCart/' . $productByCategory->Id ?>">
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

            </div>
          </div>
          <div id="product-tab" class="mt_40">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Products By Tags</h2>
            </div>
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
                    foreach ($searchByTag as $productByTags) {
                      $pic = json_decode($productByTags->Picture);
                      ?>

                      <div class="item">
                        <div class="product-thumb mb_30">

                          <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $productByTags->Id; ?>"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                          <div class="caption product-detail text-left">
                            <h6 data-name="product_name" class="product-name mt_20"><a href="<?php echo base_url() . 'product/productdetail' ?>" title="Casual Shirt With Ruffle Hem"><?php echo $productByTags->Name; ?></a></h6>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                            <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $productByTags->Price; ?></span>
                            </span>
                            <div class="button-group text-center">
                              <a href="#" id="wishlist">
                                <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                                        echo $_SESSION['userid'];
                                                                                      } ?>">
                                <input type="hidden" name="productid" id="productid" value="<?php if (isset($productByTags->Id)) {
                                                                                              echo $productByTags->Id;
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
                              <a href="<?php echo base_url() . 'cart/addCart/' . $productByTags->Id ?>">
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

            </div>
          </div>
          <div id="product-tab" class="mt_40">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Products By Brand</h2>
            </div>
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
                    foreach ($searchByBrand as $productByBrand) {
                      $pic = json_decode($productByBrand->Picture);
                      ?>

                      <div class="item">
                        <div class="product-thumb mb_30">

                          <div class="image product-imageblock"> <a href="<?php echo base_url() . 'product/productdetail/' . $productByBrand->Id; ?>"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                          <div class="caption product-detail text-left">
                            <h6 data-name="product_name" class="product-name mt_20"><a href="<?php echo base_url() . 'product/productdetail' ?>" title="Casual Shirt With Ruffle Hem"><?php echo $productByBrand->Name; ?></a></h6>
                            <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span> </div>
                            <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $productByBrand->Price; ?></span>
                            </span>
                            <div class="button-group text-center">
                              <a href="#" id="wishlist">
                                <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                                        echo $_SESSION['userid'];
                                                                                      } ?>">
                                <input type="hidden" name="productid" id="productid" value="<?php if (isset($productByBrand->Id)) {
                                                                                              echo $productByBrand->Id;
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
                              <a href="<?php echo base_url() . 'cart/addCart/' . $productByBrand->Id ?>">
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

            </div>
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