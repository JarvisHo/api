<?php
class Model_account_product extends CI_Model
{
    /**強化進銷存專用model**/
    public function __construct()
    {
        $this->load->database();
    }

    public function func_add($source)
    {
        $data = array(
            'category_name'         => $source['category_name'],
            'category_company_id'   => $source['category_company_id'],
            'category_lang_id'      => $source['category_lang_id'],
        );
        $this->db->insert('product_category',$data);
    }

    public function func_get($company_id,$lang_id,$search_name)
    {
        $this->db->where('category_company_id',$company_id);
        $this->db->where('category_lang_id',$lang_id);
        if(!empty($search_name))$this->db->like('category_name',$search_name);
        return $this->db->get('product_category')->result_array();
    }

    public function func_update($source)
    {
        $data = array(
            'category_name'         => $source['update_category_name'],
        );
        $this->db->where('category_id',$source['update_category_id']);
//        print_r($source);
        $this->db->update('product_category',$data);
    }

    public function func_get_model($company_id,$lang_id,$search_con)
    {
        $this->db->where('model_company_id',$company_id);
        $this->db->where('model_lang_id',$lang_id);
        if(!empty($search_con)){
            if(!empty($search_con['model_name']))$this->db->like('model_name',$search_con['model_name']);
            if($search_con['model_category_id']!='all')$this->db->where('model_category_id',$search_con['model_category_id']);
        }
        return $this->db->get('product_model')->result_array();
    }

    public function func_get_model_via_id($company_id,$lang_id,$model_id)
    {
        $this->db->where('model_company_id',$company_id);
        $this->db->where('model_lang_id',$lang_id);
        $this->db->where('model_id',$model_id);
        return $this->db->get('product_model')->row_array();
    }

    public function func_add_model($source)
    {
        $data = array(
            'model_category_id'             => $source['model_category_id'],
            'model_name'                    => $source['model_name'],
            'model_unit_name'               => $source['model_unit_name'],
            'model_company_id'              => $source['model_company_id'],
            'model_lang_id'                 => $source['model_lang_id'],
            'model_default_unit_price'      => $source['model_default_unit_price'],
            'model_default_unit_cost'       => $source['model_default_unit_cost'],
            'model_default_ori_qty'         => $source['model_default_ori_qty'],
            'model_default_ori_unit_cost'   => $source['model_default_ori_unit_cost'],
        );
        $this->db->insert('product_model',$data);
    }

    public function func_update_model($source)
    {
        $data = array(
            'model_category_id'                 => $source['model_category_id'],
            'model_name'                        => $source['model_name'],
            'model_unit_name'                   => $source['model_unit_name'],
            'model_default_unit_price'          => $source['model_default_unit_price'],
            'model_default_unit_cost'           => $source['model_default_unit_cost'],
            'model_default_ori_qty'             => $source['model_default_ori_qty'],
            'model_default_ori_unit_cost'       => $source['model_default_ori_unit_cost'],
            'model_init_product_id'       => $source['model_init_product_id'],
        );
        $this->db->where('model_id',$source['model_id']);
        $this->db->update('product_model',$data);
    }

    public function func_get_model_attr_type($company_id,$lang_id,$cons)
    {
        $this->db->where('attr_type_company_id',$company_id);
        $this->db->where('attr_type_lang_id',$lang_id);
        $this->db->where('attr_type_product_model_id',$cons['con_model_id']);
        return $this->db->get('product_attr_type')->result_array();
    }

    public function func_add_model_attr_type($source)
    {
        $data = array(
            'attr_type_company_id'           => $source['attr_type_company_id'],
            'attr_type_lang_id'              => $source['attr_type_lang_id'],
            'attr_type_product_model_id'     => $source['attr_type_product_model_id'],
            'attr_type_name'                 => $source['attr_type_name'],
        );
        $this->db->insert('product_attr_type',$data);
        return $this->db->insert_id();
    }

    public function func_update_model_attr_type($source)
    {
        $data = array(
            'attr_type_name' => $source['attr_type_name'],
        );
        $this->db->where('attr_type_id',$source['attr_type_id']);
        $this->db->update('product_attr_type',$data);
    }

    public function func_get_num_of_own_model_by_category($category_id)
    {
        $this->db->where('product_model.model_category_id',$category_id);
        return sizeof($this->db->get('product_model')->result_array());
    }

    public function func_add_attr_val($source)
    {
        $data = array(
            'attr_company_id'     => $source['attr_company_id'],
            'attr_lang_id'        => $source['attr_lang_id'],
            'attr_model_id'       => $source['attr_model_id'],
            'attr_type_id'        => $source['attr_type_id'],
            'attr_value'          => $source['add_attr_value_name'],
        );

        $this->db->insert('product_attr',$data);
        return $this->db->insert_id();
    }

