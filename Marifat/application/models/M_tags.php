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

class M_tags extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'tags';

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
		$this->db->select('id, tag, slug, is_deleted');
		$this->db->like('tag', $keyword);
		$this->db->or_like('slug', $keyword);
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
			->like('tag', $keyword)
			->or_like('slug', $keyword)
			->count_all_results(self::$table);
	}

	/**
	 * Create Tag from posts
	 * @param string
	 * @return Void
	 */
	public function create($str) {
		$tags = explode(',', $str);
		foreach ($tags as $tag) {
			$count = $this->db
				->where('tag', trim($tag))
				->count_all_results(self::$table);
			if ($count == 0 && trim($tag) != '') {
				$data = [
					'tag' => trim($tag),
					'slug' => url_title(trim($tag))
				];
				$this->db->insert(self::$table, $data);
			}
		}
	}

	/**
	 * Get All Tags
	 * @access public
	 * @return Query
	 */
	public function get_tags() {
		return $this->db
			->select('id, tag, slug')
			->where('is_deleted', 'false')
			->get(self::$table);
	}
}