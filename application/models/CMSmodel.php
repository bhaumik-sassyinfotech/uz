<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/16/2017
 * Time: 5:47 PM
 */
class CMSmodel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getDataBySlug($slug = NULL)
    {
        $query = $this->db->get_where( 'cms_master' , array( 'page_link' => $slug , 'page_status' => 0 ) );
        return $query->row_array();
    }



}