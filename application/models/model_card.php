<?php

class Model_card extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('ip');
    }

    public function auto_fix($str){

        $str = str_replace ("<","",$str);
        $str = str_replace (">","",$str);
        $str = str_replace (";","",$str);
        $str = str_replace (",","",$str);
        $str = str_replace ("'","",$str);
        $str = str_replace ("''","",$str);
        $str = str_replace ("+","",$str);
        $str = str_replace ("-","",$str);
        $str = str_replace ("*","",$str);
        $str = str_replace ("&","",$str);
        $str = str_replace ("=","",$str);
        $str = str_replace ("DROP","",$str);
        $str = str_replace ("SELECT","",$str);
        $str = str_replace ("(","",$str);
        $str = str_replace (")","",$str);

        return $str;
    }

    public function set_card()
    {
        $card_number = $this->auto_fix($this->input->post('cardNumber'));

        if(strlen($card_number)!=16)return null;

        $data = array(
            'card_member_id' => $this->input->post('member_id'),
            'card_card1' => substr($card_number,0,4),
            'card_card2' => substr($card_number,4,4),
            'card_card3' => substr($card_number,8,4),
            'card_card4' => substr($card_number,12,4),
            'card_year' => $this->input->post('year'),
            'card_month' => $this->input->post('month'),
            'card_ccv' => $this->input->post('ccv'),
            'card_ip' => get_user_ip()
        );
        if(!$this->db->insert('paw_member_credit_card', $data))redirect('warning','location',301);
    }

    public function disable_all_card(){

        $this->db->where('card_member_id', $this->input->post('member_id'));

        if(!$this->db->update('paw_member_credit_card', array('card_status' => 1)))return false;

    }

}