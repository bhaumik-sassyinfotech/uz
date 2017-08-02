<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/27/2017
 * Time: 12:08 PM
 */
class Dashboard_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }
    public function active()
    {
        $query = $this->db->query("SELECT count(*) as `website_count` FROM website WHERE `is_deleted` = 0");
        $data['websiteCount'] = $query->row_array();
        $query = $this->db->query("SELECT count(*) as `pages_count` FROM pages WHERE `is_deleted` = 0");
        $data['pagesCount'] = $query->row_array();

        return $data;
    }
    public function totalSales()
    {
//        $this->db->select('count(*) as sales_count');
//        $this->db->from('booking_ads_main');
//        $query = $this->db->get();
//        return $query->row_array();
        $query = $this->db->get_where('booking_ads_main' , array( 'is_active' => 1 , 'payment_status' => 'Completed' ));
        $result = $query->result_array();
//        echo "<pre>";print_r($result);die;
//        $count = 0;
        $p = 0;
        $today = date("Y-m-d");

        foreach ($result as $key => $val)
        {
            $bookingDate =  date("Y-m-d" , strtotime($val['created_date']));
            if($bookingDate == $today )
            {
//                $count++;
//                $p+=$val['total_paid_amount'];
                $p+=$val['final_price'];
            }
        }
        return $p;
    }
    public function purchasedToday()
    {
        $today = date("Y-m-d");
        $this->db->select('*');
        $this->db->from('booking_ads_main');
        $this->db->where(array( 'is_active' => 1 , 'payment_status' => 'Completed' ));
        $query = $this->db->get();
        $result = $query->result_array();
        $count = 0;
        foreach ($result as $key => $val)
        {
            $bookingDate =  date("Y-m-d" , strtotime($val['created_date']));
            if($bookingDate == $today )
            {
                $count++;
            }
        }
        return $count;
    }
    public function liveToday()
    {
        $today = date("Y-m-d");
//        $today = "2017-07-27";
        $this->db->select('*');
        $this->db->from('booking_ads_details');
        $this->db->like('booking_date' , $today , 'after');
        $this->db->group_by("bk_id");
        $this->db->where(array('is_deleted' => 0));
        $query = $this->db->get();
        $result = $query->result_array();
        $count=0;
        foreach( $result as $key => $val )
        {
            $this->db->select('COUNT(space_id) as cn');
            $this->db->from('booking_ads_main');
            $this->db->where(array( 'id' => $val['bk_id'] , 'is_deleted' => 0 , 'is_active' => 1));
            $query1 = $this->db->get()->row_array();
            $count += $query1['cn'];
//            echo "<pre>";$cnt[$key] = $query1->row_array();
//            echo $this->db->last_query();
        }
//        die;
//        echo "<Pre>"; print_r($count);
//        echo "<br>".$this->db->last_query();die;
        return $count;
    }
}