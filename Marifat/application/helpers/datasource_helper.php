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

// Settings
if (! function_exists('general')) {
	function general() {
		return [
			[
				'group' => 'general',
				'variable' => 'site_maintenance',
				'default' => 'false',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Pemeliharaan situs'
			],
			[
				'group' => 'general',
				'variable' => 'site_maintenance_end_date',
				'default' => '2017-01-01',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tanggal Berakhir Pemeliharaan Situs'
			],
			[
				'group' => 'general',
				'variable' => 'site_cache',
				'default' => 'false',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Cache situs'
			],
			[
				'group' => 'general',
				'variable' => 'site_cache_time',
				'default' => 10,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Lama Cache Situs'
			],
			[
				'group' => 'general',
				'variable' => 'meta_description',
				'default' => 'CMS Sekolahku adalah Content Management System dan PPDB Online gratis untuk SD SMP/Sederajat SMA/Sederajat',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Deskripsi Meta'
			],
			[
				'group' => 'general',
				'variable' => 'meta_keywords',
				'default' => 'CMS, Website Sekolah Gratis, Cara Membuat Website Sekolah, membuat web sekolah, contoh website sekolah, fitur website sekolah, Sekolah, Website, Internet,Situs, CMS Sekolah, Web Sekolah, Website Sekolah Gratis, Website Sekolah, Aplikasi Sekolah, PPDB Online, PSB Online, PSB Online Gratis, Penerimaan Siswa Baru Online, Raport Online, Kurikulum 2013, SD, SMP, SMA, Aliyah, MTs, SMK',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Kata Kunci Meta'
			],
			[
				'group' => 'general',
				'variable' => 'google_map_api_key',
				'default' => '1234567890',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'API Key Google Map'
			],
			[
				'group' => 'general',
				'variable' => 'favicon',
				'default' => 'favicon.png',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Favicon'
			],
			[
				'group' => 'general',
				'variable' => 'header',
				'default' => 'header.png',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Gambar Header'
			]
		];
	}
}

if (! function_exists('media')) {
	function media() {
		return [
			[
				'group' => 'media',
				'variable' => 'file_allowed_types',
				'default' => 'jpg, jpeg, png, gif',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tipe file yang diizinkan'
			],
			[
				'group' => 'media',
				'variable' => 'upload_max_filesize',
				'default' => 0,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Maksimal Ukuran File yang Diupload'
			],
			[
				'group' => 'media',
				'variable' => 'thumbnail_size_height',
				'default' => 100,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Gambar Thumbnail'
			],
			[
				'group' => 'media',
				'variable' => 'thumbnail_size_width',
				'default' => 150,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Gambar Thumbnail'
			],
			[
				'group' => 'media',
				'variable' => 'medium_size_height',
				'default' => 308,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Gambar Sedang'
			],
			[
				'group' => 'media',
				'variable' => 'medium_size_width',
				'default' => 460,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Gambar Sedang'
			],
			[
				'group' => 'media',
				'variable' => 'large_size_height',
				'default' => 600,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Gambar Besar'
			],
			[
				'group' => 'media',
				'variable' => 'large_size_width',
				'default' => 800,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Gambar Besar'
			],
			[
				'group' => 'media',
				'variable' => 'album_cover_height',
				'default' => 250,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Cover Album Photo'
			],
			[
				'group' => 'media',
				'variable' => 'album_cover_width',
				'default' => 400,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Cover Album Photo'
			],
			[
				'group' => 'media',
				'variable' => 'banner_height',
				'default' => 81,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Iklan'
			],
			[
				'group' => 'media',
				'variable' => 'banner_width',
				'default' => 245,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Iklan'
			],
			[
				'group' => 'media',
				'variable' => 'image_slider_height',
				'default' => 400,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Gambar Slide'
			],
			[
				'group' => 'media',
				'variable' => 'image_slider_width',
				'default' => 900,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Gambar Slide'
			],
			[
				'group' => 'media',
				'variable' => 'student_photo_height',
				'default' => 170,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tinggi Photo Peserta Didik'
			],
			[
				'group' => 'media',
				'variable' => 'student_photo_width',
				'default' => 113,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Lebar Photo Peserta Didik'
			],
			[
				'group' => 'media',
				'variable' => 'employee_photo_height',
				'default' => 170,
				'group_access' => 'employee, administrator, super_user',
				'description' => 'Tinggi Photo Guru dan Tenaga Kependidikan'
			],
			[
				'group' => 'media',
				'variable' => 'employee_photo_width',
				'default' => 113,
				'group_access' => 'employee, administrator, super_user',
				'description' => 'Lebar Photo Guru dan Tenaga Kependidikan'
			],
			[
				'group' => 'media',
				'variable' => 'headmaster_photo_height',
				'default' => 170,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Photo Kepala Sekolah'
			],
			[
				'group' => 'media',
				'variable' => 'headmaster_photo_width',
				'default' => 113,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Photo Kepala Sekolah'
			],
			[
				'group' => 'media',
				'variable' => 'header_height',
				'default' => 80,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Gambar Header'
			],
			[
				'group' => 'media',
				'variable' => 'header_width',
				'default' => 200,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Gambar Header'
			],
			[
				'group' => 'media',
				'variable' => 'logo_height',
				'default' => 120,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Logo Sekolah'
			],
			[
				'group' => 'media',
				'variable' => 'logo_width',
				'default' => 120,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Logo Sekolah'
			]
		];
	}
}

