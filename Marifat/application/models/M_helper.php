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

class M_helper extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * @param string
	 * @param array
	 * @return Boolean
	 */
	public function insert($table, array $fill_data) {
		$this->db->trans_start();
		$this->db->insert($table, $fill_data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * @param string
	 * @param string
	 * @param string
	 * @param array
	 * @return Boolean
	 */
	public function update($id, $table, array $fill_data) {
		$this->db->trans_start();
		$this->db->where(self::$pk, $id)->update($table, $fill_data);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * @param string
	 * @param string
	 * @param string
	 * @return Boolean
	 */
	public function delete_permanently($key, $value, $table) {
		$this->db->trans_start();
		$this->db->where_in($key, $value)->delete($table);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * @param string
	 * @param string
	 * @param string
	 * @return Boolean
	 */
	public function delete(array $ids, $table) {
		$this->db->trans_start();
		$this->db->where_in(self::$pk, $ids)
			->update($table, [
				'is_deleted' => 'true',
				'deleted_by' => $this->session->userdata('id'),
				'deleted_at' => date('Y-m-d H:i:s')
			]
		);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * @param string
	 * @return Boolean
	 */
	public function truncate($table) {
		$this->db->trans_start();
		$this->db->truncate($table);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	 * @param string
	 * @param string
	 * @param string
	 * @return Boolean
	 */
	public function restore(array $ids, $table) {
		$this->db->trans_start();
		$this->db->where_in(self::$pk, $ids)
			->update($table, [
				'is_deleted' => 'false',
				'restored_by' => $this->session->userdata('id'),
				'restored_at' => date('Y-m-d H:i:s')
			]
		);
		$this->db->trans_complete();
		return $this->db->trans_status();
	}

	/**
	* isValExist
	 * @param string
	 * @param string
	 * @param string
	 * @return Boolean
	 */
	public function isValExist($key, $value, $table) {
		$count = $this->db
			->where($key, $value)
			->count_all_results($table);
		return $count > 0;
	}

	/**
	 * Row Object
	 * @return Object
	 */
	public function RowObject($table, $key, $value) {
		return $this->db
			->where($key, $value)
			->get($table)
			->row();
	}

	/**
	 * Results Object
	 * @return Array of Object
	 */
	public function ResultsObject($table) {
		return $this->db->get($table)->result();
	}

	/**
	 * Row Array
	 * @return Array
	 */
	public function RowArray($table, $key, $value) {
		return $this->db
			->where($key, $value)
			->get($table)
			->row_array();
	}

	/**
	 * Results Array
	 * @return Array of Array
	 */
	public function ResultsArray($table) {
		return $this->db->get($table)->result_array();
	}

	/**
	 * Chek if email exist
	 * @param String
	 * @param String
	 * @param String
	 * @return Boolean
	 */
	public function is_email_exist($field, $value, $table, $id = 0) {
		$this->db->where($field, $value);
		if ($id > 0) {
			if ($table == 'users' && ($this->session->userdata('user_type') == 'employee' || $this->session->userdata('user_type') == 'student')) {
				$this->db->where('profile_id !=', $id);
			} else {
				$this->db->where('id !=', $id);
			}
		}
		return $this->db->count_all_results($table) > 0;
	}

	/**
	 * is_valid_captcha
	 * @param 	String
	 * @return 	Bool
	 */
	public function is_valid_captcha($str) {
		$expiration = time() - 7200; // Two hour limit
		$this->db->where('captcha_time < ', $expiration)->delete('_captcha');
		$sql = 'SELECT COUNT(*) AS count FROM _captcha WHERE word = ? AND ip_address = ? AND captcha_time > ?';
		$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
		$query = $this->db->query($sql, $binds);
		$row = $query->row();
		return $row->count > 0;
	}

	/**
	 * Set Captcha
	 * @return String
	 */
	public function set_captcha() {
		$vals = [
			'word' => random_string('numeric', 5),
			'img_path' => './media_library/captcha/',
			'img_url' => base_url() . 'media_library/captcha/',
			'img_width' => 180,
			'img_height' => 60,
			'expiration' => 7200,
			'colors' => [
				'background' => [255, 255, 255],
				'border' => [0, 0, 0],
				'text' => [0, 0, 0],
				'grid' => [255, 255, 255],
			],
		];
		$cap = create_captcha($vals);
		$data = [
			'captcha_time' => $cap['time'],
			'ip_address' => $this->input->ip_address(),
			'word' => $cap['word']
		];
		$query = $this->db->insert_string('_captcha', $data);
		$this->db->query($query);
		return $cap;
	}

	/**
	 * Clear Expired Session
	 * @return Void
	 */
	public function clear_expired_session() {
		$this->db->query("DELETE FROM `_sessions` WHERE DATE_FORMAT(FROM_UNIXTIME(timestamp), '%Y-%m-%d') < CURRENT_DATE");
	}
}