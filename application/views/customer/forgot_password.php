<br><br><br><br><br>
<div class="yangon-container">
    <div class="container">
        <div class="al-table"
             <div class="al-table-col">
                <!--start forgot section-->
                <div class="al-right-contener  col-middle">
                    <form id="forgotCustomerForm" action="<?php echo base_url('customer/forgot_password') ?>" method="post" >
                        <input type="hidden" name="link" id="link" value="customer/checkEmailForPass">
                        <h1 class="al-right-contener-head">Forgot Password</h1>
                        <div class="al-right-content">
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
                            <ul class="al-right-filed-list my-account-section">
                                <li>
                                    <div class="alrft-col">Email <em>*</em></div>
                                    <div class="alrft-col">

                                        <input type="text" class="form-control required email checkExist" name="email" id="email" value="<?php echo @$email; ?>"/>
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
            <!-- End forgot Section -->
        </div>
    </div>
</div>
<!-- End Of Inner container -->	

