<?php


class Space_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    public function getData()
    {
        $this->db->select('*');
        $this->db->from('website');
        $this->db->join('space', 'space.website_id = website.id');
//        $this->db->join( 'sale_price' , 'space.id = sale_price.p_id' );
        $this->db->where('space.is_deleted' , 0);
        $this->db->order_by("space.id", "desc");
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getDataByID($id)
    {
        $this->db->select('*, space.id as space_id,space.image as image_name,space.website_url as web_url');
        $this->db->from('space');
        $this->db->join('website', 'website.id = space.website_id');
        $this->db->where(array('space.id' => $id , 'space.is_deleted' => 0));
        $query = $this->db->get();
        return $query->row_array();
    }
    public function getSalePriceDataByID($id)
    {
        $this->db->select('*, space.image as image_name');
        $this->db->from('space');
        $this->db->join('sale_price', 'sale_price.p_id = space.id');
        $this->db->where(array('space.id' => $id , 'space.is_deleted' => 0, 'sale_price.is_deleted' => 0));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function getPageData()
    {
        $this->db->select('*');
        $this->db->from('website');
        $this->db->join('pages', 'pages.website_id = website.id');
        $this->db->where('pages.is_deleted' , 0);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function getPageListByID($id)
    {
        $this->db->select('page_id,page_name');
        $query = $this->db->get_where( 'pages' , array( 'website_id' => $id ,'is_deleted' => 0) );
        return $query->result_array();
    }

    public function update($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('space', $data);
    }
    public function updateSalePriceByID($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('sale_price', $data);
    }
    public function insert($data)
    {
        if($this->db->insert('space', $data))
        {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }
    public function insertSalePrice($sale_data)
    {

        if($this->db->insert('sale_price', $sale_data))
        {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
    }
    public function deleteSalePriceByID($id)
    {
        $data = array
        (
            'is_deleted'	=> 	1,
        );
        $this->db->where('id',$id);
        $this->db->update('sale_price', $data);
//        echo $this->db->last_query();die;
    }

    public function delete($id)
    {
        $data = array
        (
            'is_deleted'	=> 	1,
        );

        $this->db->trans_start();
        $this->db->where('p_id',$id);
        $this->db->update('sale_price', $data);
        $this->db->where('id',$id);
        $this->db->update('space', $data);
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }
    }

    public function getSalePriceData()
    {
        $this->db->select('*');
        $this->db->from('space');
        $this->db->join('sale_price', 'sale_price.p_id = space.website_id');
        $this->db->join('website', 'website.id = space.website_id');
        $this->db->where(array('space.is_deleted' => 0));
        $query = $this->db->get();
        return $query->result_array();
    }
    public function deleteSpaceByWebsite($id)
    {
        $data = array
        (
            'is_deleted'	=> 	1,
        );
        $this->db->trans_start();
        $this->db->select('*');
        $this->db->where('website_id',$id);
        $this->db->from('space');
        $query = $this->db->get();
        $result = $query->result_array();

        $this->db->where('website_id',$id);
        $this->db->update('space', $data);
        foreach ($result as $key => $val)
        {
            $this->db->where('p_id', $val['p_id']);
            $this->db->update('sale_price', $data);
        }
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE)
        {
            $this->db->trans_rollback();
            return FALSE;
        } else {
            $this->db->trans_commit();
            return TRUE;
        }

    }

    public function getSalePriceByID($id)
    {
        $this->db->select('*');
        $this->db->from('space');
        $this->db->join('sale_price', 'sale_price.p_id = space.website_id');
        $this->db->join('website', 'website.id = space.website_id');
        $this->db->where(array('space.is_deleted' => 0));
        $query = $this->db->get();
        return $query->result_array();
    }

}