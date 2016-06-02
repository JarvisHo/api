<?php

class Ctrl_order_single extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Model_order_single');

        $this->load->library('form_validation');
        $this->load->library('session');

        $this->load->helper('date');
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->helper('email');

        $this->load->helper('verify_login');

        verify_login_admin($this->session->all_userdata());

    }


    public function index()
    {
        $data['order'] = $this->Model_order_single->get_order();

        $data['order_search']['FULLNAME'] = $this->input->post('FULLNAME');
        $data['order_search']['CELLPHONE'] = $this->input->post('CELLPHONE');
        $data['order_search']['ADDRESS'] = $this->input->post('ADDRESS');
        $data['order_search']['EMAIL'] = $this->input->post('EMAIL');
        $data['order_search']['ID'] = $this->input->post('ID');
        $data['order_search']['STATUS'] = $this->input->post('STATUS');
        $data['order_search']['startDate'] = $this->input->post('startDate');
        $data['order_search']['endDate'] = $this->input->post('endDate');

        $data = $this->orderTableFormat($data);

        $this->load->view('templates/header');
        $this->load->view('single/index', $data);
        $this->load->view('templates/footer');
    }


    public function view($order_id)
    {
        if ($this->input->post('action') == "suspend") {
            if (!$this->model_service->switch_service_status()) {
                redirect('error', 'location', 301);
            }
        }

        $data['order_item'] = $this->Model_order_single->get_order($order_id);

        if (empty($data['order_item'])) {
            show_404();
        }

        $options = array(
            '0' => '未進行到刷卡階段',
            '1' => '等待自動刷卡',
            '2' => '已成功付款',
            '3' => '付款失敗',
            '4' => '已出貨',
            '5' => '等待自動退款',
            '6' => '已退款',
            '7' => '退款失敗',
            '8' => '已出貨已退款'
        );


        $this->form_validation->set_rules('single_email', '姓名', 'required');
        $this->form_validation->set_rules('single_phone', '手機號碼', 'required');

        $selected = $data['order_item']['single_status'];
        $data['order_item']['single_status_select'] = form_dropdown('single_status', $options, $selected);

        if ($this->form_validation->run() === FALSE) {
            $data['msg'] = "<span></span>";
            $this->load->view('templates/header');
            $this->load->view('single/view', $data);
            $this->load->view('templates/footer');
        } else {
            $this->Model_order_single->update_order();
            $data['order_item'] = $this->Model_order_single->get_order($order_id);
            $data['order_item']['single_status_select'] = form_dropdown('single_status', $options, $data['order_item']['single_status']);
            $data['msg'] = "<span>Edited!</span>";
            $this->load->view('templates/header');
            $this->load->view('single/view', $data);
            $this->load->view('templates/footer');
        }
    }


    public function orderTableFormat($data)
    {
        for ($i = 0; $i < count($data['order']); $i++) {
//            $data['order'][$i]['order_stamp'] = mdate("%m-%d %h:%i", strtotime($data['order'][$i]['order_stamp']));

            switch ($data['order'][$i]['single_status']) {
                case 0:
                    $data['order'][$i]['STATUS_IMAGE'] = "<span class='hint--bottom' data-hint='未進行到刷卡階段'>" .img('dist/images/declined_order.png');
                    $data['order'][$i]['STATUS_HTML'] = "disabled='disabled')'";
                    break;
                case 1:
                    $data['order'][$i]['STATUS_IMAGE'] = img('dist/images/wait.png');
                    $data['order'][$i]['STATUS_HTML'] = "onclick='return confirm('請再次確認是否要進行退款，此動作無法取消。')'";
                    break;
                case 2:
                    $data['order'][$i]['STATUS_IMAGE'] = img('dist/images/approved_order.png');
                    $data['order'][$i]['STATUS_HTML'] = "onclick=\"return confirm('請再次確認是否要進行退款，此動作無法取消。');\"";
                    break;
                case 3:
                    $data['order'][$i]['STATUS_IMAGE'] = "<span class='hint--bottom' data-hint='" . $data['order'][$i]['single_error_message'] . "'>" . img('dist/images/declined_order.png') . "</span>";
                    $data['order'][$i]['STATUS_HTML'] = "disabled='disabled'";
                    break;
                case 4:
                    $data['order'][$i]['STATUS_IMAGE'] = img('dist/images/shipped_order.png');
                    $data['order'][$i]['STATUS_HTML'] = "disabled='disabled'";
                    break;
                case 5:
                    $data['order'][$i]['STATUS_IMAGE'] = img('dist/images/wait.png');
                    $data['order'][$i]['STATUS_HTML'] = "disabled='disabled'";
                    break;
                case 6:
                    $data['order'][$i]['STATUS_IMAGE'] = img('dist/images/void_or_refund_order.png');
                    $data['order'][$i]['STATUS_HTML'] = "disabled='disabled'";
                    break;
                case 7:
                    $data['order'][$i]['STATUS_IMAGE'] = "<span class='hint--bottom' data-hint='" . $data['order'][$i]['single_error_message'] . "'>" . img('dist/images/refund_fail_order.png') . "</span>";
                    $data['order'][$i]['STATUS_HTML'] = "onclick='return confirm('請再次確認是否要進行退款，此動作無法取消。')'";
                    break;
                case 8:
                    $data['order'][$i]['STATUS_IMAGE'] = img('dist/images/shipped_refund_order.png');
                    $data['order'][$i]['STATUS_HTML'] = "disabled='disabled'";
                    break;

            }
        }
        return $data;
    }
}
