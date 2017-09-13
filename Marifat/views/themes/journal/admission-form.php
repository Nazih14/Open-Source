<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
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

		var citizenship = $('#citizenship').val();
		if (citizenship == 'WNI') {
			$('.country').hide();
		}
	});
</script>
<div class="col-xs-12 col-md-12">
	<form class="form-horizontal admission-form" role="form">
		<ul class="nav nav-tabs" role="tablist">
			<li role="presentation" class="active"><a href="#tab_1" aria-controls="tab_1" role="tab" data-toggle="tab"><i class="fa fa-angle-double-right"></i> REGISTRASI PESERTA DIDIK</a></li>
			<li role="presentation"><a href="#tab_2" aria-controls="tab_2" role="tab" data-toggle="tab"><i class="fa fa-angle-double-right"></i> DATA PRIBADI</a></li>
			<li role="presentation"><a href="#tab_3" aria-controls="tab_3" role="tab" data-toggle="tab"><i class="fa fa-angle-double-right"></i> DATA AYAH KANDUNG</a></li>
			<li role="presentation"><a href="#tab_4" aria-controls="tab_4" role="tab" data-toggle="tab"><i class="fa fa-angle-double-right"></i> DATA IBU KANDUNG</a></li>
			<li role="presentation"><a href="#tab_5" aria-controls="tab_5" role="tab" data-toggle="tab"><i class="fa fa-angle-double-right"></i> DATA WALI</a></li>
			<li role="presentation"><a href="#tab_6" aria-controls="tab_6" role="tab" data-toggle="tab"><i class="fa fa-angle-double-right"></i> DATA PERIODIK</a></li>
			<li role="presentation"><a href="#tab_7" aria-controls="tab_7" role="tab" data-toggle="tab"><i class="fa fa-angle-double-right"></i> SELESAI</a></li>
		</ul>
		<div class="tab-content">
			<div role="tabpanel" class="tab-pane active" id="tab_1">
				<div class="form-group">
					<label for="is_transfer" class="col-sm-4 control-label">Jenis Pendaftaran <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<?=form_dropdown('is_transfer', ['' => 'Pilih :', 'false' => 'Baru', 'true' => 'Pindahan'], set_value('is_transfer'), 'class="form-control" id="is_transfer"')?>
					</div>
				</div>
				
				<!-- Khusus SMK atau Universitas -->
				<?php if (in_array(get_school_level(), have_majors())) { ?>
				<div class="form-group">
					<label for="first_choice" class="col-sm-4 control-label">Pilihan I (Satu) <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<?=form_dropdown('first_choice', $majors, set_value('first_choice'), 'class="form-control" id="first_choice" onchange="check_options(1)" onblur="check_options(1)" onmouseup="check_options(1)"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="second_choice" class="col-sm-4 control-label">Pilihan II (Dua) <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<?=form_dropdown('second_choice', $majors, set_value('second_choice'), 'class="form-control" id="second_choice" onchange="check_options(2)" onblur="check_options(2)" onmouseup="check_options(2)"')?>
					</div>
				</div>
				<?php } ?>

				<!-- Khusus SMP/Sederajat dan SMA/Sederajat -->
				<?php if (get_school_level() == 2 || get_school_level() == 3 || get_school_level() == 4) { ?>
				<div class="form-group">
					<label for="prev_exam_number" class="col-sm-4 control-label">Nomor Peserta Ujian Nasional Sebelumnya</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('prev_exam_number')?>" class="form-control" id="prev_exam_number" name="prev_exam_number">
					</div>
				</div>
				<div class="form-group">
					<label for="paud" class="col-sm-4 control-label">Apakah pernah PAUD</label>
					<div class="col-sm-8">
						<?=form_dropdown('paud', ['' => 'Pilih :', 'false' => 'Tidak', 'true' => 'Ya'], set_value('paud'), 'class="form-control" id="paud"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="tk" class="col-sm-4 control-label">Apakah pernah TK</label>
					<div class="col-sm-8">
						<?=form_dropdown('tk', ['' => 'Pilih :', 'false' => 'Tidak', 'true' => 'Ya'], set_value('tk'), 'class="form-control" id="tk"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="skhun" class="col-sm-4 control-label">Nomor Seri SKHUN Sebelumnya</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('skhun')?>" class="form-control" id="skhun" name="skhun" placeholder="Nomor Surat Keterangan Hasil Ujian Nasional">
					</div>
				</div>
				<div class="form-group">
					<label for="diploma_number" class="col-sm-4 control-label">Nomor Seri Ijazah Sebelumnya</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('diploma_number')?>" class="form-control" id="diploma_number" name="diploma_number" placeholder="Nomor Seri Ijazah Sebelumnya">
					</div>
				</div>
				<?php } ?>

				<div class="form-group">
					<label for="hobby" class="col-sm-4 control-label">Hobi</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('hobby')?>" class="form-control" id="hobby" name="hobby">
					</div>
				</div>
				<div class="form-group">
					<label for="ambition" class="col-sm-4 control-label">Cita-cita</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('ambition')?>" class="form-control" id="ambition" name="ambition">
					</div>
				</div>

				

			</div>
			<div role="tabpanel" class="tab-pane" id="tab_2">
				<div class="form-group">
					<label for="full_name" class="col-sm-4 control-label">Nama Lengkap <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('full_name')?>" class="form-control" id="full_name" name="full_name">
					</div>
				</div>
				<div class="form-group">
					<label for="gender" class="col-sm-4 control-label">Jenis Kelamin <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<?=form_dropdown('gender', ['' => 'Pilih :', 'M' => 'Laki-laki', 'F' => 'Perempuan'], set_value('gender'), 'class="form-control" id="gender"')?>
					</div>
				</div>
				
				<!-- Khusus SMP/Sederajat, SMA/Sederajat -->
				<?php if (get_school_level() == 2 || get_school_level() == 3 || get_school_level() == 4) { ?>
				<div class="form-group">
					<label for="nisn" class="col-sm-4 control-label">NISN</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('nisn')?>" class="form-control" id="nisn" name="nisn" placeholder="Nomor Induk Sekolah Nasional">
					</div>
				</div>
				<?php } ?>

				<!-- Khusus Selain SD -->
				<?php if (get_school_level() != 1) { ?>
				<div class="form-group">
					<label for="nik" class="col-sm-4 control-label">NIK <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('nik')?>" class="form-control" id="nik" name="nik" placeholder="Nomor Induk Kependudukan">
					</div>
				</div>
				<?php } ?>

				<div class="form-group">
					<label for="birth_place" class="col-sm-4 control-label">Tempat Lahir <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('birth_place')?>" class="form-control" id="birth_place" name="birth_place">
					</div>
				</div>
				<div class="form-group">
					<label for="birth_date" class="col-sm-4 control-label">Tanggal Lahir <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<div class="input-group">
							<input readonly="true" type="text" value="<?php echo set_value('birth_date')?>" class="form-control" id="birth_date" name="birth_date">
							<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="religion" class="col-sm-4 control-label">Agama <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<?=form_dropdown('religion', $religion, set_value('religion'), 'class="form-control" id="religion"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="special_needs" class="col-sm-4 control-label">Kebutuhan Khusus</label>
					<div class="col-sm-8">
						<?=form_dropdown('special_needs', $special_needs, set_value('special_needs'), 'class="form-control" id="special_needs"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="street_address" class="col-sm-4 control-label">Alamat Jalan <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<textarea rows="4" name="street_address" id="street_address" class="form-control"><?php echo set_value('street_address')?></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="rt" class="col-sm-4 control-label">RT</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('rt')?>" class="form-control" id="rt" name="rt" placeholder="Rukun Tetangga">
					</div>
				</div>
				<div class="form-group">
					<label for="rw" class="col-sm-4 control-label">RW</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('rw')?>" class="form-control" id="rw" name="rw" placeholder="Rukun Warga">
					</div>
				</div>
				<div class="form-group">
					<label for="sub_village" class="col-sm-4 control-label">Nama Dusun</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('sub_village')?>" class="form-control" id="sub_village" name="sub_village">
					</div>
				</div>
				<div class="form-group">
					<label for="village" class="col-sm-4 control-label">Nama Kelurahan/ Desa</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('village')?>" class="form-control" id="village" name="village">
					</div>
				</div>
				<div class="form-group">
					<label for="sub_district" class="col-sm-4 control-label">Kecamatan</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('sub_district')?>" class="form-control" id="sub_district" name="sub_district">
					</div>
				</div>
				<div class="form-group">
					<label for="district" class="col-sm-4 control-label">Kabupaten <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('district')?>" class="form-control" id="district" name="district">
					</div>
				</div>
				<div class="form-group">
					<label for="postal_code" class="col-sm-4 control-label">Kode Pos</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('postal_code')?>" class="form-control" id="postal_code" name="postal_code">
					</div>
				</div>
				<div class="form-group">
					<label for="residence" class="col-sm-4 control-label">Tempat Tinggal</label>
					<div class="col-sm-8">
						<?=form_dropdown('residence', $residence, set_value('residence'), 'class="form-control" id="residence"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="transportation" class="col-sm-4 control-label">Moda Transportasi</label>
					<div class="col-sm-8">
						<?=form_dropdown('transportation', $transportation, set_value('transportation'), 'class="form-control" id="transportation"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="mobile_phone" class="col-sm-4 control-label">Nomor HP <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('mobile_phone')?>" class="form-control" id="mobile_phone" name="mobile_phone">
					</div>
				</div>
				<div class="form-group">
					<label for="phone" class="col-sm-4 control-label">Nomor Telepon</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('phone')?>" class="form-control" id="phone" name="phone">
					</div>
				</div>
				<div class="form-group">
					<label for="email" class="col-sm-4 control-label">E-mail Pribadi</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('email')?>" class="form-control" id="email" name="email">
					</div>
				</div>
				<div class="form-group">
					<label for="sktm" class="col-sm-4 control-label">No. Surat Keterangan Tidak Mampu (SKTM)</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('sktm')?>" class="form-control" id="sktm" name="sktm">
					</div>
				</div>
				<div class="form-group">
					<label for="kks" class="col-sm-4 control-label">No. Kartu Keluarga Sejahtera (KKS)</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('kks')?>" class="form-control" id="kks" name="kks">
					</div>
				</div>
				<div class="form-group">
					<label for="kps" class="col-sm-4 control-label">No. Kartu Pra Sejahtera (KPS)</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('kps')?>" class="form-control" id="kps" name="kps">
					</div>
				</div>
				<div class="form-group">
					<label for="kip" class="col-sm-4 control-label">No. Kartu Indonesia Pintar (KIP)</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('kip')?>" class="form-control" id="kip" name="kip">
					</div>
				</div>
				<div class="form-group">
					<label for="kis" class="col-sm-4 control-label">No. Kartu Indonesia Sehat (KIS)</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('kis')?>" class="form-control" id="kis" name="kis">
					</div>
				</div>
				<div class="form-group">
					<label for="citizenship" class="col-sm-4 control-label">Kewarganegaraan <span style="color: red">*</span></label>
					<div class="col-sm-8">					 
						<select name="citizenship" id="citizenship" class="form-control" onchange="change_country_field()" onblur="change_country_field()" onmouseup="change_country_field()">
							<option value="">Pilih :</option>
							<option value="WNI">Warga Negara Indonesia (WNI)</option>
							<option value="WNA">Warga Negara Asing (WNA)</option>
						</select>
					</div>
				</div>
				<div class="form-group country">
					<label for="country" class="col-sm-4 control-label">Nama Negara</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('country')?>" class="form-control" id="country" name="country" placeholder="Diisi jika warga negara asing">
					</div>
				</div>
				<div class="form-group">
					<label for="country" class="col-sm-4 control-label">Photo</label>
					<div class="col-sm-8">
						<input type="file" id="file" name="file" style="margin-top: 12px;">
		    			<p class="help-block">Format file harus JPG dan ukuran file maksimal 1 Mb</p>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="tab_3">
				<div class="form-group">
					<label for="father_name" class="col-sm-4 control-label">Nama Ayah Kandung <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('father_name')?>" class="form-control" id="father_name" name="father_name">
					</div>
				</div>
				<div class="form-group">
					<label for="father_birth_year" class="col-sm-4 control-label">Tahun Lahir <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('father_birth_year')?>" class="form-control" id="father_birth_year" name="father_birth_year" placeholder="Tahun Lahir Ayah Kandung. contoh : 1965">
					</div>
				</div>
				<div class="form-group">
					<label for="father_education" class="col-sm-4 control-label">Pendidikan</label>
					<div class="col-sm-8">
						<?=form_dropdown('father_education', $education, set_value('father_education'), 'class="form-control" id="father_education"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="father_employment" class="col-sm-4 control-label">Pekerjaan</label>
					<div class="col-sm-8">
						<?=form_dropdown('father_employment', $employment, set_value('father_employment'), 'class="form-control" id="father_employment"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="father_monthly_income" class="col-sm-4 control-label">Penghasilan Bulanan</label>
					<div class="col-sm-8">
						<?=form_dropdown('father_monthly_income', $monthly_income, set_value('father_monthly_income'), 'class="form-control" id="father_monthly_income"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="father_special_needs" class="col-sm-4 control-label">Kebutuhan Khusus</label>
					<div class="col-sm-8">
						<?=form_dropdown('father_special_needs', $special_needs, set_value('father_special_needs'), 'class="form-control" id="father_special_needs"')?>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="tab_4">
				<div class="form-group">
					<label for="mother_name" class="col-sm-4 control-label">Nama Ibu Kandung <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('mother_name')?>" class="form-control" id="mother_name" name="mother_name">
					</div>
				</div>
				<div class="form-group">
					<label for="mother_birth_year" class="col-sm-4 control-label">Tahun Lahir</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('mother_birth_year')?>" class="form-control" id="mother_birth_year" name="mother_birth_year" placeholder="Tahun Lahir Ibu Kandung. contoh : 1965">
					</div>
				</div>
				<div class="form-group">
					<label for="mother_education" class="col-sm-4 control-label">Pendidikan</label>
					<div class="col-sm-8">
						<?=form_dropdown('mother_education', $education, set_value('mother_education'), 'class="form-control" id="mother_education"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="mother_employment" class="col-sm-4 control-label">Pekerjaan</label>
					<div class="col-sm-8">
						<?=form_dropdown('mother_employment', $employment, set_value('mother_employment'), 'class="form-control" id="mother_employment"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="mother_monthly_income" class="col-sm-4 control-label">Penghasilan Bulanan</label>
					<div class="col-sm-8">
						<?=form_dropdown('mother_monthly_income', $monthly_income, set_value('mother_monthly_income'), 'class="form-control" id="mother_monthly_income"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="mother_special_needs" class="col-sm-4 control-label">Kebutuhan Khusus</label>
					<div class="col-sm-8">
						<?=form_dropdown('mother_special_needs', $special_needs, set_value('mother_special_needs'), 'class="form-control" id="mother_special_needs"')?>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="tab_5">
				<div class="form-group">
					<label for="guardian_name" class="col-sm-4 control-label">Nama Wali</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('guardian_name')?>" class="form-control" id="guardian_name" name="guardian_name">
					</div>
				</div>
				<div class="form-group">
					<label for="guardian_birth_year" class="col-sm-4 control-label">Tahun Lahir</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('guardian_birth_year')?>" class="form-control" id="guardian_birth_year" name="guardian_birth_year" placeholder="Tahun Lahir Wali. contoh : 1965">
					</div>
				</div>
				<div class="form-group">
					<label for="guardian_education" class="col-sm-4 control-label">Pendidikan</label>
					<div class="col-sm-8">
						<?=form_dropdown('guardian_education', $education, set_value('guardian_education'), 'class="form-control" id="guardian_education"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="guardian_employment" class="col-sm-4 control-label">Pekerjaan</label>
					<div class="col-sm-8">
						<?=form_dropdown('guardian_employment', $employment, set_value('guardian_employment'), 'class="form-control" id="guardian_employment"')?>
					</div>
				</div>
				<div class="form-group">
					<label for="guardian_monthly_income" class="col-sm-4 control-label">Penghasilan Bulanan</label>
					<div class="col-sm-8">
						<?=form_dropdown('guardian_monthly_income', $monthly_income, set_value('guardian_monthly_income'), 'class="form-control" id="guardian_monthly_income"')?>
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="tab_6">
				<div class="form-group">
					<label for="height" class="col-sm-4 control-label">Tinggi Badan (Cm)</label>
					<div class="col-sm-8">
						<input type="number" value="<?php echo set_value('height')?>" class="form-control" id="height" name="height">
					</div>
				</div>
				<div class="form-group">
					<label for="weight" class="col-sm-4 control-label">Berat Badan (Kg)</label>
					<div class="col-sm-8">
						<input type="number" value="<?php echo set_value('weight')?>" class="form-control" id="weight" name="weight">
					</div>
				</div>
				<div class="form-group">
					<label for="mileage" class="col-sm-4 control-label">Jarak Tempat Tinggal ke Sekolah (Km)</label>
					<div class="col-sm-8">
						<input type="text" value="<?php echo set_value('mileage')?>" class="form-control" id="mileage" name="mileage">
					</div>
				</div>
				<div class="form-group">
					<label for="traveling_time" class="col-sm-4 control-label">Waktu Tempuh ke Sekolah (Menit)</label>
					<div class="col-sm-8">
						<input type="number" value="<?php echo set_value('traveling_time')?>" class="form-control" id="traveling_time" name="traveling_time">
					</div>
				</div>
				<div class="form-group">
					<label for="sibling_number" class="col-sm-4 control-label">Jumlah Saudara Kandung</label>
					<div class="col-sm-8">
						<input type="number" value="<?php echo set_value('sibling_number')?>" class="form-control" id="sibling_number" name="sibling_number">
					</div>
				</div>
			</div>
			<div role="tabpanel" class="tab-pane" id="tab_7">
				<div class="form-group">
					<label for="captcha" class="col-sm-4 control-label">Kode Keamanan <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<?=$captcha['image'];?>
					</div>
				</div>
				<div class="form-group">
					<label for="captcha" class="col-sm-4 control-label"></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="captcha" name="captcha" placeholder="Masukan 5 angka diatas">
					</div>
				</div>
				<div class="form-group">
					<label for="declaration" class="col-sm-4 control-label">Pernyataan <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="declaration" id="declaration"> Saya menyatakan dengan sesungguhnya bahwa isian data dalam formulir ini adalah benar. Apabila ternyata data tersebut tidak benar / palsu, maka saya bersedia menerima sanksi berupa <strong>Pembatalan</strong> sebagai <strong>Calon <?=get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik' ?></strong> <?=$this->session->userdata('school_name')?>
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<div class="col-sm-offset-4 col-sm-8">
						<button type="button" onclick="save_registration_form(); return false;" class="btn btn-success"><i class="fa fa-send"></i> SIMPAN FORMULIR PENDAFTARAN</button>
					</div>
				</div>
			</div>
		</div>				
	</form>
</div>