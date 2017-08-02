<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Error extends CI_Controller {
   function __construct() {
        parent::__construct();
		
	}
    public function index() 
    { 
        $this->output->set_status_header('404'); 
        $datas['content'] = 'error_404'; // View name 
		$datas['config'] = footerSettings();
		$this->load->view('templates/header', $datas);
        $this->load->view('errors/index', $datas);//loading in my template 
        $this->load->view('templates/footer', $datas);
    } 
} 
?>