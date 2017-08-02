<!-- page heading start-->

<div class="page-heading">

    <h3> <?php echo $Module; ?> </h3>

    <ul class="breadcrumb">

        <li>

            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>

        </li>

        <li>

            <a href="<?php echo base_url() . 'space'; ?>">View All <?php echo $Module; ?></a>

        </li>

        <li class="active"><?php echo ucfirst($action) . " " . $Module; ?></li>

    </ul>

</div>

<!-- page heading end-->

<?php if ($this->session->flashdata('spaceError') != '') { ?>

    <div class="alert alert-danger" id="del_succ" data-es="Aquí se muestra el resultado del evento">

        <?php echo '   <h6>' . $this->session->flashdata('spaceError') . '</h6>';
        $this->session->unset_userdata('spaceError');
        ?>

    </div>

<?php } ?>

<?php if ($this->session->flashdata('overlapError') != '') { ?>

    <div class="alert alert-danger" id="del_succ" data-es="Aquí se muestra el resultado del evento">

        <?php echo '   <h6>' . $this->session->flashdata('overlapError') . '</h6>';
        $this->session->unset_userdata('overlapError');
        ?>

    </div>

<?php } ?>

<?php
$postData = array();
if ($this->session->flashdata('inputError') != '') {
    $showData = $this->session->flashdata('inputError');
    $spaceData = $showData['spaceData'];
    //        echo "<pre/>";print_r($spaceData);
    $pageData = $showData['pageData'];
    $postData = $showData['post_data'];
    //    echo "<pre/>";print_r($postData);
}

?>

<!--body wrapper start-->

