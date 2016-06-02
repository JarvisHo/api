<?php
class Ctrl_brand extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();

		$this->load->model('model_brand');
		$this->load->model('model_upload');

        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('parse');

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
	}

    public function create()
    {
        if($this->input->post())
        {
            $brand = $this->model_brand->view_brand($this->input->post('brand_hash_id'));

            $this->form_validation->set_rules('brand_hash_id', 'brand_hash_id', 'required');
            $this->form_validation->set_rules('brand_name', 'brand_name', 'required');

            if (empty($brand['brand_id']) AND $this->model_brand->set_brand())
            {
                $this->model_upload->set_file_down($this->input->post('brand_hash_id'));

                $data['msg'] = "<div class='alert alert-success'>品牌新增成功！<a class='btn btn-default' href='".base_url()."admin/dog/food'>回列表</a></div>";
            }else{
                $data['msg'] = "<div class='alert alert-danger'>新增失敗，品牌已經存在資料庫囉。<a class='btn btn-default' href='".base_url()."admin/dog/food'>回列表</a></div>";
            }
        }
        else
        {
            $data['msg'] = "";
        }

        $data['hash_id'] = sha1(rand());

        $this->load->view('templates/header');
        $this->load->view('brand/create',$data);
        $this->load->view('templates/footer');
    }

	public function view($brand_hash_id = FALSE)
    {
        if($brand_hash_id === FALSE) show_404();

        if(empty($brand_hash_id)) show_404();

        if($this->input->post())
        {
            $this->form_validation->set_rules('brand_hash_id', 'brand_hash_id', 'required');
            $this->form_validation->set_rules('brand_name', 'brand_name', 'required');

            if($this->model_brand->update_brand())
            {
                $this->model_upload->set_file_down($this->input->post('brand_hash_id'));

                $msg = "<div class='alert alert-success'>品牌更新成功！<a class='btn btn-default' href='".base_url()."admin/dog/food/".$this->input->post('brand_hash_id')."'>回列表</a></div>";
            }else{
                $msg = "<div class='alert alert-danger'>品牌更新失敗...<a class='btn btn-default' href='".base_url()."admin/dog/food/".$this->input->post('brand_hash_id')."'>回列表</a></div>";
            }
        }

        $data = $this->model_brand->view_brand($brand_hash_id);


        isset($msg) ? $data['msg'] = $msg : $data['msg'] = "";

        $this->load->view('templates/header');
        $this->load->view('brand/view', $data);
        $this->load->view('templates/footer');

    }

}
