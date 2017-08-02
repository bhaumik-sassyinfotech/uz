

<style>    .my_check
    {
        position: relative;
        top: 3px;        margin: 25px;
    }    .my_required:after
    {
        content:"*";        color:red;
    }    input[type="checkbox"]
    {        float: right;
             margin-right: 30%;    }
    label
    {        font-weight: bold !important;
    }</style>
<!-- page heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>        </li>
        <li>            <a href="<?php echo base_url('unit'); ?>">View All Unit<?php //echo $Module;            ?></a>        </li>
        <li class="active"><?php echo ucfirst($Module); ?></li>
    </ul>
</div>
<!-- page heading end--><!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12 ">
            <section class="panel">
                <header class="panel-heading">
                    <?php echo $Module; ?>
                    <?php if (@$dataList[0]['is_lock'] == 1) { ?>
                        <span class="btn btn-primary pull-right btn-sm" title="Locked" style="margin-left : 5px;"><i class="fa fa-lock"></i></span>
                        <span style="color:red;" class="pull-right">
                            This unit is locked and it will available after <?php echo date('d M, Y h:i:s', strtotime(@$dataList[0]['avl_date'])); ?>
                        </span>
                    <?php } else if (@$dataList[0]['is_sold'] == 0) { ?>
                        <a href="<?php echo base_url() . 'leads/addedit/' . @$dataList[0]['unit_id'] . '/1'; ?>">
                            <span class="btn btn-info" style="float:right">
                                Create Lead
                            </span>
                        </a>
                    <?php } ?>
                </header>
                <?php if ($dataList) { ?>
                    <div class="panel-body">
                        <table class="table table-hover">
                            <tr>
                                <th>Unit no : </th>
                                <td>
                                    <?php echo $dataList[0]['unit_no']; ?>
                                </td>
                                <th>Sold : </th>
                                <td><?php echo ($dataList[0]['is_sold']) ? "<span style='color:red'>Yes</span>" : "No"; ?></td>
                            </tr>
                            <tr>
                                <th class="">Project name : </th>
                                <td><a href="javascript:;" data-src="<?php echo base_url() . 'leads/getPropertydetail/' . @$dataList[0]['property_id']; ?>"  title="View" data-toggle="modal" data-target="#viewDetail" data-title="View Project" data-message="">
                                        <?php echo $dataList[0]['property_name']; ?>
                                    </a>
                                </td>
                                <th class="">Building name : </th>
                                <td>
                                    <a href="javascript:;" data-src="<?php echo base_url() . 'leads/getBuildingdetail/' . @$dataList[0]['build_id']; ?>"  title="View" data-toggle="modal" data-target="#viewDetail" data-title="View Building" data-message="">
                                        <?php echo $dataList[0]['build_name']; ?>
                                    </a>
                                    <?php //echo $dataList[0]['build_name']; ?>
                                </td>
                            </tr>
                            <tr>
                                <th class="">Floor name : </th>
                                <td><?php echo $dataList[0]['floor']; ?></td>
                                <th>Plan name : </th>
                                <td><?php echo $dataList[0]['plan_name']; ?></td>
                            </tr>
                            <tr>
                                <th>Type of unit : </th>
                                <td><?php echo $dataList[0]['type_of_unit']; ?></td>
                                <th>Sq. ft :</th>
                                <td><?php echo $dataList[0]['sq_ft']; ?></td>
                            </tr>

                            <tr>
                                <th>Built up area : </th>
                                <td><?php echo $dataList[0]['built_up_area']; ?></td>
                                <th>Doors :</th>
                                <td><?php echo $dataList[0]['doors']; ?></td>
                            </tr>
                            <tr>
                                <th>Flooring details : </th>
                                <td><?php echo $dataList[0]['floor_details']; ?></td>
                                <th>Bathroom details :</th>
                                <td><?php echo $dataList[0]['bathroom_details']; ?></td>
                            </tr>
                            <tr>
                                <th>Extra rooms :</th>
                                <td><?php echo $dataList[0]['extra_rooms']; ?></td>
                                <th>Kitchen details :</th>
                                <td><?php echo $dataList[0]['kitchen_details']; ?></td>
                            </tr>
                            <tr>
                                <th>Balcony :</th>
                                <td><?php echo $dataList[0]['balcony']; ?></td>
                                <th>Parking :</th>
                                <td><?php echo $dataList[0]['parking']; ?></td>
                            </tr>
                            <tr>
                                <th>Selling price (<i class="fa fa-rupee"></i>) :</th>
                                <td><?php echo $dataList[0]['price']; ?></td>
                                <th>Brokerage amount (<i class="fa fa-rupee"></i>) :</th>
                                <td><?php echo $dataList[0]['brokerage_amt']; ?></td>
                            </tr>
                            <tr>
                                <th>Facing direction :</th>
                                <td><?php echo $dataList[0]['facing_direction']; ?></td>
                                <?php if ($dataList[0]['remarks'] != '') { ?>
                                    <th>Remarks :</th>
                                    <td><?php echo $dataList[0]['remarks']; ?></td>
                                <?php } else { ?>
                                    <th></th><td></td>
                                <?php } ?>
                            </tr>
                            <?php $aeminities = ''; ?>
                            <?php
                            if ($dataList[0]['lift'] != 0) {
                                $aeminities .= 'Lift, ';
                            }
                            if ($dataList[0]['gym'] != 0) {
                                $aeminities .= 'Gym, ';
                            }
                            if ($dataList[0]['security'] != 0) {
                                $aeminities .= 'Security, ';
                            }
                            if ($dataList[0]['fire_alarm'] != 0) {
                                $aeminities .= 'Fire alarm, ';
                            }
                            if ($dataList[0]['power_backp'] != 0) {
                                $aeminities .= 'Power backup, ';
                            }
                            if ($dataList[0]['play_area'] != 0) {
                                $aeminities .= 'Play area, ';
                            }
                            if ($dataList[0]['water_storage'] != 0) {
                                $aeminities .= 'Water storage, ';
                            }
                            if ($dataList[0]['camera_equiped'] != 0) {
                                $aeminities .= 'Camera equiped, ';
                            }
                            if ($dataList[0]['wastage_disposal'] != 0) {
                                $aeminities .= 'Wastage disposal, ';
                            }
                            if ($dataList[0]['garden'] != 0) {
                                $aeminities .= 'Garden, ';
                            }
                            if ($dataList[0]['burglar_alarm'] != 0) {
                                $aeminities .= 'Burglar alarm, ';
                            }
                            if ($dataList[0]['temple'] != 0) {
                                $aeminities .= 'Temple';
                            }
                            ?>
                            <?php $aeminities .=''; ?>
                            <?php if ($aeminities) { ?>
                                <tr>
                                    <th>Amenities :</th>
                                    <td colspan="3">
                                        <?php echo rtrim($aeminities, ", "); ?>
                                    </td>
                                </tr>

                            <?php } ?>
                        </table>
                    <?php } else { ?>
                        <h3 class="my_not_found">Data Not Found.</h3>
                    <?php } ?>
                </div>
                <?php
                if (!empty($leadData)) {
                    $loginGroup = $this->session->userdata('admin_group_id');
                    ?>
                    <div class="form-group clearfix">
                        <div class="col-md-12 col-sm-12">
                            <header class="panel-heading">Leads on this property</header>
                            <table class='table table-hover'>
                                <tr>
                                    <th>Date</th>
                                    <th>Contact name</th>
                                    <th>Contact email</th>
                                    <th>Price (<i class='fa fa-rupee'></i>)</th>
                                    <?php if ($loginGroup != 2 && $loginGroup != 3) { ?>
                                        <th>Lead by</th>
                                    <?php } ?>
                                    <th>Action</th>
                                </tr>
                                <?php
                                if (!empty($leadData)) {
                                    foreach ($leadData as $key => $val) {
                                        $status = ((!empty($sellData)) && @$sellData['lead_id'] == $val['lead_id']) ? ' <span class="label label-success label-mini">Success</span>' : '';
                                        if ($loginGroup != 2 && $loginGroup != 3) {
                                            $lead_by = $val['first_name'] . ' ' . $val['last_name'];
                                            echo "<tr><td>" . date('d M, Y', strtotime($val['created_on'])) . "</td><td>" . $val['contact1_name'] . "</td><td>" . $val['contact1_email'] . "</td>
                                                          <td>" . $val['price_per_sqft'] . "</td><td>" . @$lead_by . "</td><td><a target='_blank' href='" . base_url('leads/view/' . @$val['lead_id']) . "'>View</a></td></tr>";
                                        } else {
                                            echo "<tr><td>" . date('d M, Y', strtotime($val['created_on'])) . "</td><td>" . $val['contact1_name'] . "</td><td>" . $val['contact1_email'] . "</td>
                                                          <td>" . $val['price_per_sqft'] . "</td><td><a target='_blank' href='" . base_url('leads/view/' . @$val['lead_id']) . "'>View</a></td></tr>";
                                        }
                                    }
                                } else {
                                    echo "<tr><td colspan='6' style='text-align:center'>No any lead!</td></tr>";
                                }
                                ?>
                            </table>
                        </div>
                    </div>
                <?php } ?>
                <?php if (!empty($sellData)) { ?>
                    <div class="form-group clearfix">
                        <div class="col-md-12 col-sm-12">
                            <header class="panel-heading">Sold property information</header>
                            <table class='table table-hover'>
                                <thead></thead>
                                <tbody>
                                    <tr>
                                        <th>Owner Name :</th><td><?php echo $sellData['name']; ?></td>
                                        <th>Owner Email :</th><td><?php echo $sellData['email']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Address :</th><td><?php echo $sellData['present_adress']; ?></td>
                                        <th>Phone No : </th><td><?php echo $sellData['phone1']; ?></td>
                                    </tr>
                                    <tr>
                                        <th>PAN No :</th><td><?php echo $sellData['pan_no']; ?></td>
                                        <th>Sold By : </th><td><?php echo $sellData['first_name'] . ' ' . $sellData['last_name'] . ' (' . $sellData['email'] . ')'; ?></td>
                                    </tr>
                                    <tr>
                                        <th>Selling Date :</th><td><?php echo date('d M, Y', $sellData['selling_date']); ?></td>
                                        <th>Selling price (<i class='fa fa-rupee'></i>) : </th><td><?php echo $sellData['selling_price']; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php } ?>

            </section>
        </div>
    </div>
</div>
<!--body wrapper end-->
