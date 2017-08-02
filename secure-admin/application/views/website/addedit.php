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

<?php
$postData = array();
if ($this->session->flashdata('inputError') != '')
{
    $showData    = $this->session->flashdata('inputError');

    $websiteData = $showData['post_data'];
    $pagesData   = $showData['post_data']['page_name'];
//    echo "<pre/>";print_r($pagesData);

}
?>

<?php if ($this->session->flashdata('succMsg') != '') { ?>

    <div class="alert alert-success" id="add_succ" data-es="Aquí se muestra el resultado del evento">

        <?php echo '   <h6>' . $this->session->flashdata('succMsg') . '</h6>';
        $this->session->unset_userdata('succMsg');

        ?>

    </div>

<?php } ?>

<?php if ($this->session->flashdata('errorMsg') != '') { ?>

    <div class="alert alert-danger" id="del_succ" data-es="Aquí se muestra el resultado del evento">

        <?php echo '   <h6>' . $this->session->flashdata('errorMsg') . '</h6>';
        $this->session->unset_userdata('errorMsg');
        ?>

    </div>

<?php } ?>

<div class="wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel">
                <header class="panel-heading">
                    <?php echo $action . " " . $Module; ?>
                </header>
                <div class="panel-body">
                    <form name="websiteForm" id="websiteForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url('website/addEdit'); ?>" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?php echo @$websiteData['id']; ?>">
                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                    <label for="website_name">Website Name: *</label>
                                    <input type="text" name="website_name" id="website_name" class="validName form-control required" value="<?php echo @$websiteData['website_name']; ?>" placeholder="Website Name">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                    <label for="short_description">Short Description: *</label>
                                    <input type="text" name="short_description" id="short_description" class="form-control required" value="<?php echo @$websiteData['short_description']; ?>" placeholder="Short Description">
                                </div>
                            </div>

                        </div>

                        <div class="form-group clearfix">
                            <div class="col-md-6 col-sm-6">
                                <div class="bottom-spacing">
                                    <label for="website_url">Website URL: (http://www.example.com) *</label>
                                    <input type="url" name="website_url" id="website_url" class="form-control required" value="<?php echo @$websiteData['website_url']; ?>" placeholder="http://www.example.com">
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <label for="website_rating">Website Rating:*</label>
                                <select id="website_rating" name="website_rating" class="required">


<!--                                    --><?php //if($action == 'edit') { ?>
                                        <option value="">Select Rating</option>
                                        <option value="1" <?php if( $websiteData['website_rating'] == '1') echo "selected";?> >1</option>
                                        <option value="2" <?php if( $websiteData['website_rating'] == '2') echo "selected";?> >2</option>
                                        <option value="3" <?php if( $websiteData['website_rating'] == '3') echo "selected";?> >3</option>
                                        <option value="4" <?php if( $websiteData['website_rating'] == '4') echo "selected";?> >4</option>
                                        <option value="5" <?php if( $websiteData['website_rating'] == '5') echo "selected";?> >5</option>
<!--                                    --><?php
//                                    } else
//                                    { ?>
<!--                                        <option value="">Select Rating</option>-->
<!--                                        <option value="1">1</option>-->
<!--                                        <option value="2">2</option>-->
<!--                                        <option value="3">3</option>-->
<!--                                        <option value="4">4</option>-->
<!--                                        <option value="5">5</option>-->
<!--                                    --><?php
//                                    }
//                                    ?>


                                </select>
                            </div>

                        </div>
                        <div class="form-group clearfix">

                            <div class="col-md-12">

                                <label for="website_description">Description : *</label>

                                <textarea class="form-control ckeditor required" name="website_description" rows="6" id="website_description">
                                    <?php

//                                        if ($action == 'edit')
//                                        {
                                            echo @$websiteData['website_description'];
//                                        }
                                    ?>
                                </textarea>

                            </div>

                        </div>

                        <input type="hidden" name="old_image" value="<?php echo @$websiteData['image']; ?>"/>
                        <div class="form-group clearfix">
                            <div class="frmgroup clearfix col-md-6 col-sm-6 col-xs-12">
                                <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                                    <div class="form-group last">
                                        <label class="col-md-12 col-sm-12 col-xs-12">Website image:*</label>
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width:200px; height:107px;">
                                                    <?php if ($action == 'edit' && @$websiteData['image'] != '' && file_exists(UPLOAD_ON_ROOT . '/website/' . @$websiteData['image'])) { ?>
                                                        <img src="<?php echo UPLOAD_URL_ROOT . '/website/' . @$websiteData['image']; ?>">
                                                    <?php } else { ?>
                                                        <img style="width:95px;" src="<?php echo IMAGE_URL . 'photos/default_user.png' ?>" alt=""/>
                                                    <?php } ?>
                                                </div>
                                                <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                <div class="galbtndiv col-md-12">
                                                    <div class="row">
                                                        <p>Allowed File types are: jpg , jpeg , png , gif.</p>
                                                        <span class="btn btn-default btn-file">
                                                        <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Upload Image</span>
                                                        <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                                        <input name="image" type="file" class="<?php if ($action == 'add')
                                                            echo "required"; ?> imageonly uploadLimit" id="image">
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


                        <?php if ($action == 'edit') { //edit data ?>
                            <div id="dynamic-div">
                                <?php
                                $k = 0;
                                //                            echo "<pre>"; print_r($pagesData);die;
                                foreach ($pagesData as $data):
                                    $k++;
                                    ?>
                                    <div id="<?php echo "dyn" . $data['page_id']; ?>" class="container form-group clearfix webpages">
                                        <input type="hidden" name="edit_page_id[]" value="<?php echo $data['page_id']; ?>"/>
                                        <div class="col-md-10 pd0 col-sm-10 bottom-spacing">
                                            <label for="page_name">Page Name: *</label>
                                            <input type="text" name="edit_page_name[]" id="page_name<?php echo $k; ?>" class="form-control page_name" value="<?php echo $data['page_name'] ?>" placeholder="Page Name" required>
                                        </div>
                                        <div class="button-wrapper" style="position: relative; ">
                                            <a class="remove_field1 remove_page btn btn-danger" href="javascript:;" title="Delete" type="button" data-id="<?php echo $data['page_id']; ?>" data-toggle="modal" data-target="#confirmDelete"
                                               data-title="Delete Page" data-message="Are you sure you want to delete this?">Remove</a>
                                        </div>
                                    </div>
                                    <?php

                                endforeach;
                                ?>
                            </div>
                        <?php } else {
                            //add data ?>
                        <div id="dynamic-div">
                            <?php if (!empty($pagesData)) { // if error found refill the submitted data
                                $pi = -1;

                                foreach ($pagesData as $keys => $vals)
                                {
                                    $pi++;
//                                    echo $vals;
                                    ?>
                                    <div class="form-group clearfix container webpages bottom-spacing">
                                        <div class="col-md-10 pd0 col-sm-10 bottom-spacing">
                                            <?php if ($pi == 0) { ?>
                                                <label for="page_name">Page Name: *</label>
                                                <?php
                                            } ?>
                                                <input type="text" name="page_name[]" id="page_name" class="form-control required page_name" placeholder="Page Name" value="<?php echo $vals; ?>">

                                        </div>
                                        <div class="button-wrapper">
                                            <a id="remove" style="visibility: hidden" class="remove_field btn remove_page btn btn-danger">Remove</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else
                            {
                                ?>

                                <div class="form-group clearfix container webpages bottom-spacing">
                                    <div class="col-md-10 pd0 col-sm-10 bottom-spacing">
                                        <label for="page_name">Page Name: *</label>
                                        <input type="text" name="page_name[]" id="page_name" class="form-control required page_name" placeholder="Page Name">
                                    </div>
                                    <div class="button-wrapper">
                                        <a id="remove" style="visibility: hidden" class="remove_field btn remove_page btn btn-danger">Remove</a>
                                    </div>
                                </div>
                                <?php
                            }?>
                            </div>
                        <?php } ?>

                        <input type="hidden" name="cnt" id="cnt" value="<?php echo @$k; ?>"/>

                        <div class="col-md-12 pd0 col-sm-12">

                            <button type="button" id="addMore" class="btn btn-success">Add more</button>
                            <br><br>
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
<!--THIS MODAL IS CREATED BECAUSE OF CONFLICT WITH AJAX REQUEST MODAL-->
<div class="modal fade" id="del_confirm" role="dialog" aria-labelledby="labelConfirmDelete" aria-hidden="true">
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
                <button type="button" class="btn btn-default cancelDelConf" data-dismiss="modal">Cancel</button>
                <a href="javascript:;" type="button" class="btn btn-danger" id="conf">Ok</a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $('input[type=url]').keypress(function (e)
    {
        if (e.which === 32)
            return false;
    });


    //    $('#del_confirm').find('.modal-footer #conf').on('click', function () {
    //        $('#del_confirm').modal('hide');
    //    });


    $("form#websiteForm").validate({
//        ignore: [],
        rules:
        {
            'website_url':
            {
                required: true,
                url: true
            }
//            ,
//            'page_name':
//            {
//                required: true
//            },
//            'edit_page_name':
//            {
//                required: true
//            }
        }
//        ,
//        message: {
//            "page_name": {'required': "Please enter page name."},
//            "edit_page_name": {'required': "Please enter page name."}
//        }
    });

    //    $("#websiteForm").validate({
    //        ignore: [],
    //        rules:
    //        {
    //            'website_url':
    //            {
    //                required: true,
    //                url     : true
    //            }
    //            "page_name[]"      : "required",
    //            "edit_page_name[]" : "required"
    //        }
    //        ,
    //        message:
    //        {
    //            "page_name[]" : "Please enter page name.",
    //            "edit_page_name[]": "Please enter page name."
    //        }
    //    });

    function removeBtn() {
        var page_count = $("#dynamic-div .webpages").length;
        console.log("Page Count = " + page_count);
        if (page_count == 1) {
//                alert('remove btn hide');
            $('#dynamic-div .btn-danger').css(
                {
                    'visibility': 'hidden',
                    'position': 'relative',
                    'left': '-40px',
                });
        } else {
            $('#dynamic-div .btn-danger').css({
                'visibility': 'inherit',
                'position': 'relative',
                'left': '-40px',
            });
        }
    }


    $('document').ready(function () {

        $('#dynamic-div .btn-danger').attr('style', 'visibility: hidden');

        var count = $("#cnt").val();
        removeBtn();

        function addField() {
            count++;
//        <label for="page_name'+count+'">Page Name: *</label>
            var addMoreContent = '<div class="container form-group webpages"><div class="col-md-10 pd0 col-sm-10 bottom-spacing"><input type="text" name="page_name[]" id="page_name' + count + '" class="form-control page_name required" placeholder="Page Name"></div><div class="button-wrapper" style="position: relative;"><a href="javascript:void(0);" id="remove' + count + '" data-target="#del_conf" data-toggle="modal" class="remove_field btn remove_page btn btn-danger">Remove</a></div></div>';
            $("#dynamic-div").append(addMoreContent);

            removeBtn();
        }

        $("#addMore").click(function () {
            addField();
            removeBtn();
        });
        $("#dynamic-div").on("click", ".remove_field", function (e) {   //user click on remove text
            let that = $(this);
            e.preventDefault();
            $('#del_confirm').modal('show');
            $('#del_confirm').find('.modal-footer .cancelDelConf').on('click', function () {
                $('#del_confirm').modal('hide');
            });
            $('#del_confirm').find('.modal-footer #conf').on('click', function () {
                $(that).parent('div').parent('div').remove();
                removeBtn();
                $('#del_confirm').modal('hide');
            });

            removeBtn();
        });

        $('#confirm').click(function (e) {
            console.log("Ajax Request");
            var dataString = $("#remove_id").val();
            $.ajax(
                {
                    url: "<?php echo base_url() . 'website/deletePage/' ?>",
                    type: 'POST',
                    data: {id: dataString},
                    async: false,
                    success: function (data) {
                        $("#dyn" + dataString).remove();
                        removeBtn();
                    }
                });
        });

    });
</script>