<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	// Import Students
	function import_students() {
		$('#submit').attr('disabled', 'disabled');
		$('#loading').show();
		var values = {
			students: $('#students').val()
		};
		$.post(_BASE_URL + 'students/import/save', values, function(response) {
			var res = H.stringToJSON(response);
			H.growl(res.type, H.message(res.message));
			$('#students').val('');
			$('#submit').removeAttr('disabled');
			$('#loading').hide();
		});
	}
</script>
<section class="content-header">
   <h1><i class="fa fa-upload text-green"></i> <?=ucwords(strtolower($title));?></h1>
 </section>
 <section class="content">
 	<div class="panel panel-default">
		<div class="panel-body">			
			<form role="form">
				<div class="box-body">
					<div class="callout callout-success">
	            	<h4>Petunjuk Singkat</h4>
	         		<ul>
	         			<li>Copy dan paste <strong>[NIS] [NAMA LENGKAP] [JENIS KELAMIN] [ALAMAT JALAN]</strong> dari Ms. Excel disini.</li>
	         			<li>Kolom <strong>JENIS KELAMIN</strong> diisi huruf <strong>"M"</strong> jika Laki-laki dan <strong>"F"</strong> jika Perempuan.</li>
	         			<li><?=get_school_level() == 5 ? 'Mahasiswa':'Peserta Didik'?> yang diimport akan otomatis statusnya menjadi <strong>"Aktif"</strong>. Pastikan data referensi status <?=get_school_level() == 5 ? 'Mahasiswa':'Peserta Didik'?> <strong>"Aktif"</strong> tersedia. Klik <a href="<?=site_url('students/student_status')?>"> disini</a> untuk melihat <strong>Daftar Status <?=get_school_level() == 5 ? 'Mahasiswa':'Peserta Didik'?></strong></li>
	         		</ul>
	         	</div>
					<div class="form-group">
               	<textarea autofocus id="students" name="students" class="form-control" rows="16" placeholder="Paste here..."></textarea>
            	</div>
				</div>
				<div class="box-footer">
               <button type="submit" onclick="import_students(); return false;" class="btn btn-primary"><i class="fa fa-upload"></i> IMPORT</button>
               <img id="loading" style="display: none;" src="<?=base_url('assets/img/loading.gif');?>">
            </div>
         </form>
		</div>
	</div>
 </section>