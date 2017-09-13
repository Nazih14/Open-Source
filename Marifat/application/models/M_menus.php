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

class M_menus extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'menus';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Fungsi untuk menu recursive
	 * @param  Int
	 * @return Array
	 */
	public function parent_menus($parent_id = 0) {
		$menus = [];
		$this->db->where('parent_id', $parent_id);
		$this->db->order_by('position', 'ASC');
		$result = $this->db->get(self::$table);
		foreach ($result->result() as $row) {
			$menus[] = [
				'id' => $row->id,
				'menu_title' => $row->menu_title,
				'child' => $this->parent_menus($row->id),
			];
		}
		return $menus;
	}

	/**
	 * Recursive function for save menu position
	 * @return Void
	 */
	public function update_position($parent_id, $children) {
		$i = 1;
		foreach ($children as $key => $value) {
			$id = $children[$key]['id'];
			$fill_data = [
				'parent_id' => $parent_id,
				'position' => $i
			];
			$this->db->where(self::$pk, $id)->update(self::$table, $fill_data);
			if (isset($children[$key]['children'][0])) {
				$this->update_position($id, $children[$key]['children']);
			}
			$i++;
		}
	}

	/**
	 * Get All Menus
	 * @return Query
	 */
	public function get_all() {
		return $this->db
			->select('id, menu_title, menu_url, menu_type, is_deleted')
			->order_by('parent_id', 'ASC')
			->order_by('position', 'ASC')
			->get(self::$table);
	}

	/**
	 * Check if child exist
	 * @param Int
	 * @return Boolean
	 */
	public function is_child_exist($parent_id) {
		$query = $this->db
			->where('parent_id', $parent_id)
			->count_all_results(self::$table);
		return $query > 0;
	}

	/**
	 * Fungsi untuk menu recursive : TOP Navigasi
	 */
	public function get_parent_menu($parent_id = 0) {
		$menu = [];
		$this->db->select('
			id
			, menu_title
			, menu_url
			, menu_target
			, menu_type
	  	');
		$this->db->from('menus');
		$this->db->where('parent_id', $parent_id);
		$this->db->where('is_deleted', 'false');
		$this->db->order_by('position', 'ASC');
		$this->db->order_by('menu_title', 'ASC');
		$result = $this->db->get();
		foreach ($result->result() as $row) {
			$menu[] = [
				'id' => $row->id,
				'menu_title' => $row->menu_title,
				'menu_url' => $row->menu_url,
				'menu_target' => $row->menu_target,
				'menu_type' => $row->menu_type,
				'child' => $this->get_parent_menu($row->id),
			];
		}
		return $menu;
	}
}