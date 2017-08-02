
<!-- order heading start-->
<div class="page-heading">
    <h3><?php echo $Module; ?></h3>
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo base_url() . 'dashboard'; ?>">Dashboard</a>
        </li>
        <li>
            <a href="<?php echo base_url() . 'Order'; ?>">View All Orders</a>
        </li>
        <li class="active"> View <?php echo $module; ?> </li>
    </ul>
</div>
<!--body wrapper start-->
<div class="wrapper">
    <div class="row">
        <div class="col-md-12">
            <!--statistics start-->
            <section class="panel">
<!--                <header class="panel-heading pd-btm-25px">-->
<!--                    View --><?php //echo $Module; ?><!-- Detail-->
<!--                    <div class="btn-group pull-right">-->
<!--                        <a class="btn btn-primary btn-md emailShipment" data-id="--><?php //echo $orderData['order_id']; ?><!--"-->
<!--                           href="javascript:void(0)"><i class="fa fa-bus tooltips"></i> Ship </a>-->
<!--                        <a class="btn btn-primary btn-md" target="_blank"-->
<!--                           href="--><?php //echo base_url() . 'order/printOrder/' . $orderData['id']; ?><!--"><i-->
<!--                                    class="fa fa-print"></i> Print </a>-->
<!--                    </div>-->
<!--                </header>-->

                <div class="panel-body">
                    <div class="head">
                        <p>Order Processed</p>
                    </div>

                    <div class="border-dotted">
                        <div class="head-detail">
                            <p>Your Order Number: <?php echo $orderData['invoice_id']; ?></p>
                        </div>

                        <div class="head small-font">
                            (placed on <?php echo date("F d, Y H:i:s A", strtotime($orderData['created_date'])); ?>):
                        </div>
                    </div>

                    <div class="gutter clearfix container-fluid">
                        <div class="col-md-3 col-sm-3 padding-top-bot">
                            <div class="col-md-12">
                                <p class="bold underline">Shipping Information:<input type="button"
                                                                                     id="billingDetailCopy" value="Copy"
                                                                                     class="btn btn-success"></p>
                            </div>

                            <div class="col-md-12 billing">
                                <form method="post" id="billingDetailForm">
<!--                                    <input type="hidden" name="billing_id" id="billing_id"-->
<!--                                           value="--><?php //echo $orderData['billingDetails']['billing_id']; ?><!--">-->
                                    <ul>
                                        <li><input type="text" name="billing_firstname" id="billing_firstname"
                                                   value="<?php echo $orderData['customer']['first_name']; ?>">
                                        </li>
                                        <li><input type="text" name="billing_lastname" id="billing_lastname"
                                                   value="<?php echo $orderData['customer']['last_name']; ?>">
                                        </li>
                                        <li>
                                            <textarea value="<?php echo $orderData['address']; ?>" name="address" id="address" class="required" placeholder="Address"></textarea>

                                            <input type="text"
                                                   value="<?php echo $orderData['street']; ?>"
                                                   name="billing_street_address" id="billing_street_address">

                                            <div class="form-group gp-contact-form-group">
