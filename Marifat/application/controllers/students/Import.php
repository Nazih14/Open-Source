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

class Import extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_students', 'm_options']);
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = 'IMPORT PESERTA DIDIK';
		$this->vars['students'] = $this->vars['import_students'] = true;
		$this->vars['content'] = 'students/import';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Save
	 */
	public function save() {
		$rows	= explode("\n", $this->input->post('students'));
		$success = 0;
		$failed = 0;
		$exist = 0;
		$school_level = get_school_level();
		foreach($rows as $row) {
			$exp = explode("\t", $row);
			if (count($exp) != 4) continue;
			$key = 'nis';
			if ($school_level == 5) {
				$key = 'nim';
			}
			$fields = [];
			$fields[$key] = trim($exp[0]);
			$fields['full_name'] = trim($exp[1]);
			$fields['gender'] = trim($exp[2]);
			$fields['street_address'] = trim($exp[3]);
			$fields['is_transfer'] = 'false';
			$fields['is_prospective_student'] = 'false';
			$fields['is_alumni'] = 'false';
			$fields['is_student'] = 'true';
			$fields['selection_result'] = 'approved';
			$fields['citizenship'] = 'WNI';
			$fields['email'] = trim($exp[0]).'@'.str_replace(['http://www.', 'https://www.', 'http://', 'https://'], '', rtrim($this->session->userdata('website'), '/'));
			$fields['student_status'] = $this->m_options->get_options_id('student_status', 'aktif');
			$is_exist = $this->model->isValExist($key, trim($exp[0]), 'students');
			if (!$is_exist) {
				$this->model->insert('students', $fields) ? $success++ : $failed++;
			} else {
				$exist++;
			}
		}
		$response = [];
		$response['type'] = 'info';
		$response['message'] = 'Success : ' . $success. ' rows, Failed : '. $failed .', Exist : ' . $exist;
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}