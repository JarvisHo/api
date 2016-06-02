<?php
class Model_member extends CI_Model
{
    public function __construct(){
        $this->load->database();
    }

    public function set_member($source)
    {
        $this->db->insert(MEMBER, $source);
        return $this->db->insert_id();
    }

    public function get_member($member_company_id, $member_account)
    {
        $this->db->where('member_status', 0);
        $this->db->where('member_company_id', $member_company_id);
        $this->db->where('member_account', $member_account);
        return $this->db->get('member')->row_array();
    }

    public function update_member_level_up($member_company_id, $member_id)
    {
        $data = array(
            'member_level' => 1
        );
        $this->db->where('member_id', $member_id);
        $this->db->where('member_company_id', $member_company_id);
        return $this->db->update('member', $data);
    }
}
