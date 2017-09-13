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

class Change_password extends Admin_Controller {

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
		$this->vars['title'] = 'Ubah Kata Sandi';
		$this->vars['change_password'] = true;
		$this->vars['content'] = 'users/change_password';
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
				$query = $this->model->RowObject('users', 'id', $id);
				if (password_verify($this->input->post('current_password', true), $query->user_password)) {
					$fill_data = $this->fill_data();
					$fill_data['updated_by'] = $id;
					$response['type'] = $this->model->update($id, 'users', $fill_data) ? 'success' : 'error';
					$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated'; 
				} else {
					$response['type'] = 'error';
					$response['message'] = 'not_updated';
				}
			} else {
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
			'user_password' => password_hash($this->input->post('new_password', true), PASSWORD_BCRYPT)
		];
	}

	/**
	 * Validations Form
	 * @access  public
	 * @return Bool
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('current_password', 'Current Password', 'trim|required');
		$val->set_rules('new_password', 'New Password', 'trim|required');
		$val->set_rules('retype_new_password', 'Re-type New Password', 'trim|required|matches[new_password]');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}