<?php
define("INFINITY",0);
define("FRONT_END",TRUE);

class Ctrl_frontend extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->library('cart');

        $this->load->model('model_brand');
        $this->load->model('model_product');
        $this->load->model('model_cart');
        $this->load->model('model_card');
        $this->load->model('model_service');
        $this->load->model('model_search');
        $this->load->model('model_member');
        $this->load->model('model_receiver');

        $this->load->helper('form');
        $this->load->helper('mobile');

        if($this->input->get('process')=='cancel')$this->cart->destroy();

    }

    public function index()
    {
        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/index');
        $this->load->view('frontend/templates/footer');
    }

    public function faq()
    {
        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/faq');
        $this->load->view('frontend/templates/footer');
    }

    public function contact()
    {
        if($this->input->post('email')!='')
        {
            $this->load->helper('email');
            $subject = "[泡麻吉/PawMaji]客戶回饋單 ".date("Y-m-d",strtotime("now"));
            $msg = "客戶姓名：".$this->input->post('name')."<p><p>客戶聯絡電話：".$this->input->post('phone')."<p><p>電子信箱：".$this->input->post('email')."<p><p>客戶回饋：".$this->input->post('message');
            $to = "tsmediagroup@gmail.com";

            email_sender($subject, $msg, $to);

            $data['msg'] = " 訊息發送成功！我們會盡快給您回覆！";

        }else $data['msg'] = "";

        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/contact',$data);
        $this->load->view('frontend/templates/footer');
    }

    public function reset()
    {
        $this->load->helper('email');
        $this->load->helper('captcha');

        $values = array(
                'word'          => rand(10000000,99999999),
                'img_path'      => './captcha/',
                'img_url'       => base_url().'captcha/',
                'font_path'     => base_url().'system/fonts/texb.ttf',
                'img_width'     => '150',
                'img_height'    => 30,
                'expiration'    => 7200,
                'colors'        => array(
                                        'background' => array(255, 255, 255),
                                        'border' => array(255, 255, 255),
                                        'text' => array(0, 0, 0),
                                        'grid' => array(255, 40, 40)
                                        )
        );

        $cap = create_captcha($values);


        if(isset($_POST['captcha']))
        {
            if($_POST['captcha'] !="")
            {
                $expiration = time()-7200; // Two hour limit
                $this->db->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);

                // 然後驗證是否存在資料:
                $sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?";
                $binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
                $query = $this->db->query($sql, $binds);
                $row = $query->row();

                $temp = $this->input->post();

                if ($row->count == 0)
                {
                    $cap['msg'] = "<p style='color:red;font-size: 25px;'>驗證碼有誤，請重試！</p>";
                    if(!empty($temp['email']))$cap['email'] = $temp['email']; else $cap['email'] = "";

                }else{

                    if(!empty($temp['email'])){

                        $user = $this->model_member->get_member($temp['email']);

                        if(!empty($user['member_hash_id']))
                        {

                            $member_hash_id = $user['member_hash_id'];

                            $member_verify = $this->model_member->password_forget_member($member_hash_id);

                            email_sender("[泡麻吉]重新設定PawMaji帳戶密碼", get_reset_password_content($member_hash_id, $member_verify), $this->input->post('email'));
                        }

                    }
                    $cap['email'] = "";
                    $cap['msg'] = "<p style='color:green;font-size: 35px;'>密碼重設信已寄至您的信箱，請查收。</p>";

                }
            }
        }else{
            $cap['msg'] = "";
            $cap['email'] = "";
        }

        $data = array(
            'captcha_time'	=> $cap['time'],
            'ip_address'	=> $this->input->ip_address(),
            'word'	=> $cap['word']
        );

        $query = $this->db->insert_string('captcha', $data);

        $this->db->query($query);

        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/reset', $cap);
        $this->load->view('frontend/templates/footer');


    }

    public function entry($member_hash_id, $member_verify)
    {
        $error = false;

        if(!empty($member_hash_id)){

            $user = $this->model_member->view_member($member_hash_id);

            if(!empty($user['member_hash_id']))
            {
                $period = strtotime("now") - $user['member_validation'];

                if($period < 30*60) //30分鐘緩衝
                {
                    if($member_verify == $user['member_verify'])
                    {
                        $this->load->view('frontend/templates/header');
                        $this->load->view('frontend/entry', array('member_hash_id' => $member_hash_id));
                        $this->load->view('frontend/templates/footer');

                    }else $error = true;

                }else $error = true;

            }else $error = true;

        }else $error = true;

        if($error){
            $this->load->view('frontend/templates/header');
            $this->load->view('frontend/expire');
            $this->load->view('frontend/templates/footer');
        }
    }

    public function verify()
    {
        $error = false;

        if($this->input->post('Edsa63fdeDqwspo9dKjd4')!="") {

            $verify = $this->input->post();

            if($verify['password']==$verify['verify_password'])
            {

                $this->model_member->reset_password_member($this->input->post('Edsa63fdeDqwspo9dKjd4'), sha1($verify['password']));

                $this->load->view('frontend/templates/header');
                $this->load->view('frontend/verify');
                $this->load->view('frontend/templates/footer');

            }else $error = true;
        }else $error = true;

        if($error){
            $this->load->view('frontend/templates/header');
            $this->load->view('frontend/expire');
            $this->load->view('frontend/templates/footer');
        }

    }

    public function login()
    {
        if($this->input->post('action')=="login"){

            $email = $this->input->post('email');

            if(( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $email)))
            {
                $member['member_account'] = $this->input->post('email');
                $member['msg'] = "您的帳號或是密碼有誤，請重新嘗試！";
                $this->load->view('frontend/templates/header');
                $this->load->view('frontend/login', $member);
                $this->load->view('frontend/templates/footer');
                return false;
            }

            $data = $this->model_member->get_member($email);

            if(!empty($data['member_account']))
            {
                if($data['member_password']==sha1($this->input->post('password')))
                {
                    //設定參數
                    $loginData = array(
                        'member_id'  => $data['member_id'],
                        'member_status'  => $data['member_status'],
                        'username'  => $data['member_name'],
                        'email'     => $data['member_account'],
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($loginData);

                    if($data['member_status']==0)
                    {
                        if($this->input->post('source')=="header")
                        {
                            redirect('login','location',301);
                        }
                        else if($this->input->post('source')=="startup")
                        {
                            redirect('store','location',301);
                        }
                        else
                        {
                            redirect('form','location',301);
                        }

                    }else{
                        redirect('membership','location',301); //member送membership
                    }

                }else{

                    $member['member_account'] = $this->input->post('email');
                    $member['msg'] = "您的帳號或是密碼有誤，請重新嘗試！";
                    $this->load->view('frontend/templates/header');
                    $this->load->view('frontend/login', $member);
                    $this->load->view('frontend/templates/footer');
                    return false;

                }
            }else{

                //找不到帳號，還是說有誤
                $member['member_account'] = $this->input->post('email');
                $member['msg'] = "您的帳號或是密碼有誤，請重新嘗試！";
                $this->load->view('frontend/templates/header');
                $this->load->view('frontend/login', $member);
                $this->load->view('frontend/templates/footer');
                return false;
            }
        }
        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/index');
        $this->load->view('frontend/templates/footer');
    }

    public function logout()
    {
        $this->cart->destroy();

        $this->session->sess_destroy();

        if(isset($_SESSION))session_destroy();

        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/index');
        $this->load->view('frontend/templates/footer');
    }

    public function store_process($data){

        //搜尋品牌功能
        if($this->input->post('action')=="search")$data['brand_id'] = $this->model_search->search_brand();

        //處理購物車
        if($this->input->post('action')=="cart")$this->model_cart->cart_operate();

        //取得所有品牌
        $data['brands'] = $this->model_brand->get_brands(INFINITY, FRONT_END);

        //取得該品牌的所有產品
        if($data['brand_id']!=null)$data['products'] = $this->model_product->get_products($data['brand_id'], INFINITY, FRONT_END);

        //取得該品牌資訊
        if($data['brand_id']!=null)$data['brand'] = $this->model_brand->view_brand($data['brand_id']);

        return $data;
    }

    public function store($brand_id = 'bc5195688639b30cbe1e9e3874ef10394ca683d1')
    {
        $data['direction'] = "store";

        $data['brand_id'] = $brand_id;

        $data = $this->store_process($data);

        //若購物車已有商品，顯示下一步按鈕
        count($this->cart->contents())> 0 ? $data['next_step'] = "<a href='".base_url()."register?".strtotime('now')."' class='button button-highlight button-rounded wow pulse'>下一步 NEXT <span class='icon-arrow-right-alt1'></span></a>" : $data['next_step'] = "<button class='button button-highlight button-rounded wow pulse' disabled='disabled'>下一步 NEXT <span class='icon-arrow-right-alt1'></span></button>";
       
        //載入網頁標頭模板
            $this->load->view('frontend/templates/header');

        //載入網頁內容
            if($data['brand_id']!=null)$this->load->view('frontend/store',$data);
            else $this->load->view('frontend/store_no_brand',$data);

        $this->load->view('frontend/templates/footer');
    }

    public function startup()
    {
        if(isset($this->session->all_userdata()['logged_in'])) //是否已登入
        {
            redirect('store','location',301);
            exit();
        }

        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/startup');
        $this->load->view('frontend/templates/footer');
    }

    public function register()
    {
        //註冊程序
        if($this->input->post('action')=="register"){

            //檢查是否已經是會員
            $member = $this->model_member->get_member($this->input->post('new_email'));

            if(isset($member['member_id'])){

                //已經是會員導向登入頁面
                $member['msg'] = "您已經是我們的會員囉！請直接登入！";
                $this->load->view('frontend/templates/header');
                $this->load->view('frontend/login', $member);
                $this->load->view('frontend/templates/footer');

                return null;
                exit();

            }else{

                if($this->model_member->set_member())
                {
                    $loginData = array(
                        'member_id'  => mysql_insert_id(),
                        'member_status'  => 0,
                        'email'     => $this->input->post('new_email'),
                        'logged_in' => TRUE
                    );
                    $this->session->set_userdata($loginData);

                    //成功建立帳號，要判斷現在的位置
                    if($this->input->post('source')=="startup"){
                        redirect('store','location',301);
                        exit();
                    }
                    else{
                        redirect('form','location',301);
                        exit();
                    }
                }
            }
        }

        if(isset($this->session->all_userdata()['logged_in'])) //是否已登入
        {
            redirect('form','location',301);
            exit();
        }

        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/register');
        $this->load->view('frontend/templates/footer');
    }

    public function form()
    {
        //最終程序
        if($this->input->post('action')=="form")
        {
            //更新會員資料
            $this->model_member->update_member();

            //新增收件人資料
            $this->model_receiver->set_receiver();

            //新增信用卡資料
            $this->model_card->set_card();

            //新增服務並存入購物車
            $this->model_service->set_service();

            //送到 thankyou.php
            redirect('thankyou','location',301);
        }

        $user_data = $this->session->all_userdata();

        if(isset($user_data['logged_in'])) //是否已登入
        {
            if($user_data['member_status']==1){
                redirect('membership','location',301);
                exit();
            }

            $temp = $this->model_member->get_member($user_data['email']);

            empty($temp['member_name']) ? $data['member_name'] = '' : $data['member_name'] = $temp['member_name'];
            empty($temp['member_address']) ? $data['member_address'] = '' : $data['member_address'] = $temp['member_address'];
            empty($temp['member_phone']) ? $data['member_phone'] = '' : $data['member_phone'] = $temp['member_phone'];
            empty($temp['member_shipping']) ? $data['member_shipping'] = '' : $data['member_shipping'] = $temp['member_shipping'];
            empty($temp['member_last4']) ? $data['member_last4'] = '' : $data['member_last4'] = $temp['member_last4'];

            $pass_from_membership = $this->input->post();

            if($pass_from_membership['nextdate']!="")$data['member_date_next'] = $pass_from_membership['nextdate'];
            else $data['member_date_next'] ='';
            if($pass_from_membership['frequency']!="")$data['member_frequency'] =$pass_from_membership['frequency'];
            else $data['member_frequency'] = '';

            $this->load->view('frontend/templates/header');
            $this->load->view('frontend/form',$data);
            $this->load->view('frontend/templates/footer');

        }else{
            redirect('logout','location',301);
        }
    }

    public function thankyou()
    {
        $user_data = $this->session->all_userdata();

        if(!isset($user_data['logged_in']))redirect('logout','location',301);

        $data = $this->model_member->get_member($user_data['email']);

        $data['service'] = $this->model_service->get_service_by_member_id($user_data['member_id']);

        if(!isset($data['service']['service_date_next']))redirect('logout','location',301);

        //新增送信模組
        //2014.05.12 新增條件如果服務日期是未來才發信
        if($data['service']['service_date_next']!=date('Y-m-d',strtotime("today")))
        {
            $this->load->model('model_task');
            $source['task_category_id'] = 7;
            $source['task_member_id'] = $user_data['member_id'];
            $source['task_service_id'] = $data['service']['service_id'];
            $this->model_task->set_task_array($source);
        }

        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/thankyou',$data);
        $this->load->view('frontend/templates/footer');
    }



    public function prospect(){

        //如果是member 送membership page
        if($this->session->all_userdata()['member_status']==1){
            redirect('membership','location',301);
            return null;
        }

        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/prospect');
        $this->load->view('frontend/templates/footer');

    }

    public function get_receiver_array(){

        $receiver['receiver_id'] = $this->input->post('receiver_id');
        $receiver['receiver_name'] = $this->input->post('receiver_name');
        $receiver['receiver_phone'] = $this->input->post('receiver_phone');
        $receiver['receiver_address'] = $this->input->post('receiver_address');
        $receiver['receiver_session'] = $this->input->post('receiver_session');

        return $receiver;
    }

    public function delete_receiver($receiver_hash_id){

        if(strlen($receiver_hash_id)!=40)redirect('logout','location',301);

        if(!$this->model_receiver->delete_receiver($receiver_hash_id))redirect('logout','location',301);

        $this->membership();

    }

    public function set_default_receiver($receiver_hash_id){

        if(strlen($receiver_hash_id)!=40)redirect('logout','location',301);

        if(!$this->model_receiver->set_default_receiver($receiver_hash_id))redirect('logout','location',301);

        $this->membership();
    }

    public function membership()
    {
        $user_data = $this->session->all_userdata();

        if(!isset($user_data['logged_in']))redirect('logout','location',301);

        //如果是prospect 送prospect_ship page
        if($this->session->all_userdata()['member_status']==0){
            redirect('prospect','location',301);
            return null;
        }

        $data = $this->model_member->get_member($user_data['email']);

        //更新收件人
        if($this->input->post('action')=="update_receiver")
        {
            $this->model_receiver->update_receiver($this->get_receiver_array());
        }

        //新增收件人
        if($this->input->post('action')=="create_receiver")
        {
            $this->model_receiver->set_receiver_by_array($this->get_receiver_array());
        }

        //存檔，新增服務
        if($this->input->post('action')=="service")
        {
            if($this->model_service->set_service())
            {
                $this->cart->destroy();
                redirect('membership','location',301);
            }
        }

        //暫停特定定期宅配服務
        if($this->input->post('action')=="suspend"){
            if(!$this->model_service->switch_service_status())
            {
                redirect('error','location',301);
            }
        }

        //暫停特定定期宅配服務
        if($this->input->post('action')=="delete"){
            if(!$this->model_service->delete_service())
            {
                redirect('error','location',301);
            }
        }

        //載入服務與購物車
        $data['services'] = $this->model_service->get_services();


        //如果當前收件人是空的，就載入購物車當前的收件人
        $session = $this->session->all_userdata();

        if(!isset($session['selected_receiver']))
        {
            $default_receiver = $this->model_receiver->get_main_receiver($user_data['member_id']);

            if(!isset($default_receiver['receiver_id']))
            {
                $this->model_receiver->init_set_receiver();
                $default_receiver = $this->model_receiver->get_main_receiver($user_data['member_id']);
            }
            $session['selected_receiver'] = $default_receiver['receiver_id'];
            $this->session->set_userdata($session);
        }

        if($this->input->post('action')=="select_receiver"){
            $session['selected_receiver'] = $this->input->post('receiver_id');
            $this->session->set_userdata($session);
        }

        //載入收件人清單
        $data['selected_receiver'] = $this->model_receiver->get_receiver_by_id($session['selected_receiver']);
        $data['receivers'] = $this->model_receiver->get_receivers();

        //處理購物車
            if($this->input->post('action')=="cart")$this->model_cart->cart_operate();

        $this->load->view('frontend/templates/header');
        $this->load->view('frontend/membership',$data);
        $this->load->view('frontend/templates/footer');
    }

    public function user()
    {
        $user_data = $this->session->all_userdata();

        if(!isset($user_data['logged_in']))redirect('logout','location',301);

        //更新會員資料
        if($this->input->post('action')=="user")if($this->model_member->update_member())redirect('membership','location',301);

        $data = $this->model_member->get_member($user_data['email']);

        $this->load->view('frontend/templates/header');

        $this->load->view('frontend/user',$data);
        $this->load->view('frontend/templates/footer');
    }

    public function service($brand_id = 'bc5195688639b30cbe1e9e3874ef10394ca683d1')
    {
        $user_data = $this->session->all_userdata();

        if(!isset($user_data['logged_in']))redirect('logout','location',301);

        //首次進入服務編輯頁
        if($this->input->post('service_hash_id')!='')
        {
            //把被編輯的 service hash id 存到Session
            $temp = $this->session->all_userdata();
            $temp['service_hash_id'] = $this->input->post('service_hash_id');
            $this->session->set_userdata($temp);

            //首次進入先把之前的購物車清掉，再由載入服務中，載入該服務的購物車
            $this->cart->destroy();

            //首次進入才需要載入該服務的購物車

        }else{

            $service_id = $this->session->all_userdata()['service_hash_id'];

            if(empty($service_id))redirect('membership','location',301);
        }

        //存檔
        if($this->input->post('action')=="service"){

            if($this->input->post('process')=="delete_service"){

                if($this->model_service->delete_service())
                {
                    $this->cart->destroy();
                    redirect('membership','location',301);
                }

            }else{

                if($this->model_service->update_service())
                {
                    $this->cart->destroy();
                    redirect('membership','location',301);
                }
            }
        }

        //載入服務資料
        $data = $this->model_service->view_service($this->session->all_userdata()['service_hash_id']);

        //載入寄件人
        $data['receivers'] = $this->model_receiver->get_receivers();

        if($this->input->post('action')=="select_receiver")
        {
            $data['selected_receiver'] = $this->model_receiver->get_receiver_by_id($this->input->post('receiver_id'));
        }else{
            $data['selected_receiver'] = $this->model_receiver->get_receiver_by_id($data['service_receiver_id']);
        }

        if($this->input->post('service_hash_id')!='')$this->model_cart->load_cart($this->model_service->get_service_cart($data['service_id']));

        $data['direction'] = "service";

        $data['brand_id'] = $brand_id;

        $data = $this->store_process($data);

        $this->load->view('frontend/templates/header');

        if($data['brand_id']!=null)$this->load->view('frontend/service',$data);
        else $this->load->view('frontend/store_no_brand',$data);

        $this->load->view('frontend/templates/footer');
    }

    public function service_new($brand_id = 'bc5195688639b30cbe1e9e3874ef10394ca683d1')
    {
        $user_data = $this->session->all_userdata();

        if(!isset($user_data['logged_in']))redirect('logout','location',301);

        //首次進入服務編輯頁
        if($this->input->get('process')=='first')
        {
            //新增一個全新的 service hash id 存到Session
            $temp = $this->session->all_userdata();
            $temp['service_hash_id'] = sha1(rand().$this->session->all_userdata()['member_id']);
            $this->session->set_userdata($temp);

            //首次進入先把之前的購物車清掉
            $this->cart->destroy();
        }

        //存檔，新增服務
        if($this->input->post('action')=="service"){
            if($this->model_service->set_service())
            {
                $this->cart->destroy();
                redirect('membership','location',301);
            }
        }

        $data['brand_id'] = $brand_id;

        $data['direction'] = "service/new";

        $data = $this->store_process($data);

        $this->load->view('frontend/templates/header');

        if($data['brand_id']!=null)$this->load->view('frontend/service_new',$data);
        else $this->load->view('frontend/store_no_brand',$data);

        $this->load->view('frontend/templates/footer');
    }

}
