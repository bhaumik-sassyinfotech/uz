<?php

//$tab2 = ($profile_type == 2)?"active":"";
//print_r($this->session->flashdata('profile_type'));die;
//$ci = &get_instance();
if($this->session->flashdata('profile_type') == 1)
{
    $tab1 = "active";
} else
{
    $tab1 = "";
}

if($this->session->flashdata('profile_type') == 2)
{
    $tab2 = "active";
} else
{
    $tab2 = "";
}
if (empty($tab1) && empty($tab2))
    $tab1="active";

?>


<br><br><br><br><br><br><br>

<div class="yangon-container">
    <div class="container">
        <div class="al-table" id="myaccount">
            <div class="col-md-3 col-sm-3 col-xs-12">
                <div class="al-table-col">
                    <?php $this->load->view('templates/customerSidebar'); ?>
                </div>
            </div>
            <div class="col-md-9 col-sm-9 col-xs-12">
                <div class="al-table-col">
                <div class="my-account-tab">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="<?php echo $tab1; ?>"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile(Billing Information)</a></li>
                        <li role="presentation" class="<?php echo $tab2; ?>"><a href="#change-password " aria-controls="change-password" role="tab" data-toggle="tab">Change Password </a></li>
                    </ul>
                    <!-- Tab panes -->

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane <?php echo $tab1; ?>" id="profile">
                            <div class="al-right-contener">
                                <h1 class="al-right-contener-head">Profile</h1>
                                <input type="hidden" id="passError" value='<?php echo @$passerror; ?>'>
                                 <input type="hidden" name="link" id="link" value="customer/checkEmail">
                                <div class="al-right-content">
                                    <div class="col-md-12">
                                        <?php if ($this->session->flashdata('successMsg')) { ?>
                                            <div class="alert alert-success">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <?php echo $this->session->flashdata('successMsg'); ?>
                                            </div>
                                        <?php } ?>
                                        <?php if ($this->session->flashdata('errorMsg')) { ?>
                                            <div class="alert alert-danger">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <?php echo $this->session->flashdata('errorMsg'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <form id="myAccountFormCus" action  ="<?php echo base_url('customer/myaccount'); ?>" method="post" enctype="multipart/form-data">
                                        <ul class="al-right-filed-list my-account-section">
                                            <li>
                                                <div class="col-md-6">
                                                    <div class="alrft-col">First Name <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <input type="text" class="form-control required validateName checkOnlySpace" name="first_name" id="first_name" value="<?php echo @$first_name; ?>"/>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-6">
                                                    <div class="alrft-col">Last Name <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <input type="text" class="form-control  required validateName checkOnlySpace" name="last_name" id="last_name" value="<?php echo @$last_name; ?>"/>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-6">
                                                    <div class="alrft-col">Mobile No <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <input type="text" name="mobileno" class="form-control required validatePhoneNo validateNoLeadingZero checkOnlySpace" id="mobileno" value="<?php echo (@$mobile_no)?@$mobile_no:9; ?>"/>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-6">
                                                    <div class="alrft-col">Zipcode <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <input type="text" name="zip_code" id="zip_code"  class="noSpace form-control required checkOnlySpace" value="<?php echo $zip_code; ?>"/>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-12">
                                                    <div class="alrft-col">Address <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <textarea name="address" id="address" rows="10" cols="50" class="form-control checkOnlySpace"><?php echo $address; ?></textarea>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-6">
                                                    <div class="alrft-col">Country <em>*</em></div>
                                                    <div class="alrft-col">

                                                        <select class="form-control required" name="country" id="country">
                                                            <option value="">Select Country</option>

                                                            <?php
                                                            $msg = "";
                                                            $statess = array();

                                                            foreach ($countries as $ctry)
                                                            {
                                                                if( $country == $ctry['name'] )
                                                                {
                                                                    $msg = "selected";
                                                                    $statess = $this->spaceModel->getState($ctry['id']);
                                                                }
                                                                else
                                                                    $msg = "";
                                                            ?>

                                                                <option value="<?php echo $ctry['name']; ?>" <?php echo $msg; ?> data-cid="<?php echo $ctry['id']; ?>"><?php echo $ctry['name']; ?></option>
                                                            <?php }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-6">
                                                    <div class="alrft-col">State <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <select class="form-control required" name="state" id="state">
                                                            <option value="">Select Country First:</option>
                                                            <?php
                                                                $msg = "";
                                                                foreach ($statess as $st)
                                                                {
                                                                    if($st['name'] == $state)
                                                                    {
                                                                        $msg="selected";
                                                                    } else
                                                                    {
                                                                        $msg="";
                                                                    }
                                                            ?>
                                                                <option value="<?php echo $st['name']; ?>" <?php echo $msg; ?> ><?php echo $st['name']; ?></option>
                                                            <?php
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-6">
                                                    <div class="alrft-col">City <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <input type="text" name="city" id="city" class="form-control required checkOnlySpace" value="<?php echo $city; ?>"/>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-6">
                                                    <div class="alrft-col">Street <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <input type="text" name="street" id="street"  class="form-control required checkOnlySpace" value="<?php echo $street; ?>"/>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                        <div class="col-md-12">
                                            <div class="al-right-btn-wrapper">
                                                <div class="button"><button type="submit" class="btn-default">Submit</button></div>
                                                <div class="button"><button type="button" class="btn-default cancel" onclick="window.location.href = '<?php echo base_url() ?>'">Cancel</button></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane <?php echo $tab2; ?>" id="change-password">
                            <div class="al-right-contener">
                                <h1 class="al-right-contener-head">Change Password</h1>

                                <div class="al-right-content">
                                    <?php if ($this->session->flashdata('pwdSuccessMsg')) { ?>
                                        <div class="alert alert-success">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $this->session->flashdata('pwdSuccessMsg'); ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($this->session->flashdata('pwdErorMsg')) { ?>
                                        <div class="alert alert-danger">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <?php echo $this->session->flashdata('pwdErorMsg'); ?>
                                        </div>
                                    <?php } ?>
                                    <form id="changePasswordForm" action="<?php echo base_url('customer/changePassword') ?>" method="post" >
<!--                                    <form id="changePasswordForm" action="#" method="post" >-->
                                        <ul class="al-right-filed-list my-account-section">
                                            <li>
                                                <div class="col-md-12">
                                                    <div class="alrft-col">New Password <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <input type="password" class="form-control required noSpace checkOnlySpace" name="password" id="password" />
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="col-md-12">
                                                    <div class="alrft-col">Confirm Password <em>*</em></div>
                                                    <div class="alrft-col">
                                                        <input type="password" class="form-control required noSpace checkOnlySpace" name="confirm_password" id="confirm_password" />
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                        <div class="al-right-btn-wrapper">
                                            <div class="button"><button type="submit" class="btn btn-default">Submit</button></div>
                                            <div class="button"><button type="button" class="btn-default cancel" onclick="window.location.href = '<?php echo base_url() ?>'">Cancel</button></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#country').change(function ()
    {
//            var dataString = $("select#country option:checked").val();
//            var dataString = $("select#country option:checked").dataset.cid;
        var dataString = $("select#country").find(':selected').data('cid');

//            console.log("==="+dataString);
//            alert(dataString);
        $.ajax(
            {
                url: "<?php echo base_url() . 'space/getStates/' ?>",
                type: 'POST',
                data: {'country':dataString },
                success: function (result) {
                    $("#state").html('');
                    var data = JSON.parse(result);
                    $('#state').append(
                        '<option value = "">Select State </option>'
                    );
                    $.each(data, function (key, value) {
                        $('#state').append(
                            '<option value = "' + value.name + '">' + value.name + ' </option>'
                        );
                    });
                }
            });
    });
//$(document).ready(function () {
//    $("#country").trigger("change");
//});

</script>