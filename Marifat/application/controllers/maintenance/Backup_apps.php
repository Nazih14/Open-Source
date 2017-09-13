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

class Backup_apps extends Admin_Controller {

	/**
	 * Constructor
	 */
   public function __construct() {
      parent::__construct();
      if ($this->session->userdata('user_type') !== 'super_user')
      	redirect(base_url());
   }

	/**
	 * Backup Apps
	 */
	public function index() {
		$this->load->library('zip');
		$this->zip->read_dir(FCPATH, false);
		$file_name = 'backup-apps-on-'. date("Y-m-d-H-i-s") .'.zip';
		$this->zip->download($filename);
	}
}