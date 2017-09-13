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

class M_options extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'options';

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
	public function get_options($group = 'student_status') {
		$query = $this->db
			->select('id, option')
			->where('group', $group)
			->where('is_deleted', 'false')
			->order_by('id', 'ASC')
			->get(self::$table);
		$data = [];
		foreach($query->result() as $row) {
			$data[$row->id] = $row->option;
		}
		return $data;
	}

	/**
	 * Get options id
	 * @param string 
	 * @param string 
	 * @return int
	 */
	public function get_options_id($group = '', $option = '') {
		$query = $this->db
			->select('id')
			->where('group', $group)
			->where('LOWER(`option`)', $option)
			->limit(1)
			->get('options')
			->row();
		return $query->id;
	}
}