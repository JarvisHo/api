<?php
class ctrl_prospect extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_member');
        $this->load->helper('date');
        $this->load->helper('form');
        $this->load->library('form_validation');

        $this->load->library('session');
        $user_data = $this->session->all_userdata();
        if(isset($user_data['logged_in'])){
            if($user_data['logged_in']!=1){
                redirect('/login', 'location', 301);
            }
        }else{
            redirect('/login', 'location', 301);
        }
	}

	public function index()
	{
		$data['member'] = $this->model_member->get_members(true);

        $data['member_search']['fullname'] = $this->input->post('fullname');
        $data['member_search']['cellphone'] = $this->input->post('cellphone');
        $data['member_search']['address'] = $this->input->post('address');
        $data['member_search']['id'] = $this->input->post('id');
        $data['member_search']['account'] = $this->input->post('account');

		$this->load->view('templates/header');
		$this->load->view('prospect/index', $data);
		$this->load->view('templates/footer');

	}

	public function view($hash_id)
	{

		$data['member_item'] = $this->model_member->view_member($hash_id);

		if (empty($data['member_item']))
		{
			show_404();
		}
        $this->form_validation->set_rules('fullname', '姓名', 'required');
        $this->form_validation->set_rules('cellphone', '手機號碼', 'required');


        if ($this->form_validation->run() === FALSE)
        {
            $data['msg'] = "";
            $this->load->view('templates/header');
            $this->load->view('prospect/view', $data);
            $this->load->view('templates/footer');

        }
        else
        {
            $this->model_member->update_member();
            $data['member_item'] = $this->model_member->view_member($hash_id);
            $data['msg'] = "<div class='alert alert-success'>會員更新成功！<a class='btn btn-default' href='".base_url()."admin/prospect'>回列表</a></div>";
            $this->load->view('templates/header');
            $this->load->view('prospect/view', $data);
            $this->load->view('templates/footer');
        }



	}

	 public function stop($hash_id)
	 {


         if (empty($hash_id))
         {
             show_404();
         }

         $this->member_model->stop_autoship_member($hash_id);

         $data['member'] = $this->member_model->get_member();

         $this->load->view('templates/header');
         $this->load->view('prospect/index', $data);
         $this->load->view('templates/footer');
	 }

    public function start($hash_id)
    {
        $this->load->helper('date');
        if (empty($hash_id))
        {
            show_404();
        }

        $this->member_model->start_autoship_member($hash_id);

        $data['member'] = $this->member_model->get_member();

        $this->load->view('templates/header');
        $this->load->view('prospect/index', $data);
        $this->load->view('templates/footer');
    }
}
