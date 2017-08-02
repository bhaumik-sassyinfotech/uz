<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('string');
    }

    function upload($file_name, $name) {
        $original_path = realpath(UPLOAD_ON_ROOT . 'slider/original');
        $thumbs_path = realpath(UPLOAD_ON_ROOT . 'slider/thumb');

        $val = random_string('alnum', 5);
//        $filename = $_FILES['slider_image']['name'];
//        $temp = explode('.', $filename);
//        $imagename = $temp[0] . '_' . $val . '.' . $temp[1];
        $config = array(
            'upload_path' => $original_path,
            'allowed_types' => 'jpeg|jpg|png|gif',
            'overwrite' => TRUE,
            'create_thumb' => TRUE,
//            'file_name' => $imagename,
                //'thumb_marker'	=>	'_thumb',
        );
        $extension = explode(".", $name);
        $config['file_name'] = md5(uniqid() . time()) . "." . end($extension);
        $this->load->library('image_lib');
        //load upload class library
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($file_name)) {
            // case - failure
            $upload_error = array('error' => $this->upload->display_errors());
            return $upload_error;
        } else {
            // case - success
            $upload_data = $this->upload->data();

            $config = array(
                'source_image' => $upload_data['full_path'],
                'new_image' => $thumbs_path,
                'maintain_ratio' => true,
                'width' => 1343,
                'height' => 688
            );

            $this->image_lib->initialize($config);
            $this->image_lib->resize();

            return $upload_data;
        }
    }

    public function getData() {
        $this->db->order_by('slider_id', 'DESC');
        $this->db->where('slider_is_deleted', 'false');
        $query = $this->db->get('slider_details');
        return $query->result_array();
    }

    public function getDataByID($slider_id) {
        $this->db->where('slider_is_deleted', 'false');
        $this->db->where('slider_id', $slider_id);
        $query = $this->db->get('slider_details');
        return $query->row_array();
    }

    public function update($slider_id, $data) {
        $this->db->where('slider_id', $slider_id);
        $this->db->update('slider_details', $data);
    }

    public function insert($data) {
        $this->db->insert('slider_details', $data);
    }

    public function delete($slider_id) {
        $data = array(
            'slider_is_deleted' => 1,
        );

        $this->db->where('slider_id', $slider_id);
        $this->db->update('slider_details', $data);
    }

}

?>