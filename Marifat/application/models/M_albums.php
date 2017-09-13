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

class M_albums extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'albums';

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
		$this->db->select('id, album_title, album_description, album_cover, album_slug, is_deleted');
		$this->db->like('album_title', $keyword);
		$this->db->like('album_description', $keyword);
		$this->db->or_like('album_slug', $keyword);
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get(self::$table);
	}

	/**
	 * Get All Albums
	 * @return Query
	 */
	public function get_albums($limit = 0) {
		$this->db->select('id, album_title, album_description, album_cover, album_slug');
		$this->db->where('is_deleted', 'false');
		$this->db->order_by('created_at', 'DESC');
		if ($limit > 0) {
			$this->db->limit($limit);
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
			->like('album_title', $keyword)
			->like('album_description', $keyword)
			->or_like('album_slug', $keyword)
			->count_all_results(self::$table);
	}

	/**
	 * more_photo
	 * @param int
	 * @return query
	 */
	public function more_photo($offset) {
		$this->db->select('id, album_title, album_description, album_cover, album_slug');
		$this->db->where('is_deleted', 'false');
		if ($offset > 0) {
			$this->db->limit(6, $offset);
		}
		return $this->db->get(self::$table);
	}
}