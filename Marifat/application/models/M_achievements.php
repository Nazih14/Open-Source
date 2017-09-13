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

class M_achievements extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'achievements';

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
		$user_type = $this->session->userdata('user_type');
		$this->db->select('id, description, type, level, year, organizer, is_deleted');
		$this->db->group_start();
		$this->db->like('description', $keyword);
		$this->db->or_like('type', $keyword);
		$this->db->or_like('level', $keyword);
		$this->db->or_like('year', $keyword);
		$this->db->or_like('organizer', $keyword);
		$this->db->group_end();
		if ($user_type === 'student') {
			$this->db->where('student_id', $this->session->userdata('profile_id'));
		}
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
		$user_type = $this->session->userdata('user_type');
		$this->db->group_start();
		$this->db->like('description', $keyword);
		$this->db->or_like('type', $keyword);
		$this->db->or_like('level', $keyword);
		$this->db->or_like('year', $keyword);
		$this->db->or_like('organizer', $keyword);
		$this->db->group_end();
		if ($user_type === 'student') {
			$this->db->where('student_id', $this->session->userdata('profile_id'));
		}
		return $this->db->count_all_results(self::$table);;
	}
}