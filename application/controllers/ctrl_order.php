<?php
class Ctrl_order extends CI_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->load->model('model_task');
		$this->load->model('model_config');
		$this->load->model('model_order');
		$this->load->model('model_cart');
		$this->load->model('model_order_cart');
		$this->load->model('model_member');
		$this->load->model('model_product');
		$this->load->model('model_code');
		$this->load->helper('mail_chimp');
	}

	public function set_order($request)
	{
        //取得購物車
        $source['cart_company_id']= $request[API_COMPANY_VARIABLE];
        $source['cart_lang_id'] = $request[API_LANG_VARIABLE];
        $source['cart_code_hash_id'] = $request[API_CODE_VARIABLE];
        $data = $this->model_cart->get_cart($source);
        unset($source);

        if(count($data) > 0)
        {
            //確認會員是否已存在
            $member_array = $this->model_member->get_member($request['company'], $request['email']);
            if(count($member_array)) {
                $member_id = $member_array['member_id'];
                //已存在，不需要再新增會員
            }else{
                //加入會員
                $source = array(
                    'member_company_id' => $request['company'],
                    'member_lang_id' => $request['lang'],
                    'member_account' => $request['email'],
                    'member_name' => $request['email'],
                    'member_password' => sha1(substr(md5(uniqid(rand(), true)),0,8)), /** 八位英數隨機密碼，目前無用印為無法反轉 **/
                    'member_ip' => $request['ip'],
                    'member_region' => $request['city'],
                    'member_phone' => $request['phone_number'],
                    'member_address' => $request['shipping_address'],
                    'member_code' => $request['code']
                );
                $member_id = $this->model_member->set_member($source);
            }
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
                    case 'mailchimp';
                        $free_shipping_amount = $item['config_value'];
                        break;
                }
            }

            $order_shipping_fee = $shipping_fee;
            $order_service_fee = 0;
            $order_total = 0;
            $order_cart_total = 0;
            foreach($data as $item ) {
                $order_cart_total += $item['subtotal'];
            }
            if($order_cart_total > $free_shipping_amount){
                $order_shipping_fee = 0;
            }
            $order_total += $order_cart_total + $order_shipping_fee;

            //新增訂單
            unset($source);
            $source['order_member_id'] = $member_id;
            $source['order_shipping_fee'] = $order_shipping_fee; /** 未來要修改成重新計算費用，怕被從前臺竄改 **/
            $source['order_service_fee'] = $order_service_fee;   /** 未來要修改成重新計算費用，怕被從前臺竄改 **/
            $source['order_total'] = $order_total;               /** 未來要修改成重新計算費用，怕被從前臺竄改 **/
            $source['order_cart_total'] = $order_cart_total;
            $source['order_company_id'] = $request['company'];
            $source['order_lang_id'] = $request['lang'];
            $source['order_member_code'] = $request['code'];
            $source['order_member_address'] = $request['zip'].$request['city'].$request['state'].$request['shipping_address'];
            $source['order_payment_option'] = $request['payment_option'];
            $source['order_account_last_5'] = $request['account_last_5'];
            $source['order_shipping_option'] = $request['shipping_option'];
            $source['order_ip'] = $request['ip'];
            $source['order_member_name'] = $request['full_name'];
            $source['order_member_phone'] = $request['phone_number'];
            $source['order_member_account'] = $request['email'];
            $order = $source;
            //狀態設定
            if($source['order_payment_option'] == 1 ){
                //已完成
                $source['order_status'] = 1;
            }else{
                //未完成
                $source['order_status'] = 0;
            }

            $order['order_id'] = $this->model_order->set_order($source);
            unset($source);

            //加入訂單購物車內容
            foreach($data as $item ) {

                //取得產品資訊
                $condition['product_id'] = $item['cart_product_id'];
                $condition['company_id'] = $request[API_COMPANY_VARIABLE];
                $product = $this->model_product->func_get_product($condition);

                if($item['cart_qty']==0)continue;
                $source['cart_order_id']= $order['order_id'];
                $source['cart_product_base_id']= $product['product_base_id'];
                $source['cart_product_base_count']= $product['product_base_count'];
                $source['cart_member_id']= $member_id;
                $source['cart_package_id']= $item['cart_product_id'];
                $source['cart_package_price']= $item['product_unit_price'];
                $source['cart_package_qty']= $item['cart_qty'];
                $product_temp_name = $item['model_name'];

                unset($product);

                foreach($item['current_attr'] as $attr) {
                    $product_temp_name = $product_temp_name."(".$attr['attr_type_name'].":".$attr['attr_value'].")";
                }

                $source['cart_product_name'] = $product_temp_name;
                $this->model_order_cart->set_order_cart($source);
                unset($source);
            }

            /** MAILCHIMP FUNCTION */
            $code_array = $this->model_code->get_active_code($request[API_COMPANY_VARIABLE]);

            $api_key = array('api_key' => $code_array['code_mc_id']);
            $api_prospect_list_id = $code_array['code_mc_token_prospect'];
            $api_member_list_id = $code_array['code_mc_token_member'];

            $this->load->library('MailChimp',$api_key);

            if($request['payment_option'] == 1 ) {
                //貨到付款成立：直接送進工作事項
                $this->model_member->update_member_level_up(
                    $request[API_COMPANY_VARIABLE], $member_id);

                $task = array();
                $task['task_lang_id'] = $request[API_LANG_VARIABLE];
                $task['task_company_id'] = $request[API_COMPANY_VARIABLE];
                $task['task_member_id'] = $member_id;
                $task['task_order_id'] = $order['order_id'];
                $task['task_category_id'] = TASK_WHEN_ORDER_CREATED; //訂單創建時
                $this->model_task->set_task_array($task);

                $this->mailchimp->call('lists/subscribe', array(
                    'id'                => $api_member_list_id,
                    'email'             => array('email'=> $request['email']),
                    'merge_vars'        => array('FNAME'=> get_first_name($request['full_name']), 'LNAME'=>get_last_name($request['full_name'])),
                    'double_optin'      => false,
                    'update_existing'   => true,
                    'replace_interests' => false,
                    'send_welcome'      => false,
                ));

            }else{

                $this->mailchimp->call('lists/subscribe', array(
                    'id'                => $api_prospect_list_id,
                    'email'             => array('email'=> $request['email']),
                    'merge_vars'        => array('FNAME'=> get_first_name($request['full_name']), 'LNAME'=>get_last_name($request['full_name'])),
                    'double_optin'      => false,
                    'update_existing'   => true,
                    'replace_interests' => false,
                    'send_welcome'      => false,
                ));
            }

            echo json_encode(array('result' => true, 'order'=> $order, 'cart'=>$data , 'cart_total'=>$order_cart_total , 'total'=>$order_total));
        }
	}

    public function update_order($request) {
        $source = array();
        $source['order_company_id'] = $request[API_COMPANY_VARIABLE];
        $source['order_id'] = $request['order_id'];
        $source['order_payment_status'] = $request['order_payment_status'];
        $source['order_hash_id'] = $request['order_hash_id'];
        $source['order_status'] = $request['order_status'];

        $order = $this->model_order->get_order($source);

        if($this->model_order->update_order($source)){

            $result = 'UPDATED';

            if($source['order_status'] == 1 ) {
                $task = array();
                $task['task_lang_id'] = $request[API_LANG_VARIABLE];
                $task['task_company_id'] = $request[API_COMPANY_VARIABLE];
                $task['task_member_id'] = $order['order_member_id'];
                $task['task_order_id'] = $request['order_id'];
                $task['task_category_id'] = TASK_WHEN_ORDER_CREATED; //訂單創建時
                $this->model_task->set_task_array($task);

                $code_array = $this->model_code->get_active_code($request[API_COMPANY_VARIABLE]);

                $api_key = array('api_key' => $code_array['code_mc_id']);
                $api_prospect_list_id = $code_array['code_mc_token_prospect'];
                $api_member_list_id = $code_array['code_mc_token_member'];

                $this->load->library('MailChimp',$api_key);

                $this->mailchimp->call('lists/unsubscribe', array(
                    'id'                => $api_prospect_list_id,
                    'email'             => array('email'=> $order['order_member_account']),
                    'merge_vars'        => array('FNAME'=> get_first_name($order['order_member_name']), 'LNAME'=>get_last_name($order['order_member_name'])),
                    'double_optin'      => false,
                    'update_existing'   => true,
                    'replace_interests' => false,
                    'send_welcome'      => false,
                ));
                $this->mailchimp->call('lists/subscribe', array(
                    'id'                => $api_member_list_id,
                    'email'             => array('email'=> $order['order_member_account']),
                    'merge_vars'        => array('FNAME'=> get_first_name($order['order_member_name']), 'LNAME'=>get_last_name($order['order_member_name'])),
                    'double_optin'      => false,
                    'update_existing'   => true,
                    'replace_interests' => false,
                    'send_welcome'      => false,
                ));

                $this->model_member->update_member_level_up(
                    $request[API_COMPANY_VARIABLE], $order['order_member_id']);
            }
        }else{
            $result = 'UPDATE FAILED';
        }
        echo json_encode($result);

    }
}