if (! function_exists('writing')) {
	function writing() {
		return [
			[
				'group' => 'writing',
				'variable' => 'default_post_category',
				'default' => 1,
				'group_access' => 'administrator, super_user',
				'description' => 'Default Kategori Tulisan'
			],
			[
				'group' => 'writing',
				'variable' => 'default_post_status',
				'default' => 'publish',
				'group_access' => 'administrator, super_user',
				'description' => 'Default Status Tulisan'
			],
			[
				'group' => 'writing',
				'variable' => 'default_post_visibility',
				'default' => 'public',
				'group_access' => 'administrator, super_user',
				'description' => 'Default Akses Tulisan'
			],
			[
				'group' => 'writing',
				'variable' => 'default_post_discussion',
				'default' => 'open',
				'group_access' => 'administrator, super_user',
				'description' => 'Default Komentar Tulisan'
			],
			[
				'group' => 'writing',
				'variable' => 'post_image_thumbnail_height',
				'default' => 100,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Gambar Kecil'
			],
			[
				'group' => 'writing',
				'variable' => 'post_image_thumbnail_width',
				'default' => 150,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Gambar Kecil'
			],
			[
				'group' => 'writing',
				'variable' => 'post_image_medium_height',
				'default' => 250,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Gambar Sedang'
			],
			[
				'group' => 'writing',
				'variable' => 'post_image_medium_width',
				'default' => 400,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Gambar Sedang'
			],
			[
				'group' => 'writing',
				'variable' => 'post_image_large_height',
				'default' => 450,
				'group_access' => 'administrator, super_user',
				'description' => 'Tinggi Gambar Besar'
			],
			[
				'group' => 'writing',
				'variable' => 'post_image_large_width',
				'default' => 840,
				'group_access' => 'administrator, super_user',
				'description' => 'Lebar Gambar Besar'
			],
		];
	}
}

if (! function_exists('reading')) {
	function reading() {
		return [
			[
				'group' => 'reading',
				'variable' => 'post_per_page',
				'default' => 10,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tulisan per halaman'
			],
			[
				'group' => 'reading',
				'variable' => 'post_rss_count',
				'default' => 10,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Jumlah RSS'
			],
			[
				'group' => 'reading',
				'variable' => 'post_related_count',
				'default' => 10,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Jumlah Tulisan Terkait'
			],
			[
				'group' => 'reading',
				'variable' => 'comment_per_page',
				'default' => 10,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Komentar per halaman'
			]
		];
	}
}

if (! function_exists('discussion')) {
	function discussion() {
		return [
			[
				'group' => 'discussion',
				'variable' => 'comment_moderation',
				'default' => 'false',
				'group_access' => 'administrator, super_user',
				'description' => 'Komentar harus disetujui secara manual'
			],
			[
				'group' => 'discussion',
				'variable' => 'comment_registration',
				'default' => 'false',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Pengguna harus terdaftar dan login untuk komentar'
			],
			[
				'group' => 'discussion',
				'variable' => 'comment_blacklist',
				'default' => 'kampret',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Komentar disaring'
			],
			[
				'group' => 'discussion',
				'variable' => 'comment_order',
				'default' => 'asc',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Urutan Komentar'
			]
		];
	}
}

