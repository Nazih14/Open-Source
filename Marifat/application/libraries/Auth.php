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

class Auth {

    /**
     * The CodeIgniter super object
     *
     * @var object
     * @access public
     */
    public $CI;

    /**
     * Class constructor
     */
    public function __construct() {
        $this->CI = &get_instance();
        $this->CI->load->model(['m_users', 'm_user_privileges']);
    }

    /**
     * logged_in()
     * @access  public
     * @param   string
     * @param   string
     * @return  bool
     */
    public function logged_in($user_name, $user_password, $ip_address) {
        $login_attempts = $this->check_login_attempts($ip_address);
        if ($login_attempts) {
            $query = $this->CI->m_users->logged_in($user_name, $user_password);
            if ($query->num_rows() === 1) {
                $data = $query->row();
                if (password_verify($user_password, $data->user_password)) {
                    $session_data = [];
                    $session_data['id'] = $data->id;
                    $session_data['user_name'] = $data->user_name;
                    $session_data['user_full_name'] = $data->user_full_name;
                    $session_data['user_email'] = $data->user_email;
                    $session_data['user_url'] = $data->user_url;
                    $session_data['user_registered'] = $data->user_registered;
                    $session_data['user_group_id'] = $data->user_group_id;
                    $session_data['user_type'] = $data->user_type;
                    $session_data['profile_id'] = $data->profile_id;
                    $session_data['is_logged_in'] = true;
                    $session_data['user_privileges'] = $this->CI->m_user_privileges->module_by_user_group_id($data->user_group_id, $data->user_type);
                    $this->CI->session->set_userdata($session_data);
                    $this->last_logged_in($data->id);
                    return true;
                }
                return false;
            }
            $this->increase_login_attempts($ip_address);
            return false;
        }
        return false;
    }

    /**
     * get_user_id
     * @access  public
     * @return integer
     **/
    public function get_user_id() {
        $id = $this->session->userdata('id');
        return !empty($id) ? $id : null;
    }

    /**
     * last_logged_in
     * Fungsi untuk mengupdate data login terakhir
     * @access   public
     * @return   void
     */
    private function last_logged_in($id) {
        $this->CI->m_users->last_logged_in($id);
    }

    /**
     * is_logged_in
     * Fungsi untuk mengecek apakah data session user id kosong / tidak
     * @access   public
     * @return   bool
     */
    public function is_logged_in() {
        return $this->CI->session->userdata('is_logged_in');
    }

    /**
     * restrict
     * Fungsi untuk memvalidasi status login
     * @access   public
     * @return   bool
     */
    public function restrict() {
        if (!$this->is_logged_in()) {
            redirect('login');
        }
    }

    /**
     * check_login_attempts
     * Fungsi untuk mengecek apakah bisa login atau di blokir
     * @access   public
     * @return   void
     */
    public function check_login_attempts($ip_address) {
        $max_login_attempts = 3;
        $max_locked_time = 600; // locked at 30 minutes
        $login_attempts = $this->CI->m_users->check_login_attempts($ip_address);
        if ($login_attempts) {
            if ($login_attempts->counter >= $max_login_attempts) {
                $datetime = strtotime($login_attempts->datetime);
                $difference = time() - $datetime;
                if ($difference >= $max_locked_time) {
                    $this->clear_login_attempts($ip_address);
                    return TRUE;
                } else {
                    return FALSE;
                }
            }
            return TRUE;
        }
        return TRUE;
    }

    /**
     * create_login_attempts
     * Fungsi untuk menginputkan ip address ketika gagal login
     * @access   private
     * @return   void
     */
    private function increase_login_attempts($ip_address) {
        $this->CI->m_users->increase_login_attempts($ip_address);
    }

    /**
     * clear_login_attempts
     * Fungsi untuk menghapus data login attempts
     * @access   private
     * @return   void
     */
    private function clear_login_attempts($ip_address) {
        $this->CI->m_users->clear_login_attempts($ip_address);
    }
}