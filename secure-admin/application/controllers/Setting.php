<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting extends CI_Controller {

    function __construct() {
        parent::__construct();
//        if ($this->aauth->is_loggedin() == FALSE) {
//            redirect('account');
//        }
    }
    public function index() {
        
        $data['datalist'] = GetAllRecord('config', array(), false);
        $data['type'] = 'Settings';
        $this->load->view('templates/header', $data);
        $this->load->view('setting/view', $data);
        $this->load->view('templates/footer', $data);
    }

    function addEdit($id = 0) {
        if ($this->input->post()) {
			
            $data = array(
                'config_value' => trim($this->input->post('config_value')),
            );
            $config_key = $this->input->post('config_key');
            if ($config_key) {
               
                $optresult = Insert_Update_Data('config', array('config_key' => $config_key), $data);
                $action = "updated";
            } 
            if ($optresult)
                $this->session->set_flashdata('success_message', "Setting has been updated successfully.");
            else
                $this->session->set_flashdata('error_message', "Setting can not be updated.");
            redirect('setting');
        }
        if ($id) {
            $configData = GetAllRecord('config', array('config_key' => $id), true);
            if (!empty($configData))
                $data = $configData;
            else {
                redirect('setting');
                exit;
            }
            $data['action'] = "edit";
            
        } else {
            redirect('setting');
            exit;
        }
        
        $data['title'] = 'Setting';
        $this->load->view('templates/header', $data);
        $this->load->view('setting/addedit', $data);
        $this->load->view('templates/footer', $data);
    }
       

}


