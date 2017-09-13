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

class Public_Controller extends MY_Controller {

	/**
	 * General Variable
	 * @var Array
	 */
	protected $vars = [];
	
	/**
	 * constructor
	 */
	public function __construct() {
		parent::__construct();
		
		// Load Text Helper
		$this->load->helper(['text', 'blog_helper']);

		// Load Token Library
		$this->load->library('token');
		
		// CSRF Token
		$session_data['csrf_token'] = $this->token->get_token();

		// set session data
		$this->session->set_userdata($session_data);
		
		// redirect if under construction
		if ($this->session->userdata('site_maintenance') == 'true' && 
			$this->session->userdata('site_maintenance_end_date') >= date('Y-m-d') && 
			$this->uri->segment(1) !== 'login') {
			redirect('under-construction');
		}

		//  cache file
		if ($this->session->userdata('site_cache') == 'true' && intval($this->session->userdata('site_cache_time')) > 0) {
			$this->output->cache($this->session->userdata('site_cache_time'));
		}

		// Load Top Menus
		$this->load->model('m_menus');
		$this->vars['menus'] = $this->m_menus->get_parent_menu();
	}

	/**
    * valid_captcha
    * @return boolean
    */
   public function valid_captcha($str) {
      if ($this->model->is_valid_captcha($str)) {
         return true;
      }
      $this->form_validation->set_message('valid_captcha', 'Kode Keamanan tidak valid');
      return false;
   }
}