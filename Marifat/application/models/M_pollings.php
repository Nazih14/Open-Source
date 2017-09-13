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

class M_pollings extends CI_Model {

	/**
	 * Primary key
	 * @var string
	 */
	public static $pk = 'id';

	/**
	 * Table
	 * @var string
	 */
	public static $table = 'pollings';

	/**
	 * Constructor
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Save
	 */
	public function save($answer_id) {
		$count = $this->db
			->where('ip_address', $_SERVER['REMOTE_ADDR'])
			->where('LEFT(created_at, 10)=', date('Y-m-d'))
			->count_all_results(self::$table);
		if ($count === 0) {
			return $this->model->insert(self::$table, [
					'ip_address' => $_SERVER['REMOTE_ADDR'],
					'answer_id' => $answer_id,
					'created_at' => date('Y-m-d H:i:s')
				]
			);
		}
	}

	/**
	 * Result
	 */
	public function polling_result($question_id) {
		if ($question_id && $question_id != 0 && ctype_digit((string) $question_id)) {
			return $this->db->query("
				SELECT x2.answer AS labels
				  , COUNT(*) AS data
				FROM pollings x1
				LEFT JOIN answers x2
				  ON x1.answer_id= x2.id
				WHERE x2.question_id = '{$question_id}'
				GROUP BY x1.answer_id
				ORDER BY 1 ASC
			");
		}
		return;		
	}
}