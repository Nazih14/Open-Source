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

class Admission_form extends Public_Controller {

	/**
	 * Constructor
	 * @access  public
	 */
	public function __construct() {
		parent::__construct();
		// If close, redirect
		if ($this->session->userdata('admission_status') == 'close') {
			redirect(base_url());
		}
		// If not in array, redirect
		if ($this->session->userdata('admission_start_date') && $this->session->userdata('admission_end_date')) {
			$date_range = array_date($this->session->userdata('admission_start_date'), $this->session->userdata('admission_end_date'));
			if (!in_array(date('Y-m-d'), $date_range)) {
				redirect(base_url());
			}
		}

		$this->load->model('m_registrants');
		$this->pk = M_registrants::$pk;
		$this->table = M_registrants::$table;
	}

	/**
	 * Index
	 * @access  public
	 */
	public function index() {
		$this->load->helper(['captcha', 'string', 'form']);
		$this->load->model(['m_options', 'm_majors']);
		$this->vars['page_title'] = 'Formulir Penerimaan '. (get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik').' Baru Tahun '.$this->session->userdata('admission_year');
		$this->vars['religion'] = ['' => 'Pilih :'] + $this->m_options->get_options('religion');
		$this->vars['special_needs'] = $this->m_options->get_options('special_needs');
		$this->vars['residence'] = ['' => 'Pilih :'] + $this->m_options->get_options('residence');
		$this->vars['transportation'] = ['' => 'Pilih :'] + $this->m_options->get_options('transportation');
		$this->vars['education'] = ['' => 'Pilih :'] + $this->m_options->get_options('education');
		$this->vars['employment'] = ['' => 'Pilih :'] + $this->m_options->get_options('employment');
		$this->vars['monthly_income'] = ['' => 'Pilih :'] + $this->m_options->get_options('monthly_income');		
		$this->vars['majors'] = ['' => 'Pilih :'] + $this->m_majors->dropdown();
		$this->vars['captcha'] = $this->model->set_captcha();
		$this->vars['content'] = 'themes/'.theme_folder().'/admission-form';
		$this->load->view('themes/'.theme_folder().'/index', $this->vars);
	}

	/**
	  * Save
	  */
	public function save() {
		$response = [];
		if ($this->input->post('csrf_token') && $this->token->is_valid_token($this->input->post('csrf_token'))) {
			if ($this->validation()) {
				$fill_data = $this->fill_data();
				$is_uploaded = false;
				if (!empty($_FILES['file']['name'])) {
					$upload = $this->upload();				
					if ($upload['type'] == 'success') {
						$is_uploaded = true;
						$fill_data['photo'] = $upload['file_name'];
					} else {
						$response['type'] = $upload['type'];
						$response['message'] = $upload['message'];
					}
				}
				$query = $this->model->insert($this->table, $fill_data);
				if ($query) {
					$result = $this->m_registrants->find_registrant($fill_data['birth_date'], $fill_data['registration_number']);
					$this->load->library('admission');
					$this->admission->generating_pdf($result);
				}
				if (!isset($response['type'])) {
					$response['type'] = $query ? 'success' : 'error';	
				}
				if (!isset($response['message'])) {
					$response['message'] = $query ? 'created' : 'not_created';	
				}
				$file_name = 'formulir-penerimaan-'. (get_school_level() == 5 ? 'mahasiswa' : 'peserta-didik').'-baru-tahun-'.$this->session->userdata('admission_year');
				$file_name .= '-'.$fill_data['birth_date'].'-'.$fill_data['registration_number'].'.pdf';
				$response['file_name'] = $file_name;
				if (!$query && $is_uploaded) {
					@unlink(FCPATH.'media_library/students/'.$upload['file_name']);
				}
			} else {
				$response['type'] = 'error';
				$response['message'] = validation_errors();
			}
			$response['csrf_token'] = $this->token->get_token();
		} else {
			$response['type'] = 'token_error';
		}

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($response, JSON_PRETTY_PRINT))
			->_display();
		exit;
	}

