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
        <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
          <div class="breadcrumb ptb_20">
            <h1>New TOYS...</h1>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="category_page.html">Products</a></li>
              <li class="active">New TOYS...</li>
            </ul>
          </div>
          <!-- =====  BREADCRUMB END===== -->

          <div class="row mt_10 ">
            <?php
            if (isset($_SESSION['cartAdded'])) {
              echo "<div class='alert alert-success'>" . $_SESSION['cartAdded'] . "</div>";
            }
            ?>
            <?php
            foreach ($product_detail as $product) {
              $pic = json_decode($product['Picture']);
              ?>
              <div class="col-md-6">
                <div><a class="thumbnails"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="" /></a></div>
                <div id="product-thumbnail" class="owl-carousel">
                  <?php
                  foreach ($pic as $picture) {

                    ?>

                    <div class="item">
                      <div class="image-additional"><a class="thumbnail" href="<?php echo base_url(); ?>images/product/product1.jpg" data-fancybox="group1"> <img src="<?php echo base_url('upload/' . $picture); ?>" alt="" /></a></div>
                    </div>

                  <?php } ?>
                </div>
              </div>

            <?php } ?>
            <div class="col-md-6 prodetail caption product-thumb">
              <h4 data-name="product_name" class="product-name"><a href="#" title="Casual Shirt With Ruffle Hem"><?php echo $product['Name']; ?></a></h4>
              <div class="rating">
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span>
              </div>
              <span class="price mb_20"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $product['Price']; ?></span>
              </span>
              <hr>
              <ul class="list-unstyled product_info mtb_20">
                <li>
                  <label>Brand:</label>
                  <span> <a href="#"><?php
                                      if (isset($parent_brand)) {
                                        echo $parent_brand[0]['Name'];
                                      }
                                      ?></a></span></li>
                <li>
                  <label>Product Code:</label>
                  <span> <?php echo $product['Code']; ?></span></li>
                <li>
                  <label>Availability:</label>
                  <span> In Stock</span></li>
              </ul>
              <hr>
              <p class="product-desc mtb_30">
                <?php echo $product['ShortDescription']; ?>
              </p>
              <div id="product">
                <div class="form-group">
                  <div class="row">
                    <div class="Sort-by col-md-6">
                      <label>Sort by</label>
                      <select name="product_size" id="select-by-size" class="selectpicker form-control">
                        <option>Small</option>
                        <option>Medium</option>
                        <option>Large</option>
                      </select>
                    </div>
                    <div class="Color col-md-6">
                      <label>Color</label>
                      <select name="product_color" id="select-by-color" class="selectpicker form-control">
                        <option>Blue</option>
                        <option>Green</option>
                        <option>Orange</option>
                        <option>White</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="qty mt_30 form-group2">
                  <label>Qty</label>
                  <input name="product_quantity" min="1" value="1" type="number">
                </div>
                <div class="button-group mt_30">
                  <a href="<?php echo base_url() . 'cart/addCart/' . $product_detail[0]['Id'] ?>">
                    <div class="add-to-cart">
                      <span>Add to cart</span>
                    </div>
                  </a>
                  <input type="hidden" name="userid" id="userid" value="<?php if (isset($_SESSION['userid'])) {
                                                                          echo $_SESSION['userid'];
                                                                        } ?>">
                  <input type="hidden" name="productid" id="productid" value="<?php if (isset($product_detail[0]['Id'])) {
                                                                                echo $product_detail[0]['Id'];
                                                                              } ?>">
                  <a href="#" id="wishlist">
                    <div class="wishlist"><span>wishlist</span></div>
                  </a>
                  <div class="compare"><a href="#"><span>Compare</span></a></div>
                </div>
              </div>
            </div>
          </div>





          <div class="row">
            <div class="col-md-12">
              <div id="exTab5" class="mtb_30">
                <ul class="nav nav-tabs">
                  <li class="active"> <a href="#1c" data-toggle="tab">Overview</a> </li>
                  <li><a href="#2c" data-toggle="tab">Reviews (1)</a> </li>
                  <li><a href="#3c" data-toggle="tab">Solution</a> </li>
                </ul>
                <div class="tab-content mt_20">
                  <div class="tab-pane active" id="1c">
                    <p>CLorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis malesuada mi id tristique. Sed ipsum nisi, dapibus at faucibus non, dictum a diam. Nunc vitae interdum diam. Sed finibus, justo vel maximus facilisis, sapien turpis euismod tellus, vulputate semper diam ipsum vel tellus.</p>
                  </div>
                  <div class="tab-pane" id="2c">
                    <div>
                      <div class="card">
                        <div class="card-body">
                          <div class="row">

                            <?php
                            foreach ($review_list as $review) {

                              if ($review->ProductId == $product_detail[0]['Id']) {
                                if (isset($review->IsApproved) && $review->IsApproved == "Approved") { ?>

                                  <p><?php echo $review->ReviewText; ?></p>
                                <?php }
                              }
                            } ?>

                          </div>
                        </div>
                      </div>
                    </div>

                    <form class="form-horizontal" method="POST" action="<?php echo base_url() . 'product/productreview/' . $product_detail[0]['Id']; ?>">
                      <div id="review"></div>
                      <h4 class="mt_20 mb_30">Write a review</h4>
                      <?php if (isset($_SESSION['userid'])) { ?>
                        <input type="hidden" name="userEmail" value="<?php echo $_SESSION['email']; ?>">
                        <input type="hidden" name="userid" value="<?php echo $_SESSION['userid']; ?>">
                      <?php } ?>
                      <div class="form-group required">
                        <div class="col-sm-12">
                          <label class="control-label" for="input-name">Your Name</label>
                          <input name="name" value="" id="input-name" class="form-control" type="text">
                        </div>
                      </div>
                      <div class="form-group required">
                        <div class="col-sm-12">
                          <label class="control-label" for="input-review">Your Review</label>
                          <textarea name="text-review" rows="5" id="input-review" class="form-control"></textarea>
                          <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                        </div>
                      </div>
                      <div class="form-group required">
                        <div class="col-md-6">
                          <label class="control-label">Rating</label>
                          <div class="rates"><span>Bad</span>
                            <input name="rating" value="1" type="radio">
                            <input name="rating" value="2" type="radio">
                            <input name="rating" value="3" type="radio">
                            <input name="rating" value="4" type="radio">
                            <input name="rating" value="5" type="radio">
                            <span>Good</span></div>
                        </div>
                        <div class="col-md-6">
                          <div class="buttons pull-right">
                            <button class="btn btn-md btn-link">Continue</button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane" id="3c">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut lobortis malesuada mi id tristique. Sed ipsum nisi, dapibus at faucibus non, dictum a diam. Nunc vitae interdum diam. Sed finibus, justo vel maximus facilisis, sapien turpis euismod tellus, vulputate semper diam ipsum vel tellus.applied clearfix to the tab-content to rid of the gap between the tab and the content</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="heading-part text-center">
                <h2 class="main_title mt_50">Related Products</h2>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="product-layout  product-grid related-pro  owl-carousel mb_50">
              <div class="item">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="<?php echo base_url(); ?>images/product-img-02.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url(); ?>images/product-img-2.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name mt_20"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating">
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span>
                    </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
                    <div class="button-group text-center">
                      <div class="wishlist"><a href="#"><span>wishlist</span></a></div>
                      <div class="quickview"><a href="#"><span>Quick View</span></a></div>
                      <div class="compare"><a href="#"><span>Compare</span></a></div>
                      <div class="add-to-cart"><a href="#"><span>Add to cart</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="<?php echo base_url(); ?>images/product-img-08.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url(); ?>images/product-img-8.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name mt_20"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating">
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span>
                    </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
                    <div class="button-group text-center">
                      <div class="wishlist"><a href="#"><span>wishlist</span></a></div>
                      <div class="quickview"><a href="#"><span>Quick View</span></a></div>
                      <div class="compare"><a href="#"><span>Compare</span></a></div>
                      <div class="add-to-cart"><a href="#"><span>Add to cart</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="<?php echo base_url(); ?>images/product-img-03.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url(); ?>images/product-img-3.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name mt_20"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating">
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span>
                    </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
                    <div class="button-group text-center">
                      <div class="wishlist"><a href="#"><span>wishlist</span></a></div>
                      <div class="quickview"><a href="#"><span>Quick View</span></a></div>
                      <div class="compare"><a href="#"><span>Compare</span></a></div>
                      <div class="add-to-cart"><a href="#"><span>Add to cart</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="<?php echo base_url(); ?>images/product-img-04.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url(); ?>images/product-img-4.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name mt_20"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating">
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span>
                    </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
                    <div class="button-group text-center">
                      <div class="wishlist"><a href="#"><span>wishlist</span></a></div>
                      <div class="quickview"><a href="#"><span>Quick View</span></a></div>
                      <div class="compare"><a href="#"><span>Compare</span></a></div>
                      <div class="add-to-cart"><a href="#"><span>Add to cart</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="<?php echo base_url(); ?>images/product-img-05.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url(); ?>images/product-img-5.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name mt_20"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating">
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span>
                    </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
                    <div class="button-group text-center">
                      <div class="wishlist"><a href="#"><span>wishlist</span></a></div>
                      <div class="quickview"><a href="#"><span>Quick View</span></a></div>
                      <div class="compare"><a href="#"><span>Compare</span></a></div>
                      <div class="add-to-cart"><a href="#"><span>Add to cart</span></a></div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="product-thumb">
                  <div class="image product-imageblock"> <a href="product_detail_page.html"> <img data-name="product_image" src="<?php echo base_url(); ?>images/product-img-09.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> <img src="<?php echo base_url(); ?>images/product-img-9.jpg" alt="iPod Classic" title="iPod Classic" class="img-responsive"> </a> </div>
                  <div class="caption product-detail text-left">
                    <h6 data-name="product_name" class="product-name mt_20"><a href="#" title="Casual Shirt With Ruffle Hem">Latin literature from 45 BC, making it over old.</a></h6>
                    <div class="rating">
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                      <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span>
                    </div>
                    <span class="price"><span class="amount"><span class="currencySymbol">PKR</span>70.00</span>
                    </span>
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

        </div>
      </div>
      <div id="brand_carouse" class="ptb_30 text-center">
        <div class="type-01">
          <div class="heading-part mb_20 ">
            <h2 class="main_title">Brand Logo</h2>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="brand owl-carousel ptb_20">
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand1.png" alt="Disney" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand2.png" alt="Dell" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand3.png" alt="Harley" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand4.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand5.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand6.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand7.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand8.png" alt="Canon" class="img-responsive" /></a> </div>
                <div class="item text-center"> <a href="#"><img src="<?php echo base_url(); ?>images/brand/brand9.png" alt="Canon" class="img-responsive" /></a> </div>
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