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
if($this->session->flashdata('profile_type') == 3)
{
    $tab3 = "active";
} else
{
    $tab3 = "";
}
if (empty($tab1) && empty($tab2) && empty($tab3))
    $tab1="active";

?>


<br><br><br><br><br><br><br>

<div class="yangon-container">
    <div class="container">
        <div class="al-table" id="advertisement">
            <div class="al-table-col col-md-3 col-sm-3 col-xs-12">
                <?php $this->load->view('templates/customerSidebar'); ?>
            </div>
            <div class="al-table-col col-md-9 col-sm-9 col-xs-12">
                <div class="my-advertisement-tab">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="<?php echo $tab1; ?>"><a href="#schedul" aria-controls="profile" role="tab" data-toggle="tab">Scheduled</a></li>
                        <li role="presentation" class="<?php echo $tab2; ?>"><a href="#live" aria-controls="live" role="tab" data-toggle="tab">Live </a></li>
                        <li role="presentation" class="<?php echo $tab3; ?>"><a href="#exhausted " aria-controls="exhausted" role="tab" data-toggle="tab">Exhausted</a></li>
                    </ul>
                    <!-- Tab panes -->

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane <?php echo $tab1; ?>" id="schedul">
                            <div class="al-right-contener">
                                <h1 class="al-right-contener-head<?php echo $tab1; ?>">Scheduled</h1>
                                <div class="al-right-content">
                                    <div class="table-pannel1">
                                        <!--<table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Website Name</th>
                                    <th>Space Name</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Total</th>
                                    <th>Views</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                        $i=1;
                                        foreach ($scheduled as $ads)
                                        {
                                            ?>
                                <tr>
                                    <td><?php echo $i++?></td>
                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                    <td><?php echo $ads['website_name']; ?></td>
                                    <td><?php echo $ads['page']; ?></td>
                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                    <td><?php echo "Views"; ?></td>
                                </tr>
                            <?php
                                        }
                                        ?>
                            <?php

                                        foreach ($live as $ads)
                                        {
                                            ?>
                                <tr>
                                    <td><?php echo $i++?></td>
                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                    <td><?php echo $ads['website_name']; ?></td>
                                    <td><?php echo $ads['page']; ?></td>
                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                    <td><?php echo "Views"; ?></td>
                                </tr>
                                <?php
                                        }
                                        ?>
                            <?php
                                        foreach ($exhausted as $ads)
                                        {
                                            ?>
                                <tr>
                                    <td><?php echo $i++?></td>
                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                    <td><?php echo $ads['website_name']; ?></td>
                                    <td><?php echo $ads['page']; ?></td>
                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                    <td><?php echo "Views"; ?></td>
                                </tr>
                                <?php
                                        }
                                        ?>

                            </tbody>
                        </table>-->
                                      
                                            <div class="col-md-6 col-sm-6 schedule">
                                                <div class="media">
                                                    <div class="col-md-12">
                                                        <h3>Heading</h3>
                                                        <a href="#" class="eye-icon"><i class="fa fa-eye"></i> 34</a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 img">
                                                        <img src="http://demosipl.com/upzurge/assets/uploads/user_booking/8ea6a9b2baa6f1d99ca2a4e7e894d639.jpg" class="img-responsive">
                                                        <p>website name</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 list">
                                                        <ul>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 price">
                                                        <span>NGN 90</span>
                                                        <button class="btn btn-primary">Details</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 schedule">
                                                <div class="media">
                                                    <div class="col-md-12">
                                                        <h3>Heading</h3>
                                                        <a href="#" class="eye-icon"><i class="fa fa-eye"></i> 34</a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 img">
                                                        <img src="http://demosipl.com/upzurge/assets/uploads/user_booking/8ea6a9b2baa6f1d99ca2a4e7e894d639.jpg" class="img-responsive">
                                                        <p>website name</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 list">
                                                        <ul>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 price">
                                                        <span>NGN 90</span>
                                                        <button class="btn btn-primary">Details</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 schedule">
                                                <div class="media">
                                                    <div class="col-md-12">
                                                        <h3>Heading</h3>
                                                        <a href="#" class="eye-icon"><i class="fa fa-eye"></i> 34</a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 img">
                                                        <img src="http://demosipl.com/upzurge/assets/uploads/user_booking/8ea6a9b2baa6f1d99ca2a4e7e894d639.jpg" class="img-responsive">
                                                        <p>website name</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 list">
                                                        <ul>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 price">
                                                        <span>NGN 90</span>
                                                        <button class="btn btn-primary">Details</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 schedule">
                                                <div class="media">
                                                    <div class="col-md-12">
                                                        <h3>Heading</h3>
                                                        <a href="#" class="eye-icon"><i class="fa fa-eye"></i> 34</a>
                                                    </div>
                                                    <div class="col-md-3 col-sm-3 img">
                                                        <img src="http://demosipl.com/upzurge/assets/uploads/user_booking/8ea6a9b2baa6f1d99ca2a4e7e894d639.jpg" class="img-responsive">
                                                        <p>website name</p>
                                                    </div>
                                                    <div class="col-md-6 col-sm-6 list">
                                                        <ul>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                            <li>Start date: 20-17-2017</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3 price">
                                                        <span>NGN 90</span>
                                                        <button class="btn btn-primary">Details</button>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane <?php echo $tab2; ?>" id="live">
                            <div class="al-right-contener">
                                <h1 class="al-right-contener-head<?php echo $tab2; ?>">Live</h1>
                                <div class="al-right-content">
                                    <div class="table-pannel1">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Website Name</th>
                                                <th>Space Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Total</th>
                                                <th>Views</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $i=1;
                                            foreach ($scheduled as $ads)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                                    <td><?php echo $ads['website_name']; ?></td>
                                                    <td><?php echo $ads['page']; ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                                    <td><?php echo "Views"; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <?php

                                            foreach ($live as $ads)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                                    <td><?php echo $ads['website_name']; ?></td>
                                                    <td><?php echo $ads['page']; ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                                    <td><?php echo "Views"; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            foreach ($exhausted as $ads)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                                    <td><?php echo $ads['website_name']; ?></td>
                                                    <td><?php echo $ads['page']; ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                                    <td><?php echo "Views"; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div role="tabpanel" class="tab-pane <?php echo $tab3; ?>" id="exhausted">
                            <div class="al-right-contener">
                                <h1 class="al-right-contener-head<?php echo $tab3; ?>">Exhausted</h1>
                                <div class="al-right-content">
                                    <div class="table-pannel1">
                                        <table class="table table-bordered">
                                            <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Website Name</th>
                                                <th>Space Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Total</th>
                                                <th>Views</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $i=1;
                                            foreach ($scheduled as $ads)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                                    <td><?php echo $ads['website_name']; ?></td>
                                                    <td><?php echo $ads['page']; ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                                    <td><?php echo "Views"; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <?php

                                            foreach ($live as $ads)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                                    <td><?php echo $ads['website_name']; ?></td>
                                                    <td><?php echo $ads['page']; ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                                    <td><?php echo "Views"; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            foreach ($exhausted as $ads)
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++?></td>
                                                    <td><img src="<?php echo UPLOAD_URL_ROOT."user_booking/".$ads['booking_banner_image']; ?>" alt=""></td>
                                                    <td><?php echo $ads['website_name']; ?></td>
                                                    <td><?php echo $ads['page']; ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['start'])); ?></td>
                                                    <td><?php echo date("Y/m/d" , strtotime($ads['end'])); ?></td>
                                                    <td><?php echo CURRENCY.$ads['total']; ?></td>
                                                    <td><?php echo "Views"; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                            </tbody>
                                        </table>
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


