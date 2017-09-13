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

class Lost_password extends Public_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['page_title'] = 'Lost Password';
		$this->vars['content'] = 'users/lost_password';
		$this->load->view('users/index', $this->vars);
	}

	/**
	 * process
	 * @access  public
	 */
	public function process() {
		$response = [];
		if ($this->validation()) {
			$user_email = $this->input->post('email', TRUE);
			$is_exist = $this->model->isValExist('user_email', $user_email, 'users');
			if (! $is_exist) {
				$response['type'] = 'warning';
				$response['message'] = 'Email anda tidak terdaftar pada database kami';
			} else {
				$forgot_password_key = sha1($user_email . uniqid(mt_rand(), true));
				$this->load->model('m_settings');
				$settings = $this->m_settings->mail_server_settings();
				$config['protocol'] = $settings['mail_server_protocol']; 
				$config['smtp_host'] = $settings['mail_server_hostname'];
				$config['smtp_port'] = (int) $settings['mail_server_port'];
				$config['smtp_user'] = $settings['mail_server_username']; 
				$config['smtp_pass'] = $settings['mail_server_password']; 
				$config['mailtype'] = 'html';
				$config['charset'] = 'iso-8859-1';
				$config['wordwrap'] = true;
				$config['newline'] = "\r\n";
				$this->load->library('email', $config);
				$this->email->from($this->session->userdata('email'), $this->session->userdata('school_name'));
				$this->email->to($user_email);
				$this->email->bcc($this->session->userdata('email'));
				$this->email->subject('Permintaan Kata Sandi Baru - '. $this->session->userdata('school_name'));
				$message = "Dear Member " . $this->session->userdata('school_name');
				$message .= "<br><br>";
				$message .= "Silahkan klik tautan berikut untuk melakukan mengubah kata sandi Anda.";
				$message .= "<br>";
				$message .= "<a href=".base_url() . 'reset-password/' . $forgot_password_key.">".base_url() . 'reset-password/' . $forgot_password_key."</a>";
				$message .= "<br><br>";
				$message .= "Abaikan email ini jika Anda tidak mengajukan perubahan kata sandi ini.";
				$message .= "<br>";
				$message .= "Terima Kasih.";
				$message .= "<br><br>";
				$message .= $this->session->userdata('school_name');
				$this->email->message($message);
				if ($this->email->send()) {
					// update users tables
					$this->load->model('m_users');
					$update = $this->m_users->set_forgot_password_key($user_email, $forgot_password_key);
					if ($update) {
						$response['type'] = 'success';
						$response['message'] = 'Tautan untuk mengubah kata sandi sudah kami kirimkan melalui email. Silahkan periksa email Anda.';
					} else {
						$response['type'] = 'warning';
						$response['message'] = 'Terjadi kesalahan dalam proses ubah kata sandi. Silahkan hubungi operator website untuk konfirmasi.';
					}
				} else {
					$response['type'] = 'warning';
					$response['message'] = 'Tautan untuk mengubah kata sandi tidak terkirim. Silahkan kirim email ke ' . $this->session->userdata('email');
				}
			}
		} else {
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
	 * Validations Form
	 * @access  public
	 * @return Bool
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('email', 'Email', 'trim|required|valid_email');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}