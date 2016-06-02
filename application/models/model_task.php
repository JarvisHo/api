<?php
class Model_task extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function set_task_array($source)
    {
        $data = array();
        if (!empty($source['task_member_id'])) $data['task_member_id'] = $source['task_member_id'];
        if (!empty($source['task_service_id'])) $data['task_service_id'] = $source['task_service_id'];
        if (!empty($source['task_order_id'])) $data['task_order_id'] = $source['task_order_id'];
        if (!empty($source['task_category_id'])) $data['task_category_id'] = $source['task_category_id'];
        if (!empty($source['task_article_id'])) $data['task_article_id'] = $source['task_article_id'];
        if (!empty($source['task_status'])) $data['task_status'] = $source['task_status'];
        if (!empty($source['task_target_email'])) $data['task_target_email'] = $source['task_target_email'];
        if (count($data) > 0) {$this->db->insert('email_task', $source); return $this->db->insert_id();} else return null;
    }

    public function get_task($task_id)
    {
        if(!empty($task_id)) {
            $this->db->where('task_id', $task_id);
            $query = $this->db->get('paw_email_task');
            return $query->row_array();
        }
    }

    public function update_task( $task )
    {
        if(!empty($task['task_id'])){

        $data = array(
            'task_article_id' => $task['task_article_id'],
            'task_status' => $task['task_status']
        );

        $this->db->where('task_id', $task['task_id']);
        $this->db->update('paw_email_task', $data);

        }
    }
}


