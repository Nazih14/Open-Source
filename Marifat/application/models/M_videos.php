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

class M_videos extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'posts';

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
		$this->db->select('id, post_title, post_content, is_deleted');
		$this->db->where('post_type', 'video');
		$this->db->group_start();
		$this->db->like('post_title', $keyword);
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
			->where('post_type', 'video')
			->group_start()
			->like('post_title', $keyword)
			->group_end()			
			->count_all_results(self::$table);
	}

	/**
	 * Get Recent Videos
	 * @return string
	 */
	public function get_recent_video($limit) {
		return $this->db
			->select('post_content')
			->where('post_type', 'video')
			->where('is_deleted', 'false')
			->order_by('created_at', 'DESC')
			->limit($limit)
			->get(self::$table);
	}

	/**
	 * Get All Videos
	 * @return string
	 */
	public function get_videos() {
		return $this->db
			->select('id, post_title, post_content')
			->where('post_type', 'video')
			->where('is_deleted', 'false')
			->order_by('created_at', 'DESC')
			->get(self::$table);
	}
}