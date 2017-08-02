<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sale_price extends CI_Controller
{

    function __construct() {

        parent::__construct();

        $this->load->model('space_model', 'space');
        $this->load->model('sale_price_model', 'sale');
    }

    /**
     * @return object
     */
    public function index()
    {
        $data['Module']   = "Space";
        $data['saleData'] = $this->space->getSalePriceData();

        $this->load->view('templates/header', $data);
        $this->load->view('sale_price/view', $data);
        $this->load->view('templates/footer', $data);
    }

}