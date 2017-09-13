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

class Welcome extends Admin_Controller {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_posts');
		$this->pk = M_posts::$pk;
		$this->table = M_posts::$table;
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = 'SAMBUTAN KEPALA SEKOLAH';
		$this->vars['blog'] = $this->vars['welcome'] = true;
		$this->vars['query'] = $this->m_posts->get_welcome();
		$this->vars['content'] = 'posts/welcome';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Save or Update
	 * @return 	Object 
	 */
	public function save() {
		$response = [];
		if ($this->validation()) {
			$fill_data = $this->fill_data();
			$fill_data['updated_by'] = $this->session->userdata('id');
			$response['action'] = 'update';		
			$response['type'] = $this->m_posts->welcome_update($fill_data) ? 'success' : 'error';
			$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated'; 
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
	 * fill_data
	 */
	private function fill_data() {
		return [
			'post_content' => $this->input->post('post_content'),
			'post_type' => 'welcome'
		];
	}

	/**
	 * Validations Form
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('post_content', 'Sambutan Kepala Sekolah', 'trim|required');
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