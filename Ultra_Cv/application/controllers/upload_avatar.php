<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
      class Upload_avatar extends CI_Controller {
          var $gallery_path;
          var $gallery_path_url;
          public function __construct() {
               parent::__construct();
               $this->gallery_path = realpath(APPPATH . '../gui/assets/ultraviolet_avatar/');
               $this->gallery_path_url = base_url() . 'gui/assets/ultraviolet_avatar/';


  $this->load->helper(array('url','html','form'));

   }

   function upload() {
            $id_user=$this->uri->segment(3);
    if   ($this->input->post('upload')){  

                $config = array(
                         'allowed_types' => 'jpg|jpeg|gif|png',
                         'upload_path' => $this->gallery_path,
                         'max_size' => 2000,
                         'file_name' => url_title($this->input->post('file_upload'))
                );

                $this->load->library('upload', $config);
                $this->upload->do_upload();

                //////// START ,Sintak untuk menyimpan data hasil upload ke database mysql 
                $file = $this->upload->file_name;
                $username = $this->input->post('username');
                 $password = $this->input->post('password');
                 $gambar_lama=$this->input->post('gambar_lama');
                      unlink("./gui/assets/ultraviolet_avatar/$gambar_lama");

  $this->db->where('id_user',$id_user);
  $this->db->update('user',array(
        
              'username'=>$username,
              'password'=> $password,
                        'avatar' => $file));



          $this->session->sess_destroy();
    redirect('backend');

         }

        }

    }

?>