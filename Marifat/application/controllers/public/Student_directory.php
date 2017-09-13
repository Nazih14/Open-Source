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

class Student_directory extends Public_Controller {

	/**
	 * Current Semester ID
	 */
	public $current_semester_id = 0;
	
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
		$this->load->model(['m_students', 'm_academic_years']);
		$this->current_semester_id = (int) $this->m_academic_years->get_active_id(); 
		$this->total_rows = $this->m_students->more_students(0, $this->current_semester_id)->num_rows();
		$this->total_pages = ceil($this->total_rows / 20);
	}

	/**
	 * Index
	 */
	public function index() {
		$academic_year = $this->model->RowObject('academic_years', 'id', $this->current_semester_id);
		$this->vars['page_title'] = (get_school_level() == 5 ? 'MAHASISWA' : 'PESERTA DIDIK'). ' Tahun Pelajaran ' . $academic_year->academic_year .' / '. ($academic_year->semester == 'odd' ? 'Ganjil':'Genap');
		$this->vars['total_pages'] = $this->total_pages;
		$this->vars['query'] = $this->m_students->more_students(-1, $this->current_semester_id);
		$this->vars['content'] = 'themes/'.theme_folder().'/loop-students';
		$this->load->view('themes/'.theme_folder().'/index', $this->vars);
	}

	/**
	 * More Files
	 */
	public function more_students() {
		$page_number = (int) $this->input->post('page_number', true);
		$offset = ($page_number - 1) * 20;
		$response = [];
		$query = $this->m_students->more_students($offset, $this->current_semester_id);
		$rows = [];
		foreach($query->result() as $row) {
			$photo = 'no-image.jpg';
			if ($row->photo && file_exists($_SERVER['DOCUMENT_ROOT'] . '/media_library/students/'.$row->photo)) {
				$photo = $row->photo;
			}
			$rows[] = [
				'class_name' => $row->class_name,
				'nis' => $row->nis,
				'nim' => $row->nim,
				'full_name' => $row->full_name,
				'gender' => $row->gender,
				'birth_place' => $row->birth_place,
				'birth_date' => indo_date($row->birth_date),
				'photo' => base_url('media_library/students/'.$photo)
			];
		}
		$response['rows'] = $rows;
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}