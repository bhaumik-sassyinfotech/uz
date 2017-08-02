<!--
ITEM-NAME: space-name by space id
Status: PENDING , COMPLETED , FAIL
Sub total: base price
Grand total: final price
-->

<!-- order heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url('dashboard'); ?>">Dashboard</a>
        </li>
        <li class="active"> View <?php echo $Module; ?> </li>
    </ul>
</div>

<?php if ($this->session->flashdata('EditSuccMsg') != '') { ?>
    <div class="alert alert-success" id="edit_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('EditSuccMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('AddSuccMsg') != '') { ?>
    <div class="alert alert-success" id="add_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('AddSuccMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('DeleteSuccMsg') != '') { ?>
    <div class="alert alert-success" id="del_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('DeleteSuccMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('MailSuccMsg') != '') { ?>
    <div class="alert alert-success" id="mail_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('MailSuccMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('CommentSuccMsg') != '') { ?>
    <div class="alert alert-success" id="comment_succ" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('CommentSuccMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('ErrorMsg') != '') { ?>
    <div class="alert alert-danger" id="error_msg" data-es="Aquí se muestra el resultado del evento">
        <?php echo '   <h6>' . $this->session->flashdata('ErrorMsg') . '</h6>'; ?>
    </div>
<?php } ?>
<!-- order heading end-->

<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <section class="panel">
                <header class="panel-heading pd-btm-25px">
                    View <?php echo $Module; ?>
                </header>
                <div class="panel-body">
                    <div class="adv-table table-responsive">
                        <form name="orderListForm" id="orderListForm">
                            <table class="display table table-bordered table-striped icon-color-blk order_detail"
                                   id="dynamic-table">
                                <thead>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="10%">Invoice No.</th>
                                    <th width="">Customer Name</th>
									<th width="">Email</th>
									<th width="20%">Advertisement Name</th>
                                    <th width="10%">Status</th>
                                    <th width="13%">Sub Total( <?php echo CURRENCY;?> )</th>
                                    <th width="13%">Grand Total( <?php echo CURRENCY;?> )</th>
                                    <th class="axn-width">Actions</th>
                                </tr>
                                </thead>

                                <tbody>
                                <?php
                                $i = 1;
                                //                                echo "<pre>";print_r($customer);die;
                                foreach ($orderData as $data):
//                                    $query = "select * from booking_ads_users where uid=" . $data['user_id'];
//                                    $user = $this->db->query($query)->row_array();
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $data['invoice_id']; ?></td>
                                        <td>
                                            <strong class="no-margin">
                                                <?php 
												//print_r($data['customer']);
												if($data['customer_id']!=0){?>
												<a href="<?php echo base_url() . 'customer/edit/'.$data['customer_id']; ?>" >
												<?php
                                                echo $data['customer']['first_name'] . ' ' . $data['customer']['last_name'];
                                                ?>
												</a>
												<?php }else{
													echo $data['customer']['first_name'] . ' ' . $data['customer']['last_name'];
												}?>
												
												
                                            </strong>
                                        </td>
										<td><?php echo $data['customer']['email']; ?></td>
										<td>
                                            <?php
                                            //                                            foreach ($data['product_details'] as $key => $value) {
                                             echo "<b>".$data['website']['website_name']."</b><br/>";
											echo '<p class="no-margin">' . $data['space']['page'] . '</p>';
                                            //                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $status = strtolower($data['payment_status']);
//                                            echo $status;die;
                                            if ($status == "fail")
                                                $class = "label label-danger";
                                            else if ($status == "pending")
                                                $class = "label label-warning";
                                            else if ($status == "completed")
                                                $class = "label label-success";
                                            else
                                                $class = "label label-primary";
                                            ?>
                                            <span class="<?php echo $class; ?>"> <?php echo strtoupper($data['payment_status']); ?></span>

                                        </td>
                                        <td><?php echo number_format($data['base_price'], 2); ?></td>
                                        <td><?php echo number_format($data['final_price'], 2); ?></td>
                                        <td>
                                            <div>
                                                <a target="_blank"
                                                   href="<?php echo base_url() . 'order/printOrder/' . $data['id']; ?>"><i title="Print"
                                                            class="fa fa-print tooltips" data-original-title="Print"></i></a> |
                                                <a href="<?php echo base_url() . 'order/view/' . $data['id']; ?>"><i
                                                            class="fa fa-eye tooltips" data-trigger="hover"
                                                            data-toggle="tooltip" title="View"
                                                            data-original-title="View"></i> </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach;
                                ?>
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th width="5%">ID</th>
                                    <th width="10%">Invoice No.</th>
                                    <th width="">Customer Name</th>
									<th width="">Email</th>
									<th width="20%">Advertisement Name</th>
                                    <th width="10%">Status</th>
                                    <th width="13%">Sub Total(<?php echo CURRENCY;?>)</th>
                                    <th width="13%">Grand Total(<?php echo CURRENCY;?>)</th>
                                    <th class="axn-width">Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </section>
            <!--statistics end-->
        </div>
    </div>
</div>
<input type="hidden" name="viewPage" id="viewPage" value="orderDetail">
<!--body wrapper end-->

<script type="text/JavaScript">
    $('#dynamic-table').DataTable({
        "aoColumnDefs": [{"bSortable": false, "aTargets": [7]}]
    });

    Ajax_URL = '<?php echo base_url() ?>' + 'order';

    function confirmDelete() {
        var agree = confirm("Are you sure you want to delete this record?");
        if (agree)
            return true;
        else
            return false;
    }
</script>