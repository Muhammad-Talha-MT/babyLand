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
    <?php require("profileheader.php"); ?>
    <!-- =====  HEADER END  ===== -->
    <!-- =====  CONTAINER START  ===== -->
    <div class="container">
      <div class="row ">
        <?php require("left.php"); ?>
        <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
          <!-- contact  -->
          <div class="col-md-4">
            <a href="<?php echo base_url() . 'customer/loginwithfacebook'; ?>"><img src="<?php echo base_url() . 'images/flogin.png' ?>"></a>
          </div>
          <div class="row">
            <div class="col-md-6 col-md-offset-3">
              <div class="panel-login">
                <div class="panel-heading">
                  <div class="row mb_20">
                    <div class="col-xs-6">
                      <a href="#" class="active" id="login-form-link">Login</a>
                    </div>
                    <div class="col-xs-6">
                      <a href="#" id="register-form-link">Register</a>
                    </div>
                  </div>
                  <hr>
                </div>

                <div class="panel-body">

                  <?php
                  if (isset($_SESSION['fail'])) { ?>
                    <div class="alert alert-danger">
                      <?php echo $_SESSION['fail']; ?>
                    </div>
                  <?php } ?>
                  <div class="row">
                    <div class="col-lg-12">
                      <form action="<?php echo base_url() . 'customer/login'; ?>" method="post">
                        <div>
                          <div class="form-group">
                            <input type="text" name="username1" id="username1" tabindex="1" class="form-control" placeholder="Username" value="">
                            <?php
                            echo form_error('username1');
                            ?>
                          </div>
                          <div class="form-group">
                            <input type="password" name="password1" id="password" tabindex="2" class="form-control" placeholder="Password">
                            <?php
                            echo form_error('password1');
                            ?>
                          </div>
                          <div class="form-group text-center">
                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                            <label for="remember"> Remember Me</label>
                          </div>

                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                              </div>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-lg-12">
                                <div class="text-center">
                                  <a href="#" tabindex="5" class="forgot-password">Forgot Password?</a>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>

                      <form action="<?php echo base_url() . 'customer/signup'; ?>" method="post">
                        <?php
                        if (isset($_SESSION['failSignup'])) { ?>
                          <div class="alert alert-danger">
                            <?php echo $_SESSION['failSignup']; ?>
                          </div>
                        <?php } ?>
                        <div>
                          <div class="form-group">
                            <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">

                            <?php
                            echo form_error('username');
                            ?>
                          </div>
                          <div class="form-group">
                            <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="<?php echo set_value('email'); ?>">
                            <span id="error"></span>
                            <?php
                            //echo form_error('email');
                            ?>
                          </div>
                          <div class="form-group">
                            <input type="text" name="contact" id="contact" tabindex="2" class="form-control" placeholder="Phone">
                            <?php
                            //echo form_error('password');
                            ?>
                          </div>
                          <div class="form-group">
                            <input type="text" name="address" id="address" tabindex="2" class="form-control" placeholder="Address">
                            <?php
                            ///echo form_error('password');
                            ?>
                          </div>
                          <div class="form-group">
                            <input type="password" name="password" id="password2" tabindex="2" class="form-control" placeholder="Password">
                            <?php
                            //echo form_error('password');
                            ?>
                          </div>
                          <div class="form-group">
                            <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                            <?php
                            //echo form_error('confirm-password');
                            ?>
                          </div>
                          <div class="form-group">
                            <div class="row">
                              <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                              </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
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