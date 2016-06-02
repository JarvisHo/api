<?php
class Model_service extends CI_Model
{
    public function __construct()
    {
        $this->load->database();

        $this->load->library('session');
        $this->load->library('cart');
        $this->load->helper('datetime');

        $this->load->model('model_order');
        $this->load->model('model_product');
        $this->load->model('model_cart');
        $this->load->model('model_receiver');

    }


    //後台dashboard 啟動的服務數量
    public function get_dashboard_active_service_counter()
    {
        $this->db->from('paw_member_service')->where('service_status', 0 );

        return $this->db->count_all_results();
    }

    //後台dashboard 5日內下單的服務數量
    public function get_recent_services()
    {
        $this->db->where('service_status', 0 );

        $this->db->where('service_date_next >', date("Y-m-d",strtotime("today")) );

        $this->db->order_by("service_date_next", "asc");

        $this->db->join('paw_member', 'paw_member.member_id = paw_member_service.service_member_id', 'left');

        $this->db->join('paw_member_receiver', 'paw_member_receiver.receiver_id = paw_member_service.service_receiver_id', 'left');

        $query = $this->db->from('paw_member_service')->where('service_date_next <=', date("Y-m-d",strtotime("+ 5 days")))->get();

        $data = $query->result_array();

        for($i=0 ; $i <count($data); $i++)
        {

            switch ($data[$i]['member_shipping']) {
                case 0:
                    $data[$i]['member_shipping_text'] = "晚上";
                    break;
                case 1:
                    $data[$i]['member_shipping_text'] = "下午";
                    break;
                case 2:
                    $data[$i]['member_shipping_text'] = "早上";
                    break;
            }


            if(!empty($data[$i]['service_date_next']) AND $data[$i]['service_date_next']!='0000-00-00') {
                $data[$i]['service_date_next_year'] = get_year($data[$i]['service_date_next'])."年";
                $data[$i]['service_date_next_date'] = "<span style='font-size: 2em'>".get_month($data[$i]['service_date_next'])."</span>月<span style='font-size: 2em'>".get_date($data[$i]['service_date_next'])."</span>日";
            }else{
                $data[$i]['service_date_next_year'] = '';
                $data[$i]['service_date_next_date'] = '-';
            }
            if(!empty($data[$i]['service_date_last']) AND $data[$i]['service_date_last']!='0000-00-00'){
                $data[$i]['service_date_last_year']= get_year($data[$i]['service_date_last']);
                $data[$i]['service_date_last_date']= "<span style='font-size: 2em'>".get_month($data[$i]['service_date_last'])."</span>月<span style='font-size: 2em'>".get_date($data[$i]['service_date_last'])."</span>日";
            }else{
                $data[$i]['service_date_last_year'] = '';
                $data[$i]['service_date_last_date'] = '-';
            }

            if($data[$i]['service_status']==0 )$data[$i]['service_status_class'] = "table-active"; else $data[$i]['service_status_class'] = "table-disabled";

            $data[$i]['service_cart'] = $this->get_service_cart($data[$i]['service_id']);

            for($j=0;$j<count($data[$i]['service_cart']);$j++)
            {
                $temp = $this->model_product->get_package($data[$i]['service_cart'][$j]['cart_package_id']);
                if($temp['package_price']!="")$data[$i]['service_cart'][$j]['cart_package_price'] = $temp['package_price']; else $data[$i]['service_cart'][$j]['cart_package_price'] = "";
                if($temp['package_weight']!=""){
                    $data[$i]['service_cart'][$j]['cart_package_weight'] = $temp['package_weight'];
                    $data[$i]['service_cart'][$j]['cart_package_weight_text'] = "".number_format($temp['package_weight']*0.00221,1)."磅 / ".number_format($temp['package_weight']/1000,1)." 公斤";
                } else {
                    $data[$i]['service_cart'][$j]['cart_package_weight'] = "";
                    $data[$i]['service_cart'][$j]['cart_package_weight_text'] = "";
                }
                $data[$i]['service_cart'][$j]['cart_product_name'] = $this->model_product->view_product($data[$i]['service_cart'][$j]['cart_product_id'])['product_name'];

            }

        }

        return $data;
    }

