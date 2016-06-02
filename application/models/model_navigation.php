<?php

class model_navigation extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function func_get($company_id,$lang_id)
    {
        $this->db->order_by('nt_id','asc');
        $this->db->where('nt_company_id',$company_id);
        $this->db->where('nt_lang_id',$lang_id);
        $this->db->where('nt_status',0);
        $result = $this->db->get('nav_type')->result_array();
        for($i=0;$i<count($result);$i++){
            $this->db->where('nc_nt_id',$result[$i]['nt_id']);
            $this->db->where('nc_company_id',$company_id);
            $this->db->where('nc_lang_id',$lang_id);
            $this->db->where('nc_status', 0);
            $result[$i]['nav_content'] = $this->db->get('nav_content')->result_array();
        }
        return $result;
    }

    public function func_add($source)
    {
        $this->db->insert('nav_type',$source);
    }

    public function func_update($source)
    {
        $this->db->where('nt_company_id',$source['nt_company_id']);
        $this->db->where('nt_lang_id',$source['nt_lang_id']);
        $this->db->where('nt_id',$source['nt_id']);
        $this->db->update('nav_type',$source);
    }
}
