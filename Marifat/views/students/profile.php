<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<style type="text/css">
	legend {
		margin-bottom: 30px;
		margin-top: 30px;
	}
</style>
<script type="text/javascript">
	$( document ).ready( function() {
		$('#birth_date').datepicker({
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
			paud: $('#paud').val(),
			tk: $('#tk').val(),
			hobby: $('#hobby').val(),
			ambition: $('#ambition').val(),
			birth_place: $('#birth_place').val(),
			birth_date: $('#birth_date').val(),
			religion: $('#religion').val(),
			special_needs: $('#special_needs').val(),
			street_address: $('#street_address').val(),
			rt: $('#rt').val(),
			rw: $('#rw').val(),
			sub_village: $('#sub_village').val(),
			village: $('#village').val(),
			sub_district: $('#sub_district').val(),
			district: $('#district').val(),
			postal_code: $('#postal_code').val(),
			residence: $('#residence').val(),
			transportation: $('#transportation').val(),
			phone: $('#phone').val(),
			mobile_phone: $('#mobile_phone').val(),
			email: $('#email').val(),
			sktm: $('#sktm').val(),
			kks: $('#kks').val(),
			kps: $('#kps').val(),
			kip: $('#kip').val(),
			kis: $('#kis').val(),
			citizenship: $('#citizenship').val(),
			country: $('#country').val(),
			father_name: $('#father_name').val(),
			father_birth_year: $('#father_birth_year').val(),
			father_education: $('#father_education').val(),
			father_employment: $('#father_employment').val(),
			father_monthly_income: $('#father_monthly_income').val(),
			father_special_needs: $('#father_special_needs').val(),
			mother_name: $('#mother_name').val(),
			mother_birth_year: $('#mother_birth_year').val(),
			mother_education: $('#mother_education').val(),
			mother_employment: $('#mother_employment').val(),
			mother_monthly_income: $('#mother_monthly_income').val(),
			mother_special_needs: $('#mother_special_needs').val(),
			guardian_name: $('#guardian_name').val(),
			guardian_birth_year: $('#guardian_birth_year').val(),
			guardian_education: $('#guardian_education').val(),
			guardian_employment: $('#guardian_employment').val(),
			guardian_monthly_income: $('#guardian_monthly_income').val(),
			mileage: $('#mileage').val(),
			traveling_time: $('#traveling_time').val(),
			height: $('#height').val(),
			weight: $('#weight').val(),
			sibling_number: $('#sibling_number').val()
		};
		$.post(_BASE_URL + 'student_profile/save', values, function(response) {
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
				  <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">Registrasi <?=get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik'?></a></li>
				  <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">Data Pribadi</a></li>
				  <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">Data Ayah Kandung</a></li>
				  <li class=""><a href="#tab_4" data-toggle="tab" aria-expanded="false">Data Ibu Kandung</a></li>
				  <li class=""><a href="#tab_5" data-toggle="tab" aria-expanded="false">Data Wali</a></li>
				  <li class=""><a href="#tab_6" data-toggle="tab" aria-expanded="false">Data Periodik</a></li>
				</ul>
				<div class="tab-content">
				  <div class="tab-pane active" id="tab_1">
					 <form class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label for="is_transfer" class="col-sm-4 control-label">Jenis Pendaftaran</label>
								<div class="col-sm-8">
								  <input readonly="true" type="text" class="form-control" id="is_transfer" value="<?=$query->is_transfer ? ($query->is_transfer == 'true' ? 'Pindahan' : 'Baru') : '';?>">
								</div>
							</div>
							<div class="form-group">
								<label for="start_date" class="col-sm-4 control-label">Tanggal Masuk <?=get_school_level() == 5 ? 'Kuliah' : 'Sekolah'?></label>
								<div class="col-sm-8">
								  <input readonly="true" type="text" class="form-control" id="start_date" value="<?=$query->start_date ? indo_date($query->start_date) : '';?>">
								</div>
							</div>
							<div class="form-group">
								<label for="prev_exam_number" class="col-sm-4 control-label">Nomor Peserta Ujian Sebelumnya</label>
								<div class="col-sm-8">
								  <input readonly="true" type="text" class="form-control" id="prev_exam_number" value="<?=$query->prev_exam_number ? $query->prev_exam_number : '';?>">
								</div>
							</div>
							<div class="form-group">
								<label for="paud" class="col-sm-4 control-label">Apakah Pernah PAUD ?</label>
								<div class="col-sm-8">
									<?=form_dropdown('paud', ['true' => 'Pernah', 'false' => 'Tidak Pernah'], $query->paud, 'id="paud" class="form-control"');?>
								</div>
							</div>
							<div class="form-group">
								<label for="tk" class="col-sm-4 control-label">Apakah Pernah TK ?</label>
								<div class="col-sm-8">
									<?=form_dropdown('tk', ['true' => 'Pernah', 'false' => 'Tidak Pernah'], $query->paud, 'id="tk" class="form-control"');?>
								</div>
							</div>
							<div class="form-group">
								<label for="skhun" class="col-sm-4 control-label">Nomor Seri SKHUN Sebelumnya</label>
								<div class="col-sm-8">
								  <input readonly="true" type="text" class="form-control" id="skhun" value="<?=$query->skhun ? $query->skhun : '';?>">
								</div>
							</div>
							<div class="form-group">
								<label for="diploma_number" class="col-sm-4 control-label">Nomor Seri Ijazah Sebelumnya</label>
								<div class="col-sm-8">
								  <input readonly="true" type="text" class="form-control" id="diploma_number" value="<?=$query->diploma_number ? $query->diploma_number : '';?>">
								</div>
							</div>
							<div class="form-group">
								<label for="hobby" class="col-sm-4 control-label">Hobi</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="hobby" value="<?=$query->hobby ? $query->hobby : '';?>">
								</div>
							</div>
							<div class="form-group">
								<label for="ambition" class="col-sm-4 control-label">Cita-Cita</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="ambition" value="<?=$query->ambition ? $query->ambition : '';?>">
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
									  <input readonly="true" type="text" class="form-control" id="full_name" value="<?=$query->full_name ? $query->full_name : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="gender" class="col-sm-4 control-label">Jenis Kelamin</label>
									<div class="col-sm-8">
									  <input readonly="true" type="text" class="form-control" id="gender" value="<?=$query->gender ? $query->gender : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="nisn" class="col-sm-4 control-label">Nomor Induk Sekolah Nasional</label>
									<div class="col-sm-8">
									  <input readonly="true" type="text" class="form-control" id="nisn" value="<?=$query->nisn ? $query->nisn : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="nis" class="col-sm-4 control-label">Nomor Induk Sekolah</label>
									<div class="col-sm-8">
									  <input readonly="true" type="text" class="form-control" id="nis" value="<?=$query->nis ? $query->nis : '';?>">
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
											<input type="text" class="form-control" id="birth_date" value="<?=$query->birth_date ? $query->birth_date : '';?>">
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>
									</div>
								</div>
								<div class="form-group">
									<label for="religion" class="col-sm-4 control-label">Agama</label>
									<div class="col-sm-8">
										<?=form_dropdown('religion', religion(), $query->religion, 'id="religion" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="special_needs" class="col-sm-4 control-label">Kebutuhan Khusus</label>
									<div class="col-sm-8">
										<?=form_dropdown('special_needs', $special_needs, $query->special_needs, 'id="special_needs" class="form-control"');?>
									</div>
								</div>
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
								<div class="form-group">
									<label for="residence" class="col-sm-4 control-label">Tempat Tinggal</label>
									<div class="col-sm-8">
										<?=form_dropdown('residence', $residence, $query->residence, 'id="residence" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="transportation" class="col-sm-4 control-label">Moda Transportasi</label>
									<div class="col-sm-8">
										<?=form_dropdown('transportation', $transportation, $query->transportation, 'id="transportation" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="mobile_phone" class="col-sm-4 control-label">Nomor HP</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="mobile_phone" value="<?=$query->mobile_phone ? $query->mobile_phone : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="phone" class="col-sm-4 control-label">Nomor Telepon</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="phone" value="<?=$query->phone ? $query->phone : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="email" class="col-sm-4 control-label">Email Pribadi</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="email" value="<?=$query->email ? $query->email : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="sktm" class="col-sm-4 control-label">No. Surat Keterangan Tidak Mampu (SKTM)</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="sktm" value="<?=$query->sktm ? $query->sktm : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="kks" class="col-sm-4 control-label">No. Kartu Keluarga Sejahtera (KKS)</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="kks" value="<?=$query->kks ? $query->kks : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="kps" class="col-sm-4 control-label">No. Kartu Pra Sejahtera (KPS)</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="kps" value="<?=$query->kps ? $query->kps : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="kip" class="col-sm-4 control-label">No. Kartu Indonesia Pintar (KIP)</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="kip" value="<?=$query->kip ? $query->kip : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="kis" class="col-sm-4 control-label">No. Kartu Indonesia Sehat (KIS)</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="kis" value="<?=$query->kis ? $query->kis : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="citizenship" class="col-sm-4 control-label">Kewarganegaraan</label>
									<div class="col-sm-8">
										<?=form_dropdown('citizenship', ['WNI' => 'Warga Negara Indonesia', 'WNA' => 'Warga Negara Asing'], $query->citizenship, 'id="citizenship" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="country" class="col-sm-4 control-label">Nama Negara</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="country" value="<?=$query->country ? $query->country : '';?>">
									</div>
								</div>
							</div>
						</form>	
				  </div>
				  <div class="tab-pane" id="tab_3">
					 <form class="form-horizontal">
						<div class="box-body">
							<div class="form-group">
								<label for="father_name" class="col-sm-4 control-label">Nama Ayah</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="father_name" value="<?=$query->father_name ? $query->father_name : '';?>">
								</div>
							</div>
							<div class="form-group">
								<label for="father_birth_year" class="col-sm-4 control-label">Tahun Lahir Ayah</label>
								<div class="col-sm-8">
								  <input type="text" class="form-control" id="father_birth_year" value="<?=$query->father_birth_year ? $query->father_birth_year : '';?>">
								</div>
							</div>
							<div class="form-group">
								<label for="father_education" class="col-sm-4 control-label">Pendidikan Ayah</label>
								<div class="col-sm-8">
									<?=form_dropdown('father_education', $education, $query->father_education, 'id="father_education" class="form-control"');?>
								</div>
							</div>
							<div class="form-group">
								<label for="father_employment" class="col-sm-4 control-label">Pekerjaan Ayah</label>
								<div class="col-sm-8">
									<?=form_dropdown('father_employment', $employment, $query->father_employment, 'id="father_employment" class="form-control"');?>
								</div>
							</div>
							<div class="form-group">
								<label for="father_monthly_income" class="col-sm-4 control-label">Penghasilan Bulanan Ayah</label>
								<div class="col-sm-8">
									<?=form_dropdown('father_monthly_income', $monthly_income, $query->father_monthly_income, 'id="father_monthly_income" class="form-control"');?>
								</div>
							</div>
							<div class="form-group">
								<label for="father_special_needs" class="col-sm-4 control-label">Kebutuhan Khusus Ayah</label>
								<div class="col-sm-8">
									<?=form_dropdown('father_special_needs', $special_needs, $query->father_special_needs, 'id="father_special_needs" class="form-control"');?>
								</div>
							</div>
						</div>
					 </form>
				  </div>
					<div class="tab-pane" id="tab_4">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="mother_name" class="col-sm-4 control-label">Nama Ibu</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="mother_name" value="<?=$query->mother_name ? $query->mother_name : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="mother_birth_year" class="col-sm-4 control-label">Tahun Lahir Ibu</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="mother_birth_year" value="<?=$query->mother_birth_year ? $query->mother_birth_year : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="mother_education" class="col-sm-4 control-label">Pendidikan Ibu</label>
									<div class="col-sm-8">
										<?=form_dropdown('mother_education', $education, $query->mother_education, 'id="mother_education" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="mother_employment" class="col-sm-4 control-label">Pekerjaan Ibu</label>
									<div class="col-sm-8">
										<?=form_dropdown('mother_employment', $employment, $query->mother_employment, 'id="mother_employment" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="mother_monthly_income" class="col-sm-4 control-label">Penghasilan Bulanan Ibu</label>
									<div class="col-sm-8">
										<?=form_dropdown('mother_monthly_income', $monthly_income, $query->mother_monthly_income, 'id="mother_monthly_income" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="mother_special_needs" class="col-sm-4 control-label">Kebutuhan Khusus Ibu</label>
									<div class="col-sm-8">
										<?=form_dropdown('mother_special_needs', $special_needs, $query->mother_special_needs, 'id="mother_special_needs" class="form-control"');?>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="tab_5">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="guardian_name" class="col-sm-4 control-label">Nama Wali</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="guardian_name" value="<?=$query->guardian_name ? $query->guardian_name : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="guardian_birth_year" class="col-sm-4 control-label">Tahun Lahir Wali</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="guardian_birth_year" value="<?=$query->guardian_birth_year ? $query->guardian_birth_year : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="guardian_education" class="col-sm-4 control-label">Pendidikan Wali</label>
									<div class="col-sm-8">
										<?=form_dropdown('guardian_education', $education, $query->guardian_education, 'id="guardian_education" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="guardian_employment" class="col-sm-4 control-label">Pekerjaan Wali</label>
									<div class="col-sm-8">
										<?=form_dropdown('guardian_employment', $employment, $query->guardian_employment, 'id="guardian_employment" class="form-control"');?>
									</div>
								</div>
								<div class="form-group">
									<label for="guardian_monthly_income" class="col-sm-4 control-label">Penghasilan Bulanan Wali</label>
									<div class="col-sm-8">
										<?=form_dropdown('guardian_monthly_income', $monthly_income, $query->guardian_monthly_income, 'id="guardian_monthly_income" class="form-control"');?>
									</div>
								</div>
							</div>
						</form>
					</div>
					<div class="tab-pane" id="tab_6">
						<form class="form-horizontal">
							<div class="box-body">
								<div class="form-group">
									<label for="mileage" class="col-sm-4 control-label">Jarak Tempat Tinggal ke <?=get_school_level() == 5 ? 'Kampus' : 'Sekolah'?></label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="mileage" value="<?=$query->mileage ? $query->mileage : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="traveling_time" class="col-sm-4 control-label">Waktu Tempuh ke <?=get_school_level() == 5 ? 'Kampus' : 'Sekolah'?></label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="traveling_time" value="<?=$query->traveling_time ? $query->traveling_time : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="height" class="col-sm-4 control-label">Tinggi Badan (Cm)</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="height" value="<?=$query->height ? $query->height : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="weight" class="col-sm-4 control-label">Berat Badan (Kg)</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="weight" value="<?=$query->weight ? $query->weight : '';?>">
									</div>
								</div>
								<div class="form-group">
									<label for="sibling_number" class="col-sm-4 control-label">Jumlah Saudara Kandung</label>
									<div class="col-sm-8">
									  <input type="text" class="form-control" id="sibling_number" value="<?=$query->sibling_number ? $query->sibling_number : '';?>">
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