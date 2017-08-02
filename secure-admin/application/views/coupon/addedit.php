<?php
$setValidation = (@$couponData['coupon_type'] == "percentage" || $action == "add") ? "min=0 max=100" : '';
?>
<!-- page heading start-->

<div class="page-heading">

    <h3> <?php echo $Module; ?> </h3>

    <ul class="breadcrumb">

        <li>

            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>

        </li>

        <li>

            <a href="<?php echo base_url() . 'coupons'; ?>">View All <?php echo $Module; ?></a>

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

                    <form id="couponEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url() . 'coupons/addedit'; ?>" enctype="multipart/form-data">

                        <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">


                        <?php if ($action == 'edit') { ?>

                            <input type="hidden" name="coupon_id" id="coupon_id" value="<?php echo $couponData['coupon_id']; ?>">

                        <?php } ?>


                        <div class="form-group clearfix">

                            <div class="col-md-4 col-sm-6">

                                <label for="coupon_name">Name:* </label>

                                <input type="text" class="form-control required" name="coupon_name" id="coupon_name" value="<?php
                                if ($action == 'edit') {
                                    echo htmlspecialchars($couponData['coupon_name']);
                                }
                                ?>" placeholder="Name" maxlength="50"/>

                            </div>


                            <div class="col-md-4 col-sm-6">

                                <label for="coupon_code">Code:* </label>

                                <input type="text" class="form-control required" name="coupon_code" id="coupon_code" value="<?php
                                if ($action == 'edit') {
                                    echo htmlspecialchars($couponData['coupon_code']);
                                }
                                ?>" placeholder="Code" maxlength="10" onblur="checkCode(this.value)"/>


                                <label id="codeerror" class="error hidden"></label>

                                <input type="hidden" name="co2" id="co2" value="<?php
                                if ($action == 'edit') {
                                    echo htmlspecialchars($couponData['coupon_code']);
                                }
                                ?>"/>

                            </div>

                        </div>


                        <div class="form-group clearfix">

                            <div class="col-md-4 col-sm-6">

                                <label>Start / End Date: * </label>

                                <div class="input-group input-large custom-date-range customFieldSet">

                                    <input readonly type="text" class="form-control dpd1 required" name="coupon_startdate" id="coupon_startdate" value="<?php if ($action == 'edit') {echo date("d-m-Y", strtotime($couponData['coupon_startdate'])); } ?>">

                                    <span class="input-group-addon">To</span>

                                    <input readonly type="text" class="form-control dpd2 required" name="coupon_enddate" id="coupon_enddate" value="<?php if ($action == 'edit') { echo date("d-m-Y", strtotime($couponData['coupon_enddate'])); } ?>">

                                </div>

                            </div>


                            <div class="col-md-4 col-sm-6">

                                <label for="coupon_discount">Discount:* </label>

                                <input type="text" maxlength="8" class="form-control required number" <?php echo $setValidation; ?> name="coupon_discount"  id="coupon_discount" value="<?php if ($action == 'edit') { echo $couponData['coupon_discount']; } ?>" placeholder="Discount"/>

                            </div>


                            <input type="hidden" name="old_coupon_type" id="old_coupon_type" value="<?php echo @$couponData['coupon_type'] ?>">
                            <div class="col-md-1 col-sm-4 dis-type-width ">

                                <label for="coupon_type">Type:* </label>

                                <select class="form-control m-bot15 fa-select" name="coupon_type" id="coupon_type" <?php if ($action == "edit") { ?> disabled="disabled"  <?php } ?>>

                                    <?php
                                    $discount_type = json_decode(discount_type, true);


                                    foreach ($discount_type as $key => $value) {

                                        $selected = false;

                                        if ($action == "edit") {

                                            if ($key == $couponData['coupon_type']) {

                                                $selected = true;
                                            }
                                        }
                                        ?>

                                        <option value="<?php echo $key; ?>" <?php
                                        if ($selected) {
                                            echo "selected";
                                        }
                                        ?> ><?php echo $value; ?></option>

                                        <?php
                                    }
                                    ?>

                                </select>

                            </div>

                        </div>


                        <div class="form-group clearfix">

                            <div class="col-md-12">

                                <label for="coupon_description">Description :* </label>

                                <textarea class="form-control ckeditor" name="coupon_description" rows="6" id="coupon_description"><?php
                                    if ($action == 'edit') {
                                        echo $couponData['coupon_description'];
                                    }
                                    ?></textarea>

                            </div>

                        </div>


                        <div class="form-group clearfix">

                            <div class="col-md-4 col-sm-4">

                                <label for="coupon_limit">No. Of Use :* </label>
                                <?php
                                if ($action == 'edit')
                                    $per = "readonly"; else
                                    $per = "";
                                ?>
                                <input type="number" min="1" class="form-control digits required" <?php echo $per; ?> name="coupon_limit" id="coupon_limit" value="<?php
                                if ($action == 'edit') {
                                    echo $couponData['coupon_limit'];
                                }
                                ?>" placeholder="Limit"/>

                            </div>


                            <div class="col-md-4 col-sm-4">

                                <label for="CouponStatus">Status :* </label>

                                <?php
                                $status_array = array('0' => 'Inactive', '1' => 'Active');

                                $selected_value = '';

                                if ($action == 'edit') {

                                    $selected_value = $couponData['coupon_status'];
                                } else
                                    $selected_value = 1;
                                ?>

                                <select class="form-control m-bot15 required" name="coupon_status" id="coupon_status">

                                    <!--<option value="">Select</option>-->

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


                            <!--<div class="col-md-4 col-sm-4">

                                <label for="coupon_type">Type : </label>

                                <input type="text" class="form-control" name="coupon_type" id="coupon_type" value="<?php
                            if ($action == 'edit') {
                                echo htmlspecialchars($couponData['coupon_type']);
                            }
                            ?>" placeholder="Type" />

                            </div>-->

                        </div>


                        <div class="col-md-12 pd0 col-sm-12">

                            <input value="save" type="submit" id="submit" name="submit" class="btn btn-primary"/>

                            <a class="btn btn-default" href="<?php echo base_url() . 'coupons'; ?>"> Cancel</a>

                        </div>

                    </form>

                </div>

            </section>

        </div>

    </div>

</div>

<!--body wrapper end-->


<script type="text/javascript">

    $('#coupon_type').change(function () {
        selectType = $(this).val();
        if (selectType == "percentage") {
            $('#coupon_discount').attr('min', 0);
            $('#coupon_discount').attr('max', 100);
        } else {
            $('#coupon_discount').removeAttr('min');
            $('#coupon_discount').removeAttr('max');
        }

    });

    $('#submit').click(function () {

        if ($('#codeerror').text() == "Code already exist.") {

            $('#coupon_code').focus();

            return false;

        }

    });


    function checkCode(demo) {

        if ($('#co2').val() != demo) {

            $.ajax({
                url: "<?php echo base_url() . 'coupons/checkCode'; ?>",
                type: "POST",
                data: {id: demo},
                success: function (data) {

                    $('#codeerror').text(data);

                    if (data != '') {

                        $(this).focus();

                        $('#codeerror').removeClass('hidden');

                        $('#codeerror').css('display', 'block');

                        $('#coupon_code').val('');

                    } else {

                        $('#codeerror').addClass('hidden');

                    }

                }

            });

        } else {

            $('#codeerror').text('');

            $('#codeerror').addClass('hidden');

        }

    }

</script>