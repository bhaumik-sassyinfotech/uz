<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/15/2017
 * Time: 5:28 PM
 */
class Pages extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('PagesModel' , 'pages');
    }

    public function view($id)
    {

    }
}