if (! function_exists('social_account')) {
	function social_account() {
		return [
			[
				'group' => 'social_account',
				'variable' => 'facebook',
				'default' => 'https://www.facebook.com/cmssekolahku/',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Facebook'
			],
			[
				'group' => 'social_account',
				'variable' => 'twitter',
				'default' => 'https://twitter.com/antonsofyan',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Twitter'
			],
			[
				'group' => 'social_account',
				'variable' => 'google_plus',
				'default' => 'google.com/+AntonSofyan',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Google Plus'
			],
			[
				'group' => 'social_account',
				'variable' => 'linked_in',
				'default' => 'https://www.linkedin.com/in/anton-sofyan-1428937a/',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Linked In'
			],
			[
				'group' => 'social_account',
				'variable' => 'youtube',
				'default' => '-',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Youtube'
			],
			[
				'group' => 'social_account',
				'variable' => 'instagram',
				'default' => 'https://www.instagram.com/anton_sofyan/',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Instagram'
			]
		];
	}
}

if (! function_exists('mail_server')) {
	function mail_server() {
		return [
			[
				'group' => 'mail_server',
				'variable' => 'mail_server_protocol',
				'default' => 'smpt',
				'group_access' => 'administrator, super_user',
				'description' => 'Mail Server Protocol'
			],
			[
				'group' => 'mail_server',
				'variable' => 'mail_server_hostname',
				'default' => 'ssl://smtp.gmail.com',
				'group_access' => 'administrator, super_user',
				'description' => 'Mail Server Hostname'
			],
			[
				'group' => 'mail_server',
				'variable' => 'mail_server_username',
				'default' => 'admin',
				'group_access' => 'administrator, super_user',
				'description' => 'Mail Server Username'
			],
			[
				'group' => 'mail_server',
				'variable' => 'mail_server_password',
				'default' => 'admin',
				'group_access' => 'administrator, super_user',
				'description' => 'Mail Server Password'
			],
			[
				'group' => 'mail_server',
				'variable' => 'mail_server_port',
				'default' => 465,
				'group_access' => 'administrator, super_user',
				'description' => 'Mail Server Port'
			]
		];
	}
}

if (! function_exists('admission')) {
	function admission() {
		return [
			[
				'group' => 'admission',
				'variable' => 'admission_status',
				'default' => 'open',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Status Penerimaan Peserta Didik Baru'
			],
			[
				'group' => 'admission',
				'variable' => 'admission_year',
				'default' => date('Y'),
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tahun Penerimaan Peserta Didik Baru'
			],
			[
				'group' => 'admission',
				'variable' => 'admission_start_date',
				'default' => '2017-01-01',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tanggal Mulai PPDB'
			],
			[
				'group' => 'admission',
				'variable' => 'admission_end_date',
				'default' => '2017-12-31',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tanggal Selesai PPDB'
			],
			[
				'group' => 'admission',
				'variable' => 'announcement_start_date',
				'default' => '2017-01-01',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tanggal Mulai Pengumuman Hasil Seleksi PPDB'
			],
			[
				'group' => 'admission',
				'variable' => 'announcement_end_date',
				'default' => '2017-12-31',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Tanggal Selesai Pengumuman Hasil Seleksi PPDB'
			]			
		];
	}
}

