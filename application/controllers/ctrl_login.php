<?php
class Ctrl_login extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_member');
        $this->load->library('form_validation');
        $this->load->library('session');
	}

	public function index()
	{
        $this->session->sess_destroy();
		$this->load->view('login/index');
	}

    public function verify()
    {
        $data = $this->model_member->get_member($this->input->post('email'));

        if(!empty($data['member_account']))
        {
            if($data['member_level']>1)
            {
                if($data['member_password']==sha1($this->input->post('password')))
                {
                    $loginData = array(
                        'member_id'  => $data['member_id'],
                        'member_status'  => $data['member_status'],
                        'username'  => $data['member_name'],
                        'email'     => $data['member_account'],
                        'level'     => $data['member_level'],
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($loginData);

                    redirect(base_url().'admin/dashboard', 'location', 301);
                }else{
                    redirect('/admin/login', 'location', 301);
                }
            }else{
                redirect('/admin/login', 'location', 301);
            }
        }else{
            redirect('/admin/login', 'location', 301);
        }

    }

}
