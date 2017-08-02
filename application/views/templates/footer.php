<!--MODAL DIALu kaOG-->
<!---->
<!--<div class="modal fade" id="specialPrices" role="dialog">-->
<!--    <div class="modal-dialog">-->
<!---->
            <!-- Modal content-->
<!--        <div class="modal-content">-->
<!--            <div class="modal-header">-->
<!--                <button type="button" class="close" data-dismiss="modal">&times;</button>-->
<!--                <h4 class="modal-title">Sale Prices</h4>-->
<!--            </div>-->
<!--            <div class="modal-body">-->
<!--                <table id="hrs-avail-tb" class="table hrs-avail-tb" width="100%" cellspacing="0">-->
<!--                    <thead class="hrs-avail-tb-head ">-->
<!--                    <tr>-->
<!--                        <th class="hrs-avail-tb-head-col">Charge Per Hour</th>-->
<!--                        <th class="hrs-avail-tb-head-col">Charge Per Day</th>-->
<!--                        <th class="hrs-avail-tb-head-col">Start Date</th>-->
<!--                        <th class="hrs-avail-tb-head-col">End Date</th>-->
<!---->
<!--                    </thead>-->
<!--                    <tbody class="hrs-avail-tb-content-main ">-->
<!--                    --><?php
//                    foreach ($salePriceData as $sale) {
//                        ?>
<!--                        <tr class="">-->
<!--                            <td class="hrs-avail-tb-content-col">-->
<!--                                <div class="hrs-avail-tb-td">$--><?php //echo $sale['sale_price_per_hour']; ?><!--</div>-->
<!--                            </td>-->
<!--                            <td class="hrs-avail-tb-content-col">-->
<!--                                <div class="hrs-avail-tb-td">$--><?php //echo $sale['sale_price_per_day']; ?><!--</div>-->
<!--                            </td>-->
<!--                            <td class="hrs-avail-tb-content-col">-->
<!--                                <div class="hrs-avail-tb-td">--><?php //echo date('Y-m-d H:i', strtotime($sale['start_date'])); ?><!--</div>-->
<!--                            </td>-->
<!--                            <td class="hrs-avail-tb-content-col">-->
<!--                                <div class="hrs-avail-tb-td">--><?php //echo date('Y-m-d H:i', strtotime($sale['end_date'])); ?><!--</div>-->
<!--                            </td>-->
<!---->
<!--                        </tr>-->
<!--                        --><?php
//                    }
//                    ?>
<!--                    </tbody>-->
<!--                </table>-->
<!--            </div>-->
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
<!--            </div>-->
<!--        </div>-->
<!---->
<!--    </div>-->
<!--</div>-->
<!---->
<!--</div>-->


<footer class="footer full">
    <div class="footer-up full">
        <div class="container">
            <div class="footer-up-inner full">
                <div class="footer-up-col aos-init" data-aos="fade-right">
                    <div class="footer-up-hd full">
                        <div class="footer-logo">
                            <img src="<?php echo IMAGE_PATH; ?>logo.png" alt="uz-img">
                        </div>
                    </div>
                    <div class="footer-up-content full">
                        <p>
                            <?php echo $config['about_us']; ?>

                        </p>
                    </div>
                </div>

                <div class="footer-up-col aos-init" data-aos="fade-up">
                    <div class="footer-up-hd">
                        <h3>Sitemap</h3>
                    </div>
                    <div class="footer-up-content">
                        <ul class="link-list">
                            <li>
                                <a href="<?php echo base_url(); ?>">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('about_us'); ?>">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('website'); ?>">
                                    Websites
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('help'); ?>">
                                    Help
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('contact_us'); ?>">
                                    Contact Us
                                </a>
                            </li>


                        </ul>
                    </div>
                </div>
                <div class="footer-up-col aos-init" data-aos="fade-left">
                    <div class="footer-up-hd">
                        <h3>Follow Us</h3>
                    </div>
                    <div class="footer-up-content">

                        <div class="social-list full">
                            <ul>
                                <li>
                                    <a href="<?php echo $config['facebook_url']; ?>">
                                        <!--<i class="fa fa-facebook" aria-hidden="true"></i>-->
                                        <img src="<?php echo IMAGE_PATH; ?>facebook.png" alt="uz-img">
                                    </a>

                                </li>
                                <li>
                                    <a href="<?php echo $config['twitter_url']; ?>">
                                        <!--<i class="fa fa-twitter" aria-hidden="true"></i>-->
                                        <img src="<?php echo IMAGE_PATH; ?>twitter.png" alt="uz-img">
                                    </a>
                                </li>

                                <li>
                                    <a href="<?php echo $config['instagram_url']; ?>">
                                        <!--<i class="fa fa-instagram" aria-hidden="true"></i>-->
                                        <img src="<?php echo IMAGE_PATH; ?>insta.png" alt="uz-img">
                                    </a>
                                </li>

                            </ul>

                        </div>
                        <div class="copyright full">
                            <p>Copyright © 2017 <?php echo ucfirst(strtolower(SITE_TITLE)); ?>. All right reserved.</p>
                        </div>
                        <div class="terms full">
                            <ul>
                                <li>
                                    <a href="<?php echo base_url('privacy_policy');?>">Privacy Policy </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('terms_of_service');?>">Terms Of Service </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</footer>



