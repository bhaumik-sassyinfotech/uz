<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url('users'); ?>">View All <?php echo $Module; ?></a>
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
                    <form id="userEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url('users/addEdit'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="user_id" id="user_id" value="<?php echo @$user_id; ?>">
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                               <div class="bottom-spacing">
                                <label for="user_name">First Name :* </label>
                                <input type="text" name="first_name" id="first_name" class="form-control required" value="<?php echo @$first_name; ?>" placeholder="First Name" >
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                               <div class="bottom-spacing">
                                <label for="user_name">Last Name :* </label>
                                <input type="text" name="last_name" id="last_name" class="form-control required" value="<?php echo @$last_name; ?>" placeholder="Last Name" >
                            </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_email">Email :* </label>
                                <input type="email" name="email" id="email" class="form-control required email checkAlreadyExist" value="<?php echo @$email; ?>" placeholder="Email" <?php echo ($this->session->userdata('admin_id') == @$user_id) ? 'readOnly' : ''; ?> >
                                <input type="hidden" name="unique_id" id="unique_id" value="user_id" />
                                <input type="hidden" name="link" id="link" value="users/checkEmail" />
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_contact_no">Contact No :* </label>
                                <input type="text" name="mobileno" id="mobileno" class="form-control required validatePhoneNo validateNoLeadingZero"  value="<?php echo @$mobileno; ?>" placeholder="Contact Number">
                            </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_password">Password :* </label>
                                <input type="password" name="user_password" id="user_password" class="form-control <?php if ($action == 'add') { echo "required"; } ?>" placeholder="Password" <?php if ($action == 'edit') { ?> onchange="valueChange(this.value)" <?php } ?> >
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-6 confirmPassword" >
                                <div class="bottom-spacing">
                                <label for="confirm_password">Confirm Password :* </label>
                                <input type="password" name="confirm_password" id="confirm_password"  class="form-control <?php if ($action == 'add') { echo "required"; } ?>""  placeholder="Confirm Password" >
                            </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_group">User Group :* </label>
                                <select class="form-control required" name="group_id" id="group_id">
                                    <option value="" >Select Group</option>
                                    <?php foreach ($groupData as $groups) { ?>
                                        <option value="<?php echo $groups['group_id']; ?>" <?php
                                        if ($groups['group_id'] == @$group_id) {
                                            echo "selected";
                                        }
                                        ?> ><?php echo @$groups['group_name']; ?></option>
                                            <?php } ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <div class="inline-cont-wrp margin-top-22">
                                <label for="user_active">Status :*</label>
                                <?php
                                $Editstatus = 1;
                                if ($action == 'edit') {
                                    $Editstatus = @$status;
                                }
                                ?>
                                <label class="radio-inline">
                                    <input type="radio" name="status"  value="1" <?php
                                    if ($Editstatus == 1) {
                                        echo 'checked';
                                    }
                                    ?> >Active
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status" value="0" <?php
                                    if ($Editstatus == 0) {
                                        echo 'checked';
                                    }
                                    ?> >In Active
                                </label>
                            </div>
                            </div>
                        </div> 
                        </div> 
                        <input type="hidden" name="old_image" value="<?php echo @$image; ?>"/>
                        <div class="form-group clearfix">
                            <div class="frmgroup clearfix col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                                    <div class="form-group last">
                                        <label class="col-md-12 col-sm-12 col-xs-12">User Image:</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width:200px; height:107px;">
                                                    <?php if ($action == 'edit' && @$image != '' && file_exists(UPLOAD_ON_ROOT .'/users/'. @$image)) { ?>
                                                        <img src="<?php echo UPLOAD_URL_ROOT .'/users/'. @$image; ?>" >	
                                                    <?php } else { ?>
                                                        <img style="width:95px;" src="<?php echo IMAGE_URL . 'photos/default_user.png' ?>" alt="" />
                                                    <?php } ?>
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div class="galbtndiv col-md-12">
                                                   <div class="row">
                                                       <p>Allowed File types are: jpg , jpeg , png , gif.</p>
                                                       <span class="btn btn-default btn-file">
                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Upload image</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        <input name="image" type="file" class="imageonly uploadLimit" id="image">
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
                            <a class="btn btn-default" href="<?php echo base_url('users'); ?>"> Cancel</a>	
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

<script>
    $(document).ready(function () {
        $("#mobileno").blur(function ()
        {
            temp = $("#mobileno").val();
            data = temp.replace(/\D/g,'');
            $("#mobileno").val(data);
        });
    });
</script>