<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {

    function __construct() {
        parent::__construct();
       
    }

    public function index() {
        if ($this->aauth->is_loggedin()) {
            redirect(base_url('dashboard'));
        } else
            $this->load->view('login');
    }

    public function logout() {
        $this->aauth->logout();
        redirect('account');
    }

    function logcheck() {
        $email = trim($this->input->post('signin_id'));
        $pass = trim($this->input->post('signin_password'));
        if ($email != '' && $pass != '') {
            $result = $this->aauth->login($email, $pass);
            if ($result)
                redirect(base_url('dashboard'));
            else {
                $this->session->set_flashdata('invalidMsg', 'Email id or Password is invalid or your account is not active');
                redirect(base_url());
            }
        }
    }

    function forgetPassword() {
        $contact_email = $this->input->post('forget_email');
        $result = $this->aauth->remind_password($contact_email);
        if ($result) {
            $this->session->set_flashdata('maillSucc', 'Your New Password has been sent successfully on your email.');
            redirect(base_url());
        } else {
            $this->session->set_flashdata('noEmailFoundMsg', 'Sorry !! This email has not been registerd on our site.');
            redirect(base_url(), 'refresh');
        }
    }

    function profile() {
        $data = array();
        $id = $this->session->userdata('admin_id');
        $userData = $this->aauth->get_user($id);
        if ($userData)
            $data = $userData;
        $data['Module'] = "Profile";
        if ($this->input->post()) {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'email' => $this->session->userdata('admin_email'),
                'mobileno' => $this->input->post('mobileno'),
                'password' => $this->input->post('user_password'),
                'group_id' => $this->input->post('group_id'),
                'status' => $this->input->post('status'),
            );
            if (!empty($_FILES['image']['name'])) {
                $fileName = $_FILES['image']['name'];
                $upload = uploadFile('image', 'img', 'users', $fileName);
                $old_image = $this->input->post('old_image');
                if ($old_image != '' && file_exists(UPLOAD_ON_ROOT . "/users/" . $old_image))
                    unlink(UPLOAD_ON_ROOT . "/users/" . $old_image);
                if (!empty($upload) && $upload['success'] == true)
                   $data['image'] = $upload['path'];
            }
            $optresult = $this->aauth->update_user($id, $data);
            if ($optresult)
                $this->session->set_flashdata('addUpdMsg', "Profile is updated successfully");
            else
                $this->session->set_flashdata('addUpdMsg', "Profile is not updated successfully");
            redirect('account/profile');
        }
        //$data['priviledge'] = json_decode($this->session->userdata('admin_priviledge'));
        $this->load->view('templates/header', $data);
        $this->load->view('profile', $data);
        $this->load->view('templates/footer', $data);
    }

}

?>
