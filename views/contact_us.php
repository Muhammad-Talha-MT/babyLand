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
        <?php require("left.php"); ?>
        <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- contact  -->
          <div class="row">
            <div class="col-md-4 col-xs-12 contact">
              <div class="location mb_50">
                <h3 class="capitalize mb_20">Our Location</h3>
                <div class="address">Office address
                  <br><?php echo $setting_list->address; ?></div>
                <div class="call mt_10"><i class="fa fa-phone" aria-hidden="true"></i><?php echo $setting_list->contact; ?></div>
                <div class="email mt_10"><i class="fa fa-envelope" aria-hidden="true"></i><a href="mailto:info@yourdomailname.com" target="_top"><?php echo $setting_list->email; ?></a></div>
              </div>
            </div>
            <div class="col-md-8 col-xs-12 contact-form mb_50">
              <!-- Contact FORM -->
              <div id="contact_form">
                <?php if (isset($_SESSION['success'])) { ?>
                  <div class="alert alert-success">
                    <span><?php if (isset($_SESSION['success'])) {
                            echo $_SESSION['success'];
                          } ?></span>
                  </div>
                <?php } ?>
                <?php if (isset($_SESSION['fail'])) { ?>
                  <div class="alert alert-danger">
                    <span><?php if (isset($_SESSION['fail'])) {
                            echo $_SESSION['fail'];
                          } ?></span>
                  </div>
                <?php } ?>
                <form id="contact_body" method="post" action="<?php if (isset($_SESSION['userid'])) {
                                                                echo base_url() . 'page/postmessage/' . $_SESSION['userid'];
                                                              } ?>">
                  <!--                                <label class="full-with-form" ><span>Name</span></label>
-->
                  <input class="full-with-form " type="text" name="name" placeholder="Name" data-required="true" value="<?php if (isset($_SESSION['userName'])) {
                                                                                                                          echo $_SESSION['userName'];
                                                                                                                        } ?>" />
                  <!--                <label class="full-with-form" ><span>Email Address</span></label>
-->
                  <input class="full-with-form  mt_30" type="email" name="email" placeholder="Email Address" data-required="true" value="<?php if (isset($_SESSION['email'])) {
                                                                                                                                            echo $_SESSION['email'];
                                                                                                                                          } ?>" />
                  <!--                <label class="full-with-form" ><span>Phone Number</span></label>
-->
                  <input class="full-with-form  mt_30" type="text" name="phone1" placeholder="Phone Number" maxlength="15" data-required="true" value="<?php if (isset($_SESSION['contact'])) {
                                                                                                                                                          echo $_SESSION['contact'];
                                                                                                                                                        } ?>" />
                  <!--                <label class="full-with-form" ><span>Subject</span></label>
-->
                  <input class="full-with-form  mt_30" type="text" name="subject" placeholder="Subject" data-required="true">
                  <!--                                <label class="full-with-form" ><span>Attachment</span></label>
-->
                  <!--                                <label class="full-with-form" ><span>Message</span></label>
-->
                  <textarea class="full-with-form  mt_30" name="message" placeholder="Message" data-required="true"></textarea>
                  <button class="btn mt_30" type="submit">Send Message</button>
                </form>
                <div id="contact_results"></div>
              </div>
              <!-- END Contact FORM -->
            </div>
          </div>
          <!-- map  -->
          <div class="row">
            <div class="col-xs-12 map mb_80">
              <div id="map"></div>
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

  <!-- =====  FOOTER END  ===== -->
  <!-- Single Blog  -->
  <!-- End Blog   -->
  <!-- =====  CONTAINER END  ===== -->
  <!-- =====  FOOTER START  ===== -->
  <?php require("footer.php"); ?>
  <!-- =====  FOOTER END  ===== -->
  <?php require("bottom.php"); ?>
</body>

</html>