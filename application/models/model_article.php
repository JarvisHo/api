<?php

class Model_article extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_active_article($article_category_id)
    {
        $this->db->where('article_category_id',$article_category_id);
        $this->db->where('article_status', 1);
        $this->db->where('article_company_id', $this->session->all_userdata()['company_id']);
        $query = $this->db->get('article',1);
        return $query->row_array();
    }

    public function add_article_array($source)
    {
        $data = array();

        if(!empty($source['article_title']))$data['article_title'] = $source['article_title'];
        if(!empty($source['article_content']))$data['article_content'] = $source['article_content'];
        if(!empty($source['article_category']))$data['article_category'] = $source['article_category'];
        if(!empty($source['article_hash_id']))$data['article_hash_id'] = $source['article_hash_id'];
        if(!empty($source['article_alias']))$data['article_alias'] = $source['article_alias'];
        if(!empty($source['article_digest']))$data['article_digest'] = $source['article_digest'];
        if(!empty($source['article_lat']))$data['article_lat'] = $source['article_lat'];
        if(!empty($source['article_lon']))$data['article_lon'] = $source['article_lon'];

        if(count($data)>0)$this->db->insert('article', $source);

    }

    public function update_article_array($source)
    {
        $data = array();
        if(!empty($source['article_title']))$data['article_title'] = $source['article_title'];
        if(!empty($source['article_content']))$data['article_content'] = $source['article_content'];
        if(!empty($source['article_alias']))$data['article_alias'] = $source['article_alias'];
        if(!empty($source['article_digest']))$data['article_digest'] = $source['article_digest'];
        if(!empty($source['article_lat']))$data['article_lat'] = $source['article_lat'];
        if(!empty($source['article_lon']))$data['article_lon'] = $source['article_lon'];
        if($source['article_status']!="")$data['article_status'] = $source['article_status'];

        $this->db->where('article_hash_id', $source['article_hash_id']);
        $this->db->update('article', $data);
    }


    public function get_article($article_hash_id = FALSE, $article_category_id = null)
    {
        if ($article_hash_id === FALSE)
        {
            $this->db->order_by("article.article_id", "DESC");

            if($article_category_id != null) {
                $this->db->where('article_category_id', $article_category_id);
            }
            $this->db->from('article')->where('article_status < 2');

            $query = $this->db->get();

            $data = $query->result_array();

        } else {

            if(strlen($article_hash_id)<40)show_404();
            $this->db->from('article')->where('article_hash_id', $article_hash_id);
            $query = $this->db->get();
            $data = $query->row_array();
        }
        return $data;
    }

    public function get_article_via_alias($request)
    {
        $this->db->where('article_company_id', $request['company']);
        $this->db->where('article_lang_id', $request['lang']);
        $this->db->from('article')->where('article_alias', $request['article_alias']);
        $query = $this->db->get();
        return $query->row_array();
    }
}
