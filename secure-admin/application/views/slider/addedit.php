<!-- page heading start-->

<div class="page-heading">

    <h3> <?php echo $Module; ?> </h3>

    <ul class="breadcrumb"> 

        <li>

            <a href="<?php echo base_url() . 'dashboard'; ?>">Dashboard</a>

        </li>

        <li>

            <a href="<?php echo base_url() . 'slider'; ?>">View All <?php echo $Module; ?></a>

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

                    <form id="sliderEditForm" role="form" class="cmxform form-horizontal adminex-form" method="post" action="<?= base_url() . 'slider/addedit'; ?>" enctype="multipart/form-data">

                        <input type="hidden" name="action" id="action" value="<?php echo $action; ?>">



                        <?php if ($action == 'edit') { ?>

                            <input type="hidden" name="slider_id" id="slider_id" value="<?php echo $sliderData['slider_id']; ?>">

                        <?php } ?>



                        <div class="form-group clearfix">

                            <div class="col-md-12 col-sm-12">
                                <div class="bottom-spacing">

                                    <label for="slider_name">Title  :</label>

                                    <input type="text" class="form-control required" name="slider_name" id="slider_name" placeholder="Title" value="<?php
                                    if ($action == 'edit') {
                                        echo htmlspecialchars($sliderData['slider_name']);
                                    }
                                    ?>" maxlength="50"/>

                                </div>
                            </div>



                        </div>



                        <div class="form-group clearfix">

                            <div class="col-md-12 col-sm-12">
                                <div class="bottom-spacing">
                                    <label for="slider_desc">Description: </label>

                                    <textarea class="form-control ckeditor" name="slider_desc" id="slider_desc" rows="6"><?php
                                        if ($action == 'edit') {
                                            echo $sliderData['slider_desc'];
                                        }
                                        ?></textarea>

                                </div>
                            </div>

                        </div>



                        <div class="form-group clearfix">

                            <div class="frmgroup clearfix col-md-6 col-sm-6 col-xs-12">

                                <div class="col-md-12 col-sm-12 col-xs-12 pd0">
                                    <div class="bottom-spacing">
                                        <div class="form-group last">

                                            <label class="col-md-12 col-sm-12 col-xs-12">Image Upload :</label>

                                            <div class="col-md-12 col-sm-12 col-xs-12">


                                                <div class="fileupload fileupload-new" data-provides="fileupload">

                                                    <div class="fileupload-new thumbnail" style="width:200px; height:107px;">

                                                        <?php
                                                        if ($action == 'edit') {
                                                            ?>

                                                            <img src="<?php echo UPLOAD_URL_ROOT; ?>slider/thumb/<?php echo $sliderData['slider_image']; ?>" >	

                                                        <?php } else { ?>

                                                            <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />

                                                        <?php } ?>

                                                    </div>

                                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>

                                                    <div class="galbtndiv col-md-12">

                                                        <p>Best image size : 1366 x 700</p>

                                                        <span class="btn btn-default btn-file">

                                                            <span class="fileupload-new"><i class="fa fa-paper-clip"></i> Select image</span>

                                                            <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>

                                                            <input name="slider_image" type="file" class="<?php
                                                            if ($action == "add") {
                                                                echo "required ";
                                                            }
                                                            ?>imageonly" id="slider_image">

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

                            <input value="save" type="submit" id="submit" name="submit" class="btn btn-primary"/>

                            <a class="btn btn-default" href="<?php echo base_url() . 'slider'; ?>"> Cancel</a>

                        </div>

                    </form>

                </div>

            </section>

        </div>

    </div>

</div>

<!--body wrapper end-->