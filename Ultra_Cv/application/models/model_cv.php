<?php
//ULTRA CV BY VERLY ANANDA
//DONATE me : 139 249 6984 a/n elita BCA se ikhlasnya :D for make me keep spirit

//------------------------------------------------//
class model_cv extends CI_Model{

function tampil(){
		$this->db->select('*');
		$this->db->from('user');
		$this->db->from('frontend');
		return $this->db->get();
}

function profile(){
	 	$this->db->select('*');
	 	$this->db->from('frontend_profile');
	 	return $this->db->get();
}

function portos(){
		$this->db->select('*');
	 	$this->db->from('portofolio');
	 	return $this->db->get();

}

function data_footer(){
		$this->db->select('*');
	 	$this->db->from('frontend_footer');
	 	return $this->db->get();
}


function blog_post($sampai,$dari){
		$this->db->join('category', 'blog.id_category = category.id_category');
		$data = $this->db->get('blog', $sampai, $dari);
		return $data->result();
	}

function blog_jumlah(){
		return $this->db->get('blog')->num_rows();
	}

	function category_jumlah($id_kat){
		$this->db->where('id_category',$id_kat);
		return $this->db->get('blog')->num_rows();
	}

	function blog_sidebar(){
		$this->db->select('*');
		$this->db->from('category');
		return $this->db->get();
	}

	function readmore($id_blog){
		$this->db->select('*');
		$this->db->from('blog');
		$this->db->where('id_blog',$id_blog);
		return $this->db->get();

	}

	function category($sampai,$dari,$id_kat){
	   $this->db->where('id_category',$id_kat);
		$data = $this->db->get('blog',$sampai,$dari);
		return $data->result();
	}



}
?>