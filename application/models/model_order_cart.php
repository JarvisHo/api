<?php
class Model_order_cart extends CI_Model
{
    public function __construct()
    {
      $this->load->database();
    }
    public function set_order_cart($source)
    {
        $this->db->insert(ORDER_CART, $source);
        return $this->db->insert_id();
    }
}