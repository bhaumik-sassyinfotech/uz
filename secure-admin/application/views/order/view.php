<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url() . 'Order'; ?>">View All Orders</a>
        </li>
        <li class="active"> View <?php echo $module; ?> </li>
    </ul>
</div>
<!-- page heading end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <section class="panel">
                <header class="panel-heading pd-btm-25px">
                    View <?php echo $module; ?> Details
                </header>
                <div class="panel-body">
                    <div class="adv-table table-responsive">
                        <form name="cmsListForm" id="cmsListForm">
                            <table class="table table-striped display table table-bordered table-striped icon-color-blk"
                                   id="dynamic-table">
                                <tbody class="drag-body">
                                <tr>
                                    <td colspan="2"><STRONG>Customer Information: </STRONG></td>
                                </tr>
								<tr>
                                    <td>Name:</td>
                                    <td><?php if($orderData['customer_id']!=0){?>
										<a href="<?php echo base_url() . 'customer/edit/'.$orderData['customer_id']; ?>" >
										<?php echo $orderData['customer']['first_name'] . ' ' . $orderData['customer']['last_name']; ?>
										</a>
									<?php }else{
										echo $orderData['customer']['first_name'] . ' ' . $orderData['customer']['last_name'];
									}?>	
									</td>
                                </tr>
								<tr>
                                    <td>Email:</td>
                                    <td><?php echo $orderData['customer']['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Mobile Number:</td>
                                    <td><?php echo $orderData['customer']['mobile_no']; ?></td>
                                </tr>
                                <tr>
                                    <td>Address:</td>
                                    <td><?php echo $orderData['customer']['address']; ?></td>
                                </tr>
                                <tr>
                                    <td>Street:</td>
                                    <td><?php echo $orderData['customer']['street']; ?></td>
                                </tr>
                                <tr>
                                    <td>City:</td>
                                    <td><?php echo $orderData['customer']['city']; ?></td>
                                </tr>
                                <tr>
                                    <td>State:</td>
                                    <td><?php echo $orderData['customer']['state']; ?></td>
                                </tr>
                                <tr>
                                    <td>Zipcode:</td>
                                    <td><?php echo $orderData['customer']['zip_code']; ?></td>
                                </tr>
                                <tr>
                                    <td>Country:</td>
                                    <td><?php echo $orderData['customer']['country']; ?></td>
                                </tr>
                                </tbody>
                            </table>
                            <br><br>
                            <table class="table table-striped display table table-bordered table-striped icon-color-blk"
                                   id="dynamic-table">
                                <tr>
                                    <td colspan="5"><STRONG>Ads Information: </STRONG></td>
                                </tr>
                                <tr>
                                    <th>Ads Image</th>
									<th>Website Name</th>
                                    <th>Ads Name</th>
                                    <th>Hours</th>
                                    <th>Date</th>
                                </tr>
                                <tr>
                                    <td>
                                        <?php

                                        if (file_exists(UPLOAD_ON_ROOT .'user_booking/' . $orderData['booking_banner_image']) && $orderData['booking_banner_image']) { ?>
                                            <img width="50" height="50"
                                                 src="<?php echo UPLOAD_URL_ROOT .'user_booking/' . $orderData['booking_banner_image']; ?>"/>
                                        <?php } else { ?>
                                            <img alt="" width="50" height="50"
                                                 src="<?php echo IMAGE_URL . 'no_image_pdf.png/'; ?>"/>
                                        <?php } ?>
                                    </td>
									<td><a href="<?php echo base_url()."website/addEdit/".$orderData['web_id'];?>" target="_blank"><?php echo $orderData['website']['website_name']; ?></a></td>
                                    <td>
										<?php echo $orderData['space']['page']."<br/>"; ?>
										<a target="_blank"
										   href="<?php echo base_url() . 'space/addedit/' . $orderData['space_id']; ?>"><i
													class="fa fa-edit tooltips" title="Edit"></i></a> |
										<a target="_blank" href="<?php echo $orderData['space']['website_url']; ?>"><i class="fa fa-eye tooltips" title="View"
													></i> </a>
									</td>
                                    <td><?php echo $orderData['booked_hours']; ?></td>
                                    <td><?php echo date("F d, Y H:i A", strtotime($orderData['created_date'])); ?></td>
                                </tr>
                            </table>
                            <br><br>
                            <table class="table table-striped display table table-bordered table-striped icon-color-blk"
                                   id="dynamic-table">
                                <tr>
                                    <td colspan="4"><strong>Ads Details: </strong></td>
                                </tr>
                                <tr>
                                    <th width="10%">Days Selected</th>
                                    <th width="15%">Total Hours</th>
                                    <th width="50%">Slots</th>
                                    <th width="10%">Total Amount</th>
                                </tr>
                                <?php
                                foreach ($bookingData as $data)
                                { ?>
                                    <tr class="">
                                        <td> <?php echo date("F d, Y ", strtotime($data['booking_date'])); ?></td>
                                        <td> <?php echo $data['tot_hours']; ?></td>
                                        <td> <?php echo $data['slots']; ?></td>
                                        <td> <?php echo CURRENCY.$data['tot_amount']; ?></td>
                                    </tr>
                                    <?php
                                } ?>

                            </table>
                            <table class="table table-striped display table table-bordered table-striped icon-color-blk"
                                   id="dynamic-table">
                                <tr>

                                    <td class="fright fbold f12" style="width: 75%;">Subtotal</td>

                                    <td class="f12" style="width: 25%;"><i></i><?php echo CURRENCY.number_format($orderData['base_price'], 2); ?>
                                    </td>

                                </tr>
                                <?php
                                if ($orderData['discount_price'])
                                {
                                    ?>
                                    <tr>
                                        <td>Coupon Discount (<strong><?php echo $orderData['coupon_code']; ?></strong>)</td>
                                        <td>
                                            <?php echo "<strong>-</strong>" . CURRENCY . number_format($orderData['discount_price'] , 2); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                <tr>
                                    <td>Transaction Fee </td>
                                    <td>
                                        <?php echo CURRENCY . number_format($orderData['transaction_fee'] , 2); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td ><strong>Grand Total</strong></td>
                                    <td><?php echo CURRENCY. number_format($orderData['total_paid_amount'], 2); ?></td>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
            </section>
            <!--statistics end-->
        </div>
    </div>
</div>
