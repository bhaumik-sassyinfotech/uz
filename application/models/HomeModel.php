<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/16/2017
 * Time: 10:13 AM
 */
class HomeModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function getBannerImages()
    {
        $query = $this->db->get_where( 'space' , array('is_deleted' => 0 ));
        return $query->result_array();
    }
}