<script src="<?php echo JS_PATH; ?>bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH; ?>jquery.mixitup.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
<script src="<?php echo JS_PATH; ?>jquery.counterup.min.js"></script>
<script type="text/javascript">


    $(document).ready(function ($) {


        var filterList = {

            init: function () {

                // MixItUp plugin
                // http://mixitup.io
                $('#portfoliolist').mixItUp({
                    selectors: {
                        target: '.portfolio',
                        filter: '.filter'
                    },
                    load: {
                        filter: '.app'
                    }
                });

            }

        };
        //Rating functionality
        $('.website_ratings').barrating({
            theme: 'css-stars',
            showSelectedRating: false,
            hoverState: false,
            readonly: true
        });

        // Run the show!
        filterList.init();


        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });

        var listH = $(".listing-main").innerHeight();
        //alert(listH);
        var listH1 = listH + 40;
        //alert(listH1);
        $(".listing-main-img").css("height", listH1);

        console.log("aaa");


    });
    /*jQuery(document).ready(function( $ ) {
     $('.counter').counterUp({
     delay: 10,
     time: 1000
     });
     });*/
</script>
<script src="<?php echo JS_PATH; ?>jquery.barrating.js"></script>
<!--<script src="--><?php //echo JS_PATH; ?><!--examples.js"></script>-->
<script src="<?php echo JS_PATH; ?>aos1.js"></script>
<script>
    AOS.init({
        easing: 'ease-in-out-sine',
        disable: 'mobile'
    });
</script>
<script src="<?php echo JS_PATH; ?>underscore-min.js"></script>
<script src="<?php echo JS_PATH; ?>moment.min.js"></script>
<script src="<?php echo JS_PATH; ?>clndr.js"></script>
<!--<script src="<?php //echo JS_PATH; ?>demo.js"></script>-->
<script>
    var base_url = '<?php echo base_url() ?>';
    var link = $('#link').val();
