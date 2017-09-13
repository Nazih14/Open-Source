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

class Feed extends Public_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_posts');
		$this->load->helper(['xml', 'text']);
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['feed_name'] = $this->session->userdata('website');
		$this->vars['encoding'] = 'utf-8';
		$this->vars['feed_url'] = base_url().'feed';
		$this->vars['page_description'] = $this->session->userdata('meta_description');
		$this->vars['page_language'] = 'en-en';
		$this->vars['creator_email'] = $this->session->userdata('email');
		$this->vars['posts'] = $this->m_posts->feed();
		header('Content-Type: text/xml; charset=utf-8', true);
		$this->load->view('frontend/feed', $this->vars);
	}
}