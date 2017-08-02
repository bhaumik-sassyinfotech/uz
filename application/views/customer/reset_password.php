<!-- Start Of Inner container -->
<br><br><br><br><br>
<div class="yangon-container">
    <div class="container">
        <!--start reset section-->
        <!--<div class="reset-note">
                          <b>Reset Password link has been expired</b>
        </div>-->

        <div class="al-table">
             <div class="al-table-col">

                <div class="al-right-contener  col-middle">

                    <form id="resetPassCustomerForm" action="<?php echo base_url('customer/reset_password') ?>" method="post" >
                        <h1 class="al-right-contener-head">Reset Password</h1>
                        <div class="al-right-content">
                            <?php if ($this->session->flashdata('successMsg')) { ?>
                                <div class="alert alert-danger">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('successMsg'); ?>
                                </div>
                            <?php } ?>

                            <?php if ($this->session->flashdata('successMsg')) { ?>
                                <div class="alert alert-success">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $this->session->flashdata('successMsg'); ?>
                                </div>
                            <?php } ?>
                            <ul class="al-right-filed-list my-account-section">
                                <li>
                                    <div class="alrft-col">Email <em>*</em></div>
                                    <div class="alrft-col">
                                        <input type="text" readonly="" class="form-control" name="email" id="email" value="<?php echo @$email; ?>"/>
                                    </div>
                                </li>
                                <li>
                                    <div class="alrft-col">Password <em>*</em></div>
                                    <div class="alrft-col">
                                        <input type="password" class="form-control required checkOnlySpace noSpace" name="password" id="password" />
                                    </div>
                                </li>
                                <li>
                                    <div class="alrft-col">Confirm Password <em>*</em></div>
                                    <div class="alrft-col">
                                        <input type="password" class="form-control required checkOnlySpace noSpace" name="confirm_password" id="confirm_password" />
                                    </div>
                                </li>
                            </ul>
                            <div class="al-right-btn-wrapper">
                                <div class="button"><button type="submit" value="submit" name="submit" class="btn-default">Submit</button></div>
                                <div class="button"><button type="button" value="cancel" name="cancel" class="btn-default cancel" onclick="window.location.href = '<?php echo base_url() ?>'">Cancel</button></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End reset Section -->
        </div>
    </div>
    <!-- End Of Inner container -->
</div>
<script>
    $("#resetPassCustomerForm").validate({
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
            }
        },
        messages:
        {
            confirm_password:
            {
                minlength:"Password should be of minimum 6 characters.",
                equalTo: "Please enter same password."
            }
        }
});
</script>