    //前台thankyou使用中，只會叫出最後一筆 service
    public function get_service_by_member_id($service_member_id)
    {
        $this->db->order_by("service_id", "desc");
        $this->db->where("service_status", 0);
        $this->db->join('paw_member_receiver', 'paw_member_receiver.receiver_id = paw_member_service.service_receiver_id', 'left');
        $query = $this->db->where('service_member_id', $service_member_id )->get('paw_member_service', 1 );
        $data = $query->row_array();

        if(!empty($data['service_date_next']) AND $data['service_date_next']!='0000-00-00') {
            $data['service_date_next_year'] = get_year($data['service_date_next'])."年";
            $data['service_date_next_date'] = "<span style='font-size: 2em'>".get_month($data['service_date_next'])."</span>月<span style='font-size: 2em'>".get_date($data['service_date_next'])."</span>日";
        }else{
            $data['service_date_next_year'] = '';
            $data['service_date_next_date'] = '-';
        }
        if(!empty($data['service_date_last']) AND $data['service_date_last']!='0000-00-00'){
            $data['service_date_last_year']= get_year($data['service_date_last']);
            $data['service_date_last_date']= "<span style='font-size: 2em'>".get_month($data['service_date_last'])."</span>月<span style='font-size: 2em'>".get_date($data['service_date_last'])."</span>日";
        }else{
            $data['service_date_last_year'] = '';
            $data['service_date_last_date'] = '-';
        }

        if($data['service_status']==0 )$data['service_status_class'] = "table-active"; else $data['service_status_class'] = "table-disabled";

        $data['service_cart'] = $this->get_service_cart($data['service_id']);

        for($j=0;$j<count($data['service_cart']);$j++)
        {
            $temp = $this->model_product->get_package($data['service_cart'][$j]['cart_package_id']);
            if($temp['package_price']!="")$data['service_cart'][$j]['cart_package_price'] = $temp['package_price']; else $data['service_cart'][$j]['cart_package_price'] = "";
            if($temp['package_weight']!="")$data['service_cart'][$j]['cart_package_weight'] = $temp['package_weight']; else $data['service_weight'][$j]['cart_package_weight'] = "";
            $data['service_cart'][$j]['cart_product_name'] = $this->model_product->view_product($data['service_cart'][$j]['cart_product_id'])['product_name'];
        }
        return $data;
    }

    public function get_service_by_id($service_id)
    {
        $query = $this->db->from('paw_member_service')->where('service_id', $service_id )->get();

        return $query->row_array();
    }

    public function set_service()
    {
        $nextdate = $this->input->post('nextdate');

        if(empty($nextdate))$nextdate = date("Y-m-d");

        $receiver_id = $this->input->post('receiver_id');

        if($receiver_id == "") //查主要的receiver_id
        {
            $this->load->model('model_receiver');

            $receiver = $this->model_receiver->get_main_receiver($this->input->post('member_id'));

            $receiver_id = $receiver['receiver_id'];
        }

        $data = array(
            'service_receiver_id' => $receiver_id,
            'service_member_id' => $this->input->post('member_id'),
            'service_date_next' => $nextdate,
            'service_frequency' => $this->input->post('frequency'),
            'service_hash_id' => $this->session->all_userdata()['service_hash_id']
        );
        if(!$this->db->insert('paw_member_service', $data))redirect('warning','location',301);

        $service_id = mysql_insert_id();

        foreach ($this->cart->contents() as $items):

            unset($data);

            $data = array(
                'cart_member_id' => $this->input->post('member_id'),
                'cart_product_id' => $items['product'],
                'cart_package_id' => $items['id'],
                'cart_service_id' => $service_id,
                'cart_package_image' => $items['image'],
                'cart_package_qty' => $items['qty']
            );
            $this->db->insert('paw_member_cart', $data);//)redirect('warning','location',301);

        endforeach;

        $this->cart->destroy();

        return true;
    }

    public function update_service()
    {
        $nextdate = $this->input->post('nextdate');

        if(empty($nextdate))$nextdate = date("Y-m-d");

        $data = array(
            'service_date_next' => $nextdate,
            'service_receiver_id' => $this->input->post('service_receiver_id'),
            'service_frequency' => $this->input->post('frequency')
        );
        $this->db->where('service_hash_id', $this->session->all_userdata()['service_hash_id']);

        if(!$this->db->update('paw_member_service', $data))redirect('warning','location',301);

        $service = $this->model_service->view_service($this->session->all_userdata()['service_hash_id']);

        $this->db->where('cart_service_id', $service['service_id']);

        if(!$this->db->update('paw_member_cart', array('cart_status' => 1)))return false;

        foreach ($this->cart->contents() as $items):

            unset($data);

            $data = array(
                'cart_member_id' => $this->input->post('member_id'),
                'cart_product_id' => $items['product'],
                'cart_package_id' => $items['id'],
                'cart_service_id' => $service['service_id'],
                'cart_package_image' => $items['image'],
                'cart_package_qty' => $items['qty']
            );
            $this->db->insert('paw_member_cart', $data);//)redirect('warning','location',301);

        endforeach;



        return true;
    }

