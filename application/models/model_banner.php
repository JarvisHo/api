<?php

class Model_banner extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_news_banner(){

        return $this->get_banners(1);

    }

    public function get_about_banner(){

        return $this->get_banners(2);

    }

    public function get_teachers_banner(){

        return $this->get_banners(3);

    }

    public function get_courses_banner(){

        return $this->get_banners(4);

    }

    public function get_activities_banner(){

        return $this->get_banners(5);

    }

    public function get_enroll_banner(){

        return $this->get_banners(6);

    }

    public function get_banners($category,$company_id='999',$lang_id='999'){

        $this->db->where('banner_company_id',$company_id);
        $this->db->where('banner_lang_id',$lang_id);

        $this->db->from('pas_banner')->where('banner_category', $category);

        $query = $this->db->get();

        $result = $query->result_array();

        for($i = 0; $i < count($result); $i++)
        {
            $source = $result[$i]['banner_source'];

            if(empty($source)){

                $result[$i]['banner_youtube'] = "";

                $result[$i]['banner_image'] = "";

                $result[$i]['banner_unit'] = "";

            }else{

            if(strstr($source, 'youtube'))
            {
                $result[$i]['banner_youtube'] = $source;

                $result[$i]['banner_image'] = "";

                $result[$i]['banner_unit'] = "<li><iframe class='youtube' width='100%' src='//www.youtube.com/embed/".end(explode("=", $source))."' frameborder='0' allowfullscreen ></iframe></li>";

            }else{

                $result[$i]['banner_youtube'] = "";

                $result[$i]['banner_image'] = end(explode("/", $source));

                $result[$i]['banner_unit'] = '';

                if($result[$i]['banner_link']!='')$result[$i]['banner_unit'] = "<a href='".$result[$i]['banner_link']."' target='_blank'>";
                $result[$i]['banner_unit'] .= "<li style='background-color: #f5f5f5;'><center><img src='".base_url()."uploads/".$source."' class='img-responsive banner_img'/></center></li></a>";
                if($result[$i]['banner_link']!='')$result[$i]['banner_unit'] .= "</a>";
            }

            }
        }

        return $result;

    }

    public function update_banners($target)
    {
        for($i=0;$i<count($target['banner_link']);$i++){
            $data = array(
                'banner_source'     => $target['banner_source'][$i],
                'banner_link'       => $target['banner_link'][$i],
            );
            $this->db->where('banner_id',$target['banner_id'][$i]);
            $this->db->where('banner_company_id',$target['banner_company_id']);
            $this->db->where('banner_lang_id',$target['banner_lang_id']);
            $this->db->update('pas_banner',$data);
        }
    }

    public function func_get_banner_status($banner_id)
    {
        $this->db->where('banner_id',$banner_id);
        $source = $this->db->get('pas_banner')->row_array();
        return $source['banner_status'];

    }

    public function func_switch_banner_status($banner_id,$ori_banner_status)
    {
        $data = array(
            'banner_status' => 2,
        );
        switch($ori_banner_status){
            case(0):
                $data = array(
                    'banner_status' => 1,
                );
                break;
            case(1):
                $data = array(
                    'banner_status' => 0,
                );
                break;
        }
        $this->db->where('banner_id',$banner_id);
        $this->db->update('pas_banner',$data);
        return $data['banner_status'];
    }

    public function update_banners_dep()
    {

        $target = $_FILES;

        for($i = 0 ;$i< count($target['id']);$i++){

            if($target['url'][$i]=='')
            {

                if($target['files']['name'][$i]!='')
                {
                    unset($_FILES);

                    $width = 1200;

                    $ext = end(explode('.',$target['files']['name'][$i]));
                    $hash_file_name = sha1($ext[0].rand());
                    $filename = $hash_file_name.'.'.$ext;

                    $_FILES['userfile']['name'] = $filename;
                    $_FILES['userfile']['type'] = $target['files']['type'][$i];
                    $_FILES['userfile']['tmp_name'] = $target['files']['tmp_name'][$i];
                    $_FILES['userfile']['error'] = $target['files']['error'][$i];
                    $_FILES['userfile']['size'] = $target['files']['size'][$i];


                    $this->upload->initialize($this->set_upload_options());

                    if ( ! $this->upload->do_upload())
                    {
                        $error = array('error' => $this->upload->display_errors());
                        $this->load->view('upload_form',$error);
                    }
                    else
                    {
                        $data = array('upload_data' => $this->upload->data());

                        $config['image_library'] = 'gd2';
                        $config['source_image']	= $data['upload_data']['full_path'];
                        $config['maintain_ratio'] = TRUE;
                        $config['new_image'] = $hash_file_name."_".$width.'_thumb.'.$ext;
                        $config['width'] = $width;
                        $config['height'] = $width;

                        $this->load->library('image_lib',$config);

                        if ( ! $this->image_lib->resize())
                        {
                            echo $this->image_lib->display_errors();

                        }else{

                            $target['source'][$i] = $config['new_image'];
                            echo $target['source'][$i];
                        }
                    }
                }else{
                    $target['source'][$i] = $target['path'][$i];
                }

            }else{
                $target['source'][$i] = $target['url'][$i];
            }

            $data = array(
                'banner_source' => $target['source'][$i],
                'banner_link' => $target['link'][$i]
            );

            $this->db->where('banner_id', $target['id'][$i]);
            $this->db->update('pas_banner', $data);

        }
    }

    private function set_upload_options()
    {
        //  upload an image options
        $config = array();
        $config['upload_path'] = 'uploads/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }

    public function set_default_banners($category,$company_id,$lang_id)
    {
        $data = array(
            'banner_category'   => $category,
            'banner_company_id' => $company_id,
            'banner_lang_id'    => $lang_id,
            'banner_source'     => 'default_img.jpg',
            'banner_link'       => '',
            'banner_hash_id'    => 'z',
            'banner_status'     => 1,
        );
        for($i=0;$i<5;$i++){
            $this->db->insert('pas_banner',$data);
        }
    }
}
