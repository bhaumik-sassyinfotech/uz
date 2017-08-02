<?php
class Website_model extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    public function getData()
    {
        $this->db->where('is_deleted',0);
        $this->db->order_by("id ", "desc");
        $query = $this->db->get('website');
        return $query->result_array();
    }
    public function getTopData()
    {
        $this->db->where('is_top',0);
        $this->db->where('is_deleted',0);
        $query = $this->db->get('website');
        return $query->result_array();
    }
    public function getDataByID($id)
    {
        $query = $this->db->get_where('website', array('id' => $id, 'is_deleted' => 0));
        return $query->row_array();
    }
    public function update($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('website', $data);
    }
    public function insert($data)
    {
        if($this->db->insert('website', $data))
        {
            $mentor_id = $this->db->insert_id();
            return $mentor_id;
        }
        return false;
    }

    public function insertPage($data)
    {
        if($this->db->insert('pages',$data))
        {
            $page_id = $this->db->insert_id();
            return $page_id;
        }
        return false;
    }
    public function getPageDataByID($id)
    {
        $query = $this->db->get_where('pages', array('website_id' => $id, 'is_deleted' => 0));
        return $query->result_array();
    }
    public function deletePage($id)
    {
        $data = array
        (
            'is_deleted'	=> 	1,
        );
        $this->db->where('page_id',$id);
        $this->db->update('pages', $data);
    }
    public function deletePageByWebsite($id)
    {
        $data = array
        (
            'is_deleted'	=> 	1,
        );
        $this->db->where('website_id',$id);
        $this->db->update('pages', $data);
    }


    public function delete($id)
    {
        $data = array
        (
            'is_deleted'	=> 	1,
        );
        $this->db->where('id',$id);
        $this->db->update('website', $data);
    }

    public function updatePageByID( $id , $data )
    {
        $this->db->where('page_id', $id);
        return $this->db->update('pages', $data);
    }
    public function check_booking_active($webid,$date){
        $this->db->select('bkd.booking_date');
        $this->db->from('booking_ads_main bkm');
        $this->db->join('booking_ads_details bkd', 'bkd.bk_id = bkm.id' , 'left');
        $this->db->where('bkd.booking_date >=',$date);//before/after/none
        $this->db->where('bkm.web_id',$webid);
        $this->db->where('bkm.payment_status','Completed');
        $this->db->where('bkm.is_active',1);
        $this->db->where('bkm.is_deleted',0);
        $this->db->where('bkd.is_deleted',0);

        $query = $this->db->get();
        //echo $this->db->last_query();die;
        return $query->result_array();
    }
}
?>
