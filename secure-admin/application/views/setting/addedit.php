<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $title ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url('setting'); ?>"><?php echo $title ?></a>
        </li>
        <li class="active"><?php echo ucfirst($action) . " Setting"; ?></li>
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel">

                <header class="panel-heading">
                    <?php echo $action . ' Setting'; ?>
                </header>
                <form id="settingForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url('setting/addedit'); ?>">
            
                    <div class="panel-body">
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <label for="config_key">Name : </label>
                                <input type="text" name="config_key" id="config_key" class="form-control required"  placeholder="Config Name" value="<?php echo @$config_key; ?>" readonly="readonly">
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <label for="config_value">Value: </label>
                                <textarea name="config_value" id="config_value" class="form-control required <?php echo trim(@$config_validate); ?>"><?php echo trim(@$config_value); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-12 col-sm-12">
                                <label for="config_value"><?php echo trim(@$config_description); ?> </label>
                                <!--<textarea name="config_description" id="config_description" readonly="readonly" class="form-control required"><?php echo trim(@$config_description); ?></textarea>-->
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <input type="submit" name="add_config" id="add_config" value="Save" class="btn btn-primary">
                                <a href="<?php echo base_url('setting'); ?>" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

