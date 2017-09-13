<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
      class Upload_img extends CI_Controller {
          var $gallery_path;
          var $gallery_path_url;
          public function __construct() {
               parent::__construct();
               $this->gallery_path = realpath(APPPATH . '../assets/img_blog/');
               $this->gallery_path_url = base_url() . 'assets/img_blog/';

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
                $title = $this->input->post('title');
                $kategoris=$this->input->post('kategoris');
                $pengirim = $this->input->post('pengirim');
                $isi = $this->input->post('isi');
                $tgl = date('Y-m-d H:i:s');

  $this->db->insert('blog',array(
              'id_category' => $kategoris,
  						'judul' => $title,
  						'pengirim'=>$pengirim,
  						'isi_blog'=> $isi,
                        'img_blog' => $file,
                        'date' => $tgl ));

                ///////// END

           redirect ('index.php/admin_area/settings_blog');

         }

        }

    }

?>