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
            <h1>Products</h1>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li class="active">Products</li>
            </ul>
          </div>
          <!-- =====  BREADCRUMB END===== -->
          <div class="category-page-wrapper mb_30">
            <div class="col-xs-6 sort-wrapper">
              <label class="control-label" for="input-sort">Sort By :</label>
              <div class="sort-inner">
                <select id="input-sort" class="form-control">
                  <option value="ASC" selected="selected">Default</option>
                  <option value="ASC">Name (A - Z)</option>
                  <option value="DESC">Name (Z - A)</option>
                  <option value="ASC">Price (Low &gt; High)</option>
                  <option value="DESC">Price (High &gt; Low)</option>
                  <option value="DESC">Rating (Highest)</option>
                  <option value="ASC">Rating (Lowest)</option>
                  <option value="ASC">Model (A - Z)</option>
                  <option value="DESC">Model (Z - A)</option>
                </select>
              </div>
              <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
            </div>
            <div class="col-xs-4 page-wrapper">
              <label class="control-label" for="input-limit">Show :</label>
              <div class="limit">
                <select id="input-limit" class="form-control">
                  <option value="8" selected="selected">08</option>
                  <option value="25">25</option>
                  <option value="50">50</option>
                  <option value="75">75</option>
                  <option value="100">100</option>
                </select>
              </div>
              <span><i class="fa fa-angle-down" aria-hidden="true"></i></span>
            </div>
            <div class="col-xs-2 text-right list-grid-wrapper">
              <div class="btn-group btn-list-grid">
                <button type="button" id="list-view" class="btn btn-default list-view"></button>
                <button type="button" id="grid-view" class="btn btn-default grid-view active"></button>
              </div>
            </div>
          </div>
          <div class="row">
            <?php foreach ($Child_Product as $child) {
              $pic = json_decode($child['Picture']);
              ?>
              <div class="product-layout  product-grid  col-lg-3 col-md-4 col-sm-6 col-xs-12 ">
                <div class="item">
                  <div class="product-thumb clearfix mb_30">
                    <div class="image product-imageblock"> <a href="<?php echo base_url(); ?>Product/ProductDetail"> <img data-name="product_image" src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive" /> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic" class="img-responsive" /> </a> </div>
                    <div class="caption product-detail text-left">
                      <h6 data-name="product_name" class="product-name mt_20"><a href="#" title="Casual Shirt With Ruffle Hem"><?php echo $child['Name']; ?></a></h6>
                      <div class="rating">
                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-1x"></i></span>
                        <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i><i class="fa fa-star fa-stack-x"></i></span>
                      </div>
                      <span class="price"><span class="amount"><span class="currencySymbol">PKR</span><?php echo $child['Price']; ?></span>
                      </span>
                      <p class="product-desc mt_20 mb_60"><?php echo $child['ShortDescription']; ?></p>
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

            <?php } ?>
            
          </div>
          <div class="pagination-nav text-center mt_50">
            <ul>
              <li><a href="#"><i class="fa fa-angle-left"></i></a></li>
              <li class="active"><a href="#">1</a></li>
              <li><a href="#">2</a></li>
              <li><a href="#">3</a></li>
              <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
            </ul>
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