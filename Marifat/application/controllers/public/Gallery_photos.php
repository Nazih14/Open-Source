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

class Gallery_photos extends Public_Controller {

	/**
	 * Total Rows
	 */
	private $total_rows = 0;

	/**
	 * Total Page
	 */
	private $total_pages = 0;
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_albums']);
		$this->total_rows = $this->m_albums->get_albums()->num_rows();
		$this->total_pages = ceil($this->total_rows / 6);
	}

	/**
	 * photo
	 */
	public function index() {
		$this->vars['total_pages'] = $this->total_pages;
		$this->vars['query'] = $this->m_albums->get_albums(6);
		$this->vars['content'] = 'themes/'.theme_folder().'/loop-album';
		$this->load->view('themes/'.theme_folder().'/index', $this->vars);
	}

	/**
	 * More photo
	 */
	public function more_photos() {
		$page_number = intval($this->input->post('page_number', true));
		$offset = ($page_number - 1) * 6;
		$query = $this->m_albums->more_photo($offset);
		$rows = [];
		foreach($query->result() as $row) {
			$rows[] = $row;
		}
		$response = [
			'rows' => $rows,
			'total_rows' => $this->total_rows
		];

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
	
	/**
	 * List Images
	 * @return Object
	 */
	public function preview() {
		$id = $this->input->post('id');
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$this->load->model('m_photos');
			$query = $this->m_photos->get_image_by_album_id($id);
			$items = [];
			foreach($query->result() as $row) {
				$items[] = [
					'src' => base_url().'media_library/albums/large/'.$row->photo_name
				];
			}
			$response = [
				'count' => count($items),
				'items' => $items
			];
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode($response, JSON_PRETTY_PRINT))
				->_display();
			exit;
		} else {
			show_404();
		}
	}
}