<!--                                                <label for="country">Country: *</label>-->
                                                <input type="text" value="<?php echo $orderData['country']; ?>" disabled="disabled" name="">
                                            </div>

                                            <input type="text" name="billing_city" id="billing_city"
                                                   value="<?php echo $orderData['street'] ?>">
                                            <input type="text" name="billing_city" id="billing_city"
                                                   value="<?php echo $orderData['city'] ?>">
                                            <input type="text" name="state" id="state"
                                                   value="<?php echo $orderData['state'] ?>">
                                            <input type="number" name="zip_code" id="zip_code" maxlength="6"
                                                   value="<?php echo $orderData['zip_code'] ?>">
                                        </li>
                                        <li>T:<input type="number" name="mobile" id="mobile"
                                                     value="<?php echo $orderData['mobile_no']; ?>"
                                                     class="notNegative numericOnly required form-control input-sm"
                                                     placeholder="Mobile no "></li>
                                    </ul>
                                </form>
                            </div>
                        </div>


                    <div class="adv-table table-responsive margin-tb">
                        <table class="display table table-bordered icon-color-blk order-table" id="drag-row">
                            <thead>
                            <tr>
                                <th style="width: 45%;" class="bold">Item</th>
                                <th style="width: 9%;" class="bold">Sku</th>
                                <th class="bold" style="width: 6%;">Qty</th>
                                <th class="bold" style="width: 13%;">Sub Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $orderProducts = $orderData['products'];
                            foreach ($orderProducts as $value) {
                                ?>
                                <tr>
                                    <td width="">
                                        <?php if (file_exists(UPLOAD_PATH . 'space/' . $value['product_image'])) { ?>
                                            <img width="50" height="50"
                                                 src="<?php echo UPLOAD_URL; ?>product/thumb/<?php echo $value['product_image']; ?>"
                                                 alt="<?php echo $value['product_name']; ?>"
                                                 class="img-responsive pull-left order-size" /><?php echo $value['product_name']; ?>
                                        <?php } else { ?>
                                            <img alt="" width="50" height="50"
                                                 src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image"/>
                                        <?php } ?>
                                        <p style="font-size: 12px;text-transform:  lowercase !important"><?php echo $value['product_flavour']; ?></p>
                                    </td>
                                    <td class="border"><?php echo $value['product_sku']; ?></td>
                                    <td class="border"><?php echo $value['product_qty']; ?></td>
                                    <td>
                                        <i class="fa fa-inr"></i>
                                        <?php
                                        $qty = $value['product_qty'];
                                        $price = $value['product_price'];
                                        $total = $qty * $price;
                                        echo number_format($total, 2);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        <table class="bottom-tbl" align="right" style="width: 100%;">
                            <tbody>
                            <tr>
                                <td></td>
                                <td class="border " style="width: 20.5%;">Subtotal</td>
                                <td class="border " style="width: 17.8%;"><i
                                            class="fa fa-inr"></i><?php echo " " . number_format($orderData['order_sub_total'], 2); ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="border ">Coupon
                                    Discount <?php echo ($orderData['order_coupon_code'] != '') ? "(" . $orderData['order_coupon_code'] . ")" : ""; ?></td>
                                <td class="border ">
                                    <?php
                                    /* $discount_type = json_decode(discount_type,true);
                                      $type = '';
                                      foreach( $discount_type as $key => $value )
                                      {
                                      if( $key == $orderData['order_coupon_type'] )
                                      {
                                      $type = $value;
                                      }
                                      } */
                                    $discounted_type = $orderData['order_coupon_type'];

                                    if (!empty($orderData['order_coupon_discount'])) {
                                        if ($discounted_type == "percentage")
                                            echo $orderData['order_coupon_discount'] . '%';
                                        else
                                            echo '<i class="fa fa-inr"></i> ' . $orderData['order_coupon_discount'];
                                    } else
                                        echo "-";
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="border ">Shipping &amp; Handling</td>
                                <td class="border "><i class="fa fa-inr"></i> 0</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td class="g-total border">Grand Total</td>
                                <td class="g-total border"><i
                                            class="fa fa-inr"></i><?php echo " " . number_format($orderData['order_grand_total'], 2); ?>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="adv-table table-responsive margin-tb" id="shipment_detail">
                        <p class="panel-heading pd-btm-25px">Shipping and Tracking Information</p>
                        <div class="alert alert-danger shipment_msg" style="display: none">Please,first add shipment
                            data
                        </div>
                        <table class="display table table-bordered icon-color-blk order-table" id="drag-row">
                            <thead>
                            <tr>
                                <th style="width: 25%;" class="bold">Carrier</th>
                                <th style="width: 20%;" class="bold">Number</th>
                                <th class="bold" style="width: 20%;">Action</th>
                            </tr>
                            </thead>
                            <tbody class="order_shipmentData">
                            <?php
                            foreach ($shipmentData as $value) {
                                ?>
                                <tr data-id="<?php echo $value['shipment_id'] ?>">
                                    <td><?php echo $value['oc_name'] ?></td>
                                    <td><?php echo $value['shipment_trackno']; ?></td>
                                    <td><a href="javascript:void(0)" data-id="<?php echo $value['shipment_id'] ?>"
                                           class="deleteShipment">Delete</a></td>
                                </tr>
                                <?php
                            }
                            ?>
                            </tbody>
                            <tr>
                                <td style="width: 25%;">
                                    <select name="shipment_provider_id" id="shipment_provider_id">
                                        <?php foreach ($orderCarrierData as $key => $val) { ?>
                                            <option value="<?php echo $val['oc_id']; ?>"><?php echo $val['oc_name']; ?></option>
                                        <?php } ?>
                                    </select>
                                </td>
                                <td style="width: 20%;"><input type="text" name="shipment_trackno"
                                                               id="shipment_trackno"></td>
                                <td style="width: 20%;"><a href="javascript:void(0)" id="addShipment"
                                                           class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <form id="orderCommentEditForm" role="form" class="cmxform form-horizontal adminex-form"
                          method="post" action="<?= base_url() . 'order/addcomment'; ?>" enctype="multipart/form-data">
                        <input type="hidden" name="order_id" id="order_id"
                               value="<?php echo $orderData['order_id']; ?>">
                        <div class="row com-his-container">
                            <p class="panel-heading pd-btm-25px">Comment History</p>
                            <div class="col-md-6 col-sm-6">
                                <h5>Add Order Comments</h5>

                                <div class="form-group clearfix">
                                    <div class="col-md-4 col-sm-4">
                                        <label for="order_status">Status : </label>
                                        <select class="form-control m-bot15 required" name="order_status"
                                                id="order_status">
                                            <option value=""></option>
                                            <?php
                                            $payment_status = json_decode(payment_status, true);
                                            foreach ($payment_status as $key => $value) {
                                                $selected = false;
                                                if ($key == $orderData['order_status']) {
                                                    $selected = true;
                                                }
                                                ?>
                                                <option value="<?php echo $key; ?>" <?php
                                                if ($selected) {
                                                    echo "selected";
                                                }
                                                ?> ><?php echo $value; ?></option><?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group clearfix">
                                    <div class="col-md-12">
                                        <label for="order_comment"> Comment : </label>
                                        <textarea class="form-control" name="order_comment" rows="4"
                                                  id="order_comment"></textarea>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="col-md-6 col-sm-6 no-padding">
                                            <label><input type="checkbox" name="order_notify_customer"
                                                          id="order_notify_customer" value="yes"> Notify Customer by
                                                Email</label>
                                            <label><input type="checkbox" name="order_visible_front"
                                                          id="order_visible_front" value="yes"> Visible On
                                                Frontend</label>
                                        </div>

                                        <div class="col-md-6 col-sm-6 no-padding">
                                            <input value="Submit Comment" type="submit" id="submit" name="submit"
                                                   class="btn btn-primary"/>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            if (count($orderCommentData) > 0) {
                                ?>
                                <div class="col-md-6 col-sm-6">
                                    <div class="col-md-12 comment-list">
                                        <?php
                                        foreach ($orderCommentData as $comment) {
                                            $notified = $comment['order_notify_customer'];

                                            if ($notified == "yes")
                                                $notified = "Notified";
                                            else
                                                $notified = "Not Notified";

                                            $payment_status = json_decode(payment_status, true);
                                            $status = $comment['order_status'];
                                            foreach ($payment_status as $key => $value) {
                                                if ($key == $status) {
                                                    $status = $value;
                                                }
                                            }
                                            ?>
                                            <div class="form-group clearfix">
                                                <p class="txt-bold">
                                                    <i class="fa fa-file-o"></i>
                                                    <?php echo date("F d, Y H:i:s A", strtotime($comment['order_logs_date'])) . " | " . $status; ?>
                                                </p>
                                                <p>Customer <span class="txt-bold"><?php echo $notified; ?></span></p>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </form>

                    <?php if ($orderData['pay_info'] != '') {
                        $payinfo = json_decode($orderData['pay_info'], 1);
                        echo '<b>Additional Payment Info</b><br><table class="display table table-bordered icon-color-blk order-table"><tbody>';
                        foreach ($payinfo as $keyP => $valP) {
                            if ($valP != '') {
                                echo '<tr><td class="border">' . $keyP . '</td><td class="border">' . $valP . '</td><td></tr>';
                            }
                        }
                        echo '</tbody></table>';
                    }
                    ?>
                </div>
            </section>
            <!--statistics end-->
        </div>
    </div>
</div>
<!--body wrapper end-->
<!-- Modal -->
<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="shipmentEmailModal"
     class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title">Shipment Email Format</h4>
            </div>
            <div class="modal-body">
                <div class="row emailFormatBody" style="margin: 10px 0px !important"></div>

            </div>
            <div class="modal-footer">
                <a href="<?php echo base_url('order/sendShipmentEmail/' . $orderData['order_id'] . '/1') ?>"
                   class="btn btn-primary">Send Email</a>
            </div>
        </div>
    </div>
</div>
<!-- modal -->

<script type="text/javascript">
    $('#billingDetailSave').click(function () {
        $.post('<?php echo base_url('order/saveBillingDetail') ?>', $('#billingDetailForm').serialize(), function (data) {
            if (data == 1) {
                alert("Billing information has been saved successfully..");
            }
        })
    });
    $('#shippingDetailSave').click(function () {
        $.post('<?php echo base_url('order/saveShippingDetail') . '/' . $orderData['billingDetails']['billing_id']; ?>', $('#shippingDetailForm').serialize(), function (data) {
            if (data == 1) {
                alert("Shipping information has been saved successfully..");
            }
        })
    });
    $('#billingDetailCopy').click(function () {
        $('#shipping_firstname').val($('#billing_firstname').val());
        $('#shipping_lastname').val($('#billing_lastname').val());
        $('#shipping_address').val($('#billing_address').val());
        $('#shipping_street_address').val($('#billing_street_address').val());
        $('#shipping_state').val($('#billing_state').val());
        $('#shipping_city').val($('#billing_city').val());
        $('#shipping_zipcode').val($('#billing_zipcode').val());
        $('#shipping_phone').val($('#billing_phone').val());
    });
    $('#addShipment').click(function () {
        track_no = $.trim($('#shipment_trackno').val());
        if (track_no != '') {
            order_id = $('#order_id').val();
            shipment_provider_id = $('#shipment_provider_id option:selected').val();
            shipment_provider_text = $('#shipment_provider_id option:selected').text();
            $.post('<?php echo base_url('order/addShipment') ?>', {
                order_id: order_id,
                shipment_trackno: track_no,
                shipment_provider_id: shipment_provider_id
            }, function (data) {
                if (data != 0) {
                    html = ' <tr data-id="' + data + '"><td>' + shipment_provider_text + '</td><td>' + track_no + '</td><td><a href="javascript:void(0)" data-id="' + data + '" class="deleteShipment">Delete</a></td></tr>'
                    $('.order_shipmentData').append(html);
                    $('#shipment_trackno').val('');
                }
            });
        } else {
            alert("Please,enter shipment trackno");
            $('#shipment_trackno').focus();
        }

    })
    $(document).on('click', '.deleteShipment', function () {
        shipment_id = $(this).attr('data-id');
        if (shipment_id && confirm("Are you sure you want to delete this shipment detail..?")) {
            $.post('<?php echo base_url('order/deleteShipment') ?>', {shipment_id: shipment_id}, function (data) {
                if (data == 1) {
                    $('.order_shipmentData').find('tr[data-id="' + shipment_id + '"]').remove();
                }
            });
        }
    })
    $('.emailShipment').click(function () {
        id = $(this).attr('data-id');
        $.post('<?php echo base_url('order/checkShipment') ?>', {order_id: id}, function (data) {
            if (data == 1) {
                $.post('<?php echo base_url('order/sendShipmentEmail') ?>', {order_id: id}, function (result) {
                    if (result != '') {
                        result = $.parseJSON(result);
                        if (result.status == 1) {
                            $('.emailFormatBody').html(result.html);
                            $('#shipmentEmailModal').modal('show');
                            $('#modelShipment').attr('width', '100% !important');
                        }
                        else {
                            alert("No order found !!!");
                        }
                    }
                });
            } else {
                $('html, body').animate({
                    scrollTop: $("#shipment_detail").offset().top
                }, 2000);
                $('.shipment_msg').show();
                setTimeout(function () {
                    $('.shipment_msg').hide();
                }, 5000);
            }
        });
    })
</script>