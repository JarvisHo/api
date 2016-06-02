<?php
class Ctrl_api extends CI_Controller
{
    public function __construct() {
		parent::__construct();
        $this->load->helper('ip');
        $this->load->helper('url');
        $this->load->helper('string');
        $this->load->helper('error');
        $this->load->helper('file');
        $this->load->library('AESCrypt');
	}

	public function index()
	{
        $data = $this->input->post(API_POST_VARIABLE);

//        if($data=="") {
//        $request['company'] = 999;
//        $request['lang'] = 999;
//        $request['code'] = "463cb2fd1cfdc9dfd2d59e76f305fdd5cd7bfecd";
//        $request['key'] = API_KEY_VARIABLE;
//        $request['token'] = API_TOKEN_VARIABLE;
//        $request['command'] = SET_ORDER;
//        $request['cart'][] = array('cart_model_id' => 2, 'cart_product_id' => 1, 'cart_qty' => 1);
//        $request['cart'][] = array('cart_model_id' => 2, 'cart_product_id' => 2, 'cart_qty' => 1);
//        $request['zip'] = 100;
//        $request['city'] = "台北市";
//        $request['state'] = "中正區";
//        $request['shipping_address'] = "內湖區新明路246巷3弄28號3樓";
//        $request['payment_option'] = 2;
//        $request['account_last_5'] = 12345;
//        $request['shipping_option'] = 1;
//        $request['full_name'] = "\\u4f55 \\u5bb6\\u7dad";
//        $request['phone_number'] = "0912345678";
//        $request['email'] = "endless640c@gmail.com";
//        $data = json_encode($request);
//        echo $data;
//        unset($request);
//    }
//        if($data=="") {
//            $request['company'] = 999;
//            $request['lang'] = 999;
//            $request['code'] = "ad36dacfae695747784d2a33cdd82d643d707b38";
//            $request['key'] = API_KEY_VARIABLE;
//            $request['token'] = API_TOKEN_VARIABLE;
//            $request['command'] = GET_PRODUCT_INFO_BY_PRODUCT_ID;
//            $request['product_id'] = 2;
//            $request['attr_array'] = array(3,5,7);
//            $data = json_encode($request);
//            echo $data;
//            unset($request);
//        }
//        if($data=="")$data = "{\"key\":\"7110eda4d09e062aa5e4a390b0a572ac0d2c0220\",\"token\":\"1e9771b83f63f53e7d6518d87a66870ecea5b8db\",\"code\":\"0f190236db139ed2012bb9f5529224793abffbc8\",\"company\":1,\"lang\":999,\"ip\":\"182.234.77.32\",\"command\":\"get_category_list\"}";
        //if($data=="")$data = "{\"key\":\"29768611b765a496a4edf674dee3ac2c3dfd7eb0\",\"token\":\"23d6116f553dde1b1e5fd0326cdbf0c749609529\",\"code\":\"ad36dacfae695747784d2a33cdd82d643d707b38\",\"company\":999,\"lang\":999,\"ip\":\"127.0.0.1\",\"command\":\"get_category_list\"}";
        //if($data=="")$data = "{\"key\":\"29768611b765a496a4edf674dee3ac2c3dfd7eb0\",\"token\":\"23d6116f553dde1b1e5fd0326cdbf0c749609529\",\"code\":\"97809b4a1ff856094937833fb8ab95021049989a\",\"company\":999,\"lang\":999,\"ip\":\"127.0.0.1\",\"command\":\"get_product_info_by_product_id\",\"product_id\":\"12\"}";
        //if($data=="")$data = "{\"key\":\"7110eda4d09e062aa5e4a390b0a572ac0d2c0220\",\"token\":\"1e9771b83f63f53e7d6518d87a66870ecea5b8db\",\"code\":\"8c0153540f5e5ae61dc4cd9e57ebb039433dce4b\",\"company\":1,\"lang\":999,\"ip\":\"127.0.0.1\",\"command\":\"get_category_list\"}";

//        if(!is_exist($request[API_KEY_VARIABLE])){ echoError("The API key is missing"); return null; }
//        if(!is_exist($request[API_TOKEN_VARIABLE])){ echoError("The API token is missing"); return null; }
//        if(!is_exist($request[API_CODE_VARIABLE])){ echoError("The API code is missing"); return null; }
//        if(!is_exist($request[API_COMMAND_VARIABLE])){ echoError("The Command is missing"); return null; }
        //驗證API待補
//        echo "<pre>";print_r($request);
//

        if($data == "")return null;
        $data = substr_replace($data,"\\","",0);
        if(!is_exist($data)){ echoError("JSON Format Error"); return null; }
        $request = json_decode(stripslashes($data),true);

        $this->load->model('model_company');
        $company = $this->model_company->get_company($request[API_KEY_VARIABLE], $request[API_TOKEN_VARIABLE]);
        if($company == null)return null;
        $request['company_id'] = $company['company_id'];

        //載入所需模組
        $command = $request[API_COMMAND_VARIABLE];
        switch ($command) {
            case GET_PRODUCT_CATEGORY_LIST:
            case GET_PRODUCT_LIST_BY_CATEGORY_ID:
            case GET_PRODUCT_INFO_BY_PRODUCT_ID:
            case GET_PRODUCT_ATTR_LIST_BY_MODEL_ID:
            case GET_PRODUCT_IMAGE_LIST_BY_MODEL_ID:
            case GET_PRODUCT_INFO_BY_ATTR_ID_ARRAY:
                $this->load->library(CTRL_PRODUCT);
                $this->ctrl_product->$command($request);
                break;
            case SET_CART:
            case GET_CART:
            case VOID_CART:
                $this->load->library(CTRL_CART);
                $this->ctrl_cart->$command($request);
                break;
            case SET_ORDER:
            case UPDATE_ORDER:
                $this->load->library(CTRL_ORDER);
                $this->ctrl_order->$command($request);
                break;
            case LOGIN:
            case REGISTER:
            case RESET_PASSWORD:
                $this->load->library(CTRL_MEMBER);
                $this->ctrl_member->$command($request);
                break;
            case GET_ARTICLE_VIA_ALIAS:
                $this->load->library(CTRL_ARTICLE);
                $this->ctrl_article->$command($request);
                break;
            case GET_BASE_INFO:
                $this->load->library(CTRL_BASE_INFO);
                $this->ctrl_base->$command($request);
                break;
            default:
                return null;
                break;
        }
    }

    public function check_json()
    {

    }
}
