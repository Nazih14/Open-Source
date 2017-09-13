<?php defined('BASEPATH') or exit('No direct script access allowed');

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

/**
 * Get Active Theme
 */
if (! function_exists('theme_folder')) {
	function theme_folder() {
		$CI = &get_instance();
		return $CI->session->userdata('theme');
	}
}

/**
 * Get Links
 */
if (! function_exists('get_links')) {
	function get_links() {
		$CI = &get_instance();
		$CI->load->model('m_links');
		return $CI->m_links->get_links();
	}
}

/**
 * Get Post Categories
 */
if (! function_exists('get_post_categories')) {
	function get_post_categories() {
		$CI = &get_instance();
		$CI->load->model('m_post_categories');
		return $CI->m_post_categories->get_post_categories();
	}
}

/**
 * Get Tags
 */
if (! function_exists('get_tags')) {
	function get_tags() {
		$CI = &get_instance();
		$CI->load->model('m_tags');
		return $CI->m_tags->get_tags();
	}
}

/**
 * Get Banners
 */
if (! function_exists('get_banners')) {
	function get_banners() {
		$CI = &get_instance();
		$CI->load->model('m_banners');
		return $CI->m_banners->get_banners();
	}
}

/**
 * Get Archive Year
 */
if (! function_exists('get_archive_year')) {
	function get_archive_year() {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_archive_year();
	}
}

/**
 * Get Archive
 */
if (! function_exists('get_archives')) {
	function get_archives($year) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_archives($year);
	}
}

/**
 * Get Quotes
 */
if (! function_exists('get_quotes')) {
	function get_quotes() {
		$CI = &get_instance();
		$CI->load->model('m_quotes');
		return $CI->m_quotes->get_quotes();
	}
}

/**
 * Get Image Sliders
 */
if (! function_exists('get_image_sliders')) {
	function get_image_sliders() {
		$CI = &get_instance();
		$CI->load->model('m_image_sliders');
		return $CI->m_image_sliders->get_image_sliders();
	}
}

/**
 * Get Question
 */
if (! function_exists('get_active_question')) {
	function get_active_question() {
		$CI = &get_instance();
		$CI->load->model('m_questions');
		return $CI->m_questions->get_active_question();
	}
}

/**
 * Get Answears
 */
if (! function_exists('get_answers')) {
	function get_answers($question_id) {
		$CI = &get_instance();
		$CI->load->model('m_answers');
		return $CI->m_answers->get_answers($question_id);
	}
}

/**
 * Get Recent Posts
 */
if (! function_exists('get_recent_posts')) {
	function get_recent_posts($limit) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_recent_posts($limit);
	}
}

/**
 * Get Popular Posts
 */
if (! function_exists('get_popular_posts')) {
	function get_popular_posts($limit) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_popular_posts($limit);
	}
}

/**
 * Get Post by category
 */
if (! function_exists('get_post_category')) {
	function get_post_category($id, $limit) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_post_category($id, $limit);
	}
}

/**
 * Get Post categories
 */
if (! function_exists('get_post_categories')) {
	function get_post_categories($limit) {
		$CI = &get_instance();
		$CI->load->model('m_post_categories');
		return $CI->m_post_categories->get_post_categories($limit);
	}
}

if (! function_exists('get_related_posts')) {
	function get_related_posts($get_post_categories, $id) {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_related_posts($get_post_categories, $id);
	}
}

/**
 * Get Welcome
 */
if (! function_exists('get_welcome')) {
	function get_welcome() {
		$CI = &get_instance();
		$CI->load->model('m_posts');
		return $CI->m_posts->get_welcome();
	}
}

/**
 * Get Video
 */
if (! function_exists('get_recent_video')) {
	function get_recent_video($limit) {
		$CI = &get_instance();
		$CI->load->model('m_videos');
		return $CI->m_videos->get_recent_video($limit);
	}
}

/**
 * Get Albums Photo
 */
if (! function_exists('get_albums')) {
	function get_albums($limit) {
		$CI = &get_instance();
		$CI->load->model('m_albums');
		return $CI->m_albums->get_albums($limit);
	}
}

/**
 * recursive list
 */
if (!function_exists('recursive_list')) {
	function recursive_list($menus) {
		$str = '';
		foreach ($menus as $menu) {
			$url = base_url() . $menu['menu_url'];
			if ($menu['menu_type'] == 'links') {
				$url = $menu['menu_url'];
			}							
			$str .= '<li>';
			$subchild = recursive_list($menu['child']);
			$str .= anchor($url, $menu['menu_title'].($subchild?' <span class="caret"></span>':''), 'target="'.$menu['menu_target'].'"');
			if ($subchild) {
				$str .= "<ul class='dropdown-menu'>" . $subchild . "</ul>";
			}
			$str .= "</li>";
		}
		return $str;
	}
}