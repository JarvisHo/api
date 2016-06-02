<?php

class Model_search extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function search_brand()
    {
        $this->db->like('brand_name', $this->input->post('brand_part_text'));

        $this->db->from('paw_brand')->where('brand_status', 0);;

        $query = $this->db->get();

        $data = $query->row_array();

        if(!empty($data['brand_id']))
        {
            return $data['brand_id'];
        }
        else{


            //品牌名稱，找不到就找產品名稱
            $this->db->like('product_name', $this->input->post('brand_part_text'));

            $this->db->from('paw_brand_product')->where('product_status', 0);

            $query = $this->db->get();

            $data = $query->result_array();

            for($i=0;$i<count($data);$i++)
            {
                if(!empty($data[$i]['product_brand_id']))
                {
                    $this->db->from('paw_brand')->where('brand_id', $data[$i]['product_brand_id']);
                    $query = $this->db->get();
                    $temp = $query->row_array();
                    if(isset($temp['brand_status']))if($temp['brand_status']==0)return $temp['brand_id'];
                }
            }

            return null;
        }
    }

}