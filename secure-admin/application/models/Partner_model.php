<?php
class Partner_model extends CI_Model {

	function __construct(){
	  parent::__construct();
	}
	public function getData()
	{
		$this->db->where('is_deleted',0);
  		$query = $this->db->get('partner');
		return $query->result_array();	
	}
 	public function getTopData()
	{
		$this->db->where('is_view',1);
		$this->db->where('is_deleted',0);
  		$query = $this->db->get('mentor');
		return $query->result_array();	
	}
	public function getDataByID($id)
	{
		$query = $this->db->get_where('partner', array('id' => $id, 'is_deleted' => 0));
		return $query->row_array();
	}
	public function update($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update('partner', $data); 
	}
	public function insert($data)
	{
		if($this->db->insert('partner', $data)){
			$partner_id = $this->db->insert_id();
			return $partner_id;
		}
		return false;
	}
		
	public function delete($id)
	{
		$data = array(
			'is_deleted'	=> 	1,
		);
		$this->db->where('id',$id);
		$this->db->update('partner', $data); 
	}
	
}
?>
