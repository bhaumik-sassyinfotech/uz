<!-- page heading start-->
<div class="page-heading">
    <h3>
        <?php echo $Module; ?>
    </h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li class="active">  Edit <?php echo $Module; ?></li>
    </ul>

</div>
<!-- page heading end-->
<?php if ($this->session->flashdata('EditSuccMsg') != '') {
    ?>
    <div class="alert alert-success" id="edit_succ" data-es="Aqu� se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('EditSuccMsg') . '</h6>'; ?>
    </div> <?php } ?>

<!-- page heading end-->
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel">
                <header class="panel-heading">
                    Edit  <?php echo $Module; ?> Detail
                </header>
                <div class="panel-body">
                    <form id="configEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url() . 'config/addedit'; ?>">
                        <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">

                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <label for="site_title">Site Title : </label>
                                <input type="text" name="site_title" id="site_title" class="form-control required" value="<?php echo htmlspecialchars($configData['site_title']); ?>" placeholder="Site Title" >
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <label for="copyright_text">Copyright Text : </label>
                                <input type="text" name="copyright_text" id="copyright_text" class="form-control required" value="<?php echo htmlspecialchars($configData['copyright_text']); ?>" placeholder="Copyright Text" >
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <label for="facebook_url">Facebook Url : </label>
                                <input type="text" name="facebook_url" id="facebook_url" class="form-control url" value="<?php echo $configData['facebook_url']; ?>" placeholder="Facebook Url" >
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <label for="twitter_url">Twitter Url : </label>
                                <input type="text" name="twitter_url" id="twitter_url" class="form-control url" value="<?php echo $configData['twitter_url']; ?>" placeholder="Twitter Url" >
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <label for="instagram_url">Google+ : </label>
                                <input type="text" name="googleplus_url" id="instagram_url" class="form-control url" value="<?php echo $configData['googleplus_url']; ?>" placeholder="Instagram Url" >
                            </div>

                            
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-4 col-sm-4">
                                <label for="admin_email">Admin Email : </label>
                                <input type="text" name="admin_email" id="admin_email" class="form-control required email" value="<?php echo $configData['admin_email']; ?>" placeholder="Admin Email" >
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label for="contact_email">Contact Email : </label>
                                <input type="text" name="contact_email" id="contact_email" class="form-control required email" value="<?php echo $configData['contact_email']; ?>" placeholder="Contact Email" >
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <label for="support_email">Support Email : </label>
                                <input type="text" name="support_email" id="support_email" class="form-control required email" value="<?php echo $configData['support_email']; ?>" placeholder="Support Email" >
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <label for="site_meta_keyword">Meta Keyword : </label>
                                <input type="text" class="form-control required" name="site_meta_keyword" id="site_meta_keyword" value="<?php echo htmlspecialchars($configData['site_meta_keyword']); ?>" placeholder="Meta Keyword " />
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <label for="site_meta_keyword">Customer Care Number : </label>
                                <input type="text" class="form-control required" name="customer_care_no" id="customer_care_no" value="<?php echo $configData['customer_care_no']; ?>" placeholder="Customer Care Number" />
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-12 col-sm-12">
                                <label for="site_meta_desc">Meta Description : </label>
                                <textarea class="form-control ckeditor required" name="site_meta_desc" rows="6" id="site_meta_desc"><?php echo $configData['site_meta_desc']; ?></textarea>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <label for="site_address">Address : </label>
                                <input type="text" name="site_address" id="site_address" class="form-control required" value="<?php echo htmlspecialchars($configData['site_address']); ?>" placeholder="Address" >
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <label for="map_address">Map Address : </label>
                                <input type="text" name="map_address" id="map_address" class="form-control required" value="<?php echo htmlspecialchars($configData['map_address']); ?>" placeholder="Map Address" >
                            </div>
                        </div>

                      

                        <div class="col-md-12 pd0 col-sm-12">
                            <button type="submit" id="submit" name="submit" class="btn btn-primary">save</button>
                            <a class="btn btn-default" href="<?php echo base_url() . 'config'; ?>"> Cancel</a>	
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->  