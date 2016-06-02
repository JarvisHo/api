<?php
class Ctrl_cart extends CI_Controller
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_cart');
        $this->load->model('model_config');
    }
    public function add_cart($request) {
        if(!isset($request['company']))return null;
        if(!isset($request['lang']))return null;
        if(!isset($request['code']))return null;
        if(!isset($request['cart']))return null;

        $source = array();
        $source['cart_company_id'] = $request['company'];
        $source['cart_lang_id'] = $request['lang'];
        $source['cart_code_hash_id'] = $request['code'];

        $request['cart'][] = array(
            'cart_model_id'=> 1,
            'cart_product_id'=> 1,
            'cart_qty'=> 1);
        $this->model_cart->void_cart($source);

        foreach($request['cart'] as $item) {
            $source['cart_model_id'] = $item['cart_model_id'];
            $source['cart_product_id'] = $item['cart_product_id'];
            $source['cart_qty'] = $item['cart_qty'];
            $this->model_cart->set_cart($source);
        }
        $this->get_cart($request);
    }

    public function set_cart($request) {
        if(!isset($request['company']))return null;
        if(!isset($request['lang']))return null;
        if(!isset($request['code']))return null;
        if(!isset($request['cart']))return null;

        $source = array();
        $source['cart_company_id'] = $request['company'];
        $source['cart_lang_id'] = $request['lang'];
        $source['cart_code_hash_id'] = $request['code'];

        $this->model_cart->void_cart($source);

        foreach($request['cart'] as $item) {
            $source['cart_model_id'] = $item['cart_model_id'];
            $source['cart_product_id'] = $item['cart_product_id'];
            $source['cart_qty'] = $item['cart_qty'];
            $this->model_cart->set_cart($source);
        }
        $this->get_cart($request);
    }

    public function get_cart($request) {
        if(!isset($request['company']))return null;
        if(!isset($request['lang']))return null;
        if(!isset($request['code']))return null;
        $source = array();
        $source['cart_company_id'] = $request['company'];
        $source['cart_lang_id'] = $request['lang'];
        $source['cart_code_hash_id'] = $request['code'];
        $result = $this->model_cart->get_cart($source);
        $total = 0;
        $counter = 0;
        for($i = 0; $i < count($result);$i++ ){
            $total += $result[$i]['subtotal'];
            $counter += $result[$i]['cart_qty'];
        }
        $data['cart'] = $result;
        $data['total'] = $total;
        $data['counter'] = $counter;

        //計算是否需要運費
        $config = $this->model_config->get_config($request[API_COMPANY_VARIABLE], NULL);
        $shipping_fee = 0;
        $free_shipping_amount = 0;
        foreach($config as $item){
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

    public function void_cart($request) {
        if(!isset($request[API_COMPANY_VARIABLE]))return null;
        if(!isset($request[API_CODE_VARIABLE]))return null;
        $source = array();
        $source['cart_company_id'] = $request[API_COMPANY_VARIABLE];
        $source['cart_code_hash_id'] = $request[API_CODE_VARIABLE];
        $this->model_cart->void_cart($source);
        unset($source);
        return 'successful';
    }
}
