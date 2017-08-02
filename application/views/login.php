<?php
$customer = ($login_type == 1) ? "active" : "";
$business = ($login_type == 2) ? "active" : "";
$cus_disp = ($login_type == 1) ? "display:block" : "display:none";
$busi_disp = ($login_type == 2) ? "display:block" : "display:none";
?>
<br><br><br><br><br>
<div class="yangon-container">
    <div class="container">
        <div class="login-section">		  
            <div>
                <!-- Nav tabs -->
                <!--<ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="<?php echo $customer ?>"><a href="#customer-login" aria-controls="customer-login" role="tab" data-toggle="tab">Customer Login</a></li>-->
<!--                    <li role="presentation" class="--><?php //echo $business ?><!--"><a href="#business-owner-login" aria-controls="business-owner-login" role="tab" data-toggle="tab">Business Owner Login</a></li>-->
                <!--</ul>-->
                <!-- Tab panes -->
                <div class="tab-content">
                    <!-- Customer Login Form -->				
                    <div role="tabpanel" class="tab-pane <?php echo $customer ?>" id="customer-login">
                        <div class="message" style="<?php echo $cus_disp ?>">
                            <?php if (@$errors != '') { ?>
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo @$errors; ?>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('errorMsg')) { ?>
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('errorMsg'); ?>
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('successMsg')) { ?>
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('successMsg'); ?>
                                </div>
                            <?php } ?>
                            <?php //if ($this->session->flashdata('successActivationMsg')) { ?>
                            <!--                                <div class="alert alert-success">
                                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php //echo $this->session->flashdata('successActivationMsg'); ?>
                                                            </div>-->
                            <?php //} ?>
                        </div>
                        <div class="login-containt">  
                            <form id="loginCustomerForm" action="<?php echo base_url('customer') ?>" method="post" >
                                <h1 class="al-right-contener-head">Customer Login</h1>
                                <div class="form-group">
                                    <div class="login-form-box">
                                        <span class="field-icon"><img src="<?php echo IMAGE_PATH ?>user-icon.png"/></span>
                                        <input type="text" placeholder="Enter Email" class="form-control checkOnlySpace required email_valid" name="email" id="email" value="<?php echo @$email; ?>"/>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="login-form-box">
                                        <span class="field-icon"><img src="<?php echo IMAGE_PATH ?>password-icon.png"/></span>
                                        <input type="password" placeholder="Enter Password" class="form-control required" name="password" id="password" />
                                    </div>
                                </div>
                                <div class="btn-row">
                                    <div class="sign-in-btn">
                                        <button type="submit" class="btn btn-default signin-btn">Login</button>
                                    </div>
                                </div>
                                <span class="forgot-pass-txt">
                                    <a style="color: #00aaee;" href="<?php echo base_url('customer/forgot_password') ?>">Forgot Password ?</a>
                                </span>
                            </form>
                        </div>
                    </div>

            </div>		  
        </div>
    </div>
</div>
<div class="modal fade yangon-new-popup" id="activationModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document"> 
        <div class="modal-content">
            <!--<div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>-->
            <div class="modal-body">
                <div class="yangon-new-pop-modal-bd-img">
                    <img src="<?php echo IMAGE_PATH . "logo.png"; ?>">
                </div>

                <div class="yangon-new-pop-modal-bd-head">
                    <h3>Your account is activated successfully.</h3>
                    <span class="">Thank you for choosing <?php echo SITE_TITLE; ?> </span>
                </div>
            </div>

        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        message = "<?php echo $this->session->flashdata('successActivationMsg') ?>";
    <?php if (isset($_SESSION['show_model']) && $_SESSION['show_model'] == 1) { ?>
            console.log(1);
    <?php } else { ?>
            if (message) {
                $('#activationModal').modal('show');
            }
    <?php $_SESSION['show_model'] = 1; } ?>
//        if (message) {
//            $('#activationModal').modal('show');
//        }
    });
</script>
