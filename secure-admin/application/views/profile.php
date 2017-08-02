<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() . 'dashboard'; ?>">Dashboard</a>
        </li>
        <li class="active"><?php echo "Edit " . $Module; ?></li>
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel">
                <header class="panel-heading">
                    <?php echo "Edit " . $Module; ?>
                </header>

                <div class="panel-body">
                    <?php if ($this->session->flashdata('addUpdMsg') != '') { ?>
                        <div class="alert alert-success" id="add_succ" data-es="Aquí se muestra el resultado del evento">
                            <?php echo '   <h6>' . $this->session->flashdata('addUpdMsg') . '</h6>'; ?>
                        </div>
                    <?php } ?>
                    <form id="userEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url() . 'account/profile'; ?>" enctype="multipart/form-data">

                        <input type="hidden" name="user_id" id="user_id" value="<?php echo @$user_id; ?>">


                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_name">First Name : </label>
                                <input type="text" name="first_name" id="first_name" class="form-control required"  value="<?php echo @$first_name; ?>"  placeholder="First Name" >
                            </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_name">Last Name : </label>
                                <input type="text" name="last_name" id="last_name" class="form-control required"  value="<?php echo @$last_name; ?>"  placeholder="Last Name" >
                            </div>
                            </div>

                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_email">Email : </label>
                                <input type="email" name="email" id="email" class="form-control required email" value="<?php echo @$email; ?>" placeholder="User Email"  onblur="checkEmail(this.value)" readonly="">

                                <label id="emailerror" class="error hidden" ></label>
                                <input type="hidden" name="hd2" id="hd2" value="<?php echo $this->session->userdata('admin_email'); ?>" /> 
                            </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_contact_no">Contact No : </label>
                                <input type="text" name="mobileno" id="mobileno" class="form-control required validatePhoneNo validateNoLeadingZero"  value="<?php echo @$mobileno; ?>" placeholder="User Mobileno"  >
                            </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                <label for="user_password">Password : </label>
                                <input type="password" name="user_password" id="user_password" maxlength="8" class="form-control noSpace" placeholder="User Password"  onchange="valueChange(this.value)">
                            </div>
                            </div>

                            <div class="col-md-6 col-sm-6 confirmPassword" >
                                <div class="bottom-spacing">
                                <label for="confirm_password">Confirm Password : </label>
                                <input type="password" name="confirm_password" id="confirm_password" class="form-control noSpace"  placeholder="Confirm Password" >
                            </div>
                            </div>
                        </div>
                        <input type="hidden" name="old_image" value="<?php echo @$image; ?>"/>
                        <div class="form-group clearfix">
                            <div class="frmgroup clearfix col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                                    <div class="bottom-spacing">
                                    <div class="form-group last">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Image Upload :</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width:200px; height:107px;">
                                                    <?php if (@$image != '' && file_exists(UPLOAD_ON_ROOT . '/users/' . @$image)) { ?>
                                                        <img src="<?php echo UPLOAD_URL_ROOT . '/users/' . @$image; ?>" >	
                                                    <?php } else { ?>
                                                        <img style="width:95px;" src="<?php echo IMAGE_URL . 'photos/default_user.png' ?>" alt="" />
                                                    <?php } ?>
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div class="galbtndiv col-md-12">
                                                    <p>Best image size : 200 x 200</p>
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
                        <input type="hidden" name="status" id="status" value="<?php echo @$status; ?>" />
                        <input type="hidden" name="group_id" id="group_id" value="<?php echo @$group_id; ?>" />
                        <div class="col-md-12 pd0 col-sm-12">
                            <div class="bottom-spacing">
                            <input value="Save" type="submit" id="submit" name="submit" class="btn btn-primary"/>
                            <a class="btn btn-default" href="<?php echo base_url('dashboard'); ?>"> Cancel</a>	
                        </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->

<script type="text/javascript">
    $('#submit').click(function () {
        if ($('#emailerror').text() == "user email already exist.")
        {
            $('#email').focus();
            return false;
        }
    });

    function checkEmail(demo)
    {
        if ($('#hd2').val() != demo)
        {
            user_id = $('#user_id').val();
            $.ajax({
                url: "<?php echo base_url() . 'users/checkName'; ?>",
                type: "POST",
                data: {email_id: demo, user_id: user_id},
                success: function (data) {
                    $('#emailerror').text(data);
                    if (data != '') {
                        $(this).focus();
                        $('#emailerror').removeClass('hidden');
                        $('#emailerror').css('display', 'block');
                        $('#email').val('');
                        return false;
                    } else {
                        $('#emailerror').addClass('hidden');
                        $('#email').removeClass('error');
                    }
                }
            });
        } else
        {
            $('#emailerror').text('');
            $('#emailerror').addClass('hidden');
        }
    }

    function valueChange(value)
    {
        $(".confirmPassword").addClass('required');
        $(".confirmPassword").css('display', 'block');
    }
</script> 
