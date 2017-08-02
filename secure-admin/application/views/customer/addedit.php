<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url('customer'); ?>">View All <?php echo $Module; ?></a>
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
                    <form id="customerEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url('customer/edit'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="uid" id="uid" value="<?php echo @$uid; ?>">
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                    <label for="user_name">First Name :* </label>
                                    <input type="text" name="first_name" id="first_name" class="form-control required validateName checkOnlySpace" value="<?php echo @$first_name; ?>" placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                    <label for="user_name">Last Name :* </label>
                                    <input type="text" name="last_name" id="last_name" class="form-control required validateName checkOnlySpace" value="<?php echo @$last_name; ?>" placeholder="Last Name">
                                </div>
                            </div>
                        </div>
                        <div class="form-group clearfix">

                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                    <label for="user_contact_no">Contact No :* </label>
                                    <input type="text" minlength="6" maxlength="16" name="mobile_no" id="mobile_no" class="form-control required validatePhoneNo" value="<?php echo @$mobile_no; ?>" placeholder="Contact Number">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6">

                                <label for="status">Status : </label>

                                <?php
                                $status_array = array('0' => 'Inactive', '1' => 'Active');
                                $selected_value = '';

                                if ($action == 'edit') {

                                    $selected_value = $status;
                                } else
                                    $selected_value = 1;
                                ?>

                                <select class="form-control m-bot15 required" name="status" id="status">
                                    <?php
                                    foreach ($status_array as $key => $value) {
                                        ?>
                                        <option value="<?php echo $key ?>" <?php
                                        if ($key == $selected_value) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-12 bottom-spacing">
                                <label for="address">Address : </label>
                                <textarea name="address" id="address" rows="5" cols="5" class="form-control"><?php echo $address; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="col-md-4 col-sm-4 bottom-spacing">
                                <label for="email">Email : </label>
                                <input class="form-control"  type="text" value="<?php echo $email;?>" name="email" id="email" disabled>
                            </div>
                            <div class="col-md-4 col-sm-4 bottom-spacing">
                                <label for="country">Country : </label>
                                <select class="form-control" name="country" id="country">
                                    <option value="">Select Country</option>

                                    <?php
                                    $msg = "";
                                    $statess = array();

                                    foreach ($countries as $ctry)
                                    {
                                        if( $country == $ctry['name'] )
                                        {
                                            $msg = "selected";
                                            $statess = $this->customer->getState($ctry['id']);
                                        }
                                        else
                                            $msg = "";
                                        ?>

                                        <option value="<?php echo $ctry['name']; ?>" <?php echo $msg; ?> data-cid="<?php echo $ctry['id']; ?>"><?php echo $ctry['name']; ?></option>
                                    <?php }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-4 col-sm-4 bottom-spacing">
                                <label for="state">State : </label>
                                <select class="form-control" name="state" id="state">
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
                        <div class="form-group clearfix">
                            <div class="col-md-4 col-sm-4 bottom-spacing">
                                <label for="city">City : </label>
                                <input type="text" name="city" id="city" class="form-control" value="<?php echo $city; ?>"/>
                            </div>
                            <div class="col-md-4 col-sm-4 bottom-spacing">
                                <label for="street">Street : </label>
                                <input type="text" name="street" id="street"  class="form-control" value="<?php echo $street; ?>"/>
                            </div>
                            <div class="col-md-4 col-sm-4 bottom-spacing">
                                <label for="zip_code">Zipcode : </label>
                                <input type="text" name="zip_code" id="zip_code"  class="form-control" value="<?php echo $zip_code; ?>"/>
                            </div>
                        </div>
                </div>

                <div class="col-md-12 pd0 col-sm-12">
                    <input value="Save" type="submit" id="submit" name="submit" class="btn btn-primary"/>
                    <a class="btn btn-default" href="<?php echo base_url('customer'); ?>"> Cancel</a>
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
        $("#mobileno").blur(function () {
            temp = $("#mobileno").val();
            data = temp.replace(/\D/g, '');
            $("#mobileno").val(data);
        });
        $('#country').change(function ()
        {
//            var dataString = $("select#country option:checked").val();
//            var dataString = $("select#country option:checked").dataset.cid;
            var dataString = $("select#country").find(':selected').data('cid');

//            console.log("==="+dataString);
//            alert(dataString);
            $.ajax(
                {
                    url: "<?php echo base_url() . 'customer/getStates/' ?>",
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
    });

</script>
<!---->
<!--<div class="form-group clearfix">-->
<!--    <div class="col-md-6 col-sm-6">-->
<!--        <div class="bottom-spacing">-->
<!--            <label for="user_password">Password :* </label>-->
<!--            <input type="password" name="user_password" id="user_password" class="form-control --><?php //if ($action == 'add') { echo "required"; } ?><!--" placeholder="Password" --><?php //if ($action == 'edit') { ?><!-- onchange="valueChange(this.value)" --><?php //} ?><!-- >-->
<!--        </div>-->
<!--    </div>-->
<!--    <div class="col-md-6 col-sm-6 confirmPassword" >-->
<!--        <div class="bottom-spacing">-->
<!--            <label for="confirm_password">Confirm Password :* </label>-->
<!--            <input type="password" name="confirm_password" id="confirm_password"  class="form-control --><?php //if ($action == 'add') { echo "required"; } ?><!--""  placeholder="Confirm Password" >-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<!--                            <div class="col-md-6 col-sm-6">-->
<!--                                <div class="bottom-spacing">-->
<!--                                <label for="user_email">Email :* </label>-->
<!--                                <input type="email" name="email" id="email" class="form-control required email checkAlreadyExist" value="--><?php //echo @$email; ?><!--" placeholder="Email" -->
<?php //echo ($this->session->userdata('admin_id') == @$user_id) ? 'readOnly' : ''; ?><!-- >-->
<!--                                <input type="hidden" name="unique_id" id="unique_id" value="user_id" />-->
<!--                                <input type="hidden" name="link" id="link" value="users/checkEmail" />-->
<!--                            </div>-->