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

class Student_profile extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * index
	 */
	public function index() {
		$this->load->helper('form');
		$this->load->model('m_options');
		$id = null !== $this->session->userdata('profile_id') ? $this->session->userdata('profile_id') : 0;
		$this->vars['title'] = 'Biodata';
		$this->vars['student_profile'] = true;
		$this->vars['religion'] = ['' => 'Pilih :'] + $this->m_options->get_options('religion');
		$this->vars['special_needs'] = ['' => 'Pilih :'] + $this->m_options->get_options('special_needs');
		$this->vars['residence'] = ['' => 'Pilih :'] + $this->m_options->get_options('residence');
		$this->vars['transportation'] = ['' => 'Pilih :'] + $this->m_options->get_options('transportation');
		$this->vars['education'] = ['' => 'Pilih :'] + $this->m_options->get_options('education');
		$this->vars['employment'] = ['' => 'Pilih :'] + $this->m_options->get_options('employment');
		$this->vars['monthly_income'] = ['' => 'Pilih :'] + $this->m_options->get_options('monthly_income');
		$this->vars['query'] = $this->model->RowObject('students', 'id', $id);
		$this->vars['content'] = 'students/profile';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * save
	 * @access  public
	 */
	public function save() {
		$id = null !== $this->session->userdata('profile_id') ? $this->session->userdata('profile_id') : 0;
		$response = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			if ($this->validation()) {
				$fill_data = $this->fill_data();
				$fill_data['updated_by'] = $id;
				$response['type'] = $this->model->update($id, 'students', $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated';
			} else {
				$response['action'] = 'validation_errors';
				$response['type'] = 'error';
				$response['message'] = validation_errors();
			}
		} else {
			$response['type'] = 'error';
			$response['message'] = 'not_updated';
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	 * Fill Data
	 * @return Array
	 */
	private function fill_data() {
		return [
			'paud' => $this->input->post('paud', true),
			'tk' => $this->input->post('tk', true),
			'hobby' => $this->input->post('hobby', true),
			'ambition' => $this->input->post('ambition', true),
			'birth_place' => $this->input->post('birth_place', true),
			'birth_date' => $this->input->post('birth_date', true),
			'religion' => $this->input->post('religion', true),
			'special_needs' => $this->input->post('special_needs', true),
			'street_address' => $this->input->post('street_address', true),
			'rt' => $this->input->post('rt', true),
			'rw' => $this->input->post('rw', true),
			'sub_village' => $this->input->post('sub_village', true),
			'village' => $this->input->post('village', true),
			'sub_district' => $this->input->post('sub_district', true),
			'district' => $this->input->post('district', true),
			'postal_code' => $this->input->post('postal_code', true),
			'residence' => $this->input->post('residence', true),
			'transportation' => $this->input->post('transportation', true),
			'phone' => $this->input->post('phone', true),
			'mobile_phone' => $this->input->post('mobile_phone', true),
			'email' => $this->input->post('email') ? $this->input->post('email', true) : NULL,
			'sktm' => $this->input->post('sktm', true),
			'kks' => $this->input->post('kks', true),
			'kps' => $this->input->post('kps', true),
			'kip' => $this->input->post('kip', true),
			'kis' => $this->input->post('kis', true),
			'citizenship' => $this->input->post('citizenship', true),
			'country' => $this->input->post('country', true),
			'father_name' => $this->input->post('father_name', true),
			'father_birth_year' => $this->input->post('father_birth_year', true),
			'father_education' => $this->input->post('father_education', true),
			'father_employment' => $this->input->post('father_employment', true),
			'father_monthly_income' => $this->input->post('father_monthly_income', true),
			'father_special_needs' => $this->input->post('father_special_needs', true),
			'mother_name' => $this->input->post('mother_name', true),
			'mother_birth_year' => $this->input->post('mother_birth_year', true),
			'mother_education' => $this->input->post('mother_education', true),
			'mother_employment' => $this->input->post('mother_employment', true),
			'mother_monthly_income' => $this->input->post('mother_monthly_income', true),
			'mother_special_needs' => $this->input->post('mother_special_needs', true),
			'guardian_name' => $this->input->post('guardian_name', true),
			'guardian_birth_year' => $this->input->post('guardian_birth_year', true),
			'guardian_education' => $this->input->post('guardian_education', true),
			'guardian_employment' => $this->input->post('guardian_employment', true),
			'guardian_monthly_income' => $this->input->post('guardian_monthly_income', true),
			'mileage' => $this->input->post('mileage', true),
			'traveling_time' => $this->input->post('traveling_time', true),
			'height' => $this->input->post('height', true),
			'weight' => $this->input->post('weight', true),
			'sibling_number' => $this->input->post('sibling_number', true)
		];
	}

	/**
	 * Validations Form
	 * @access  public
	 * @return Bool
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('email', 'Email', 'trim|required|valid_email');
		$val->set_rules('father_birth_year', 'Tahun Lahir Ayah', 'trim|numeric|min_length[4]|max_length[4]');
		$val->set_rules('mother_birth_year', 'Tahun Lahir Ibu', 'trim|numeric|min_length[4]|max_length[4]');
		$val->set_rules('guardian_birth_year', 'Tahun Lahir Wali', 'trim|numeric|min_length[4]|max_length[4]');
		$val->set_rules('sibling_number', 'Jumlah Saudara Kandung', 'trim|numeric|min_length[1]|max_length[2]');
		$val->set_rules('rt', 'RT', 'trim|numeric');
		$val->set_rules('rw', 'RW', 'trim|numeric');
		$val->set_rules('postal_code', 'Kode Pos', 'trim|numeric');
		$val->set_rules('mileage', 'Jarak Tempat Tinggal ke Sekolah', 'trim|numeric');
		$val->set_rules('traveling_time', 'Waktu Tempuh ke Sekolah', 'trim|numeric');
		$val->set_rules('height', 'Tinggi Badan', 'trim|numeric|min_length[2]|max_length[3]');
		$val->set_rules('weight', 'Berat Badan', 'trim|numeric|min_length[2]|max_length[3]');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}