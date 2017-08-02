<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url('website'); ?>">View All <?php echo $Module; ?></a>
        </li>
        <li class="active"><?php echo ucfirst($action) . " " . $Module; ?></li>
    </ul>
</div>
<!-- page heading end-->
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel">
                <header class="panel-heading">
                    <?php echo $action . " " . $Module; ?>
                </header>
                <div class="panel-body">
                    <form id="mentorEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url('website/addEdit'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?php echo @$id; ?>">
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
								<div class="bottom-spacing">
									<label for="user_name">Website Name  : </label>
									<input type="text" name="website_name" id="website_name" class="form-control required" value="<?php echo @$website_name; ?>" placeholder="Website Name" >
								</div>
                            </div>
                        </div>

                            <div class="form-group clearfix">
                                <div class="col-md-6 col-sm-6">
                                    <div class="bottom-spacing">
                                        <label for="user_email">Website URL : </label>
                                        <input type="text" name="website_url" id="website_url" class="form-control required" value="<?php echo @$website_url; ?>" placeholder="Website URL" >
                                     </div>
                                </div>
                            </div>

                        <input type="hidden" name="old_image" value="<?php echo @$image; ?>"/>
                        <div class="form-group clearfix">
                            <div class="frmgroup clearfix col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                                    <div class="form-group last">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Image Upload :</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width:200px; height:107px;">
                                                    <?php if ($action == 'edit' && @$image != '' && file_exists(UPLOAD_ON_ROOT .'/website/'. @$image)) { ?>
                                                        <img src="<?php echo UPLOAD_URL_ROOT .'/website/'. @$image; ?>" >	
                                                    <?php } else { ?>
                                                        <img style="width:95px;" src="<?php echo IMAGE_URL . 'photos/default_user.png' ?>" alt="" />
                                                    <?php } ?>
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div class="galbtndiv col-md-12">
                                                   <div class="row">
                                                   
                                                    <p>Best image size : 212 x 212</p>
                                                    <span class="btn btn-default btn-file">
                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Upload image</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        <input name="image" type="file" class="uploadLimit validateImage valid required" id="image">
                                                    </span>
                                                    <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 pd0 col-sm-12">
                            <input value="Save" type="submit" id="submit" name="submit" class="btn btn-primary"/>
                            <a class="btn btn-default" href="<?php echo base_url('website'); ?>"> Cancel</a>	
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
