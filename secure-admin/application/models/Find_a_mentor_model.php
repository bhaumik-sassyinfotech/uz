<?php
class Find_a_mentor_model extends CI_Model {

	function __construct(){
	  parent::__construct();
	}
	public function getData()
	{
		$query = $this->db->get('company_mentor');
		return $query->result_array();
	}
	
	public function  getData_byId($id){
		$this->db->select('company_mentor.*,country.country_name,state.state_name,city.city_name');
		$this->db->from('company_mentor');
		$this->db->join('country','country.country_id=company_mentor.country','left');
		$this->db->join('state','state.state_id=company_mentor.state','left');
		$this->db->join('city','city.city_id=company_mentor.city','left');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
	}
}
?>
