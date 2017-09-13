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

class Registrants extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model(['m_registrants', 'm_majors']);
		$this->pk = M_registrants::$pk;
		$this->table = M_registrants::$table;
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = 'SEMUA PENDAFTAR';
		$this->vars['admission_year'] = $this->session->userdata('admission_year');
		$this->vars['admission'] = $this->vars['registrants'] = true;
		if (in_array(get_school_level(), have_majors())) {
			$this->vars['ds_majors'] = json_encode($this->m_majors->dropdown());
		} else {
			$this->vars['ds_majors'] = json_encode([]);
		}
		$this->vars['content'] = 'admission/registrants';
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
		$query = $this->m_registrants->get_where($keyword, $limit, $offset);
		$total_rows = $this->m_registrants->total_rows($keyword);
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
				$response['action'] = 'save';
				$response['type'] = 'error';
				$response['message'] = 'not_created';
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
	 * Verified prospective studnets
	 * @return 	Object 
	 */
	public function verified() {
		$id = (int) $this->input->post('id', true);
		$response = [];
		$fill_data['updated_by'] = $this->session->userdata('id');
		$fill_data['re_registration'] = $this->input->post('re_registration', true);
		$response['action'] = 'update';
		$response['type'] = $this->model->update($id, $this->table, $fill_data) ? 'success' : 'error';
		$response['sql'] = $this->db->last_query();
		$response['message'] = $response['type'] == 'success' ? 'updated' : 'not_updated';
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
			'first_choice' => $this->input->post('first_choice', true),
			'second_choice' => $this->input->post('second_choice', true),
			'full_name' => $this->input->post('full_name', true),
			'gender' => $this->input->post('gender', true),
			'nisn' => $this->input->post('nisn') ? $this->input->post('nisn', true) : null,
			'nik' => $this->input->post('nik', true),
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
			'email' => $this->input->post('email') ? $this->input->post('email', true) : null,
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
	 * @return Boolean
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		if (in_array(get_school_level(), have_majors())) {
			$val->set_rules('first_choice', 'First Choice', 'trim|required');
			$val->set_rules('second_choice', 'Second Choice', 'trim|required');
		}
		$val->set_rules('full_name', 'Full Name', 'trim|required');
		$val->set_rules('email', 'Email', 'trim|valid_email');
		$val->set_rules('father_birth_year', 'Father Birth Year', 'trim|numeric|min_length[4]|max_length[4]');
		$val->set_rules('mother_birth_year', 'Mother Birth Year', 'trim|numeric|min_length[4]|max_length[4]');
		$val->set_rules('guardian_birth_year', 'Guardian Birth Year', 'trim|numeric|min_length[4]|max_length[4]');
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
			$config = [];
			$config['upload_path'] = './media_library/students/';
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
					@chmod(FCPATH.'media_library/students/'.$file['file_name'], 0777);
					// chmood old file
					@chmod(FCPATH.'media_library/students/'.$file_name, 0777);
					// unlink old file
					@unlink(FCPATH.'media_library/students/'.$file_name);
					// resize new image
					$this->image_resize(FCPATH.'media_library/students', $file['file_name']);
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
		$config['width'] = intval($this->session->userdata('student_photo_width'));
		$config['height'] = intval($this->session->userdata('student_photo_height'));
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	/**
	  * Print PDF Registration Form
	  */
	public function print_registration_form() {
		$id = (int) $this->input->post('id', true);
		$query = $this->model->RowObject($this->table, $this->pk, $id);
		$response = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$this->load->model('m_registrants');
			$result = $this->m_registrants->find_registrant($query->birth_date, $query->registration_number);
			if (count($result) == 0) {
				$response['type'] = 'warning';
				$response['message'] = 'Data dengan tanggal lahir '.indo_date($query->birth_date).' dan nomor pendaftaran '.$query->registration_number.' tidak ditemukan.';
			} else {
				$file_name = 'formulir-penerimaan-'. (get_school_level() == 5 ? 'mahasiswa' : 'peserta-didik').'-baru-tahun-'.$this->session->userdata('admission_year');
				$file_name .= '-'.$query->birth_date.'-'.$query->registration_number.'.pdf';
				$this->load->library('admission');
				$this->admission->generating_pdf($result);
				$response['type'] = 'success';
				$response['file_name'] = $file_name;
			}
		} else {
			$response['type'] = 'error';
			$response['message'] = 'Format data tidak valid.';
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}
}