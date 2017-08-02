<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url('client_testimonial'); ?>">View All <?php echo $Module; ?></a>
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
                    <form id="client_testimonialEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url('client_testimonial/addEdit'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?php echo @$id; ?>">
                        <div class="form-group clearfix">
                            <div class="col-md-12 col-sm-12">
								<div class="bottom-spacing">
									<label for="user_name">Full Name  : </label>
									<input type="text" name="name" id="name" class="form-control required" value="<?php echo @$name; ?>" placeholder="Full Name" >
								</div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_email">Place : </label>
                                <input type="text" name="place" id="place" class="form-control required" value="<?php echo @$place; ?>" placeholder="Place" >
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
									<div class="inline-cont-wrp margin-top-22">
										<label for="user_active">Is View : </label>
										<?php
										$Editview = 1;
										if ($action == 'edit') {
											$Editview = @$is_view;
										}
										?>
										<label class="radio-inline">
											<input type="radio" name="is_view"  value="1" <?php if ($Editview == 1) { echo 'checked'; }?> >Yes
										</label>
										<label class="radio-inline">
											<input type="radio" name="is_view" value="0" <?php if ($Editview == 0) { echo 'checked'; }?> >No
										</label>
									</div>
								</div>
							</div>
                        </div>
                        <div class="form-group clearfix">
                             <div class="col-md-12 col-sm-12">
                                <div class="bottom-spacing">
									<label for="user_contact_no">Description : </label>
									<textarea name="description" id="description" class="form-control required" placeholder="Description"><?php echo @$description; ?></textarea>
								</div>
                            </div>
                        </div>
                        <div class="col-md-12 pd0 col-sm-12">
                            <input value="Save" type="submit" id="submit" name="submit" class="btn btn-primary"/>
                            <a class="btn btn-default" href="<?php echo base_url('clients_testimonial'); ?>"> Cancel</a>	
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
