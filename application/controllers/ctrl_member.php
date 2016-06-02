<?php

class Ctrl_member extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

//        $this->load->library('session');
//        $this->load->library('form_validation');
        $this->load->model('model_member');
//        $this->load->helper('date');
//        $this->load->helper('form');
//        $this->load->helper('verify_login');

//        verify_login_admin($this->session->all_userdata());
    }

    public function login(){
        echo "yes";
    }

    public function index()
    {
        $data['member'] = $this->model_member->get_members();
//
        $data['member_search']['fullname'] = $this->input->post('fullname');
        $data['member_search']['cellphone'] = $this->input->post('cellphone');
        $data['member_search']['address'] = $this->input->post('address');
        $data['member_search']['id'] = $this->input->post('id');
        $data['member_search']['account'] = $this->input->post('account');

        $data['operation_member_id'] = "";

        $this->load->view('templates/header');
        $this->load->view('member/index', $data);
        $this->load->view('templates/footer');
    }

    public function view($hash_id)
    {
        $data['member_item'] = $this->model_member->view_member($hash_id);

        if (empty($data['member_item'])) {
            show_404();
        }

        $this->form_validation->set_rules('fullname', '姓名', 'required');
        $this->form_validation->set_rules('cellphone', '手機號碼', 'required');


        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = "";
            $this->load->view('templates/header');
            $this->load->view('member/view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->model_member->update_member();
            $data['member_item'] = $this->model_member->view_member($hash_id);
            $data['msg'] = "<div class='alert alert-success'>會員更新成功！<a class='btn btn-default' href='" . base_url() . "admin/member'>回列表</a></div>";
            $this->load->view('templates/header');
            $this->load->view('member/view', $data);
            $this->load->view('templates/footer');
        }
    }

    public function suspend($order_service_id)
    {
        if (empty($order_service_id)) {
            show_404();
        }

        $this->db->where('service_id', $order_service_id);

        $this->db->from('paw_member_service');

        $query = $this->db->get();

        $row = $query->row_array();

        $operation_member_id = $row['service_member_id'];

        if ($row['service_status'] == 0) $status = 1; else $status = 0;

        $this->db->where('service_id', $order_service_id);

        if ($this->db->update('paw_member_service', array('service_status' => $status))) {

            if ($status == 1) { //暫停服務成功

                //新增送信模組
                $this->load->model('model_task');

                $source['task_member_id'] = $row['service_member_id'];
                $source['task_service_id'] = $order_service_id;
                $source['task_category_id'] = 5;

                $this->model_task->set_task_array($source);
                //新增送信模組
            }

        } else {
            redirect('warning', 'location', 301);
        }

        $data['member'] = $this->model_member->get_members();

        $data['operation_member_id'] = $operation_member_id;

        $this->load->view('templates/header');
        $this->load->view('member/index', $data);
        $this->load->view('templates/footer');
    }

}
