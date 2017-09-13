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

class Chart extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_students');
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = 'GRAFIK';
		$this->vars['students'] = $this->vars['chart_students'] = true;
		$query = $this->m_students->student_by_student_status();
		$labels = [];
		$data = [];
		foreach($query->result() as $row) {
			array_push($labels, $row->labels);
			array_push($data, $row->data);
		}
		$this->vars['labels'] = json_encode($labels);
		$this->vars['data'] = json_encode($data);
		$this->vars['content'] = 'students/chart';
		$this->load->view('backend/index', $this->vars);
	}
}