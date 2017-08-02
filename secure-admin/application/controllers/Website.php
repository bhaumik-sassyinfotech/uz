<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Website extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('website_model', 'website');
        $this->load->model('Space_model', 'space');
    }

    public function index() {
        $data['Module'] = "Website";
        $data['websiteData'] = $this->website->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('website/view', $data);
        $this->load->view('templates/footer', $data);
    }

    public function delete()
    {
        $id = $this->uri->segment(3);

        $date = date("Y-m-d");
        $activeAds = $this->website->check_booking_active($id,$date);
        if(!empty($activeAds))
        {
            $message = "Sorry. You cannot delete this website as the ads present on it will be used in future.";
            $this->session->set_flashdata('webDeleteSuccMsg', $message);
        }else
        {
            $message = "Website has been deleted successfully.";
            $this->session->set_flashdata('webAddUpdMsg', $message);
            $this->website->delete($id);
            $this->website->deletePageByWebsite($id);
            $this->space->deleteSpaceByWebsite($id); 

        }

        redirect('website');
    }

    public function deletePage()
    {
        $id = $this->input->post('id');
        $this->website->deletePage($id);
    }

//    public function check

    function addedit($id = 0){
        $data = array();
        if ($id)
        {
            $websiteData = $this->website->getDataByID($id);
            $pagesData   = $this->website->getPageDataByID($id);
            if (!empty($websiteData) OR !empty($pagesData))
            {
                $data['websiteData'] = $websiteData;
                $data['pagesData']   = $pagesData;
            }
            else
                redirect('website');
            $data['action'] = "edit";
        } else
        {
            $data['action'] = "add";
        }
//
//        echo "<pre>"; print_r($data);die;
        if ($this->input->post())
        {
            $data = array(
                'website_name' => $this->input->post('website_name'),
                'website_url' => $this->input->post('website_url'),
                'short_description' => $this->input->post('short_description'),
                'website_description' => $this->input->post('website_description'),
                'website_rating' => $this->input->post('website_rating'),
                'website_description' => $this->input->post('website_description'),
            );

            $this->form_validation->set_rules('website_name','Website name', 'trim|required|min_length[3]');
            $this->form_validation->set_rules('website_url', 'Website URL', 'trim|required|valid_url');
            $this->form_validation->set_rules('short_description', 'Short Description', 'trim|required|max_length[255]');
            $this->form_validation->set_rules('website_description', 'Website Description', 'trim|required');
            $this->form_validation->set_rules('website_rating', 'Website Rating', 'trim|required|numeric');

//            $this->form_validation->set_rules('image', 'Logo', 'required');

            if ($this->form_validation->run() === TRUE)
            {
                if (!empty($_FILES['image']['name']))
                {
                        $fileName = $_FILES['image']['name'];
                        $upload = uploadFile('image', 'img', 'website', $fileName,212,212);
                        $old_image = $this->input->post('old_image');
                        if ($old_image != '' && file_exists(UPLOAD_ON_ROOT . "/website/" . $old_image))
                            unlink(UPLOAD_ON_ROOT . "/website/" . $old_image);
                        if (!empty($upload) && $upload['success'] == true)
                            $data['image'] = $upload['path'];

                }
//                $data['image'] = $this->input->post('image');

                $id = $this->input->post('id');
                if ($id)
                { /* Edit Data */
                    $data['updated_at'] = date("Y-m-d H:i:s");
                    $optresult = $this->website->update($id, $data);
                    //echo "<pre>"; print_r($data);die;
                    $editPageID = $this->input->post('edit_page_id');
                    $editPageName = $this->input->post('edit_page_name');

                    for ($i=0; $i< count($editPageID); $i++ )
                    {
                        $updatedData =
                        [
                            'website_id' => $id,
                            'updated_at' => date("Y-m-d H:i:s"),
                            'page_name'  => $editPageName[$i],
                        ];

                        $result = $this->website->updatePageByID( $editPageID[$i] , $updatedData );
                    }

                    $pageName = $this->input->post('page_name');
                    for($i=0; $i<count($pageName); $i++)
                    {
                        $uniqueID = unique_id();
                        $pageData =
                        [
                            'website_id'     => $id,
                            'page_name'      => $pageName[$i],
                            'created_at'     => date("Y-m-d H:i:s"),
                            'page_unique_id' => $uniqueID
                        ];
                        $result = $this->website->insertPage($pageData);
                    }

                    $action = "updated";
                } else { /* Add Data */
                    $data['created_at'] = date("Y-m-d H:i:s");
                    $data['website_unique_id'] = unique_id();
                    $optresult = $this->website->insert($data);

                    $pageName = $this->input->post('page_name');

                    for ($i=0; $i< count($pageName); $i++ )
                    {
                        $pageData =
                        [
                            'website_id' => $optresult,
                            'page_name'  => $pageName[$i],
                            'created_at' => date("Y-m-d H:i:s")
                        ];

                        $result = $this->website->insertPage($pageData);
                    }

                    $action = "added";
                }
                if ($optresult)
                {
                    $this->session->set_flashdata('webAddUpdMsg', "Website has been " . $action . " successfully");
                } else {
                    $this->session->set_flashdata('webAddUpdMsg', "Website is not " . $action . " successfully");
                }

                redirect('website');
            } else
            {
                $this->session->set_flashdata('errorMsg', validation_errors());
                $datashow['website_data']  = $data;
                $datashow['post_data']     = $this->input->post();
//				echo "<pre>"; print_r($datashow);die;
                $this->session->set_flashdata('inputError', $datashow);
                redirect('website/addEdit/'.$this->input->post('id'));
            }
        }

        $data['Module'] = "Website";
        $this->load->view('templates/header', $data);
        $this->load->view('website/addedit', $data);
        $this->load->view('templates/footer', $data);
    }
}