    public function switch_service_status()
    {
        $row = $this->view_service($this->input->post('service_hash_id'));

        if($row['service_status']==0)$status = 1; else $status = 0;

        $this->db->where('service_hash_id', $this->input->post('service_hash_id'));

        if(!$this->db->update('paw_member_service', array('service_status' => $status)))redirect('warning','location',301);

        return true;
    }

    public function delete_service()
    {
        $this->db->where('service_hash_id', $this->input->post('service_hash_id'));

        if(!$this->db->update('paw_member_service', array('service_status' => 2)))redirect('warning','location',301);

        return true;
    }

    //前台membership 使用中
    public function get_services()
    {
        if(!isset($this->session->all_userdata()['member_id']))redirect('logout','location',301);

        $this->db->order_by("paw_member_service.service_status", "ASC");

        $this->db->order_by("paw_member_service.service_date_next", "ASC");

        //附加地址資訊
        $this->db->join('paw_member_receiver', 'paw_member_receiver.receiver_id = paw_member_service.service_receiver_id', 'left');

        $this->db->where("paw_member_service.service_member_id", $this->session->all_userdata()['member_id']);

        $this->db->where("paw_member_service.service_status < 2");

        $this->db->from('paw_member_service');

        $query = $this->db->get();

        $data = $query->result_array();

        for($i=0 ; $i <count($data); $i++)
        {

            //非多地址的版本用戶，補救措施
            if($data[$i]['receiver_name']==""){

                $this->load->model('model_receiver');
                $receiver = $this->model_receiver->get_main_receiver($this->session->all_userdata()['member_id']);

                //非多地址的版本用戶補上service_receiver_id
                $service_update = array('service_receiver_id' => $receiver['receiver_id']);
                $this->db->where('service_hash_id', $data[$i]['service_hash_id']);
                $this->db->update('paw_member_service', $service_update);

                $data[$i]['receiver_name'] = $receiver['receiver_name'];
                $data[$i]['receiver_phone'] = $receiver['receiver_phone'];
                $data[$i]['receiver_address'] = $receiver['receiver_address'];
                $data[$i]['receiver_session'] = $receiver['receiver_session'];

            }

            switch ($data[$i]['receiver_session']) {
                case 0:
                    $data[$i]['receiver_session_text'] = "晚上";
                    break;
                case 1:
                    $data[$i]['receiver_session_text'] = "下午";
                    break;
                case 2:
                    $data[$i]['receiver_session_text'] = "早上";
                    break;
                case 3:
                    $data[$i]['receiver_session_text'] = "不限";
                    break;
            }

            if(!empty($data[$i]['service_date_next']) AND $data[$i]['service_date_next']!='0000-00-00') {
                $data[$i]['service_date_next_year'] = get_year($data[$i]['service_date_next'])."年";
                $data[$i]['service_date_next_date'] = "<span style='font-size: 2em'>".get_month($data[$i]['service_date_next'])."</span>月<span style='font-size: 2em'>".get_date($data[$i]['service_date_next'])."</span>日";
            }else{
                $data[$i]['service_date_next_year'] = '';
                $data[$i]['service_date_next_date'] = '-';
            }
            if(!empty($data[$i]['service_date_last']) AND $data[$i]['service_date_last']!='0000-00-00'){
                $data[$i]['service_date_last_year']= get_year($data[$i]['service_date_last']);
                $data[$i]['service_date_last_date']= "<span style='font-size: 2em'>".get_month($data[$i]['service_date_last'])."</span>月<span style='font-size: 2em'>".get_date($data[$i]['service_date_last'])."</span>日";
            }else{
                $data[$i]['service_date_last_year'] = '';
                $data[$i]['service_date_last_date'] = '-';
            }

            if($data[$i]['service_status']==0 )$data[$i]['service_status_class'] = "table-active"; else $data[$i]['service_status_class'] = "table-disabled";

            $data[$i]['service_cart'] = $this->get_service_cart($data[$i]['service_id']);

            for($j=0;$j<count($data[$i]['service_cart']);$j++)
            {
                $temp = $this->model_product->get_package($data[$i]['service_cart'][$j]['cart_package_id']);
                if($temp['package_price']!="")$data[$i]['service_cart'][$j]['cart_package_price'] = $temp['package_price']; else $data[$i]['service_cart'][$j]['cart_package_price'] = "";
                if($temp['package_weight']!="")$data[$i]['service_cart'][$j]['cart_package_weight'] = $temp['package_weight']; else $data[$i]['service_cart'][$j]['cart_package_weight'] = "";
                $data[$i]['service_cart'][$j]['cart_product_name'] = $this->model_product->view_product($data[$i]['service_cart'][$j]['cart_product_id'])['product_name'];

            }

        }

        return $data;
    }

