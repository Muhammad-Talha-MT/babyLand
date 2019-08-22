<header id="header">
  <div class="header-top">
    <div class="container">
      <div class="row">
        <div class="col-sm-6">
          <ul class="header-top-left">
            <li class="language dropdown"> <span class="dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"> <img src="<?php echo base_url(); ?>images/English-icon.gif" alt="img"> English <span class="caret"></span> </span>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                <li><a href="#"><img src="<?php echo base_url(); ?>images/English-icon.gif" alt="img"> English</a></li>
                <li><a href="#"><img src="<?php echo base_url(); ?>/images/French-icon.gif" alt="img"> French</a></li>
                <li><a href="#"><img src="<?php echo base_url(); ?>/images/German-icon.gif" alt="img"> German</a></li>
              </ul>
            </li>
            <li class="currency dropdown"> <span class="dropdown-toggle" id="dropdownMenu12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"> PKR <span class="caret"></span> </span>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenu12">
                <li><a href="#">USD</a></li>
                <li><a href="#">EUR</a></li>
                <li><a href="#">AUD</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="col-sm-6">
          <ul class="header-top-right text-right">

            <?php if (isset($_SESSION['userid'])) { ?>
              <li class="account"><a href="<?php echo base_url(); ?>/Customer/showProfile/<?php echo $_SESSION['userid']; ?>"><?php echo $_SESSION['userName']; ?></a></li>
            <?php } else { ?>
              <li class="account"><a href="<?php echo base_url(); ?>/Customer/RegisterLogin">Login Your Account</a></li>
            <?php } ?>

            <li class="sitemap"><a href="#">Sitemap</a></li>
            <li class="cart"><a href="<?php echo base_url(); ?>/Cart/MyCart">My Cart</a></li>
            <?php
            if (isset($_SESSION['userid'])) { ?>
              <li><a href="<?php echo base_url() . '/customer/logout'; ?>">Log Out</a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <div class="header">
    <div class="container">
      <nav class="navbar">
        <div class="navbar-header mtb_20"> <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <h1><?php echo $setting_list->bannerName; ?></h1>
          </a> </div>
        <div class="header-right pull-right mtb_50">
          <button class="navbar-toggle pull-left" type="button" data-toggle="collapse" data-target=".js-navbar-collapse"> <span class="i-bar"><i class="fa fa-bars"></i></span></button>
          <div class="shopping-icon">
            <div class="cart-item " data-target="#cart-dropdown" data-toggle="collapse" aria-expanded="true" role="button">Item's : <span class="cart-qty">
                <?php echo count($this->cart->contents()); ?>

              </span></div>
            <div id="cart-dropdown" class="cart-menu collapse">
              <ul>
                <li>
                  <table class="table table-striped">
                    <tbody>
                      <?php
                      foreach ($this->cart->contents() as $cart) {
                        $pic = json_decode($cart['image']);
                        ?>
                        <tr>
                          <input type="hidden" name="cartid" value="<?php echo $cart['rowid']; ?>" class="cartid">
                          <td class="text-center"><a href="#"><img src="<?php echo base_url('upload/' . $pic[0]); ?>" alt="iPod Classic" title="iPod Classic"></a></td>
                          <td class="text-left product-name"><a href="#"><?php echo $cart['name'] ?></a>
                            <span class="text-left price"><?php echo $cart['price'] ?></span>
                            <div class="input-group">
                              <input class="cart-qty" name='quantity' min="1" value="<?php echo $cart['qty'] ?>" type="number">
                              <button class="btn update" title="" name="update" id="update" data-toggle="tooltip" type="button" data-original-title="Update"><i class="fa fa-refresh"></i></button>
                            </div>
                          </td>
                          <td class="text-center"><a class="close-cart delete" name="delete" id="delete"><i class="fa fa-times-circle"></i></a></td>
                        </tr>

                      <?php } ?>
                    </tbody>
                  </table>
                </li>
                <li>
                  <div id="">
                    <table class="table" id="">
                      <tbody>
                        <tr>
                          <td class="text-right"><strong>Sub-Total</strong></td>
                          <td class="text-right"><span class='total'><?php echo $this->cart->total(); ?></span></td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>Eco Tax (-2.00)</strong></td>
                          <td class="text-right">PKR2.00</td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>VAT (20%)</strong></td>
                          <td class="text-right">PKR20.00</td>
                        </tr>
                        <tr>
                          <td class="text-right"><strong>Total</strong></td>
                          <td class="text-right">PKR2,122.00</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </li>
                <li>
                  <a href="<?php echo base_url(); ?>Cart/MyCart"><input class="btn pull-left mt_10" value="View cart" type="submit"></a>
                  <a href="<?php echo base_url(); ?>Cart/CheckOut"><input class="btn pull-right mt_10" value="Checkout" type="submit"></a>
                </li>
              </ul>
            </div>
          </div>
          <div class="main-search pull-right">
            <div class="search-overlay">
              <!-- Close Icon -->
              <a href="javascript:void(0)" class="search-overlay-close"></a>
              <!-- End Close Icon -->
              <div class="container">
                <!-- Search Form -->
                <form role="search" id="searchform" action="<?php echo base_url() . 'product/searchProduct' ?>" method="get">
                  <label class="h5 normal search-input-label">Enter keywords To Search Entire Store</label>
                  <input value="" name="keyword" placeholder="Search here..." type="search">
                  <button type="submit"></button>
                </form>
                <!-- End Search Form -->
              </div>
            </div>
            <div class="header-search"> <a id="search-overlay-btn"></a> </div>
          </div>
        </div>
        <div class="collapse navbar-collapse js-navbar-collapse pull-right">
          <ul id="menu" class="nav navbar-nav">
            <?php $count = 0;
            foreach ($category_list as $category) { ?>
              <?php if ($category->ParentCategoryId == 0) {
                if ($count < 5) { ?>
                  <li class="dropdown mega-dropdown">
                    <a href="<?php echo base_url() . 'category/CategoryProduct/' . $category->Id; ?>" class="dropdown-toggle">
                      <span><i class="fa fa-exchange"></i></span><span><?php echo $category->Name;
                                                                        $id = $category->Id; ?></span>
                    </a>
                    <ul class="dropdown-menu mega-dropdown-menu row">
                      <li class="col-md-3">
                        <ul>
                          <?php foreach ($category_list as $child) {
                            $childId = $child->Id;
                            if ($child->ParentCategoryId == $id) {
                              ?>
                              <li class="dropdown-header">
                                <a href="<?php echo base_url() . 'category/CategoryProduct/' . $child->Id; ?>"><?php echo $child->Name; ?></a>
                              </li>
                              <?php $subChildCount = 0;
                              foreach ($category_list as $subchild) {
                                $subchildId = $subchild->Id;
                                if ($subchild->ParentCategoryId == $childId && $subChildCount < 10) {
                                  ?>
                                  <li>
                                    <a href="<?php echo base_url() . 'category/CategoryProduct/' . $subchild->Id; ?>"><?php echo $subchild->Name; ?></a>
                                  </li>
                                  <?php $subChildCount++;
                                }
                              } ?>

                            <?php }
                          } ?>
                        </ul>
                      </li>
                    </ul>
                  </li>
                  <?php $count++;
                }
              }  ?>
            <?php } ?>
          </ul>
          </li>




          </ul>
        </div>
        <!-- /.nav-collapse -->
      </nav>
    </div>
  </div>
  <div class="header-bottom">
    <div class="container">
      <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-3">
          <div class="category">
            <div class="menu-bar" data-target="#category-menu,#category-menu-responsive" data-toggle="collapse" aria-expanded="true" role="button">
              <h4 class="category_text">Top category</h4>
              <span class="i-bar"><i class="fa fa-bars"></i></span>
            </div>
          </div>
          <div id="category-menu-responsive" class="navbar collapse " aria-expanded="true" role="button">
            <div class="nav-responsive">
              <ul class="nav  main-navigation collapse in">
                <li><a href="#">Pharmacy</a></li>
                <li><a href="#">Health</a></li>
                <li><a href="#">Beauty</a></li>
                <li><a href="#">Vitamins</a></li>
                <li><a href="#">Sweating</a></li>
                <li><a href="#">Coughs & Colds</a></li>
                <li><a href="#">Hair Loss</a></li>
                <li><a href="#">Weight Loss</a></li>
                <li><a href="#">Antifungals</a></li>
                <li><a href="#">Pain Relief</a></li>
                <li><a href="#">Stop Smoking</a></li>
                <li><a href="#">Skin Conditions</a></li>
                <li><a href="#">Top Brands</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-8 col-md-8 col-lg-9">
          <div class="header-bottom-right offers">
            <div class="marquee">
              <?php foreach ($news_list as $News) { ?>
                <span><i class="fa fa-circle" aria-hidden="true"></i><?php echo $News->heading; ?></span>
              <?php } ?>
              <span><i class="fa fa-circle" aria-hidden="true"></i>Lorum ipsum is a dummy text!</span>
              <span><i class="fa fa-circle" aria-hidden="true"></i>Lorum ipsum is a dummy text</span>
              <span><i class="fa fa-circle" aria-hidden="true"></i>Lorum ipsum is a dummy text</span>
              <span><i class="fa fa-circle" aria-hidden="true"></i>Lorum ipsum is a dummy text?</span>
              <span><i class="fa fa-circle" aria-hidden="true"></i>Lorum ipsum is a dummy text?</span>
              <span><i class="fa fa-circle" aria-hidden="true"></i>Lorum ipsum is a dummy text?</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>