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
                        <li role="presentation" class="active"><a href="#schedul" aria-controls="profile" role="tab">Scheduled</a></li>
                        <li role="presentation" class=""><a href="<?php echo base_url('customer/ads_live'); ?>" aria-controls="live" role="tab">Live </a></li>
                        <li role="presentation" class=""><a href="<?php echo base_url('customer/ads_exhausted'); ?>" aria-controls="exhausted" role="tab">Exhausted</a></li>
                    </ul>
                    <!-- Tab panes -->
<!--                    <a class="tab-pane" href="--><?php //echo base_url('customer/ads_live'); ?><!--">Live 1</a>-->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="schedul">
                            <div class="al-right-contener">
<!--                                <h1 class="al-right-contener-head--><?php //echo $tab1; ?><!--">Scheduled</h1>-->
                                <div class="al-right-content">
                                    <div class="table-pannel1">
                                            <?php if(empty($scheduled))
                                            {
                                                echo "<h1 class='al-right-contener-head no-content'>No Ads to be scheduled</h1>";
                                            } else
                                            {
                                                foreach ($scheduled as $ads) {
                                                    ?>
                                                    <div class="col-md-6 col-sm-6 box schedule">
                                                        <div class="media">
                                                            <div class="col-md-12">
                                                                <h3><?php echo $ads['page']; ?></h3>
                                                                <a href="#" class="eye-icon"><i class="fa fa-eye"></i> <?php echo $ads['views']; ?></a>
                                                            </div>
                                                            <div class="col-md-3 col-sm-3 img">
                                                                <div class="img-size">
                                                                    <img src="<?php echo UPLOAD_URL_ROOT . "user_booking/" . $ads['booking_banner_image']; ?>" class="img-responsive">
                                                                    <div class="visible-xs hidden-sm hidden-md hidden-lg"><p><?php echo $ads['website_name']; ?></p></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-sm-6 list">
                                                                <ul>
                                                                    <li>Start date: <?php echo date("Y/m/d", strtotime($ads['start'])); ?></li>
                                                                    <li>End date: <?php echo date("Y/m/d", strtotime($ads['end'])); ?></li>
                                                                    <li>Total Days: <?php echo $ads['tot_days']; ?></li>
                                                                    <li>Total Hours: <?php echo $ads['tot_hours']; ?></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-3 price">
                                                                <span><?php echo CURRENCY.$ads['total']; ?></span>
                                                                <a href="<?php echo base_url('customer/advertisement_details/') . base64_encode($ads['bk_id']); ?>">
                                                                    <button class="btn btn-primary">Details</button>
                                                                </a>
                                                            </div>
                                                            <div class="hidden-xs visible-sm visible-md visible-lg"><p><?php echo $ads['website_name']; ?></p></div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            <div class="listing-pagination full">
                                                <?php echo @$links; ?>
                                             </div>
                                            <?php
                                            }
                                            ?>
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


           