if (! function_exists('school_profile')) {
	function school_profile() {
		return [
			[
				'group' => 'school_profile',
				'variable' => 'npsn',
				'default' => 123,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'NPSN'
			],
			[
				'group' => 'school_profile',
				'variable' => 'school_name',
				'default' => 'SMA Negeri 9 Kuningan',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Nama Sekolah'
			],
			[
				'group' => 'school_profile',
				'variable' => 'headmaster',
				'default' => 'Anton Sofyan',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Kepala Sekolah'
			],
			[
				'group' => 'school_profile',
				'variable' => 'headmaster_photo',
				'default' => 'headmaster_photo.png',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Photo Kepala Sekolah'
			],
			[
				'group' => 'school_profile',
				'variable' => 'school_level',
				'default' => 3,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Bentuk Pendidikan'
			],
			[
				'group' => 'school_profile',
				'variable' => 'school_status',
				'default' => 1,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Status Sekolah'
			],
			[
				'group' => 'school_profile',
				'variable' => 'ownership_status',
				'default' => 1,
				'group_access' => 'administrator, super_user',
				'description' => 'Status Kepemilikan'
			],
			[
				'group' => 'school_profile',
				'variable' => 'decree_operating_permit',
				'default' => '-',
				'group_access' => 'administrator, super_user',
				'description' => 'SK Izin Operasional'
			],
			[
				'group' => 'school_profile',
				'variable' => 'decree_operating_permit_date',
				'default' => date('Y-m-d'),
				'group_access' => 'administrator, super_user',
				'description' => 'Tanggal SK Izin Operasional'
			],
			[
				'group' => 'school_profile',
				'variable' => 'tagline',
				'default' => 'Where Tomorrow\'s Leaders Come Together',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Slogan'
			],
			[
				'group' => 'school_profile',
				'variable' => 'rt',
				'default' => 12,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'RT'
			],
			[
				'group' => 'school_profile',
				'variable' => 'rw',
				'default' => '06',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'RW'
			],
			[
				'group' => 'school_profile',
				'variable' => 'sub_village',
				'default' => 'Wage',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Dusun'
			],
			[
				'group' => 'school_profile',
				'variable' => 'village',
				'default' => 'Kadugede',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Kelurahan / Desa'
			],
			[
				'group' => 'school_profile',
				'variable' => 'sub_district',
				'default' => 'Kadugede',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Kecamatan'
			],
			[
				'group' => 'school_profile',
				'variable' => 'district',
				'default' => 'Kuningan',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Kabupaten'
			],
			[
				'group' => 'school_profile',
				'variable' => 'postal_code',
				'default' => 45561,
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Kode Pos'
			],
			[
				'group' => 'school_profile',
				'variable' => 'street_address',
				'default' => 'Jalan Raya Kadugede No. 11',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Alamat Jalan'
			],
			[
				'group' => 'school_profile',
				'variable' => 'latitude',
				'default' => '1234567890',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Latitude'
			],
			[
				'group' => 'school_profile',
				'variable' => 'longitude',
				'default' => '1234567890',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Longitude'
			],
			[
				'group' => 'school_profile',
				'variable' => 'phone',
				'default' => '0232123456',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Telepon'
			],
			[
				'group' => 'school_profile',
				'variable' => 'fax',
				'default' => '0232123456',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Fax'
			],
			[
				'group' => 'school_profile',
				'variable' => 'email',
				'default' => 'info@sman9kuningan.sch.id',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Email'
			],
			[
				'group' => 'school_profile',
				'variable' => 'website',
				'default' => 'http://www.sman9kuningan.sch.id',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Website'
			],
			[
				'group' => 'school_profile',
				'variable' => 'logo',
				'default' => 'logo.png',
				'group_access' => 'public, student, employee, administrator, super_user',
				'description' => 'Logo'
			]
		];
	}
}

// Options

if (! function_exists('student_status')) {
	function student_status() {
		return [
			'Aktif',
			'Lulus',
			'Mutasi',
			'Dikeluarkan',
			'Mengundurkan Diri',
			'Putus Sekolah',
			'Meninggal',
			'Hilang',
			'Lainnya'
		];
	}
}

if (! function_exists('employment')) {
	function employment() {
		return [
			'Tidak bekerja', 
			'Nelayan', 
			'Petani', 
			'Peternak', 
			'PNS/TNI/POLRI', 
			'Karyawan Swasta', 
			'Pedagang Kecil', 
			'Pedagang Besar',
			'Wiraswasta', 
			'Wirausaha', 
			'Buruh', 
			'Pensiunan', 
			'Lain-lain'
		];
	}
}

