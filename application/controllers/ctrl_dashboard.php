<?php
class Ctrl_dashboard extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();

        $this->load->library('session');
        $this->load->library('form_validation');

        $this->load->model('model_order');
        $this->load->model('model_service');
        $this->load->model('model_member');

        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
	}

	public function index()
	{
        $data['active_service_counter'] = $this->model_service->get_dashboard_active_service_counter();
        $data['recent_services'] = $this->model_service->get_recent_services();
        $data['prospect'] = $this->model_member->get_dashboard_prospect_number();
        $data['member'] = $this->model_member->get_dashboard_member_number();
        $data['order'] = $this->model_order->get_ready_to_ship_orders();
		$this->load->view('templates/header');
		$this->load->view('dashboard/index',$data);
		$this->load->view('templates/footer');
	}
}
