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

class M_class_group_settings extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'class_group_settings';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_options');
	}

	/**
	 * Save
	 * @param int
	 * @param int
	 * @param array
	 * @return bool
	 */
	public function insert($academic_year_id = 0, $class_group_id = 0, $ids = []) {
		$fill_data = [];
		foreach($ids as $id) {
			$is_exist = $this->model->isValExist('id', $id, 'students');
			if ($is_exist && !$this->is_exist($academic_year_id, $class_group_id, $id)) {
				$fill_data[] = [
					'academic_year_id' => $academic_year_id,
					'class_group_id' => $class_group_id,
					'student_id' => $id
				];
				$student_status = $this->m_options->get_options_id('student_status', 'aktif');
				if ($student_status > 0) {
					$this->db
						->where('id', $id)
						->update('students', [
							'student_status' => $student_status,
							'is_student' => 'true'
						]);
				}
			}
		}
		if (count($fill_data) > 0) {
			$this->db->insert_batch(self::$table, $fill_data);	
			return true;
		}
		return false;
	}

	/**
	 * Chek if not exist
	 * @param int
	 * @param int
	 * @param int
	 * @return Bool
	 */
	private function is_exist($academic_year_id = 0, $class_group_id = 0, $student_id = 0) {
		if ($academic_year_id > 0 && $class_group_id > 0 && $student_id > 0) {
			$count = $this->db
				->where('academic_year_id', $academic_year_id)
				->where('class_group_id', $class_group_id)
				->where('student_id', $student_id)
				->count_all_results(self::$table);
			return $count > 0;
		}
		return true;
	}
}