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

class Subscriber extends Public_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_subscribers');
	}
		
	/**
	 * Save or Update
	 * @return 	Object 
	 */
	public function save() {
		$response = [];
		if ($this->input->post('csrf_token') && $this->token->is_valid_token($this->input->post('csrf_token'))) {
			if ($this->validation()) {
				$email = $this->input->post('subscriber', true);
				$response['type'] = $this->m_subscribers->save($email) ? 'success' : 'info';
				$response['message'] = $response['type'] == 'success' ? 'Email anda sudah tersimpan' : 'Email anda sudah terdaftar dalam database kami.';
			} else {
				$response['type'] = 'error';
				$response['message'] = validation_errors();
			}
			$response['csrf_token'] = $this->token->get_token();
		} else {
			$response['type'] = 'token_error';
		}
		
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	/**
	 * Validations Form
	 * @return Boolean
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('subscriber', 'Email', 'trim|required|valid_email');
		$val->set_message('valid_email', 'Masukan email dengan format yang benar');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}