<div class="wrapper">

    <div class="row">

        <div class="col-md-12 ">

            <section class="panel">

                <header class="panel-heading">

                    <?php echo $action . " " . $Module; ?>

                </header>


                <div class="panel-body">
                    <form id="spaceEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post"
                          action="<?= base_url() . 'space/addedit'; ?>" enctype="multipart/form-data">

                        <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">
                        <!--{echo"<pre>"; print_r($spaceData); die;}-->
                        <?php if ($action == 'edit') { ?>
                            <input type="hidden" name="id" id="id" value="<?php echo $spaceData['space_id']; ?>">
                        <?php } ?>
                        <div class="form-group clearfix">
                            <div class="col-md-4 col-sm-4">

                                <label for="websiteList">Website : * </label>
                                <select class="form-control m-bot15 required" name="website_id" id="websiteList">
                                    <option value="">Select Website</option>
                                    <?php
                                    foreach ($websiteData as $web) {
                                        ?>
                                        <option value="<?php echo $web['id']; ?> "<?php
                                        if ($web['id'] == (int)$spaceData['website_id']) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $web['website_name']; ?></option>

                                    <?php } ?>

                                </select>

                            </div>

                            <div class="col-md-4 col-sm-4">

                                <label for="pageList">Pages : *</label>
                                <select class="form-control m-bot15 required" name="pageList" id="pageList">
                                    <option value="">Select Page</option>
                                    <?php
                                    $msg = "selected";
                                    foreach ($pageData as $page) {
                                        //if ($spaceData['website_id'] == $page['website_id']) {
                                        ?>
                                        <option value="<?php echo $page['page_id']; ?>"
                                            <?php if ($page['page_id'] == (int)$spaceData['page_id'])
                                                echo $msg;
                                            ?>>
                                            <?php echo $page['page_name']; ?>
                                        </option>

                                        <?php //}
                                    } ?>

                                </select>

                            </div>
                            <div class="col-md-4 bottom-spacing">
                                <label for="page">Space Name : *</label>
                                <input type="text" name="page" id="page" class="form-control required"
                                       value="<?php echo @$spaceData['page']; ?>" maxlength="100" placeholder="Space Name">
                            </div>
                        </div>
                        <div class="form-group clearfix">

                            <div class="col-md-8 col-sm-6">
                                <div class="bottom-spacing">
                                    <label for="website_url">Website Page URL : *</label>
                                    <input type="url" name="website_url" id="website_url" class="form-control required"
                                           value="<?php echo @$spaceData['web_url']; ?>" placeholder="Website Page URL">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">

                                <label for="status">Status : </label>

                                <?php
                                $status_array = array('0' => 'Inactive', '1' => 'Active');
                                $selected_value = '';

                                if ($action == 'edit') {

                                    $selected_value = $spaceData['status'];
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
                            <div class="col-md-12">
                                <label for="description">Description : *</label>
                                <textarea class="form-control ckeditor required" name="description" rows="6"
                                          id="description"><?php

                                    //if ($action == 'edit') {
                                    echo @$spaceData['description'];
                                    //}
                                    ?></textarea>
                            </div>

                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-4">
                                <label for="banner_width">Banner Width (px): *</label>
                                <input type="text" name="banner_width" id="banner_width"
                                       class="validWidth form-control required"
                                       value="<?php echo @$spaceData['banner_width']; ?>"
                                       placeholder="Banner Width">
                                <br>
                            </div>
                            <div class="col-md-4">
                                <label for="banner_height">Banner Height (px) : *</label>
                                <input type="text" name="banner_height" id="banner_height"
                                       class="validHeight form-control required"
                                       value="<?php echo @$spaceData['banner_height']; ?>"
                                       placeholder="Banner Height">
                            </div>

                        </div>

                        <input type="hidden" name="old_image" value="<?php echo @$spaceData['image_name']; ?>"/>
                        <div class="form-group clearfix">
                            <div class="frmgroup bottom-spacing clearfix col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                                    <div class="form-group last">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Image of Space : *</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail"
                                                     style="width:200px; height:107px;">
                                                    <?php if ($action == 'edit' && @$spaceData['image_name'] != '' && file_exists(UPLOAD_ON_ROOT . '/space/' . @$spaceData['image_name'])) { ?>
                                                        <img src="<?php echo UPLOAD_URL_ROOT . '/space/' . @$spaceData['image_name']; ?>">
                                                    <?php } else { ?>
                                                        <img style="width:95px;"
                                                             src="<?php echo IMAGE_URL . 'photos/default_user.png' ?>"
                                                             alt=""/>
                                                    <?php } ?>
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail"
                                                     style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div class="galbtndiv col-md-12">
                                                    <div class="row">
                                                        <p>Allowed File types are: jpg , jpeg , png , gif.</p>

                                                        <span></span>
                                                        <span class="btn btn-default btn-file">
                                                            <span class="fileupload-new"><i
                                                                        class="fa fa-paper-clip"></i> Upload image</span>
                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                            <input name="image" type="file"
                                                                   class="uploadLimit validateImage valid <?php if ($action == 'add')
                                                                       echo "required"; ?>"
                                                                   id="image">
                                                        </span>


                                                        <a href="#" class="btn btn-danger fileupload-exists"
                                                           data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-4">
                                <label for="base_price_per_hour">Base Price Per Hour (in <?php echo CURRENCY; ?>) : *</label>
                                <input type="text" name="base_price_per_hour" id="base_price_per_hour"
                                       class="form-control required"
                                       value="<?php echo @$spaceData['base_price_per_hour']; ?>"
                                       placeholder="Base Price per hour...">

                            </div>
                            <div class="col-md-4">
                                <label for="base_price_per_day">Base Price Per Day (in <?php echo CURRENCY; ?>) : *</label>
                                <input type="text" name="base_price_per_day" id="base_price_per_day"
                                       class="form-control required"
                                       value="<?php echo @$spaceData['base_price_per_day']; ?>"
                                       placeholder="Base Price per day...">
                                <br>
                            </div>
                        </div>


                        <?php if ($action == 'edit') {
                            //edit data
                            ?>
                            <div id="dynamic-div">
                                <?php
                                $k = 0;
                                if (!empty($salePriceData))
                                {
                                    foreach ($salePriceData as $data):
                                        ?>

                                        <div id="<?php echo "dyn" . $data['id'] ?>" class="row container form-group clearfix pd0 webpages">
                                            <input type="hidden" name="edit_sale_price_id[]"
                                                   value="<?php echo $data['id']; ?>"/>

                                            <div class="col-md-3">
                                                <label for="sale_price_per_hour<?= $k; ?>">Sale Price Per Hour (in <?php echo CURRENCY; ?>) :</label>
                                                <input type="text" name="edit_sale_price_per_hour[]"
                                                       id="sale_price_per_hour<?= $k; ?>"
                                                       class=" form-control"
                                                       value="<?php echo @$data['sale_price_per_hour']; ?>"
                                                       placeholder="Sale Price per hour">
                                            </div>

                                            <div class="col-md-3">
                                                <label for="sale_price_per_day<?= $k; ?>">Sale Price Per Day (in <?php echo CURRENCY; ?>) : </label>
                                                <input type="text" name="edit_sale_price_per_day[]"
                                                       id="sale_price_per_day<?= $k; ?>"
                                                       class=" form-control"
                                                       value="<?php echo @$data['sale_price_per_day']; ?>"
                                                       placeholder="Sale Price per day">
                                            </div>

                                            <div class="col-md-3 bottom-spacing">
                                                <label for="start<?= $k; ?> ">From:</label>
                                                <input autocomplete="off" type="text" name="edit_startdate[]"
                                                       class="form-control dpd1"
                                                       value="<?php echo date("d-m-Y", strtotime($data['start_date'])); ?>"
                                                       id="start<?= $k; ?>">

                                            </div>
                                            <div class="col-md-3">
                                                <label for="end<?= $k; ?>">To:</label>
                                                <input autocomplete="off" type="text" name="edit_enddate[]"
                                                       class="form-control to dpd2" data-count="<?php echo $k; ?>"
                                                       value="<?php echo date("d-m-Y", strtotime($data['end_date'])); ?>"
                                                       id="end<?= $k; ?>">
                                            </div>
                                            <div class="button-wrapper">
                                                <a class="remove_field1 btn btn-danger" href="javascript:;"
                                                   title="Delete" type="button" data-id="<?php echo $data['id']; ?>"
                                                   data-toggle="modal" data-target="#confirmDelete"
                                                   data-title="Delete Space"
                                                   data-message="Are you sure that you want to delete this space?">Remove</a>
                                            </div>

                                        </div>

                                        <?php
                                        $k++;
                                    endforeach;
                                } else {
                                    ?>
                                    <div class="row container pd0 form-group clearfix webpages">
                                        <div class="col-md-3">
                                            <label for="sale_price_per_hour">Sale Price per hour (in <?php echo CURRENCY; ?>):</label>
                                            <input type="text" name="sale_price_per_hour[]" id="sale_price_per_hour"
                                                   class="validPrice form-control "
                                                   value=""
                                                   placeholder="Sale Price per hour">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="sale_price_per_day">Sale Price Per Day(in <?php echo CURRENCY; ?>):</label>
                                            <input type="text" name="sale_price_per_day[]" id="sale_price_per_day"
                                                   class="validPrice form-control "
                                                   value=""
                                                   placeholder="Sale Price per day">
                                        </div>
                                        <div class="col-md-3 bottom-spacing">

                                            <label for="start">From:</label>
                                            <input autocomplete="off" type="text" name="startdate[]" class="form-control dpd1"
                                                   value="" id="start0">

                                        </div>
                                        <div class="col-md-3">
                                            <label for="end">To:</label>
                                            <input autocomplete="off" type="text" name="enddate[]" class="form-control to dpd2"
                                                   value="" id="end0">
                                        </div>
                                        <div class="button-wrapper">
                                            <a style="visibility:hidden;" href="javascript:void(0);" data-target="#del_space" data-count="0" data-toggle="modal" id="remove" class="btn btn-danger remove_field">Remove</a>
                                        </div>

                                    </div>

                                <?php } ?>
                            </div>
                        <?php } else { //add data
                            ?>
                            <div id="dynamic-div">
                                <?php if (!empty($postData) && isset($postData['sale_price_per_hour'])) {
                                    //                                echo "<pre>"; print_r($postData);
                                    $pi = -1;
                                    $hourlyPrice = $postData['sale_price_per_hour'];
                                    $dailyPrice = $postData['sale_price_per_day'];
                                    $start_date = $postData['startdate'];
                                    $end_date = $postData['enddate'];
                                    //                                echo "<pre>"; print_r($hourlyPrice);
                                    foreach ($hourlyPrice as $pkey => $pval) {
                                        $pi++;
                                        /*
                                            echo "<pre>"; print_r($hourlyPrice[$pkey]);echo "</pre>";
                                            echo "<pre>"; print_r($dailyPrice[$pkey]);echo "</pre>";
                                            echo "<pre>"; print_r($start_date[$pkey]);echo "</pre>";
                                            echo "<pre>"; print_r($end_date[$pkey]);echo "</pre>"; */
                                        ?>
                                        <div class="row container pd0 form-group clearfix webpages">
                                            <div class="col-md-3">
                                                <label for="sale_price_per_hour">Sale Price per hour (in <?php echo CURRENCY; ?>):</label>
                                                <input type="text" name="sale_price_per_hour[]" id="sale_price_per_hour"
                                                       class="validPrice form-control"
                                                       value="<?php echo $pval; ?>"
                                                       placeholder="Sale Price per hour">
                                            </div>
                                            <div class="col-md-3">
                                                <label for="sale_price_per_day">Sale Price Per Day(in <?php echo CURRENCY; ?>):</label>
                                                <input type="text" name="sale_price_per_day[]" id="sale_price_per_day"
                                                       class="validPrice form-control"
                                                       value="<?php echo $dailyPrice[ $pkey ]; ?>"
                                                       placeholder="Sale Price per day">
                                            </div>
                                            <div class="col-md-3 bottom-spacing">

                                                <label for="start">From:</label>
                                                <input autocomplete="off" type="text" name="startdate[]" class="form-control dpd1"
                                                       value="<?php echo $start_date[ $pkey ]; ?>" id="start<?php echo $pi; ?>">

                                            </div>
                                            <div class="col-md-3">
                                                <label for="end">To:</label>
                                                <input autocomplete="off" type="text" name="enddate[]" class="form-control to dpd2"
                                                       value="<?php echo $end_date[ $pkey ]; ?>" id="end<?php echo $pi; ?>">
                                            </div>
                                            <div class="button-wrapper">
                                                <a style="visibility:hidden;" href="javascript:void(0);" data-target="#del_space" data-count="<?php echo $pi; ?>" data-toggle="modal" id="remove" class="btn btn-danger remove_field">Remove</a>
                                            </div>

                                        </div>

                                        <?php
                                    }
                                    ?>


                                    <?php
                                } else { ?>
                                    <div class="row container pd0 form-group clearfix webpages">
                                        <div class="col-md-3">
                                            <label for="sale_price_per_hour">Sale Price per hour (in <?php echo CURRENCY; ?>):</label>
                                            <input type="text" name="sale_price_per_hour[]" id="sale_price_per_hour"
                                                   class="validPrice form-control"
                                                   value=""
                                                   placeholder="Sale Price per hour">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="sale_price_per_day">Sale Price Per Day(in <?php echo CURRENCY; ?>):</label>
                                            <input type="text" name="sale_price_per_day[]" id="sale_price_per_day"
                                                   class="validPrice form-control"
                                                   value=""
                                                   placeholder="Sale Price per day">
                                        </div>
                                        <div class="col-md-3 bottom-spacing">

                                            <label for="start">From:</label>
                                            <input autocomplete="off" type="text" name="startdate[]" class="form-control dpd1"
                                                   value="" id="start0">

                                        </div>
                                        <div class="col-md-3">
                                            <label for="end">To:</label>
                                            <input autocomplete="off" type="text" name="enddate[]" class="form-control to dpd2"
                                                   value="" id="end0">
                                        </div>
                                        <div class="button-wrapper">
                                            <a style="visibility:hidden;" href="javascript:void(0);" data-target="#del_space" data-count="0" data-toggle="modal" id="remove" class="btn btn-danger remove_field">Remove</a>
                                        </div>

                                    </div>

                                <?php } ?>
                            </div>
                            <?php
                            if (isset($pi) && $pi > -1) {
                                $k = $pi;
                            }
                        } ?>
                        <input type="hidden" name="cnt" id="cnt" value="<?php echo @$k; ?>"/>

                        <div class="col-md-12 pd0 col-sm-12">
                            <button type="button" id="addMore" class="btn btn-success">Add more</button>
                            <br>
                            <br>
                            <input value="Save" type="submit" id="submit" name="submit"
                                   class="btn btn-primary"/>

                            <a class="btn btn-default" href="<?php echo base_url() . 'space'; ?>"> Cancel</a>

                        </div>

                    </form>

                </div>

            </section>

        </div>

    </div>
</div>
<!--</div>-->
<!---->
<!--</div>-->

<!--body wrapper end-->

<!--THIS MODAL IS CREATED BECAUSE OF CONFLICT WITH AJAX REQUEST MODAL-->
<div class="modal fade" id="del_spc" role="dialog" aria-labelledby="labelConfirmDelete" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Delete Permanently</h4>
            </div>
            <div class="modal-body">
                <p>Are you sure about this?</p>
            </div>
            <!--            <input type="hidden" name="conf_remove_id" id="conf_remove_id" >-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default cancelSpcDelConf" data-dismiss="modal">Cancel</button>
                <a href="javascript:;" type="button" class="btn btn-danger" id="spcconf">Ok</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function noSpace() {
        $('input[id^=start]').keypress(function (e) {
            if (e.which === 32)
                return false;
        });
        $('input[id^=end]').keypress(function (e) {
            if (e.which === 32)
                return false;
        });
    }
    //        $('#del_space').find('.modal-footer #spaceConf').on('click', function () {
    //            $('#del_space').modal('hide');
    //        });
    $("#spaceEditForm").validate(
        {
//            ignore: [],
            rules: {
                'website_url': {
                    required: true,
                    url: true
                },
                'description': {
                    required: true,
                    minlength: 8
                },
                'base_price_per_hour': {
                    required: true,
                    min: 0.01
                },
                'base_price_per_day': {
                    required: true,
                    min: 0.01
                },
                'sale_price_per_hour[]': {
                    //required: true,
                    min: 0.01
                },
                'sale_price_per_day[]': {
                    //required: true,
                    min: 0.01
                },
                'banner_width': {
                    required: true,
                    min: 1
                },
                'banner_height': {
                    required: true,
                    min: 1
                }
            },
            messages: {
                'base_price_per_hour': {
                    required: "Please enter valid price.",
                    min: "Please enter valid price."
                },
                'base_price_per_day': {
                    required: "Please enter valid price.",
                    min: "Please enter valid price."
                },
                'banner_width': {
                    min: "Please enter a valid banner width/height."
                },
                'banner_height': {
                    min: "Please enter a valid banner width/height."
                },
                'sale_price_per_hour[]': {
                    min: "Please enter proper sale price."
                },
                'sale_price_per_day[]': {
                    min: "Please enter proper sale price."
                }
            }
        });
    function removeBtn() {
        var sale_count = $("#dynamic-div .webpages").length;
        console.log("Sale Count = " + sale_count);
        if (sale_count == 1)
        {
            $('#dynamic-div .btn-danger').css(
                {
//                    'visibility': 'hidden',
//                    'position': 'relative',
                    'visibility': 'inherit',
                    'position': 'relative',

//                    'left'       : '-40px',
                });
        } else {
//                alert('remove btn show');
            $('#dynamic-div .btn-danger').css({
                'visibility': 'inherit',
                'position': 'relative',
//                        'left'       : '-40px',
            });

        }
    }
    $('document').ready(function () {
        $('input[type=url]').keypress(function (e) {
            if (e.which === 32)
                return false;
        });

        jQuery.validator.addMethod("validWidth", function (value, element) {
            return this.optional(element) || /^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/i.test(value);
        }, "Please enter a valid banner width.");
        jQuery.validator.addMethod("validHeight", function (value, element) {
            return this.optional(element) || /^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/i.test(value);
        }, "Please enter a valid banner height.");
        jQuery.validator.addMethod("validPrice", function (value, element) {
            return this.optional(element) || /^(\-|\+)?([0-9]+(\.[0-9]+)?|Infinity)$/i.test(value);
        }, "Please enter a valid price.");


        var start = new Date();
//var end = new Date(new Date().setYear(start.getFullYear()+1));	

        $('.dpd1').datepicker({
            //timepicker:true,
            format: 'dd-mm-yyyy',
            startDate: start,
            //endDate   : end,
        }).on('changeDate', function () {
            var sdate = $(this).val();
            var dsplit = sdate.split("-");
            var sd = new Date(dsplit[2], dsplit[1] - 1, dsplit[0]);
            $('.dpd2').datepicker('setStartDate', new Date(sd));
        });

        $('.dpd2').datepicker({
            format: 'dd-mm-yyyy',
            //startDate : start,
            //endDate   : end
        }).on('changeDate', function () {
            var edate = $(this).val();
            var dsplit = edate.split("-");
            var ed = new Date(dsplit[2], dsplit[1] - 1, dsplit[0]);
            $('.dpd1').datepicker('setEndDate', new Date(ed));
        });


        var d = new Date();
//datetimepicker/datepicker
        /*$('#start0').datepicker({
         //format: 'yyyy-mm-dd',
         format: 'dd-mm-yyyy',
         startDate: d,
         //startView: "month",
         //maxView: "decade",
         autoclose: true,

         });
         $('#end0').datepicker({
         //format: 'yyyy-mm-dd',
         format: 'dd-mm-yyyy',
         startDate: d,
         startView: "month",
         //maxView: "decade",
         autoclose: true,
         //use24hours: true
         });*/


        /*$('#start0').change(function () {
         $('#end0').val('');
         $('#end0').datepicker('remove');

         var from_date = new Date($('#start0').val());

         $('#end0').datepicker(
         {
         startDate: from_date,

         startView: "month",
         maxView: "decade",
         });
         console.log(from_date);
         });*/


        var count = $("#cnt").val();

        /*if (count > 0) {
         var ii = 0;
         for (ii = 1; ii <= count; ii++) {
         (function (ii) {
         console.log($("#start" + ii).val());

         $('#start' + ii).datepicker({
         format: 'dd-mm-yyyy',
         startView: "month",
         maxView: "decade",
         autoclose: true,

         });
         $('#end' + ii).datepicker({
         format: 'dd-mm-yyyy',
         startView: "month",
         maxView: "decade",
         autoclose: true,
         });

         $('#start' + ii).change(function () {
         $('#end' + ii).val('');
         $('#end' + ii).datepicker('remove');

         var from_date = new Date($('#start' + ii).val());
         //                    var from_date = $("#start"+ii).val();
         console.log("New :" + from_date)

         $('#end' + ii).datepicker(
         {
         format: 'dd-mm-yyyy',
         startDate: from_date,
         startView: "month",
         maxView: "decade",
         autoclose: true,
         });
         });
         })(ii);

         }
         }*/


        removeBtn();
        noSpace();
        function addField() {
            count++;

//            var addMoreContent = '<div class="container form-group clearfix pd0"><div class=" col-sm-2 col-md-2 "><label for="sale_price'+count+'">Sale Price : *</label><input type="text" name="sale_price[]" id="sale_price'+count+'" class="form-control required" value="<?php //echo @$spaceData['sale_price']; ?>//" placeholder="Sale Price" ></div><div class="col-md-offset-2 col-md-3 bottom-spacing"><label for="start'+count+'">From:</label><input type="text" name="startdate[]" class="form-control required" value="<?php //@$spaceData['start_date'];?>//" id="start'+count+'"></div><div class="col-md-1"></div><div class="col-md-2"><label for="end">To:</label><input type="text" name="enddate[]" class="form-control required" <?php //@$spaceData['end_date'];?>// id="end'+count+'"> </div><div class="button-wrapper"><a id="remove'+count+'" class="remove_field btn btn-danger">Remove</a></div></div>';
//            var addMoreContent = '<div class="container pd0 form-group clearfix "><div class=" col-sm-2 col-md-2 "><label for="sale_price'+count+'">Sale Price : *</label><input type="text"name="sale_price[]"id="sale_price'+count+'"class="float form-control required"value=""placeholder="Sale Price"></div><div class="col-md-offset-2 col-md-3 bottom-spacing"><label for="start'+count+'">From:</label><input type="text" name="startdate[]"class="form-control required"value="<?php //@$spaceData['start_date'];?>//"id="start'+count+'"></div><div class="col-md-1"></div><div class="col-md-3"><label for="end">To:</label> <input type="text" name="enddate[]"class="form-control required"id="end'+count+'"></div><div class="button-wrapper"><a id="remove'+count+'" class="remove_field btn btn-danger">Remove</a></div></div>';
            var currency = "<?php echo CURRENCY; ?>";
            var addMoreContent = '<div class="row container pd0 form-group clearfix webpages"><div class="col-md-3 "><label for="sale_price_per_hour' + count + '">Sale Price per hour(in ' + currency + '): *</label><input type="text" name="sale_price_per_hour[]" id="sale_price_per_hour' + count + '"class="validPrice form-control required " value="" placeholder="Sale Price per hour"></div><div class="col-md-3"><label for="sale_price_per_day' + count + '">Sale Price Per Day(in ' + currency + '): *</label><input type="text" name="sale_price_per_day[]" id="sale_price_per_day' + count + '" class="validPrice form-control required" value="" placeholder="Sale Price per day"></div><div class="col-md-3 bottom-spacing"><label for="start' + count + '">From: *</label><input autocomplete="off" type="text" name="startdate[]"class="form-control required dpd1" value="" id="start' + count + '"></div><div class="col-md-3"><label for="end">To: *</label><input autocomplete="off" type="text" name="enddate[]" class="form-control required dpd2" id="end' + count + '"></div><div class="button-wrapper"><a href="javascript:void(0);" data-target="#del_space" data-toggle="modal"  id="remove' + count + '" data-count="remove' + count + '"  class="remove_field btn btn-danger to">Remove</a></div></div>';
            $("#dynamic-div").append(addMoreContent);
            console.log(count);
//            $("#dynamic-div").after(addMoreContent);
            removeBtn();

            var start = new Date();
//var end = new Date(new Date().setYear(start.getFullYear()+1));	

            $('.dpd1').datepicker({
                //timepicker:true,
                format: 'dd-mm-yyyy',
                startDate: start,
                //endDate   : end,
            }).on('changeDate', function () {
                var sdate = $(this).val();
                var dsplit = sdate.split("-");
                var sd = new Date(dsplit[2], dsplit[1] - 1, dsplit[0]);
                $('.dpd2').datepicker('setStartDate', new Date(sd));
            });

            $('.dpd2').datepicker({
                format: 'dd-mm-yyyy',
                //startDate : start,
                //endDate   : end
            }).on('changeDate', function () {
                var edate = $(this).val();
                var dsplit = edate.split("-");
                var ed = new Date(dsplit[2], dsplit[1] - 1, dsplit[0]);
                $('.dpd1').datepicker('setEndDate', new Date(ed));
            });


//            var from_date = $("#start"+count).val();

            /*$('#start' + count).datepicker({
             format: 'dd-mm-yyyy',
             startDate: d,
             startView: "month",
             maxView: "decade",
             autoclose: true,

             });
             $('#end' + count).datepicker({
             format: 'dd-mm-yyyy',
             startDate: d,
             startView: "month",
             maxView: "decade",
             autoclose: true,
             //                use24hours:true
             });


             $('#start' + count).change(function () {
             $('#end' + count).val('');
             $('#end' + count).datepicker('remove');

             var from_date = new Date($('#start' + count).val());

             $('#end' + count).datepicker(
             {
             //                startDate: d,
             format: 'dd-mm-yyyy',
             startView: "month",
             maxView: "decade",
             autoclose: true,
             startDate: from_date,
             });
             });*/

        }

        $("#addMore").click(function () {
            addField();
            removeBtn();
            noSpace();
        });

        $(".to").blur(function () {

        });

        $("#dynamic-div").on("click", ".remove_field", function (e) {   //user click on remove text
            let that = $(this);
            e.preventDefault();
            $('#del_spc').modal('show');
            $('#del_spc').find('.modal-footer .cancelSpcDelConf').on('click', function () {
                $('#del_spc').modal('hide');
            });
            $('#del_spc').find('.modal-footer #spcconf').on('click', function () {
                $(that).parent('div').parent('div').remove();
                removeBtn();
                $('#del_spc').modal('hide');
            });

            removeBtn();
            noSpace();
        });
        $('#confirm').click(function (e) {
            var dataString = $("#remove_id").val();
            console.log(dataString);
            $.ajax(
                {
                    url: "<?php echo base_url() . 'space/deleteSalePrice/' ?>",
                    type: 'POST',
                    data: {id: dataString},
                    async: false,
//                dataType: 'json',
                    success: function (data) {
                        $("#dyn" + dataString).remove();
                        removeBtn();
                    }
                });
        });
        $("#websiteList").change(function () {
            var dataString = $("select#websiteList option:checked").val();
            $.ajax(
                {
                    url: "<?php echo base_url() . 'space/getPageList/' ?>",
                    type: 'POST',
                    data: {id: dataString},
//                dataType: 'json',
                    success: function (result) {
                        $("#pageList").html('');
                        $("#pageList").append('<option value = ""> Select Page </option>');

                        var data = JSON.parse(result);

                        $.each(data, function (key, value) {
                            $('#pageList').append(
                                "<option value = '" + value.page_id + " '>" + value.page_name + " </option>"
                            );
                        });
                    }
                });

        });

    });


</script>