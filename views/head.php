<head>
  <!-- =====  BASIC PAGE NEEDS  ===== -->
  <meta charset="utf-8">
  <title>Baby Land</title>
  <!-- =====  SEO MATE  ===== -->
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="description" content="">
  <meta name="keywords" content="">
  <meta name="distribution" content="global">
  <meta name="revisit-after" content="2 Days">
  <meta name="robots" content="ALL">
  <meta name="rating" content="8 YEARS">
  <meta name="Language" content="en-us">
  <meta name="GOOGLEBOT" content="NOARCHIVE">
  <!-- =====  MOBILE SPECIFICATION  ===== -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta name="viewport" content="width=device-width">
  <!-- =====  CSS  ===== -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/font-awesome.min.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/bootstrap.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/magnific-popup.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/owl.carousel.css">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.png">
  <link rel="apple-touch-icon" href="<?php echo base_url(); ?>images/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="<?php echo base_url(); ?>images/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="<?php echo base_url(); ?>images/apple-touch-icon-114x114.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <style>
  #error {
    color: red;
  }
  </style>
  <script>
    $(document).ready(function() {
      $('#email').blur(function() {
        var dataToSend = {
          'email': $(this).val()
        };
        var ajaxObj = {
          type: 'POST',
          datatype: 'json',
          url: '<?php echo base_url(); ?>customer/checkEmail',
          data: dataToSend,
          success: function(r) {
            var bool = JSON.parse(r);
            if (bool == true) {
              $("#username").attr("disabled", "disabled");
              $("#password2").attr("disabled", "disabled");
              $("#contact").attr("disabled", "disabled");
              $("#address").attr("disabled", "disabled");
              $("#confirm-password").attr("disabled", "disabled");
              $("#register-submit").attr("disabled", "disabled");
              $("#error").text("Email Already Exist!");
            } else {
              $("#username").removeAttr("disabled");
              $("#password2").removeAttr("disabled");
              $("#contact").removeAttr("disabled");
              $("#address").removeAttr("disabled");
              $("#confirm-password").removeAttr("disabled");
              $("#register-submit").removeAttr("disabled");
              $("#error").text("");
            }
          },
          onerror: function() {
            console.log("Falied");
          }
        }
        console.log(ajaxObj);
        $.ajax(ajaxObj);
      });


    });
    $(document).ready(function() {
      $(".update").click(function() {
        console.log("called");
        var dataToSend = {
          'id': $(this).closest("tr").find("input[class='cartid']").val(),
          'quantity': $(this).closest("div.input-group").find("input[name='quantity']").val(),
        };
        console.log(dataToSend);
        var ajaxObj = {
          type: 'POST',
          datatype: 'json',
          url: '<?php echo base_url(); ?>Cart/updateQuantity',
          data: dataToSend,
          success: function(r) {
            console.log(r);
            $(".total").text(r);
          },
          error: function() {
            console.log("Failed");
          },
        };
        $.ajax(ajaxObj);

      });
    });

    $(document).ready(function() {
      $(".update").click(function() {
        console.log("called");
        var dataToSend = {
          'id': $(this).closest("tr").find("input[class='cartid']").val(),
          'quantity': $(this).closest("div.input-group").find("input[name='quantity']").val(),
        };
        console.log(dataToSend);
        var ajaxObj = {
          type: 'POST',
          datatype: 'json',
          url: '<?php echo base_url(); ?>Cart/updateQuantity',
          data: dataToSend,
          success: function(r) {
            console.log(r);
            $(".total").text(r);
          },
          error: function() {
            console.log("Failed");
          },
        };
        $.ajax(ajaxObj);

      });
    });

    $(document).ready(function() {
      $(".delete").click(function() {
        console.log("called");
        var dataToSend = {
          'id': $(this).closest("tr").find("input[class='cartid']").val(),
          'quantity': 0,
        };
        console.log(dataToSend);
        var ajaxObj = {
          type: 'POST',
          datatype: 'json',
          url: '<?php echo base_url(); ?>Cart/delete',
          data: dataToSend,
          success: function(r) {
            //console.log()
            location.reload();
          },
          error: function() {
            console.log("Failed");
          },
        };
        $.ajax(ajaxObj);

      });
    });

    $(document).ready(function() {
      $("#wishlist").click(function() {
        console.log("called");
        var dataToSend = {
          'userid': $("#userid").val(),
          'productid': $("#productid").val(),
        };
        console.log(dataToSend);
        var ajaxObj = {
          type: 'POST',
          datatype: 'json',
          url: '<?php echo base_url() . 'wishlist/addwish/' ?>',
          data: dataToSend,
          success: function(r) {
            console.log(r);
          },
          error: function() {
            console.log("Failed");
          },
        };
        $.ajax(ajaxObj);

      });
    });

    $(document).ready(function() {

      function grandTotal() {
        var items = parseFloat($("#total_item").text());
        var total = parseFloat($("#total").text());
        var gift = parseFloat($("#giftCard").text());
        var shipping = parseFloat($("#shipping").text());
        var grandTotal = total + shipping - gift;
        $("#grandTotal").text(grandTotal);
      }
      $("#button-voucher").click(function() {
        console.log("called");
        var dataToSend = {
          'code': $("#input-voucher").val(),
        };
        console.log(dataToSend);
        var ajaxObj = {
          type: 'POST',
          datatype: 'json',
          url: '<?php echo base_url() . 'gift/checkGiftCode' ?>',
          data: dataToSend,
          success: function(r) {
            console.log(r);
            $("#giftCard").text(r);
            grandTotal();
          },
          error: function() {
            console.log("Failed");
          },
        };
        $.ajax(ajaxObj);

      });
    });
    $(document).ready(function() {
      $("#guestCustomerdiv").hide();
      $("#registeredCustomer").hide();
      $("#guestCustomer").click(function() {
        $("#guestCustomerdiv").show();
        $("#registeredCustomer").hide();
      });
      $("#registered").click(function() {
        $("#guestCustomerdiv").hide();
        $("#registeredCustomer").show();
      });

      $(".button-account").click(function() {
        $("#collapseTowtrigger").trigger("click");
      });

      $("#payment-address").click(function() {
        $("#new-paymentAddress").show();
      });


      //forget password
      $(document).ready(function() {
        $("#forgotPassword").click(function() {
          console.log("called");
          var dataToSend = {
            'email': $("#email").val(),
            'password': $("#password").val(),
          };
          console.log(dataToSend);
          var ajaxObj = {
            type: 'POST',
            datatype: 'json',
            url: '<?php echo base_url(); ?>customer/sendPassword',
            data: dataToSend,
            success: function(r) {
              console.log(r)


            },
            error: function() {
              console.log("Failed");
            },
          };
          $.ajax(ajaxObj);

        });
      });
    });
  </script>
</head>