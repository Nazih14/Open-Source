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

class M_users extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'users';

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
	public function get_where($keyword, $limit = 0, $offset = 0, $user_type = '') {
		if ($user_type == 'student') {
			$this->db->select('
				x1.id
				, x1.user_name
				, x2.full_name
				, x2.email
				, x1.is_deleted
			');
			$this->db->join('students x2', 'x1.profile_id = x2.id', 'LEFT');
			$this->db->where('user_type', 'student');
		}

		if ($user_type == 'employee') {
			$this->db->select('
				x1.id
				, x1.user_name
				, x2.full_name
				, x2.email
				, x1.is_deleted
			');
			$this->db->join('employees x2', 'x1.profile_id = x2.id', 'LEFT');
			$this->db->where('user_type', 'employee');
		}
		
		if ($user_type == 'administrator') {
			$this->db->select('
				x1.id
				, x1.user_name
				, x1.user_full_name
				, x1.user_email
				, x1.user_url
				, x2.group
				, x1.is_deleted
			');
			$this->db->join('user_groups x2', 'x1.user_group_id = x2.id', 'LEFT');
			$this->db->where('user_type', 'administrator');
		}
		
		if ($user_type == 'student' || $user_type == 'employee') {
			$this->db->group_start();
			$this->db->like('x1.user_name', $keyword);
			$this->db->or_like('x2.full_name', $keyword);
			$this->db->or_like('x2.email', $keyword);
			$this->db->group_end();
		}

		if ($user_type == 'administrator') {
			$this->db->group_start();
			$this->db->like('x1.user_name', $keyword);
			$this->db->or_like('x1.user_name', $keyword);
			$this->db->or_like('x1.user_full_name', $keyword);
			$this->db->or_like('x1.user_email', $keyword);
			$this->db->or_like('x1.user_url', $keyword);
			$this->db->or_like('x2.group', $keyword);
			$this->db->group_end();
		}
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
		$this->db->join('user_groups x2', 'x1.user_group_id = x2.id', 'left');
		$user_type = $this->session->userdata('user_type');
		if ($user_type == 'super_user') {
			$this->db->where('user_type !=', 'super_user');
		}
		if ($user_type == 'administrator') {
			$this->db->where_not_in('user_type', ['super_user', 'administrator']);
		}
		$this->db->group_start();
		$this->db->like('x1.user_name', $keyword);
		$this->db->or_like('x1.user_name', $keyword);
		$this->db->or_like('x1.user_full_name', $keyword);
		$this->db->or_like('x1.user_email', $keyword);
		$this->db->or_like('x1.user_url', $keyword);
		$this->db->or_like('x2.group', $keyword);
		$this->db->group_end();
		return $this->db->count_all_results(self::$table. ' x1');
	}

	/**
     * logged_in()
     * @access  public
     * @param   string
     * @return  bool
     */
	public function logged_in($user_name) {
		return $this->db
			->select('id
				, user_name
				, user_password
				, user_full_name
				, user_email
				, user_url
				, user_registered
				, user_group_id
				, user_type
				, profile_id
				, forgot_password_key
				, is_active
				, is_logged_in
				, last_logged_in
				, ip_address
			')
         ->where('user_name', $user_name)
         ->where('is_active', 'true')
         // ->where('is_logged_in', 'false')
         ->limit(1)
         ->get(self::$table);
	}

	/**
     * last_logged_in()
     * @access  public
     * @param   int
     * @return  void
     */
	public function last_logged_in($id) {
		$fields = [
			'last_logged_in' => date('Y-m-d H:i:s'),
			'ip_address' => get_ip_address(),
			'is_logged_in' => 'true'
		];
		$this->db
			->where(self::$pk, $id)
			->update(self::$table, $fields);
	}

	/**
     * reset_logged_in
     * set is_logged_in to false
     * @access  public
     * @param   int
     * @return  void
     */
	public function reset_logged_in($id) {
		$this->db
			->where(self::$pk, $id)
			->update(self::$table, ['is_logged_in' => 'false']);
	}

	/**
     * check_login_attempts
     * @access  public
     * @param   string
     * @return  int
     */
	public function check_login_attempts($ip_address) {
		$query = $this->db
			->where('ip_address', $ip_address)
			->get('login_attempts');
		if ($query->num_rows() === 1) {
			return $query->row();
		}
		return NULL;
	}

	/**
     * increase_login_attempts
     * @access  public
     * @param   string
     * @return  void
     */
	public function increase_login_attempts($ip_address) {
		$query = $this->db
			->where('ip_address', $ip_address)
			->get('login_attempts');
		if ($query->num_rows() === 1) {
			$result = $query->row();
			$this->db
				->where('ip_address', $ip_address)
				->update('login_attempts', ['counter' => ($result->counter + 1), 'datetime' => date('Y-m-d H:i:s')]);
		} else {
			$this->db
				->insert('login_attempts', ['ip_address' => $ip_address, 'counter' => 1, 'datetime' => date('Y-m-d H:i:s')]);
		}
	}

	/**
     * clear_login_attempts
     * @access  public
     * @param   string
     * @return  void
     */
	public function clear_login_attempts($ip_address) {
		$this->db
			->where('ip_address', $ip_address)
			->delete('login_attempts');
	}

	/**
     * get last logged in
     * @access  public
     * @return  query
     */
	public function get_last_logged_in() {
		return $this->db
			->select("
				CASE WHEN x1.user_type = 'administrator' THEN x1.user_full_name
    			WHEN x1.user_type = 'student' THEN x2.full_name
    			WHEN x1.user_type = 'employee' THEN x3.full_name
      		END AS full_name
  				, x1.last_logged_in
			")
			->join('students x2', 'x1.profile_id = x2.id', 'LEFT')
			->join('employees x3', 'x1.profile_id = x3.id', 'LEFT')
			->where('x1.user_type !=', 'super_user')
			->where('x1.last_logged_in IS NOT NULL')
			->order_by('x1.last_logged_in', 'DESC')
			->limit(10)
			->get(self::$table.' x1');
	}

	/**
     * is_user_exist
     * @param 	string
     * @access  public
     * @return  query
     */
	public function is_exist($field, $value) {
		return $this->db
			->where($field, $value)
			->count_all_results(self::$table);
	}

	/**
     * change_user_name
     * @param 	string
     * @access  public
     * @return  Boolean
     */
	public function change_user_name($user_name) {
		return $this->db
			->where('user_name', $this->session->userdata('user_name'))
			->update(self::$table, ['user_name' => $user_name]);
	}

	/**
     * set_forgot_password_key
     * @param 	string
     * @param 	string
     * @access  public
     * @return  Boolean
     */
	public function set_forgot_password_key($user_email, $forgot_password_key) {
		return $this->db
			->where('user_email', $user_email)
			->update(self::$table, ['forgot_password_key' => $forgot_password_key, 'forgot_password_request_date' => date('Y-m-d H:i:s')]);
	}

	/**
     * remove activation key
     * @param 	string
     * @access public
     * @return Boolean
     */
	public function remove_forgot_password_key($id) {
		return $this->db
			->where(self::$pk, $id)
			->update(self::$table, ['forgot_password_key' => null, 'forgot_password_request_date' => null]);
	}

	/**
     * Reset Password
     * @param 	string
     * @access public
     * @return Boolean
     */
	public function reset_password($id, array $fill_data) {
		return $this->db
			->where(self::$pk, $id)
			->update(self::$table, $fill_data);
	}
}