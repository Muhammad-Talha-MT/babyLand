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
                <?php require("profileleft.php"); ?>
                <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
                    <!-- =====  BANNER STRAT  ===== -->
                    <h1>Customer Profile</h1>
                    <br>
                    <?php if (isset($_SESSION['success'])) { ?>
                        <div class="alert alert-success">
                            <span><?php if (isset($_SESSION['success'])) {
                                        echo $_SESSION['success'];
                                    } ?></span>
                        </div>
                    <?php } ?>
                    <?php if (isset($_SESSION['failed'])) { ?>
                        <div class="alert alert-danger">
                            <span><?php if (isset($_SESSION['failed'])) {
                                        echo $_SESSION['failed'];
                                    } ?></span>
                        </div>
                    <?php } ?>
                    <?php if ((validation_errors())) { ?>
                        <div class="alert alert-danger">
                            <?php echo validation_errors(); ?>
                        </div>
                    <?php } ?>
                    
                    <form action="<?php echo base_url() . 'customer/changepassword/' . $_SESSION['userid']; ?>" method="post">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>
                                    Old Password
                                </th>
                                <td>
                                    <input placeholder="Old Password" class="form-control" type="password" value="" name="oldpassword" value="">

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    New Password
                                </th>
                                <td>
                                    <input placeholder="New Password" class="form-control" type="password" name="newpassword" id="" value="">

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Confirm Password
                                </th>
                                <td>
                                    <input placeholder="Confirm Password" class="form-control" type="password" value="" name="confirmpassword">
                                </td>
                            </tr>

                        </table>
                        <input type="submit" value="CHANGE PASSWORD" name="update" class="btn">
                    </form>

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