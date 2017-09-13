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

class M_settings extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'settings';

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
	public function get_where($keyword, $limit = 0, $offset = 0, $group = 'general') {
		$this->db->select('id, variable, COALESCE(`value`, `default`) AS value, description, is_deleted');
		$this->db->where('group', $group);
		$this->db->group_start();
		$this->db->like('description', $keyword);
		$this->db->or_like('value', $keyword);
		$this->db->group_end()			;
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
	public function total_rows($keyword, $group) {
		return $this->db
			->where('group', $group)
			->group_start()
			->like('description', $keyword)
			->or_like('value', $keyword)
			->group_end()			
			->count_all_results(self::$table);
	}

	/**
	 * Get Setting Values
	 * @param array
	 * @return array
	 */
	public function get_setting_values($group_access = 'public') {
		$query = $this->db
			->select('variable, COALESCE(`value`, `default`) AS `value`')
			->like('group_access', $group_access)
			->get(self::$table);
		$settings = [];
		foreach($query->result() as $row) {
			$settings[$row->variable] = $row->value;
		}
		return $settings;
	}

	/**
	 * mail_server_settings
	 * @return array
	 */
	function mail_server_settings() {
		$query = $this->db
			->select("variable, COALESCE(value, default, '') setting_value")
			->where('group', 'mail_server')
			->get('settings');
		$data = [];
		foreach($query->result() as $row) {
			$data[$row->variable] = $row->setting_value;
		}
		return $data;
	}
}