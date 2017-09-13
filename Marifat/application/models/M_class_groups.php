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

class M_class_groups extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'class_groups';

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
		$this->db->select("
			x1.id
			, CONCAT(x1.class, IF((x2.short_name <> ''), CONCAT(' ',x2.short_name),''),IF((x1.sub_class <> ''),CONCAT(' - ',x1.sub_class),'')) AS class_group
			, x1.is_deleted
		");
		$this->db->join('majors x2', 'x1.major_id = x2.id', 'LEFT');
		$this->db->like("CONCAT(x1.class, IF((x2.short_name <> ''), CONCAT(' ',x2.short_name),''),IF((x1.sub_class <> ''),CONCAT(' - ',x1.sub_class),''))", $keyword);
		$this->db->order_by('x1.class', 'ASC');
		$this->db->order_by('x1.sub_class', 'ASC');
		$this->db->order_by('x1.major_id', 'ASC');
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
			->join('majors x2', 'x1.major_id = x2.id', 'LEFT')
			->like("CONCAT(x1.class, IF((x2.short_name <> ''), CONCAT(' ',x2.short_name),''),IF((x1.sub_class <> ''),CONCAT(' - ',x1.sub_class),''))", $keyword)
			->count_all_results('class_groups x1');
	}

	/**
	 * Dropdown
	 * @return Array
	 */
	public function dropdown() {
		$query = $this->db
			->select("x1.id, CONCAT(x1.class, IF((x2.short_name <> ''), CONCAT(' ',x2.short_name),''),IF((x1.sub_class <> ''),CONCAT(' - ',x1.sub_class),'')) AS class_group")
			->join('majors x2', 'x1.major_id = x2.id', 'LEFT')
			->where('x1.is_deleted', 'false')
			->order_by('class_group', 'ASC')
			->get('class_groups x1');
		$data = [];
		if ($query->num_rows() > 0) {
			foreach($query->result() as $row) {
				$data[$row->id] = $row->class_group;
			}
		}
		return $data;
	}
}