<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/21/2017
 * Time: 4:15 PM
 */
class Enquiries_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getData($id=0)
    {
        $this->db->order_by("id","desc");
        if($id) {
            $query = $this->db->get_where('contact_us', array( 'id' => $id , 'is_deleted' => 0));
            return $query->row_array();
        } else {
            $query = $this->db->get_where('contact_us', array('is_deleted' => 0));
            return $query->result_array();
        }


    }


}