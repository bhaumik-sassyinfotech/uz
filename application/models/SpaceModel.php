<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/15/2017
 * Time: 3:40 PM
 */
class SpaceModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }
    public function getData()
    {
        $query = $this->db->get_where('space',array( 'is_deleted'=> 0 , 'status' => 1 ));
        return $query->result_array();
    }
    public function getSpaceByID($websiteID)
    {
        $query = $this->db->get_where('space',array( 'website_id' => $websiteID ,'is_deleted'=> 0 , 'status' => 1 ));
        return $query->result_array();
    }
    public function getSalePriceByID($spaceID)
    {
        $query = $this->db->get_where('sale_price',array( 'p_id' => $spaceID ,'is_deleted' => 0 ));
        return $query->result_array();
    }
    public function minWebsitePrice($websiteID)
    {
        $this->db->select(' MIN(base_price_per_hour) as min_hourly , MIN(base_price_per_day) as min_daily');
        $query = $this->db->get_where( 'space',array( 'website_id' => $websiteID , 'is_deleted' => 0 , 'status' => 1 ));
        return $query->result_array();
    }
    public function getCountries()
    {
        $query = $this->db->get('countries');
        return $query->result_array();
    }
    public function getState($id)
    {
        $query = $this->db->get_where( 'states' , array('country_id' => $id) );
        return $query->result_array();
    }

    
}