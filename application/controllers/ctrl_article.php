<?php

class Ctrl_article extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_article');
    }

    public function get_article_via_alias($request)
    {
        $result = $this->model_article->get_article_via_alias($request);
        echo json_encode($result);
    }

}
