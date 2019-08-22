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
                <?php require("profileleft.php"); ?>
                <div class="col-sm-8 col-md-8 col-lg-9 mtb_30">
                    <!-- =====  BANNER STRAT  ===== -->
                    <br>
                    <h1>Orders</h1>
                    <br>
                    <table class="table table-bordered table-hover">
                        <tr>
                            <th>Order ID</th>
                            <th>Grand Total</th>
                            <th>Status</th>
                        </tr>
                        <?php foreach ($order_list as $order) { ?>
                            <tr>
                                <td><?php echo $order['orderId']; ?></td>
                                <td><?php echo $order['cartGrandTotal']; ?></td>
                                <td>
                                    <p class="badge badge-pill badge-info dropdown-toggle status" data-toggle="dropdown">
                                        <?php echo $order['status']; ?>
                                    </p>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
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