    public function func_get_attr_val($company_id,$lang_id,$cons)
    {
        $this->db->where('attr_type_id',$cons['attr_type_id']);
        $this->db->where('attr_model_id',$cons['attr_model_id']);
        $this->db->where('attr_company_id',$company_id);
        $this->db->where('attr_lang_id',$lang_id);
        return $this->db->get('product_attr')->result_array();
    }

    public function func_get_attr_val_same($company_id,$lang_id,$attr_model_id,$attr_type_id)
    {
        $this->db->where('attr_company_id',$company_id);
        $this->db->where('attr_lang_id',$lang_id);
        $this->db->where('attr_model_id',$attr_model_id);
        $this->db->where('attr_type_id',$attr_type_id);
        return $this->db->get('product_attr')->result_array();
    }

    public function func_update_attr_val($cons)
    {
        $data = array(
            'attr_value' => $cons['attr_val_name'],
        );
        $this->db->where('attr_id',$cons['attr_id']);
        $this->db->update('product_attr',$data);
    }

    public function func_get_attr_val_num($attr_type_id)
    {
        $this->db->where('attr_type_id',$attr_type_id);
        $temp_doc = $this->db->get('product_attr')->result_array();
        return sizeof($temp_doc);
    }

    public function func_add_product($source)
    {
        $data = array(
            'product_company_id'    => $source['product_company_id'],
            'product_lang_id'       => $source['product_lang_id'],
            'product_model_id'      => $source['product_model_id'],
            'product_unit_price'    => $source['product_unit_price'],
            'product_unit_cost'     => $source['product_unit_cost'],
            'product_ori_qty'       => $source['product_ori_qty'],
            'product_ori_unit_cost' => $source['product_ori_unit_cost'],
            'product_status'        => $source['product_status'],
        );
        $this->db->insert('product_main',$data);
        return $this->db->insert_id('product_main',$data);
    }

    public function func_add_product_main_attr_link($source)
    {
        $data = array(
            'main_attr_link_product_attr_type_id'   => $source['attr_type_id'],
            'main_attr_link_product_attr_id'        => $source['attr_id'],
            'main_attr_link_product_id'             => $source['product_id'],
        );
        $this->db->insert('product_main_attr_link',$data);
    }

    public function func_change_model_status($model_id,$status_id)
    {
        $data = array(
            'model_status' => $status_id,
        );
        $this->db->where('model_id',$model_id);
        $this->db->update('product_model',$data);
    }

    public function func_change_model_init_product_id($model_id,$init_product_id)
    {
        $data = array(
            'model_init_product_id' => $init_product_id,
        );
        $this->db->where('model_id',$model_id);
        $this->db->update('product_model',$data);
    }

    public function func_get_model_selected($company_id,$lang_id,$search_con)
    {
        $this->db->where('model_company_id',$company_id);
        $this->db->where('model_lang_id',$lang_id);
        $this->db->where('model_id',$search_con['model_id']);
        return $this->db->get('product_model')->row_array();
    }

    public function func_get_model_content($company_id,$lang_id,$model_id)
    {
        $this->db->where('product_company_id',$company_id);
        $this->db->where('product_lang_id',$lang_id);
        $this->db->where('product_model_id',$model_id);
        return $this->db->get('product_main')->result_array();
    }

    public function func_get_product($company_id,$lang_id,$search_con)
    {
        $this->db->where('product_company_id',$company_id);
        $this->db->where('product_lang_id',$lang_id);
        $this->db->where('product_model_id',$search_con['model_id']);
        return $this->db->get('product_main')->result_array();
    }

    public function func_get_attr_link($product_id)
    {
        $this->db->where('main_attr_link_product_id',$product_id);
        return $this->db->get('product_main_attr_link')->result_array();
    }

    public function func_get_attr_type_name_via_id($attr_type_id)
    {
        $this->db->where('attr_type_id',$attr_type_id);
        $this->db->select('attr_type_name');
        $tamp_get =  $this->db->get('product_attr_type')->row_array();
        return $tamp_get['attr_type_name'];
    }

    public function func_get_attr_name_via_id($attr_id)
    {
        $this->db->where('attr_id',$attr_id);
        $this->db->select('attr_value');
        $tamp_get =  $this->db->get('product_attr')->row_array();
        return $tamp_get['attr_value'];
    }

    public function get_attr_via_id($attr_id)
    {
        $this->db->where('attr_id',$attr_id);
        return $this->db->get('product_attr')->row_array();
    }

    public function func_get_other_attr_type($company_id,$lang_id,$model_id,$attr_type_id)
    {
        $this->db->where('attr_type_company_id',$company_id);
        $this->db->where('attr_type_lang_id',$lang_id);
        $this->db->where('attr_type_product_model_id',$model_id);
        $this->db->where('attr_type_id !=',$attr_type_id);
        return $this->db->get('product_attr_type')->result_array();
    }
}