//    console.log(base_url+link);


    jQuery.validator.addMethod("noSpace", function (value, element) {
        if (value != '') {
            return value.indexOf(" ") < 0 && value != "";
        } else
            return true;
    }, "Space is not allowed");

    jQuery.validator.addMethod("validatePhoneNo", function (value, element) {
//            return this.optional(element) || /^(\+){0,1}[0-9()-]*$/.test(value);
        if (this.optional(element) || /^(\+){0,1}[0-9()-\s]*$/.test(value) && value != '')
        {
            return true;
        } else
            return false;
    }, "Please enter valid contact number.");

    jQuery.validator.addMethod("validateNoLeadingZero", function (value, element)
    {
        if (value != '')
        {
            firstLetter = value.charAt(0);
            if (firstLetter == '0')
                return false;
            else
                return true;
        } else
            return true;
    }, 'Mobile number should not start with "0".');
    jQuery.validator.addMethod("noSpace", function (value, element) {
        if (value != '') {
            return value.indexOf(" ") < 0 && value != "";
        } else
            return true;
    }, "Space is not allowed");

    jQuery.validator.addMethod("validateName", function (value, element) {
        return this.optional(element) || /^[a-zA-Z\\.'-\s]+$/i.test(value);
    }, "Please enter valid Name");

    jQuery.validator.addMethod("checkAlreadyExist", function (value, element) {
        if ($.trim(value) != '') {
            var isSuccess = true;
            $.ajax({
                url: base_url + link,
                type: 'POST',
                data: {
                    email_id: value
//                    unique_id: $('#' + unique_id).val()
                },
                async: false,
                success: function (data)
                {
//                    alert(data);
                    res = $.parseJSON(data);
                    isSuccess = res.result === true ? true : false
                }
            });
            return isSuccess;
        } else
            return true;
    }, "This email is already registered on our website.");

    jQuery.validator.addMethod("notNegative", function (value, element) {
        if ($.trim(value) != '') {
            if ($.trim(value) <= 0)
                return false;
            else
                return true;
        } else
            return true;
    }, "Value should be greater than 0");

    jQuery.validator.addMethod("noSpecialChar", function (value, element) {
        return this.optional(element) || /^[a-zA-Z0-9]+$/i.test(value);
    }, "No Special Characters");

    jQuery.validator.addMethod("checkOnlySpace", function (value, element) {
//        if ( $.trim( $('#myInput').val() ) == '' ){
        if ( $.trim( value ) == '' ){
            return value.indexOf(" ") < 0 && value != "";
        } else
            return true;
    }, "Field cannot be left blank.");

    jQuery.validator.addMethod("noSpace", function (value, element) {
        if (value != '') {
            return value.indexOf(" ") < 0 && value != "";
        } else
            return true;
    }, "Space is not allowed");

    jQuery.validator.addMethod("validateImage", function (value, element) {
        if (value) {
            var fileExtension = ['jpeg', 'jpg', 'png', 'gif', 'bmp'];
            if ($.inArray($(element).val().split('.').pop().toLowerCase(), fileExtension) == -1)
                return false;
            else
                return true;
        } else
            return true;
    }, "Please enter valid image type.");

    jQuery.validator.addMethod("validateImagesize", function (value, element) {
        if (value)
        {
            var size = parseFloat(element.files[0].size / 1024 / 1024).toFixed(2);
            if (size > 5)
                return false;
            else
                return true;
        } else
            return true;

    }, 'Max size for image is 5MB.');
    jQuery.validator.addMethod("email_valid", function (value, element)
    {
//            return this.optional(element) || /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/.test(value);
        return this.optional(element) || /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,6}|\d+)$/i .test(value);
    }, "Please enter valid email address format.");

    jQuery.validator.addMethod("numericOnly", function (value, element) {
        return this.optional(element) || /^[0-9]+$/i.test(value);
    }, "Please enter numbers only.");

    $("#loginCustomerForm").validate({
        rules:
        {
            email:"required",
//            password:
//            {
//                requried: true,
//                minlength:6
//            }
        }
    });

    $("#changePasswordForm").validate(
    {
        rules:
        {
            password:
            {
                required: true,
                minlength: 6
            },
            confirm_password:
            {
                minlength: 6,
                equalTo: "#password"
            }
        },
        messages:
        {
            confirm_password:
            {
                minlength: "Please enter at least 6 characters.",
                equalTo: "Passwords do not match."
            }
        }
    });

    $("#signupCustomerForm").validate({
        rules:
        {
            password:
            {
                required: true,
                minlength: 6
            },
            confirm_password:
            {
                equalTo: "#password"
            },
            mobileno:
            {
                minlength: 6,
                maxlength: 16
            }
        },
        messages:
        {
            password:
            {
                minlength:"Please enter password at least of 6 characters."
            },
            confirm_password:
            {
                equalTo: "Please enter same password."
            },
            mobileno:
            {
                minlength: "Please enter valid phone number.",
                maxlength: "Please enter valid phone number."
            }
        }

    });
    $("#myAccountFormCus").validate({
        rules:
        {
            address:
            {
                required:true,
                minlength: 4
            },
            mobileno:
            {
                minlength: 6,
                maxlength: 16
            }
        }
    });
</script>

</body>
</html>