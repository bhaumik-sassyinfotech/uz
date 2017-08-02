<?php
class Newsletter_model extends CI_Model {

	function __construct(){
	  parent::__construct();
	}
	
	public function getData(){
		$query = $this->db->get('newsletter');
		return $query->result_array();
	}
	
	public function  getData_byId($id){
		$this->db->select('newsletter.*,country.country_name,state.state_name,city.city_name');
		$this->db->from('newsletter');
		$this->db->join('country','country.country_id=newsletter.country','left');
		$this->db->join('state','state.state_id=newsletter.state','left');
		$this->db->join('city','city.city_id=newsletter.city','left');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
	}
		
	
}
?>
