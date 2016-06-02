<?php
class Model_upload extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }

    public function add_file($data)
    {
        $this->db->insert('paw_file', $data);
    }

    public function set_file_down($file_parent_hash_id)
    {
        $data = array(
            'file_status' => 1
        );
        $this->db->where('file_parent_hash_id', $file_parent_hash_id);
        return $this->db->update('paw_file', $data);

    }

    public function get_file_path($file_id)
    {
        $this->db->from('paw_file')->where('file_id', $file_id);

        $query = $this->db->get();

        $file = $query->row_array();

        return $file['file_path'];

    }
}
