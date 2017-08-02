<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Customer extends CI_Controller {


    function __construct() {
        parent::__construct();
        $this->load->model('spaceModel');
        $this->load->model('WebsiteModel' , 'website');
        $this->load->library('pagination');
    }

    public function index($customer_id = 0)
    {
        $redirectLink = $this->input->post('redirectLink');
        if(empty($this->session->flashdata('redirect')))
        {
            $this->session->set_flashdata('redirect' , $redirectLink);
        }

//        if(!empty($this->session->flashdata("redirect")) && isCustomerLogin())
//        {//if redirect link found that is from spaceregistration -> login then redirect to that URL.
//            $link = base_url($this->session->flashdata("redirect"));
//            redirect($link);
//        } else if(!empty($this->session->flashdata("redirect")) && !isCustomerLogin())
//        {
//            $link = base_url($this->session->flashdata("redirect"));
//            $this->session->set_flashdata("errorMsg" , "Email address or password don't match.");
//            redirect($link);
//        }
        if (isCustomerLogin() && empty($redirectLink))
            redirect('customer/myaccount');
        $data = array();
        if ($this->input->post())
        {
            $this->form_validation->set_rules('email', "Email", "required|trim");
            $this->form_validation->set_rules('password', "Password", "required|trim");
            if ($this->form_validation->run() == false)
            {
                $this->session->set_flashdata('errorMsg', validation_errors());
            } else
            {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $user = Getallrecord('booking_ads_customer', array('email' => $email,  'is_deleted' => 0), true);
//                'status' => 1,
                if(empty($user))
                { // if empty not registered yet
                    $site = ucfirst(strtolower(SITE_TITLE));
                    $data = $this->input->post();
                    $data['errors'] = "You haven't registered on ".$site." yet. Please register yourself with us.";
                } else
                { // registered user
                    $userData = Getallrecord('booking_ads_customer', array('email' => $email, 'password' => md5($password), 'is_deleted' => 0), true);
                    if (!empty($userData)){
                        if (!$userData['status'])
                        {
                            $data = $this->input->post();
                            $data['errors'] = "Your account is not activated yet. Please activate your account from the activation link sent to your email address.";
                        } elseif( $userData['status'] )
                        {
                            $data = array('customer_id' => $userData['uid'], 'customer_first_name' => $userData['first_name'], 'customer_last_name' => $userData['last_name'], 'customer_mobileno' => $userData['mobile_no'], 'customer_email' => $userData['email'], 'customer_logged_in' => TRUE);
                            $this->session->set_userdata($data);
                            $this->session->set_flashdata('successMsg', "You are logged in....");

                            if(!empty($this->session->flashdata("redirect")) && isCustomerLogin())
                            {//if redirect link found that is from spaceregistration -> login then redirect to that URL.
                                $link = base_url($this->session->flashdata("redirect"));
                                redirect($link);
                            }
                            //                    redirect('customer/myaccount');
                            redirect('customer/myaccount');
                        }
                    } else
                    {//empty
                        if (!empty($this->session->flashdata("redirect")) && !isCustomerLogin()) {
                            $link = base_url($this->session->flashdata("redirect"));
                            $this->session->set_flashdata("errorMsg", "Email address or password don't match.");
                            redirect($link);
                        }
                        $data['errors'] = "Email address and password don't match.";
                    }
                }
            }
        }
        $data['login_type'] = 1;
        $customer_id = decrypt($customer_id);

        $data['config'] = footerSettings();
        $this->load->view('templates/header',$data);
//        $this->load->view('customer/login', $data);
        $this->load->view('login', $data);
        $this->load->view('templates/footer');
    }

    public function signup()
    {
//        if (isCustomerLogin())
//            redirect('home');
        $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim');
        $this->form_validation->set_rules('mobileno', 'Mobile No', 'required|trim|numeric');
//        $this->form_validation->set_rules('address', 'Address', 'required|trim');
//        $this->form_validation->set_rules('city', 'City', 'required|trim');
//        $this->form_validation->set_rules('state', 'State', 'required|trim');
//        $this->form_validation->set_rules('country', 'Country', 'required|trim');
//        $this->form_validation->set_rules('street', 'Street', 'required|trim');
//        $this->form_validation->set_rules('zip_code', 'Zipcode', 'required|trim|numeric');

        $data['config'] = footerSettings();
//        echo '<pre>';print_r($this->input->post());
        if ($this->input->post())
        {
            if ($this->form_validation->run() == false)
            {
                $this->session->set_flashdata("errorMsg", validation_errors());
                redirect('customer');
//                $data['errors'] = validation_errors();
            } else
            {
                $pass = md5($this->input->post('password'));
                $saveData = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name'  => $this->input->post('last_name'),
                    'email'      => $this->input->post('email'),
                    'password'   => $pass,
                    'mobile_no'  => $this->input->post('mobileno'),
//                    'address'    => $this->input->post('address'),
//                    'city'       => $this->input->post('city'),
//                    'state'      => $this->input->post('state'),
//                    'country'    => $this->input->post('country'),
//                    'street'     => $this->input->post('street'),
//                    'zip_code'   => $this->input->post('zip_code'),
                    'status'     => 0,
                    'created_date' => date('Y-m-d H:i:s')
                );
                $insert_id = Insert_Update_Data('booking_ads_customer', array(), $saveData, true);
                if ($insert_id)
                {
                    $this->session->set_flashdata("successMsg", "Your account has been created. <br />Please verify it by clicking on the activation link that has been sent to you via email.");
                    $parse = array(
                        'FIRSTNAME' => $saveData['first_name'],
                        'LASTNAME' => $saveData['last_name'],
                        'EMAIL' => $saveData['email'],
                        'PASSWORD' => $this->input->post('password'),
                        'ACTIVELINK' => base_url('customer/activateAccount/' . Encrypt(trim($saveData['email']))));
                    sendMailNew($saveData['email'], '', '', '', 'USER_REGISTRATION', $parse);
                    redirect('customer');
                }
            }
        }
        $this->load->view('templates/header' , $data);
        $this->load->view('customer/signup');
        $this->load->view('templates/footer');
    }

    public function transaction()
    {
        if( !isCustomerLogin() )
        {
            redirect(base_url('customer'));
        }

        $customerID = $this->session->customer_id;
        
        $data['transactionData'] = $this->website->getTransactions($customerID);
//        echo "<Pre>";print_r($data);die;
        $data['config'] = footerSettings();
//        echo "<pre>"; print_r($data);die;
        $this->load->view('templates/header' , $data);
        $this->load->view('customer/transaction-listing', $data);
        $this->load->view('templates/footer' , $data);
    }
    public function printTransaction($output='' , $bk_id='')
    {

//        $bk_id=2;
        $customerID = $this->session->customer_id;
        $data['orderData']     = $this->website->getDataByID($bk_id);
        $data['bookingData'] = $this->website->getBookingDetails($bk_id);
        $data['transactionData'] = $this->website->getTransactions($customerID,$bk_id);
        $data['CURRENCY'] = "NGN";

//        echo "<pre>"; print_r($data);die;

        //passing booking id will fetch only that booking related data
        $this->load->library('Pdf');
        //$pdf = new Pdf('P', 'mm', 'A4', true, 'UTF-8', false);

        $pdf = new Pdf(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor(SITE_TITLE);
        $pdf->SetTitle('Transaction');
        $pdf->SetSubject('Transaction Details');
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
        $html = $this->load->view('customer/transactionPDF', $data, TRUE);

        $pdf->writeHTML($html, true, false, false, false, '');

        if ($output == "download")
            $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'Transaction-'.$data['transactionData'][0]['transaction_id'].'.pdf', 'FD');
        if ($output == "view")
            $pdf->Output($_SERVER['DOCUMENT_ROOT'] . 'Transaction-'.$data['transactionData'][0]['transaction_id'].'.pdf', 'I');
        //$pdf->Output('Invoice'.rand(0,1000).'.pdf', 'I');
        //$pdf->Output('Invoice'.rand(0,1000).'.pdf ', 'FD');
    }

    function activateAccount($email = '')
    {
        if ($email != '') {
            $email = trim(Decrypt(trim($email)));
            $_SESSION['show_model']=0;
            $customerData = GetAllRecord('booking_ads_customer', array('email' => $email, 'is_deleted' => 0), true);
            $customer_id = encrypt($customerData['uid']);
            if (!empty($customerData))
            {
                if ( $customerData['status'] == 0 )
                {
                    Insert_Update_Data('booking_ads_customer', array('email' => $email), array('status' => 1));
                    $this->session->set_flashdata('successActivationMsg', "Your account has been activated successfully.Please login to access your account");
                } else
                {
                    $_SESSION['show_model']=1;
                    $this->session->set_flashdata('successMsg', "Your account has been already activated..");
                    //                    redirect('customer');
                }
            } else
            {
                $this->session->set_flashdata('errorMsg', "Activation link is not correct");
                //                redirect('customer');
            }
        } else {
            $this->session->set_flashdata('errorMsg', "Activation link is not correct");
            //            redirect('customer');
        }
        if ($this->session->userdata('customer_id'))
            redirect('home');
        else
            redirect('customer/index/' . $customer_id);
    }


    function forgot_password()
    {
        if (isCustomerLogin())
            redirect('home');
        $data = array();
        $this->form_validation->set_rules('email', 'Email', 'required|trim');

        if ($this->input->post())
        { 
            if ($this->form_validation->run() == false)
            {
                $this->session->set_flashdata('errorMsg' ,validation_errors());
                redirect('customer/forgot_password');
            } else
            {
                $email = trim($this->input->post('email'));
                $userData = Getallrecord('booking_ads_customer', array('email' => $email, 'is_deleted' => 0), true);

                if(!empty($userData))
                {
                    if($userData['status'])
                    {// user is activated
                        $encryptEmail = Encrypt($email);
                        $encryptTime = Encrypt(date('Y-m-d H:i:s'));
                        $encryptString = $encryptEmail . "--" . $encryptTime;
                        $parse = array(
                            'FIRSTNAME' => $userData['first_name'],
                            'LASTNAME' => $userData['last_name'],
                            'FORGOTPWDLINK' => base_url('customer/reset_password/' . $encryptString));
                        sendMailNew($email, '', '', '', 'FORGOT_PASSWORD', $parse);
                        $this->session->set_flashdata('successMsg' ,"Email has been sent to you for resetting your password");
                    } else
                    {// user is not activated
                        $this->session->set_flashdata('errorMsg' ,"Your account is not activated yet. Please activate your account from the activation link sent to your email address.");
                    }
                } else
                {
                    $site = ucfirst(strtolower(SITE_TITLE));
                    $this->session->set_flashdata('errorMsg' ,"You haven't registered on ".$site." yet. Please register yourself with us.");
                    redirect('customer/forgot_password');
                }
            }
        }
        $data['config'] = footerSettings();
        $this->load->view('templates/header' , $data);
        $this->load->view('customer/forgot_password', $data);
        $this->load->view('templates/footer');
    }


    function reset_password($arg = '')
    {

        if (isCustomerLogin())
            redirect('home');
        if ($arg != '')
//        if (!empty($arg))
        {
//            echo "<pre>"; print_r($arg);die;
            $data = array();
            $encryptedString = explode("--", $arg);
            if (!empty($encryptedString) && count($encryptedString) == 2)
            {
                $email = Decrypt(trim($encryptedString[0]));
                $timestamp = Decrypt(trim($encryptedString[1]));
                $date1 = date_create($timestamp);
                $date2 = date_create(date('Y-m-d H:i:s'));
                $diff = date_diff($date1, $date2);
                if ($diff->format("%h") <= 1)
                {
                    $data['email'] = trim($email);
                    $checkEmailExist = Getallrecord('booking_ads_customer', array('email' => trim($email), 'is_deleted' => 0), true);
                    if (empty($checkEmailExist))
                    {
                        $data['errors'] = "Reset Password link is wrong...";
                    }
                } else {
                    $data['errors'] = "Reset Password link has been expired";
                }
                $data['config'] = footerSettings();
                $this->load->view('templates/header', $data);
                $this->load->view('customer/reset_password', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $this->session->set_userdata('errorMsg', "Reset password link is wrong");
//                redirect('customer');
                redirect(base_url('customer/reset_password').$arg);
            }
        } else if ($this->input->post('email') != '')
        {
            $data = array();
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|matches[confirm_password]');
//            if ($this->form_validation->run() == false)
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('errorMsg', validation_errors());
                redirect(base_url('customer/reset_password/'));
            } else
            {
                $email = trim($this->input->post('email'));
                $checkEmailExist = Getallrecord('booking_ads_customer', array('email' => $email, 'status' => 1 , 'is_deleted' => 0), true);
                if (empty($checkEmailExist)) {
                    $data['errors'] = "This email is not registered...";
                } else
                {
                    $updData = array( 'password' => md5($this->input->post('password')));
                    Insert_Update_Data('booking_ads_customer', array('email' => $email), $updData);
                    $this->session->set_flashdata("successMsg", "Your password has been changed successfully");
                    redirect('customer');
                }
            }
            $data['config'] = footerSettings();
            $this->load->view('templates/header', $data);
            $this->load->view('customer/reset_password', $data);
            $this->load->view('templates/footer', $data);
        } else{
            redirect('home');
        }

    }

    function checkEmailForPass() {
        $returnArr = array();
        if ($this->input->post('email_id')) {
            $email = $this->input->post('email_id');
            $result = Getallrecord('booking_ads_customer', array('email' => $email, 'is_deleted' => 0));
            if (count($result))
                $returnArr['result'] = true;
            else
                $returnArr['result'] = false;
        } else
            $returnArr['result'] = true;
        echo json_encode($returnArr);
    }

    function checkEmail() {
        $returnArr = array();
        if ($this->input->post('email_id'))
        {
            $email = $this->input->post('email_id');
            $condition = array('email' => $email, 'is_deleted' => 0);
            if ($this->session->customer_id)
            {
                $customer_email = Getallrecord('booking_ads_customer', array('uid' => $this->session->customer_id, 'is_deleted' => 0), true, 'email');
                if ($email == $customer_email['email'])
                {
                    $returnArr['result'] = true;
                }
            }
            else
            {
                $result = Getallrecord('booking_ads_customer', $condition);
                if (count($result))
                    $returnArr['result'] = false;
                else
                    $returnArr['result'] = true;
            }
        } else
            $returnArr['result'] = true;
        echo json_encode($returnArr);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }


    function myaccount()
    {
        if (!isCustomerLogin())
        {
            redirect('customer');
        }
        $data = array();
        $data= Getallrecord('booking_ads_customer', array('uid' => $this->session->customer_id, 'is_deleted' => 0), true);
        $data['countries'] = GetAllRecord('countries');
        if ($this->input->post())
        {
            $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');

            if ($this->form_validation->run() == false)
            {
                $this->session->set_flashdata("profile_type", 1);
                $this->session->set_flashdata("errorMsg", validation_errors());
                redirect('customer/myaccount');
            } else
            {
                $saveData = array(
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
//                    'email' => $this->input->post('email'),
                    'mobile_no' => $this->input->post('mobileno'),
                    'address'    => $this->input->post('address'),
                    'city'       => $this->input->post('city'),
                    'state'      => $this->input->post('state'),
                    'country'    => $this->input->post('country'),
                    'street'     => $this->input->post('street'),
                    'zip_code'   => $this->input->post('zip_code'),

                    'modified_date' => date('Y-m-d H:i:s')
                );
                Insert_Update_Data('booking_ads_customer', array('uid' => $this->session->customer_id) , $saveData);
                $this->session->set_flashdata("successMsg", "Your details have been updated successfully..");
                redirect('customer/myaccount');
            }
        }

        $data['profile_type'] = 1;
        $data['config'] = footerSettings();
        $this->load->view('templates/header' , $data);
        $this->load->view('customer/myaccount', $data);
        
        $this->load->view('templates/footer');
    }

    function changePassword()
    {
        if (!isCustomerLogin())
            redirect('customer');
        //$userData = GetAllRecord('business_owner', array('busi_owner_id' => $this->owner_id), true, 'password');
        $data = GetAllRecord('booking_ads_customer', array('uid' => $this->session->customer_id, 'is_deleted' => 0), true);
        if ($this->input->post())
        {
            $newPassword = $this->input->post('password');
            $confPassword = $this->input->post('confirm_password');
            $this->form_validation->set_rules('password', 'Password', 'required|trim|matches[confirm_password]|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|trim|min_length[6]');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata("profile_type", 2);
                $this->session->set_flashdata("pwdErorMsg", "Passwords don't match.");
//                $url = base_url('customer/myaccount').'#change-password';
                $url = base_url('customer/myaccount');
                //                echo $url;die;
                redirect($url);
            }
            else
            {

//                if ($data['password'] != md5($oldPassword)) {
//                    $data['passerrors'] = "Invalid old password";
//                    $data['old_password'] = $oldPassword;
//                    $this->load->view('templates/header');
//                    $this->load->view('customer/myaccount', $data);
//                    
//                    $this->load->view('templates/footer');
//                } else {
                Insert_Update_Data('booking_ads_customer', array('uid' => $this->session->customer_id), array('password' => md5($newPassword)));
                if ( $this->session->userdata('customer_id') )
                {
                    $sess_array = array('customer_id', 'customer_first_name', 'customer_last_name', 'customer_mobileno', 'customer_email', 'customer_logged_in');
                    $this->session->unset_userdata($sess_array);
                }
                $this->session->set_flashdata("pwdSuccessMsg", "Your password has been changed successfully..");
                redirect('customer');
//                }
            }
        } else
            redirect('customer/myaccount');
    }

    public function getStates()
    {
        $name = $this->input->post('country');
        $data = $this->space->getState($name);
        $arr = array();
        foreach ($data as $d)
        {
            $arr[] = $d;
        }

        echo json_encode($arr);
    }

    public function ads_live($page=1)
    {
        if(!isCustomerLogin())
        {
            redirect(base_url('customer'));
        }
        $data['config'] = footerSettings();
        $customer_id = $this->session->customer_id;
        $config = array();
        $config["base_url"] = base_url()."customer/ads_live";
        $total_ads_live = $this->website->advertisements($customer_id,"live");

        $config["total_rows"] = count($total_ads_live);
        $config["per_page"] = 4;
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
//        $config['next_tag_open'] = "<li><a href='' class='next'>";
//        $config['prev_tag_open'] = "<li><a href='' class='prev'>";
        /*$config['next_tag_open'] = "<li><a href='' class='next'>";
        $config['next_tag_close'] = "</a></li>";
         $config['prev_tag_open'] = "<li><a href='' class='prev'>";
        $config['prev_tag_close'] = "</a></li>";*/       
        
        $config['next_tag_open'] = "<li><a href='' class='next'>NEXT";
        $config['next_tag_close'] = "</a></li>";
        $config['prev_tag_open'] = "<li><a href='' class='prev'>PREVIOUS";
        $config['prev_tag_close'] = "</a></li>";

        

        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li><a href='' class='last'>LAST";    
        $config['last_tag_close'] = "</a></li>";

        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['live'] = $this->website->advertisements($customer_id,"live",$page, $config['per_page']);

        $data['start_page'] = $page;
        $data['page_limit'] = $config['per_page'];
        $data["links"] = $this->pagination->create_links();
        $this->load->view('templates/header',$data);
        $this->load->view('customer/live_ads',$data);
        $this->load->view('templates/footer',$data);

    }

    public function ads_exhausted($page=1)
    {
        if(!isCustomerLogin()) 
        {
            redirect(base_url('customer'));
        }
        $data['config'] = footerSettings();
        $customer_id = $this->session->customer_id;
        $config = array();

        $config["base_url"] = base_url() . "customer/ads_exhausted";

//        $data['total_ads_exhausted'] = $this->website->advertisements($customer_id,"exhausted");
        $total_ads_exhausted = $this->website->advertisements($customer_id,"exhausted");

//        echo "<pre>"; print_r($total_ads_exhausted);die;
        $config["total_rows"] = count($total_ads_exhausted);
        $config["per_page"] = 4;


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
        
        $config['next_tag_open'] = "<li><a href='' class='next'>NEXT";
        $config['next_tag_close'] = "</a></li>";
        $config['prev_tag_open'] = "<li><a href='' class='prev'>PREVIOUS";
        $config['prev_tag_close'] = "</a></li>";
/*
        $config['next_tag_open'] = "<li>";
        $config['next_tag_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tag_close'] = "</li>";
*/
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
         $config['last_tag_open'] = "<li><a href='' class='last'>LAST";    
        $config['last_tag_close'] = "</a></li>";

        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['exhausted'] = $this->website->advertisements($customer_id,"exhausted",$page, $config['per_page']);

        $data['start_page'] = $page;
        $data['page_limit'] = $config['per_page'];
        $data["links"] = $this->pagination->create_links();
        $this->load->view('templates/header',$data);
        $this->load->view('customer/exhausted_ads',$data);
        $this->load->view('templates/footer',$data);
    }

    public function advertisements($page=1)
    {
        if(!isCustomerLogin())
        {
            redirect(base_url('customer'));
        }
        $data = array();

        $customer_id = $this->session->customer_id;
        $config = array();

        $config["base_url"] = base_url() . "customer/advertisements";

        //        $data['total_ads_exhausted'] = $this->website->advertisements($customer_id,"exhausted");
        $total_ads_scheduled= $this->website->advertisements($customer_id,"scheduled");
//        echo "<pre>"; print_r($total_ads_scheduled);die;

        $config["total_rows"] = count($total_ads_scheduled);
        $config["per_page"] = 4;


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
//        $config['next_tag_open'] = "<li><a href='' class='next'>";
        $config['next_tag_open'] = "<li><a href='' class='next'>NEXT";
        $config['next_tag_close'] = "</a></li>";
        $config['prev_tag_open'] = "<li><a href='' class='prev'>PREVIOUS";
        $config['prev_tag_close'] = "</a></li>"; 
        $config['first_tag_open'] = "<li>";
        $config['first_tag_close'] = "</li>";
        $config['last_tag_open'] = "<li><a href='' class='last'>LAST";
        $config['last_tag_close'] = "</a></li>";

        $config['reuse_query_string'] = TRUE;
        $this->pagination->initialize($config);
        $data['scheduled'] = $this->website->advertisements($customer_id,"scheduled",$page, $config['per_page']);

        $data['start_page'] = $page;
        $data['page_limit'] = $config['per_page'];
        $data["links"] = $this->pagination->create_links();

        $data['config'] = footerSettings();
        $this->load->view('templates/header',$data);
        $this->load->view('customer/advertisements',$data);
        $this->load->view('templates/footer',$data);
    }

    function advertisement_details($id)
    {
        if (!isCustomerLogin())
            redirect(base_url('customer'));
        $id = base64_decode($id);
        //        echo $id;die;
        $customer_id = $this->session->customer_id;

        //        Top table
        $data['scheduled'] = $this->website->getBookingDetails($id, "scheduled");
        $data['live'] = $this->website->getBookingDetails($id, "live");
        $data['exhausted'] = $this->website->getBookingDetails($id, "exhausted");
//        echo "<pre>"; print_r($data);die;
//        Barchart
        $barchartData = $this->website->barchart($id);
        $data['chart_is_empty'] = FALSE;
        if (!empty($barchartData))
        {
            $barData[] = array('date', 'count');
            foreach ($barchartData as $key => $value)
            {
                $barData[] = array($value['date'], (int)$value['count']);
            }
            $data['barChartData']  = json_encode($barData);
            $date = [];
            for($i=1; $i< count($barData); $i++)
            {
                $date[] = $barData[$i][0];
            }
            $data['dropdown'] = $date;
        } else
        {
            $data['chart_is_empty'] = TRUE;
        }
//        $barData[] = array('date', 'count');
//        if (!empty($barData))
//        {
//            foreach ($barchartData as $key => $value)
//            {
//                $barData[] = array($value['date'], (int)$value['count']);
//            }
//        }
//        echo "<pre>"; print_r($barData);die;

        $data['bk_id'] = $id;
        //line chart
        $lineChartData = $this->website->linechart($id);
        if(!empty($lineChartData))
        {
            $lineData[] = array('hours', 'clicks');

            for ($i = 0; $i < 24; $i++)
            {
                $lineData[] = array($i, 0);
            }

            foreach ($lineChartData as $key => $val)
            {
                $lineData[ $val['hour'] + 1 ] = array((int)$val['hour'], (int)$val['count']);
            }
            $data['lineChartData'] = json_encode($lineData);
        }else
        {
            $data['chart_is_empty'] = TRUE;
        }
        $data['config'] = footerSettings();
        $this->load->view('templates/header', $data );
        $this->load->view('customer/graphs' , $data );
        $this->load->view('templates/footer', $data );
    }

    function lineChart_ajax()
    {
//        $id   = base64_decode(trim($this->input->post('bk_id')));
        $id   = $this->input->post('bk_id');
        $date = date("Y-m-d" , strtotime($this->input->post('date') ));
        $lineChartData = $this->website->linechart($id , $date);
//        echo "<pre>"; print_r($lineChartData); die;
//        $lineData = array();
        $lineData[] = array('hours' , 'clicks');
        for($i=0; $i< 24; $i++)
        {
            $lineData[] = array($i,0);
        }

        foreach ($lineChartData as $key => $val)
        {
            $lineData[$val['hour']+1] = array((int) $val['hour'],(int)$val['count']);
        }
        echo json_encode($lineData);
    }



}
