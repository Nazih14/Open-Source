<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
	legend {
		margin-bottom: 30px;
		margin-top: 30px;
	}
</style>
<script type="text/javascript">
	$( document ).ready( function() {
		// Select2
		$('.select2').select2();

		// Datepicker
		$('.datepicker').datepicker({
			format: 'yyyy-mm-dd',
			todayBtn: 'linked',
			minDate: '0001-01-01',
			setDate: new Date(),
			todayHighlight: true,
			autoclose: true
		});
	});

	function save_changes() {
		var values = {
			assignment_letter_number: $('#assignment_letter_number').val(),
			assignment_letter_date: $('#assignment_letter_date').val(),
			assignment_start_date: $('#assignment_start_date').val(),
			parent_school_status: $('#parent_school_status').val(),
			full_name: $('#full_name').val(),
			gender: $('#gender').val(),
			nik: $('#nik').val(),
			birth_place: $('#birth_place').val(),
			birth_date: $('#birth_date').val(),
			mother_name: $('#mother_name').val(),
			street_address: $('#street_address').val(),
			rt: $('#rt').val(),
			rw: $('#rw').val(),
			sub_village: $('#sub_village').val(),
			village: $('#village').val(),
			sub_district: $('#sub_district').val(),
			district: $('#district').val(),
			postal_code: $('#postal_code').val(),
			religion: $('#religion').val(),
			marital_status: $('#marital_status').val(),
			spouse_name: $('#spouse_name').val(),
			spouse_employment: $('#spouse_employment').val(),
			citizenship: $('#citizenship').val(),
			country: $('#country').val(),
			npwp: $('#npwp').val(),
			employment_status: $('#employment_status').val(),
			nip: $('#nip').val(),
			niy: $('#niy').val(),
			nuptk: $('#nuptk').val(),
			employment_type: $('#employment_type').val(),
			decree_appointment: $('#decree_appointment').val(),
			appointment_start_date: $('#appointment_start_date').val(),
			institutions_lifter: $('#institutions_lifter').val(),
			decree_cpns: $('#decree_cpns').val(),
			pns_start_date: $('#pns_start_date').val(),
			rank: $('#rank').val(),
			salary_source: $('#salary_source').val(),
			headmaster_license: $('#headmaster_license').val(),
			skills_laboratory: $('#skills_laboratory').val(),
			handle_special_needs: $('#handle_special_needs').val(),
			braille_skills: $('#braille_skills').val(),
			sign_language_skills: $('#sign_language_skills').val(),
			phone: $('#phone').val(),
			mobile_phone: $('#mobile_phone').val(),
			email: $('#email').val()
		};
		$.post(_BASE_URL + 'employee_profile/save', values, function(response) {
			var res = H.stringToJSON(response);
			H.growl(res.type, H.message(res.message));
		});
	}
