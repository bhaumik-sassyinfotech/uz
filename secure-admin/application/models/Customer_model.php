<?php
class Customer_model extends CI_Model {

	function __construct(){
	  parent::__construct();
	}
	public function getData()
	{
		$this->db->where('is_deleted',0);
  		$query = $this->db->get('booking_ads_customer');
		return $query->result_array();	
	}
 	
	public function getDataByID($id)
	{
		$query = $this->db->get_where('booking_ads_customer', array('uid' => $id, 'is_deleted' => 0));
		return $query->row_array();
	}
	public function update($id,$data)
	{
		$this->db->where('uid', $id);
		return $this->db->update('booking_ads_customer', $data);
	}
    public function getState($id)
    {
        $query = $this->db->get_where('states', array('country_id' => $id) );
        return $query->result_array();
    }
}
?>
