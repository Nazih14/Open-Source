<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CMS Sekolahku | CMS (Content Management System) dan PPDB/PMB Online GRATIS 
 * untuk sekolah SD/Sederajat, SMP/Sederajat, SMA/Sederajat, dan Perguruan Tinggi
 * @version    2.1.0
 * @author     Anton Sofyan | https://facebook.com/antonsofyan | 4ntonsofyan@gmail.com | 0857 5988 8922
 * @copyright  (c) 2014-2017
 * @link       http://sekolahku.web.id
 * @since      Version 2.1.0
 *
 * PERINGATAN :
 * 1. TIDAK DIPERKENANKAN MEMPERJUALBELIKAN APLIKASI INI TANPA SEIZIN DARI PIHAK PENGEMBANG APLIKASI.
 * 2. TIDAK DIPERKENANKAN MENGHAPUS KODE SUMBER APLIKASI.
 * 3. TIDAK MENYERTAKAN LINK KOMERSIL (JASA LAYANAN HOSTING DAN DOMAIN) YANG MENGUNTUNGKAN SEPIHAK.
 */

class Posts extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_posts', 'm_post_categories']);
		$this->pk = M_posts::$pk;
		$this->table = M_posts::$table;
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = 'TULISAN';
		$this->vars['blog'] = $this->vars['posts'] = $this->vars['all_posts'] = true;
		$this->vars['content'] = 'posts/read';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Add new
	 */
	public function create() {
		$this->load->helper('form');
		$id = $this->uri->segment(4);
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$this->vars['query'] = $this->model->RowObject($this->table, $this->pk, $id);
			$post_image = 'media_library/posts/medium/'.$this->vars['query']->post_image;
			$this->vars['post_image'] = file_exists(FCPATH . $post_image) ? base_url($post_image) : '';
		} else {
			$this->vars['query'] = false;
		}
		$this->vars['option_categories'] = $this->m_post_categories->get_all();
		$this->vars['title'] = $id && is_int(intval($id)) ? 'Edit Tulisan' : 'Tambah Tulisan';
		$this->vars['blog'] = $this->vars['posts'] = $this->vars['post_create'] = true;
		$this->vars['action'] = site_url('blog/posts/save/'.$id);
		$this->vars['content'] = 'posts/create';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Pagination
	 */
	public function pagination() {
		$page_number = (int) $this->input->post('page_number', true);
		$limit = (int) $this->input->post('per_page', true);
		$keyword = trim($this->input->post('keyword', true));
		$offset = ($page_number * $limit);
		$query = $this->m_posts->get_where($keyword, $limit, $offset);
		$total_rows = $this->m_posts->total_rows($keyword);
		$total_page = $limit > 0 ? ceil($total_rows / $limit) : 1;
		if ($query->num_rows() > 0) {
			$rows = [];
			foreach($query->result() as $row) {
				$rows[] = $row;
			}
			$data = [
				'total_page' => intval($total_page),
				'total_rows' => intval($total_rows),
				'rows' 		 => $rows
			];
		} else {
			$data = [
				'total_page' => 0,
				'total_rows' => 0
			];
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	 * find_id
	 * @param 	int $id
	 * @return 	Object 
	 */
	public function find_id() {
		$id = (int) $this->input->post('id', true);
		$query = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$query = $this->model->RowObject($this->table, $this->pk, $id);
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($query, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	/**
	 * Save or Update
	 * @return 	Object 
	 */
	public function save() {
		$id = (int) $this->uri->segment(4);
		$response = [];
		if ($this->validation()) {
			$fill_data = $this->fill_data();
			$error_msg = [];
			if (!empty($_FILES['post_image'])) {
				$upload = $this->post_image_upload_handler($id);
				if ($upload['type'] == 'success') {
					$fill_data['post_image'] = $upload['file_name'];
				} else {
					$error_msg = $upload['message'];
				}
			}
			if (count($error_msg) > 0) {
				$response['action'] = 'error';
				$response['type'] = 'error';
				$response['message'] = $error_msg;
			} else {
				if ($id == 0) {
					$fill_data['created_at'] = NULL;
					$fill_data['created_by'] = $this->session->userdata('id');
					$response['action'] = 'save';
					$response['type'] = $this->model->insert($this->table, $fill_data) ? 'success' : 'error';
					$response['message'] = $response['type'] == 'success' ? 'created' : 'not_created';
				} else {
					$fill_data['updated_by'] = $this->session->userdata('id');
					unset($fill_data['post_author']);
					$response['action'] = 'update';		
					$response['type'] = $this->model->update($id, $this->table, $fill_data) ? 'success' : 'error';
					$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated'; 
				}
				// Create tags from posts
				$this->load->model('m_tags');
				$this->m_tags->create($fill_data['post_tags']);
			}
		} else {
			$response['action'] = 'validation_errors';
			$response['type'] = 'error';
			$response['message'] = validation_errors();
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	 * Save published date
	 * @return 	Object 
	 */
	public function save_published_date() {
		$id = (int) $this->input->post('id', true);
		$response = [];
		$fill_data = [
			'created_at' => $this->input->post('created_at', true)
		];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$fill_data['updated_by'] = $this->session->userdata('id');
			$response['action'] = 'update';		
			$response['type'] = $this->model->update($id, $this->table, $fill_data) ? 'success' : 'error';
			$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated'; 
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	 * fill_data
	 */
	private function fill_data() {
		return [
			'post_title' => $this->input->post('post_title', true),
			'post_content' => $this->input->post('post_content'),
			'post_author' => $this->session->userdata('id'),
			'post_categories' => $this->input->post('post_categories', true),
			'post_type' => 'post',
			'post_status' => $this->input->post('post_status', true),
			'post_visibility' => $this->input->post('post_visibility', true),
			'post_comment_status' => $this->input->post('post_comment_status', true),
			'post_slug' => url_title(strtolower($this->input->post('post_title', true)), '-'),
			'post_tags' => strtolower($this->input->post('post_tags', true))
		];
	}

	/**
	 * Validations Form
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('post_title', 'Title', 'trim|required');
		$val->set_rules('post_content', 'Content', 'trim|required');
		$val->set_rules('post_status', 'Status', 'trim|required|in_list[publish,draft]');
		$val->set_rules('post_visibility', 'Visibilitas', 'trim|required|in_list[public,private]');
		$val->set_rules('post_comment_status', 'Komentar', 'trim|required|in_list[open,close]');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}

	/**
	 * Insert image in tinyMCE Editor
	 */
	public function tinymce_upload() {
		$this->tinymce_upload_handler();
	}
}