    //後台會員列表使用中
    public function get_member_services($member_id)
    {
        $this->db->order_by("paw_member_service.service_status", "ASC");

        $this->db->order_by("paw_member_service.service_date_next", "ASC");

        $this->db->where("paw_member_service.service_member_id", $member_id);

        $this->db->where("paw_member_service.service_status < 2");

        $this->db->from('paw_member_service');

        $query = $this->db->get();

        $data = $query->result_array();


        if(count($data) > 0){

            for($i=0 ; $i <count($data); $i++)
            {
                if(!empty($data[$i]['service_date_next']) AND $data[$i]['service_date_next']!='0000-00-00') {
                    $data[$i]['service_date_next_year'] = get_year($data[$i]['service_date_next'])."年";
                    $data[$i]['service_date_next_date'] = "<span style='font-size: 2em'>".get_month($data[$i]['service_date_next'])."</span>月<span style='font-size: 2em'>".get_date($data[$i]['service_date_next'])."</span>日";
                }else{
                    $data[$i]['service_date_next_year'] = '';
                    $data[$i]['service_date_next_date'] = '-';
                }
                if(!empty($data[$i]['service_date_last']) AND $data[$i]['service_date_last']!='0000-00-00'){
                    $data[$i]['service_date_last_year']= get_year($data[$i]['service_date_last']);
                    $data[$i]['service_date_last_date']= "<span style='font-size: 2em'>".get_month($data[$i]['service_date_last'])."</span>月<span style='font-size: 2em'>".get_date($data[$i]['service_date_last'])."</span>日";
                }else{
                    $data[$i]['service_date_last_year'] = '';
                    $data[$i]['service_date_last_date'] = '-';
                }

                if(isset($data[$i]['service_date_next'])){
//                    $data[$i]['service_date_left'] = days_between_dates($data[$i]['service_date_next'],date('Y-m-d',strtotime("today")));
                    $data[$i]['service_date_left'] = "?";
                }else{
                    $data[$i]['service_date_left'] = "?";
                }
//
                if(isset($data[$i]['service_status']))
                {
                    if($data[$i]['service_status']==0 )
                    {
                        $data[$i]['service_status_class'] = "table-active";
                    } else {
                        $data[$i]['service_status_class'] = "table-disabled";
                    }
                }else{
                    $data[$i]['service_status_class'] = "table-disabled";
                }

//
                $data[$i]['service_cart'] = $this->get_service_cart($data[$i]['service_id']);

                for($j=0;$j<count($data[$i]['service_cart']);$j++)
                {
                    $temp = $this->model_product->get_package($data[$i]['service_cart'][$j]['cart_package_id']);

                    if(isset($temp['package_price']))
                        $data[$i]['service_cart'][$j]['cart_package_price'] = $temp['package_price'];
                    else $data[$i]['service_cart'][$j]['cart_package_price'] = $data[$i]['service_cart'][$j]['cart_package_id'];
                    $data[$i]['service_cart'][$j]['cart_product_name'] = $this->model_product->view_product($data[$i]['service_cart'][$j]['cart_product_id'])['product_name'];
                }
            }

            return $data;

        }else{
            return null;
        }




    }


    public function view_service($service_id){

        if (is_numeric($service_id))
        {
            $field = 'service_id';
        }else{
            $field = 'service_hash_id';
        }

        $this->db->where($field, $service_id);

        $this->db->from('paw_member_service');

        $query = $this->db->get();

        $data = $query->row_array();

        return $data;
    }

    public function get_service_cart($service_id){

        $this->db->where("paw_member_cart.cart_service_id", $service_id);

        $this->db->where("paw_member_cart.cart_status", 0);

        $this->db->from('paw_member_cart');

        $query = $this->db->get();

        return $query->result_array();

    }

    public function get_service_cart_detail($service_id)
    {
        $this->db->select('product_name, package_weight, package_price, cart_package_qty');

        $this->db->join('paw_brand_product', 'product_id = cart_product_id', 'left');

        $this->db->join('paw_brand_product_package', 'package_id = cart_package_id', 'left');

        $this->db->where("paw_member_cart.cart_service_id", $service_id);

        $this->db->where("paw_member_cart.cart_status", 0);

        $this->db->from('paw_member_cart');

        $query = $this->db->get();

        return $query->result_array();
    }

}