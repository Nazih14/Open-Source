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

class M_themes extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'themes';

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
		$this->db->select('id, theme_name, theme_folder, theme_author, is_active, is_deleted');
		$this->db->like('theme_name', $keyword);
		$this->db->or_like('theme_folder', $keyword);
		$this->db->or_like('theme_author', $keyword);
		$this->db->order_by('theme_name');
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
			->like('theme_name', $keyword)
			->or_like('theme_folder', $keyword)
			->or_like('theme_author', $keyword)
			->count_all_results(self::$table);
	}

	/**
	 * get_active_themes
	 * @return string
	 */
	public function get_active_themes() {
		$query = $this->db
			->select('theme_folder')
			->where('is_active', 'true')
			->limit(1)
			->get(self::$table);
		if ($query->num_rows() === 1) {
			$result = $query->row();
			return $result->theme_folder;
		}
		return 'cosmo';
	}

	/**
	 * Set not active
	 * @param int
	 * @return bool
	 */
	public function set_not_active($id = 0) {
		if ($id > 0) {
			$this->db->where(self::$pk . ' !=', $id);
		}
		return $this->db->update(self::$table, ['is_active' => 'false']);
	}
}