<?php

class Model_company extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_company($company_key, $company_token){
        $this->db->where('company_key',$company_key);
        $this->db->where('company_token', $company_token);
        $this->db->where('company_status', 0);
        $query = $this->db->get('company',1);
        return $query->row_array();
    }
}
