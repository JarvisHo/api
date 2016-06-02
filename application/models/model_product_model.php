<?php
class Model_product_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }
    public function get_model($search_con) {
        if(!empty($search_con)) {
            if(!empty($search_con['model_name']))$this->db->like('model_name',$search_con['model_name']);
            if($search_con['model_category_id']!='all')$this->db->where('model_category_id',$search_con['model_category_id']);
            if($search_con['model_company_id']!='all')$this->db->where('model_company_id',$search_con['model_company_id']);
        }
        return $this->db->get('product_model')->result_array();
    }
    public function func_get_model_attr_type($cons) {
        $this->db->where('attr_type_product_model_id',$cons['con_model_id']);
        return $this->db->get('product_attr_type')->result_array();
    }
    public function func_get_num_of_own_model_by_category($category_id) {
        $this->db->where('product_model.model_category_id',$category_id);
        return sizeof($this->db->get('product_model')->result_array());
    }
}