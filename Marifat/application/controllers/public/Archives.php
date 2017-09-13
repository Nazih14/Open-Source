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

class Archives extends Public_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_posts');
	}

	/**
	 * Index
	 */
	public function index() {
		$year = substr($this->uri->segment(2), 0, 4);
		$month = substr($this->uri->segment(3), 0, 2);
		if ($year && $month) {
			$this->vars['title'] = bulan($month).' '.$year;
			$total_rows = $this->m_posts->more_archive_posts(0, $year, $month)->num_rows();
			$this->vars['total_page'] = ceil($total_rows / 6);
			$this->vars['query'] = $this->m_posts->more_archive_posts(-1, $year, $month);
			$this->vars['content'] = 'themes/'.theme_folder().'/loop-posts';
			$this->load->view('themes/'.theme_folder().'/index', $this->vars);
		} else {
			show_404();
		}
	}

	/**
	 * More Posts
	 */
	public function more_posts() {
		$year = substr($this->input->post('year', true), 0, 4);
		$month = substr($this->input->post('month', true), 0, 2);
		$page_number = intval($this->input->post('page_number', true));
		$offset = ($page_number - 1) * 6;
		$query = $this->m_posts->more_archive_posts($offset, $year, $month);
		$total_rows = $this->m_posts->more_archive_posts(0, $year, $month)->num_rows();
		$rows = [];
		foreach($query->result() as $row) {
			$rows[] = $row;
		}
		$response = [
			'rows' => $rows,
			'total_page' => ceil($total_rows / 6)
		];

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}