<?php
class Model_product extends CI_Model
{

    public function __construct() {
        $this->load->database();
    }

    public function get_category_list($condition) {
        if(!empty($condition['company_id']))$this->db->where('category_company_id',$condition['company_id']);
        if(!empty($condition['search_name']))$this->db->like('category_name',$condition['search_name']);
        $this->db->select('category_id, category_name');
        $this->db->where('category_status', 0);
        return $this->db->get('product_category')->result_array();
    }

    //前台查詢單一類別所有商品
    public function get_product_list_by_category_id($condition) {
        if(!empty($condition['company_id']))$this->db->where('model_company_id',$condition['company_id']);
        if(!empty($condition['model_category_id']))$this->db->where('model_category_id',$condition['model_category_id']);
        $this->db->join('product_main', 'product_model.model_init_product_id = product_main.product_id', 'left');
        $this->db->where('model_status', 0);
        $response = $this->db->get('product_model')->result_array();
        return $response;
    }

    public function func_get_product($condition) {
        if(!empty($condition)) {
            if(isset($condition['product_id']))       $this->db->where('product_id',    $condition['product_id']);
            if(isset($condition['company_id']))       $this->db->where('product_company_id',    $condition['company_id']);
            if(isset($condition['product_lang_id']))  $this->db->where('product_lang_id',  $condition['lang']);
        }
        //查到 model and product
        $this->db->join('product_model', 'product_model.model_id = product_main.product_model_id', 'left');
        $this->db->where('model_status', 0);
        $response = $this->db->get('product_main')->row_array();

//        echo $this->db->last_query();
//        print_r($response);

        $this->db->where('image_status', 0);
        $this->db->where('image_product_id', $condition['product_id']);
        $response['product_image'] = $this->db->get('product_image')->result_array();

        $this->db->where('category_id', $response['model_category_id']);
        $response['product_category'] = $this->db->get('product_category')->row_array();

        $this->db->where('main_attr_link_product_id', $condition['product_id']);
        $response['current_attr'] = $this->db->get('product_main_attr_link')->result_array();

        $this->db->where('attr_type_product_model_id', $response['model_id']);
        $response['attr'] = $this->db->get('product_attr_type')->result_array();
        for($i = 0;$i < count($response['attr']) ;$i++) {
            $this->db->where('attr_type_id', $response['attr'][$i]['attr_type_id']);
            $response['attr'][$i]['val'] = $this->db->get('product_attr')->result_array();
        }
        return $response;
    }

    public function func_get_model_attr_type($condition)
    {
        $this->db->where('attr_type_product_model_id',$condition['model_id']);
        return $this->db->get('product_attr_type')->result_array();
    }

    public function func_get_product_by_attr_id_array($condition)
    {
        $product_id = 0;
        $this->db->where('product_model_id', $condition['model_id']);
        $this->db->select('product_id');
        $products = $this->db->get('product_main')->result_array();

        for($i = 0; $i < count($products) ;$i++) {
            $this->db->where('main_attr_link_product_id',$products[$i]['product_id']);
            $this->db->select('main_attr_link_product_id, main_attr_link_product_attr_id');
            $products[$i]['attr'] = $this->db->get('product_main_attr_link')->result_array();
            $candidate_product_id = $products[$i]['attr'][0]['main_attr_link_product_id'];
            $temp = array();
            for($j = 0; $j < count($products[$i]['attr']) ;$j++) {
                $temp[] = $products[$i]['attr'][$j]['main_attr_link_product_attr_id'];
            }
            $tmp = array_diff($condition['attr_array'], $temp);
            if(count($tmp) == 0 ){
                $product_id = $candidate_product_id;
                break;
            }
        }
        unset($products);

//        $this->db->where('model_id', $condition['model_id']);
//        $this->db->join('product_main', 'product_model.model_id = product_main.product_model_id');
//        $this->db->where('product_id', $product_id);
//        $response = $this->db->get('product_model')->row_array();
//        $this->db->where('attr_type_product_model_id', $condition['model_id']);
//        $response['attr'] = $this->db->get('product_attr_type')->result_array();
//        for($i = 0;$i < count($response['attr']) ;$i++) {
//            $this->db->where('attr_type_id', $response['attr'][$i]['attr_type_id']);
//            $response['attr'][$i]['val'] = $this->db->get('product_attr')->result_array();
//        }

        return $product_id;
    }

}