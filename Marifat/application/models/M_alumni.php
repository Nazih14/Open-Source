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

class M_alumni extends CI_Model {

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
		$this->db->select('id, nis, full_name, gender, street_address, photo, start_date, end_date, is_deleted');
		$this->db->where('is_alumni', 'true');
		$this->db->group_start();
		$this->db->like('nis', $keyword);
		$this->db->or_like('full_name', $keyword);
		$this->db->or_like('gender', $keyword);
		$this->db->or_like('street_address', $keyword);
		$this->db->or_like('start_date', $keyword);
		$this->db->or_like('end_date', $keyword);
		$this->db->group_end();
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get(self::$table);
	}

	/**
	 * Get Total row for pagination
	 * @param string
	 * @return int
	 */
	public function total_rows($keyword) {
		return $this->db
			->where('is_alumni', 'true')
			->group_start()
			->like('nis', $keyword)
			->or_like('full_name', $keyword)
			->or_like('gender', $keyword)
			->or_like('street_address', $keyword)
			->or_like('start_date', $keyword)
			->or_like('end_date', $keyword)
			->group_end()
			->count_all_results(self::$table);
	}

	/**
	 * More Alumni
	 * @param int
	 * @return query
	 */
	public function more_alumni($offset = 0) {
		$this->db->select("id, nis, nim, full_name, IF(gender = 'M', 'L', 'P') AS gender, birth_place, LEFT(start_date, 4) AS start_date, LEFT(end_date, 4) AS end_date, birth_date, photo");
		$this->db->where('is_deleted', 'false');
		$this->db->where('is_alumni', 'true');
		if ($offset < 0) {
			$this->db->limit(20);
		}
		if ($offset > 0) {
			$this->db->limit(20, $offset);
		}
		$this->db->order_by('end_date', 'ASC');
		$this->db->order_by('full_name', 'ASC');
		return $this->db->get(self::$table);
	}
}