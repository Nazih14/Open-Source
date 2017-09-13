<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<section class="sidebar">
	<ul class="sidebar-menu">
		
		<?php if (in_array('dashboard', $this->session->userdata('user_privileges'))) { ?>
			<li class="<?=isset($dashboard) ? 'active':'';?>">
				<a href="<?=site_url('dashboard');?>">
					<i class="fa fa-dashboard"></i> <span>Beranda</span>
				</a>
			</li>
		<?php } ?>

		<li>
			<a href="<?=base_url();?>" target="_blank">
				<i class="fa fa-rocket"></i> <span>Lihat Situs</span>
			</a>
		</li>
		
		<!-- @namespace Employee Menu -->
		<?php if ($this->session->userdata('user_type') === 'employee' && in_array('employee_profile', $this->session->userdata('user_privileges'))) { ?>
			<li class="<?=isset($employee_profile) ? 'active':'';?>">
				<a href="<?=site_url('employee_profile');?>">
					<i class="fa fa-user"></i> <span>Profil</span>
				</a>
			</li>
		<?php } ?>

		<!-- @namespace Student Menu -->
		<?php if ($this->session->userdata('user_type') === 'student' && in_array('student_profile', $this->session->userdata('user_privileges'))) { ?>
			<li class="<?=isset($student_profile) ? 'active':'';?>">
				<a href="<?=site_url('student_profile');?>">
					<i class="fa fa-edit"></i> <span>Profil</span>
				</a>
			</li>
			<li class="<?=isset($achievements) ? 'active':'';?>">
				<a href="<?=site_url('achievements');?>">
					<i class="fa fa-trophy"></i> <span>Prestasi</span>
				</a>
			</li>
			<li class="<?=isset($scholarships) ? 'active':'';?>">
				<a href="<?=site_url('scholarships');?>">
					<i class="fa fa-money"></i> <span>Beasiswa</span>
				</a>
			</li>
		<?php } ?>

		<!-- @namespace Administrator Menu -->
		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('blog', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview <?=isset($blog) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-edit"></i> <span>Blog</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">				
					<li <?=isset($image_sliders) ? 'class="active"':'';?>><a href="<?=site_url('blog/image_sliders');?>"><i class="fa fa-picture-o"></i> Gambar Slide</a></li>
					<li <?=isset($messages) ? 'class="active"':'';?>><a href="<?=site_url('blog/messages');?>"><i class="fa fa-envelope-o"></i> Pesan Masuk</a></li>
					<li <?=isset($links) ? 'class="active"':'';?>><a href="<?=site_url('blog/links');?>"><i class="fa fa-link"></i> Tautan</a></li>	
					<li <?=isset($pages) ? 'class="active"':'';?>><a href="<?=site_url('blog/pages');?>"><i class="fa fa-file-o"></i> Halaman</a></li>
					<li <?=isset($posts) ? 'class="active"':'';?>>
						<a href="#"><i class="fa fa-file-text-o"></i> Tulisan <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li <?=isset($all_posts) ? 'class="active"':'';?>><a href="<?=site_url('blog/posts');?>"><i class="fa fa-navicon"></i> Semua Tulisan</a></li>
							<li <?=isset($post_create) ? 'class="active"':'';?>><a href="<?=site_url('blog/posts/create');?>"><i class="fa fa-pencil"></i> Tambah Baru</a></li>
							<li <?=isset($post_categories) ? 'class="active"':'';?>><a href="<?=site_url('blog/post_categories');?>"><i class="fa fa-list-ul"></i> Kategori Tulisan</a></li>
							<li <?=isset($post_comments) ? 'class="active"':'';?>><a href="<?=site_url('blog/post_comments');?>"><i class="fa fa-comments-o"></i> Komentar</a></li>
							<li <?=isset($tags) ? 'class="active"':'';?>><a href="<?=site_url('blog/tags');?>"><i class="fa fa-tags"></i> Tags</a></li>
						</ul>
					</li>
					<li <?=isset($quotes) ? 'class="active"':'';?>><a href="<?=site_url('blog/quotes');?>"><i class="fa fa-quote-right"></i> Kutipan</a></li>
					<li <?=isset($welcome) ? 'class="active"':'';?>><a href="<?=site_url('blog/welcome');?>"><i class="fa fa-bullhorn"></i> Sambutan Kepala Sekolah</a></li>
					<li <?=isset($subscribers) ? 'class="active"':'';?>><a href="<?=site_url('blog/subscribers');?>"><i class="fa fa-folder-open-o"></i> Subscribers</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('reference', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview <?=isset($reference) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-chevron-circle-right"></i> <span>Data Referensi</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?=isset($academic_years) ? 'class="active"':'';?>><a href="<?=site_url('reference/academic_years');?>"><i class="fa fa-chevron-circle-right"></i> Tahun Akademik</a></li>
					<li <?=isset($special_needs) ? 'class="active"':'';?>><a href="<?=site_url('reference/special_needs');?>"><i class="fa fa-chevron-circle-right"></i> Kebutuhan Khusus</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('students', $this->session->userdata('user_privileges'))) { ?>	
			<li class="treeview <?=isset($students) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-user-plus"></i> <span><?=get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik' ?></span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?=isset($all_students) ? 'class="active"':'';?>><a href="<?=site_url('students/students');?>"><i class="fa fa-smile-o"></i> Semua <?=get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik' ?></a></li>
					<li <?=isset($alumni) ? 'class="active"':'';?>><a href="<?=site_url('students/alumni');?>"><i class="fa fa-smile-o"></i> Alumni</a></li>
					<li <?=isset($chart_students) ? 'class="active"':'';?>><a href="<?=site_url('students/chart');?>"><i class="fa fa-bar-chart"></i> Grafik</a></li>
					<li <?=isset($class_group_settings) ? 'class="active"':'';?>><a href="<?=site_url('students/class_group_settings');?>"><i class="fa fa-cogs"></i> Pengaturan Kelas</a></li>
					<li <?=isset($student_reference) ? 'class="active"':'';?>>
						<a href="#"><i class="fa fa-chevron-circle-right"></i> Data Referensi <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li <?=isset($class_groups) ? 'class="active"':'';?>><a href="<?=site_url('students/class_groups');?>"><i class="fa fa-chevron-circle-right"></i> Kelas</a></li>
							<li <?=isset($educations) ? 'class="active"':'';?>><a href="<?=site_url('students/educations');?>"><i class="fa fa-chevron-circle-right"></i> Pendidikan</a></li>
							<?php if (in_array(get_school_level(), have_majors())) { ?>
								<li <?=isset($majors) ? 'class="active"':'';?>><a href="<?=site_url('students/majors');?>"><i class="fa fa-chevron-circle-right"></i> Program Keahlian</a></li>
							<?php } ?>
							<li <?=isset($monthly_income) ? 'class="active"':'';?>><a href="<?=site_url('students/monthly_income');?>"><i class="fa fa-chevron-circle-right"></i> Penghasilan Orang Tua</a></li>
							<li <?=isset($residence) ? 'class="active"':'';?>><a href="<?=site_url('students/residence');?>"><i class="fa fa-chevron-circle-right"></i> Tempat Tinggal</a></li>
							<li <?=isset($student_status) ? 'class="active"':'';?>><a href="<?=site_url('students/student_status');?>"><i class="fa fa-chevron-circle-right"></i> Status <?=get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik' ?></a></li>
							<li <?=isset($transportations) ? 'class="active"':'';?>><a href="<?=site_url('students/transportations');?>"><i class="fa fa-chevron-circle-right"></i> Moda Transportasi</a></li>
						</ul>
					</li>
					<li <?=isset($import_students) ? 'class="active"':'';?>><a href="<?=site_url('students/import');?>"><i class="fa fa-upload"></i> Import <?=get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik' ?></a></li>
					<li <?=isset($class_group_students) ? 'class="active"':'';?>><a href="<?=site_url('students/class_group_students');?>"><i class="fa fa-vcard"></i> Rombongan Belajar</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('employees', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview <?=isset($employees) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-user-plus"></i> <span><?=get_school_level() == 5 ? 'Staff dan Dosen' : 'GTK' ?></span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?=isset($all_employees) ? 'class="active"':'';?>><a href="<?=site_url('employees/employees');?>"><i class="fa fa-smile-o"></i> <?=get_school_level() == 5 ? 'Semua Staff dan Dosen' : 'Semua GTK' ?></a></li>
					<li <?=isset($employee_reference) ? 'class="active"':'';?>>
						<a href="#"><i class="fa fa-chevron-circle-right"></i> Data Referensi <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li <?=isset($employment) ? 'class="active"':'';?>><a href="<?=site_url('employees/employment');?>"><i class="fa fa-chevron-circle-right"></i> Pekerjaan Suami / Istri</a></li>
							<li <?=isset($employment_status) ? 'class="active"':'';?>><a href="<?=site_url('employees/employment_status');?>"><i class="fa fa-chevron-circle-right"></i> Status Kepegawaian</a></li>
							<li <?=isset($employment_types) ? 'class="active"':'';?>><a href="<?=site_url('employees/employment_types');?>"><i class="fa fa-chevron-circle-right"></i> Jenis <?=get_school_level() == 5 ? 'Staff dan Dosen' : 'GTK' ?></a></li>
							<li <?=isset($institutions_lifter) ? 'class="active"':'';?>><a href="<?=site_url('employees/institutions_lifter');?>"><i class="fa fa-chevron-circle-right"></i> Lembaga Pengangkat</a></li>
							<li <?=isset($ranks) ? 'class="active"':'';?>><a href="<?=site_url('employees/ranks');?>"><i class="fa fa-chevron-circle-right"></i> Pangkat / Golongan</a></li>
							<li <?=isset($salary_sources) ? 'class="active"':'';?>><a href="<?=site_url('employees/salary_sources');?>"><i class="fa fa-chevron-circle-right"></i> Sumber Gaji</a></li>
							<li <?=isset($skills_laboratory) ? 'class="active"':'';?>><a href="<?=site_url('employees/skills_laboratory');?>"><i class="fa fa-chevron-circle-right"></i> Keahlian Laboratorium</a></li>
						</ul>
					</li>
					<li <?=isset($import_employees) ? 'class="active"':'';?>><a href="<?=site_url('employees/import');?>"><i class="fa fa-upload"></i> Import <?=get_school_level() == 5 ? 'Staff dan Dosen' : 'GTK' ?></a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('admission', $this->session->userdata('user_privileges'))) { ?>	
			<li class="treeview <?=isset($admission) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-street-view"></i> <span><?=get_school_level() == 5 ? 'PMB' : 'PPDB'?> <?=NULL !== $this->session->userdata('admission_year') ? $this->session->userdata('admission_year') : date('Y');?> </span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?=isset($phases) ? 'class="active"':'';?>><a href="<?=site_url('admission/phases');?>"><i class="fa fa-calendar"></i> Gelombang Pendaftaran</a></li>
					<li <?=isset($quotas) ? 'class="active"':'';?>><a href="<?=site_url('admission/quotas');?>"><i class="fa fa-filter"></i> Kuota Pendaftaran</a></li>
					<li <?=isset($registrants) ? 'class="active"':'';?>><a href="<?=site_url('admission/registrants');?>"><i class="fa fa-smile-o"></i> Semua Pendaftar</a></li>
					<li <?=isset($selection_process) ? 'class="active"':'';?>><a href="<?=site_url('admission/selection_process');?>"><i class="fa fa-hourglass-start"></i> Proses Seleksi</a></li>
					<li <?=isset($registrants_approved) ? 'class="active"':'';?>><a href="<?=site_url('admission/registrants_approved');?>"><i class="fa fa-check-circle-o"></i> Pendaftar Diterima</a></li>
					<li <?=isset($registrants_unapproved) ? 'class="active"':'';?>><a href="<?=site_url('admission/registrants_unapproved');?>"><i class="fa fa-remove"></i> Pendaftar Tidak Diterima</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('plugins', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview <?=isset($plugins) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-plug"></i> <span>Plugins</span> <i class="fa fa-angle-left pull-right"></i>
				</a>			
				<ul class="treeview-menu">
					<li <?=isset($banners) ? 'class="active"':'';?>><a href="<?=site_url('plugins/banners');?>"><i class="fa fa-newspaper-o"></i> Iklan</a></li>
					<li <?=isset($pollings) ? 'class="active"':'';?>>
						<a href="#"><i class="fa fa-question-circle"></i> Jajak Pendapat <i class="fa fa-angle-left pull-right"></i></a>
						<ul class="treeview-menu">
							<li <?=isset($questions) ? 'class="active"':'';?>><a href="<?=site_url('plugins/questions');?>"><i class="fa fa-circle-thin"></i> Pertanyaan</a></li>
							<li <?=isset($answers) ? 'class="active"':'';?>><a href="<?=site_url('plugins/answers');?>"><i class="fa fa-circle-thin"></i> Jawaban</a></li>
						</ul>
					</li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('media', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview <?=isset($media) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-upload"></i> <span>Media</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?=isset($files) ? 'class="active"':'';?>><a href="<?=site_url('media/files');?>"><i class="fa fa-paperclip"></i> File</a></li>
					<li <?=isset($file_categories) ? 'class="active"':'';?>><a href="<?=site_url('media/file_categories');?>"><i class="fa fa-tasks"></i> Kategori File</a></li>
					<li <?=isset($albums) ? 'class="active"':'';?>><a href="<?=site_url('media/albums');?>"><i class="fa fa-camera"></i> Album Photo</a></li>
					<li <?=isset($videos) ? 'class="active"':'';?>><a href="<?=site_url('media/videos');?>"><i class="fa fa-film"></i> Video</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('appearance', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview <?=isset($appearance) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-paint-brush"></i> <span>Tampilan</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?=isset($menus) ? 'class="active"':'';?>><a href="<?=site_url('appearance/menus');?>"><i class="fa fa-mouse-pointer"></i> Menu</a></li>
					<li <?=isset($themes) ? 'class="active"':'';?>><a href="<?=site_url('appearance/themes');?>"><i class="fa fa-desktop"></i> Tema</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('acl', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview <?=isset($acl) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-cogs"></i> <span>Pengguna</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<?php if ($this->session->userdata('user_type') == 'super_user') { ?>
					<li <?=isset($administrator) ? 'class="active"':'';?>><a href="<?=site_url('acl/administrator');?>"><i class="fa fa-smile-o"></i> Administrator</a></li>
					<?php } ?>
					<li <?=isset($user_students) ? 'class="active"':'';?>><a href="<?=site_url('acl/students');?>"><i class="fa fa-smile-o"></i> <?=get_school_level() === 5 ? 'Mahasiswa':'Peserta Didik'?></a></li>
					<li <?=isset($user_employees) ? 'class="active"':'';?>><a href="<?=site_url('acl/employees');?>"><i class="fa fa-smile-o"></i> <?=get_school_level() === 5 ? 'Staff/Dosen':'GTK'?></a></li>
					<li <?=isset($modules) ? 'class="active"':'';?>><a href="<?=site_url('acl/modules');?>"><i class="fa fa-cogs"></i> Daftar Modul</a></li>
					<li <?=isset($user_groups) ? 'class="active"':'';?>><a href="<?=site_url('acl/user_groups');?>"><i class="fa fa-tasks"></i> Grup Pengguna</a></li>
					<li <?=isset($user_privileges) ? 'class="active"':'';?>><a href="<?=site_url('acl/user_privileges');?>"><i class="fa fa-random"></i> Hak Akses</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('settings', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview <?=isset($settings) ? 'active':'';?>">
				<a href="#">
					<i class="fa fa-wrench"></i> <span>Pengaturan</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu">
					<li <?=isset($discussion_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/discussion');?>"><i class="fa fa-comments-o"></i> Diskusi</a></li>
					<li <?=isset($mail_server_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/mail_server');?>"><i class="fa fa-envelope"></i> Email Server</a></li>
					<li <?=isset($social_account_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/social_account');?>"><i class="fa fa-globe"></i> Jejaring Sosial</a></li>
					<li <?=isset($media_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/media');?>"><i class="fa fa-folder-open-o"></i> Media</a></li>
					<li <?=isset($writing_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/writing');?>"><i class="fa fa-pencil-square-o"></i> Menulis</a></li>
					<li <?=isset($reading_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/reading');?>"><i class="fa fa-book"></i> Membaca</a></li>					
					<li <?=isset($admission_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/admission');?>"><i class="fa fa-street-view"></i> <?=get_school_level() == 5 ? 'PMB' : 'PPDB'?></a></li>
					<li <?=isset($school_profile_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/school_profile');?>"><i class="fa fa-home"></i> Profil <?=get_school_level() == 5 ? 'Kampus' : 'Sekolah'?></a></li>
					<li <?=isset($general_settings) ? 'class="active"':'';?>><a href="<?=site_url('settings/general');?>"><i class="fa fa-sign-out"></i> Umum</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
			<?php if (in_array('maintenance', $this->session->userdata('user_privileges'))) { ?>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-medkit"></i> <span>Pemeliharaan</span> <i class="fa fa-angle-left pull-right"></i>
				</a>
				<ul class="treeview-menu" style="margin-bottom: 20px">
					<li><a href="<?=site_url('maintenance/backup_database');?>"><i class="fa fa-database"></i> Backup Database</a></li>
					<li><a href="<?=site_url('maintenance/backup_apps');?>"><i class="fa fa-download"></i> Backup Apps</a></li>
				</ul>
			</li>
			<?php } ?>
		<?php } ?>

		<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
		<li class="profile-menu">
			<a href="<?=site_url('profile');?>">
				<i class="fa fa-power-off"></i> <span>Ubah Profil</span>
			</a>
		</li>
		<?php } ?>

		<li class="change-password-menu">
			<a href="<?=site_url('change_password');?>">
				<i class="fa fa-power-off"></i> <span>Ubah Kata Sandi</span>
			</a>
		</li>
		
		<li class="power-off-menu">
			<a href="<?=site_url('logout');?>">
				<i class="fa fa-power-off"></i> <span>Keluar</span>
			</a>
		</li>
		
	</ul>
	<br>
 </section>