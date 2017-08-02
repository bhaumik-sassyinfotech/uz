<?php
class Be_a_mentor_model extends CI_Model {

	function __construct(){
	  parent::__construct();
	}
	
	public function getData(){
		$query = $this->db->get('become_mentor');
		return $query->result_array();
	}
	
	public function  getData_byId($id){
		$this->db->select('become_mentor.*,country.country_name,state.state_name,city.city_name');
		$this->db->from('become_mentor');
		$this->db->join('country','country.country_id=become_mentor.country','left');
		$this->db->join('state','state.state_id=become_mentor.state','left');
		$this->db->join('city','city.city_id=become_mentor.city','left');
		$this->db->where('id',$id);
		return $this->db->get()->row_array();
	}
		
	
}
?>
