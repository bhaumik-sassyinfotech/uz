<!-- Start Of Inner container -->
<div class="yangon-container">
    <div class="container">
        <div class="al-table">
            <div class="al-table-col">
                <!--start reset section-->
                <div class="al-right-contener col-middle">
                    
                    <div class="al-right-content">
                        <?php if (@$errors != '') { ?>
                            <div class="alert alert-danger">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo @$errors; ?>
                            </div>
                        <?php } ?>
                        <?php if ( $this->session->flashdata('successMsg') != '' ) { ?>
                            <div class="alert alert-success">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <?php echo $this->session->flashdata('successMsg'); ?>
                            </div>
                        <?php } ?>
                        <br><br><br><br><br>
                        <form id="signupCustomerForm" action="<?php echo base_url('customer/signup') ?>" method="post">
<!--                        <form id="signupCustomerForm" action="#" method="post">-->
                            <h1 class="al-right-contener-head">Customer Signup</h1>
                            <input type="hidden" name="link" id="link" value="customer/checkEmail">
                            <ul class="al-right-filed-list my-account-section">
                                <li>
                                    <div class="col-md-6">
                                        <div class="alrft-col">First Name <em>*</em></div>
                                        <div class="alrft-col">

                                            <input type="text" class="form-control required checkOnlySpace validateName" name="first_name" id="first_name" value="<?php echo @$first_name; ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-md-6">
                                        <div class="alrft-col">Last Name <em>*</em></div>
                                        <div class="alrft-col">
                                            <input type="text" class="form-control  required checkOnlySpace validateName" name="last_name" id="last_name" value="<?php echo @$last_name; ?>"/>
                                        </div>
                                    </div>
                                </li>
                                <li>    
                                    <div class="col-md-6">
                                        <div class="alrft-col">Email <em>*</em></div>
                                        <div class="alrft-col">
                                            <input type="email" name="email" id="email" class="form-control required checkAlreadyExist email_valid checkOnlySpace noSpace" value=""/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-md-6">
                                        <div class="alrft-col">Mobile No. <em>*</em></div>
                                        <div class="alrft-col">
                                            <input type="text" name="mobileno" class="form-control required checkOnlySpace validatePhoneNo validateNoLeadingZero" id="mobileno" value=""/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-md-6">
                                        <div class="alrft-col">Password <em>*</em></div>
                                        <div class="alrft-col">
                                            <input type="password" name="password" id="password" class="form-control required checkOnlySpace noSpace" value=""/>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="col-md-6">
                                        <div class="alrft-col">Confirm Password <em>*</em></div>
                                        <div class="alrft-col">
                                            <input type="password" name="confirm_password" id="confirm_password" class="noSpace form-control required checkOnlySpace noSpace" value=""/>
                                        </div>
                                    </div>
                                </li>
<!--                                <li>-->
<!--                                    <div class="alrft-col">Address <em>*</em></div>-->
<!--                                    <div class="alrft-col">-->
<!--                                        <textarea name="address" id="address" rows="10" cols="50" class="form-control required checkOnlySpace"></textarea>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <div class="alrft-col">City <em>*</em></div>-->
<!--                                    <div class="alrft-col">-->
<!--                                        <input type="text" name="city" id="city" class="form-control required checkOnlySpace" value=""/>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <div class="alrft-col">State <em>*</em></div>-->
<!--                                    <div class="alrft-col">-->
<!--                                        <input type="text" name="state" id="state" class="form-control required checkOnlySpace" value=""/>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <div class="alrft-col">Country <em>*</em></div>-->
<!--                                    <div class="alrft-col">-->
<!--                                        <input type="text" name="country" id="country"  class="form-control required checkOnlySpace" value=""/>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <div class="alrft-col">Street <em>*</em></div>-->
<!--                                    <div class="alrft-col">-->
<!--                                        <input type="text" name="street" id="street"  class="form-control required checkOnlySpace" value=""/>-->
<!--                                    </div>-->
<!--                                </li>-->
<!--                                <li>-->
<!--                                    <div class="alrft-col">Zipcode <em>*</em></div>-->
<!--                                    <div class="alrft-col">-->
<!--                                        <input type="text" name="zip_code" id="zip_code"  class="noSpace form-control required checkOnlySpace" value=""/>-->
<!--                                    </div>-->
<!--                                </li>-->
                            </ul>
                            <div class="al-right-btn-wrapper facebook_signup">
                                <div class="button">
                                    <button type="submit" value="submit" class="btn-default">Submit</button>
                                </div>
                                <div class="button">
                                    <button type="button" value="cancel" class="btn-default cancel" onclick="window.location.href = '<?php echo base_url() ?>'">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- End reset Section -->
            </div>
        </div>
    </div>
</div>
<!-- End Of Inner container -->
<!--<script>-->
<!--    jQuery.validator.addMethod("noSpace", function (value, element) {-->
<!--        if (value != '') {-->
<!--            return value.indexOf(" ") < 0 && value != "";-->
<!--        } else-->
<!--            return true;-->
<!--    }, "Space is not allowed");-->
<!---->
<!--    jQuery.validator.addMethod("validatePhoneNo", function (value, element) {-->
<!--//            return this.optional(element) || /^(\+){0,1}[0-9()-]*$/.test(value);-->
<!--        if (this.optional(element) || /^(\+){0,1}[0-9()-\s]*$/.test(value) && value != '')-->
<!--        {-->
<!--            return true;-->
<!--        } else-->
<!--            return false;-->
<!--    }, "Please enter valid contact number.");-->
<!---->
<!--    jQuery.validator.addMethod("validateNoLeadingZero", function (value, element) {-->
<!--//        return this.optional(element) || /^(\+){0,1}[(0-9]{0,1}[0-9()-]*$/.test(value);-->
<!--        if (value != '')-->
<!--        {-->
<!--            firstLetter = value.charAt(0);-->
<!--            if (firstLetter == '0')-->
<!--                return false;-->
<!--            else-->
<!--                return true;-->
<!--        } else-->
<!--            return true;-->
<!--    }, 'Mobile number should not start with "0".');-->
<!--    jQuery.validator.addMethod("noSpace", function (value, element) {-->
<!--        if (value != '') {-->
<!--            return value.indexOf(" ") < 0 && value != "";-->
<!--        } else-->
<!--            return true;-->
<!--    }, "Space is not allowed");-->
<!--    $("#signupCustomerForm").validate({-->
<!--        rules:-->
<!--        {-->
<!--            address:-->
<!--            {-->
<!--                required:true,-->
<!--                minlength: 4-->
<!--            }-->
<!--        }-->
<!--    });-->
<!--</script>-->