<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/28/2017
 * Time: 12:07 PM
 */
class Order extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'Order_model' , 'order' );
    }

    public function index()
    {
        $data['orderData'] = $this->order->getData();
//echo "<pre>";print_r($data);die;
        //        $data['bookingData'] = $this->order->getBookingDetails(1);
//        echo "<pre>"; print_r($data['orderData']);die;
//        echo "<pre>";print_r($data);die;
        $data['Module'] = "Orders";
        $this->load->view('templates/header');
        $this->load->view('order/list' , $data);
        $this->load->view('templates/footer');
    }

    public function formatTime($slotData)
    {
        $slot = explode("-" , $slotData);

        if ($slot[0] <= 1200)
        { // AM
            $end =  "AM";
            $temp = $slot[0]/100;
            if($temp == 12)
                $end = "PM";
            if($temp == 0)
                $temp="12";
            $slot[0] = $temp.":00 ".$end;
        } else
        {// PM
            $end = "PM";
            $temp = $slot[0]/100;
            if($temp == 24)
                $end = "AM";
            $slot[0] = ($temp - 12).":00 ".$end;
        }

        if ($slot[1] <= 1200)
        { // AM
            $end = "AM";
            $temp = $slot[1]/100;
            if($temp == 12)
                $end = "PM";
            if($temp == 0)
                $temp="12";

            $slot[1] = $temp.":00 ".$end;
        } else
        {// PM
            $end = "PM";
            $temp = $slot[1]/100;
            if($temp == 24)
                $end = "AM";
            $slot[1] = ($temp - 12).":00 ".$end;
        }
        return $slot;
    }
    public function view($id)
    {
        $data['module'] = "Booking";
//        $id=2;
        $data['orderData'] = $this->order->getDataByID($id);
        $data['bookingData'] = $this->order->getBookingDetails($id);

        foreach ($data['bookingData'] as $keys => $vals)
        {
            $slotStr = '';
            $slot = $vals['tot_slots'];
            $slots = explode("," , $slot);
            foreach ($slots as $key => $val)
            {
                $range = explode("-" , $val);
                $slotStr .= date("g:i A",strtotime($range[0]))." - ".date("g:i A",strtotime($range[1])).", ";
            }
            $data['bookingData'][$keys]['slots'] = rtrim($slotStr , ", ");
        }

        $this->load->view('templates/header');
        $this->load->view('order/view' , $data);
        $this->load->view('templates/footer');
    }

    public function printOrder($id)
    {
        $data['orderData']   = $this->order->getDataByID($id);
        $data['bookingData'] = $this->order->getBookingDetails($id);
        $data['CURRENCY'] = "NGN";
//        echo "<pre>"; print_r($data);die;

/*

         foreach ($data['bookingData'] as $key => $val)
        {
            if ($data['bookingData'][$key]['tot_hours'] == "24")
            {
                $data['bookingData'][$key]['slots'] = "12:00 AM - 11:59 PM";
            }
            else
            {
                $slots = explode("," , $data['bookingData'][$key]['tot_slots']);
                $data['bookingData'][$key]['slots'] = '';
                for ($i=0; $i<count($slots); $i++)
                {
                    $temp = $this->formatTime($slots[$i]);
                    $data['bookingData'][$key]['slots'] .= $temp[0]." - ".$temp[1]." ,";
                }
                $data['bookingData'][$key]['slots'] = rtrim($data['bookingData'][$key]['slots'] , ',');
            }

        }
*/
        foreach ($data['bookingData'] as $keys => $vals)
        {
            $slotStr = '';
            $slot = $vals['tot_slots'];
            $slots = explode("," , $slot);
            foreach ($slots as $key => $val)
            {
                $range = explode("-" , $val);
                $slotStr .= date("g:i A",strtotime($range[0]))." - ".date("g:i A",strtotime($range[1])).", ";
            }
            $data['bookingData'][$keys]['slots'] = rtrim($slotStr , ", ");
        }
        $this->load->library('Pdf');
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(SITE_TITLE);
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice');
        $pdf->SetKeywords('Invoice, Website');
        //$pdf->setCellHeightRatio(0.10);
        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE . ' 048', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array('times', '', '15'));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, '50');
        //$pdf->SetAutoPageBreak(false);
        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
        //$pdf->setPrintFooter(false);
        // ---------------------------------------------------------
        // set font
        $pdf->SetFont('times', '', '5');
        $pdf->setCellHeightRatio('0.99');
        // add a page
        $pdf->AddPage();


//		echo "<pre>";
//		print_r($data);
//		exit;
		error_reporting(0);
        $html = $this->load->view('order/invoicePDF', $data, TRUE);

        $pdf->writeHTML($html, true, false, false, false, '');
		
		$pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'Invoice-'.$data['orderData']['invoice_id'].'.pdf', 'FD');
		//$pdf->Output('Invoice'.rand(0,1000).'.pdf', 'I');
		//$pdf->Output('Invoice'.rand(0,1000).'.pdf ', 'FD');
        
    }

}