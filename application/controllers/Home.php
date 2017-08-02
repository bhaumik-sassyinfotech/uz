<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('homeModel' , 'home');

    }
    public function index()
    {

        $data['config'] = footerSettings();

        $this->load->view('templates/header',$data);
        $this->load->view('home',$data);
        $this->load->view('templates/footer',$data);
    }


}