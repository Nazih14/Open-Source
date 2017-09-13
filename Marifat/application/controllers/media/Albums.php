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

class Albums extends Admin_Controller {

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->load->model('m_albums');
		$this->pk = M_albums::$pk;
		$this->table = M_albums::$table;
	}

	/**
	 * Index
	 */
	public function index() {
		$this->vars['title'] = 'ALBUM PHOTO';
		$this->vars['media'] = $this->vars['albums'] = true;
		$this->vars['content'] = 'albums/read';
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
		$query = $this->m_albums->get_where($keyword, $limit, $offset);
		$total_rows = $this->m_albums->total_rows($keyword);
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
	 * Index
	 */
	public function form_upload() {
		$id = $this->uri->segment(4);
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$query = $this->model->RowObject(M_albums::$table, M_albums::$pk, $id);
			$this->vars['title'] = $query->album_title;
			$this->vars['action'] = site_url('media/albums/images_upload/').$id;
			$this->vars['media'] = $this->vars['albums'] = true;
			$this->vars['content'] = 'albums/form_upload';
			$this->load->view('backend/index', $this->vars);
		} else {
			show_404();
		}
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
			'album_title' => $this->input->post('album_title', true),
			'album_description' => $this->input->post('album_description', true),
			'album_slug' => url_title(strtolower($this->input->post('album_title', true)))
		];
	}

	/**
	 * Validations Form
	 * @return Boolean
	 */
	private function validation() {
		$this->load->library('form_validation');
		$val = $this->form_validation;
		$val->set_rules('album_title', 'Title', 'trim|required');
		$val->set_rules('album_description', 'Description', 'trim');
		$val->set_error_delimiters('<div>&sdot; ', '</div>');
		return $val->run();
	}

	/**
	 * List Images
	 * @return Object
	 */
	public function list_images() {
		$id = $this->uri->segment(4);
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

	/**
	 * Upload Cover albums
	 * @return Void
	 */
	public function cover_upload() {
		$id = (int) $this->input->post('id', true);
		$response = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$query = $this->model->RowObject($this->table, $this->pk, $id);
			$file_name = $query->album_cover;
			$config['upload_path'] = './media_library/albums/';
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
				$update = $this->model->update($id, $this->table, ['album_cover' => $file['file_name']]);
				if ($update) {
					// resize new image
					$this->album_cover_resize(FCPATH.'media_library/albums/', $file['file_name']);
					// chmood new file
					@chmod(FCPATH.'media_library/albums/'.$file['file_name'], 0777);
					// chmood old file
					@chmod(FCPATH.'media_library/albums/'.$file_name, 0777);
					// unlink old file
					@unlink(FCPATH.'media_library/albums/'.$file_name);
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
	  * Album Cover Resize
	  */
	 private function album_cover_resize($source, $file_name) {
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source .'/'.$file_name;
		$config['maintain_ratio'] = false;
		$config['width'] = intval($this->session->userdata('album_cover_width'));
		$config['height'] = intval($this->session->userdata('album_cover_height'));
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	/**
	 * Upload Gallery Images
	 * @return Void
	 */
	public function images_upload() {
		$id = $this->uri->segment(4);
		$response = [];
		if ($id && $id > 0 && ctype_digit((string) $id)) {
			$config['upload_path'] = './media_library/albums/';
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
				$fill_data = [
					'photo_album_id' => $id,
					'photo_name' => $file['file_name']
				];
				$this->model->insert('photos', $fill_data);
				// chmood new file
				@chmod(FCPATH.'media_library/albums/'.$file['file_name'], 0777);
				$this->image_resize(FCPATH.'media_library/albums/', $file['file_name'], 'large');
				$this->image_resize(FCPATH.'media_library/albums/', $file['file_name'], 'medium');
				$this->image_resize(FCPATH.'media_library/albums/', $file['file_name'], 'thumbnail');
				@unlink(FCPATH.'media_library/albums/'.$file['file_name']);
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
	 private function image_resize($source, $file_name, $size = 'large') {
		$settings = [
			'thumbnail_size_height' => $this->session->userdata('thumbnail_size_height'),
			'thumbnail_size_width' => $this->session->userdata('thumbnail_size_width'),
			'medium_size_height' => $this->session->userdata('medium_size_height'),
			'medium_size_width' => $this->session->userdata('medium_size_width'),
			'large_size_height' => $this->session->userdata('large_size_height'),
			'large_size_width' => $this->session->userdata('large_size_width'),
		];
		$this->load->library('image_lib');
		$config['image_library'] = 'gd2';
		$config['source_image'] = $source .'/'.$file_name;
		$config['new_image'] = $source .'/'.$size;
		$config['maintain_ratio'] = false;
		$config['width'] = intval($settings[$size.'_size_width']);
		$config['height'] = intval($settings[$size.'_size_height']);
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		@chmod($source.'/'.$file_name, 0777);
	}
}