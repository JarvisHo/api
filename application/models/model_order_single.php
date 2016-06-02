<?php

class Model_order_single extends CI_Model
{

  public function __construct()
  {
    $this->load->database();
  }

  public function get_order($single_id = FALSE)
  {
    if ($single_id === FALSE)
    {
        $post = $this->input->post();

        if(count($post)>0)
        {
            $array = array();

            if(!empty($post['FULLNAME']))$array['single_name'] = $post['FULLNAME'];
            if(!empty($post['CELLPHONE']))$array['single_phone'] = $post['CELLPHONE'];
            if(!empty($post['ADDRESS']))$array['single_address'] = $post['ADDRESS'];
            if(!empty($post['ID']))$array['single_paynow_buy_safe_no'] = $post['ID'];
            if(!empty($post['EMAIL']))$array['single_email'] = $post['EMAIL'];
            if(!empty($post['startDate']))$this->db->where( "single_stamp_create > ", $post['startDate']);
            if(!empty($post['endDate']))$this->db->where( "single_stamp_create < ", $post['endDate']);
            if(!empty($post['STATUS']))$array['single_status'] = $post['STATUS'];

            if(count($array)>0)$this->db->like($array);
        }

        $this->db->order_by("single_stamp_create", "desc");

        $query = $this->db->get('paw_sales_single');

        $data['order'] = $query->result_array();

        return $data['order'];

    }else{

        $this->db->from('paw_sales_single')->where('single_id', $single_id);
        $query = $this->db->get();

        $data = $query->row_array();

        return $data;
    }

  }

   public function update_order()
   {
     $this->load->helper('url');


     $data = array(
         'single_name' => $this->input->post('single_name'),
         'single_phone' => $this->input->post('single_phone'),
         'single_address' => $this->input->post('single_address'),
         'single_status' => $this->input->post('single_status')
     );
       $this->db->where('single_id', $this->input->post('single_id'));

       return $this->db->update('paw_sales_single', $data);
   }
//
//    public function start_auto_refund_order($single_id){
//        $data = array(
//            'single_status' => 4
//        );
//        $this->db->where('single_id', $single_id);
//        return $this->db->update('paw_sales_single', $data);
//
//    }
//    public function set_single_shipped($single_id){
//        $data = array(
//            'single_status' => 3
//        );
//        $this->db->where('single_id', $single_id);
//        return $this->db->update('paw_sales_single', $data);
//
//    }

}
