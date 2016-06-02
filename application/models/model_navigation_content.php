<?php

class model_navigation_content extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function func_get($navigation_type_id,$company_id,$lang_id)
    {
        $this->db->order_by('nc_id','desc');
        $this->db->where('nc_nt_id',$navigation_type_id);
        $this->db->where('nc_company_id',$company_id);
        $this->db->where('nc_lang_id',$lang_id);
        $this->db->where('nc_status', 0);
        return $this->db->get('nav_content')->result_array();
    }

    public function func_add_batch($source)
    {
        $this->db->insert_batch('nav_content',$source);
    }

    public function func_add($source)
    {
        $this->db->insert('nav_content',$source);

    }

    public function func_update($source)
    {
        $data = array(
            'nc_name'   => $source['nc_name'],
            'nc_url'    => $source['nc_url'],
            'nc_target' => $source['nc_target'],
            'nc_status' => $source['nc_status'],
        );
        $this->db->where('nc_company_id',$source['nc_company_id']);
        $this->db->where('nc_lang_id',$source['nc_lang_id']);
        $this->db->where('nc_id',$source['nc_id']);
        $this->db->update('nav_content',$data);
    }
}
