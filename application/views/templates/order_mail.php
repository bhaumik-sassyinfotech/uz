<?php
//
//$orderData['customer'] = $this->order->getDataByID($bk_id);
//$bookingData = $this->order->getBookingDetails($bk_id);
$allproducts = '';
$allproducts .= '<tr>
        <td style="padding:5px 0px;"><img height="45" width="45" src="' . UPLOAD_URL_ROOT . 'user_booking/' . $orderData['booking_banner_image'] . '" /></td>
        <td style="padding:5px 0px;color:#282828;text-transform:uppercase;">' . $orderData['space']['page'] . '</td>
        <td style="padding:5px 0px;color:#3d3d40">' . $orderData['booked_hours']  . '</td>
        <td style="padding:5px 0px;text-align:center;color:#636363">' . date("F d, Y H:i A", strtotime($orderData['created_date'])) . '</td>
    </tr>';
$adsDetails = '';
foreach ($bookingData as $key => $val)
{
    $adsDetails .= '<tr>
            <td style="padding:5px 0px;color:#282828;text-transform:uppercase;"></td>
			<td style="padding:5px 0px;color:#282828;text-transform:uppercase;">' . date("F d, Y", strtotime($val['booking_date'])) . '</td>
			<td style="padding:5px 0px;color:#3d3d40">' . $val['tot_hours']  . '</td>
			<td style="padding:5px 0px;color:#3d3d40">' . $val['slots']  . '</td>
			<td style="padding:5px 0px;color:#636363; text-align: right">' . CURRENCY.$val['tot_amount'] . '</td>
		</tr>';
}


$logo = IMAGE_PATH."logo.png";

