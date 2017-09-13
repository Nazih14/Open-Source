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

class Readmore extends Public_Controller {

	/**
	 * Total Rows
	 */
	public $total_rows = 0;

	/**
	 * Total Page
	 */
	public $total_pages = 0;

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_post_comments');
		$this->total_rows = $this->m_post_comments->more_comments($this->uri->segment(2), 0)->num_rows();
		$this->total_pages = ceil($this->total_rows / $this->session->userdata('comment_per_page'));
	}
	
	/**
	 * Readmore
	 */
	public function index() {
		$this->load->helper(['text', 'form']);
		$id = (int) $this->uri->segment(2);
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$this->load->helper(['captcha', 'string']);
			$this->load->model(['m_posts', 'm_pages', 'm_post_comments']);
			$this->m_posts->increase_viewer($id);
			$this->vars['query'] = $this->model->RowObject('posts', 'id', $id);
			if (filter_var($this->vars['query']->is_deleted, FILTER_VALIDATE_BOOLEAN)) {
				redirect(base_url(), 'refresh');
			}
			if ($this->vars['query']->post_status == 'draft') {
				redirect(base_url(), 'refresh');
			}
			if ($this->vars['query']->post_visibility == 'private' && ! $this->auth->is_logged_in()) {
				redirect(base_url(), 'refresh');
			}
			$this->vars['post_comments'] = $this->m_post_comments->get_post_comments($id);
			$this->vars['total_pages'] = $this->total_pages; // Total Comment Page
			$this->vars['page_title'] = $this->vars['query']->post_title;
			$this->vars['post_type'] = 'post';
			if ($this->vars['query']->post_type === 'page') {
				$this->vars['post_type'] = 'page';
			}
			$this->vars['post_author'] = $this->model->RowObject('users', 'id', $this->vars['query']->post_author)->user_full_name;
			$this->vars['content'] = 'themes/'.theme_folder().'/single-post';
			$this->vars['captcha'] = $this->model->set_captcha();
			$this->load->view('themes/'.theme_folder().'/index', $this->vars);
		} else {
			show_404();
		}
	}
}