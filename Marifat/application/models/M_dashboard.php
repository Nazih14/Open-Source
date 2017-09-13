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

class M_dashboard extends CI_Model {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get Data
	 * @return Query
	 */
	public function widget_box() {
		$query = $this->db->query("
			SELECT (SELECT COUNT(*) FROM comments x1 WHERE x1.comment_type='message') AS messages
			, (SELECT COUNT(*) FROM comments x1 WHERE x1.comment_type='post') AS comments
			, (SELECT COUNT(*) FROM posts x1 WHERE x1.post_type='post') AS posts
			, (SELECT COUNT(*) FROM posts x1 WHERE x1.post_type='page') AS pages
			, (SELECT COUNT(*) FROM post_categories) AS categories
			, (SELECT COUNT(*) FROM tags) AS tags
			, (SELECT COUNT(*) FROM links) AS links
			, (SELECT COUNT(*) FROM quotes) AS quotes
		");
		return $query->row();
	}
}