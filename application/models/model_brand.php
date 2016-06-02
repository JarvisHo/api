<?php

class Model_brand extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
        $this->load->helper('parse');
    }

    public function set_brand()
    {
        $data = array(
            'brand_name' => $this->input->post('brand_name'),
            'brand_hash_id' => $this->input->post('brand_hash_id'),
            'brand_digest' => $this->input->post('brand_digest'),
            'brand_description' => $this->input->post('brand_description')
        );
        return $this->db->insert('paw_brand', $data);
    }

    public function view_brand($brand_id)
    {
        if (is_numeric($brand_id))
        {
            $field = 'brand_id';
        }else{
            $field = 'brand_hash_id';
        }

        $this->db->from('paw_brand')->where($field, $brand_id);

        $query = $this->db->get();

        $data = $query->row_array();

        if(isset($data['brand_description']))
        {
            $data['brand_image'] = current(get_images_src_array($data['brand_description'],"640x145"));//取出完畢
        }else{
            $data['brand_image'] = "";
        }



        return $data;
    }

    public function get_brands($limit, $frontend)
    {
        if($limit != 0) $this->db->limit($limit);

        if($frontend == true) $this->db->where('brand_status', 0);

        $this->db->order_by("paw_brand.brand_sort", "DESC");

        $this->db->from('paw_brand');

        $query = $this->db->get();

        return $query->result_array();
    }

    public function update_brand()
    {
        $data = array(
            'brand_name' => $this->input->post('brand_name'),
            'brand_sort' => $this->input->post('brand_sort'),
            'brand_status' => $this->input->post('brand_status'),
            'brand_digest' => $this->input->post('brand_digest'),
            'brand_description' => $this->input->post('brand_description')
        );
        $this->db->where('brand_hash_id', $this->input->post('brand_hash_id'));
        return $this->db->update('paw_brand', $data);
    }

    public function disable_brand()
    {
        $data = array(
            'brand_status' => 1
        );
        $this->db->where('brand_hash_id', $this->input->post('brand_hash_id'));
        $this->db->update('paw_brand', $data);
    }

    public function enable_brand()
    {
        $data = array(
            'brand_status' => 0
        );
        $this->db->where('brand_hash_id', $this->input->post('brand_hash_id'));
        $this->db->update('paw_brand', $data);
    }

    public function highlight_brand()
    {
        $data = array(
            'brand_sort' => 1
        );
        $this->db->where('brand_hash_id', $this->input->post('brand_hash_id'));
        $this->db->update('paw_brand', $data);
    }


}