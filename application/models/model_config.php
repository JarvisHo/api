<?php

class model_config extends CI_Model
{
    public function __construct() {
        $this->load->database();
    }

    public function get_config($company_id,$config_id) {
        if(isset($config_id))$this->db->where('config_id',$config_id);
        $this->db->where('config_company_id',$company_id);
        if(isset($config_id)){
            return $this->db->get('config')->row_array();
        }else{
            return $this->db->get('config')->result_array();
        }
    }

    public function add_config($source)
    {
        $data = array(
            'config_key'        => $source['config_key'],
            'config_value'      => $source['config_val'],
            'config_company_id' => $source['config_company_id'],
        );
        $this->db->insert('config',$data);
    }

    public function update_config($source,$company_id)
    {
        $this->db->where('config_company_id',$company_id);
        $this->db->update_batch('config',$source,'config_id');
    }

    public function delete_config($company_id,$config_id)
    {
        $this->db->where('config_company_id',$company_id);
        $this->db->where('config_id',$config_id);
        $this->db->delete('config');
    }
}