	/**
	  * upload Images
	  */
	private function upload() {
		$response = [];
		$config['upload_path'] = './media_library/students/';
		$config['allowed_types'] = 'jpg|jpeg';
		$config['max_size'] = 1024; // 1 Mb
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('file')) {
			$response['type'] = 'error';
			$response['message'] = $this->upload->display_errors();
			$response['file_name'] = '';
		} else {
			$file = $this->upload->data();			
			// chmood file
			@chmod(FCPATH.'media_library/albums/'.$file['file_name'], 0777);
			$this->image_resize(FCPATH.'media_library/students/', $file['file_name']);
			$response['type'] = 'success';
			$response['message'] = 'uploaded';
			$response['file_name'] = $file['file_name'];
		}
		return $response;
	}

	/**
	  * Resize Images
	  */
	 private function image_resize($source, $file_name, $image_size = 'large') {
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source .'/'.$file_name;
		$config['new_image'] = $source .'/'.$image_size;
		$config['maintain_ratio'] = false;
		$config['width'] = intval($this->session->userdata('student_photo_width'));
		$config['height'] = intval($this->session->userdata('student_photo_height'));
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		@chmod($source.'/'.$file_name, 0644);
	}
	
	/**
	 * Fill Data
	 * @return Array
	 */
	private function fill_data() {
		$data = [];
		$data['registration_number'] = $this->m_registrants->registration_number();
		$data['is_prospective_student'] = 'true';
		$data['is_alumni'] = 'false';
		$data['is_student'] = 'false';
		$data['re_registration'] = 'false';
		$data['is_transfer'] = $this->input->post('is_transfer', true);
		$data['admission_phase_id'] = NULL !== $this->session->userdata('admission_phase_id') ? (int) $this->session->userdata('admission_phase_id') : 0;
		$data['full_name'] = $this->input->post('full_name', true);
		$data['birth_date'] = $this->input->post('birth_date', true);
		$data['gender'] = $this->input->post('gender', true);
		$data['district'] = $this->input->post('district', true);

		$data['first_choice'] = $this->input->post('first_choice') ? $this->input->post('first_choice', true) : null;
		$data['second_choice'] = $this->input->post('second_choice') ? $this->input->post('second_choice', true) : null;
		$data['prev_exam_number'] = $this->input->post('prev_exam_number') ? $this->input->post('prev_exam_number', true) : null;
		$data['paud'] = $this->input->post('paud') ? $this->input->post('paud', true) : null;
		$data['tk'] = $this->input->post('tk') ? $this->input->post('tk', true) : null;
		$data['hobby'] = $this->input->post('hobby', true);
		$data['ambition'] = $this->input->post('ambition', true);
		$data['is_transfer'] = $this->input->post('is_transfer', true);
		$data['skhun'] = $this->input->post('skhun') ? $this->input->post('skhun', true) : NULL;
		$data['diploma_number'] = $this->input->post('diploma_number') ? $this->input->post('diploma_number', true) : null;
		$data['full_name'] = $this->input->post('full_name', true);
		$data['gender'] = $this->input->post('gender', true);
		$data['nisn'] = $this->input->post('nisn') ? $this->input->post('nisn', true) : NULL;
		$data['nik'] = $this->input->post('nik') ? $this->input->post('nik', true) : NULL;
		$data['birth_place'] = $this->input->post('birth_place', true);
		$data['birth_date'] = $this->input->post('birth_date', true);
		$data['religion'] = $this->input->post('religion', true);
		$data['special_needs'] = $this->input->post('special_needs', true);
		$data['street_address'] = $this->input->post('street_address', true);
		$data['rt'] = $this->input->post('rt', true);
		$data['rw'] = $this->input->post('rw', true);
		$data['sub_village'] = $this->input->post('sub_village', true);
		$data['village'] = $this->input->post('village', true);
		$data['sub_district'] = $this->input->post('sub_district', true);
		$data['district'] = $this->input->post('district', true);
		$data['postal_code'] = $this->input->post('postal_code', true);
		$data['residence'] = $this->input->post('residence', true);
		$data['transportation'] = $this->input->post('transportation', true);
		$data['phone'] = $this->input->post('phone', true);
		$data['mobile_phone'] = $this->input->post('mobile_phone', true);
		$data['email'] = $this->input->post('email') ? $this->input->post('email', true) : NULL;
		$data['sktm'] = $this->input->post('sktm', true);
		$data['kks'] = $this->input->post('kks', true);
		$data['kps'] = $this->input->post('kps', true);
		$data['kip'] = $this->input->post('kip', true);
		$data['kis'] = $this->input->post('kis', true);
		$data['citizenship'] = $this->input->post('citizenship', true);
		$data['country'] = $this->input->post('country', true);
		$data['father_name'] = $this->input->post('father_name', true);
		$data['father_birth_year'] = $this->input->post('father_birth_year', true);
		$data['father_education'] = $this->input->post('father_education', true);
		$data['father_employment'] = $this->input->post('father_employment', true);
		$data['father_monthly_income'] = $this->input->post('father_monthly_income', true);
		$data['father_special_needs'] = $this->input->post('father_special_needs', true);
		$data['mother_name'] = $this->input->post('mother_name', true);
		$data['mother_birth_year'] = $this->input->post('mother_birth_year', true);
		$data['mother_education'] = $this->input->post('mother_education', true);
		$data['mother_employment'] = $this->input->post('mother_employment', true);
		$data['mother_monthly_income'] = $this->input->post('mother_monthly_income', true);
		$data['mother_special_needs'] = $this->input->post('mother_special_needs', true);
		$data['guardian_name'] = $this->input->post('guardian_name', true);
		$data['guardian_birth_year'] = $this->input->post('guardian_birth_year', true);
		$data['guardian_education'] = $this->input->post('guardian_education', true);
		$data['guardian_employment'] = $this->input->post('guardian_employment', true);
		$data['guardian_monthly_income'] = $this->input->post('guardian_monthly_income', true);
		$data['mileage'] = $this->input->post('mileage', true);
		$data['traveling_time'] = $this->input->post('traveling_time', true);
		$data['height'] = $this->input->post('height', true);
		$data['weight'] = $this->input->post('weight', true);
		$data['sibling_number'] = $this->input->post('sibling_number');
		return $data;
	}

	/**
	 * Validations Form
	 * @return Boolean
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('is_transfer', 'Jenis Pendaftaran', 'trim|required|in_list[true,false]');
		if (in_array(get_school_level(), have_majors())) {
			$val->set_rules('first_choice', 'Pilihan I (Satu)', 'trim|required|numeric');
			$val->set_rules('second_choice', 'Pilihan II (Dua)', 'trim|required|numeric');
		}
		$val->set_rules('prev_exam_number', 'Nomor Peserta Ujian', 'trim');
		$val->set_rules('paud', 'PAUD', 'trim');
		$val->set_rules('tk', 'TK', 'trim');
		$val->set_rules('hobby', 'Hobi', 'trim');
		$val->set_rules('ambition', 'Cita-cita', 'trim');		
		$val->set_rules('full_name', 'Nama Lengkap', 'trim|required');
		$val->set_rules('gender', 'Jenis Kelamin', 'trim|required');
		$val->set_rules('skhun', 'Nomor Seri SKHUN Sebelumnya', 'trim');
		$val->set_rules('diploma_number', 'Nomor Seri Ijazah Sebelumnya', 'trim');
		$val->set_rules('nisn', 'NISN', 'trim');
		$val->set_rules('nik', 'NIK', 'trim');
		$val->set_rules('birth_place', 'Tempat Lahir', 'trim|required');
		$val->set_rules('birth_date', 'Tanggal Lahir', 'trim|required');
		$val->set_rules('religion', 'Agama', 'trim|required|numeric');
		$val->set_rules('special_needs', 'Kebutuhan Khusus', 'trim|numeric');
		$val->set_rules('street_address', 'Alamat Jalan', 'trim|required');
		$val->set_rules('rt', 'RT', 'trim');
		$val->set_rules('rw', 'RW', 'trim');
		$val->set_rules('sub_village', 'Nama Dusun', 'trim');
		$val->set_rules('village', 'Nama Kelurahan / Desa', 'trim');
		$val->set_rules('sub_district', 'Kecamatan', 'trim');
		$val->set_rules('district', 'Kabupaten', 'trim|required');
		$val->set_rules('postal_code', 'Kode Pos', 'trim|numeric');
		$val->set_rules('residence', 'Tempat Tinggal', 'trim|numeric');
		$val->set_rules('transportation', 'Moda Transportasi', 'trim|numeric');
		$val->set_rules('phone', 'Nomor Telepon', 'trim');
		$val->set_rules('mobile_phone', 'Nomor HP', 'trim|required');
		$val->set_rules('email', 'E-mail Pribadi', 'trim|valid_email');
		$val->set_rules('sktm', 'No. Surat Keterangan Tidak Mampu (SKTM)', 'trim');
		$val->set_rules('kks', 'No. Kartu Keluarga Sejahtera (KKS)', 'trim');
		$val->set_rules('kps', 'No. Kartu Pra Sejahtera (KPS)', 'trim');
		$val->set_rules('kip', 'No. Kartu Indonesia Pintar (KIP)', 'trim');
		$val->set_rules('kis', 'No. Kartu Indonesia Sehat (KIS)', 'trim');
		$val->set_rules('citizenship', 'Kewarganegaraan', 'trim|required|in_list[WNI,WNA]');
		$val->set_rules('country', 'Nama Negara', 'trim');
		
		$val->set_rules('father_name', 'Nama Ayah Kandung', 'trim|required');
		$val->set_rules('father_birth_year', 'Tahun Lahir Ayah', 'trim|numeric|required|min_length[4]|max_length[4]');
		$val->set_rules('father_education', 'Pendidikan Ayah', 'trim|numeric');
		$val->set_rules('father_employment', 'Pekerjaan Ayah', 'trim|numeric');
		$val->set_rules('father_monthly_income', 'Penghasilan Bulanan Ayah', 'trim|numeric');
		$val->set_rules('father_special_needs', 'Kebutuhan Khusus Ayah', 'trim|numeric');
		
		$val->set_rules('mother_name', 'Nama Ibu Kandung', 'trim|required');
		$val->set_rules('mother_birth_year', 'Tahun Lahir Ibu', 'trim|numeric|min_length[4]|max_length[4]');
		$val->set_rules('mother_education', 'Pendidikan Ibu', 'trim|numeric');
		$val->set_rules('mother_employment', 'Pekerjaan Ibu', 'trim|numeric');
		$val->set_rules('mother_monthly_income', 'Penghasilan Bulanan Ibu', 'trim|numeric');
		$val->set_rules('mother_special_needs', 'Kebutuhan Khusus Ibu', 'trim|numeric');
		
		$val->set_rules('guardian_name', 'Nama Wali', 'trim');
		$val->set_rules('guardian_birth_year', 'Tahun Lahir Wali', 'trim|numeric|min_length[4]|max_length[4]');
		$val->set_rules('guardian_education', 'Pendidikan Wali', 'trim|numeric');
		$val->set_rules('guardian_employment', 'Pekerjaan Wali', 'trim|numeric');
		$val->set_rules('guardian_monthly_income', 'Penghasilan Bulanan Wali', 'trim|numeric');
		
		$val->set_rules('mileage', 'Jarak Tempat Tinggal ke Sekolah', 'trim|numeric|min_length[1]|max_length[5]');
		$val->set_rules('traveling_time', 'Waktu Tempuh ke Sekolah', 'trim|numeric|min_length[1]|max_length[5]');
		$val->set_rules('height', 'Tinggi Badan', 'trim|numeric|min_length[2]|max_length[5]');
		$val->set_rules('weight', 'Berat Badan', 'trim|numeric|min_length[2]|max_length[5]');
		$val->set_rules('sibling_number', 'Jumlah Saudara Kandung', 'trim|numeric|max_length[2]');

		$val->set_rules('captcha', 'Captcha', 'trim|required|callback_valid_captcha');
		$val->set_rules('declaration', 'Pernyataan', 'trim|required|in_list[true]|callback_declaration_check');

		$val->set_message('required', '{field} harus diisi');
		$val->set_message('min_length', '{field} Harus Diisi Minimal {param} Karakter');
		$val->set_message('max_length', '{field} harus Diisi Maksimal {param} Karakter');
		$val->set_message('numeric', '{field} harus diisi dengan angka');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}

	/**
    * Declaration Check
    * @return boolean
    */
	public function declaration_check($str) {
		if (!filter_var($str, FILTER_VALIDATE_BOOLEAN)) {
			$this->form_validation->set_message('declaration_check', 'Pernyataan Harus Diceklis');
			return false;
		}
		return true;
	}
}