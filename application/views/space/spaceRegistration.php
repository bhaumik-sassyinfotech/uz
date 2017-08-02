<div class="main-content full cms-pages">
    <div class="uz-wrap full web-info-page">
        <div class="Website-add-sec full">
            <div class="container-fluid">
                <div class="ad full">
                    <span class="adtext">Billing Information</span>
                </div>

            </div>
        </div>

        <!--Error Message-->
        <?php if ($this->session->flashdata('registerError') != '') { ?>
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                <strong>Sorry!</strong> <?php echo $this->session->flashdata('registerError'); ?>
            </div>
        <?php } ?>

        <div class="contact-us-wrap full contact-space space-reg">
            <div class="gp-content-sec full contact-page other-page-content">
                <div class="container">
                    <div class="check-out contact-page-content full">
                        <?php

                        /*echo "<pre>"; print_r($userData);die;*/
                        if (!isCustomerLogin()) {
                            ?>
                            <?php if ($this->session->flashdata('errorMsg') != '') { ?>
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                                    <strong>Sorry!</strong> <?php echo $this->session->flashdata('errorMsg'); ?>
                                </div>
                            <?php } ?>
                            <div class="form-group">
                                <label class="radio-inline"><input id="r1" checked type="radio" value="login" name="checkout">Login Account</label>
                                <label class="radio-inline"><input id="r2" type="radio" value="guest" name="checkout">Guest Account</label>
                            </div>

                            <div class="form-group container login-area">
                                <form action="<?php echo base_url('customer'); ?>" method="post">
                                    <input type="hidden" name="redirectLink" id="redirectLink" value="<?php echo $redirectLink; ?>">
                                    <div class="col-md-4">
                                        <label for="username">Email:*</label>
                                        <input type="email" required class="required form-control" id="email" name="email"/>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="password">Password:*</label>
                                        <input type="password" required class="required form-control" id="password" name="password">
                                    </div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-success" name="login" value="Login">Login</button>
                                    </div>
                                </form>
                            </div> 
                            <?php
                        }
                        ?>
                        <div class="contact-page-content-form full input-detail">
                            <form class="gp-contact-us-form" action="<?php echo base_url('website/userBooking') ?>" name="paymentForm" id="paymentForm" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="booking_id" id="booking_id" value="<?php echo $booking_id; ?>">
                                <input type="hidden" name="checkoutType" id="checkoutType" value="<?php echo $checkoutType; ?>">
                                
                                <div class="form-group gp-contact-form-group">
                                    <label for="first_name" class="control-label">
                                        First Name: *
                                    </label>
                                    <input type="text" name="first_name" id="first_name"
                                           class="validateName checkOnlySpace required form-control input-sm"
                                           placeholder="First Name" value="<?php echo @$userData['first_name']; ?>">
                                </div>

                                <div class="form-group gp-contact-form-group">
                                    <label for="last_name" class="control-label">
                                        Last Name: *
                                    </label>
                                    <input type="text" name="last_name" id="last_name"
                                           class="validateName checkOnlySpace required form-control input-sm"
                                           placeholder="Last Name" value="<?php echo @$userData['last_name']; ?>">
                                </div>


                                <div class="form-group gp-contact-form-group">
                                    <label for="email" class="control-label">
                                        Email ID: *
                                    </label>
                                    <input type="email" name="email" id="email" class="required email_valid checkOnlySpace form-control input-sm"
                                           placeholder="Email id" value="<?php echo @$userData['email']; ?>">
                                </div>

                                <div class="form-group gp-contact-form-group">
                                    <label for="mobile" class="control-label">
                                        Mobile Number: *
                                    </label>
                                    <input type="text" name="mobile" id="mobile"
                                           class="notNegative numericOnly checkOnlySpace required form-control input-sm"
                                           placeholder="Mobile no " value="<?php echo @$userData['mobile_no']; ?>">
                                </div>

                                <div class="form-group gp-contact-form-group" id="adrs">
                                    <label for="address" class="control-label">Address</label>
                                    <textarea name="address" id="address" class="required checkOnlySpace" placeholder="Address"><?php echo @$userData['address']; ?></textarea>
                                </div>

                                <div class="form-group gp-contact-form-group">
                                    <label for="country">Country: *</label>
                                    <select class="form-control required" name="country" id="country">
                                        <option value="">Select Country</option>
                                        <?php
                                        if ($userData['country']) {
                                            $msg = "";
                                            $statess = array();

                                            foreach ($countryList as $ctry) {
                                                if ($userData['country'] == $ctry['name']) {
                                                    $msg = "selected";
                                                    $statess = $this->space->getState($ctry['id']);
                                                } else
                                                    $msg = "";
                                                ?>
                                                <option value="<?php echo $ctry['name']; ?>" <?php echo $msg; ?> data-cid="<?php echo $ctry['id']; ?>"><?php echo $ctry['name']; ?></option>
                                                <?php
                                            } //end foreach of if condition.
                                            ?>
                                        <?php } else {
                                            foreach ($countryList as $country) { ?>
                                                <option value="<?php echo $country['name']; ?>" data-cid="<?php echo $country['id']; ?>"><?php echo $country['name']; ?></option>
                                            <?php } //end foreach of else condition.

                                        } ?>
                                    </select>
                                </div>

                                <div class="form-group gp-contact-form-group">
                                    <label for="state">State: *</label>
                                    <div class="form-group">

                                        <select class="form-control required" name="state" id="state">
                                            <option value="">Select Country First:</option>
                                            <?php
                                            $msg = "";
                                            foreach ($statess as $st) {
                                                if ($st['name'] == $userData['state']) {
                                                    $msg = "selected";
                                                } else {
                                                    $msg = "";
                                                }
                                                ?>
                                                <option value="<?php echo $st['name']; ?>" <?php echo $msg; ?> ><?php echo $st['name']; ?></option>
                                                <?php
                                            } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group gp-contact-form-group">
                                    <label for="street" class="control-label">
                                        Street: *
                                    </label>
                                    <input type="text" name="street" id="street"
                                           class="validName checkOnlySpace required form-control input-sm"
                                           placeholder="Street" value="<?php echo @$userData['street']; ?>">
                                </div>
                                <div class="form-group gp-contact-form-group">
                                    <label for="town" class="control-label">
                                        Town/City: *
                                    </label>
                                    <input type="text" name="town" id="town"
                                           class="required form-control checkOnlySpace input-sm"
                                           placeholder="Town/City" value="<?php echo @$userData['city']; ?>">
                                </div>
                                <div class="form-group gp-contact-form-group">
                                    <label for="zipcode" class="control-label">
                                        Zipcode: *
                                    </label>
                                    <input type="text" name="zipcode" id="zipcode"
                                           class="checkOnlySpace required form-control input-sm"
                                           placeholder="Zipcode" value="<?php echo @$userData['zip_code']; ?>">
                                </div>

                                <div class="form-group gp-contact-form-group">
                                    <label for="website_url" class="control-label">
                                        Add Hyperlink you like to associate: (http://www.example.com) *
                                    </label>
                                    <input type="text" name="website_url" id="website_url"
                                           class="required checkOnlySpace form-control input-sm"
                                           placeholder="http://www.example.com">
                                </div>

                                <div class="form-group gp-contact-form-group">
                                    <label for="banner" class="control-label">
                                        Upload Image:*
                                    </label>
                                    <input type="file" name="banner" id="banner"
                                           class="imageonly validateImagesize validateImage btn btn-primary required "/><br>
                                    <p class="alert alert-danger" id="alert-size-error" style="display: none"></p>
                                    <span>Please upload image of : </span>
                                    <span><?php echo $space['banner_width'] . " x " . $space['banner_height']; ?> (pixels)</span>
                                    <!--                                    <div class="alert alert-info">-->
                                    <!--                                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
                                    <!--                                        <span>Please upload image of following size (pixels): </span><br>-->
                                    <!--                                    </div>-->
                                </div>


                                <!--Booking Cart Details-->
                                <div class="day-selected full">
                                    <div class="loading" style="display: none;">
                                        <div class="content"><img src="<?php echo base_url() . 'assets/images/loader.gif'; ?>"/></div>
                                    </div>

                                    <div class="day-selected-inner">
                                        <table id="hrs-avail-tb-data" class="table hrs-avail-tb" width="100%" cellspacing="0">
                                            <thead class="hrs-avail-tb-head ">
                                            <tr>
                                                <th class="hrs-avail-tb-head-col">Days Selected With Number Of Hours</th>
                                                <th class="hrs-avail-tb-head-col">Charge Per Hour / Day</th>
                                                <th class="hrs-avail-tb-head-col">Total Amount</th>

                                            </tr>
                                            </thead>
                                            <tbody class="hrs-avail-tb-content-main ">
                                            <?php
                                            $base_price = 0;
                                            if (!empty($userBookingData)) {
                                                $base_price = $userBookingData[0]['base_price'];
                                                $final_price = $userBookingData[0]['final_price'];
                                                $coupon_id = $userBookingData[0]['coupon_id'];
                                                $coupon_discount = $userBookingData[0]['coupon_discount'];
                                                $coupon_code = $userBookingData[0]['coupon_code'];
                                                $discount_price = $userBookingData[0]['discount_price'];

                                                foreach ($userBookingData as $BookingData) {
                                                    ?>
                                                    <tr>
                                                        <td class="hrs-avail-tb-content-col">
                                                            <div class="hrs-avail-tb-td"><?php echo date("jS F Y", strtotime($BookingData['booking_date'])); ?> (<span><?php echo $BookingData['tot_booking_hrs']; ?></span> Hours)</div>
                                                        </td>
                                                        <td class="hrs-avail-tb-content-col">
                                                            <div class="hrs-avail-tb-td"><?php echo CURRENCY; ?><?php echo $BookingData['single_price']; ?></div>
                                                        </td>
                                                        <td class="hrs-avail-tb-content-col">
                                                            <div class="hrs-avail-tb-td"><?php echo CURRENCY; ?><?php echo $BookingData['tot_amount']; ?></div>
                                                        </td>
                                                    </tr>
                                                <?php }
                                            } ?>
                                            <tr class="base_amount_col">
                                                <td class="hrs-avail-tb-content-col"></td>
                                                <td class="hrs-avail-tb-content-col">Subtotal:</td>
                                                <td class="hrs-avail-tb-content-col"><?php echo CURRENCY; ?><?php echo $base_price; ?></span></td>
                                            </tr>
                                            <?php if ($coupon_id != 0) { ?>
                                                <tr class="coupon_amount_col">
                                                    <td class="hrs-avail-tb-content-col"></td>
                                                    <td class="hrs-avail-tb-content-col">Coupon: <span class="applied_coupon_code"><?php echo $coupon_code; ?> (<?php echo $coupon_discount; ?> %)</span></td>
                                                    <td class="hrs-avail-tb-content-col">-<?php echo CURRENCY; ?><?php echo $discount_price; ?></span></td>
                                                </tr>
                                                <tr class="final_amount_col">
                                                    <td class="hrs-avail-tb-content-col"></td>
                                                    <td class="hrs-avail-tb-content-col">Total:</td>
                                                    <td class="hrs-avail-tb-content-col"><b><?php echo CURRENCY; ?><span id="bk_final_net_price" class="bk_net_price"><?php echo $final_price; ?></span></b></td>
                                                </tr>
                                            <?php } else { ?>
                                                <tr class="final_amount_col">
                                                    <td class="hrs-avail-tb-content-col"></td>
                                                    <td class="hrs-avail-tb-content-col">Total:</td>
                                                    <td class="hrs-avail-tb-content-col"><b><?php echo CURRENCY; ?><span id="bk_final_net_price" class="bk_net_price"><?php echo $base_price; ?></span></b></td>
                                                </tr>
                                            <?php } ?>

                                            <tr>
                                                <td colspan="3">
                                                    <?php
                                                    if ($coupon_id != 0) {
                                                        $coupon_code_text = $coupon_code;
                                                        $coupon_code_text_css = "readonly";
                                                        $bk_final_price = $final_price;
                                                        $apply_coupon = "display:none;";
                                                        $cancel_coupon = "display:block;";
                                                    } else {
                                                        $coupon_code_text = "";
                                                        $coupon_code_text_css = "";
                                                        $bk_final_price = $base_price;
                                                        $apply_coupon = "display:block;";
                                                        $cancel_coupon = "display:none;";
                                                    }
                                                    ?>

                                                    <div class="form-group gp-contact-form-group">
                                                        <input type="text" name="coupon_code" id="coupon_code" value="<?php echo $coupon_code_text; ?>" class="form-control input-sm"
                                                               placeholder="Add Coupon Code" <?php echo $coupon_code_text_css; ?>/>
                                                        <label id="coupon_code_msg"></label>
                                                    </div>

                                                    <button type="button" name="apply_coupon_code" id="apply_coupon_code" class="btn btn-default site-btn" style="<?php echo $apply_coupon; ?>">apply coupon code</button>

                                                    <button type="button" name="cancel_coupon_code" id="cancel_coupon_code" class="btn btn-default site-btn" style="<?php echo $cancel_coupon; ?>">cancel coupon code</button>

                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                <input type="hidden" name="final_price" id="final_price" value="<?php echo $bk_final_price; ?>"/>
                                <!--Booking Cart Details-->

                                <div class="form-group gp-contact-form-group " style="float: none; margin: 0 auto">
                                    <div class="contact-submit-btn">
                                        <button type="submit" name="save" id="save" class="btn btn-default site-btn">
                                            Pay and Confirm your ad
                                        </button>
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

<script type="text/javascript">
    //Apply Coupon Code
    $("#apply_coupon_code").click(function () {
        var coupon_code = $("#coupon_code").val();
        var booking_id = $("#booking_id").val();
        var final_price = $("#final_price").val();

        if (coupon_code == "") {
            alert('Please Add Coupon Code First!');
            $("#coupon_code").addClass("error");
            $("#coupon_code").focus();
        } else {
            if (final_price > 0) {
                $.ajax({
                    url: '<?php echo base_url('website/apply_coupon_code');?>',
                    type: 'post',
                    dataType: "json",
                    async: false,
                    data: 'coupon_code=' + coupon_code + '&booking_id=' + booking_id,
                    beforeSend: function () {
                        $('.loading').show();
                    },
                    success: function (data) {
                        //alert("hererere");
                        if (data.result == 'success') {
                            $("#coupon_code").prop('readonly', true);
                            $("#coupon_code_msg").html('<span class="msg_ss">' + data.msg + '</span>');
                            $("#cancel_coupon_code").show();
                            $("#apply_coupon_code").hide();

                            $('.final_amount_col').before('<tr class="coupon_amount_col"><td class="hrs-avail-tb-content-col"></td><td class="hrs-avail-tb-content-col">Coupon: <span class="applied_coupon_code">' + coupon_code + ' (' + data.discount_val + '%)</span> </td><td class="hrs-avail-tb-content-col">-<?php echo CURRENCY;?>' + data.discount + '</td></tr>');
                            $("#bk_final_net_price").html(data.final_price);
                            $("#final_price").val(data.final_price);

                        } else {
                            //alert('noo');
                            $("#coupon_code_msg").html('<span class="msg_ff">' + data.msg + '</span>');
                            $("#coupon_code").removeAttr('readonly');
                        }
                        $('.loading').fadeOut("slow");
                    }
                });
            } else {
                $("#coupon_code_msg").html('<span class="msg_ff">Unable to apply coupon code</span>');
            }
        }
    });


    //Cancel Coupon Code
    $("#cancel_coupon_code").click(function () {
        var coupon_code = $("#coupon_code").val();
        var booking_id = $("#booking_id").val();
        var final_price = $("#final_price").val();

        if (coupon_code == "") {
            alert('Please Add Coupon Code First!');
            $("#coupon_code").addClass("error");
            $("#coupon_code").focus();
        } else {
            $.ajax({
                url: '<?php echo base_url('website/cancel_coupon_code');?>',
                type: 'post',
                dataType: "json",
                async: false,
                data: 'coupon_code=' + coupon_code + '&booking_id=' + booking_id,
                beforeSend: function () {
                    $('.loading').show();
                },
                success: function (data) {
                    //alert("hererere");
                    if (data.result == 'success') {
                        $("#coupon_code").val('');
                        $("#coupon_code").removeAttr('readonly');
                        $("#coupon_code_msg").html('<span class="msg_ss">' + data.msg + '</span>');
                        $("#cancel_coupon_code").hide();
                        $("#apply_coupon_code").show();

                        $(".coupon_amount_col").remove();
                        $("#bk_final_net_price").html(data.final_price);
                        $("#final_price").val(data.final_price);
                    } else {
                        $("#coupon_code").prop('readonly', true);
                        $("#coupon_code_msg").html('<span class="msg_ff">' + data.msg + '</span>');
                    }
                    $('.loading').fadeOut("slow");
                }
            });
        }
    });
    //END
    var _URL = window.URL || window.webkitURL;
    $("#banner").change(function (e) {
        var correctWidth = <?php echo $space['banner_width']; ?>;
        var correctHeight = <?php echo $space['banner_height'];?>;
        var file, img;
        if ((file = this.files[0])) {
            img = new Image();
            img.onload = function () {
                var uploadWidth = this.width;
                var uploadHeight = this.height;
                if (uploadHeight != correctHeight && uploadWidth != correctWidth) { //hide submit button

                    $("#alert-size-error").removeAttr('style');
                    $("#alert-size-error").text('Please upload image of dimensions specified below.').css({'display': 'block', 'color': 'red'});

                    $("#save").attr('disabled', true);
                } else {
                    $("#save").attr('disabled', false);
                    $("#alert-size-error").css('display', 'none');
                }

                console.log(uploadWidth + "x" + uploadHeight);
            };
//            img.onerror = function()
//            {
//                alert( "not a valid file: " + file.type);
//            };
            img.src = _URL.createObjectURL(file);

        }
    });

    $('document').ready(function () {
        $('#paymentForm').validate(
            {
                rules: {
                    website_url: {
                        required: true,
                        url: true
                    },
                    zipcode: {
                        required: true,
                    },
                    mobile: {
                        required: true,
                        minlength: 6,
                        maxlength: 16
                    }
                }
            });


        $('#country').change(function () {
//            var dataString = $("select#country option:checked").val();
//            var dataString = $("select#country option:checked").dataset.cid;
            var dataString = $("select#country").find(':selected').data('cid');

//            console.log("==="+dataString);
//            alert(dataString);
            $.ajax(
                {
                    url: "<?php echo base_url() . 'space/getStates/' ?>",
                    type: 'POST',
//                    contentType: "application/json; charset=utf-8",
//                    Content-Type : 'application/json',

//                    data: {country: 'dataString'},
//                    dataType: 'json',
//                    data: { 'country': dataString},
                    data: {'country': dataString},
                    success: function (result) {
                        $("#state").html('');
                        var data = JSON.parse(result);
                        $.each(data, function (key, value) {
                            $('#state').append(
//                                "<option value = '" + value.name + " '>" + value.name + " </option>"
                                '<option value = "' + value.name + '">' + value.name + ' </option>'
                            );
                        });
                    }
                });
        });
    });
    $("input[name='checkout']").change(function () {
//        alert($("input[name='checkout']:checked").val() + " will be selected");
        radioSelected = $("input[name='checkout']:checked").val();
        $("input[name='checkoutType']:checked").val();
   
        if (radioSelected == "login") { // show login fields
//            $("#r1").parent().addClass('active');
//            $("#r2").parent().parent().removeClass('active');
            $(".login-area").fadeIn("slow", "swing");
            $("input[name='checkoutType']").val(1);
//            $("input[type='radio']:checked").addClass("active");

        } else { //hide
//            $("#r1").parent().parent().removeClass('active');
//            $("#r2").parent().addClass('active');
//            $(this).parent().toggleClass('active');
            $(".login-area").fadeOut("slow", "swing");
            $("input[name='checkoutType']").val(2);

        }
    });


</script>
