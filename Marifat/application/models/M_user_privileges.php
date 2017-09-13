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

class M_user_privileges extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'user_privileges';

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
		$this->db->select('x1.id, x2.group, x3.module_name, x3.module_description, x3.module_url, x1.is_deleted');
		$this->db->join('user_groups x2', 'x1.user_group_id = x2.id', 'LEFT');
		$this->db->join('modules x3', 'x1.module_id = x3.id', 'LEFT');
		$this->db->like('x2.group', $keyword);
		$this->db->or_like('x3.module_name', $keyword);
		$this->db->or_like('x3.module_description', $keyword);
		$this->db->or_like('x3.module_url', $keyword);
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
			->join('user_groups x2', 'x1.user_group_id = x2.id', 'LEFT')
			->join('modules x3', 'x1.module_id = x3.id', 'LEFT')
			->like('x2.group', $keyword)
			->or_like('x3.module_name', $keyword)
			->or_like('x3.module_description', $keyword)
			->or_like('x3.module_url', $keyword)
			->count_all_results('user_privileges x1');
	}

	/**
	 * Module by user group id
	 * @param Int
	 * @param String
	 * @return int
	 */
	public function module_by_user_group_id($user_group_id, $user_type) {		
		$user_privileges = ['dashboard', 'change_password'];
		if ($user_type == 'super_user') {
			array_push($user_privileges, 'maintenance', 'acl', 'admission', 'appearance', 'blog', 'employees', 'media', 'plugins', 'reference', 'settings', 'students', 'profile');
		} else if ($user_type == 'administrator') {
			array_push($user_privileges, 'profile');
			$query = $this->db
				->select('x2.module_url')
				->join('modules x2', 'ON x1.module_id = x2.id', 'LEFT')
				->where('x1.user_group_id', $user_group_id)
				->where('x1.is_deleted', 'false')
				->get('user_privileges x1');
			foreach ($query->result() as $row) {
				array_push($user_privileges, $row->module_url);
			}
		} else if ($user_type == 'employee') {
			array_push($user_privileges, 'employee_profile');
		} else if ($user_type == 'student') {
			array_push($user_privileges, 'student_profile', 'scholarships', 'achievements');	
		}
		return $user_privileges;
	}
}