$headerTemplate = '<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <title><?php echo SITE_TITLE; ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Calibri, Arial;
        }

        * {
            margin: 0;
            padding: 0;
        }

        .table {
            width: 100%;
            max-width: 650px;
            margin-left: 2px
            border: 0;
        }

        .left-space {
            width: 50px;
        }

        .center-space {
            width: 550px;
        }

        .right-space {
            width: 50px;
        }

        .logo {
            float: none;
            padding: 3px 0 0px 0;
            /*background-color: #ffffff;*/
            background:linear-gradient(to bottom, #b00f1a 0%, #b41018 18%, #c51515 35%, #d01815 52%, #de1a13 69%, #ee2011 84%, #f8220f 100%);
            /*border-top: 5px #00a0e1 solid;*/
            /*border-top: linear-gradient(to bottom, #b00f1a 0%, #b41018 18%, #c51515 35%, #d01815 52%, #de1a13 69%, #ee2011 84%, #f8220f 100%);*/
        }

        .banner img {
            float: left;
            width: 100%;
        }

        .page-hidd {
            float: left;
            width: 100%;
            margin: 30px 0;
            font-size: 27px;
            color: #000000;
            text-align: center;
            text-decoration: underline;
        }

        .page-text {
            float: left;
            width: 100%;
            margin-bottom: 20px;
            font-size: 13px;
            color: #000000;
            text-align: left;
        }

        .get-started {
            text-transform: uppercase;
            color: #000;
        }

        .agent-img {
            width: 60px;
        }

        .agent-img img {
            float: left;
            width: 100%;
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
        }

        .agent-text {
            font-size: 13px;
            color: #000000;
            text-align: left;
        }

        .agent-col2 {
            width: 140px;
            padding: 0 10px;
            border-right: 1px #000000 solid;
        }

        .agent-col3 {
            padding-left: 10px;
        }

        .got-line {
            float: left;
            width: 100%;
            margin-top: 15px;
            padding: 10px 0;
            background-color: #00aaee;
            border-bottom: 1px #3BBAED solid;
        }

        .got-line img {
            vertical-align: middle;
        }

        .got-line-more {
            padding: 3px 5px 5px 5px;
            background-color: #c3c3c3;
            color: #000000;
            text-decoration: none;
        }

        .footer-line {
            float: left;
            width: 100%;
            padding: 10px 0;
            /*background-color: #009fdf;*/
            background: linear-gradient(to bottom, #b00f1a 0%, #b41018 18%, #c51515 35%, #d01815 52%, #de1a13 69%, #ee2011 84%, #f8220f 100%);
        }

        .footer-line-text1 {
            color: #000;
            font-size: 10px;
        }

        .footer-line-text2 {
            width: 125px;
            color: #93dbf8;
            font-size: 11px;
        }
        .footer-line-text2 a {
            color: #93dbf8;
        }
        .footer-social-icon {
            width: 72px;
        }
        @media only screen and (max-width: 480px) {
            .left-space {
                width: 20px;
            }
            .right-space {
                width: 20px;
            }
            .page-hidd {
                font-size: 20px;
            }
            .page-text,
            .agent-text {
                font-size: 11px;
            }
            .got-line img {
                width: 170px;
            }
            .got-line-more {
                font-size: 12px;
            }
            .footer-line-text1 {
                font-size: 7px;
            }
            .footer-line-text2 {
                width: 105px;
                font-size: 9px;
            }
            .footer-social-icon {
                width: 80px;
            }
        }
    </style>
</head>

<body>
<table cellpadding="4" cellspacing="1" style="width: 650px;">
    <tbody>
    <tr>
        <td class="logo" colspan="2" style="background:linear-gradient(to bottom, #b00f1a 0%, #b41018 18%, #c51515 35%, #d01815 52%, #de1a13 69%, #ee2011 84%, #f8220f 100%);padding:1px">
            <table cellpadding="0" cellspacing="0" class="table">
                <tbody>
                <tr>
                    <td class="left-space" style="width: 138px; height: 50px;"><img src="'.$logo.'" alt=""></td>
                    <td class="center-space"></td>
                    <td class="right-space"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>';








$copyrightText = $config['copyright_text'];
$contactNumber = $config['contact_number'];
$fbURL = $config['facebook_url'];
$fbicon = IMAGE_PATH."fb.png";

$twitterURL = $config['twitter_url'];
$twittericon = IMAGE_PATH."tr.png";
$footerTemplate = '
    <tr>
        <td class="footer-line" colspan="2" style="background: linear-gradient(to bottom, #b00f1a 0%, #b41018 18%, #c51515 35%, #d01815 52%, #de1a13 69%, #ee2011 84%, #f8220f 100%);
    padding: 10px;">
            <table cellpadding="0" cellspacing="0" class="table" style="width:100%">
                <tbody>
                <tr>
                    <td class="left-space"></td>
                    <td class="center-space">
                        <table cellpadding="0" cellspacing="0" class="table" style="width:100%">
                            <tbody>
                            <tr>
                                <td class="footer-line-text1" style="color: #fff; text-aligb:left">'. $copyrightText .'</td>
                                <td class="footer-line-text1"> <a style="text-decoration: none; color: #fff; float: right; padding-right: 10px" href="tel:'.$contactNumber.'">'. $contactNumber .'</a></td>
                                <td class="footer-social-icon">
                                                               <a href="'.$fbURL .'"><img src="'.$fbicon.'" alt="facebook Logo"></a>
                                    <a href="'.$twitterURL.'"><img
                                                src="'. $twittericon.'" ></a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                    <td class="right-space"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
    </tr>
    </tbody>
</table>
</table>
</body>
</html>';

















//$order_text = "You have got one order from Upzurge";
if( $orderData['discount_price'] )
{
    $couponDiscount =
        '<tr>
			<td style="padding:5px 0px">&nbsp;</td>
			<td style="padding:5px 0px;text-align:center">&nbsp;</td>
			<td style="padding:5px 0px;color:#a1a1a1">Coupon Discount ('.$orderData['coupon_code'].' )</td>
			<td style="padding:5px 0px;color:#a1a1a1">' . "-". CURRENCY .  number_format( $orderData['discount_price'] , 2) . '</td>
		</tr>';
} else
{
    $couponDiscount = '<tr style="display: none"><td></td></tr>';
}
$templateText = '
    <table border="0" cellpadding="0" cellspacing="0" style="background-color:#fff; margin:0px auto;padding:2%;" width="100%">
	<tbody>
		<tr>
			<td colspan="4"><span class="greet" style="color:#797979;font-size:14px;font-family:arial;font-weight:700;">Hello ' . $orderData['customer']['first_name']." ". $orderData['customer']['last_name'] . ',</span><br />
			<br />
			<span class="greettxt" style="color:#848484;font-size:14px;width:44%">' . $order_text . ' </span><br />
			&nbsp;</td>
		</tr>
	</tbody>
</table>

<table border="0" cellpadding="0" cellspacing="0" style="background-color:#fff; margin:0px auto;padding: 0px 2%;" width="60%">
	<tbody>
		<tr>
			<td align="center" style="margin:0px auto;"><span class="processtit" style="color:#3d3d40;font-size:30px;margin-bottom: 10px;font-weight: normal;">Order Completed</span>
			<p style="border-top: 1px dotted;border-bottom: 1px dotted;font-family: arial;margin:30px 0px 30px;padding:5px 0px"><span class="proinfo" style="color:#1c1b1b;font-size:18px;">Your order number: <span style="font-weight:700;">' . $orderData['invoice_id'] . '</span></span><br />
			<span class="proinfodate" style="color:#a1a1a1;font-size:13px;font-family: arial;">(Placed on ' . date("F d, Y H:i A", strtotime($orderData['created_date'])) . '):</span></p>
			</td>
		</tr>
	</tbody>
</table>

<table cellpadding="0" cellspacing="0" style="text-align:left;font-size:12px;margin:30px auto;" width="100%">
	<tbody>
		<tr>
			<td width="50%">
			<h4 style="border-bottom:1px solid #282828;color:#282828;font-size:14px;font-family:arial;font-weight:bold;display:inline">Billing Information:</h4>
			<p style="color:#848484;font-size:12px;font-family:arial;font-weight:normal;padding-top: 10px">' . $orderData['customer']['first_name'] . ' ' . $orderData['customer']['last_name'] . '<br>' . $orderData['customer']['address'] . '<br/>' . $orderData['customer']['street'] . ',<br/>' . $orderData['customer']['city'] . '<br/>' .  $orderData['customer']['state'] .  "-" . $orderData['customer']['zip_code'] . '<br/>' . $orderData['customer']['country'] . '<br/>' . 'T: ' . $orderData['customer']['mobile_no'] . '</p>
			</td>
		</tr>
	</tbody>
</table>

<table cellpadding="0" cellspacing="0" class="productinfo" style="text-align:left;font-size:12px;margin:0px auto;border-bottom:1px solid  #cdcdcd;margin-bottom: 20px" width="100%">
	<thead>
        <tr style="font-size:13px;font-weight: bold;padding-bottom:10px">
            <strong>Ads Information</strong>
        </tr>
		<tr style="font-size:13px;font-weight: bold;">
			<th style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;font-weight: bold;">Item</th>
			<th style="border-top: 1px solid #cdcdcd; border-bottom: 1px solid #cdcdcd; padding: 5px 0px; font-weight: bold;">Name</th>
			<th style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;font-weight: bold;">Hours</th>
			<th style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;text-align:center;font-weight: bold;">Date</th>
		</tr>
	</thead>
	<tbody>' . $allproducts . '</tbody>
	</table>
	<table cellpadding="0" cellspacing="0" class="productinfo" style="text-align:left;font-size:12px;margin:0px auto;" width="100%">
	<thead>
	    <tr style="font-size:13px;font-weight: bold;padding-bottom: 10px">
            <strong>Ads Details</strong>
        </tr>
		<tr style="font-size:13px;font-weight: bold;">
		    <td style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;font-weight: bold;">&nbsp;</td>
			<th style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;font-weight: bold;">Days Selected</th>
			<th style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px; font-weight: bold;">Total Hours</th>
			<th style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px; font-weight: bold;text-align: center">Slots</th>
			<th style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;font-weight: bold;text-align: right">Total Amount</th>
		</tr>
    </thead>
	<tbody>'. $adsDetails .'</tbody>
	<tbody style="text-align: right">
		<tr>
			
			<td style="padding:5px 0px">&nbsp;</td>
			<td style="padding:5px 0px;text-align:center">&nbsp;</td>
            <td style="padding:5px 0px">&nbsp;</td>
			<td style="padding:5px 0px;color:#a1a1a1">subtotal</td>
			<td style="padding:5px 0px;color:#a1a1a1;text-align: right">' . CURRENCY . number_format($orderData['base_price'], 2) . '</td>
		</tr>
		'.$couponDiscount.'
		<tr>
			<td style="padding:5px 0px">&nbsp;</td>
			<td style="padding:5px 0px;text-align:center">&nbsp;</td>
            <td style="padding:5px 0px;text-align:center">&nbsp;</td>
			<td style="padding:5px 0px;color:#a1a1a1">Transaction Fee</td>
			<td style="padding:5px 0px;color:#a1a1a1">'. CURRENCY . number_format($orderData['transaction_fee'], 2)  .'</td>
		</tr>

		<tr>
			<td style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px">&nbsp;</td>
			<td style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;text-align:center">&nbsp;</td>
			<td style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;text-align:center">&nbsp;</td>
			<td style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;color:#2b292f">Grand Total</td>
			<td style="border-top: 1px solid #cdcdcd;border-bottom: 1px solid #cdcdcd;padding:5px 0px;color:#2b292f">' . CURRENCY . number_format($orderData['total_paid_amount'], 2) . '</td>
		</tr>
	</tbody>
</table>


<table cellpadding="0" cellspacing="0" style="text-align:left;color:#1a1a1a;font-size:14px;font-family:arial;margin:30px auto;" width="100%">
	<tbody>
		<tr>
			<td>
			<p style="font-weight:normal;margin:5px 0px"><strong style="font-weight: 600">Team Upzurge</strong></p>
			</td>
		</tr>
	</tbody>
</table>';

$template = $headerTemplate . $templateText . $footerTemplate;
//echo $template;die;

$this->load->library('email');
$config['mailtype'] = 'html';
$this->email->initialize($config);

$this->email->from($from, $config['support_email']);
$this->email->to($to);

$subject1 = "Booking on " . SITE_TITLE;
$this->email->subject($subject1);

$this->email->message($template);
$this->email->send();

?>