<?php

class Model_receiver extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_data(){

        $data = array(
            'receiver_hash_id' => sha1(time().$this->session->all_userdata()['member_id']),
            'receiver_name' => $this->auto_fix($this->input->post('fullname')),
            'receiver_phone' => $this->auto_fix($this->input->post('cellphone')),
            'receiver_address' => $this->auto_fix($this->input->post('address')),
            'receiver_session' => $this->auto_fix($this->input->post('receiveTime')),
            'receiver_member_id' => $this->session->all_userdata()['member_id']
        );

        return $data;
    }

    //使用者填完form 複製一份到receiver

    public function set_receiver()
    {
        $data = $this->get_data();

        if($this->db->insert('paw_member_receiver', $data))
        {
            return true;
        }
        else
        {
            redirect('logout','location',301);
        }

    }

    //前台使用
    public function set_receiver_by_array($data)
    {
        unset($data['receiver_id']);
        $data['receiver_member_id'] = $this->session->all_userdata()['member_id'];
        $data['receiver_status'] = 1;
        $data['receiver_hash_id'] = sha1(time().$data['receiver_member_id']);
        $this->db->insert('paw_member_receiver', $data);
    }

    //每個會員初始化使用
    public function init_set_receiver()
    {
        $this->load->model('model_member');

        $member = $this->model_member->get_member_by_id($this->session->all_userdata()['member_id']);

        $data['receiver_name'] = $member['member_name'];
        $data['receiver_phone'] = $member['member_phone'];
        $data['receiver_address'] = $member['member_address'];
        $data['receiver_member_id'] = $member['member_id'];
        $data['receiver_status'] = 0;
        $data['receiver_hash_id'] = sha1(time().$member['member_id']);
        $this->db->insert('paw_member_receiver', $data);
    }

    public function auto_fix($str){

        $str = str_replace ("<","",$str);
        $str = str_replace (">","",$str);
        $str = str_replace (";","",$str);
        $str = str_replace (",","",$str);
        $str = str_replace ("'","",$str);
        $str = str_replace ("''","",$str);
        $str = str_replace ("+","",$str);
        $str = str_replace ("-","",$str);
        $str = str_replace ("*","",$str);
        $str = str_replace ("&","",$str);
        $str = str_replace ("=","",$str);
        $str = str_replace ("DROP","",$str);
        $str = str_replace ("SELECT","",$str);
        $str = str_replace ("(","",$str);
        $str = str_replace (")","",$str);

        return $str;
    }

    public function update_receiver($receiver)
    {
        $receiver_id = $receiver['receiver_id'];

        unset($receiver['receiver_id']);

        $this->db->where('receiver_id',  $receiver_id);

        return $this->db->update('paw_member_receiver', $receiver);
    }

    public function get_main_receiver($member_id){

        $this->db->where('receiver_member_id', $member_id);

        $this->db->where('receiver_status', 0);

        $query = $this->db->from('paw_member_receiver')->get();

        $data = $query->row_array();

        if(isset($data['receiver_session'])){

            switch ($data['receiver_session']) {
                case 0:
                    $data['receiver_session_text'] = "晚上";
                    break;
                case 1:
                    $data['receiver_session_text'] = "下午";
                    break;
                case 2:
                    $data['receiver_session_text'] = "早上";
                    break;
                case 3:
                    $data['receiver_session_text'] = "不限";
                    break;
            }
        }
        return $data;

    }

    public function get_receivers()
    {
        $this->db->where('receiver_member_id', $this->session->all_userdata()['member_id']);

        $this->db->where('receiver_status < ', 2);

        $this->db->order_by("receiver_status", "asc");

        $query = $this->db->from('paw_member_receiver')->get();

        $data = $query->result_array();

        for($i=0;$i<count($data);$i++){

            //查詢有多少服務正在使用
            $this->db->where('service_status <', 2);

            $this->db->where('service_receiver_id', $data[$i]['receiver_id']);

            $this->db->from('paw_member_service');

            $data[$i]['receiver_used_count'] = $this->db->count_all_results();

            switch ($data[$i]['receiver_session']) {
                case 0:
                    $data[$i]['receiver_session_text'] = "晚上";
                    break;
                case 1:
                    $data[$i]['receiver_session_text'] = "下午";
                    break;
                case 2:
                    $data[$i]['receiver_session_text'] = "早上";
                    break;
                case 3:
                    $data[$i]['receiver_session_text'] = "不限";
                    break;
            }

        }

        return $data;
    }

    public function get_receiver_by_id($receiver_id)
    {
        $this->db->where('receiver_member_id', $this->session->all_userdata()['member_id']);

        $this->db->where('receiver_id', $receiver_id);

        $this->db->where('receiver_status < ', 2);

        $query = $this->db->from('paw_member_receiver')->get();

        $data = $query->row_array();

            switch ($data['receiver_session']) {
                case 0:
                    $data['receiver_session_text'] = "晚上";
                    break;
                case 1:
                    $data['receiver_session_text'] = "下午";
                    break;
                case 2:
                    $data['receiver_session_text'] = "早上";
                    break;
                case 3:
                    $data['receiver_session_text'] = "不限";
                    break;
            }

        return $data;
    }

    public function view_receiver($receiver_hash_id)
    {
        $query = $this->db->from('paw_member_receiver')->where('receiver_hash_id', $receiver_hash_id )->get();

        $data = $query->row_array();

        if(isset($data['receiver_shipping']))
        {
            $shipping = $data['receiver_shipping'];

            $options = array( 0 => '晚上', 1 => '下午' , 2 =>'早上');

            $data['receiver_receive'] = $options[ $shipping ];
        }

        return $data;
    }

    public function delete_receiver($receiver_hash_id)
    {
        $receiver['receiver_status'] = 2;

        $this->db->where('receiver_hash_id',  $receiver_hash_id);

        return $this->db->update('paw_member_receiver', $receiver);
    }

    public function set_default_receiver($receiver_hash_id)
    {
        $receiver['receiver_status'] = 1;
        $this->db->where('receiver_status',  0);
        $this->db->update('paw_member_receiver', $receiver);

        $receiver['receiver_status'] = 0;
        $this->db->where('receiver_hash_id',  $receiver_hash_id);
        $result = $this->db->update('paw_member_receiver', $receiver);

        $session = $this->session->all_userdata();

        $default_receiver = $this->model_receiver->get_main_receiver($session['member_id']);

        $session['selected_receiver'] = $default_receiver['receiver_id'];

        $this->session->set_userdata($session);

        return $result;
    }

}
