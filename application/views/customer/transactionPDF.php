<?php

$CI = &get_instance();
//echo "&#8358;"."<br>";
//echo "&#x20a6;";
?>

<style>

    .f15 {
        font-size: 15px;
    }

    .f12 {
        font-size: 12px;
    }

    .fbold {
        font-weight: bold;
    }

    .fleft {
        text-align: left !important;
    }

    .fright {
        text-align: right !important;
    }

</style>

<table cellspacing="0" cellpadding="5" bgcolor="#D3D3D3" align="center">

    <tr>

        <td class="f15">
            <p class="fbold">Transaction Completed</p>
        </td>

    </tr>

    <tr>

        <td class="f15">

            <p>Your transaction ID: <?php echo $transactionData[0]['transaction_id']; ?></p><br/>

            <p style="font-size: 12px;">(Placed
                on <?php echo date("F d, Y H:i A", strtotime($transactionData[0]['created_date'])); ?>)</p>
        </td>

    </tr>

</table>


<table>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
</table>


<table cellspacing="0" cellpadding="5" align="center">

    <tr>

        <td class="f15">

            <p class="fbold fleft"><u>Billing Information</u></p>

            <p class="fleft f12"><?php echo $orderData['customer']['first_name'] . ' ' . $orderData['customer']['last_name'] . "<br/>";
                echo $orderData['customer']['email']."<br/>";
                echo $orderData['customer']['address'] . "<br/>";
                echo $orderData['customer']['street'] . ",<br/>";
                echo $orderData['customer']['city'] . "-" . $orderData['customer']['zip_code'] . " " . $orderData['customer']['state'] . " " . $orderData['customer']['country'] . "<br/>";
                echo "T: " . $orderData['customer']['mobile_no'];
                ?></p>
        </td>

    </tr>

</table>


<br><br>
<p class="fleft fbold f15">

    <ul>
        <li>Transaction Information: </li>
    </ul>

</p>


<table cellspacing="0" cellpadding="5" align="center" border="1">

    <tr bgcolor="#D3D3D3">

        <th style="width: 30%;" class="f15 fbold">Ads Image</th>
        <th style="width: 20%;" class="f15 fbold">Website</th>
        <th style="width: 20%;" class="f15 fbold">Ads Name</th>

        <th style="width: 15%;" class="f15 fbold">Hours</th>

        <th style="width: 15%;" class="f15 fbold">Sub Total (<?= $CURRENCY;?>)</th>

    </tr>

    <tr>

        <td>
            <!--            --><?php //if (file_exists(UPLOAD_PATH . 'space/' . $orderData['space']['image'])) { ?>
            <!--            --><?php //if ( $orderData['booking_banner_image'] && file_exists(UPLOAD_URL. 'space/'.$orderData['booking_banner_image']) ) { ?>
            <?php if ( $orderData['booking_banner_image'] && file_exists(UPLOAD_ON_ROOT .'user_booking/' . $orderData['booking_banner_image']) ) { ?>
                <img width="50" height="50" src="<?php echo UPLOAD_ON_ROOT . 'user_booking/'.$orderData['booking_banner_image']; ?>"/>
            <?php } else { ?>
                <img alt="" width="50" height="50"
                     src="<?php echo IMAGE_URL . 'no_image_pdf.png/'; ?>"/>
            <?php } ?>
        </td> 
        <td class="fleft f12"><?php echo $transactionData[0]['website_name']; ?>
        </td>
        <td class="fleft f12"><?php echo $orderData['space']['page']; ?>
        </td>

        <td class="f12"><?php echo $orderData['booked_hours']; ?></td>

        <td class="f12">


            <?php
                echo number_format($orderData['base_price'],2);
            ?>

        </td>

    </tr>

    <?php

    //    }

    ?>

</table>

<br><br>
<p class="fleft fbold f15">
    <ul>
        <li>Ads Details</li>
    </ul>
</p>
<table cellspacing="0" cellpadding="5" align="center" border="1">

    <tr bgcolor="#D3D3D3">
        <th style="width: 15%;" class="f15 fbold">Days Selected </th>
        <th style="width: 15%;" class="f15 fbold">Total Hours </th>
        <th style="width: 55%;" class="f15 fbold">Slots</th>
        <th style="width: 15%;" class="f15 fbold">Total Amount (<?= $CURRENCY;?>) </th>

    </tr>
    <tbody class="hrs-avail-tb-content-main ">
    <?php
    foreach ($bookingData as $data) {?>
        <tr class="">
            <td class="f12" > <div class="hrs-avail-tb-td"><?php echo $data['booking_date']; ?></div></td>
            <td class="f12" > <div class="hrs-avail-tb-td"><?php echo $data['tot_hours']; ?></div></td>
            <td class="f12" > <div class="hrs-avail-tb-td"><?php echo $data['slots']; ?></div></td>
            <td class="f12 fright" > <div class="hrs-avail-tb-td"><?php echo number_format($data['tot_amount'] , 2); ?></div></td>
        </tr>
    <?php } ?>
    <table cellspacing="0" cellpadding="5" align="center" border="1">

        <tr>

            <td width="85%" class="fright fbold f12" style="width: 75%;">Subtotal </td>

            <td width="15%" class="f12 fright" style="width: 25%;"><i
                    class="fa"></i><?php echo number_format($orderData['base_price'], 2); ?></td>

        </tr>
        <?php
        if ($orderData['discount_price'])
        {?>
            <tr>
                <td width="85%" class="fright fbold f12">Coupon Discount</td>

                <td width="15%" class="f12 fright">

                    <?php echo "-".number_format($orderData['discount_price'] , 2); ?>
                </td >
            </tr >
            <?php
        }?>

        <tr>
            <td width="85%" class="fright fbold f12">Transaction Fee</td>
            <td width="15%" class="f12 fright"><i class="fa "></i><?php echo number_format($orderData['transaction_fee'], 2); ?></td>
        </tr>

        <tr>
            <td width="85%" class="fright fbold f12">Grand Total</td>
            <td width="15%" class="f12 fright"><i class="fa"></i><?php echo number_format($orderData['total_paid_amount'], 2); ?></td>
        </tr>

    </table>
    </tbody>
</table>
