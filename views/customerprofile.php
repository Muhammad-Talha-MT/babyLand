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
                    <form action="<?php echo base_url() . 'customer/update/' . $_SESSION['userid']; ?>" method="post">
                        <table class="table table-bordered table-hover">
                            <tr>
                                <th>
                                    Name
                                </th>
                                <td>
                                    <input class="form-control" type="text" value="<?php echo $customer[0]['UserName']; ?>" name="userName">

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Email
                                </th>
                                <td>
                                    <input class="form-control" type="email" name="email" id="" value="<?php echo $customer[0]['EmailAddress']; ?>">

                                </td>
                            </tr>
                            <tr>
                                <th>
                                    Contact
                                </th>
                                <td>
                                    <input class="form-control" type="text" value="<?php echo $customer[0]['contact']; ?>" name="contact">
                                </td>
                            </tr>

                        </table>
                        <input type="submit" value="UPDATE" name="update" class="btn">
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