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

class M_registrants_unapproved extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'students';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get data for pagination
	 * @param string
	 * @param int
	 * @param int
	 * @return Query
	 */
	public function get_where($keyword, $limit = 0, $offset = 0) {
		/*
		1: Elementary School (SD / Sederajat), // SD
		2: Junior High school (SMP / Sederajat), // SMP
		3: Senior High School (SMA / Sederajat), // SMA
		4: Vocational High School (SMK), // SMK
		5: University (Universitas) 
		*/
		$fields = [
			'x1.id'
			, 'x1.registration_number'
			, 'x1.re_registration'
			, 'x1.created_at'
			, 'x1.full_name'
			, 'x1.birth_date'
			, 'x1.gender'
		];
		if (in_array(get_school_level(), have_majors())) {
			array_push($fields, 'x2.major AS selection_result');
		} else {
			array_push($fields, 'x1.selection_result');
		}
		$this->db->select(implode(', ', $fields));
		if (in_array(get_school_level(), have_majors())) {
			$this->db->join('majors x2', 'x1.selection_result = x2.id', 'LEFT');
		}
		$this->db->where('x1.is_alumni', 'false');
		$this->db->where('x1.is_prospective_student', 'true');
		$this->db->where('x1.selection_result', 'unapproved');
		$this->db->where('LEFT(x1.registration_number, 4) = ', $this->session->userdata('admission_year') > 0 ? $this->session->userdata('admission_year') : date('Y'));
		$this->db->group_start();
		$this->db->like('x1.registration_number', $keyword);
		if (in_array(get_school_level(), have_majors())) {
			$this->db->or_like('x2.major', $keyword);
		} else {
			$this->db->or_like('x1.selection_result', $keyword);
		}
		$this->db->or_like('x1.re_registration', $keyword);
		$this->db->or_like('x1.full_name', $keyword);
		$this->db->or_like('x1.gender', $keyword);
		$this->db->or_like('x1.birth_date', $keyword);
		$this->db->or_like('x1.created_at', $keyword);
		$this->db->group_end();		
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * Get Total row for pagination
	 * @param string
	 * @return int
	 */
	public function total_rows($keyword) {
		if (in_array(get_school_level(), have_majors())) {
			$this->db->join('majors x2', 'x1.selection_result = x2.id', 'LEFT');
		}
		$this->db->where('x1.is_alumni', 'false');
		$this->db->where('x1.is_prospective_student', 'true');
		$this->db->where('x1.selection_result', 'unapproved');
		$this->db->where('LEFT(x1.registration_number, 4) = ', $this->session->userdata('admission_year') > 0 ? $this->session->userdata('admission_year') : date('Y'));
		$this->db->group_start();
		$this->db->like('x1.registration_number', $keyword);
		if (in_array(get_school_level(), have_majors())) {
			$this->db->or_like('x2.major', $keyword);
		} else {
			$this->db->or_like('x1.selection_result', $keyword);
		}
		$this->db->or_like('x1.re_registration', $keyword);
		$this->db->or_like('x1.full_name', $keyword);
		$this->db->or_like('x1.gender', $keyword);
		$this->db->or_like('x1.birth_place', $keyword);
		$this->db->or_like('x1.birth_date', $keyword);
		$this->db->or_like('x1.street_address', $keyword);
		$this->db->group_end();		
		$this->db->order_by('x1.registration_number', 'ASC');
		return $this->db->count_all_results('students x1');
	}
}