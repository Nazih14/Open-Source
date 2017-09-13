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

class M_registrants extends CI_Model {

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
	 * @access 	public
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
			"x1.id"
			, "x1.registration_number"
			, "x1.re_registration"
			, "x1.created_at"
			, "x1.full_name"
			, "x1.birth_date"
			, "IF(x1.gender = 'M', 'L', 'P') AS gender"
			, "x1.photo"
			, "x1.is_deleted"
		];
		if (in_array(get_school_level(), have_majors())) {
			array_push($fields, 'x2.major AS first_choice');
			array_push($fields, 'x3.major AS second_choice');
		}
		$this->db->select(implode(', ', $fields));
		if (in_array(get_school_level(), have_majors())) {
			$this->db->join('majors x2', 'x1.first_choice = x2.id', 'LEFT');
			$this->db->join('majors x3', 'x1.second_choice = x3.id', 'LEFT');
		}
		$this->db->where('x1.is_prospective_student', 'true');
		$this->db->where('LEFT(x1.registration_number, 4) = ', ($this->session->userdata('admission_year') > 0 ? $this->session->userdata('admission_year') : date('Y')));
		$this->db->group_start();
		$this->db->like('x1.registration_number', $keyword);
		$this->db->or_like('x1.re_registration', $keyword);
		$this->db->or_like('x1.created_at', $keyword);
		if (in_array(get_school_level(), have_majors())) {
			$this->db->or_like('x2.major', $keyword);
			$this->db->or_like('x3.major', $keyword);
		}		
		$this->db->or_like('x1.full_name', $keyword);
		$this->db->or_like('x1.gender', $keyword);
		$this->db->group_end();
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * Get Total row for pagination
	 * @access 	public
	 * @param string
	 * @return int
	 */
	public function total_rows($keyword) {
		if (in_array(get_school_level(), have_majors())) {
			$this->db->join('majors x2', 'x1.first_choice = x2.id', 'LEFT');
			$this->db->join('majors x3', 'x1.second_choice = x3.id', 'LEFT');
		}
		$this->db->where('x1.is_prospective_student', 'true');
		$this->db->where('LEFT(x1.registration_number, 4) = ', ($this->session->userdata('admission_year') > 0 ? $this->session->userdata('admission_year') : date('Y')));
		$this->db->group_start();
		$this->db->like('x1.registration_number', $keyword);
		$this->db->or_like('x1.re_registration', $keyword);
		$this->db->or_like('x1.full_name', $keyword);
		if (in_array(get_school_level(), have_majors())) {
			$this->db->or_like('x2.major', $keyword);
			$this->db->or_like('x3.major', $keyword);
		}		
		$this->db->or_like('x1.gender', $keyword);
		$this->db->or_like('x1.birth_place', $keyword);
		$this->db->or_like('x1.birth_date', $keyword);
		$this->db->or_like('x1.street_address', $keyword);
		$this->db->group_end();
		return $this->db->count_all_results('students x1');
	}

	/**
	 * Autocomplete
	 * @access 	public
	  * @return Query
	 */
	public function autocomplete($keyword, $action_type = 'reregistration') {
		$fields = ['x1.id', 'x1.registration_number', 'x1.full_name'];
		if (in_array(get_school_level(), have_majors())) {
			array_push($fields, 'x2.major AS first_choice', 'x3.major AS second_choice');
		}
		$this->db->select(implode(', ', $fields));
		// If SMK or PT
		if (in_array(get_school_level(), have_majors())) {
			$this->db->join('majors x2', 'x1.first_choice = x2.id', 'LEFT');
			$this->db->join('majors x3', 'x1.second_choice = x3.id', 'LEFT');
		}
		$this->db->where('x1.is_deleted', 'false');
		$this->db->where('x1.is_prospective_student', 'true');

		// Get For Reregistration process
		if ($action_type == 'reregistration') {
			$this->db->where('COALESCE(x1.re_registration, "") !=', 'true');	
		}

		// Get For Selection Process
		if ($action_type == 'selection_process') {
			$this->db->where('x1.re_registration', 'true');
			$this->db->where('x1.selection_result IS NULL');	
		}
				
		$this->db->where('LEFT(x1.registration_number, 4) = ', ($this->session->userdata('admission_year') > 0 ? $this->session->userdata('admission_year') : date('Y')));
		$this->db->group_start();
		$this->db->like('x1.registration_number', $keyword);
		$this->db->or_like('x1.full_name', $keyword);
		$this->db->group_end();
		return $this->db->get('students x1');
	}

	/**
	 * insert
	 * @access 	public
	 * @param int
	 * @param array
	 * @return bool
	 */
	public function insert($selection_result, array $registration_number = []) {
		$approved = 0;
		$unapproved = 0;
		$error = 0;
		foreach($registration_number as $reg_number) {
			if ($selection_result != 'unapproved') {
				if ($this->check_quota($reg_number)) {
					$query = $this->db
						->where('registration_number', $reg_number)
						->update(self::$table, ['selection_result' => $selection_result]);
					$query ? $approved++ : $error++;
				} else {
					$unapproved++;	
				}
			} else {
				$query = $this->db
					->where('registration_number', $reg_number)
					->update(self::$table, ['selection_result' => $selection_result]);
				$query ? $approved++ : $error++;
			}
		}
		$response = 'Sukses : '.$approved. ' SQL Error : '. $error.', Gagal : ' . $unapproved;
		return $response;
	}

	/**
	 * check_quota
	 * @access 	private
	 * @param string
	 * @return bool
	 */
	private function check_quota($registration_number) {
		// Get First Choice
		if (in_array(get_school_level(), have_majors())) {
			$student = $this->db
				->select('first_choice')
				->where('registration_number', $registration_number)
				->get('students')
				->row();
		}

		// Set Default Quota
		$quota = 0;
		// Get Quota
		$this->db->select('quota');
		$this->db->where('year', intval($this->session->userdata('admission_year')));
		// If SMK or PT
		if (in_array(get_school_level(), have_majors())) {
			$this->db->where('major_id', $student->first_choice);
		}
		$this->db->limit(1);
		$query = $this->db->get('registration_quotas');
		if ($query->num_rows() === 1) {
			$result = $query->row();
			$quota = $result->quota;
		}		

		// Get Approved Students
		$approved = $this->db
			->where('is_prospective_student', 'true')
			->where('selection_result IS NOT NULL')
			->where('selection_result !=', 'unapproved')
			->where('LEFT(registration_number, 4) = ', $this->session->userdata('admission_year') > 0 ? $this->session->userdata('admission_year') : date('Y'))
			->count_all_results('students');

		return $quota > $approved;
	}

	/**
	 * Generate Registration Number
	 * @access 	public
	 * @return 	Bool
	 */
	public function registration_number() {
		$year = $this->session->userdata('admission_year');
		$query = $this->db->query("
			SELECT MAX(RIGHT(registration_number, 6)) AS max_number
			FROM students
			WHERE is_prospective_student='true'
			AND LEFT(registration_number, 4) = ?
		", [$year]);

		$registration_number = "";
		if ($query->num_rows() === 1) {
			$data = $query->row();
			$number = ((int) $data->max_number) + 1;
			$registration_number = sprintf("%06s", $number);
		} else {
			$registration_number = "00001";
		}
		return $year . $registration_number;
	}

	/**
	 * Selection Result
	 * @access 	public
	 * @param 	string
	 * @param 	string
	 * @return 	array
	 */
	public function selection_result($registration_number, $birth_date) {
		// '1': 'Sekolah Dasar (SD / Sederajat)',
		// '2': 'Sekolah Menengah Pertama (SMP / Sederajat)',
		// '3': 'Sekolah Menengah Atas (SMA / Sederajat)',
		// '4': 'Sekolah MenengahKejuruan (SMK)',
		// '5': 'Akademi / Sekolah Tinggi / Universitas'	
		$response = [];
		$query = $this->db
			->where('registration_number', $registration_number)
			->where('birth_date', $birth_date)
			->get(self::$table);
		if ($query->num_rows() === 1) {
			$result = $query->row();
			if (is_null($result->selection_result)) {
				$response['type'] = 'info';
				$response['message'] = 'Proses seleksi belum dimulai';
			} else {
				if (in_array(get_school_level(), have_majors())) {
					if ($result->selection_result === 'unapprove') {
						$response['type'] = 'warning';
						$response['message'] = 'Anda Tidak Lolos Seleksi Penerimaan Peserta Didik Baru '.$this->session->userdata('school_name');
					} else {
						$majors = $this->model->RowObject('majors', 'id', $result->selection_result);
						$response['type'] = 'success';
						$response['message'] = 'Anda diterima di ' . $majors->major . ' ' . $this->session->userdata('school_name');
					}
				} else {
					if ($result->selection_result === 'unapprove') {
						$response['type'] = 'warning';
						$response['message'] = 'Anda Tidak Lolos Seleksi Penerimaan Peserta Didik Baru '.$this->session->userdata('school_name');
					} else {
						$response['type'] = 'success';
						$response['message'] = 'Anda Lolos Seleksi Penerimaan Peserta Didik Baru '.$this->session->userdata('school_name');
					}
				}
			}
		} else {
			$response['type'] = 'warning';
			$response['message'] = 'Data Anda tidak terdaftar pada database kami';
		}

		return $response;
	}

	/**
	 * Find Registrant
	 * @access 	public
	 * @param 	string
	 * @return 	array
	 */
	public function find_registrant($birth_date, $registration_number) {
		$this->db->select("
			x1.id
		  , IF(x1.is_transfer='true', 'Pindahan', 'Baru') AS is_transfer
		  , x1.registration_number
		  , x1.created_at
		  , x2.major AS first_choice
		  , x3.major AS second_choice
		  , x1.full_name
		  , IF(x1.gender = 'M', 'L', 'P') AS gender
		  , x1.nisn
		  , x1.nik
		  , x1.birth_place
		  , x1.birth_date
		  , x4.option AS religion
		  , x5.option AS special_needs
		  , x1.street_address
		  , x1.rt
		  , x1.rw
		  , x1.sub_district
		  , x1.district
		  , x1.sub_village
		  , x1.village
		  , x1.postal_code
		  , x1.email
		");
		$this->db->join('majors x2', 'x1.first_choice = x2.id', 'LEFT');
		$this->db->join('majors x3', 'x1.second_choice = x3.id', 'LEFT');
		$this->db->join('options x4', 'x1.religion = x4.id', 'LEFT');
		$this->db->join('options x5', 'x1.special_needs = x5.id', 'LEFT');
		$this->db->where('x1.birth_date', $birth_date);
		$this->db->where('x1.registration_number', $registration_number);
		return $this->db->get('students x1')->row_array();
	}

	/**
	 * Is Valid Registrant
	 * @access 	public
	 * @param 	string
	 * @param 	string
	 * @return 	bool
	 */
	public function is_valid_registrant($registration_number, $birth_date) {
		$this->db->where('registration_number', $registration_number);
		$this->db->where('birth_date', $birth_date);
		$count = $this->db->count_all_results(self::$table);
		return $count > 0;
	}
}