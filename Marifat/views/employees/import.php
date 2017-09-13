<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	// Import Employees
	function import_employees() {
		$('#submit').attr('disabled', 'disabled');
		$('#loading').show();
		var values = {
			employees: $('#employees').val()
		};
		$.post('<?=site_url("employees/import/save");?>', values, function(response) {
			var res = H.stringToJSON(response);
			H.growl(res.type, H.message(res.message));
			$('#employees').val('');
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
	         			<li>Copy dan paste <strong>[NIK] [NAMA LENGKAP] [JENIS KELAMIN] [ALAMAT JALAN]</strong> dari Ms. Excel disini.</li>
	         			<li>Kolom <strong>JENIS KELAMIN</strong> diisi huruf <strong>"M"</strong> jika Laki-laki dan <strong>"F"</strong> jika Perempuan.</li>
	         		</ul>
	         	</div>
					<div class="form-group">
               	<textarea autofocus id="employees" name="employees" class="form-control" rows="16" placeholder="Paste here..."></textarea>
            	</div>
				</div>
				<div class="box-footer">
               <button type="submit" onclick="import_employees(); return false;" class="btn btn-primary"><i class="fa fa-upload"></i> IMPORT</button>
               <img id="loading" style="display: none;" src="<?=base_url('assets/img/loading.gif');?>">
            </div>
         </form>
		</div>
	</div>
 </section>