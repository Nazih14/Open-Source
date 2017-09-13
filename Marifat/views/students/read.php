<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?php $this->load->view('backend/grid_index');?>
<script type="text/javascript">
	DS.SpecialNeeds = <?=datasource('special_needs')?>;
	DS.Religion = <?=datasource('religion')?>;
	DS.Residence = <?=datasource('residence')?>;
	DS.Transportation = <?=datasource('transportation')?>;
	DS.MonthlyIncome = <?=datasource('monthly_income')?>;
	DS.StudentStatus = <?=datasource('student_status')?>;
	DS.Employment = <?=datasource('employment')?>;
	DS.Education = <?=datasource('education')?>;
	var school_level = '<?=$school_level?>';
	var _grid = 'STUDENTS', _form = _grid + '_FORM';
	var grid_fields = [];
	grid_fields.push(
		{ 
			header: '<input type="checkbox" class="check-all">', 
			renderer:function(row) {
				return CHECKBOX(row.id, 'id');
			},
			exclude_excel: true,
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
				  return row.photo ? 
						'<a title="Preview" onclick="preview(' + image + ')"  href="#"><i class="fa fa-search-plus"></i></a>' : '';
			 },
			 exclude_excel: true,
			sorting: false
		},
		{ 
			header: '<i class="fa fa-lock"></i>', 
			renderer:function( row ) {
				return A('create_account(' + "'" + row.full_name + "'" + ', ' + row.id + ')', 'Aktivasi Akun', '<i class="fa fa-lock"></i>');
			},
			 exclude_excel: true,
			sorting: false
		}
	);

	if (parseInt(school_level) == 5) {
		grid_fields.push(
			{ header:'NIM', renderer:'nim' }
		);
	} else {
		grid_fields.push(
			{ header:'NIS', renderer:'nis' }
		);
	}

	grid_fields.push(
		{ header:'Nama Lengkap', renderer:'full_name' },
		{ 
			header:'Status', 
			renderer: function( row ) {
				return row.student_status;
			},
			sort_field: 'student_status'
		},
		{ header:'Tempat Lahir', renderer:'birth_place' },
		{ 
			header:'Tanggal Lahir', 
			renderer: function(row) {
				return row.birth_date && row.birth_date !== '0000-00-00' ? H.indo_date(row.birth_date) : '';
			},
			sort_field: 'birth_date'
		},
		{ 
			header:'L/P', 
			renderer: function( row ) {
				return row.gender == 'M' ? 'L' : 'P';
			},
			sort_field: 'gender'
		}
	);
	new GridBuilder( _grid , {
	  controller:'students/students',
	  fields: grid_fields,
	  resize_column: 6,
	  to_excel: true
	});

	var form_fields = [];
	form_fields.push(
		{ label:'Pindahan ?', name:'is_transfer', type:'select', datasource:DS.TrueFalse },
		{ label:'Alumni ?', name:'is_alumni', type:'select', datasource:DS.TrueFalse },
		{ label:'Tanggal Masuk Sekolah', name:'start_date', type:'date' }
	);
	if (parseInt(school_level) == 5) {
		form_fields.push(
			{ label:'NIM', name:'nim' }
		);
	} else {
		form_fields.push(
			{ label:'NIS', name:'nis' }
		);
	}

	// khusus untuk SD
	if (parseInt(school_level) == 1) {
		form_fields.push(
			{ label:'Apakah pernah PAUD ?', name:'paud', type:'select', datasource:DS.TrueFalse },
			{ label:'Apakah pernah TK ?', name:'tk', type:'select', datasource:DS.TrueFalse }
		);
	}

	form_fields.push(
		
		{ label:'Hobi', name:'hobby' },
		{ label:'Cita-cita', name:'ambition' },
		{ label:'Nama Lengkap', name:'full_name' },
		{ label:'Jenis Kelamin', name:'gender', type:'select', datasource:DS.Gender },
		{ label:'NISN', name:'nisn' },
		{ label:'NIK', name:'nik' },
		{ label:'Tempat Lahir', name:'birth_place' },
		{ label:'Tanggal Lahir', name:'birth_date', type:'date' },
		{ label:'Agama', name:'religion', type:'select', datasource:DS.Religion },
		{ label:'Berkebutuhan Khusus', name:'special_needs', type:'select', datasource:DS.SpecialNeeds },
		{ label:'Alamat Jalan', name:'street_address' },
		{ label:'RT', name:'rt' },
		{ label:'RW', name:'rw' },
		{ label:'Nama Dusun', name:'sub_village' },
		{ label:'Nama Kelurahan/ Desa', name:'village' },
		{ label:'Kecamatan', name:'sub_district' },
		{ label:'Kabupaten', name:'district' },
		{ label:'Kode Pos', name:'postal_code' },
		{ label:'Tempat Tinggal', name:'residence', type:'select', datasource:DS.Residence },
		{ label:'Moda Transportasi', name:'transportation', type:'select', datasource:DS.Transportation },
		{ label:'Nomor Telepon', name:'phone' },
		{ label:'Nomor HP', name:'mobile_phone' },
		{ label:'Email', name:'email' },
		{ label:'Nomor SKTM', name:'sktm', placeholder:'Surat Keterangan Tidak Mampu' },
		{ label:'Nomor KKS', name:'kks', placeholder:'Kartu Keluarga Sejahtera' },
		{ label:'Nomor KPS', name:'kps', placeholder:'Kartu Pra Sejahtera' },
		{ label:'Nomor KIP', name:'kip', placeholder:'Kartu Indonesia Pintar' },
		{ label:'Nomor KIS', name:'kis', placeholder:'Kartu Indonesia Pintar' },
		{ label:'Kewarganegaraan', name:'citizenship', type:'select', datasource:DS.Citizenship },
		{ label:'Nama Negara', name:'country' },
		{ label:'Nama ayah Kandung', name:'father_name' },
		{ label:'Tahun Lahir Ayah', name:'father_birth_year' },
		{ label:'Pendidikan Ayah', name:'father_education', type:'select', datasource:DS.Education },
		{ label:'Pekerjaan Ayah', name:'father_employment', type:'select', datasource:DS.Employment },
		{ label:'Penghasilan  Bulanan Ayah', name:'father_monthly_income', type:'select', datasource:DS.MonthlyIncome },
		{ label:'Kebutuhan Khusus Ayah', name:'father_special_needs', type:'select', datasource:DS.SpecialNeeds },
		{ label:'Nama Ibu Kandung', name:'mother_name' },
		{ label:'Tahun Lahir Ibu', name:'mother_birth_year' },
		{ label:'Pendidikan Ibu', name:'mother_education', type:'select', datasource:DS.Education },
		{ label:'Pekerjaan Ibu', name:'mother_employment', type:'select', datasource:DS.Employment },
		{ label:'Penghasilan  Bulanan Ibu', name:'mother_monthly_income', type:'select', datasource:DS.MonthlyIncome },
		{ label:'Kebutuhan Khusus Ibu', name:'mother_special_needs', type:'select', datasource:DS.SpecialNeeds },
		{ label:'Nama Wali', name:'guardian_name' },
		{ label:'Tahun Lahir Wali', name:'guardian_birth_year' },
		{ label:'Pendidikan Wali', name:'guardian_education', type:'select', datasource:DS.Education },
		{ label:'Pekerjaan Wali', name:'guardian_employment', type:'select', datasource:DS.Employment },
		{ label:'Penghasilan Bulanan Wali', name:'guardian_monthly_income', type:'select', datasource:DS.MonthlyIncome },
		{ label:'Jarak Tempat Tinggal ke Sekolah', name:'mileage', type:'number' },
		{ label:'Waktu Tempuh', name:'traveling_time', type:'number' },
		{ label:'Tinggi Badan', name:'height', type:'number' },
		{ label:'Berat Badan', name:'weight', type:'number' },
		{ label:'Jumlah Saudara Kandung', name:'sibling_number', type:'number' },
		{ label:'Status Peserta Didik', name:'student_status', type:'select', datasource:DS.StudentStatus },
		{ label:'Tanggal Keluar', name:'end_date', type:'date' },
		{ label:'Alasan Keluar', name:'reason', type:'textarea' }
	);
	new FormBuilder( _form , {
	  controller:'students/students',
	  fields: form_fields
	});
	
	function create_account( full_name, id ) {
		eModal.confirm('Apakah anda yakin akan mengaktifkan akun dengan nama ' + full_name + ' ?', 'Konfirmasi').then(function() {
			$.post(_BASE_URL + 'students/students/create_student_account', {'id':id}, function(response) {
				var res = H.stringToJSON(response);
				H.growl(res.type, H.message(res.message));
			});
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