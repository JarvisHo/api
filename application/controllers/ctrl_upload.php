<?php
define("UPLOAD_PATH", "images/" );

class Ctrl_upload extends CI_Controller {

    var $upload_path;

    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form','url'));
        $this->load->model('model_upload');
        $this->load->library('upload');

        $this->load->library('session');

        $user_data = $this->session->all_userdata();

        if(isset($user_data['logged_in']))
        {
            if($user_data['logged_in']!=1){
                redirect('/login', 'location', 301);
            }
        }else{
            redirect('/login', 'location', 301);
        }

	}

    function index()
    {
        $this->load->view('templates/header');
        $this->load->view('brand/index');
        $this->load->view('templates/footer');
    }

    function do_upload()
    {

        $files = $_FILES;

        $cpt = count($_FILES['userfile']['name']);

        $brand_hash_id = $this->input->post('brand_hash_id');

        $image_width = $this->input->post('image_width');

        for($i=0; $i<$cpt; $i++)
        {
            if($cpt!=1)
                $ext = explode('.',$_FILES['userfile']['name'][$i]);
            else
                $ext = explode('.',$_FILES['userfile']['name']);

            $hash_name = sha1(current($ext).rand());
            $filename = $hash_name.'.'.end($ext);

            $_FILES['userfile']['name']= $filename;

            if($cpt!=1)
            {
                $_FILES['userfile']['type'] = $files['userfile']['type'][$i];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'][$i];
                $_FILES['userfile']['error'] = $files['userfile']['error'][$i];
                $_FILES['userfile']['size'] = $files['userfile']['size'][$i];
            }
            else
            {
                $_FILES['userfile']['type'] = $files['userfile']['type'];
                $_FILES['userfile']['tmp_name'] = $files['userfile']['tmp_name'];
                $_FILES['userfile']['error'] = $files['userfile']['error'];
                $_FILES['userfile']['size'] = $files['userfile']['size'];
            }

            $config = $this->set_upload_options();

            $this->upload->initialize($config);

            if ( ! $this->upload->do_upload())
            {
                print_r($config);

                echo $this->upload->display_errors();
            }
            else
            {

                $data = array('upload_data' => $this->upload->data());

                //Do resize

                $config['image_library'] = 'gd2';
                $config['source_image']	= $data['upload_data']['full_path'];
                $config['maintain_ratio'] = TRUE;
                $config['new_image'] = $hash_name."_".$image_width.'_thumb.'.end($ext);
                $config['width'] = $image_width;
                $config['height'] = $image_width;

                $this->load->library('image_lib',$config);

                if ( ! $this->image_lib->resize())
                {
                    //resize fail

                    echo $this->image_lib->display_errors();

                }else{

                    //Resize success

                    //Do insert to database table paw_file

                    $data = array('file_name'=>$config['new_image'],
                                      'file_path'=>UPLOAD_PATH,
                                      'file_extension'=>end($ext),
                                      'file_parent_hash_id'=>$brand_hash_id);

                    $this->model_upload->add_file($data);

                    //return ajax

                    echo base_url().UPLOAD_PATH.$config['new_image'];
                }

            }
        }

    }
    private function set_upload_options()
    {
        $config = array();
        $config['upload_path'] = UPLOAD_PATH;
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '0';
        $config['overwrite']     = FALSE;

        return $config;
    }

//    public function validate_upload_path()
//    {
//        if ($this->upload_path == '')
//        {
//            $this->set_error('upload_no_filepath');
//            return FALSE;
//        }
//
//        if (function_exists('realpath') AND @realpath($this->upload_path) !== FALSE)
//        {
//            $this->upload_path = str_replace("\\", "/", realpath($this->upload_path));
//        }
//
//        // This is most likely the trigger for your error
//        if ( ! @is_dir($this->upload_path))
//        {
//            $this->set_error('upload_no_filepath');
//            return FALSE;
//        }
//
//        if ( ! is_really_writable($this->upload_path))
//        {
//            $this->set_error('upload_not_writable');
//            return FALSE;
//        }
//
//        $this->upload_path = preg_replace("/(.+?)\/*$/", "\\1/",  $this->upload_path);
//        return TRUE;
//    }
}
