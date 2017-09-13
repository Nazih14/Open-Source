<?php
//ULTRA CV BY VERLY ANANDA
//DONATE me : 139 249 6984 a/n elita BCA se ikhlasnya :D for make me keep spirit and for buy some foods.

//------------------------------------------------//


class Admin_area extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->helper(array('url'));
		$this->load->library('form_validation');
		 $this->load->library('pagination');
		$this->cek_session();
	}
		function cek_session(){
		if($this->session->userdata('username') == NULL )
		{
			redirect('backend');
		}		
	}
	function index(){
		$this->load->view('backend/header_admin');
		$data['query'] = $this->model_backend->front();
		$this->load->view('backend/sidebar_admin',$data);
		$this->load->view('backend/index_admin');
		$this->load->view('backend/footer_admin');
	}
	function logout(){
		$this->session->sess_destroy();
		redirect('backend');
	}


//footer frontend
	function settings_footer(){
		$this->load->view('backend/header_admin');
		$id_footer=$this->uri->segment(3);
		$data['query'] = $this->model_backend->front();
		$data['data_footer']=$this->model_backend->query_footer($id_footer);
		$this->load->view('backend/sidebar_admin',$data);
		$this->load->view('backend/index_footer',$data);
		$this->load->view('backend/footer_admin');


	}

	//portofolio

	function settings_portofolio(){
		$this->load->view('backend/header_admin');
		$data['query'] = $this->model_backend->front();
		$data['query_porto']=$this->model_backend->query_portos();
		$this->load->view('backend/sidebar_admin',$data);
		$this->load->view('backend/index_porto',$data);
		$this->load->view('backend/footer_admin');

	}
//avatar
	function settings_avatar(){
	    $this->load->view('backend/header_admin');
		$data['query'] = $this->model_backend->front();
		$id_login=$this->uri->segment(3);
		$data_avatar['avatar'] = $this->model_backend->avatar_edit($id_login);
		$this->load->view('backend/sidebar_admin',$data);
		$this->load->view('backend/index_avatar',$data_avatar);
		$this->load->view('backend/footer_static');
	}

	//FRONT

	//front edit form
	function settings_front(){
	    $this->load->view('backend/header_admin');
		$data['query'] = $this->model_backend->front();
		$id_frontend=$this->uri->segment(3);
		$data_front['data_front'] = $this->model_backend->front_edit($id_frontend);
		$this->load->view('backend/sidebar_admin',$data);
		$this->load->view('backend/index_front',$data_front);
		$this->load->view('backend/footer_static');
	}
   //proses edit front
	function update_front(){
		$id_frontend=$this->uri->segment(3);
		$front_array=array(
			'title_skill'=> $this->input->post('title_front'),
			'link_fb'    => $this->input->post('link_fb'),
			'link_twit'  => $this->input->post('link_twit'),
			'link_google'=>	$this->input->post('link_google'));
		$this->model_backend->update_front_data($id_frontend,$front_array);
		redirect('admin_area/settings_front/'.$id_frontend.'  ');

	}

//UPDATE FOOTER

	function update_footer(){
		$id_footer=$this->uri->segment(3);
		$footer_datas=array(
			'notelp'=> $this->input->post('footer_notelp'),
			'email'    => $this->input->post('footer_email'),
			'lokasi'  => $this->input->post('footer_lokasi'),
			'copyright'=>	$this->input->post('footer_copyright'));
		$this->model_backend->update_footer_data($id_footer,$footer_datas);
		redirect('admin_area/settings_footer/'.$id_footer.'  ');

	}

	//FRONT PROFILE

	//front edit front profile
	function settings_front_profile(){
	    $this->load->view('backend/header_admin');
		$data['query'] = $this->model_backend->front();
		$id_profile=$this->uri->segment(3);
		$data_front['data_front'] = $this->model_backend->front_profile_by_id($id_profile);
		$this->load->view('backend/sidebar_admin',$data);
		$this->load->view('backend/index_front_profile',$data_front);
		$this->load->view('backend/footer_static');
	}
   //proses edit front profile
	function update_front_profile(){
		$id_profile=$this->uri->segment(3);
		$front_array2=array(
			'pengenalan'=> $this->input->post('title_hi'),
			'about' => $this->input->post('aboutme'),
			'nama'  => $this->input->post('name'),
			'date'  => $this->input->post('date'),
			'alamat'=> $this->input->post('address'),
			'phone' => $this->input->post('phone'),
			'email' => $this->input->post('email'));
		$this->model_backend->update_front_profile_data($id_profile,$front_array2);
		redirect('admin_area/settings_front_profile/'.$id_profile.'  ');

	}


	//BLOG

	function settings_blog(){

		$this->load->view('backend/header_admin');
		$data['query'] = $this->model_backend->front();
		$data['kategori'] =$this->model_backend->kategori();
		$this->load->view('backend/sidebar_admin',$data);
		$jumlah= $this->model_backend->blog_jumlah();

$config['full_tag_open'] = "<ul class='pagination'>";
$config['full_tag_close'] ="</ul>";
$config['num_tag_open'] = '<li>';
$config['num_tag_close'] = '</li>';
$config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
$config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
$config['next_tag_open'] = "<li>";
$config['next_tagl_close'] = "</li>";
$config['prev_tag_open'] = "<li>";
$config['prev_tagl_close'] = "</li>";
$config['first_tag_open'] = "<li>";
$config['first_tagl_close'] = "</li>";
$config['last_tag_open'] = "<li>";
$config['last_tagl_close'] = "</li>";
		$config['base_url'] = base_url().'admin_area/settings_blog/';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 5; 		//limit nya brpp disini gans
 
	    $dari = $this->uri->segment('3');
		$data['blog'] = $this->model_backend->blog($config['per_page'],$dari);
		$this->pagination->initialize($config); 
		$this->load->view('backend/index_blog',$data);
		$this->load->view('backend/footer_static');
	}

	function settings_category_blog(){

		$this->load->view('backend/header_admin');
		$data['query'] = $this->model_backend->front();
		$data['kategori_list'] =$this->model_backend->kategori_fungsi_list();
		$this->load->view('backend/sidebar_admin',$data);
		$this->load->view('backend/index_category_list',$data);
		$this->load->view('backend/footer_static');

	}

	function delete_blog(){
	$id_blog=$this->uri->segment(3);
	$this->model_backend->delete_blog_fungsi($id_blog);
	redirect('admin_area/settings_category_blog');
}

   function delete_portofolio(){
	$id_porto=$this->uri->segment(3);
	$this->model_backend->delete_porto_fungsi($id_porto);
	redirect('admin_area/settings_portofolio');
   }

   function delete_category_blog(){
   	$id_category=$this->uri->segment(3);
   	$this->model_backend->delete_category_fungsi($id_category);
	redirect('admin_area/settings_category_blog');

   }

   function add_category(){
  	$this->model_backend->add_category_fungsi();

   }
}
?>