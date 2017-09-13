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

class Contact_us extends Public_Controller {

	/**
	 * Constructor
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper(['text', 'captcha', 'string']);
	}

	/**
	 * Index
	 * @access  public
	 */
	public function index() {
		$this->vars['page_title'] = 'Hubungi Kami';
		$this->vars['captcha'] = $this->model->set_captcha();
		$this->vars['latitude'] = null !== $this->session->userdata('latitude') ? $this->session->userdata('latitude') : 0;
		$this->vars['longitude'] = null !== $this->session->userdata('longitude') ? $this->session->userdata('longitude') : 0;
		$this->vars['api_key'] = null !== $this->session->userdata('google_map_api_key') ? $this->session->userdata('google_map_api_key') : 0;
		$this->vars['content'] = 'themes/'.theme_folder().'/contact-us';
		$this->load->view('themes/'.theme_folder().'/index', $this->vars);
	}

	/**
	 * save
	 * @access  public
	 */
	public function save() {
		$response = [];
		if ($this->input->post('csrf_token') && $this->token->is_valid_token($this->input->post('csrf_token'))) {
			if ($this->validation()) {
				$fill_data = $this->fill_data();
				$response['action'] = 'save';
				$response['type'] = $this->model->insert('comments', $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'Pesan anda sudah tersimpan.' : 'Pesan anda tidak tersimpan.';
			} else {
				$response['type'] = 'validation_errors';
				$response['message'] = validation_errors();
				$response['can_logged_in'] = TRUE;
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
	 * Fill Data
	 * @return Array
	 */
	private function fill_data() {
		$this->load->library('user_agent');
		$disallowed = explode(',', $this->session->userdata('comment_blacklist'));
		return [
			'comment_author' => $this->input->post('comment_author', true),
			'comment_email' => $this->input->post('comment_email', true),
			'comment_url' => $this->input->post('comment_url', true),
			'comment_content' => word_censor($this->input->post('comment_content', true), $disallowed, '****'),
			'comment_type' => 'message',
			'comment_ip' => $_SERVER['REMOTE_ADDR'],
			'comment_agent' => $this->agent->agent_string()
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
		$val->set_rules('comment_author', 'Nama Lengkap', 'trim|required');
		$val->set_rules('comment_email', 'Email', 'trim|required|valid_email');
		$val->set_rules('comment_url', 'URL', 'trim|valid_url');
		$val->set_rules('comment_content', 'Pesan', 'trim|required');
		$val->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');
		$val->set_message('required', '{field} harus diisi');
		$val->set_message('valid_email', '{field} harus diisi dengan format email yang benar');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}