if (! function_exists('special_needs')) {
	function special_needs() {
		return [
			'Tidak',
			'Tuna Netra', 
			'Tuna Rungu', 
			'Tuna Grahita ringan', 
			'Tuna Grahita Sedang', 
			'Tuna Daksa Ringan', 
			'Tuna Daksa Sedang', 
			'Tuna Laras',
			'Tuna Wicara', 
			'Tuna ganda',
			'Hiper aktif',
			'Cerdas Istimewa',
			'Bakat Istimewa',
			'Kesulitan Belajar',
			'Narkoba',
			'Indigo',
			'Down Sindrome', 
			'Autis',
			'Lainnya'
		];
	}
}

if (! function_exists('education')) {
	function education() {
		return [
			'Tidak sekolah', 
			'Putus SD', 
			'SD Sederajat', 
			'SMP Sederajat', 
			'SMA Sederajat', 
			'D1', 
			'D2', 
			'D3', 
			'D4/S1', 
			'S2', 
			'S3'
		];
	}
}

if (! function_exists('scholarship')) {
	function scholarship() {
		return [
			'Anak berprestasi', 
			'Anak Miskin', 
			'Pendidikan', 
			'Unggulan', 
			'Lain-lain'
		];
	}
}

if (! function_exists('achievement_type')) {
	function achievement_type() {
		return [
			'Sains', 
			'Seni', 
			'Olahraga', 
			'Lain-lain'
		];
	}
}

if (! function_exists('achievement_level')) {
	function achievement_level() {
		return [
			'Sekolah', 
			'Kecamatan', 
			'Kabupaten', 
			'Provinsi',
			'Nasional',
			'Internasional'
		];
	}
}

if (! function_exists('monthly_income')) {
	function monthly_income() {
		return [
			'Kurang dari 500,000', 
			'500.000 - 999.9999', 
			'1 Juta - 1.999.999', 
			'2 Juta - 4.999.999',
			'5 Juta - 20 Juta',
			'Lebih dari 20 Juta'
		];
	}
}

if (! function_exists('residence')) {
	function residence() {
		return [
			'Bersama orang tua', 
			'Wali',
			'Kos',
			'Asrama',
			'Panti Asuhan',
			'Lainnya'
		];
	}
}

if (! function_exists('transportation')) {
	function transportation() {
		return [
			'Jalan kaki', 
			'Kendaraan pribadi',
			'Kendaraan Umum / angkot / Pete-pete',
			'Jemputan Sekolah',
			'Kereta Api',
			'Ojek',
			'Andong / Bendi / Sado / Dokar / Delman / Beca',
			'Perahu penyebrangan / Rakit / Getek',
			'Lainnya'
		];
	}
}

if (! function_exists('religion')) {
	function religion() {
		return [
			'Islam', 
			'kristen / protestan',
			'Katholik',
			'Hindu',
			'Budha',
			'Khong Hu Chu',
			'Lainnya'
		];
	}
}

/**
 * Jenjang Sekolah
 */
if (! function_exists('school_level')) {
	function school_level() {
		// 01) SD; 02)SMP; 03)SDLB; 04)SMPLB; 5) SLB 6) SMP Terbuka
		return [
			'1 - Sekolah Dasar (SD)/ Sederajat', // SD
			'2 - Sekolah Menengah Pertama (SMP)/ Sederajat', // SMP
			'3 - Sekolah Menengah Atas (SMA) / Aliyah', // SMA
			'4 - Sekolah Menengah Kejuruan (SMK)', // SMK
			'5 - Perguruan Tinggi' // Universitas
		];
	}
}

/**
 * Marital Status
 */
if (! function_exists('marital_status')) {
	function marital_status() {
		return [
			'Kawin',
			'Belum Kawin',
			'Berpisah'
		];
	}
}

/**
 * Lembaga Pengangkat
 */
if (! function_exists('institutions_lifter')) {
	function institutions_lifter() {
		return [
			'Pemerintah Pusat', 
			'Pemerintah Provinsi',
			'Pemerintah Kab/Kota',
			'Ketua yaysan',
			'Kepala Sekolah',
			'Komite Sekolah',
			'Lainnya'
		];
	}
}

/**
 * Lembaga Pengangkat
 */
