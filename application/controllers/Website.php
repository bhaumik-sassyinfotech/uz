<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/15/2017
 * Time: 1:34 PM
 */
class Website extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('WebsiteModel', 'website');
        $this->load->model('SpaceModel', 'space');
        $this->load->library('pagination');
    }

    public function index($page = 1)
    {
        $slug = $this->input->get('search');
        $sort = $this->input->get('sort');
        if ($slug) {
            $config['suffix'] = "?search=" . $slug;
        }
        if (!$sort) {
            $sort = 0;
        }
        $config = array();

        $config["base_url"] = base_url() . "website/index";

        $data['allWebsiteData'] = $this->website->paginate($slug, $sort);

        $config["total_rows"] = count($data['allWebsiteData']);
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['next_link'] = '';
        $config['prev_link'] = '';
        $config['last_link'] = '';
        $config['full_tag_open'] = "<ul>";
        $config['full_tag_close'] = "</ul>";

        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li><a href='#' class='current'><span>";
        $config['cur_tag_close'] = "</span></a></li>";
//        $config['next_tag_open'] = "<li><a href='' class='next'><i class='fa fa-angle-right' aria-hidden='true'></i>";
//        $config['prev_tag_open'] = "<li><a href='' class='prev'><i class='fa fa-angle-left'  aria-hidden='true'></i>";
        $config['next_tag_open'] = "<li><a href='' class='next'>NEXT";
        $config['next_tag_close'] = "</a></li>";
        $config['prev_tag_open'] = "<li><a href='' class='prev'>PREVIOUS";
        $config['prev_tag_close'] = "</a></li>";

        /*
                $config['next_tag_open'] = "<li><a href='' class='next'>";
                $config['prev_tag_open'] = "<li><a href='' class='prev'>";
                $config['next_tag_close'] = "</a></li>";
                $config['prev_tag_close'] = "</a></li>";
        */
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li><a href='' class='last'>LAST";
        $config['last_tag_close'] = "</a></li>";

        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['websiteData'] = $this->website->paginate($slug, $sort, $page, $config['per_page']);

        $data['start_page'] = $page;
        $data['page_limit'] = $config['per_page'];
        $data["links"] = $this->pagination->create_links();

        $data['config'] = footerSettings();
        $this->load->view('templates/header', $data);
        $this->load->view('website/websiteList', $data);
        $this->load->view('templates/footer', $data);
    }

    public function minPrice($websiteID)
    {
        //get min of base price per hour and min base price per day using `space` table
        $result = $this->space->minWebsitePrice($websiteID);

        return $result;
    }

    public function space($id)
    {
        $id = base64_decode($id);
        $data['websiteData'] = $this->website->getWebsiteDataByID($id);
        $data['config'] = footerSettings();
        $details = array();
        $space = $this->website->getPagesID($id);
        for ($i = 0; $i < count($space); $i++)
        {
            $details[ $i ] = $this->website->getSpaceData($space[ $i ]['page_id'], $space[ $i ]['website_id']);
        }
        $data['spaceData'] = $details;

        $this->load->view('templates/header', $data);
        $this->load->view('website/websiteView', $data);
        $this->load->view('templates/footer', $data);
    }

    /*Booking Process Code*/
    public function spaceDetails($spaceID)
    {
        $spaceID = base64_decode($spaceID);
        $data['config'] = footerSettings();
        $data['spaceID'] = $spaceID;

        $space = $this->website->getSpaceDetails($spaceID);
        //        echo "<pre>";print_r($space);die;
        if (empty($space['spaceData'])) {
            redirect('website');
        }
        $data['WebId'] = $space['websiteData']['id'];
        //echo "<pre>";print_r($space);exit;

        $date = date("Y-m-d");
        $spaceBooking = $this->website->getspaceBookingDetails($spaceID, $date);
        $bookedDates = array();
        if (!empty($spaceBooking)) {
            foreach ($spaceBooking as $booking_dates) {
                if ($booking_dates['tot_hours'] == 24) {
                    $bookedDates[] = $booking_dates['booking_date'];
                }
            }
        }
        $data['bookedDates'] = $bookedDates;
        //print_r($bookedDates);exit;
        $data['spaceData'] = $space['spaceData'];
        $data['websiteData'] = $space['websiteData'];
        $data['salePriceData'] = $space['salePriceData'];

        //        echo "<pre>"; print_r($data['salePriceData']); die;
        $this->load->view('templates/header', $data);
        $this->load->view('space/space_details', $data);
        $this->load->view('templates/footer', $data);
    }

    public function get_booking_slot_info_by_date()
    {
        $date = $this->input->post('date');
        //$webid = $this->input->post('webid');
        $spaceid = $this->input->post('spaceid');

        $bookingData = $this->website->booking_by_date($date, $spaceid);
        $data['check_date'] = $date;
        $data['bookingData'] = array();
        //echo count($bookingData);
        if (count($bookingData) == 1) {
            if ($bookingData[0]['booking_hours'] == 24) {
                $data['bookingData'][] = 24;
            } else {
                foreach ($bookingData as $bookslot) {
                    $data['bookingData'][] = $bookslot['booking_hours_from'];
                }
            }
        } else {
            foreach ($bookingData as $bookslot) {
                $data['bookingData'][] = $bookslot['booking_hours_from'];
            }
        }
        //print_r($data['bookingData']);
        echo $slot_table = $this->load->view('space/booking_slot_info.php', $data, TRUE);
        exit;
        //$this->set_output($slot_table);
        //print_r($slot_table);exit;
        //echo json_encode(array('result'=>'success','slot_table'=>$slot_table));exit;
    }


    public function get_ads_price_info_bydate()
    {
        $date = $this->input->post('date');
        $timeSlot = $this->input->post('time_slot');
        $spaceId = $this->input->post('spaceid');
        $spaceData = $this->website->get_space_booking_price($date, $spaceId, $timeSlot);
        //print_r($spaceData);
        /* $price_per_hour = "";
        $price_per_day = ""; */
        if (!empty($spaceData)) {
            echo json_encode(array('result' => 'success', 'price_per_hour' => $spaceData['price_per_hour'], 'price_per_day' => $spaceData['price_per_day']));
        } else {
            echo json_encode(array('result' => 'fail', 'price_per_hour' => "", 'price_per_day' => ""));
        }
    }

    public function book_ads_datetime()
    {
        //echo "<pre>";
        //print_r($this->input->post());
        $webid = $this->input->post('booking_web_id');
        $spaceid = $this->input->post('booking_space_id');
        $spaceData = $this->website->check_space_data($webid, $spaceid);

        if (empty($spaceData)) {
            redirect('website');
        } else {
            //booking process
            $booking_current_date = $this->input->post('booking_current_date');
            $booking_net_price = $this->input->post('booking_net_price');
            $booking_time_slot_array = $this->input->post('booking_time_slot');

            $bookedSuccess = array();
            $bookedFailed = array();
            $booking_tot = 0;
            $booking_tot_hrs = 0;


            if (!empty($booking_time_slot_array)) {
                foreach ($booking_time_slot_array as $bookingDate => $bookingData) {
                    if (!empty($bookingData)) {
                        $tot_amount = 0;
                        $ibs = 0;
                        $ibf = 0;

                        foreach ($bookingData as $ads_book_slot) {
                            $booking_hrs = 1;
                            $booking_hrs_from = $ads_book_slot;
                            $booking_hrs_to = sprintf("%04d", ($ads_book_slot + 100));

                            if ($ads_book_slot == 2400) {
                                $booking_hrs = 24;
                                $booking_hrs_from = '0000';
                                $booking_hrs_to = '2359';
                            }
                            //check booking ads available for date
                            $ads_totData = $this->website->check_available_ads_slot($spaceid, $bookingDate, $booking_hrs_from);


                            //check ads slot available or not
                            if (empty($ads_totData)) {
                                $ads_price = $this->website->get_space_booking_price($bookingDate, $spaceid, $ads_book_slot);
                                if ($ads_book_slot == 2400) {
                                    $single_price = $ads_price['price_per_day'];
                                } else {
                                    $single_price = $ads_price['price_per_hour'];
                                }
                                $tot_amount = $tot_amount + $single_price;
                                $booking_tot_hrs = $booking_tot_hrs + $booking_hrs;

                                $bookedSuccess[ $bookingDate ]['booking_data'][ $ibs ]['booking_date'] = $bookingDate;
                                $bookedSuccess[ $bookingDate ]['booking_data'][ $ibs ]['booking_hours'] = $booking_hrs;
                                $bookedSuccess[ $bookingDate ]['booking_data'][ $ibs ]['booking_hours_from'] = $booking_hrs_from;
                                $bookedSuccess[ $bookingDate ]['booking_data'][ $ibs ]['booking_hours_to'] = $booking_hrs_to;
                                $bookedSuccess[ $bookingDate ]['booking_data'][ $ibs ]['single_price'] = $single_price;

                                $ibs++;
                            } else {
                                $bookedFailed[ $bookingDate ][ $ibf ]['booking_date'] = $bookingDate;
                                $bookedFailed[ $bookingDate ][ $ibf ]['booking_hours'] = $booking_hrs;
                                $bookedFailed[ $bookingDate ][ $ibf ]['booking_hours_from'] = $booking_hrs_from;
                                $bookedFailed[ $bookingDate ][ $ibf ]['booking_hours_to'] = $booking_hrs_to;

                                $ibf++;
                            }
                        }
                        $bookedSuccess[ $bookingDate ]['tot_amount'] = $tot_amount;
                        $booking_tot = $booking_tot + $tot_amount;
                    }
                    //echo "<pre>";print_r($ads_totData);
                }
                //echo $booking_tot;
                //echo "<pre>";print_r($bookedSuccess);
                //echo "<pre>";print_r($bookedFailed);
                if (!empty($bookedSuccess) && empty($bookedFailed) && $booking_tot == $booking_net_price) {
                    //echo "success";

                    //Create Booking Entry and get booking_id
                    $bk_unique_code = $this->website->unique_id();
                    $booking['web_id'] = $webid;
                    $booking['space_id'] = $spaceid;
                    $booking['payment_status'] = 'Pending';
                    $booking['base_price'] = $booking_tot;
                    $booking['total_paid_amount'] = $booking_tot;
                    $booking['final_price'] = $booking_tot;
                    $booking['booked_hours'] = $booking_tot_hrs;
                    $booking['bk_unique_code'] = $bk_unique_code;
                    $booking['is_deleted'] = 1;
                    $booking['created_date'] = date("Y-m-d H:i:s");
                    $booking['expired_date'] = date("Y-m-d H:i:s", strtotime(date("Y-m-d H:i:s") . " +30 minutes"));

                    $booking_id = $this->website->add_booking('booking_ads_main', $booking);
                    if ($booking_id) {
                        //update booking data that needed
                        $booking_update['invoice_id'] = 'UPZ#' . $booking_id;
                        $this->website->update_booking('booking_ads_main', 'id', $booking_id, $booking_update);

                        foreach ($bookedSuccess as $bdate => $bdata) {
                            $bkdetails = $bdata['booking_data'];
                            //print_r($bkdetails);exit;
                            if (!empty($bkdetails)) {
                                foreach ($bkdetails as $bkdata) {
                                    $booking_details['bk_id'] = $booking_id;
                                    $booking_details['booking_date'] = $bdate;
                                    $booking_details['booking_hours'] = $bkdata['booking_hours'];
                                    $booking_details['booking_hours_from'] = $bkdata['booking_hours_from'];
                                    $booking_details['booking_hours_to'] = $bkdata['booking_hours_to'];
                                    $booking_details['single_price'] = $bkdata['single_price'];
                                    $booking_details['tot_amount'] = $bdata['tot_amount'];
                                    //$booking_details['slot_created_date'] = date("Y-m-d H:i:s");

                                    $booking_did = $this->website->add_booking('booking_ads_details', $booking_details);
                                }
                            }
                        }
                    }
                    redirect('website/spaceConfirmation/' . base64_encode($bk_unique_code));
                    //redirect('website/spaceConfirmation/'.base64_encode($booking_id));
                    //redirect('website/spaceConfirmation/'.str_rot13($booking_id));
                } else {
                    //send error to user ads page redirect
                    //echo "error";
                    $this->session->set_flashdata('bookingError', 'Some of booking slot that you selected are already booked. please try again.');
                    redirect('website/spaceDetails/' . base64_encode($spaceid));
                }
            }
        }
    }

    public function spaceConfirmation($bku_id)
    {

        // auto fill user details if already logged in
        if (isCustomerLogin()) {
            $customer_id = $this->session->userdata('customer_id');
            $data['userData'] = GetAllRecord('booking_ads_customer', array('status' => 1, 'is_deleted' => 0, 'uid' => $customer_id), TRUE);
        }

        $bku_id = base64_decode($bku_id);
        //$id = str_rot13($bk_id);
        //$data['booking_id'] = $id;

        $bkData = $this->website->get_booking_data('booking_ads_main', 'bk_unique_code', $bku_id, 1);
        $id = $bkData['id'];

        $data['spaceid'] = $bkData['space_id'];
        $data['space'] = $this->website->get_booking_data('space', 'id', $bkData['space_id'], 1);
        $data['current'] = strtotime(date("Y-m-d H:i:s"));
        $data['created'] = strtotime($bkData['created_date']);
        $data['expired'] = strtotime($bkData['expired_date']);

        if ($data['current'] > $data['expired']) {
            $this->session->set_flashdata('bookingError', 'Booking time out! please try again.');
            redirect('website/spaceDetails/' . base64_encode($data['spaceid']));
        }

        $data['booking_id'] = $id;
        $data['config'] = footerSettings();
        $data['countryList'] = $this->space->getCountries();
        $data['checkoutType'] = 1;
        $data['redirectLink'] = "website/spaceConfirmation/" . base64_encode($bku_id);

        $userBookingData = $this->website->get_userBooking_data($id);
        /*if user already not created*/
        if (!empty($userBookingData) && $bkData['user_id'] == 0) {
            $data['userBookingData'] = $userBookingData;
            //$data['booking_id'] = $userBookingData[0]['id'];
            $this->load->view('templates/header', $data);
            $this->load->view('space/spaceRegistration', $data);
            $this->load->view('templates/footer', $data);
        } else {
            redirect('website');
        }

    }

    public function apply_coupon_code()
    {
        $coupon_code = $this->input->post('coupon_code');
        $booking_id = $this->input->post('booking_id');
        //check availability of code
        $couponData = $this->website->check_coupon_code($coupon_code);
        if (!empty($couponData)) {
            //apply discount
            $bkData = $this->website->get_booking_data('booking_ads_main', 'id', $booking_id, 1);//1=row,0=array
            if (!empty($bkData)) {
                $base_price = $bkData['base_price'];
                $coupon_discount = $couponData['coupon_discount'];

                if ($couponData['coupon_type'] == 'percentage') {
                    $discounted_amount = ($base_price * $coupon_discount) / 100;
                    $final_price = $base_price - $discounted_amount;
                    //update coupn code data and booking data
                    $c_data['coupon_limit_remain'] = $couponData['coupon_limit_remain'] - 1;
                    $c_id = $couponData['coupon_id'];
                    $cUpdate = $this->website->update_booking('coupon_details', 'coupon_id', $c_id, $c_data);

                    $b_data['coupon_id'] = $c_id;
                    $b_data['coupon_code'] = $coupon_code;
                    $b_data['coupon_discount'] = $couponData['coupon_discount'];
                    $b_data['discount_price'] = $discounted_amount;
                    $b_data['final_price'] = $final_price;
                    $bUpdate = $this->website->update_booking('booking_ads_main', 'id', $booking_id, $b_data);
                } else {
                    $final_price = $base_price - $coupon_discount;
                }
                echo json_encode(array('result' => 'success', 'msg' => 'Coupon has been applied successfully.', 'final_price' => $final_price, 'discount' => $discounted_amount, 'discount_val' => $couponData['coupon_discount']));
            }
        } else {
            echo json_encode(array('result' => 'fail', 'msg' => 'This coupon code is invalid or has expired.'));
        }
    }

    public function cancel_coupon_code()
    {
        $coupon_code = $this->input->post('coupon_code');
        $booking_id = $this->input->post('booking_id');
        //cancel coupon of code
        $couponData = $this->website->check_coupon_code_valid($coupon_code);
        if (!empty($couponData)) {
            //cancel discount
            $bkData = $this->website->get_booking_data('booking_ads_main', 'id', $booking_id, 1);
            if (!empty($bkData)) {
                $base_price = $bkData['base_price'];

                //update coupn code data and booking data
                $c_data['coupon_limit_remain'] = $couponData['coupon_limit_remain'] + 1;
                $c_id = $couponData['coupon_id'];
                $cUpdate = $this->website->update_booking('coupon_details', 'coupon_id', $c_id, $c_data);

                $b_data['final_price'] = $base_price;
                $b_data['coupon_id'] = 0;
                $b_data['coupon_code'] = "";
                $b_data['coupon_discount'] = 0;
                $b_data['discount_price'] = 0;
                $bUpdate = $this->website->update_booking('booking_ads_main', 'id', $booking_id, $b_data);

                echo json_encode(array('result' => 'success', 'msg' => 'Coupon has been canceled successfully.', 'final_price' => $base_price));
            }
        } else {
            echo json_encode(array('result' => 'fail', 'msg' => 'Failed to Cancel Coupon Code.'));
        }
    }

    function renameFile($fileName = '')
    {
        if ($fileName != "") {
            $extension = explode(".", $fileName);
            $file_name = md5(uniqid() . time()) . "." . end($extension);
        }

        return $file_name;
    }

    public function userBooking()
    {
        /* echo '<div class="main-content full booking-process"><div class="container">';
		echo '<h1>Booking Process<small></small></h1>';
		echo '<img src="'.ASSETS_URL.'images/booking-loading.gif" class="progress-image"/>';
		echo '</div></div>';
		exit; */


        /*
         * checkoutType = 1
         *                  Case 1 => user data is empty       = update => customer table
         *                  Case 2 => user data is filled      = insert => users table
         * checkoutType = 2 => guest checkout           = insert => users table
         */

        $id = $this->input->post('booking_id');
        $bkData = $this->website->get_booking_data('booking_ads_main', 'id', $id, 1);
        $bku_id = $bkData['bk_unique_code'];
        $checkoutType = $this->input->post('checkoutType');


        /*
            $customerData = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'mobile_no' => $this->input->post('mobile'),
            'address' => $this->input->post('address'),
            'city' => $this->input->post('town'),
            'state' => $this->input->post('state'),
            'country' => $this->input->post('country'),
            'street' => $this->input->post('street'),
            'zip_code' => $this->input->post('zipcode'),
            'created_date' => date("Y-m-d H:i:s")
        );*/


        if ($this->input->post()) {
            //            echo "<pre>"; print_r($this->input->post()); die;

            $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('mobile', 'mobile', 'trim|required|min_length[6]|max_length[16]|numeric');
            $this->form_validation->set_rules('zipcode', 'Zipcode', 'trim|required');
            $this->form_validation->set_rules('website_url', 'Website URL', 'trim|required|valid_url');
            $this->form_validation->set_rules('address', 'Address', 'trim|required');
            $this->form_validation->set_rules('country', 'Country', 'trim|required');
            $this->form_validation->set_rules('state', 'State', 'trim|required');
            $this->form_validation->set_rules('street', 'Street', 'trim|required');
            $this->form_validation->set_rules('town', 'Town', 'trim|required');

            if ($this->form_validation->run() === TRUE) {
                $result = 0;
                $id = $this->input->post('booking_id');
                //                $data = array();
                $data = array('first_name' => $this->input->post('first_name'), 'last_name' => $this->input->post('last_name'), 'email' => $this->input->post('email'), 'mobile_no' => $this->input->post('mobile'), 'address' => $this->input->post('address'), 'city' => $this->input->post('town'), 'state' => $this->input->post('state'), 'country' => $this->input->post('country'), 'street' => $this->input->post('street'), 'zip_code' => $this->input->post('zipcode'),);


                //                else if ($checkoutType == 2)
                //                {
                //                    $customerData['bk_id'] = $id;
                //                    Insert_Update_Data('booking_ads_users', array() , $customerData , true );
                //                }


                $file_name = '';
                if (isset($_FILES['banner'])) {
                    $errors = array();
                    $uploadSuccess = FALSE;
                    $file_name = $this->renameFile($_FILES['banner']['name']);
                    $file_size = $_FILES['banner']['size'];
                    $file_tmp = $_FILES['banner']['tmp_name'];
                    $file_type = $_FILES['banner']['type'];
                    $file_ext = @strtolower(end(explode('.', $file_name)));

                    $expensions = array("jpeg", "jpg", "png", "gif");

                    if (in_array($file_ext, $expensions) === FALSE) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    }
                    $targetDir = UPLOAD_ON_ROOT . 'user_booking/';
                    if (empty($errors) == TRUE) {
                        move_uploaded_file($file_tmp, $targetDir . $file_name);
                        $uploadSuccess = TRUE;
                    } else {
                        $this->session->set_flashdata('registerError', $errors);
                        redirect('website/spaceConfirmation/' . base64_encode($bku_id));
                    }
                }
                if ($uploadSuccess == TRUE) {
                    //                    $result = $this->website->createBookingUser($data);

                    if ($checkoutType == 1) {
                        $is_empty = checkCustomerData();
                        if ($is_empty) { //update code in customer table

                            $data['modified_date'] = date("Y-m-d H:i:s");
                            $customer_id = $this->session->userdata('customer_id');
                            $condition = array('uid' => $customer_id, 'status' => 1, 'is_deleted' => 0);
                            Insert_Update_Data('booking_ads_customer', $condition, $data);
                            unset($data['modified_date']);
                        }
                    }
                    // insert code in booking ads users
                    $data['bk_id'] = $id;
                    $data['created_date'] = date("Y-m-d H:i:s");
                    $result = Insert_Update_Data('booking_ads_users', array(), $data, TRUE);
                } else {
                    ///error message for file upload fail, please try again
                    redirect('website/spaceConfirmation/' . base64_encode($bku_id));
                }


                if ($result) {
                    //update user data to booking main
                    $up_user['user_id'] = $result;
                    $up_user['booking_banner_url'] = $this->input->post('website_url');
                    $up_user['booking_banner_image'] = $file_name;
                    if ($this->session->customer_id) {
                        $up_user['customer_id'] = $this->session->customer_id;
                    }
                    //$up_user['is_active'] = '1';
                    $userBkUpdate = $this->website->update_booking('booking_ads_main', 'id', $id, $up_user);

                    //Now send user to iBillMe payment GATEWAY with autosubmit form.
                    $booking_mainDetails = $this->website->get_booking_data('booking_ads_main', 'id', $id, 1);
                    $spaceid = $booking_mainDetails['space_id'];
                    $bookingDetails = $this->website->get_booking_data('booking_ads_details', 'bk_id', $id, 0);
                    $bookingFlag = 1;

                    if (!empty($bookingDetails)) {
                        foreach ($bookingDetails as $bkDetails) {
                            //check booking ads available for date
                            $bookingDate = $bkDetails['booking_date'];
                            $booking_hrs_from = $bkDetails['booking_hours_from'];

                            $ads_totData = $this->website->check_available_ads_slot($spaceid, $bookingDate, $booking_hrs_from);

                            if (!empty($ads_totData)) {
                                $bookingFlag = 0;
                                break;
                            }
                        }
                    }
                    //$bookingFlag ==1
                    if ($bookingFlag == 1) {

                        $action = PAYMENT_URL;
                        $member = MEMBER_ID;
                        $currency_code = CURRENCY_CODE;
                        if ($booking_mainDetails['final_price'] > 0) {
                            $full_name = $this->input->post('first_name') . " " . $this->input->post('last_name');

                            $form = '';
                            $form .= '<form name="frm_payment_method" action="' . $action . '" method="post">';
                            $form .= '<input type="hidden" name="member" value="' . $member . '" />';
                            $form .= '<input type="hidden" name="currency" value="' . $currency_code . '" />';
                            $form .= '<input type="hidden" name="price" value="' . $booking_mainDetails['final_price'] . '" />';
                            $form .= '<input type="hidden" name="email" value="' . $this->input->post('email') . '" />';
                            $form .= '<input type="hidden" name="customid" value="' . $id . '" />';
                            $form .= '<input type="hidden" name="username" value="' . SITE_TITLE . '" />';
                            $form .= '<input type="hidden" name="fullname" value="' . $full_name . '" />';
                            $form .= '</form>';

                            $form .= '<div style="text-align: center;"><div class="container">';
                            $form .= '<h1 style="text-align: center;border-top: 1px solid #eaeaea;border-bottom: 1px solid #eaeaea;padding: 15px 10px;display: inline-block;margin: 15px auto;">Booking Process<small></small></h1>';
                            $form .= '<img src="' . ASSETS_URL . 'images/booking-loading.gif" class="progress-image" style="display: block;margin: 0 auto;" />';
                            $form .= '</div></div>';

                            $form .= '<script>';
                            $form .= 'setTimeout("document.frm_payment_method.submit()", 0);';
                            $form .= '</script>';
                            echo $form;
                        } else {
                            //Add Payment
                            $p_data['uid'] = $result;
                            $p_data['email'] = $this->input->post('email');
                            $p_data['bk_id'] = $id;
                            $p_data['transaction_id'] = 'free booking';
                            $p_data['payment_type'] = 'free';
                            $p_data['amount'] = 0;
                            $p_data['total'] = 0;
                            $p_data['created_date'] = date("Y-m-d H:i:s");
                            $payment_id = $this->website->add_booking('booking_ads_payment', $p_data);

                            //not iBillMe,Free booking.
                            $b_data['total_paid_amount'] = 0;
                            $b_data['payment_id'] = $payment_id;
                            $b_data['payment_status'] = 'Completed';
                            $b_data['is_active'] = 1;
                            $b_data['is_deleted'] = 0;
                            $bookigUpdate = $this->website->update_booking('booking_ads_main', 'id', $id, $b_data);

                            //Booking Details Ads
                            $bk_data['is_active'] = 1;
                            $bookigDetailsUpdate = $this->website->update_booking('booking_ads_details', 'bk_id', $id, $bk_data);
                            //Booking User Data
                            $bu_data['payment_id'] = $payment_id;
                            $buserUpdate = $this->website->update_booking('booking_ads_users', 'uid', $result, $bu_data);
                            //send invoice email to user and admin
                            $this->send_invoice_email($id);
                            $this->session->set_flashdata('paymentSuccess', "Your order has been successfully placed. You will receive a confirmation email soon.");
                            redirect('website/success');
                        }
                    }else{
						$this->session->set_flashdata('bookingError', 'Some of booking slot that you selected are already booked. please try again.');
						redirect('website/spaceDetails/' . base64_encode($spaceid));
					}

                    //$this->session->set_flashdata('registerMsg', "User Created Successfully.");
                    //redirect('website/user_booking_payment/'.$id);
                } else {
                    $this->session->set_flashdata('registerMsg', "Some Error Occurred.");
                }

            } else {
                $this->session->set_flashdata('registerError', validation_errors());
                redirect('website/spaceConfirmation/' . base64_encode($bku_id));
            }
        } else {
            //$this->session->set_flashdata('registerError', validation_errors());
            $this->session->set_flashdata('registerError', "Please enter all booking related information.");
            redirect('website/spaceConfirmation/' . base64_encode($bku_id));
        }
    }

    //Apply/Test Payment GATEWAY iBillMe
    public function user_booking_payment($bk_id)
    {
        $data['booking_id'] = $bk_id;
        $data['config'] = footerSettings();

        $this->load->view('templates/header', $data);
        $this->load->view('website/payment', $data);
        $this->load->view('templates/footer', $data);
    }

    public function user_booking_payment_success()
    {
        $tranid = $_GET['TRANID'];
        $this->session->set_flashdata('tranid', $tranid);
        $bData = $this->website->get_dataByTranid($tranid);
        $bookingData = $this->website->getBookingDetails($bData['bk_id']);
        //echo "<pre>";print_r($bData);exit;
        $this->session->set_flashdata('tranData', $bData);
        $this->session->set_flashdata('bookingData', $bookingData);

        $this->session->set_flashdata('paymentSuccess', "Your order has been successfully placed. You will receive a confirmation email soon.");
        redirect('website/success');
    }

    public function user_booking_payment_notify()
    {
        //payment response
        error_log(print_r($_REQUEST, TRUE), 3, $_SERVER['DOCUMENT_ROOT'] . "/upzurge/logfiles/ipn_notify" . time() . ".log");

        if (isset($_REQUEST['customid']) && $_REQUEST['customid'] != '') {
            $booking_id = $_REQUEST['customid'];
            $bkData = $this->website->get_booking_data('booking_ads_main', 'id', $booking_id, 1);

            $order_total = $bkData['final_price'];
            $user_id = $bkData['user_id'];

            $email = $_REQUEST['email'];
            $transaction_id = $_REQUEST['transaction_id'];
            $amount = $_REQUEST['amount'];
            $total = $_REQUEST['total'];
            $transaction_fee = $_REQUEST['transaction_fee'];
            $date_sent = $_REQUEST['date_sent'];
            $payment_status = strtolower($_REQUEST['status']);


            //Add Payment
            $p_data['uid'] = $user_id;
            $p_data['email'] = $email;
            $p_data['bk_id'] = $booking_id;
            $p_data['amount'] = $amount;
            $p_data['total'] = $total;
            $p_data['transaction_id'] = $transaction_id;
            $p_data['transaction_fee'] = $transaction_fee;
            $p_data['IPN_date_sent'] = $date_sent;
            $p_data['IPN_status'] = $payment_status;
            $p_data['created_date'] = date("Y-m-d H:i:s");

            if ('success' == $payment_status) {
                if ($amount >= $order_total) {

                    $p_data['payment_type'] = 'paid';
                    $payment_id = $this->website->add_booking('booking_ads_payment', $p_data);

                    //iBillMe,Paid booking.
                    $b_data['payment_id'] = $payment_id;
                    $b_data['total_paid_amount'] = $total;
                    $b_data['transaction_fee'] = $transaction_fee;
                    $b_data['payment_status'] = 'Completed';
                    $b_data['is_active'] = 1;
                    $b_data['is_deleted'] = 0;
                    $bookigUpdate = $this->website->update_booking('booking_ads_main', 'id', $booking_id, $b_data);

                    //Booking Details Ads
                    $bk_data['is_active'] = 1;
                    $bookigDetailsUpdate = $this->website->update_booking('booking_ads_details', 'bk_id', $booking_id, $bk_data);
                    //Booking User Data
                    $bu_data['payment_id'] = $payment_id;
                    $buserUpdate = $this->website->update_booking('booking_ads_users', 'uid', $user_id, $bu_data);
                    //send invoice email to user and admin
                    $this->send_invoice_email($booking_id);
                    $this->session->set_flashdata('paymentSuccess', "Your order has been successfully placed.you will receive a confirmation email soon.");
                    redirect('website/success');
                } else {
                    $this->session->set_flashdata('paymentError', "Something went wrong, please contact administrator.");
                    redirect('website/fail');
                }
            } else {
                //Failed payment process
                $p_data['payment_type'] = 'fail';
                $payment_id = $this->website->add_booking('booking_ads_payment', $p_data);

                //iBillMe,Paid booking.
                $b_data['payment_id'] = $payment_id;
                $b_data['total_paid_amount'] = $total;
                $b_data['transaction_fee'] = $transaction_fee;
                $b_data['payment_status'] = 'Fail';
                $b_data['is_active'] = 0;
                $b_data['is_deleted'] = 1;
                $bookigUpdate = $this->website->update_booking('booking_ads_main', 'id', $booking_id, $b_data);

                //Booking Details Ads
                $bk_data['is_active'] = 0;
                $bk_data['is_deleted'] = 1;
                $bookigDetailsUpdate = $this->website->update_booking('booking_ads_details', 'bk_id', $booking_id, $bk_data);

                $this->session->set_flashdata('paymentError', "Payment process failed.");
                redirect('website/fail');
            }
        } else {
            $this->session->set_flashdata('paymentError', "Something went wrong, please contact administrator.");
            redirect('website/fail');
        }
    }

    public function user_booking_payment_fail()
    {
        error_log(print_r($_REQUEST, TRUE), 3, $_SERVER['DOCUMENT_ROOT'] . "/upzurge/logfiles/payment_fail" . time() . ".log");

        if (isset($_REQUEST['customid']) && $_REQUEST['customid'] != '') {
            $booking_id = $_REQUEST['customid'];
            $bkData = $this->website->get_booking_data('booking_ads_main', 'id', $booking_id, 1);
            $user_id = $_REQUEST['user_id'];

            $p_data['payment_type'] = 'fail';
            $p_data['created_date'] = date("Y-m-d H:i:s");
            $payment_id = $this->website->add_booking('booking_ads_payment', $p_data);

            //iBillMe,Paid booking.
            $b_data['payment_id'] = $payment_id;
            $b_data['payment_status'] = 'Fail';
            $b_data['is_active'] = 0;
            $b_data['is_deleted'] = 1;
            $bookigUpdate = $this->website->update_booking('booking_ads_main', 'id', $booking_id, $b_data);

            //Booking Details Ads
            $bk_data['is_active'] = 0;
            $bk_data['is_deleted'] = 1;
            $bookigDetailsUpdate = $this->website->update_booking('booking_ads_details', 'bk_id', $booking_id, $bk_data);

            $this->session->set_flashdata('paymentError', "Your payment process is failed. Please try again later.");
            redirect('website/fail');
        }
    }

    public function success()
    {
        $data['config'] = footerSettings();
        $this->load->view('templates/header', $data);
        $this->load->view('website/success', $data);
        $this->load->view('templates/footer', $data);
    }

    public function fail()
    {
        $data['config'] = footerSettings();
        $this->load->view('templates/header', $data);
        $this->load->view('website/fail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function formatTime($slotData)
    {
        $slot = explode("-", $slotData);

        if ($slot[0] < 1200) { // AM
            $end = "AM";
            $slot[0] = ($slot[0] / 100) . ":00 " . $end;
        } else {// PM
            $end = "PM";
            $slot[0] = (($slot[0] / 100) - 12) . ":00 " . $end;
        }

        if ($slot[1] < 1200) { // AM
            $end = "AM";
            $slot[1] = ($slot[1] / 100) . ":00 " . $end;
        } else {// PM
            $end = "PM";
            $slot[1] = (($slot[1] / 100) - 12) . ":00 " . $end;
        }

        return $slot;
    }

    function send_invoice_email($bk_id)
    {
        $data['orderData'] = $this->website->getDataByID($bk_id);
        $data['bookingData'] = $this->website->getBookingDetails($bk_id);

        foreach ($data['bookingData'] as $keys => $vals) {
            $slotStr = '';
            $slot = $vals['tot_slots'];
            $slots = explode(",", $slot);
            foreach ($slots as $key => $val) {
                $range = explode("-", $val);
                $slotStr .= date("g:i A", strtotime($range[0])) . " - " . date("g:i A", strtotime($range[1])) . ", ";
            }
            $data['bookingData'][ $keys ]['slots'] = rtrim($slotStr, ", ");
        }
        //        echo "<pre>"; print_r($data);die;

        $data['config'] = footerSettings();

        //send email to Admin
        $data['from'] = $data['config']['support_email'];
        $data['to'] = $data['config']['admin_email'];
        $data['order_text'] = "You have received one new order";
        $this->load->view('templates/order_mail', $data);

        //send email to user
        $data['from'] = $data['config']['support_email'];
        $data['to'] = $data['orderData']['customer']['email'];
        $data['order_text'] = "You order is confirmed on " . SITE_TITLE;
        $this->load->view('templates/order_mail', $data);
    }
}