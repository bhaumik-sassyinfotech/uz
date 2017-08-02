<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Dashboard_model' , 'dash');
    }

    public function index() {
        if ($this->aauth->is_loggedin()) {
            $data['Module'] = "Dashboard";
            $data['liveToday'] = $this->dash->liveToday();
//            echo "l";
            $data['purchasedToday'] = $this->dash->purchasedToday();
//            $salesData = $this->dash->totalSales();
//            $data['sales'] = $salesData['sales_count'];
            $data['sales'] = $this->dash->totalSales();


            $count = $this->dash->active();
            $data['pages'] = $count['pagesCount']['pages_count'];
            $data['website'] = $count['websiteCount']['website_count'];

            $this->load->view('templates/header', $data);
            $this->load->view('dashboard', $data);
            $this->load->view('templates/footer', $data);
        } else
            redirect('account');
    }

    public function denied() {
        $data['Module'] = "Dashboard";
        $this->load->view('templates/header', $data);
        $this->load->view('noaccess', $data);
        $this->load->view('templates/footer', $data);
    }

}

?>
