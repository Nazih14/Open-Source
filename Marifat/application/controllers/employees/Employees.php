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

class Employees extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_employees');
		$this->pk = M_employees::$pk;
		$this->table = M_employees::$table;
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = get_school_level() == 5 ? 'STAFF DAN DOSEN' : 'GURU DAN TENAGA KEPENDIDIKAN';
		$this->vars['employees'] = $this->vars['all_employees'] = true;
		$this->vars['content'] = 'employees/read';
		$this->load->view('backend/index', $this->vars);
	}

	/**
	 * Pagination
	 */
	public function pagination() {
		$page_number = (int) $this->input->post('page_number', true);
		$limit = (int) $this->input->post('per_page', true);
		$keyword = trim($this->input->post('keyword', true));
		$offset = ($page_number * $limit);
		$query = $this->m_employees->get_where($keyword, $limit, $offset);
		$total_rows = $this->m_employees->total_rows($keyword);
		$total_page = $limit > 0 ? ceil($total_rows / $limit) : 1;
		$response = [];
		$response['total_page'] = 0;
		$response['total_rows'] = 0;
		if ($query->num_rows() > 0) {
			$rows = [];
			foreach($query->result() as $row) {
				$rows[] = $row;
			}
			$response = [
				'total_page' => (int) $total_page,
				'total_rows' => (int) $total_rows,
				'rows' => $rows
			];
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	 * find_id
	 * @param 	int $id
	 * @return 	Object 
	 */
	public function find_id() {
		$id = (int) $this->input->post('id', true);
		$query = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$query = $this->model->RowObject($this->table, $this->pk, $id);
		}
		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($query, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	 * Save or Update
	 * @return 	Object 
	 */
	public function save() {
		$id = (int) $this->input->post('id', true);
		$response = [];
		if ($this->validation()) {
			$fill_data = $this->fill_data();
			if ($id && $id > 0 && ctype_digit((string) $id)) {
				$fill_data['updated_by'] = $this->session->userdata('id');
				$response['action'] = 'update';		
				$response['type'] = $this->model->update($id, $this->table, $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated'; 
			} else {
				$fill_data['created_at'] = NULL;
				$fill_data['created_by'] = $this->session->userdata('id');
				$response['action'] = 'save';
				$response['type'] = $this->model->insert($this->table, $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'created' : 'not_created';
			}
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
			'nik' => $this->input->post('nik', true),
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
			'npwp' => $this->input->post('npwp', true) ? $this->input->post('npwp', true) : NULL,
			'employment_status' => $this->input->post('employment_status', true),
			'nip' => $this->input->post('nip', true) ? $this->input->post('nip', true) : NULL,
			'niy' => $this->input->post('niy', true) ? $this->input->post('niy', true) : NULL,
			'nuptk' => $this->input->post('nuptk', true),
			'employment_type' => $this->input->post('employment_type', true),
			'decree_appointment' => $this->input->post('decree_appointment', true),
			'appointment_start_date' => $this->input->post('appointment_start_date', true),
			'institutions_lifter' => $this->input->post('institutions_lifter', true),
			'decree_cpns' => $this->input->post('decree_cpns', true),
			'pns_start_date' => $this->input->post('pns_start_date', true),
			'rank' => $this->input->post('rank', true),
			'salary_source' => $this->input->post('salary_source', true),
			'headmaster_license' => $this->input->post('headmaster_license', true),
			'skills_laboratory' => $this->input->post('skills_laboratory', true),
			'handle_special_needs' => $this->input->post('handle_special_needs', true),
			'braille_skills' => $this->input->post('braille_skills', true),
			'sign_language_skills' => $this->input->post('sign_language_skills', true),
			'phone' => $this->input->post('phone', true),
			'mobile_phone' => $this->input->post('mobile_phone', true),
			'email' => $this->input->post('email', true)
		];
	}

	/**
	 * Validations Form
	 * @return Boolean
	 */
	private function validation() {
		$id = (int) $this->input->post('id', true);
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('full_name', 'Full Name', 'trim|required');
		$val->set_rules('nik', 'NIK', 'trim|required');
		$val->set_rules('email', 'Email', 'trim|required|valid_email|callback_email_check['.$id.']');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}

	/**
	 * Upload
	 * @return Void
	 */
	public function upload() {
		$id = (int) $this->input->post('id', true);
		$response = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$query = $this->model->RowObject($this->table, $this->pk, $id);
			$file_name = $query->photo;
			$config['upload_path'] = './media_library/employees/';
			$config['allowed_types'] = 'jpg|png|jpeg|gif';
			$config['max_size'] = 0;
			$config['encrypt_name'] = true;
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('file')) {
				$response['action'] = 'validation_errors';
				$response['type'] = 'error';
				$response['message'] = $this->upload->display_errors();
			} else {
				$file = $this->upload->data();
				$update = $this->model->update($id, $this->table, ['photo' => $file['file_name']]);
				if ($update) {
					// chmood new file
					@chmod(FCPATH.'media_library/employees/'.$file['file_name'], 0777);
					// chmood old file
					@chmod(FCPATH.'media_library/employees/'.$file_name, 0777);
					// unlink old file
					@unlink(FCPATH.'media_library/employees/'.$file_name);
					// resize new image
					$this->image_resize(FCPATH.'media_library/employees', $file['file_name']);
				}				
				$response['action'] = 'upload';
				$response['type'] = 'success';
				$response['message'] = 'uploaded';
			}
		} else {
			$response['action'] = 'error';
			$response['type'] = 'error';
			$response['message'] = 'Not initialize ID or ID is not numeric !';
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	  * Resize Images
	  */
	 private function image_resize($source, $file_name) {
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source .'/'.$file_name;
		$config['maintain_ratio'] = false;
		$config['width'] = intval($this->session->userdata('employee_photo_width'));
		$config['height'] = intval($this->session->userdata('employee_photo_height'));
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	/**
	  * Create Employees Account
	  */
	public function create_employee_account() {
		$id = (int) $this->input->post('id', true);
		$query = $this->model->RowObject($this->table, $this->pk, $id);
		$response = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$username_exist = $this->model->isValExist('user_name', $query->nik, 'users');
			$email_exist = $this->model->isValExist('user_email', $query->email, 'users');
			if (!$username_exist && !$email_exist) {
				$fill_data = [
					'user_name' => $query->nik,
					'user_password' => password_hash($query->nik, PASSWORD_BCRYPT),
					'user_full_name' => $query->full_name,
					'user_email' => $query->email,
					'user_registered' => date('Y-m-d H:i:s'),
					'user_group_id' => 0,
					'user_type' => 'employee',
					'profile_id' => $id,
					'is_active' => 'true',
					'created_at' => date('Y-m-d H:i:s'),
					'created_by' => $this->session->userdata('id'),
				];
				$response['type'] = $this->model->insert('users', $fill_data) ? 'success' : 'error';
				$response['message'] = $response['type'] == 'success' ? 'Akun sudah diaktifkan' : 'Akun gagal diaktifkan. Nama Pengguna dan Email sudah digunakan.';
			} else {
				$response['type'] = 'info';
				$response['message'] = 'existed'; 
			}
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}