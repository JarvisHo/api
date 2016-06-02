<?php
class ctrl_base extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_config');
        $this->load->model('model_cart');
        $this->load->model('model_code');
        $this->load->model('model_banner');
        $this->load->model('model_navigation');
        $this->load->model('model_navigation_content');
    }

    public function get_base_info($request)
    {
        //TRACKING CODE
        $data['code'] = $this->model_code->get_active_code($request[API_COMPANY_VARIABLE]);

        //NAV
        $data['navigation'] = $this->model_navigation->func_get($request[API_COMPANY_VARIABLE],$request[API_LANG_VARIABLE]);

        //CONFIG
        $data['config'] = $this->model_config->get_config($request[API_COMPANY_VARIABLE], NULL);

        //BANNER
        $data['banner'] = $data['banner'] = $this->model_banner->get_banners(1,$request[API_COMPANY_VARIABLE],$request[API_LANG_VARIABLE]);
        for($i=0;$i<count($data['navigation']);$i++) {
            $navigation_type_id = $data['navigation'][$i]['nt_id'];
            $data['navigation_content'][$navigation_type_id] = $this->model_navigation_content->func_get($navigation_type_id,$request[API_COMPANY_VARIABLE],$request[API_LANG_VARIABLE]);
        }

        //CART
        $source['cart_company_id'] = $request[API_COMPANY_VARIABLE];
        $source['cart_lang_id'] = $request[API_LANG_VARIABLE];
        $source['cart_code_hash_id'] = $request[API_CODE_VARIABLE];
        $result = $this->model_cart->get_cart($source);
        $total = 0;
        $counter = 0;
        for($i = 0; $i < count($result);$i++ ){
            $total += $result[$i]['subtotal'];
            $counter += $result[$i]['cart_qty'];
        }

        //計算是否需要運費
        $shipping_fee = 0;
        $free_shipping_amount = 0;
        foreach($data['config'] as $item){
            switch($item['config_key']){
                case 'shipping_fee';
                    $shipping_fee = $item['config_value'];
                    break;
                case 'free_shipping_amount';
                    $free_shipping_amount = $item['config_value'];
                    break;
            }
        }
        if($total > $free_shipping_amount){
            $shipping_fee = 0;
        }else{
            $total += $shipping_fee;
        }
        $data['cart'] = $result;
        $data['total'] = $total;
        $data['counter'] = $counter;
        $data['shipping_fee'] = $shipping_fee;
        $data['free_shipping_amount'] = $free_shipping_amount;

        echo json_encode($data);
    }

    public function navigation_add()
    {
        $loginData =  $this->session->all_userdata();
        $data   = $this->input->post();
        $source = array(
            'nt_company_id' => $loginData['company_id'],
            'nt_lang_id'    => $loginData['lang_id'],
        );
        $combined_source = $data+$source;
        $this->model_navigation->func_add($combined_source);
        $this->navigation_admin();

    }

    public function navigation_update()
    {
        $loginData =  $this->session->all_userdata();
        $source = array(
            'nt_company_id' => $loginData['company_id'],
            'nt_lang_id'    => $loginData['lang_id'],
        );
        $data = $this->input->post();
        if(empty($data))$data=array();
        $combined_source = $data+$source;
        $this->model_navigation->func_update($combined_source);
        $this->navigation_admin();
    }

    public function navigation_content_add()
    {
        $loginData =  $this->session->all_userdata();
        $data = $this->input->post();
        if(empty($data))$data=array();
        $source = array(
            'nc_company_id' => $loginData['company_id'],
            'nc_lang_id'    => $loginData['lang_id'],
        );
        $combined_source = $data + $source;
        $this->model_navigation_content->func_add($combined_source);
        $this->navigation_admin();
    }

    public function navigation_content_update()
    {
        $loginData =  $this->session->all_userdata();
        $data = $this->input->post();
        if(empty($data))$data=array();
        $source = array(
            'nc_company_id' => $loginData['company_id'],
            'nc_lang_id'    => $loginData['lang_id'],
        );
        $combined_source = $data + $source;
        $this->model_navigation_content->func_update($combined_source);
        $this->navigation_admin();
    }
}