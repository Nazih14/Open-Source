<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
	var school_level = <?=get_school_level()?>;
	var admission_year = <?=$admission_year;?>;	
	DS.Majors = <?=$ds_majors;?>;	
	DS.SpecialNeeds = <?=datasource('special_needs')?>;
	DS.Religion = <?=datasource('religion')?>;
	DS.Residence = <?=datasource('residence')?>;
	DS.Transportation = <?=datasource('transportation')?>;
	DS.MonthlyIncome = <?=datasource('monthly_income')?>;
	DS.StudentStatus = <?=datasource('student_status')?>;
	DS.Employment = <?=datasource('employment')?>;
	DS.Education = <?=datasource('education')?>;
	var _grid = 'REGISTRANTS', _form = _grid + '_FORM', _form2 = _grid + '_FORM2';
	var grid_fields = [
		{ 
			header: '<input type="checkbox" class="check-all">', 
			renderer:function(row) {
				return CHECKBOX(row.id, 'id');
			},
			exclude_excel : true,
			sorting: false
		},
		{ 
			header: '<i class="fa fa-edit"></i>', 
			renderer:function(row) {
				return A(_form + '.OnEdit(' + row.id + ')', 'Edit');
			},
			exclude_excel : true,
			sorting: false
		},
		{ 
			header: '<i class="fa fa-check-square-o"></i>', 
			renderer:function(row) {
				return A(_form2 + '.OnEdit(' + row.id + ')', 'Daftar Ulang ?', '<i class="fa fa-check-square-o"></i>');
			},
			exclude_excel : true,
			sorting: false
		},
		{ 
			header: '<i class="fa fa-print"></i>', 
			renderer:function(row) {
				return A('print_registration_form(' + row.id + ', event)', 'Cetak Formulir Pendaftaran', '<i class="fa fa-print"></i>');
			},
			exclude_excel : true,
			sorting: false
		},
		{ 
			header: '<i class="fa fa-file-image-o"></i>', 
			renderer:function(row) {
				return UPLOAD(_form + '.OnUpload(' + row.id + ')', 'image', 'Upload Photo');
			},
			exclude_excel : true,
			sorting: false
		},
		{ 
			header: '<i class="fa fa-search-plus"></i>', 
			renderer:function(row) {
				var image = "'" + row.photo + "'";
				return row.photo ? '<a title="Preview" onclick="preview(' + image + ')"  href="#"><i class="fa fa-search-plus"></i></a>' : '';
			},
			sorting: false
		},
		{ header:'No. Daftar', renderer:'registration_number' },
		{ header:'Tanggal', renderer:'created_at' },
		{ 
			header:'Daftar Ulang ?', 
			renderer: function( row ) {
				var re_registration = row.re_registration;
				return re_registration == 'true' ? '<i class="fa fa-check-square-o"></i>' : '<i class="fa fa-warning"></i>';
			},
			sort_field: 're_registration'
		},
	];
	if (parseInt(school_level) == 3 || parseInt(school_level) == 4 || parseInt(school_level) == 5) {
		grid_fields.push(
			{ header:'Pilihan I', renderer:'first_choice' },
			{ header:'Pilihan II', renderer:'second_choice' }
		);
	}
	grid_fields.push(
		{ header:'Nama Lengkap', renderer:'full_name' },
		{ header:'L/P', renderer:'gender' }
	);
	new GridBuilder( _grid , {
		controller:'admission/registrants',
		fields: grid_fields,
		resize_column: 7,
		to_excel: true,
		can_add: false
	});

	var form_fields = [];
	if (parseInt(school_level) == 3 || parseInt(school_level) == 4 || parseInt(school_level) == 5) {
		form_fields.push(
			{ label:'Pilihan I', name:'first_choice', type:'select', datasource:DS.Majors },
			{ label:'Pilihan II', name:'second_choice', type:'select', datasource:DS.Majors }
		);
	}
	form_fields.push(
		{ label:'Nama Lengkap', name:'full_name', placeholder:'Nama Lengkap' },
		{ label:'Jenis Kelamin', name:'gender', type:'select', datasource:DS.Gender },
		{ label:'NISN', name:'nisn', placeholder:'Nomor Induk Siswa Nasional' },
		{ label:'NIK', name:'nik', placeholder:'' },
		{ label:'Tempat Lahir', name:'birth_place', placeholder:'Tempat Lahir' },
		{ label:'Tanggal Lahir', name:'birth_date', placeholder:'Tanggal Lahir', type:'date' },
		{ label:'Agama', name:'religion', type:'select', datasource:DS.Religion },
		{ label:'Berkebutuhan Khusus', name:'special_needs', type:'select', datasource:DS.SpecialNeeds },
		{ label:'Alamat Jalan', name:'street_address', placeholder:'Alamat Jalan' },
		{ label:'RT', name:'rt', placeholder:'Rukun Tetangga' },
		{ label:'RW', name:'rw', placeholder:'Rukun warga' },
		{ label:'Nama Dusun', name:'sub_village', placeholder:'Nama Dusun' },
		{ label:'Nama Kelurahan / Desa', name:'village', placeholder:'Nama Desa' },
		{ label:'Kecamatan', name:'sub_district', placeholder:'Kecamatan' },
		{ label:'Kabupaten', name:'district', placeholder:'Kabupaten' },
		{ label:'Kode Pos', name:'postal_code', placeholder:'Kode POS' },
		{ label:'Tempat Tinggal', name:'residence', type:'select', datasource:DS.Residence },
		{ label:'Moda Transportasi', name:'transportation', type:'select', datasource:DS.Transportation },
		{ label:'Nomor Telepon', name:'phone', placeholder:'Nomor Telepon' },
		{ label:'Nomor Handphone', name:'mobile_phone', placeholder:'Nomor Handphone' },
		{ label:'Email', name:'email', placeholder:'Alamat Email' },
		{ label:'Surat Keterangan Tidak Mampu (SKTM)', name:'sktm' },
		{ label:'Kartu Keluarga Sejahtera (KKS)', name:'kks' },
		{ label:'Kartu Pra Sejahtera (KPS)', name:'kps' },
		{ label:'Kartu Indonesia Pintar (KIP)', name:'kip' },
		{ label:'Kartu Indonesia Sehat (KIS)', name:'kis' },
		{ label:'Kewarganegaraan', name:'citizenship', type:'select', datasource:DS.Citizenship },
		{ label:'Negara', name:'country', placeholder:'Nama Negara. Diisi jika bukan WNI' },
		{ label:'Nama Ayah', name:'father_name', placeholder:'Nama ayah Kandung' },
		{ label:'Tahun Lahir Ayah', name:'father_birth_year', placeholder:'Tahun Lahir' },
		{ label:'Pendidikan Ayah', name:'father_education', type:'select', datasource:DS.Education },
		{ label:'Pekerjaan Ayah', name:'father_employment', type:'select', datasource:DS.Employment },
		{ label:'Penghasilan Ayah / Bulan', name:'father_monthly_income', type:'select', datasource:DS.MonthlyIncome },
		{ label:'Kebutuhan Khusus Ayah', name:'father_special_needs', type:'select', datasource:DS.SpecialNeeds },
		{ label:'Nama Ibu', name:'mother_name', placeholder:'Nama Ibu Kandung' },
		{ label:'Tahun Lahir Ibu', name:'mother_birth_year', placeholder:'Tahun Lahir' },
		{ label:'Pendidikan Ibu', name:'mother_education', type:'select', datasource:DS.Education },
		{ label:'Pekerjaan Ibu', name:'mother_employment', type:'select', datasource:DS.Employment },
		{ label:'Penghasilan Ibu / Bulan', name:'mother_monthly_income', type:'select', datasource:DS.MonthlyIncome },
		{ label:'Kebutuhan Khusus Ibu', name:'mother_special_needs', type:'select', datasource:DS.SpecialNeeds },
		{ label:'Nama Wali', name:'guardian_name', placeholder:'Nama Wali' },
		{ label:'Tahun Lahir Wali', name:'guardian_birth_year', placeholder:'Tahun Lahir' },
		{ label:'Pendidikan Wali', name:'guardian_education', type:'select', datasource:DS.Education },
		{ label:'Pekerjaan Wali', name:'guardian_employment', type:'select', datasource:DS.Employment },
		{ label:'Penghasilan Wali / Bulan', name:'guardian_monthly_income', type:'select', datasource:DS.MonthlyIncome },
		{ label:'Jarak Tempat Tinggal ke Sekolah', name:'mileage', placeholder:'Jarak tempat tinggal ke sekolah', type:'number' },
		{ label:'Waktu Tempuh', name:'traveling_time', placeholder:'Waktu Tempuh', type:'number' },
		{ label:'Tinggi Badan', name:'height', placeholder:'Tinggi Badan', type:'number' },
		{ label:'Berat Badan', name:'weight', placeholder:'Berat Badan', type:'number' },
		{ label:'Jumlah Saudara Kandung', name:'sibling_number', placeholder:'Jumlah Saudara Kandung', type:'number' }
	);
	new FormBuilder( _form , {
		controller:'admission/registrants',
		  fields: form_fields
	 });

	new FormBuilder( _form2 , {
		controller:'admission/registrants',
		fields: [
			{ label:'Daftar Ulang ?', name:'re_registration', type:'select', datasource:DS.TrueFalse }
		],
		save_action: 'verified'
	});

	// Cetak Formulir Pendaftaran
	function print_registration_form( id ) {
		$.post(_BASE_URL + 'admission/registrants/print_registration_form', {'id':id}, function(response) {
			var res = H.stringToJSON(response);
			if (res.type == 'success') {
				window.open(_BASE_URL + 'media_library/students/' + res.file_name,'_self');
			}
			H.growl('error', 'Format data tidak valid.');
		}).fail(function(xhr) {
    		console.log(xhr);
  		});
	}

	function preview(image) {
		$.magnificPopup.open({
			items: {
				src: _BASE_URL + 'media_library/students/' + image
			},
			type: 'image'
		});
	}
</script>