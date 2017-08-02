<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/16/2017
 * Time: 5:45 PM
 */
class CMS extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'CMSmodel' , 'cms' );
    }
    public function index($slug=NULL)
    {
        $config   = footerSettings();
        $pageData = $this->cms->getDataBySlug($slug);
        $data['config']   = $config;
        $data['pageData'] = $pageData;
        $this->load->view('templates/header',$data);
        $this->load->view('CMS/view',$data);
        $this->load->view('templates/footer',$data);
    }
}
