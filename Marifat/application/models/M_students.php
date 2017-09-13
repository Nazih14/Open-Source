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

class M_students extends CI_Model {

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
		$this->db->select("
			x1.id
			, COALESCE(x1.nis, '') nis
			, COALESCE(x1.nim, '') nim
			, x1.full_name
			, x2.option AS student_status
			, x1.gender
			, COALESCE(x1.birth_place, '') birth_place
			, x1.birth_date
			, x1.photo
			, x1.is_deleted
			");
		$this->db->join('options x2', 'x1.student_status = x2.id', 'LEFT');
		$this->db->where('x1.is_student', 'true');
		$this->db->group_start();
		$this->db->like('x1.nis', $keyword);
		$this->db->or_like('x2.option', $keyword);
		$this->db->or_like('x1.full_name', $keyword);
		$this->db->or_like('x1.gender', $keyword);
		$this->db->or_like('x1.birth_place', $keyword);
		$this->db->or_like('x1.birth_date', $keyword);
		$this->db->group_end();
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get(self::$table. ' x1');
	}

	/**
	 * Get Total row for pagination
	 * @param string
	 * @return int
	 */
	public function total_rows($keyword) {
		return $this->db
			->join('options x2', 'x1.student_status = x2.id', 'LEFT')
			->where('x1.is_student', 'true')
			->group_start()
			->like('x1.nis', $keyword)
			->or_like('x2.option', $keyword)
			->or_like('x1.full_name', $keyword)
			->or_like('x1.gender', $keyword)
			->or_like('x1.birth_place', $keyword)
			->or_like('x1.birth_date', $keyword)
			->group_end()
			->count_all_results('students x1');
	}

	/**
	 * Autocomplete
	 * @param int
	 * @param int
	 * @param string
	 * @return resource
	 */
	public function autocomplete($academic_year_id, $class_group_id, $keyword) {
		$like = '%'.$this->db->escape_like_str($keyword).'%';
		$binding_params = [			
			intval($academic_year_id),
			intval($class_group_id),
			$like,
			$like,
			$like,
			$like
		];
		$query = $this->db->query("
			SELECT x21.* FROM (
			  SELECT x1.id
			    , x1.registration_number
			    , x1.nis
			    , x1.nim
			    , x1.full_name
			    , x1.is_prospective_student
			  FROM students x1
			  WHERE x1.is_student = 'true'
			  UNION
			  SELECT x1.id
			    , x1.registration_number
			    , x1.nis
			    , x1.nim
			    , x1.full_name
			    , x1.is_prospective_student
			  FROM students x1
			  WHERE x1.is_prospective_student = 'true'
			  AND x1.selection_result IS NOT NULL
			  AND x1.selection_result <> 'unapproved'
			) x21
			WHERE x21.id NOT IN (
			  SELECT student_id FROM class_group_settings
			  WHERE academic_year_id = ?
			  AND class_group_id = ?
			)
			AND (
			  x21.registration_number LIKE ?
			  OR x21.nis LIKE ?
			  OR x21.nim LIKE ?
			  OR x21.full_name LIKE ?
			) 
		", $binding_params);
		return $query;
	}

	/**
	 * Get total student by student status
	 */
	public function student_by_student_status() {
		return $this->db->query("
			SELECT x2.`option` AS labels
				, COUNT(*) AS data 
			FROM students x1
			JOIN `options` x2 ON x1.student_status = x2.id
			WHERE x1.is_student = 'true' 
			GROUP BY 1
			ORDER BY 1 ASC
		");
	}

	/**
	 * More Students
	 * @param int
	 * @return query
	 */
	public function more_students($offset = 0, $current_semester_id = 0) {
		$this->db->select("
			x1.id
		  , CONCAT(x3.class, IF((x4.short_name <> ''), CONCAT(' ',x4.short_name),''),IF((x3.sub_class <> ''),CONCAT(' - ',x3.sub_class),'')) AS class_name
		  , x2.nis
		  , x2.nim
		  , x2.full_name
		  , IF(x2.gender = 'M', 'L', 'P') AS gender
		  , COALESCE(x2.birth_place, '') birth_place
		  , x2.birth_date
		  , x2.photo
		");
		$this->db->join('students x2', 'x1.student_id = x2.id', 'LEFT');
		$this->db->join('class_groups x3', 'x1.class_group_id = x3.id', 'LEFT');
		$this->db->join('majors x4', 'x3.major_id = x4.id', 'LEFT');
		$this->db->where('x1.is_deleted', 'false');
		$this->db->where('x1.academic_year_id', $current_semester_id);
		if ($offset < 0) {
			$this->db->limit(20);
		}
		if ($offset > 0) {
			$this->db->limit(20, $offset);
		}
		$this->db->order_by('x3.class', 'ASC');
		$this->db->order_by('x3.major_id', 'ASC');
		$this->db->order_by('x3.sub_class', 'ASC');
		$this->db->order_by('x2.full_name', 'ASC');
		return $this->db->get('class_group_settings x1');
	}
}