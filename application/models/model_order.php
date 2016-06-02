<?php
class Model_order extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }

    public function get_order($source){
        $this->db->where('order_company_id', $source['order_company_id']);
        $this->db->where('order_id', $source['order_id']);
        $query = $this->db->get(ORDER_MAIN);
        return $query->row_array();
    }

    public function get_order_member_id($source){
        $this->db->where('order_company_id', $source['order_company_id']);
        $this->db->where('order_id', $source['order_id']);
        $this->db->select('order_member_id');
        $query = $this->db->get(ORDER_MAIN);
        $member = $query->row_array();
        return $member['order_member_id'];
    }
    public function set_order($source)
    {
        $this->db->insert(ORDER_MAIN, $source);
        return $this->db->insert_id();
    }

    public function update_order($source)
    {
        $this->db->where('order_id', $source['order_id']);
        $this->db->where('order_company_id', $source['order_company_id']);
        $data['order_payment_status'] = $source['order_payment_status'];
        $data['order_hash_id'] = $source['order_hash_id'];
        $data['order_status'] = $source['order_status'];
        return $this->db->update(ORDER_MAIN, $data);
    }
}
