<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['hubungi-kami'] = 'public/contact_us';
$route['hubungi-kami/save'] = 'public/contact_us/save';
$route['read/(:num)/(:any)'] = 'public/readmore';
$route['feed'] = 'public/feed';
$route['sambutan-kepala-sekolah'] = 'public/sambutan_kepala_sekolah';
$route['gallery-photo'] = 'public/gallery_photos';
$route['gallery-video'] = 'public/gallery_videos';
$route['category/(:any)'] = 'public/post_categories';
$route['archives/([0-9]{4})/([0-9]{2})'] = 'public/archives';
$route['tag/(:any)'] = 'public/post_tags';
$route['download/(:any)'] = 'public/download';
$route['download/force_download/(:num)'] = 'public/download/force_download';
$route['hasil-jajak-pendapat'] = 'public/pollings/result';
$route['hasil-pencarian'] = 'public/search';
$route['under-construction'] = 'public/under_construction';
$route['login'] = 'public/login';
$route['login/(:any)'] = 'public/login/process';
$route['logout'] = 'public/logout';
$route['lost-password'] = 'public/lost_password';
$route['lost-password/process'] = 'public/lost_password/process';
$route['reset-password/(:any)'] = 'public/reset_password';
$route['reset-password-process'] = 'public/reset_password/process';
$route['student-directory'] = 'public/student_directory';
$route['employee-directory'] = 'public/employee_directory';
$route['alumni-directory'] = 'public/alumni_directory';

// PPDB
$route['formulir-penerimaan-peserta-didik-baru'] = 'public/admission_form';
$route['hasil-seleksi-penerimaan-peserta-didik-baru'] = 'public/admission_selection_results';
$route['cetak-formulir-penerimaan-peserta-didik-baru'] = 'public/print_admission_form';
$route['pdf-formulir-penerimaan-peserta-didik-baru/([0-9]{4})-([0-9]{2})-([0-9]{2})/([0-9]{9})'] = 'public/admission_form/generate_pdf';
$route['download-formulir-penerimaan-peserta-didik-baru'] = 'public/blank_registration_form';

// PMB
$route['formulir-penerimaan-mahasiswa-baru'] = 'public/admission_form';
$route['hasil-seleksi-penerimaan-mahasiswa-baru'] = 'public/admission_selection_results';
$route['cetak-formulir-penerimaan-mahasiswa-baru'] = 'public/print_admission_form';
$route['pdf-formulir-penerimaan-mahasiswa-baru/([0-9]{4})-([0-9]{2})-([0-9]{2})/([0-9]{9})'] = 'public/admission_form/generate_pdf';
$route['download-formulir-penerimaan-mahasiswa-baru'] = 'public/blank_registration_form';

$route['default_controller'] = 'home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
