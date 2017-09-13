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

class M_files extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'files';

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
		$this->db->select('
			x1.id
			, x1.file_title
			, x1.file_name
			, x1.file_type
			, x1.file_size
			, x2.category
			, x1.file_counter
			, x1.file_visibility
			, x1.is_deleted
		');
		$this->db->join('file_categories x2', 'x1.file_category_id = x2.id',  'LEFT');
		$this->db->like('x1.file_title', $keyword);
		$this->db->or_like('x1.file_type', $keyword);
		$this->db->or_like('x1.file_size', $keyword);
		$this->db->or_like('x2.category', $keyword);
		$this->db->or_like('x1.file_visibility', $keyword);
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * Get All Data
	 * @return Query
	 */
	public function get_by_category($slug) {
		$this->db
			->select('x1.id
					, x1.file_title
					, x1.file_name
					, x1.file_type
					, x1.file_size
					, x2.category
					, x1.file_counter
					, x1.file_visibility');
		$this->db->join('file_categories x2', 'x1.file_category_id = x2.id',  'LEFT');
		$this->db->where('x2.slug', $slug);
		$this->db->limit(20);
		if (! $this->auth->is_logged_in()) {
			$this->db->where('x1.file_visibility', 'public');
		}
		return $this->db->get('files x1');
	}

	/**
	 * Get Total row for pagination
	 * @param string
	 * @return int
	 */
	public function total_rows($keyword) {
		$this->db->join('file_categories x2', 'x1.file_category_id = x2.id',  'LEFT');
		if (! $this->auth->is_logged_in()) {
			$this->db->where('x1.file_visibility', 'public');
		}
		$this->db->group_start();
		$this->db->like('x1.file_title', $keyword);
		$this->db->or_like('x1.file_type', $keyword);
		$this->db->or_like('x1.file_size', $keyword);
		$this->db->or_like('x2.category', $keyword);
		$this->db->or_like('x1.file_visibility', $keyword);
		$this->db->group_end();
		return $this->db->count_all_results('files x1');
	}

	/**
	 * more_files
	 * @param int
	 * @return query
	 */
	public function more_files($slug = '', $offset = 0) {
		$this->db
			->select('x1.id
					, x1.file_title
					, x1.file_name
					, x1.file_type
					, x1.file_size
					, x2.category
					, x1.file_counter
					, x1.file_visibility');
		$this->db->join('file_categories x2', 'x1.file_category_id = x2.id',  'LEFT');
		$this->db->where('x1.is_deleted', 'false');
		if ($slug) {
			$this->db->where('x2.slug', $slug);	
		}
		if (! $this->auth->is_logged_in()) {
			$this->db->where('x1.file_visibility', 'public');
		}
		if ($offset < 0) {
			$this->db->limit(20);
		}
		if ($offset > 0) {
			$this->db->limit(20, $offset);
		}
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * count_all_results
	 * @return int
	 */
	public function count_all_results() {
		$this->db->where('is_deleted', 'false');
		if (! $this->auth->is_logged_in()) {
			$this->db->where('file_visibility', 'public');
		}
		return $this->db->count_all_results(self::$table);
	}
}