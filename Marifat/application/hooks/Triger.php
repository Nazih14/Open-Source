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

class Triger {
	
	/**
     * The CodeIgniter super object
     *
     * @var object
     * @access private
     */
    private $CI;

	/**
     * Class constructor
     */
    public function __construct() {
		$this->CI = &get_instance();
	}

	/**
     * Set Session Here
     */
	public function index() {
		$this->CI->load->model(['m_settings', 'm_themes', 'm_phases']);
		$settings = [];
		if (! $this->CI->auth->is_logged_in()) {
			$settings = $this->CI->m_settings->get_setting_values('public');
		} else {
			$settings = $this->CI->m_settings->get_setting_values($this->CI->session->userdata('user_type'));
		}
		if (count($settings) > 0) {
			$session_data = [];
			foreach($settings as $key => $value) {
				$sess_value = $value;
				if ($key == 'school_level') {
					$school_level = [1,2,3,4,5];
					if (!in_array($value, $school_level)) {
						$options = $this->CI->model->RowObject('options', 'id', $value);
						$sess_value = substr($options->option, 0, 1); // ex : 1 - SD / Sekolah Dasar <-- ambil digit pertama sebagai kode jenjang sekolah
					}						
				}
				$session_data[$key] = $sess_value;
			}
		}

		// Gelombang Pendaftaran
		$phase = $this->CI->m_phases->get_current_phase();
		if ($phase->num_rows() === 1) {
			$res = $phase->row();
			$session_data['admission_phase_id'] = $res->id;
			$session_data['admission_phase'] = $res->phase;
			$session_data['admission_start_date'] = $res->start_date;
			$session_data['admission_end_date'] = $res->end_date;
		}

		// Set Active Theme
		$session_data['theme'] = $this->CI->m_themes->get_active_themes();
		
		// Set Session Data
		$this->CI->session->set_userdata($session_data);
	}
}