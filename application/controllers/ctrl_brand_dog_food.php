<?php
define("INFINITE",0);
define("FRONTEND","1");
define("BACKEND","0");

class Ctrl_brand_dog_food extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_brand');
		$this->load->model('model_product');
        $this->load->library('form_validation');

        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('parse');

        $this->load->library('session');

        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());
	}

	public function index($brand_hash_id = FALSE)
	{
        if($brand_hash_id === FALSE)
        {
            $brand_hash_id = 39;
        }

        if(!is_numeric($brand_hash_id) AND strlen($brand_hash_id)!=40)show_404();

        $data['brand'] = $this->model_brand->view_brand($brand_hash_id);

        if(!isset($data['brand']['brand_id']))show_404();

        $data['products']  = $this->model_product->get_products($data['brand']['brand_id'], INFINITE, BACKEND);

        $data['brand']['brand_description_image_path'] = get_images_src_array($data['brand']['brand_description'],"640x145");

        $data['brands'] = $this->model_brand->get_brands(INFINITE,BACKEND);


        //將產品描述中的圖片取出：
        for($i=0; $i< count($data['products']); $i++)
        {

            $data['products'][$i]['product_digest'] = nl2br(mb_strimwidth($data['products'][$i]['product_digest'], 0, 200, "...", "UTF-8"));

        }
        //取出完畢

        $this->load->view('templates/header');
		$this->load->view('dog_food/index', $data);
		$this->load->view('templates/footer');
	}


}
