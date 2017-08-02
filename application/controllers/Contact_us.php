<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/21/2017
 * Time: 11:12 AM
 */
class Contact_us extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model( 'CMSmodel' , 'cms' );
        $this->load->model( 'Contact_model', 'contact');
        $this->load->library('parser');
    }
    public function index()
    {
        $slug = "contact_us";
        $data['config'] = footerSettings();
        $data['pageData'] = $this->cms->getDataBySlug($slug);
        $this->load->view('templates/header',$data);
        $this->load->view('contact_us',$data);
        $this->load->view('templates/footer',$data);
    }

    public function insert()
    {

        if ($this->input->post())
        {
            $this->form_validation->set_rules('name', 'Name', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required');
            $this->form_validation->set_rules('subject', 'subject', 'trim|required');
            $this->form_validation->set_rules('message', 'message', 'trim|required');
        }
        if ($this->form_validation->run() === TRUE)
        {
            $data = [
                'name'       => $this->input->post('name'),
                'email'      => $this->input->post('email'),
                'subject'    => $this->input->post('subject'),
                'message'    => $this->input->post('message'),
                'created_at' => date("Y-m-d H:i:s"),
            ];

            $result = $this->contact->insert($data);
            $data['config'] = footerSettings();
            if($result){
                $this->mailAdmin($data);
                $this->mailUser($data);
                $this->session->set_flashdata('contactSuccess', "Your message is sent successfully");
            } else
            {
                $this->session->set_flashdata('contactError', "Please try again in some time");
            }
            redirect('contact_us');
        }else
        {
            $this->session->set_flashdata('contactError', validation_errors());
            redirect('contact_us');
        }
    }
    public function  mailAdmin($data)
    {
        $template = $this->contact->getTemplate(1);

        $parse = array
        (
            'EMAIL'   => $data['email'],
            'SUBJECT' => $data['subject'],
            'MESSAGE' => nl2br($data['message'])
        );

//        $header_data = array('mail_banner'=>'');
        $header_data = array();
        $mail_body_header = $this->load->view('/templates/mail_header',$header_data,true);

//        $footer_data = array();
        $footer_data = array();
        $mail_body_footer = $this->load->view('/templates/mail_footer', $footer_data, true);

        $mail_body_main = $this->parser->parse_string($template['emailtemplate_desc'], $parse, TRUE);

        $mail_body = $mail_body_header.$mail_body_main.$mail_body_footer;


        $this->load->library('email');

        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($data['email'], $data['name']);
        $this->email->to($data['config']['admin_email']);
//                $this->email->cc('another@another-example.com');
//                $this->email->bcc('them@their-example.com');
        $subject1 = "Enquiry for: " . $data['subject'];
        $this->email->subject($subject1);

        $this->email->message($mail_body);
        $this->email->send();
    }
    public function mailUser($data)
    {
        $template = $this->contact->getTemplate(2);

        $parse=array('NAME'=>$data['name']);

//        $header_data = array('mail_banner'=>'');
        $header_data = array();
        $mail_body_header = $this->load->view('/templates/mail_header',$header_data,true);

//        $footer_data = array();
        $data['config'] = footerSettings();
        $mail_body_footer = $this->load->view('/templates/mail_footer', $data, true);

        $mail_body_main = $this->parser->parse_string($template['emailtemplate_desc'], $parse, TRUE);

        $mail_body = $mail_body_header.$mail_body_main.$mail_body_footer;
        //echo $mail_body;exit;
        $sub = "Thank you for contacting us";
        $config['mailtype'] = 'html';
        $this->email->initialize($config);
        $this->email->from($data['config']['admin_email']);
        $this->email->to($data['email']);
        $this->email->subject($sub);
        $this->email->message($mail_body);
        $this->email->send();
    }

}