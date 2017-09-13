<?php
//ULTRA CV BY VERLY ANANDA
//DONATE me : 139 249 6984 a/n elita BCA se ikhlasnya :D for make me keep spirit

//------------------------------------------------//
class Frontend extends CI_Controller{
	function __construct(){
		parent::__construct();
$this->load->helper(array('url'));
		$this->load->library('form_validation');
		 $this->load->library('pagination');
	
	}
	function index(){
	
		$this->load->view('header_frontend');
		$tampil['cv']= $this->model_cv->tampil();
		$tampil['data_footers']=$this->model_cv->data_footer();
		$this->load->view('frontend',$tampil);
		$this->load->view('footer_frontend',$tampil);

	}
	function profile(){
		$this->load->view('header_frontend');
		$tampil['profile']= $this->model_cv->profile();
		$tampil['data_footers']=$this->model_cv->data_footer();
		$this->load->view('profile',$tampil);
		$this->load->view('footer_frontend',$tampil);
	}

	function portofolio(){
		$this->load->view('header_porto');
		$tampil['portos']= $this->model_cv->portos();
		$tampil['data_footers']=$this->model_cv->data_footer();
		$this->load->view('portofolio',$tampil);
		$this->load->view('footer_porto',$tampil);


	}

	function blog(){
		$this->load->view('header_frontend');
		$tampil['data_footers']=$this->model_cv->data_footer();
		$jumlah= $this->model_cv->blog_jumlah();

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
		$config['base_url'] = base_url().'frontend/blog';
		$config['total_rows'] = $jumlah;
		$config['per_page'] = 1; 		//limit nya brpp disini gans
 
	    $dari = $this->uri->segment('3');
		$data['blog'] = $this->model_cv->blog_post($config['per_page'],$dari);
		$data['sidebar']=$this->model_cv->blog_sidebar();
		$this->pagination->initialize($config); 
		$this->load->view('front_blog',$data);
		$this->load->view('front_blog_sidebar',$data);
		$this->load->view('footer_frontend',$tampil);
	}

	function read_more(){
		$id_blog = $this->uri->segment('3');
		$this->load->view('header_frontend');
		$data['readmore']=$this->model_cv->readmore($id_blog);
		$tampil['data_footers']=$this->model_cv->data_footer();
		$data['sidebar']=$this->model_cv->blog_sidebar();
		$this->load->view('front_blog_detail',$data);
		$this->load->view('front_blog_sidebar',$data);
		$this->load->view('footer_frontend',$tampil);

	}
	function blog_category(){
		$this->load->view('header_frontend');
	    $id_kat=$this->uri->segment('3');
	   	$tampil['data_footers']=$this->model_cv->data_footer();
		$jumlahs= $this->model_cv->category_jumlah($id_kat);


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
		$config['uri_segment'] = 4;
		$config['base_url'] = base_url().'index.php/frontend/blog_category/'.$id_kat.'' ;
		$config['total_rows'] = $jumlahs;
		$config['per_page'] = 1; 		//limit nya brpp disini gans
 
	    $dari= $this->uri->segment('4');
		$data['categorys']=$this->model_cv->category($config['per_page'],$dari,$id_kat);
		$data['sidebar']=$this->model_cv->blog_sidebar();
		$this->pagination->initialize($config); 
		$this->load->view('front_blog_category',$data);
		$this->load->view('front_blog_sidebar',$data);
		$this->load->view('footer_frontend',$tampil);
	}

}

	
?>