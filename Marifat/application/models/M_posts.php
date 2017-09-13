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

class M_posts extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'posts';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Get data for pagination
	 * @param string
	 * @param int
	 * @param int
	 * @return Resource
	 */
	public function get_where($keyword, $limit = 0, $offset = 0) {
		$this->db->select('
			x1.id
			, x1.post_title
			, x2.user_full_name AS post_author
			, x1.created_at
			, x1.post_status
			, x1.is_deleted
		');
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'post');
		if ($this->session->userdata('user_type') == 'student' || $this->session->userdata('user_type') == 'employee') {
			$this->db->where('x1.post_author', $this->session->userdata('id'));
		}
		$this->db->group_start();
		$this->db->like('x1.post_title', $keyword);
		$this->db->or_like('x2.user_full_name', $keyword);
		$this->db->or_like('x1.created_at', $keyword);
		$this->db->group_end();
		if ($limit > 0) {
			$this->db->limit($limit, $offset);
		}
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * Get Total row for pagination
	 * @param string
	 * @return int
	 */
	public function total_rows($keyword) {
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'post');
		if ($this->session->userdata('user_type') == 'student' || $this->session->userdata('user_type') == 'employee') {
			$this->db->where('x1.post_author', $this->session->userdata('id'));
		}
		$this->db->group_start();
		$this->db->like('x1.post_title', $keyword);
		$this->db->or_like('x2.user_full_name', $keyword);
		$this->db->or_like('LEFT(x1.created_at, 10)', $keyword);
		$this->db->group_end();
		return $this->db->count_all_results('posts x1');
	}

	/**
	 * Get Posts for RSS Feed
	 * @return Array
	 */
	public function feed() {
		return $this->db
			->select('id, post_title, post_content, post_slug, LEFT(created_at, 10) AS created_at')
			->where('post_type', 'post')
			->where('post_status', 'publish')
			->where('is_deleted', 'false')
			->limit($this->session->userdata('post_rss_count'))
			->get(self::$table);
	}

	/**
	 * Get Archives
	 * @access public
	 * @return Query
	 */
	public function get_archives($year) {
		$this->db->select("SUBSTR(x1.created_at, 6, 2) as `code`, MONTHNAME(x1.created_at) AS `month`, COUNT(*) AS `count`");
		$this->db->where('YEAR(x1.created_at)', $year);
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.post_status', 'publish');
		if (!$this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}
		$this->db->where('x1.is_deleted', 'false');
		$this->db->group_by("1,2");
		$this->db->order_by('1', 'ASC');
		return $this->db->get('posts x1');
	}

	/**
	 * Get Recent Posts
	 * @access public
	 * @return Query
	 */
	public function get_recent_posts($limit = 6) {
		$this->db->select('
			x1.id
		  , x1.post_title
		  , LEFT(x1.created_at, 10) AS created_at
		  , x1.post_content
		  , x1.post_image
		  , x1.post_slug
		  , x1.post_counter
		  , x2.user_full_name AS post_author
		');
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.post_status', 'publish');
		if (!$this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}		
		$this->db->where('x1.is_deleted', 'false');
		$this->db->order_by('x1.created_at', 'DESC');
		$this->db->limit($limit);
		return $this->db->get('posts x1');
	}

	/**
	 * Get Popular Posts
	 * @access public
	 * @return Query
	 */
	public function get_popular_posts($limit = 6) {
		$this->db->select('
			x1.id
		  , x1.post_title
		  , LEFT(x1.created_at, 10) AS created_at
		  , x1.post_content
		  , post_image
		  , x1.post_slug
		  , x1.post_counter
		  , x2.user_full_name AS post_author
		');
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.post_status', 'publish');
		if (!$this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}		
		$this->db->where('x1.is_deleted', 'false');
		$this->db->order_by('x1.post_counter', 'DESC');
		$this->db->limit($limit);
		return $this->db->get('posts x1');
	}

	/**
	 * Get recent added posts / for dashboard
	 * @access public
	 * @return Query
	 */
	public function get_recent_added_posts() {
		$this->db->select('x1.post_title, x2.user_full_name AS post_author, LEFT(x1.created_at, 10) AS created_at');
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.is_deleted', 'false');
		$this->db->where('x1.post_status', 'publish');
		if (!$this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}
		$this->db->order_by('x1.created_at', 'DESC');
		$this->db->limit(5);
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * Get Random Posts
	 * @access public
	 * @return Query
	 */
	public function get_random_posts() {
		$this->db->select('id, post_title, post_slug');
		$this->db->where('post_type', 'post');
		$this->db->where('is_deleted', 'false');
		$this->db->where('post_status', 'publish');
		if (!$this->auth->is_logged_in()) {
			$this->db->where('post_visibility', 'public');
		}
		$this->db->order_by('RAND()');
		$this->db->limit(5);
		$this->db->get(self::$table);
	}

	/**
	 * Get Related Posts
	 * @param 	Int
	 * @access 	public
	 * @return 	Query
	 */
	public function get_related_posts($post_categories = '', $id) {
		$categories = explode(',', $post_categories);
		$this->db->select('id, post_title, post_content, LEFT(created_at, 10) AS created_at, post_image, post_slug, post_counter');
		$this->db->where('post_type', 'post');
		$this->db->where('is_deleted', 'false');
		$this->db->where('id !=', $id);
		if (! $this->auth->is_logged_in()) {
			$this->db->where('post_visibility', 'public');
		}
		$no = 0;
		$this->db->group_start();
		foreach ($categories as $category) {
			if ($no == 0) {
				$this->db->like('post_categories', $category);	
			} else {
				$this->db->or_like('post_categories', $category);
			}			
			$no++;
		}
		$this->db->group_end();
		$this->db->order_by('LEFT(created_at, 10) DESC');
		$this->db->limit((int) $this->session->userdata('post_related_count'));
		return $this->db->get(self::$table);
	}

	/**
	 * Get Year From Posted Date
	 * @access 	public
	 * @return 	Query
	 */
	public function get_archive_year() {
		$this->db->select('LEFT(created_at, 4) as year');
		$this->db->where('post_type', 'post');
		$this->db->where('is_deleted', 'false');
		$this->db->where('post_status', 'publish');
		if (! $this->auth->is_logged_in()) {
			$this->db->where('post_visibility', 'public');
		}
		$this->db->group_by('1');
		$this->db->order_by('1', 'DESC');
		return $this->db->get(self::$table);
	}

	/**
	 * Get Related Posts
	 * @param 	Int
	 * @access 	public
	 * @return 	Query
	 */
	public function get_archive_posts($year, $month) {
		$this->db->select('
			x1.id
			, x1.post_title
			, x2.user_full_name AS post_author
			, x1.post_content
			, LEFT(x1.created_at, 10) AS created_at
			, x1.post_categories
			, x1.post_image
			, x1.post_slug
			, x1.post_counter
		');
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.is_deleted', 'false');
		$this->db->where('x1.post_status', 'publish');
		$this->db->where('LEFT(x1.created_at, 4)=', $year)	;
		$this->db->where('SUBSTRING(x1.created_at, 6, 2)=', $month);
		if (! $this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}
		$this->db->order_by('x1.created_at', 'DESC');
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * Get post category
	 * @param 	Int
	 * @param 	Int
	 * @access 	public
	 * @return 	Query
	 */
	public function get_post_category($id, $limit= 0) {
		$this->db->select('x1.id, x1.post_title, x2.user_full_name AS post_author, x1.post_content, LEFT(x1.created_at, 10) AS created_at, x1.post_image, x1.post_slug, x1.post_counter');
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.is_deleted', 'false');
		$this->db->where('x1.post_status', 'publish');
		if (! $this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}
		$this->db->like('x1.post_categories', $id);
		$this->db->order_by('x1.created_at', 'DESC');
		if ($limit > 0) {
			$this->db->limit($limit);	
		}
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * Get post by tag
	 * @param 	Int
	 * @param 	Int
	 * @access 	public
	 * @return 	Query
	 */
	public function get_post_by_tag($tag, $limit= 0) {
		$this->db->select('x1.id, x1.post_title, x2.user_full_name AS post_author, x1.post_content, LEFT(x1.created_at, 10) AS created_at, x1.post_image, x1.post_slug, x1.post_counter');
		$this->db->join('users x2', 'x1.post_author = x2.id', 'LEFT');
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.is_deleted', 'false');
		$this->db->where('x1.post_status', 'publish');
		$this->db->like('x1.post_tags', $tag)	;
		$this->db->order_by('x1.created_at', 'DESC');
		if (! $this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}
		if ($limit > 0) {
			$this->db->limit($limit);	
		}
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * Welcome | Sambutan Kepala Sekolah
	 * @access public
	 * @return Query
	 */
	public function get_welcome() {
		$query = $this->db
			->select('post_content')
			->where('post_type', 'welcome')
			->limit(1)
			->get(self::$table);
		if ($query->num_rows() === 1) {
			$result = $query->row();
			return $result->post_content; 
		}
		return '';
	}

	/**
	 * Update Sambutan Kepala Sekolah
	 * @access public
	 * @return Bool
	 */
	public function welcome_update($fill_data = []) {
		$count = $this->db->where('post_type', 'welcome')->count_all_results(self::$table);
		if ($count === 0) {
			return $this->db->insert(self::$table, $fill_data);	
		}
		return $this->db->where('post_type', 'welcome')->update(self::$table, $fill_data);
	}

	/**
	 * increase_viewer
	 * @param int
	 * @return void
	 */
	public function increase_viewer($id) {
		$query = $this->model->RowObject(self::$table, self::$pk, $id);
		$this->db->where(self::$pk, $id)->update(self::$table, ['post_counter' => ($query->post_counter + 1)]);
	}

	/**
	 * Search
	 * @param String
	 * @return Array
	 */
	public function search($keyword) {
		$this->db->select('id, post_title, post_content, post_slug');
		$this->db->where('post_type', 'post');
		$this->db->where('post_status', 'publish');
		if (! $this->auth->is_logged_in()) {
			$this->db->where('post_visibility', 'public');
		}
		$this->db->where('is_deleted', 'false');
		$this->db->group_start();
		$this->db->like('LOWER(post_title)', strtolower($keyword));
		$this->db->or_like('LOWER(post_content)', strtolower($keyword));
		$this->db->group_end();
		$this->db->limit(10);
		return $this->db->get(self::$table);
	}

	/**
	 * more_posts
	 * @param string
	 * @param int
	 * @return query
	 */
	public function more_posts($slug = '', $offset = 0) {
		$id = 0;
		$query = $this->db
			->select('id')
			->where('slug', $slug)
			->limit(1)
			->get('post_categories');
		if ($query->num_rows() == 1) {
			$res = $query->row();
			$id = $res->id;
		}		
		$this->db->select('x1.id, x1.post_title, x1.post_content, LEFT(x1.created_at, 10) AS created_at, x1.post_image, x1.post_slug, x1.post_counter');
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.is_deleted', 'false');
		$this->db->where('x1.post_status', 'publish');
		if (! $this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}
		$this->db->group_start();
		$this->db->like('x1.post_categories', $id);
		$this->db->group_end();
		if ($offset < 0) {
			$this->db->limit(6);
		}
		if ($offset > 0) {
			$this->db->limit(6, $offset);
		}
		return $this->db->get(self::$table.' x1');
	}

	/**
	 * more_archive_posts
	 * @param 	string
	 * @param 	Int
	 * @param 	Int
	 * @param 	string
	 * @access 	public
	 * @return 	Query
	 */
	public function more_archive_posts($offset = 0, $year, $month) {
		$this->db->select('id, post_title, post_content, LEFT(created_at, 10) AS created_at, post_image, post_slug');
		$this->db->where('post_type', 'post');
		$this->db->where('is_deleted', 'false');
		$this->db->where('post_status', 'publish');
		$this->db->where('LEFT(created_at, 4)=', $year)	;
		$this->db->where('SUBSTRING(created_at, 6, 2)=', $month);
		if (! $this->auth->is_logged_in()) {
			$this->db->where('post_visibility', 'public');
		}
		if ($offset < 0) {
			$this->db->limit(6);
		}
		if ($offset > 0) {
			$this->db->limit(6, $offset);
		}
		return $this->db->get(self::$table);
	}

	/**
	 * more posts by tag
	 * @param string
	 * @param int
	 * @return query
	 */
	public function more_posts_by_tag($tag = '', $offset = 0) {
		$this->db->select('x1.id, x1.post_title, x1.post_content, LEFT(x1.created_at, 10) AS created_at, x1.post_image, x1.post_slug, x1.post_counter');
		$this->db->where('x1.post_type', 'post');
		$this->db->where('x1.is_deleted', 'false');
		$this->db->where('x1.post_status', 'publish');
		if (! $this->auth->is_logged_in()) {
			$this->db->where('x1.post_visibility', 'public');
		}
		$this->db->group_start();
		$this->db->like('x1.post_tags', $tag);
		$this->db->group_end();
		if ($offset < 0) {
			$this->db->limit(6);
		}
		if ($offset > 0) {
			$this->db->limit(6, $offset);
		}
		return $this->db->get(self::$table.' x1');
	}
}