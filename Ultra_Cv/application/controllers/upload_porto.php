

<?php

//ULTRA CV BY VERLY ANANDA
//DONATE me : 139 249 6984 a/n elita BCA se ikhlasnya :D for make me keep spirit

//------------------------------------------------//
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
      class Upload_porto extends CI_Controller {
          var $gallery_path;
          var $gallery_path_url;
          public function __construct() {
               parent::__construct();
               $this->gallery_path = realpath(APPPATH . '../assets/img_porto/');
               $this->gallery_path_url = base_url() . 'assets/img_porto/';


  $this->load->helper(array('url','html','form'));

   }

   function upload() {
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
                $judul_porto = $this->input->post('judul_porto');
                $completed_porto = $this->input->post('completed_porto');
                $from_porto=$this->input->post('from_porto');
                $desc_porto=$this->input->post('desc_porto');


  $this->db->insert('portofolio',array(
        
              'judul'=>$judul_porto,
              'completed'=> $completed_porto,
              'client'=> $from_porto,
              'desc'=>$desc_porto,
              'img_porto' => $file));



                ///////// END
           redirect ('admin_area/settings_portofolio ');

         }

        }

    }

?>