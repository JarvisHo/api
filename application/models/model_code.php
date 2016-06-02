<?php

class Model_code extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function get_active_code($company_id)
    {
        $this->db->where('code_status', 0);
        $this->db->where('code_company_id', $company_id);
        $query = $this->db->get('tracking_code');
        $result = $query->row_array();
        if(count($result)==0){
            $source['code_hash_id'] = sha1(rand().time());
            $source['code_company_id'] = $company_id;
            $this->db->insert('tracking_code', $source);
            $this->db->where('code_status', 0);
            $this->db->where('code_company_id', $company_id);
            $query = $this->db->get('tracking_code');
            $result = $query->row_array();
            return $result;
        }else{
            return $result;
        }
    }

    public function add_code_array($source)
    {
        $data = array();

        if(!empty($source['code_title']))$data['code_title'] = $source['code_title'];
        if(!empty($source['code_content']))$data['code_content'] = $source['code_content'];
        if(!empty($source['code_category']))$data['code_category'] = $source['code_category'];
        if(!empty($source['code_hash_id']))$data['code_hash_id'] = $source['code_hash_id'];

        if(count($data)>0)$this->db->insert('tracking_code', $source);

    }

    public function update_code_array($source)
    {
        $data = array();
        if(!empty($source['code_fb_id']))$data['code_fb_id'] = $source['code_fb_id'];
        if(!empty($source['code_ga_id']))$data['code_ga_id'] = $source['code_ga_id'];
        if(!empty($source['code_mf_id']))$data['code_mf_id'] = $source['code_mf_id'];
        if(!empty($source['code_vwo_id']))$data['code_vwo_id'] = $source['code_vwo_id'];
        if(!empty($source['code_content']))$data['code_content'] = $source['code_content'];
        //if($source['code_category_id']!="")$data['code_category_id'] = $source['code_category_id'];
        //if($source['code_status']!="")$data['code_status'] = $source['code_status'];
        $this->db->where('code_hash_id', $source['code_hash_id']);
        $this->db->update('tracking_code', $data);
    }


    public function get_code($code_hash_id = FALSE, $code_category_id = null)
    {
        if ($code_hash_id === FALSE)
        {
            $this->db->order_by("code_id", "DESC");

            if($code_category_id != null) {
                $this->db->where('code_category_id', $code_category_id);
            }
            $this->db->from('tracking_code')->where('code_status < 2');

            $query = $this->db->get();

            $data = $query->result_array();

        } else {

            if(strlen($code_hash_id)<40)show_404();
            $this->db->from('tracking_code')->where('code_hash_id', $code_hash_id);
            $query = $this->db->get();
            $data = $query->row_array();
        }

        return $data;

    }

}
