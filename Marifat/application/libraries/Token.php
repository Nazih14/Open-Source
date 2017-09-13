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

class Token {

	/**
	 * @var object
	 * @access private
	 */
    private $CI;

	/**
	 * @var token
	 * @access private
	 */
	private $token;
     
	/**
	 * @var old token
	 * @access private
	 */
	private $old_token;

	/**
	 * Class constructor
	 * @access public
	 */
	public function __construct() {
		$this->CI = &get_instance();
		if (null !== $this->CI->session->userdata('token')) {
			$this->old_token = $this->CI->session->userdata('token');
		}
	}

	/**
	 * Set Token
	 * @access private
	 * @return string
	 */
	private function set_token() {
		$ip = $_SERVER['REMOTE_ADDR'];
		$uniqid = uniqid(mt_rand(), true);
		return md5($ip . $uniqid);
	}

	/**
	 * Get Token
	 * @access public
	 * @return string
	 */
	public function get_token() {
		$this->token = $this->set_token();
		$this->CI->session->set_userdata('token', $this->token);
		return $this->token;
	}

	/**
	 * Token validated
	 * @access public
	 * @return bool
	 */
	public function  is_valid_token($token) {
		return $token === $this->old_token;
	}
}