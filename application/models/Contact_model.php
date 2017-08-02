<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/21/2017
 * Time: 11:57 AM
 */
class Contact_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function insert($data)
    {
        if($this->db->insert('contact_us', $data))
        {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }
    public function getTemplate($id)
    {
        $query = $this->db->get_where( 'email_template' , array( 'emailtemplate_id' => $id ) );
        return $query->row_array();
    }

}