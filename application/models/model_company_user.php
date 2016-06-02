<?php

class Model_company_user extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
        $this->load->helper('ip');
        $this->load->library('session');
    }

    public function get_user_by_email($email)
    {
        $this->db->from('company_user');
        $this->db->join('company','company.company_id = company_user.user_company_id');
        $this->db->where('user_account', $email );
        $query = $this->db->get();;
        return $query->row_array();
    }

}
