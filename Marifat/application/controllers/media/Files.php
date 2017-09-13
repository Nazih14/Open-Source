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

class Files extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_files', 'm_file_categories']);
		$this->pk = M_files::$pk;
		$this->table = M_files::$table;
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = 'FILE';
		$this->vars['media'] = $this->vars['files'] = true;
		$this->vars['file_category_dropdown'] = json_encode($this->m_file_categories->dropdown());
		$this->vars['content'] = 'files/read';
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
		$query = $this->m_files->get_where($keyword, $limit, $offset);
		$total_rows = $this->m_files->total_rows($keyword);
		$total_page = $limit > 0 ? ceil($total_rows / $limit) : 1;
		$response = [];
		$response['total_page'] = 0;
		$response['total_rows'] = 0;
		if ($query->num_rows() > 0) {
			$rows = [];
			foreach($query->result() as $row) {
				$rows[] = $row;
			}
			$response = [
				'total_page' => (int) $total_page,
				'total_rows' => (int) $total_rows,
				'rows' => $rows
			];
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
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
		$id = (int) $this->input->post('id', true);
		$response = [];
		if ($this->validation()) {
			$fill_data = $this->fill_data();
			if ($id && $id > 0 && ctype_digit((string) $id)) {
				$fill_data['updated_by'] = $this->session->userdata('id');
				$response['action'] = 'update';		
				$response['type'] = $this->model->update($id, $this->table, $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated'; 
			} else {
				$fill_data['created_at'] = NULL;
				$fill_data['created_by'] = $this->session->userdata('id');
				$response['action'] = 'save';
				$response['type'] = $this->model->insert($this->table, $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'created' : 'not_created';
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
	 * Fill Data
	 * @return Array
	 */
	private function fill_data() {
		return [
			'file_title' => $this->input->post('file_title', true),
			'file_category_id' => $this->input->post('file_category_id', true),
			'file_visibility' => $this->input->post('file_visibility', true)
		];
	}

	/**
	 * Validations Form
	 * @return Boolean
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('file_title', 'URL', 'trim|required');
		$val->set_rules('file_category_id', 'Description', 'trim|required|numeric');
		$val->set_rules('file_visibility', 'Target', 'trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}

	/**
	 * Upload
	 * @return Void
	 */
    public function upload() {
    	$id = (int) $this->input->post('id', true);
    	$response = [];
    	if ($id && $id > 0 && ctype_digit((string) $id)) {
    		$query = $this->model->RowObject($this->table, $this->pk, $id);
    		$file_name = $query->file_name;
			$mimes = [];
			foreach(get_mimes() as $key => $value) {
				array_push($mimes, $key);
			}
			$file_allowed_types = explode(',', $this->session->userdata('file_allowed_types'));
			$allowed_types = [];
			foreach($file_allowed_types as $mime) {
				if(in_array(trim(strtolower($mime)), $mimes)) {
					array_push($allowed_types, trim(strtolower($mime)));
				}
			}
			$config['upload_path'] = './media_library/files/';
			$config['allowed_types'] = count($allowed_types) > 0 ? implode('|', $allowed_types) : '*';
			$config['max_size'] = (int) $this->session->userdata('upload_max_filesize');
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('file')) {
				$response['action'] = 'validation_errors';
				$response['type'] = 'error';
				$response['message'] = $this->upload->display_errors();
			} else {
				$file = $this->upload->data();
				$fill_data = [
					'file_name' => $file['file_name'],
					'file_type' => $file['file_type'],
					'file_path' => $file['file_path'],
					'file_ext' => $file['file_ext'],
					'file_size' => $file['file_size']
				];
				$query = $this->model->update($id, $this->table, $fill_data);
				if ($query) {
					@chmod(FCPATH.'media_library/files/'.$file_name, 0775);
					@unlink(FCPATH.'media_library/files/'.$file_name);
				}
				$response['action'] = 'upload';
				$response['type'] = 'success';
				$response['message'] = 'uploaded';
				$response['full_path'] = $file['full_path'];
			}
    	} else {
    		$response['action'] = 'error';
			$response['type'] = 'error';
			$response['message'] = 'Not initialize ID or ID is not numeric !';
    	}

    	$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}