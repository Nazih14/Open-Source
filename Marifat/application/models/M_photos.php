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

class M_photos extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'photos';

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
		$this->db->select('x1.id, CONCAT("thumbnail/",x1.photo_name) AS photo_name, x2.album_title, x1.is_deleted');
		$this->db->join('albums x2', 'x1.photo_album_id=x2.id', 'left');
		$this->db->like('x2.album_title', $keyword);
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
			->join('albums x2', 'x1.photo_album_id=x2.id', 'left')
			->like('x2.album_title', $keyword)
			->count_all_results('photos x1');
	}

	/**
	 * @param Int
	 * @return Boolean
	 */
	public function delete_permanently($id) {
		$this->db->trans_start();
		$this->db->where(self::$pk, $id)->delete(self::$table);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * Get Images By ALbum ID
	 * @param 	Int
	 * @return Query
	 */
	public function get_image_by_album_id($id) {
		return $this->db
			->select('photo_name')
			->where('photo_album_id', $id)
			->get(self::$table);
	}
}