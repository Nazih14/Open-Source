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

class Admission_selection_results extends Public_Controller {

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
		// if isset
		if (null !== $this->session->userdata('announcement_start_date') && null !== $this->session->userdata('announcement_end_date')) {
			// If not in array, redirect
			$date_range = array_date($this->session->userdata('announcement_start_date'), $this->session->userdata('announcement_end_date'));
			if (!in_array(date('Y-m-d'), $date_range)) {
				redirect(base_url());
			}
		}
		$this->vars['page_title'] = 'Hasil Seleksi Penerimaan '. (get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik').' Baru Tahun '.$this->session->userdata('admission_year');
		$this->vars['action'] = 'admission_selection_results/selection_results';
		$this->vars['button'] = '<i class="fa fa-search"></i> LIHAT HASIL SELEKSI';
		$this->vars['onclick'] = 'selection_results()';
		$this->vars['content'] = 'themes/'.theme_folder().'/admission-search-form';
		$this->load->view('themes/'.theme_folder().'/index', $this->vars);
	}

	/**
    * Selection Results
    * @return JSON
    */
   public function selection_results() {
   	$response = [];
   	if ($this->input->post('csrf_token') && $this->token->is_valid_token($this->input->post('csrf_token'))) {
   		$birth_date = $this->input->post('birth_date', true);	
			$registration_number = $this->input->post('registration_number', true);
			if (is_valid_date($birth_date) && strlen($registration_number) == 10 && ctype_digit((string) $registration_number)) {
				$query = $this->m_registrants->selection_result($registration_number, $birth_date);
				$response['type'] = $query['type'];
				$response['message'] = $query['message'];
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