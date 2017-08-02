<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Config extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('utility_model', 'utilityModel');
    }

    public function edit() {
        $data['action'] = "edit";
        $data['Module'] = "Config";
        $data['configData'] = $this->utilityModel->getConfigData();

        $this->load->view('templates/header', $data);
        $this->load->view('config/addedit', $data);
        $this->load->view('templates/footer', $data);
    }

    function addedit() {
        $action = $this->input->post('action');
        $site_title = $this->input->post('site_title');
        $copyright_text = $this->input->post('copyright_text');
        $site_address = $this->input->post('site_address');
        $map_address = $this->input->post('map_address');
        $facebook_url = $this->input->post('facebook_url');
        $twitter_url = $this->input->post('twitter_url');
        $googleplus_url = $this->input->post('googleplus_url');
        $youtube_url = $this->input->post('youtube_url');
        $admin_email = $this->input->post('admin_email');
        $contact_email = $this->input->post('contact_email');
        $site_meta_keyword = $this->input->post('site_meta_keyword');
        $site_meta_desc = $this->input->post('site_meta_desc');
        $customer_care_no = $this->input->post('customer_care_no');
        $support_email = $this->input->post('support_email');
        $cod_available = $this->input->post('cod_available');

        if ($action == "edit") {

            $data = array(
                'site_title' => $site_title,
                'copyright_text' => $copyright_text,
                'site_address' => $site_address,
                'map_address' => $map_address,
                'facebook_url' => $facebook_url,
                'twitter_url' => $twitter_url,
                'googleplus_url' => $googleplus_url,
                'admin_email' => $admin_email,
                'contact_email' => $contact_email,
                'site_meta_keyword' => $site_meta_keyword,
                'site_meta_desc' => $site_meta_desc,
                'customer_care_no' => $customer_care_no,
                'support_email' => $support_email,
               
            );

            foreach ($data as $key => $value) {
                $this->db->query("UPDATE config SET config_value='" . $value . "' WHERE config_key='" . $key . "'");
            }

            $this->session->set_flashdata('EditSuccMsg', 'Config has been updated successfully.');
            redirect(base_url() . 'config/edit');
        }
    }

}

?>
