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

class M_class_group_students extends CI_Model {

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
			, x2.academic_year
			, CONCAT(x3.class, IF((x4.short_name <> ''), CONCAT(' ',x4.short_name),''),IF((x3.sub_class <> ''),CONCAT(' - ',x3.sub_class),'')) AS class_group
			, x5.nis
			, x5.nisn
			, x5.full_name
			, x5.gender	
			, x5.birth_place
			, x5.birth_date
			,	x1.is_deleted
			");
		$this->db->join('academic_years x2', 'x1.academic_year_id = x2.id', 'LEFT');
		$this->db->join('class_groups x3', 'x1.class_group_id = x3.id', 'LEFT');
		$this->db->join('majors x4', 'x3.major_id = x4.id', 'LEFT');
		$this->db->join('students x5', 'x1.student_id = x5.id', 'LEFT');
		$this->db->where('x5.is_student', 'true');
		$this->db->where('x5.is_alumni', 'false');
		$this->db->group_start();
		$this->db->like('x2.academic_year', $keyword);
		$this->db->or_like("CONCAT(x3.class, IF((x4.short_name <> ''), CONCAT(' ',x4.short_name),''),IF((x3.sub_class <> ''),CONCAT(' - ',x3.sub_class),''))", $keyword);
		$this->db->or_like('x5.nis', $keyword);
		$this->db->or_like('x5.nisn', $keyword);
		$this->db->or_like('x5.full_name', $keyword);
		$this->db->or_like('x5.gender', $keyword);
		$this->db->or_like('x5.birth_place', $keyword);
		$this->db->or_like('x5.birth_date', $keyword);
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
		return $this->db
			->join('academic_years x2', 'x1.academic_year_id = x2.id', 'LEFT')
			->join('class_groups x3', 'x1.class_group_id = x3.id', 'LEFT')
			->join('majors x4', 'x3.major_id = x4.id', 'LEFT')
			->join('students x5', 'x1.student_id = x5.id', 'LEFT')
			->where('x5.is_student', 'true')
			->where('x5.is_alumni', 'false')
			->group_start()
			->like('x2.academic_year', $keyword)
			->or_like("CONCAT(x3.class, IF((x4.short_name <> ''), CONCAT(' ',x4.short_name),''),IF((x3.sub_class <> ''),CONCAT(' - ',x3.sub_class),''))", $keyword)
			->or_like('x5.nis', $keyword)
			->or_like('x5.nisn', $keyword)
			->or_like('x5.full_name', $keyword)
			->or_like('x5.gender', $keyword)
			->or_like('x5.birth_place', $keyword)
			->or_like('x5.birth_date', $keyword)
			->group_end()			
			->count_all_results(self::$table.' x1');
	}
}