</script>
 <section class="content">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Penugasan</a></li>
              <li><a href="#tab_2" data-toggle="tab">Identitas</a></li>
              <li><a href="#tab_3" data-toggle="tab">Alamat</a></li>
              <li><a href="#tab_4" data-toggle="tab">Data Pribadi</a></li>
              <li><a href="#tab_5" data-toggle="tab">Kepegawaian</a></li>
              <li><a href="#tab_6" data-toggle="tab">Kompetensi Khusus</a></li>
              <li><a href="#tab_7" data-toggle="tab">Kontak</a></li>
            </ul>
            <div class="tab-content">
					<div class="tab-pane active" id="tab_1">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="assignment_letter_number" class="col-sm-4 control-label">Nomor Surat Tugas</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="assignment_letter_number" value="<?=$query->assignment_letter_number ? $query->assignment_letter_number : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="assignment_letter_date" class="col-sm-4 control-label">Tanggal Surat Tugas</label>
									<div class="col-sm-8">
										<div class="input-group">
			                			<input type="text" class="form-control datepicker" id="assignment_letter_date" value="<?=$query->assignment_letter_date ? $query->assignment_letter_date : '';?>">
			                			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			              			</div>
									</div>
								</div>
								<div class="form-group">
									<label for="assignment_start_date" class="col-sm-4 control-label">TMT Tugas</label>
									<div class="col-sm-8">
										<div class="input-group">
			                			<input type="text" class="form-control datepicker" id="assignment_start_date" value="<?=$query->assignment_start_date ? $query->assignment_start_date : '';?>">
			                			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			              			</div>
									</div>
								</div>
								<div class="form-group">
									<label for="parent_school_status" class="col-sm-4 control-label">Status Sekolah Induk</label>
									<div class="col-sm-8">
										<?=form_dropdown('parent_school_status', ['true' => 'Ya', 'false' => 'Tidak'], $query->parent_school_status, 'id="parent_school_status" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="tab_2">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="full_name" class="col-sm-4 control-label">Nama Lengkap</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="full_name" value="<?=$query->full_name ? $query->full_name : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="gender" class="col-sm-4 control-label">Jenis Kelamin</label>
									<div class="col-sm-8">
										<?=form_dropdown('gender', ['M' => 'Perempuan', 'F' => 'Laki-laki'], $query->gender, 'id="gender" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="nik" class="col-sm-4 control-label">NIK</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="nik" value="<?=$query->nik ? $query->nik : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="birth_place" class="col-sm-4 control-label">Tempat Lahir</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="birth_place" value="<?=$query->birth_place ? $query->birth_place : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="birth_date" class="col-sm-4 control-label">Tanggal Lahir</label>
									<div class="col-sm-8">
										<div class="input-group">
			                			<input type="text" class="form-control datepicker" id="birth_date" value="<?=$query->birth_date ? $query->birth_date : '';?>">
			                			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			              			</div>
									</div>
								</div>
								<div class="form-group">
									<label for="mother_name" class="col-sm-4 control-label">Nama Ibu Kandung</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="mother_name" value="<?=$query->mother_name ? $query->mother_name : '';?>">
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="tab_3">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="street_address" class="col-sm-4 control-label">Alamat Jalan</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="street_address" value="<?=$query->street_address ? $query->street_address : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="rt" class="col-sm-4 control-label">RT</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="rt" value="<?=$query->rt ? $query->rt : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="rw" class="col-sm-4 control-label">RW</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="rw" value="<?=$query->rw ? $query->rw : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="sub_village" class="col-sm-4 control-label">Nama Dusun</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="sub_village" value="<?=$query->sub_village ? $query->sub_village : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="village" class="col-sm-4 control-label">Nama Kelurahan / Desa</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="village" value="<?=$query->village ? $query->village : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="sub_district" class="col-sm-4 control-label">Kecamatan</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="sub_district" value="<?=$query->sub_district ? $query->sub_district : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="district" class="col-sm-4 control-label">Kabupaten</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="district" value="<?=$query->district ? $query->district : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="postal_code" class="col-sm-4 control-label">Kode Pos</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="postal_code" value="<?=$query->postal_code ? $query->postal_code : '';?>">
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="tab_4">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="religion" class="col-sm-4 control-label">Agama</label>
									<div class="col-sm-8">
										<?=form_dropdown('religion', $religion, $query->religion, 'id="religion" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="marital_status" class="col-sm-4 control-label">Status Perkawinan</label>
									<div class="col-sm-8">
										<?=form_dropdown('marital_status', $marital_status, $query->marital_status, 'id="marital_status" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="spouse_name" class="col-sm-4 control-label">Nama Suami / Istri</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="spouse_name" value="<?=$query->spouse_name ? $query->spouse_name : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="spouse_employment" class="col-sm-4 control-label">Pekerjaan Suami / Istri</label>
									<div class="col-sm-8">
										<?=form_dropdown('spouse_employment', $employment, $query->spouse_employment, 'id="spouse_employment" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="citizenship" class="col-sm-4 control-label">Kewarganegaraan</label>
									<div class="col-sm-8">
										<?=form_dropdown('citizenship', ['WNI' => 'Warga Negara Indonesia', 'WNA' => 'Warga Negara Asing'], $query->citizenship, 'id="citizenship" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="country" class="col-sm-4 control-label">Nama Negara</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="country" value="<?=$query->country ? $query->country : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="npwp" class="col-sm-4 control-label">NPWP</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="npwp" value="<?=$query->npwp ? $query->npwp : '';?>">
									</div>
								</div>					
							</div>
						</form>
					</div>
					<div class="tab-pane" id="tab_5">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="employment_status" class="col-sm-4 control-label">Status Kepegawaian</label>
									<div class="col-sm-8">
										<?=form_dropdown('employment_status', $employment_status, $query->employment_status, 'id="employment_status" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="nip" class="col-sm-4 control-label">NIP</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="nip" value="<?=$query->nip ? $query->nip : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="niy" class="col-sm-4 control-label">NIY</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="niy" value="<?=$query->niy ? $query->niy : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="nuptk" class="col-sm-4 control-label">NUPTK</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="nuptk" value="<?=$query->nuptk ? $query->nuptk : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="employment_type" class="col-sm-4 control-label">Jenis GTK</label>
									<div class="col-sm-8">
										<?=form_dropdown('employment_type', $employment_type, $query->employment_type, 'id="employment_type" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="decree_appointment" class="col-sm-4 control-label">SK Pengangkatan</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="decree_appointment" value="<?=$query->decree_appointment ? $query->decree_appointment : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="appointment_start_date" class="col-sm-4 control-label">TMT Pengangkatan</label>
									<div class="col-sm-8">
										<div class="input-group">
			                			<input type="text" class="form-control datepicker" id="appointment_start_date" value="<?=$query->appointment_start_date ? $query->appointment_start_date : '';?>">
			                			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			              			</div>
									</div>
								</div>
								<div class="form-group">
									<label for="institutions_lifter" class="col-sm-4 control-label">Lembaga Pengangkat</label>
									<div class="col-sm-8">
										<?=form_dropdown('institutions_lifter', $institutions_lifter, $query->institutions_lifter, 'id="institutions_lifter" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="decree_cpns" class="col-sm-4 control-label">SK CPNS</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="decree_cpns" value="<?=$query->decree_cpns ? $query->decree_cpns : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="pns_start_date" class="col-sm-4 control-label">TMT PNS</label>
									<div class="col-sm-8">
										<div class="input-group">
			                			<input type="text" class="form-control datepicker" id="pns_start_date" value="<?=$query->pns_start_date ? $query->pns_start_date : '';?>">
			                			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
			              			</div>
									</div>
								</div>
								<div class="form-group">
									<label for="rank" class="col-sm-4 control-label">Pangkat / Golongan</label>
									<div class="col-sm-8">
										<?=form_dropdown('rank', $rank, $query->rank, 'id="rank" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="salary_source" class="col-sm-4 control-label">Sumber Gaji</label>
									<div class="col-sm-8">
										<?=form_dropdown('salary_source', $salary_source, $query->salary_source, 'id="salary_source" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="tab_6">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="headmaster_license" class="col-sm-4 control-label">Punya Lisensi Kepala Sekolah ?</label>
									<div class="col-sm-8">
										<?=form_dropdown('headmaster_license', ['true' => 'Ya', 'false' => 'Tidak'], $query->headmaster_license, 'id="headmaster_license" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="skills_laboratory" class="col-sm-4 control-label">Keahlian Laboratorium</label>
									<div class="col-sm-8">
										<?=form_dropdown('skills_laboratory', $skills_laboratory, $query->skills_laboratory, 'id="skills_laboratory" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="handle_special_needs" class="col-sm-4 control-label">Mampu Menangani Kebutuhan Khusus</label>
									<div class="col-sm-8">
										<?=form_dropdown('handle_special_needs', $special_needs, $query->handle_special_needs, 'id="handle_special_needs" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="braille_skills" class="col-sm-4 control-label">Keahlian Braile</label>
									<div class="col-sm-8">
										<?=form_dropdown('braille_skills', ['true' => 'Ya', 'false' => 'Tidak'], $query->braille_skills, 'id="braille_skills" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="sign_language_skills" class="col-sm-4 control-label">Keahlian Bahasa Isyarat</label>
									<div class="col-sm-8">
										<?=form_dropdown('sign_language_skills', ['true' => 'Ya', 'false' => 'Tidak'], $query->sign_language_skills, 'id="sign_language_skills" class="form-control select2" style="width:100%;"');?>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="tab_7">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="phone" class="col-sm-4 control-label">Nomor Telepon Rumah</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="phone" value="<?=$query->phone ? $query->phone : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="mobile_phone" class="col-sm-4 control-label">Nomor HP</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="mobile_phone" value="<?=$query->mobile_phone ? $query->mobile_phone : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-4 control-label">Email</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="email" value="<?=$query->email ? $query->email : '';?>">
									</div>
								</div>
							</div>
						</form>
					</div>
            </div>
         </div>
         <div class="btn-group col-sm-8 col-sm-offset-4">
				<button type="submit" onclick="save_changes(); return false;" class="btn btn-primary submit"><i class="fa fa-save"></i> SIMPAN PERUBAHAN</button>
			</div>
		</div>
	</div>
 </section>