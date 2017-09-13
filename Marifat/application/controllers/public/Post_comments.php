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

class Post_comments extends Public_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}
	
	/**
	 * save
	 * @access  public
	 */
	public function index() {
		$response = [];
		if ($this->input->post('csrf_token') && $this->token->is_valid_token($this->input->post('csrf_token'))) {
			if ($this->validation()) {
				$fill_data = $this->fill_data();
				$response['action'] = 'save';
				$response['type'] = $this->model->insert('comments', $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'Komentar anda sudah tersimpan.' : 'Komentar anda tidak tersimpan.';
			} else {
				$response['type'] = 'validation_errors';
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
	 * Fill Data
	 * @return Array
	 */
	private function fill_data() {
		$this->load->library('user_agent');
		return [
			'comment_author' => $this->input->post('comment_author', true),
			'comment_email' => $this->input->post('comment_email', true),
			'comment_url' => $this->input->post('comment_url', true),
			'comment_content' => strip_tags($this->input->post('comment_content', true)),
			'comment_type' => 'post',
			'comment_post_id' => $this->input->post('comment_post_id', true),
			'comment_status' => filter_var($this->session->userdata('comment_moderation'), FILTER_VALIDATE_BOOLEAN) ? 'unapproved' : 'approved',
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
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}

	/**
	 * Load More Comments
	 * @access  public
	 * @return Bool
	 */
	public function more_comments() {
		$comment_post_id = (int) $this->input->post('comment_post_id', true);
		$page_number = (int) $this->input->post('page_number', true);
		$offset = ($page_number - 1) * (int) $this->session->userdata('comment_per_page');
		$response = [];
		if ($comment_post_id > 0) {
			$this->load->model('m_post_comments');
			$query = $this->m_post_comments->more_comments($comment_post_id, $offset);
			$rows = [];
			foreach($query->result() as $row) {
				$rows[] = [
					'comment_content' => $row->comment_content,
					'comment_author' => $row->comment_author,
					'comment_url' => $row->comment_url,
					'created_at' => day_name(date('N', strtotime($row->created_at))) . ', '. indo_date($row->created_at),
				];
			}
			$response['comments'] = $rows;
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}