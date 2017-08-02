<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Coupons_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('string');
    }

    public function getData() {
        $this->db->order_by('coupon_order', 'DESC');
        $this->db->where('coupon_is_deleted', 'false');
        $query = $this->db->get('coupon_details');
        return $query->result_array();
    }

    public function getDataByID($coupon_id) {
        $this->db->where('coupon_is_deleted', 'false');
        $this->db->where('coupon_id', $coupon_id);
        $query = $this->db->get('coupon_details');
        return $query->row_array();
    }

    public function update($coupon_id, $data) {
        $this->db->where('coupon_id', $coupon_id);
        $this->db->update('coupon_details', $data);
    }

    public function insert($data) {
        $this->db->insert('coupon_details', $data);
    }

    public function delete($coupon_id) {
        $data = array(
            'coupon_is_deleted' => 'true',
        );

        $this->db->where('coupon_id', $coupon_id);
        $this->db->update('coupon_details', $data);
    }

    public function getDiscountedAmount($coupon_id, $sub_total) {
        $rsCoupon = $this->getDataByID($coupon_id);
        $sub_total = number_format((float) $sub_total, 2, '.', '');
        //$original_amount = $sub_total;
        $discount = number_format((float) $rsCoupon['coupon_discount'], 2, '.', '');
        if ($rsCoupon['coupon_type'] == "percentage") {
            $discounted_amount = ($sub_total * $discount) / 100;
            $final_amount = $sub_total - $discounted_amount;
        } else {
            $final_amount = $sub_total - $discount;
        }

        return $final_amount;
    }

    public function getActiveCoupon()
    {
        $today = date('Y-m-d');
        $this->db->order_by('coupon_order', 'DESC');
        $this->db->where('coupon_is_deleted', 'false');
        $this->db->where('coupon_status', 1);
        $this->db->where('coupon_limit_remain >=', 1);
        $this->db->where('coupon_startdate <=', $today);
        $this->db->where('coupon_enddate >=', $today);
        $query = $this->db->get('coupon_details');
        return $query->result_array();
    }
}

?>