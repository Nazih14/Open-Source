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

class Employee_profile extends Admin_Controller {

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
		$this->vars['employee_profile'] = true;
		$this->vars['religion'] = ['' => 'Pilih :'] + $this->m_options->get_options('religion');
		$this->vars['marital_status'] = ['' => 'Pilih :'] + $this->m_options->get_options('marital_status');
		$this->vars['employment_status'] = ['' => 'Pilih :'] + $this->m_options->get_options('employment_status');
		$this->vars['employment'] = ['' => 'Pilih :'] + $this->m_options->get_options('employment');
		$this->vars['employment_type'] = ['' => 'Pilih :'] + $this->m_options->get_options('employment_type');
		$this->vars['institutions_lifter'] = ['' => 'Pilih :'] + $this->m_options->get_options('institutions_lifter');
		$this->vars['salary_source'] = ['' => 'Pilih :'] + $this->m_options->get_options('salary_source');
		$this->vars['skills_laboratory'] = ['' => 'Pilih :'] + $this->m_options->get_options('skills_laboratory');
		$this->vars['special_needs'] = ['' => 'Pilih :'] + $this->m_options->get_options('special_needs');
		$this->vars['rank'] = ['' => 'Pilih :'] + $this->m_options->get_options('rank');
		$this->vars['query'] = $this->model->RowObject('employees', 'id', $id);
		$this->vars['content'] = 'employees/profile';
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
				$response['type'] = $this->model->update($id, 'employees', $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated';
				if ($response['type'] == 'success') {
					$nik = $fill_data['nik'];
					if ($nik != $this->session->userdata('user_name')) {
						$this->load->model('m_users');
						$query = $this->m_users->change_user_name($nik);
						if ($query) {
							$this->session->set_userdata('user_name', $nik);
						}
					}
				}
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
			'assignment_letter_number' => $this->input->post('assignment_letter_number', true),
			'assignment_letter_date' => $this->input->post('assignment_letter_date', true),
			'assignment_start_date' => $this->input->post('assignment_start_date', true),
			'parent_School_status' => $this->input->post('parent_School_status', true),
			'full_name' => $this->input->post('full_name', true),
			'gender' => $this->input->post('gender', true),
			'nik' => $this->input->post('nik') ? $this->input->post('nik', true) : NULL,
			'birth_place' => $this->input->post('birth_place', true),
			'birth_date' => $this->input->post('birth_date', true),
			'mother_name' => $this->input->post('mother_name', true),
			'street_address' => $this->input->post('street_address', true),
			'rt' => $this->input->post('rt', true),
			'rw' => $this->input->post('rw', true),
			'sub_village' => $this->input->post('sub_village', true),
			'village' => $this->input->post('village', true),
			'sub_district' => $this->input->post('sub_district', true),
			'district' => $this->input->post('district', true),
			'postal_code' => $this->input->post('postal_code', true),
			'religion' => $this->input->post('religion', true),
			'marital_status' => $this->input->post('marital_status', true),
			'spouse_name' => $this->input->post('spouse_name', true),
			'spouse_employment' => $this->input->post('spouse_employment', true),
			'citizenship' => $this->input->post('citizenship', true),
			'country' => $this->input->post('country', true),
			'npwp' => $this->input->post('npwp') ? $this->input->post('npwp', true) : NULL,
			'employment_status' => $this->input->post('employment_status', true),
			'nip' => $this->input->post('nip') ? $this->input->post('nip', true) : NULL,
			'niy' => $this->input->post('niy') ? $this->input->post('niy', true) : NULL,
			'nuptk' => $this->input->post('nuptk') ? $this->input->post('nuptk', true) : NULL,
			'employment_type' => $this->input->post('employment_type', true),
			'decree_appointment' => $this->input->post('decree_appointment', true),
			'appointment_start_date' => $this->input->post('appointment_start_date', true),
			'institutions_lifter' => $this->input->post('institutions_lifter', true),
			'decree_cpns' => $this->input->post('decree_cpns', true),
			'pns_start_date' => $this->input->post('pns_start_date', true),
			'rank' => $this->input->post('rank', true),
			'salary_source' => $this->input->post('salary_source', true),
			'headmaster_license' => $this->input->post('headmaster_license', true),
			'skills_laboratory' => $this->input->post('skills_laboratory') ? $this->input->post('skills_laboratory', true) : NULL,
			'handle_special_needs' => $this->input->post('handle_special_needs', true),
			'braille_skills' => $this->input->post('braille_skills', true),
			'sign_language_skills' => $this->input->post('sign_language_skills', true),
			'phone' => $this->input->post('phone', true),
			'mobile_phone' => $this->input->post('mobile_phone', true),
			'email' => $this->input->post('email') ? $this->input->post('email', true) : NULL
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
		$val->set_rules('full_name', 'Nama Lengkap', 'trim|required');
		$val->set_rules('nik', 'NIK', 'trim|required');
		$val->set_rules('email', 'Email', 'trim|required|valid_email');
		$val->set_rules('rt', 'RT', 'trim|numeric');
		$val->set_rules('rw', 'RW', 'trim|numeric');
		$val->set_rules('postal_code', 'Kode Pos', 'trim|numeric');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}
}