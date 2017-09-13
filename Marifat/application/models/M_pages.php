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

class M_pages extends CI_Model {

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
	 * @return Resource
	 */
	public function get_where($keyword, $limit = 0, $offset = 0) {
		$this->db->select('
			x1.id
			, x1.post_title
			, x2.user_full_name AS post_author
			, x1.created_at
			, x1.is_deleted
		');
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'page');
		$this->db->group_start();
		$this->db->like('x1.post_title', $keyword);
		$this->db->or_like('x2.user_full_name', $keyword);
		$this->db->or_like('x1.created_at', $keyword);
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
			->join('users x2', 'x1.post_author = x2.id', 'LEFT')
			->where('x1.post_type', 'page')
			->group_start()
			->like('x1.post_title', $keyword)
			->or_like('x2.user_full_name', $keyword)
			->or_like('x1.created_at', $keyword)
			->group_end()			
			->count_all_results('posts x1');
	}

	public function get_all() {
		return $this->db
			->select('id, post_title')
			->where('post_type', 'page')
			->where('is_deleted', 'false')
			->get(self::$table);
	}

	/**
	 * Get Another Pages
	 * @param 	Int
	 * @access 	public
	 * @return 	Query
	 */
	public function get_another_pages($id) {
		return $this->db
			->select('id, post_title, post_slug')
			->where('post_type', 'page')
			->where('is_deleted', 'false')
			->where(self::$pk.' <>', $id)
			->limit(10)
			->get(self::$table);
	}

	/**
	 * Search
	 * @param String
	 * @return Array
	 */
	public function search($keyword) {
		return $this->db
			->select('id, post_title, post_content, post_slug')
			->like('post_title', $keyword)
			->where('post_type', 'page')
			->where('post_status', 'publish')
			->where('post_visibility', 'public')
			->where('is_deleted', 'false')
			->limit(10)
			->get(self::$table);
	}
}