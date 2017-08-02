<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/21/2017
 * Time: 4:12 PM
 */
class Enquiries extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'Enquiries_model' , 'enq' );
    }
    public function index()
    {
        $data['enqData'] = $this->enq->getData();
        $data['module']  = "Enquiries";
        $this->load->view('templates/header');
        $this->load->view('enquiries/view' , $data);
        $this->load->view('templates/footer');
    }
    public function enquiryDetail($id)
    {
        $data['enqData'] = $this->enq->getData($id);
        $data['module']  = "Enquiries";
        $this->load->view('templates/header');
        $this->load->view('enquiries/viewinfo' , $data);
        $this->load->view('templates/footer');
    }

}