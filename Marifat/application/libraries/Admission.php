<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'third_party/tcpdf/tcpdf.php';

class Admission extends TCPDF {
	
	/**
	 * Constructor
	 * @access  public
	 */
	public function __construct() {
		parent::__construct('P', 'Cm', 'F4', true, 'UTF-8', false);
	}

	/**
	 * Overide Header
	 */
	public function Header() {

	}

	/**
	 * Overide Footer
	 */
	public function Footer() {
    	$content = '<table width="100%" border="0" cellpadding="3" cellspacing="0" style="border-top:1px solid #000000;">';
    	$content .= '<tbody>';
    	$content .= '<tr>';
    	$content .= '<td align="left" width="60%">Simpanlah lembar pendaftaran ini sebagai bukti pendaftaran Anda.</td>';
    	$content .= '<td align="right" width="40%">Dicetak tanggal '.indo_date(date('Y-m-d')).' pukul '.date('H:i:s').'</td>';
    	$content .= '</tr>';
    	$content .= '</tbody>';
    	$content .= '</table>';
    	$this->setY(-1);
    	$this->writeHTML($content, true, false, true, false, 'L');
	}

	/**
	 * Generating PDF
	 * @param 	Array
	 * @access 	public
	 */
	public function generating_pdf(array $result) {
		$CI = &get_instance();
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->SetAutoPageBreak(TRUE, 1);
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// Set Properties
		$this->SetTitle('FORMULIR PENERIMAAN '.(get_school_level() == 5 ? 'MAHASISWA' : 'PESERTA DIDIK').' BARU TAHUN '.$CI->session->userdata('admission_year'));	
		$this->SetAuthor('http://sekolahku.web.id');
		$this->SetSubject($CI->session->userdata('school_name'));
		$this->SetKeywords($CI->session->userdata('school_name'));
		$this->SetCreator('http://sekolahku.web.id');
		$this->SetMargins(2, 1, 2, true);
		$this->AddPage();
		$this->SetFont('freesans', '', 10);

		$school_level = get_school_level();
		$content = '';
		if ($school_level == 1) { // SD
			$content = file_get_contents(VIEWPATH.'admission/pdf_admission_template_1.html');
		} else if ($school_level == 2) { // SMP
			$content = file_get_contents(VIEWPATH.'admission/pdf_admission_template_2.html');
		} else if ($school_level == 3 || $school_level == 4) { // SMA / SMK
			$content = file_get_contents(VIEWPATH.'admission/pdf_admission_template_34.html');
		} else { // Perguruan Tinggi
			$content = file_get_contents(VIEWPATH.'admission/pdf_admission_template_5.html');
		}
		// Header
		$content = str_replace('[LOGO]', base_url('media_library/images/'.$CI->session->userdata('logo')), $content);
		$content = str_replace('[SCHOOL_NAME]', strtoupper($CI->session->userdata('school_name')), $content);
		$content = str_replace('[SCHOOL_STREET_ADDRESS]', $CI->session->userdata('street_address'), $content);
		$content = str_replace('[SCHOOL_PHONE]', $CI->session->userdata('phone'), $content);
		$content = str_replace('[SCHOOL_FAX]', $CI->session->userdata('fax'), $content);
		$content = str_replace('[SCHOOL_POSTAL_CODE]', $CI->session->userdata('postal_code'), $content);
		$content = str_replace('[SCHOOL_EMAIL]', $CI->session->userdata('email'), $content);
		$content = str_replace('[SCHOOL_WEBSITE]', str_replace(['http://', 'https://', 'www.'], '', $CI->session->userdata('website')), $content);
		$content = str_replace('[TITLE]', 'Formulir Penerimaan ' . (get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik').' Baru Tahun '.$CI->session->userdata('admission_year'), $content);
		// Registrasi Peserta Didik
		$content = str_replace('[STUDENT_TYPE]', ($school_level == 5 ? 'Mahasiswa' : 'Peserta Didik'), $content);
		$content = str_replace('[IS_TRANSFER]', ($result['is_transfer'] == 'true' ? 'Pindahan':'Baru'), $content);
		$content = str_replace('[REGISTRATION_NUMBER]', $result['registration_number'], $content);
		$content = str_replace('[CREATED_AT]', $result['created_at'], $content);
		if (in_array(get_school_level(), have_majors())) {
			$content = str_replace('[FIRST_CHOICE]', $result['first_choice'], $content);
			$content = str_replace('[SECOND_CHOICE]', $result['second_choice'], $content);
		}
		// Profile
		$content = str_replace('[FULL_NAME]', $result['full_name'], $content);
		$content = str_replace('[GENDER]', $result['gender'], $content);
		if (in_array(get_school_level(), [2, 3, 4])) {
			$content = str_replace('[NISN]', $result['nisn'], $content);
			$content = str_replace('[NIK]', $result['nik'], $content);
		}
		$content = str_replace('[BIRTH_PLACE]', $result['birth_place'], $content);
		$content = str_replace('[BIRTH_DATE]', $result['birth_date'], $content);
		$content = str_replace('[RELIGION]', $result['religion'], $content);
		$content = str_replace('[SPECIAL_NEEDS]', $result['special_needs'], $content);
		// Alamat
		$content = str_replace('[STREET_ADDRESS]', $result['street_address'], $content);
		$content = str_replace('[RT]', $result['rt'], $content);
		$content = str_replace('[RW]', $result['rw'], $content);
		$content = str_replace('[SUB_VILLAGE]', $result['sub_village'], $content);
		$content = str_replace('[VILLAGE]', $result['village'], $content);
		$content = str_replace('[SUB_DISTRICT]', $result['sub_district'], $content);
		$content = str_replace('[DISTRICT]', $result['district'], $content);
		$content = str_replace('[POSTAL_CODE]', $result['postal_code'], $content);
		$content = str_replace('[EMAIL]', $result['email'], $content);
		$content = str_replace('[FOOTER_DATE]', $result['district'].', '. indo_date(substr($result['created_at'], 0, 10)), $content);
		$content = str_replace('[FOOTER_FULL_NAME]', $result['full_name'], $content);
		$file_name = 'formulir-penerimaan-'. (get_school_level() == 5 ? 'mahasiswa' : 'peserta-didik').'-baru-tahun-'.$CI->session->userdata('admission_year');
		$file_name .= '-'.$result['birth_date'].'-'.$result['registration_number'].'.pdf';
		$this->writeHTML($content, true, false, true, false, 'C');
		$this->Output(FCPATH.'media_library/students/'.$file_name, 'F');
	}

	/**
	 * Generating PDF
	 * @param 	Array
	 * @access 	public
	 */
	public function blank_pdf() {
		$CI = &get_instance();
		$this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->SetAutoPageBreak(TRUE, 1);
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// Set Properties
		$this->SetTitle('FORMULIR PENERIMAAN '.(get_school_level() == 5 ? 'MAHASISWA' : 'PESERTA DIDIK').' BARU TAHUN '.$CI->session->userdata('admission_year'));	
		$this->SetAuthor('http://sekolahku.web.id');
		$this->SetSubject($CI->session->userdata('school_name'));
		$this->SetKeywords($CI->session->userdata('school_name'));
		$this->SetCreator('http://sekolahku.web.id');
		$this->SetMargins(2, 1, 2, true);
		$this->AddPage();
		$this->SetFont('freesans', '', 10);

		// Get HTML Template
		$content = file_get_contents(VIEWPATH.'admission/pdf_admission_template.html');
		// Header
		$content = str_replace('[LOGO]', base_url('media_library/images/'.$CI->session->userdata('logo')), $content);
		$content = str_replace('[SCHOOL_NAME]', strtoupper($CI->session->userdata('school_name')), $content);
		$content = str_replace('[SCHOOL_STREET_ADDRESS]', $CI->session->userdata('street_address'), $content);
		$content = str_replace('[SCHOOL_PHONE]', $CI->session->userdata('phone'), $content);
		$content = str_replace('[SCHOOL_FAX]', $CI->session->userdata('fax'), $content);
		$content = str_replace('[SCHOOL_POSTAL_CODE]', $CI->session->userdata('postal_code'), $content);
		$content = str_replace('[SCHOOL_EMAIL]', $CI->session->userdata('email'), $content);
		$content = str_replace('[SCHOOL_WEBSITE]', str_replace(['http://', 'https://', 'www.'], '', $CI->session->userdata('website')), $content);
		$content = str_replace('[TITLE]', 'Formulir Penerimaan ' . (get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik').' Baru Tahun '.$CI->session->userdata('admission_year'), $content);
		$dotted = '.................................................................................................................';
		$content = str_replace('[STUDENT_TYPE]', (get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik'), $content);
		$content = str_replace('[IS_TRANSFER]', $dotted, $content);
		$content = str_replace('[REGISTRATION_NUMBER]', $dotted, $content);
		$content = str_replace('[CREATED_AT]', $dotted, $content);
		// Registrasi Peserta Didik
		if (in_array(get_school_level(), have_majors())) {
			$content = str_replace('[FIRST_CHOICE]', $dotted, $content);
			$content = str_replace('[SECOND_CHOICE]', $dotted, $content);	
		} else {
			$replace = '<tr><td align="right">Pilihan I (Satu)</td><td align="center">:</td><td align="left">[FIRST_CHOICE]</td></tr>';
			$content = str_replace($replace, '', $content);
			$replace = '<tr><td align="right">Pilihan II (Dua)</td><td align="center">:</td><td align="left">[SECOND_CHOICE]</td></tr>';
			$content = str_replace($replace, '', $content);
		}
		
		// Profile
		$content = str_replace('[FULL_NAME]', $dotted, $content);
		$content = str_replace('[GENDER]', $dotted, $content);
		if (in_array(get_school_level(), [2, 3, 4])) {
			$content = str_replace('[NISN]', $dotted, $content);
			$content = str_replace('[NIK]', $dotted, $content);
		} else {
			$replace = '<tr><td align="right">NISN</td><td align="center">:</td><td align="left">[NISN]</td></tr>';
			$content = str_replace($replace, '', $content);
			$replace = '<tr><td align="right">NIK</td><td align="center">:</td><td align="left">[NIK]</td></tr>';
			$content = str_replace($replace, '', $content);
		}
		$content = str_replace('[BIRTH_PLACE]', $dotted, $content);
		$content = str_replace('[BIRTH_DATE]', $dotted, $content);
		$content = str_replace('[RELIGION]', $dotted, $content);
		$content = str_replace('[SPECIAL_NEEDS]', $dotted, $content);
		// Alamat
		$content = str_replace('[STREET_ADDRESS]', $dotted, $content);
		$content = str_replace('[RT]', $dotted, $content);
		$content = str_replace('[RW]', $dotted, $content);
		$content = str_replace('[SUB_VILLAGE]', $dotted, $content);
		$content = str_replace('[VILLAGE]', $dotted, $content);
		$content = str_replace('[SUB_DISTRICT]', $dotted, $content);
		$content = str_replace('[DISTRICT]', $dotted, $content);
		$content = str_replace('[POSTAL_CODE]', $dotted, $content);
		$content = str_replace('[EMAIL]', $dotted, $content);
		$content = str_replace('[FOOTER_DATE]', '.............................................., ............. .................................... ' . $CI->session->userdata('admission_year'), $content);
		$content = str_replace('[FOOTER_FULL_NAME]', '....................................................................', $content);
		$file_name = 'formulir-penerimaan-'. (get_school_level() == 5 ? 'mahasiswa' : 'peserta-didik').'-baru-tahun-'.$CI->session->userdata('admission_year');
		$file_name = strtoupper(str_replace(' ', '-', $file_name)).'.pdf';
		$this->writeHTML($content, true, false, true, false, 'C');
		$this->Output(__DIR__.'../../media_library/students/'.$file_name, 'I');
	}
}

/* End of file Admission.php */
/* Location: ./application/libraries/Admission.php */