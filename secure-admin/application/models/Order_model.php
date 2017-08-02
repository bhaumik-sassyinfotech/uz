<?php
class Order_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getData()
    {
//        $query = $this->db->get_where( 'booking_ads_main' , array( 'is_deleted' => 0 , 'is_active' => 1 ) );
        $this->db->order_by("id","desc");
        $query = $this->db->get_where( 'booking_ads_main' , array( 'is_deleted' => 0 ) );
//        echo "<pre>"; print_r($this->db->last_query());die;

//        $this->db->select('*');

        $bkm = $query->result_array();
        foreach ($bkm as $key => $val)
        {
            $query = $this->db->get_where( 'booking_ads_users' , array('uid' => $val['user_id']));
            $bkm[$key]['customer'] = $query->row_array();
            $query = $this->db->get_where( 'space' , array('id' => $val['space_id']) );
            $bkm[$key]['space'] = $query->row_array();
			$query = $this->db->get_where( 'website' , array('id' => $val['web_id']) );
            $bkm[$key]['website'] = $query->row_array();
			
        }
        return $bkm;
    }

    public function getDataByBooking($id)
    {
        $query = $this->db->get_where('booking_ads_details' , array( 'bk_id' => $id));
        return $query->result_array();
    }

    public function getDataByID($id)
    {
        $query = $this->db->get_where( 'booking_ads_main' , array( 'id' => $id , 'is_deleted' => 0 , 'is_active' => 1 ) );
        $bkm = $query->row_array();

        $query = $this->db->get_where( 'booking_ads_users' , array('uid' => $bkm['user_id']));
        $bkm['customer'] = $query->row_array();
        $query1 = $this->db->get_where( 'space' , array('id' => $bkm['space_id']) );
        $bkm['space'] = $query1->row_array();
		$query = $this->db->get_where( 'website' , array('id' => $bkm['web_id']) );
        $bkm['website'] = $query->row_array();
		
        return $bkm;
    }
    public function getBookingDetails($id)
    {
        $this->db->select('bkd.booking_date, sum(bkd.booking_hours) as tot_hours , bkd.tot_amount , GROUP_CONCAT((bkd.booking_hours_from) , ("-") , (bkd.booking_hours_to)) as tot_slots');
        $this->db->from('booking_ads_main bkm');
        $this->db->join('booking_ads_details bkd' , 'bkd.bk_id = bkm.id' , 'left');
        $this->db->where(array( 'bkd.bk_id' => $id , 'bkm.payment_status' => 'Completed' , 'bkm.is_active' => 1 , 'bkm.is_deleted' => 0 , 'bkd.is_deleted' => 0));
        $this->db->group_by('bkd.booking_date');
        $query = $this->db->get();
//        echo $this->db->last_query();die;
        return $query->result_array();
    }
}
?>
