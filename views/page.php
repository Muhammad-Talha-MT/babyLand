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
                        <h1><?php echo $page[0]['title']; ?></h1>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="category_page.html">Information</a></li>
                            <li class="active"><?php echo $page[0]['title']; ?></li>
                        </ul>
                    </div>
                    <!-- =====  BREADCRUMB END===== -->

                    <div>
                        <?php
                        echo $page[0]['body']; ?>
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