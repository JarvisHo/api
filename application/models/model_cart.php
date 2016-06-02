<?php
class Model_cart extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }
    public function set_cart($source)
    {
        $this->db->insert(PRODUCT_CART, $source);
    }
    public function get_cart($source)
    {
        $this->db->where('cart_company_id', $source['cart_company_id']);
        $this->db->where('cart_lang_id', $source['cart_lang_id']);
        $this->db->where('cart_code_hash_id', $source['cart_code_hash_id']);
        $this->db->where('cart_status', STATUS_TRUE);
        $this->db->join('product_model','product_model.model_id = product_cart.cart_model_id','left');
        $this->db->join('product_main','product_main.product_id = product_cart.cart_product_id','left');
        $this->db->where('product_model.model_status', STATUS_TRUE);
        $this->db->where('product_main.product_status', STATUS_TRUE);
        $cart = $this->db->get(PRODUCT_CART)->result_array();

        for($i = 0; $i < count($cart);$i++ ) {
            //取得標籤
            $this->db->select('product_attr_type.attr_type_name, product_attr.attr_value');
            $this->db->where('main_attr_link_product_id', $cart[$i]['cart_product_id']);
            $this->db->join('product_attr','product_attr.attr_id = product_main_attr_link.main_attr_link_product_attr_id','left');
            $this->db->join('product_attr_type','product_attr_type.attr_type_id = product_main_attr_link.main_attr_link_product_attr_type_id','left');
            $this->db->where('product_attr.attr_status', STATUS_TRUE);
            $cart[$i]['current_attr'] = $this->db->get('product_main_attr_link')->result_array();
            $cart[$i]['subtotal'] = $cart[$i]['product_unit_price'] * $cart[$i]['cart_qty'];
        }
        return $cart;
    }

    public function void_cart($source){
        $this->db->where('cart_company_id', $source['cart_company_id']);
        $this->db->where('cart_code_hash_id', $source['cart_code_hash_id']);
        $this->db->where('cart_status', STATUS_TRUE);
        $this->db->update(PRODUCT_CART, array('cart_status'=> STATUS_FALSE));
    }


}