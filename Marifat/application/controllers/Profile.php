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

class Profile extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * index
	 */
	public function index() {
		$id = null !== $this->session->userdata('id') ? $this->session->userdata('id') : 0;
		$this->vars['title'] = 'Ubah Profil';
		$this->vars['user_profile'] = true;
		$this->vars['query'] = $this->model->RowObject('users', 'id', $id);
		$this->vars['content'] = 'users/profile';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * save
	 * @access  public
	 */
	public function save() {
		$id = null !== $this->session->userdata('id') ? $this->session->userdata('id') : 0;
		$response = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			if ($this->validation()) {
				$fill_data = $this->fill_data();
				$fill_data['updated_by'] = $id;
				$response['type'] = $this->model->update($id, 'users', $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated'; 
			} else {
				$response['action'] = 'validation_errors';
				$response['type'] = 'error';
				$response['message'] = validation_errors();
			}
		} else {
			$response['type'] = 'error';
			$response['message'] = 'not_updated';
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
			'user_full_name' => $this->input->post('user_full_name', true),
			'user_email' => $this->input->post('user_email', true),
			'user_url' => $this->input->post('user_url', true),
			'biography' => $this->input->post('biography', true)
		];
	}

	/**
	 * Validations Form
	 * @access  public
	 * @return Bool
	 */
	private function validation() {
		$id = $this->session->userdata('id');
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('user_full_name', 'Full Name', 'trim|required');
		$val->set_rules('user_email', 'Email', 'trim|required|valid_email|callback_email_check['.$id.']');
		$val->set_rules('user_url', 'URL', 'trim|valid_url');
		$val->set_rules('biography', 'Biography', 'trim');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}