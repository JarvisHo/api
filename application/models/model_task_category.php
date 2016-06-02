<?php
class Model_task_category extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }


    public function get_task_category()
    {
        $query = $this->db->get('paw_email_task_category');
        return $query->result_array();
    }
}


