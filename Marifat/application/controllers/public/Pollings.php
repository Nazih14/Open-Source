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

class Pollings extends Public_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_pollings');
	}
		
	/**
	 * Save or Update
	 * @return 	Object 
	 */
	public function save() {
		$response = [];
		if ($this->input->post('csrf_token') && $this->token->is_valid_token($this->input->post('csrf_token'))) {
			if ($this->validation()) {
				$answer_id = $this->input->post('answer_id', true);
				$response['type'] = $this->m_pollings->save($answer_id) ? 'success' : 'info';
				$response['message'] = $response['type'] == 'success' ? 'Terima kasih sudah mengikuti polling kami.' : 'Anda sudah mengikuti polling kami hari ini.';
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
		$val->set_rules('answer_id', 'Jawaban', 'trim|required|numeric');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}

	/**
	 * Eesult
	 */
	public function result() {
		$this->vars['title'] = 'Hasil Jajak Pendapat';
		$query = get_active_question();
		$results = $this->m_pollings->polling_result($query->id);
		$labels = [];
		$data = [];
		foreach($results->result() as $row) {
			array_push($labels, $row->labels);
			array_push($data, $row->data);
		}
		$this->vars['labels'] = json_encode($labels);
		$this->vars['data'] = json_encode($data);
		$this->vars['question'] = $query->question;
		$this->vars['content'] = 'themes/'.theme_folder().'/polling-result';
		$this->load->view('themes/'.theme_folder().'/index', $this->vars);
	}
}