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

class Class_group_settings extends Admin_Controller {
	
	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->helper('form');
		$this->load->model(['m_academic_years', 'm_class_groups', 'm_class_group_settings', 'm_students']);
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = 'PENGATURAN KELAS';
		$this->vars['students'] = $this->vars['class_group_settings'] = true;
		$this->vars['ds_academic_years'] = $this->m_academic_years->dropdown();
		$this->vars['ds_class_groups'] = $this->m_class_groups->dropdown();
		$this->vars['content'] = 'class_group_settings/create';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Autocomplete
	 */
	public function autocomplete() {
		$academic_year_id = $this->input->get('academic_year_id');
		$class_group_id = $this->input->get('class_group_id');
		$keyword = $this->input->get('term');
		$query = $this->m_students->autocomplete($academic_year_id, $class_group_id, $keyword);
		$data = [];
		foreach($query->result() as $row) {
			if ($row->is_prospective_student == 'true') {
				$data[] = $row->id.' - '.$row->registration_number .' - '. $row->full_name . ' (Peserta Didik Baru)';
			} else {
				$data[] = $row->id.' - ' . ($row->nis ? ($row->nis . ' - ') : '') . $row->full_name;
			}
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	 * Save
	 */
	public function save() {
		$response = [];
		if ($this->validation()) {
			$academic_year_id = $this->input->post('academic_year_id');
			$class_group_id = $this->input->post('class_group_id');
			$students = explode(',', $this->input->post('students'));
			$ids = [];
			foreach($students as $student) {
				$ids[] = trim(explode('-', $student)[0]);
			}
			$response['action'] = 'save';
			$response['type'] = $this->m_class_group_settings->insert($academic_year_id, $class_group_id, $ids) ? 'success' : 'error';
			$response['message'] = $response['type'] == 'success' ? 'created' : 'not_created';
		} else {
			$response['action'] = 'validation_errors';
			$response['type'] = 'error';
			$response['message'] = validation_errors();
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	 * Validations Form
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('academic_year_id', 'Academic Year', 'trim|required|numeric');
		$val->set_rules('class_group_id', 'Class', 'trim|required|numeric');
		$val->set_rules('students', 'Students', 'trim|required');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}