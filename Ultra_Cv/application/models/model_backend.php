<?php
//ULTRA CV BY VERLY ANANDA
//DONATE me : 139 249 6984 a/n elita BCA se ikhlasnya :D for make me keep spirit

//------------------------------------------------//
class model_backend extends CI_Model{

//cek data 
	function cek_data($username,$password){
		$this->db->where('password',$password);
		$this->db->where('username',$username);
		return $this->db->get('user');
		
		}

		// select  //
	function tampil_user(){
		$this->db->select('*');
		$this->db->from('user');
		return $this->db->get();
	}

	function kategori(){
		$this->db->select('*');
		$this->db->from('category');
		return $this->db->get();
	}

	//FUNCTION FRONT

	function front(){ //query mewakili ID 
		$this->db->select('*');
		$this->db->from('user');
		$this->db->from('frontend');
		$this->db->from('frontend_profile');
		$this->db->from('frontend_footer');


		return $this->db->get();
	}


	function query_portos(){
		$this->db->select('*');
		$this->db->from('portofolio');
		return $this->db->get();
	}
	//edit front
	function front_edit($id_frontend){
		$this->db->select('*');
		$this->db->from('frontend');
	    $this->db->where('id_frontend',$id_frontend);
		return $this->db->get();
	}
	//avatar
	function avatar_edit($id_login){
		$this->db->select('*');
		$this->db->from('user');
	    $this->db->where('id_user',$id_login);
		return $this->db->get();

	}
	function update_front_data ($id_frontend,$front_array){
		$this->db->where('id_frontend',$id_frontend);
		return $this->db->update('frontend',$front_array);
	}

	function update_avatar_data($id_user,$ava_arrai){
		$this->db->where('id_user',$id_user);
		return $this->db->update('user',$ava_arrai);

	}

	function update_footer_data($id_footer,$footer_datas){
		$this->db->where('id_footer',$id_footer);
		return $this->db->update('frontend_footer',$footer_datas);

	}

//EDIT FOOTER
function query_footer($id_footer){
		$this->db->select('*');
		$this->db->from('frontend_footer');
	    $this->db->where('id_footer',$id_footer);
		return $this->db->get();

}


	//FUNCTION FRONT_PROFILE

	//edit front
	function front_profile_by_id($id_profile){
		$this->db->select('*');
		$this->db->from('frontend_profile');
	    $this->db->where('id_profile',$id_profile);
		return $this->db->get();
	}
	function update_front_profile_data($id_profile,$front_array2){
		$this->db->where('id_profile',$id_profile);
		return $this->db->update('frontend_profile',$front_array2);
	}

function blog($sampai,$dari){
		$this->db->join('category', 'blog.id_category = category.id_category');
		$data = $this->db->get('blog', $sampai, $dari);
		return $data->result();
	}

		function blog_jumlah(){
		return $this->db->get('blog')->num_rows();
	}


		function delete_blog_fungsi($id_blog)  {
			$this->db->where('id_blog',$id_blog);
			 $query=$this->db->get('blog');
			 $row = $query->row();

			 unlink("./assets/img_blog/$row->img_blog");
			 $this->db->delete('blog', array('id_blog' => $id_blog));

		}

		function delete_porto_fungsi($id_porto)  {
			$this->db->where('id_porto',$id_porto);
			 $query=$this->db->get('portofolio');
			 $row = $query->row();

			 unlink("./assets/img_porto/$row->img_porto");
			 $this->db->delete('portofolio', array('id_porto' => $id_porto));

		
		}

		function delete_category_fungsi($id_category){
		 $this->db->delete('category', array('id_category' => $id_category));


		}

		function kategori_fungsi_list(){
		$this->db->select('*');
		$this->db->from('category');
		return $this->db->get();
		}

		function add_category_fungsi(){
			  $name_category = $this->input->post('name_category');
         

  $this->db->insert('category',array(
          
  						'name_category' => $name_category));

                ///////// END

           redirect ('admin_area/settings_category_blog');

         }
		
}
?>