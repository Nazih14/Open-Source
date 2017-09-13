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

class M_employees extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'employees';

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
			, x1.nik
			, x1.full_name
			, x2.option AS employment_type
			, x1.gender
			, COALESCE(x1.birth_place, '') birth_place
			, x1.birth_date
			, x1.photo, x1.is_deleted
		");
		$this->db->join('options x2', 'x1.employment_type = x2.id', 'LEFT');
		$this->db->like('x1.nik', $keyword);
		$this->db->or_like('x1.full_name', $keyword);
		$this->db->or_like('x1.gender', $keyword);
		$this->db->or_like('x1.birth_place', $keyword);
		$this->db->or_like('x1.birth_date', $keyword);
		$this->db->or_like('x2.option', $keyword);
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
			->join('options x2', 'x1.employment_type = x2.id', 'LEFT')
			->like('x1.nik', $keyword)
			->or_like('x1.full_name', $keyword)
			->or_like('x1.gender', $keyword)
			->or_like('x1.birth_place', $keyword)
			->or_like('x1.birth_date', $keyword)
			->or_like('x2.option', $keyword)
			->count_all_results(self::$table.' x1');
	}

	/**
	 * More Employees
	 * @param int
	 * @return query
	 */
	public function more_employees($offset = 0) {
		$this->db->select("
			x1.id
		  , x1.nik
		  , x1.full_name
		  , IF(x1.gender = 'M', 'L', 'P') AS gender
		  , x1.birth_place
		  , x1.birth_date
		  , x1.photo
		  , COALESCE(x2.option, '-') AS employment_type
		");
		$this->db->join('options x2', 'x1.employment_type = x2.id', 'LEFT');
		$this->db->where('x1.is_deleted', 'false');
		if ($offset < 0) {
			$this->db->limit(20);
		}
		if ($offset > 0) {
			$this->db->limit(20, $offset);
		}
		$this->db->order_by('x1.full_name', 'ASC');
		return $this->db->get(self::$table.' x1');
	}
}