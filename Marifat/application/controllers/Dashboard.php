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

class Dashboard extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->model->clear_expired_session();
		$this->load->model(['m_dashboard', 'm_users', 'm_post_comments']);
		$this->load->library('user_agent');
		$this->load->helper(['form', 'blog']);
	}

	/**
	 * index
	 */
	public function index() {
		$this->vars['title'] = 'Dashboard';
		$this->vars['dashboard'] = true;
		$this->vars['widget_box'] = $this->m_dashboard->widget_box();
		$this->vars['last_logged_in'] = $this->m_users->get_last_logged_in();
		$this->vars['recent_posts_comments'] = $this->m_post_comments->get_recent_comments();
		$this->vars['content'] = 'backend/dashboard';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Sidebar Collapse
	 */
	public function sidebar_collapse() {
		$collapse = $this->session->userdata('sidebar_collapse') ? false : true;
		$this->session->set_userdata('sidebar_collapse', $collapse);
	}

	/**
	 * Print Sessions
	 */
	public function print_sessions() {
		echo '<pre>';
		print_r($this->session->all_userdata());
		echo '</pre>';
	}
}