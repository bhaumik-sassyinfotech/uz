<?php

class Cms_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_cmspage_info()
    {
		$this->db->select('*');
        $this->db->from('cms_master');
        $this->db->where('page_status' , 0);
        return $this->db->get()->result_array();
    }

    function get_cmspagewise_info($id)
    {
        $this->db->select('*');
        $this->db->from('cms_master');
        $this->db->where('page_id', $id);
        return $this->db->get()->result_array();
    }

    function update_cms_info($id, $data1)
    {
        $this->db->where('page_id', $id);
        $this->db->update('cms_master', $data1);
    }

    public function get_settings_vlaue_byId($ids)
    {
        $this->db->select('*');
        $this->db->from('config_settings');
        $this->db->where_in('setting_id', $ids);
        $this->db->order_by("setting_id", "asc");
        return $this->db->get()->result_array();
    }

}

?>