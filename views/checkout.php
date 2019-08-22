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
            <h1>Shopping Cart</h1>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ul>
          </div>
          <!-- =====  BREADCRUMB END===== -->
          <form action="<?php echo base_url(); ?>Cart/checkOut" method="post">
            <div class="panel-group mt_20" id="accordion">
              <div class="panel panel-default  ">
                <div class="panel-heading">
                  <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Step 1: Checkout Options <i class="fa fa-caret-down"></i></a></h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-sm-6">
                        <h3>New Customer</h3>
                        <p>Checkout Options:</p>
                        <div class="radio">
                          <label>
                            <input type="radio" value="register" id="registered" name="account">Registered Account</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" value="guest" id="guestCustomer" name="account">Guest Checkout</label>
                        </div>
                        <p>By creating an account you will be able to shop faster, be up to date on an order's status, and keep track of the orders you have previously made.</p>
                        <input type="button" class="btn mt_20 button-account" data-loading-text="Loading..." id="button-account" value="Continue">
                      </div>
                      <?php if (!isset($_SESSION['userName'])) { ?>
                        <div class="alert alert-success col-md-4">
                          <h3><?php echo "Register You Account!" ?></h3>Press As Guest Customer
                        </div>
                        <div id="guestCustomerdiv">
                          <div class="col-sm-6">
                            <h3>Guest Customer</h3>
                            <p>I am a returning customer</p>
                            <form action="<?php base_url() . 'Customer/signUpQuick' ?>" method="post">
                              <div class="form-group">
                                <label for="input-email" class="control-label">Full Name</label>
                                <input type="text" class="form-control" id="fullName" placeholder="Full Name" value="" name="fullName">
                              </div>
                              <div class="form-group">
                                <label for="input-email" class="control-label">E-Mail</label>
                                <input type="text" class="form-control" id="input-email" placeholder="E-Mail" value="" name="email">
                              </div>
                              <div class="form-group">
                                <label for="input-email" class="control-label">Contact</label>
                                <input type="text" class="form-control" id="contact" placeholder="Phone" value="" name="contact">
                              </div>
                              <div class="form-group">
                                <label for="input-email" class="control-label">Address</label>
                                <input type="text" class="form-control" id="address" placeholder="Address" value="" name="Address">
                              </div>
                              <div class="form-group">
                                <label for="input-password" class="control-label">Password</label>
                                <input type="password" class="form-control" id="input-password" placeholder="Password" value="" name="password">
                                <a href=""><input type="button" class="btn mt_20" data-loading-text="Loading..." id="button-login" value="Register"></a>
                                <a class="pt_30" href="#">Forgotten Password</a></div>
                            </form>

                          </div>
                        <?php } else {  ?>
                          <div>
                            <?php if (isset($_SESSION['userName'])) {
                              echo "<div class='alert alert-success col-md-6'><h3>" . $_SESSION['userName'] . " your UserId is " . $_SESSION['userid'] . "</h3></div>";

                              echo "<h2>Press CONTINUE</h2>";
                            } ?>
                          </div>
                        <?php } ?>
                      </div>

                    </div>

                  </div>

                </div>
                <div class="panel panel-default ">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a data-toggle="collapse" id="collapseTowtrigger" data-parent="#accordion" href="#collapseTwo">Step 2: Billing Details <i class="fa fa-caret-down"></i></a> </h4>
                  </div>
                  <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">

                      <br>
                      <div id="payment-new">
                        <div class="form-group required">
                          <label for="input-payment-firstname" class="col-sm-2 control-label">Full Name</label>
                          <div class="col-sm-10">
                            <input type="hidden" value="<?php if (isset($_SESSION['userid'])) {
                                                          echo $_SESSION['userid'];
                                                        } ?>" name="userid">
                            <input type="text" class="form-control" value="<?php if (isset($_SESSION['userName'])) {
                                                                              echo $_SESSION['userName'];
                                                                            } ?>" id="input-payment-firstname" placeholder="First Name" value="" name="fullName">
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="input-payment-address-1" class="col-sm-2 control-label">Address 1</label>
                          <div class="col-sm-10">
                            <input type="text" value="<?php if (isset($_SESSION['address'])) {
                                                        echo $_SESSION['address'];
                                                      } ?>" id="address" class="address form-control" name="address_1" ?>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="input-payment-address-1" class="col-sm-2 control-label">Address 1</label>
                          <div class="col-sm-10">
                            <input type="text" value="<?php if (isset($_SESSION['email'])) {
                                                        echo $_SESSION['email'];
                                                      } ?>" id="email" class="email form-control" name="email" ?>
                          </div>
                        </div>
                        <div class="form-group required">
                          <label for="input-payment-city" class="col-sm-2 control-label">City</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-payment-city" placeholder="City" value="" name="city">
                          </div>
                        </div>
                        <div class="form-group required">
                          <label for="input-payment-city" class="col-sm-2 control-label">Contact</label>
                          <div class="col-sm-10">
                            <input type="text" class="form-control" id="contact" value="<?php if (isset($_SESSION['contact'])) {
                                                                                          echo $_SESSION['contact'];
                                                                                        } ?>" placeholder="Phone" value="" name="contact">
                          </div>
                        </div>
                      </div>
                      <div class="buttons clearfix">
                        <div class="pull-right">
                          <input type="button" class="btn" data-loading-text="Loading..." id="button-payment-address" value="Continue">
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
                <div class="panel panel-default ">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapsefour">Step 4: Delivery Method <i class="fa fa-caret-down"></i></a> </h4>
                  </div>
                  <div id="collapsefour" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p>Please select the preferred shipping method to use on this order.</p>
                      <p><strong>Flat Rate</strong></p>
                      <div class="radio">
                        <label>
                          <input type="radio" checked="checked" value="100" name="shipping_method"> Flat Shipping Rate - 100 RPS</label>
                      </div>
                      <p><strong>Add Comments About Your Order</strong></p>
                      <p>
                        <textarea class="form-control" rows="8" name="comment"></textarea>
                      </p>
                      <div class="buttons">
                        <div class="pull-right">
                          <input type="button" class="btn mt_20" data-loading-text="Loading..." id="button-shipping-method" value="Continue">
                        </div>
                      </div>
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
                <div class="panel panel-default ">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapsefive">Step 5: Payment Method <i class="fa fa-caret-down"></i></a> </h4>
                  </div>
                  <div id="collapsefive" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p>Please select the preferred payment method to use on this order.</p>
                      <div class="radio">
                        <label>
                          <input type="radio" checked="checked" value="cod" name="payment_method"> Cash On Delivery </label>
                      </div>
                      <p><strong>Add Comments About Your Order</strong></p>
                      <p>
                        <textarea class="form-control" rows="8" name="comment"></textarea>
                      </p>
                      <div class="buttons">
                        <div class="pull-right mt_20">I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a>
                          <input type="checkbox" value="1" name="agree"> &nbsp;
                          <input type="button" class="btn" data-loading-text="Loading..." id="button-payment-method" value="Continue">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="panel panel-default ">
                  <div class="panel-heading">
                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion" href="#collapsesix">Step 6: Confirm Order <i class="fa fa-caret-down"></i></a> </h4>
                  </div>
                  <div id="collapsesix" class="panel-collapse collapse">
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <td class="text-left">Product Name</td>
                              <td class="text-left">Model</td>
                              <td class="text-right">Quantity</td>
                              <td class="text-right">Unit Price</td>
                              <td class="text-right">Total</td>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $price = 0;
                            foreach ($this->cart->contents() as $cart) {

                              ?>
                              <tr>
                                <td class="text-left"><a href="http://localhost/opc001/index.php?route=product/product&amp;product_id=46"><?php echo $cart['name'] ?></a></td>
                                <td class="text-left">Product 19</td>
                                <td class="text-right"><?php echo $cart['qty'] ?></td>
                                <td class="text-right"><?php echo $cart['price'];
                                                        $price = $price + $cart['price']; ?></td>
                                <td class="text-right"><?php echo $price; ?></td>
                              </tr>
                            <?php } ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <td class="text-right" colspan="4"><strong>Sub-Total:</strong></td>
                              <td class="text-right"><?php echo $this->cart->total(); ?></td>
                            </tr>
                            <tr>
                              <td class="text-right" colspan="4"><strong>Flat Shipping Rate:</strong></td>
                              <td class="text-right"><?php $shipping = 100;
                                                      echo $shipping;
                                                      ?></td>
                            </tr>
                            <tr>
                              <td class="text-right" colspan="4"><strong>Total:</strong></td>
                              <td class="text-right"><?php
                                                      $total = $shipping + $this->cart->total();
                                                      echo $total;
                                                      ?>
                                <input type="hidden" name="grandtotal" value="<?php echo $total ?>">
                              </td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                      <div class="buttons">
                        <div class="pull-right">
                          <input type="submit" data-loading-text="Loading..." class="btn" id="button-confirm" value="Confirm Order">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- =====  CONTAINER END  ===== -->
      <!-- =====  FOOTER START  ===== -->

      <!-- =====  FOOTER END  ===== -->
    </div>
    <?php require("footer.php"); ?>
    <?php require("bottom.php"); ?>
</body>

</html>