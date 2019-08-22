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
    <header id="header">
      <?php require("subscribeme.php"); ?>
      <!-- =====  HEADER START  ===== -->
      <?php require("profileheader.php"); ?>
    </header>
    <!-- =====  HEADER END  ===== -->
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <div class="row ">
        <div id="column-left" class="col-sm-4 col-md-4 col-lg-3 hidden-xs">
          <div id="category-menu" class="navbar collapse in  mb_40" aria-expanded="true">
            <div class="nav-responsive">
              <ul class="nav  main-navigation collapse in">
                <?php foreach ($blog_list as $blogs) { ?>
                  <li><a href="#"><?php echo $blogs->name; ?></a></li>
                <?php } ?>

              </ul>
            </div>
          </div>
          <div class="left_banner left-sidebar-widget mt_30 mb_40"> <a href="#"><img src="images/left-banner-img-1.jpg" alt="Left Banner" class="img-responsive" /></a> </div>
          <div class="blog-category left-sidebar-widget mb_50">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Product Category</h2>
            </div>
            <ul>
              <?php
              foreach ($category_list as $category) {
                if ($category->ParentCategoryId == 0) {
                  ?>
                  <li><a href="<?php echo base_url() . 'category/CategoryProduct/' . $category->Id; ?>"><?php echo $category->Name; ?></a></li>
                <?php }
              } ?>
            </ul>
          </div>
          <div class="left-blog left-sidebar-widget mb_50">
            <div class="heading-part mb_20 ">
              <h2 class="main_title">Latest Post</h2>
            </div>
            <div id="left-blog">
              <div class="row ">

                <?php foreach ($latest_blog as $lblog) {
                  $pic = json_decode($lblog->picture);
                  ?>
                  <div class="blog-item mb_20">
                    <div class="post-format col-xs-4">
                      <div class="thumb post-img"><a herf="#"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="HealthCare"></a></div>
                    </div>
                    <div class="post-info col-xs-8 ">
                      <h5><?php echo $lblog->name; ?> </h5>
                      <div class="date pull-left"> <i class="fa fa-calendar" aria-hidden="true"></i><?php echo date('F, Y', strtotime($lblog->createdDate)); ?> </div>
                    </div>
                  </div>
                <?php } ?>


              </div>
            </div>
          </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- =====  BANNER STRAT  ===== -->
          <div class="breadcrumb ptb_20">
            <h1><?php echo $blog[0]['name']; ?></h1>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="blog_page.html">Blogs</a></li>
              <li class="active"><?php echo $blog[0]['title']; ?></li>
            </ul>
          </div>
          <!-- =====  BREADCRUMB END===== -->
          <?php $pic = json_decode($blog[0]['picture']); ?>
          <div class="row">
            <div class="blog-item listing-effect col-md-12 mb_50">
              <div class="post-format">
                <div class="thumb post-img"><a href="#" title="Beautiful Lady"> <img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="HealthCare"></a></div>
                <div class="post-type"> <i class="fa fa-picture-o" aria-hidden="true"></i> </div>
              </div>
              <div class="post-info mtb_20 ">
                <h2 class="mb_10"> <a href="#"><?php echo $blog[0]['name'];  ?></a> </h2>
                <p><?php echo $blog[0]['description'];  ?></p>
              </div>
              <blockquote><?php echo $blog[0]['quote'];  ?></blockquote>
              <div class="details mtb_20">
                <div class="date"> <i class="fa fa-calendar" aria-hidden="true"></i><?php echo date('F, Y', strtotime($blog[0]['createdDate'])); ?></div>
              </div>
              <div class="author-about mt_50">
                <h3 class="author-about-title">About the Author</h3>
                <div class="author mtb_30">
                  <div class="author-avatar"> <img alt="" src="images/Agent-avatar-img-1.png"></div>
                  <div class="author-body">
                    <h5 class="author-name"><a href="#"><?php echo $author[0]['userName']; ?></a></h5>
                    <div class="email mt_10"><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@yourdomailname.com" target="_top"><?php echo $author[0]['email']; ?></a></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Single Blog  -->
  <!-- End Blog   -->
  <!-- =====  CONTAINER END  ===== -->
  <!-- =====  FOOTER START  ===== -->
  <?php require("footer.php"); ?>
  <!-- =====  FOOTER END  ===== -->
  <?php require("bottom.php"); ?>
</body>

</html>