<?php
    $readonly = "readonly";
?>
<!-- page heading start-->
<div class="page-heading">
    <h3> <?php echo $Module; ?> </h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url('template'); ?>">View All <?php echo $Module; ?></a>
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
                    <form id="emailtemplateEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url('template/addEdit'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="emailtemplate_id" id="emailtemplate_id" value="<?php echo @$emailtemplate_id; ?>">
                        <div class="form-group clearfix">
                            <div class="col-md-4 col-sm-4">
                                <div class="bottom-spacing">
                                <label for="exampleInputEmail1">Template Name  : </label>
                                <input type="text" class="form-control required" <?php echo $readonly; ?> name="emailtemplate_name" id="emailtemplate_name" placeholder="Template Name" value="<?php echo @$emailtemplate_name ?>" maxlength="50"/>
                            </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="bottom-spacing">
                                <label for="emailtemplate_for">Template Key :</label>
                                <input type="text" class="form-control required" <?php echo $readonly; ?> name="emailtemplate_key" id="emailtemplate_key" placeholder="Template Name" value="<?php echo @$emailtemplate_key ?>" maxlength="50"/>
                            </div>
                            </div>
                            <div class="col-md-4 col-sm-4">
                                <div class="bottom-spacing">
                                <label for="exampleInputEmail1">Template Subject  : </label>
                                <input type="text" class="form-control required" name="emailtemplate_subject" id="emailtemplate_subject" placeholder="Email Subject" value="<?php echo @$emailtemplate_subject ?>" maxlength="50"/>
                            </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-12 col-sm-12">
                                <div class="bottom-spacing">
                                <label for="page_metadesc">Template Description : </label>
                                <textarea class="form-control ckeditor" name="emailtemplate_desc" id="emailtemplate_desc" rows="6"><?php echo @$emailtemplate_desc; ?></textarea>
                            </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="page_metadesc">Allowed Fields : </label>
                                <textarea class="form-control required" readonly="" name="allowedfields" id="allowedfields" rows="6"><?php echo @$allowedfields; ?></textarea>
                            </div>
                            </div>
                        </div>
                        <div class="col-md-12 pd0 col-sm-12">
                            <div class="bottom-spacing">
                            <input value="save" type="submit" id="submit" name="submit" class="btn btn-primary"/>
                            <a class="btn btn-default" href="<?php echo base_url('template'); ?>"> Cancel</a>
                        </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->