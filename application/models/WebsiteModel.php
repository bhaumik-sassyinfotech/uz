<?php

/**
 * Created by PhpStorm.
 * User: BHAUMIK
 * Date: 6/15/2017
 * Time: 1:38 PM
 */
class WebsiteModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }

    public function getData($slug,$sort=0)
    {

        $this->db->select('*');
        $this->db->like('website_name', $slug, 'both');
        $this->db->from('website');
        $this->db->where('is_deleted' , 0);
        $query = $this->db->get();

        return $query->result_array();
//
    }

    public function getWebsiteDataByID($id)
    {
        $query = $this->db->get_where('website',array('id' => $id  ,'is_deleted' => 0 ));
        return $query->row_array();
    }

    public function getWebsiteData($start ,$limit,$slug,$sort=0)
    {
//        $this->db->order_by('id', 'ASC');
        $this->db->select('*');
        $this->db->where(array('is_deleted'=> 0));
        $this->db->like('website.website_name', $slug, 'both');
        if($sort == "latest") // latest first
        {
            $this->db->order_by("website.created_at", "ASC");
        } else if($sort == "alpha") // alphabetical order
        {
            $this->db->order_by("website.website_name", "ASC");
        }
        $this->db->limit($limit, (($start - 1) * $limit));
        $this->db->from('website');
        $query = $this->db->get();
//        echo $this->db->last_query();die;
        return $query->result_array();
    }
    public function getDetailByID($websiteID)
    {
        $this->db->select('*');
        $this->db->from('space');
        $this->db->join('pages', 'space.page_id = pages.page_id');
        $this->db->where(array( 'space.is_deleted' => 0 ,  'space.status' => 1 ));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPagesID($websiteID)
    {
//        $this->db->select('space.id as sp_id , pages.page_id as p_id , space.website_id , space.page_id , space.page as space_name , space.image , space.banner_height , space.banner_width , space.base_price_per_day , space.base_price_per_hour , pages.page_name');
        $this->db->select(' space.page_id , space.website_id ');
        $this->db->from('space');
        $this->db->join('pages', 'space.page_id = pages.page_id' , 'left');
        $this->db->where( array( 'space.website_id' => $websiteID ,  'space.status' => 1 , 'space.is_deleted' => 0 , 'pages.is_deleted' => 0 ) );
        $this->db->group_by('space.page_id');
        $query = $this->db->get();

        return $query->result_array();
    }
    public function getSpaceData($pageID , $websiteID)
    {
        $this->db->select('space.id as sp_id , pages.page_id as p_id , space.website_id , space.page_id , space.page as space_name , space.image , space.banner_height , space.banner_width , space.base_price_per_day , space.base_price_per_hour , pages.page_name');
        $this->db->from('space');
        $this->db->join('pages', 'space.page_id = pages.page_id' , 'left');
        $this->db->where(array('space.page_id' => $pageID , 'space.website_id' => $websiteID , 'space.is_deleted' => 0 , 'pages.is_deleted' => 0 ,  'space.status' => 1 ));
        $query = $this->db->get();
//        echo $this->db->last_query();die;
        return $query->result_array();
    }

    public function getSpaceDetails($spaceID)
    {
        $query = $this->db->get_where('space',array( 'id' => $spaceID ,'is_deleted' => 0 , 'status' => 1 ));
        $spaceResult   = $query->row_array();
        $today = date("Y-m-d");
        $salePrice = $this->db->get_where('sale_price' , array( 'p_id' => $spaceID , 'is_deleted' => 0 , 'end_date >=' => $today ));
        $data['salePriceData'] = $salePrice->result_array();
//        echo "<pre>"; print_r($this->db->last_query());die;
        $data['websiteData']   = $this->getWebsiteDataByID($spaceResult['website_id']);
        $data['spaceData']     = $spaceResult;
        return $data;

		//echo "<pre>";print_r($data);die;
    }

    public function minWebsitePrice($websiteID)
    {
        $this->db->select('MIN(base_price_per_hour) as min_hourly , MIN(base_price_per_day) as min_daily');
        $query = $this->db->get_where( 'space',array( 'website_id' => $websiteID , 'is_deleted' => 0 , 'status' => 1 ));
        return $query->row_array();
    }

    public function paginate(  $slug = NULL , $sort = NULL , $start = 0 , $limit = 0  )
    {
//        $this->db->select(' website.id , website.website_name as web_name , website.short_description as web_sdesc , website.website_description as web_desc, website.website_url as web_url , website.image as web_image , pages.page_id , pages.page_name');
        $this->db->select('website.id as web_id , website.image as web_image , website.website_name as web_name, website.short_description as web_sdesc , website.website_rating');

        if($slug)
        {
            $this->db->like('website.website_name', "$slug", 'both');
        }
        if( $sort === "alpha" ) // alphabetical order
        {
            $this->db->order_by("website.website_name", "ASC");
        }else
        {
            $this->db->order_by("website.created_at", "DESC");
        }
        if( $start && $limit )
        {
            $this->db->limit($limit, ( ($start - 1) * $limit ) );
        }
        $this->db->from('website');
        $this->db->join('space', 'space.website_id = website.id', 'left');
//        $this->db->from('space');
//        $this->db->join('website', 'space.website_id = website.id', 'left');
//        $this->db->join('pages' , 'pages.page_id = space.page_id', 'left');
        $this->db->group_by('website.id');
        $this->db->where( array( 'website.is_deleted' => 0 , 'space.is_deleted' => 0  , 'space.status' => 1 ) );
        $query = $this->db->get();
        $result = $query->result_array();
        foreach ($result as $key => $value)
        {
            $this->db->select('pages.page_name');
            $this->db->from('space');
//            $this->db->join('pages' , 'pages.website_id='.$value['web_id'] , 'left');
            $this->db->join('pages' , 'pages.page_id = space.page_id' , 'left');
            $this->db->group_by('pages.page_name');
            $this->db->where(array('pages.is_deleted' => 0 , 'space.is_deleted' => 0 , 'space.status' => 1));
            $query= $this->db->get();
            $result[$key]['pages'] = $query->result_array();
            $result[$key]['minPrice'] = $this->minWebsitePrice($value['web_id']);
        }
        return $result;
    }

	/*Booking functions*/
	
	public function booking_by_date($date,$spaceid){
		$this->db->select('bkd.*');
		$this->db->from('booking_ads_main bkm');
		$this->db->join('booking_ads_details bkd', 'bkd.bk_id = bkm.id' , 'left');
		$this->db->like('bkd.booking_date',$date, 'after');//before/after/none
		$this->db->where('bkm.space_id',$spaceid);
		$this->db->where('bkm.payment_status','Completed');
		$this->db->where('bkm.is_active',1);
		$this->db->where('bkm.is_deleted',0);
		$this->db->where('bkd.is_deleted',0);
		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
	}
	public function getspaceBookingDetails($spaceid,$date){
		//$date = date("Y-m-d");
		$this->db->select('bkd.booking_date,sum(`bkd`.`booking_hours`) as tot_hours');
		$this->db->from('booking_ads_main bkm');
		$this->db->join('booking_ads_details bkd', 'bkd.bk_id = bkm.id' , 'left');
		$this->db->where('bkd.booking_date >=',$date);
		$this->db->where('bkm.space_id',$spaceid);
		$this->db->where('bkm.payment_status','Completed');
		$this->db->where('bkm.is_active',1);
		$this->db->where('bkm.is_deleted',0);
		$this->db->where('bkd.is_deleted',0);
		$this->db->group_by('bkd.booking_date');
		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
	}
	public function get_space_booking_price($date,$spaceid,$timeSlot){
		/*if($timeSlot==2400){
			$check_date_start = $date." 00:00";
			$check_date_end = $date." 23:59";
		}else{
			$timeSlot = substr_replace($timeSlot, ":", 2, 0);
			$check_date_start = $date." ".$timeSlot;
			$check_date_end = $date." ".$timeSlot;
		}*/
		
		$this->db->select('sale_price_per_hour as price_per_hour,sale_price_per_day as price_per_day');
		$this->db->from('sale_price');
		$this->db->where('p_id',$spaceid);
		$this->db->where('start_date <=',$date);
		$this->db->where('end_date >=',$date);
		//$this->db->where('start_date <=',$check_date_start);
		//$this->db->where('end_date >',$check_date_end);
		
		//$this->db->where('end_date >=',$check_date_start);
		$this->db->where('is_deleted',0);
		$this->db->order_by('id','ASC');
		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		$result = $query->row_array();
		if(empty($result)){
			$this->db->select('base_price_per_hour as price_per_hour,base_price_per_day as price_per_day');
			$this->db->from('space');
			$this->db->where('id',$spaceid);
			$this->db->where('is_deleted',0);
			$query = $this->db->get();
			$result = $query->row_array();
		}
		return $result;
	}
	
	public function check_space_data($webid,$spaceid){
		$this->db->select('*');
		$this->db->from('space');
		$this->db->where('id',$spaceid);
		$this->db->where('website_id',$webid);
		$this->db->where('is_deleted',0);
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	
	public function check_available_ads_slot($spaceid,$date,$booking_hrs_from){
		$this->db->select('bkd.booking_date,sum(`bkd`.`booking_hours`) as tot_hours');
		$this->db->from('booking_ads_main bkm');
		$this->db->join('booking_ads_details bkd', 'bkd.bk_id = bkm.id' , 'left');
		$this->db->where('bkd.booking_date =',$date);
		$this->db->where('bkd.booking_hours_from',$booking_hrs_from);
		$this->db->where('bkm.space_id',$spaceid);
		$this->db->where('bkm.payment_status','Completed');
		$this->db->where('bkm.is_active',1);
		$this->db->where('bkm.is_deleted',0);
		$this->db->where('bkd.is_deleted',0);
		$this->db->group_by('bkd.booking_date');
		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->row_array();
	}
	
	public function get_booking_data($table,$id_name,$id,$array_type){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($id_name,$id);
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		if($array_type==1){
			return $query->row_array();
		}else{
			return $query->result_array();
		}
    }
	
	public function add_booking($table,$data){
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}
	public function update_booking($table,$id_name,$id,$data){
		$this->db->where($id_name,$id);
		$this->db->update($table, $data);
		return $id; 
	}
	
	public function check_coupon_code($coupon_code){
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('coupon_details');
		//$this->db->where('coupon_code',$coupon_code);
		//$this->db->where("coupon_code LIKE BINARY '$coupon_code'", NULL, true);
		$this->db->where("coupon_code = BINARY '$coupon_code'", NULL, true);
		$this->db->where('coupon_startdate <=',$date);
		$this->db->where('coupon_enddate >=',$date);
		//$this->db->where('coupon_limit_remain >',0);
		$this->db->where('coupon_limit_remain >=',1);
		$this->db->where('coupon_status',1);
		$this->db->where('coupon_is_deleted','false');
		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->row_array();
	}
	
	public function check_coupon_code_valid($coupon_code){
		$date = date("Y-m-d");
		$this->db->select('*');
		$this->db->from('coupon_details');
		//$this->db->where('coupon_code',$coupon_code);
		//$this->db->where("coupon_code LIKE BINARY '$coupon_code'", NULL, true);
		$this->db->where("coupon_code = BINARY '$coupon_code'", NULL, true);
		$this->db->where('coupon_startdate <=',$date);
		$this->db->where('coupon_enddate >=',$date);
		//$this->db->where('coupon_limit_remain >',0);
		//$this->db->where('coupon_limit_remain >=',1);
		//$this->db->where("fieldname LIKE BINARY 'value'", NULL, true);
		//$this->db->like("fieldname LIKE BINARY 'value'", NULL);
		$this->db->where('coupon_status',1);
		$this->db->where('coupon_is_deleted','false');
		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->row_array();
	}
	

	
	public function get_userBooking_data($id)
    {
        $this->db->select('bkm.base_price,bkm.final_price,bkm.coupon_id,bkm.coupon_code,bkm.coupon_discount,bkm.discount_price,bkd.*,sum(bkd.booking_hours) as tot_booking_hrs');
		$this->db->from('booking_ads_details bkd');
		$this->db->join('booking_ads_main bkm', 'bkd.bk_id = bkm.id' , 'left');
		$this->db->where('bkd.bk_id',$id);
		$this->db->group_by('bkd.booking_date');
		
		$query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result_array();
		
		/* $booking = $this->db->get_where( 'booking_ads_main' , array( 'id' => $id , 'is_deleted' => 0 , 'is_active' => 1 ) );
        $data['bookingData'] = $booking->result_array();
        $space = $this->db->get_where( 'space' ,  array( 'id' => $id , 'is_deleted' => 0 , 'status' => 1) );
        $data['spaceData']   = $space->result_array();
//        echo $this->db->last_query();die;
        return $data; */
    }
    public function createBookingUser($data)
    {
        if($this->db->insert('booking_ads_users' , $data))
        {
            return $this->db->insert_id();
        }
        return false;
    }

	function unique_id()
    {
		return substr(md5(microtime()*rand(0,9999)),0,15);
	}

    public function getDataByID($id)
    {
        $query = $this->db->get_where( 'booking_ads_main' , array( 'id' => $id , 'is_deleted' => 0 , 'is_active' => 1 ) );
        $bkm = $query->row_array();

        $query = $this->db->get_where( 'booking_ads_users' , array('uid' => $bkm['user_id']));
        $bkm['customer'] = $query->row_array();
        $query1 = $this->db->get_where( 'space' , array('id' => $bkm['space_id']) );
        $bkm['space'] = $query1->row_array();

        return $bkm;
    }
    public function getBookingDetails($id , $type='')
    {
        $today = date("Y-m-d");
        $this->db->select('bkd.booking_date , bkm.booking_banner_image , sum(bkd.booking_hours) as tot_hours , bkd.tot_amount , bkd.single_price , GROUP_CONCAT((bkd.booking_hours_from) , ("-") , (bkd.booking_hours_to)) as tot_slots');
        $this->db->from('booking_ads_main bkm');
        $this->db->join('booking_ads_details bkd' , 'bkd.bk_id = bkm.id' , 'left');
        if($type == "scheduled")
        {
            $this->db->where('bkd.booking_date >', $today);
        }
        elseif ($type == "live")
        {
            $this->db->where('bkd.booking_date =', $today);
        }
        elseif ($type == "exhausted")
        {
            $this->db->where('bkd.booking_date <', $today);
        }
        $this->db->where(array( 'bkd.bk_id' => $id , 'bkm.payment_status' => 'Completed' , 'bkm.is_active' => 1 , 'bkm.is_deleted' => 0 , 'bkd.is_deleted' => 0));
        $this->db->group_by('bkd.booking_date');
        $query = $this->db->get();
        $results = $query->result_array();

        foreach ($results as $keys => $vals)
        {
            $slotStr = '';
            $slot = $vals['tot_slots'];
            $slots = explode("," , $slot);
            foreach ($slots as $key => $val)
            {
                $range = explode("-" , $val);
                $slotStr .= date("g:i A",strtotime($range[0]))." - ".date("g:i A",strtotime($range[1])).", ";
            }
            $results[$keys]['slots'] = rtrim($slotStr , ", ");
        }
        return $results;
    }

    public function getTransactions($customerID,$bk_id='')
    {
        $this->db->select('bkp.transaction_id , bkm.id as bkID,  bkp.total , bkp.created_date , bkd.booking_date , sum(bkd.booking_hours) as tot_hours , web.website_name , space.page');
        $this->db->from('booking_ads_main bkm');
        //        $this->db->where(array('));
        $this->db->join('booking_ads_payment bkp', 'bkp.bk_id = bkm.id' , 'left');
        $this->db->join('website web', 'bkm.web_id = web.id' , 'left');
        $this->db->join('space', 'bkm.space_id = space.id' , 'left');
        $this->db->join('booking_ads_details bkd' , 'bkd.bk_id = bkm.id' , 'left');
        $this->db->group_by('bkd.bk_id');
        if($bk_id)
        {
            $this->db->where('bkm.id',$bk_id);
        }
//        $this->db->group_by('bkd.booking_date');
        $this->db->where(array('bkm.customer_id' => $customerID , 'bkm.payment_status' => 'Completed' , 'bkm.is_active' => 1 , 'bkm.is_deleted' => 0 , 'bkd.is_deleted' => 0 ));
        $query = $this->db->get();
//        echo "<pre>"; print_r($this->db->last_query());
        $results = $query->result_array();
//        $results = $query->row_array();
        foreach ($results as $key => $value)
        {
            $this->db->select('bkd.booking_date');
            $this->db->from('booking_ads_details bkd');
            $this->db->where('bkd.bk_id' , $value['bkID']);
            $this->db->group_by('bkd.booking_date');
            $query = $this->db->get()->result_array();
            $results[$key]['tot_days'] = count($query);

        }
//        echo "<pre>"; print_r($results);die;
        return $results;
    }

    public function advertisements( $customerID , $type , $start = 0 , $limit = 0 )
    {
        $today = date("Y-m-d");
        $this->db->select('web.website_name , bkm.booking_banner_image , space.page , bkp.transaction_id , bkp.bk_id ,  bkp.total , bkp.created_date , bkd.booking_date , sum(bkd.booking_hours) as tot_hours');
        $this->db->from('booking_ads_main bkm');
        $this->db->join('booking_ads_payment bkp', 'bkm.id = bkp.bk_id' , 'left');
        $this->db->join('website web', 'bkm.web_id = web.id' , 'left');
        $this->db->join('space', 'bkm.space_id = space.id' , 'left');
        $this->db->join('booking_ads_details bkd' , 'bkd.bk_id = bkm.id' , 'left');
        $this->db->order_by("bkm.id","desc");
        if( $start && $limit )
        {
            $this->db->limit($limit, ( ($start - 1) * $limit ) );
        }
        $this->db->group_by('bkd.bk_id');
        if($type == "scheduled")
        {
            $this->db->where('bkd.booking_date >', $today);
        }
        elseif ($type == "live")
        {
            $this->db->where('bkd.booking_date =', $today);
        }
        elseif ($type == "exhausted")
        {
            $this->db->where('bkd.booking_date <', $today);
        }
        $this->db->where(array( 'bkm.customer_id' => $customerID , 'bkm.payment_status' => 'Completed' , 'bkm.is_active' => 1 , 'bkm.is_deleted' => 0 , 'bkd.is_deleted' => 0 ));
        $query = $this->db->get();
        $results = $query->result_array();
//        echo "<pre>"; print_r($this->db->last_query());die;
        foreach ($results as $key => $value)
        {
            $this->db->select('sum(views_count) as count');
            $this->db->from('booking_ads_views');
            $this->db->where('bk_id' , $value['bk_id']);
            $queryy = $this->db->get()->row_array();
            if($queryy['count'])
            {
                $results[ $key ]['views'] = $queryy['count'];
            }
            else
            {
                $results[ $key ]['views'] = 0;
            }

//            $this->db->select('MIN(booking_date) as start , MAX(booking_date) as end , count(booking_date) as tot_days');
            $this->db->select('MIN(booking_date) as start , MAX(booking_date) as end ');
            $this->db->from('booking_ads_details bkd');
            $this->db->where('bkd.bk_id' , $value['bk_id']);
            $this->db->group_by('bkd.bk_id');
            $query1 = $this->db->get()->row_array();
//            echo "<pre>"; print_r($this->db->last_query());
            $results[$key]['start']    = $query1['start'];
            $results[$key]['end']      = $query1['end'];

            $this->db->select('*');
            $this->db->from('booking_ads_details bkd');
            $this->db->where('bkd.bk_id' , $value['bk_id']);
            $this->db->group_by('bkd.booking_date');
            $query2 = $this->db->get()->result_array();
//            echo "<pre>"; print_r($query2);
            $results[$key]['tot_days'] = count($query2);

//            $query1 = $this->db->get()->result_array();

//            $results[$key]['tot_days'] = $query1[0]['tot_days'];
//            $results[$key]['start']    = $query1[0]['start'];
//            $results[$key]['end']      = $query1[0]['end'];
        }
//        echo "<hr><pre>"; print_r($results);
//        die;
        return $results;
    }

    public function barchart($id)
    {
        $this->db->select('DATE(view_date) as date,  sum(views_count) as count');
        $this->db->from('booking_ads_views');
        $this->db->where('bk_id' , $id);
        $this->db->group_by('CAST(view_date AS DATE)');
        $query = $this->db->get();
        $results = $query->result_array();
//        echo "<pre>";print_r($this->db->last_query());die;
       return $results;
    }
    public function lineChart($id , $date='')
    {// $date="2017-07-20";
        if( empty($date) )
        {
            $this->db->select('DATE(view_date) as date,  sum(views_count) as count');
            $this->db->from('booking_ads_views');
            $this->db->where('bk_id' , $id);
            $this->db->group_by('CAST(view_date AS DATE)');
            $query = $this->db->get();
            $results = $query->row_array();
            $date = $results['date'];
        }
        $this->db->select('DATE(view_date) as date,  HOUR(view_date) as hour , sum(views_count) as count');
        $this->db->from('booking_ads_views');
        $this->db->where('bk_id' , $id);
        $this->db->where('DATE(view_date)' , $date);
//        $this->db->like('view_date', $date, 'after');
        $this->db->group_by('HOUR(view_date)');

        $query = $this->db->get();
        $results = $query->result_array();

        return $results;
    }
	
	public function get_dataByTranid($tranid){
		$this->db->select('*');
		$this->db->from('booking_ads_payment');
		$this->db->where('transaction_id',$tranid);
		$query = $this->db->get();
        $results = $query->row_array();
        return $results;
	}
    
}