if (! function_exists('employment_status')) {
	function employment_status() {
		return [
			'PNS ',
			'PNS Diperbantukan ',
			'PNS DEPAG ',
			'GTY/PTY ',
			'GTT/PTT Provinsi ',
			'GTT/PTT Kabupaten/Kota',
			'Guru Bantu Pusat ',
			'Guru Honor Sekolah ',
			'Tenaga Honor Sekolah ',
			'CPNS',
			'Lainnya'
		];
	}
}

/**
 * Jenis Pendidik dan Tenaga Kependidikan (GTK)
 */
if (! function_exists('employment_type')) {
	function employment_type() {
		return [
			'Guru Kelas',
			'Guru Mata Pelajaran',
			'Guru BK',
			'Guru Inklusi',
			'Tenaga Administrasi Sekola',
			'Gurtu Pendamping',
			'Guru Magang',
			'Guru TIK',
			'Laboran',
			'Pustakawan',
			'Lainnya'
		];
	}
}

/**
 * Golongan
 */
if (! function_exists('rank')) {
	function rank() {
		return [
			'I/A',
			'I/B',
			'I/C',
			'I/D',
			'II/A',
			'II/B',
			'II/C',
			'II/D',
			'III/A',
			'III/B',
			'III/C',
			'III/D',
			'IV/A',
			'IV/B',
			'IV/C',
			'IV/D',
			'IV/E'
		];
	}
}

/**
 * Sumber Gaji
 */
if (! function_exists('salary_source')) {
	function salary_source() {
		return [
			'APBN',
			'APBD Provinsi',
			'APBD Kab/Kota',
			'Yaysan',
			'Sekolah',
			'Lembaga Donor',
			'Lainnya'
		];
	}
}

/**
 * Keahlian Laboratorium
 */
if (! function_exists('skills_laboratory')) {
	function skills_laboratory() {
		return [
			'Lab IPA',
			'Lab Fisika',
			'Lab Biologi',
			'Lab Kimia',
			'Lab Bahasa',
			'Lab Komputer',
			'Teknik Bangunan',
			'Teknik Serveai & Pemetaan',
			'Teknik Ketenagakerjaan',
			'Teknik Pendidnginan & Tata Udara', 
			'Teknik Mesin'
		];
	}
}

if (! function_exists('modules')) {
	function modules($key = '') {
		$CI = &get_instance();
		$modules = [
			'hubungi-kami' => 'Hubungi Kami',
			'gallery-photo' => 'Gallery Photo',
			'gallery-video' => 'Gallery Video',
			'student-directory' => 'Direktori Peserta Didik',
			'employee-directory' => 'Direktori Guru dan Tenaga Kependidikan',
			'alumni-directory' => 'Direktori Alumni'
		];
		
		// '1': 'Elementary School (SD / Sederajat)', // SD
		// '2': 'Junior High school (SMP / Sederajat)', // SMP
		// '3': 'Senior High School (SMA / Sederajat)', // SMA
		// '4': 'Vocational High School (SMK)', // SMK
		// '5': 'University (Universitas)'

		if ($CI->session->userdata('school_level') == 5) {
			$modules['formulir-penerimaan-mahasiswa-baru'] = 'Formulir Penerimaan Mahasiswa Baru';
			$modules['hasil-seleksi-penerimaan-mahasiswa-baru'] = 'Hasil Seleksi Penerimaan Mahasiswa Baru';
			$modules['cetak-formulir-penerimaan-mahasiswa-baru'] = 'Cetak Formulir Penerimaan Mahasiswa Baru';
			$modules['download-formulir-penerimaan-mahasiswa-baru'] = 'Download Formulir Penerimaan Mahasiswa Baru';
		} else {
			$modules['formulir-penerimaan-peserta-didik-baru'] = 'Formulir Penerimaan Peserta Didik Baru';
			$modules['hasil-seleksi-penerimaan-peserta-didik-baru'] = 'Hasil Seleksi Penerimaan Peserta Didik Baru';
			$modules['cetak-formulir-penerimaan-peserta-didik-baru'] = 'Cetak Formulir Penerimaan Peserta Didik Baru';
			$modules['download-formulir-penerimaan-peserta-didik-baru'] = 'Download Formulir Penerimaan Peserta Didik Baru';
		}
		return $key == '' ? $modules : $modules[$key];
	}
}