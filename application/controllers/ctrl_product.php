<?php
class Ctrl_product extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_product');
    }

    //取得列表
    public function get_category_list($request) {
        $result = $this->model_product->get_category_list($request);
        echo json_encode($result);
    }

    /* 需要 category_id */
    public function get_product_list_by_category_id($request) {
        $result = $this->model_product->get_product_list_by_category_id($request);
        echo json_encode($result);
    }

    /* 需要 product_id */
    public function get_product_info_by_product_id($request) {
        $result = $this->model_product->func_get_product($request);;
        echo json_encode($result);
    }

    public function get_product_attr_list_by_model_id($request) {
        $result = $this->model_product->func_get();
        echo json_encode($result);
    }

    public function get_product_image_by_id($request) {
        $result = $this->model_product->func_get();
        echo json_encode($result);
    }

    public function get_product_info_by_attr_id_array($request) {
        $result['product_id'] = $this->model_product->func_get_product_by_attr_id_array($request);
        $this->get_product_info_by_product_id($result);
    }
}
