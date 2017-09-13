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

class Print_admission_form extends Public_Controller {

	/**
	 * Constructor
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_registrants');
	}

	/**
	 * Index
	 * @access  public
	 */
	public function index() {
		$this->vars['page_title'] = 'Cetak Formulir Penerimaan '. (get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik').' Baru Tahun '.$this->session->userdata('admission_year');
		$this->vars['action'] = 'print_admission_form/process';
		$this->vars['button'] = '<i class="fa fa-file-pdf-o"></i> CETAK FORMULIR';
		$this->vars['onclick'] = 'print_admission_form()';
		$this->vars['content'] = 'themes/'.theme_folder().'/admission-search-form';
		$this->load->view('themes/'.theme_folder().'/index', $this->vars);
	}

	/**
	 * PDF Generated Process 
	 * @access  public
	 */
	public function process() {
		$response = [];
		if ($this->input->post('csrf_token') && $this->token->is_valid_token($this->input->post('csrf_token'))) {
			$birth_date = $this->input->post('birth_date');	
			$registration_number = $this->input->post('registration_number');
			if (is_valid_date($birth_date) && strlen($registration_number) == 10 && ctype_digit((string) $registration_number)) {
				$result = $this->m_registrants->find_registrant($birth_date, $registration_number);
				if (!count($result)) {
					$response['type'] = 'warning';
					$response['message'] = 'Data dengan tanggal lahir '.indo_date($birth_date).' dan nomor pendaftaran '.$registration_number.' tidak ditemukan.';
				} else {
					$file_name = 'formulir-penerimaan-'. (get_school_level() == 5 ? 'mahasiswa' : 'peserta-didik').'-baru-tahun-'.$this->session->userdata('admission_year');
					$file_name .= '-'.$birth_date.'-'.$registration_number.'.pdf';
					if (!file_exists(FCPATH.'media_library/students/'.$file_name)) {
						$this->generating_pdf($result);
					}
					$response['type'] = 'success';
					$response['file_name'] = $file_name;
				}
			} else {
				$response['type'] = 'error';
				$response['message'] = 'Format data yang anda masukan tidak benar.';
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
}