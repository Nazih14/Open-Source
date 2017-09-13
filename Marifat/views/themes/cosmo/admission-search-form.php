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
	});
</script>
<div class="col-xs-12 col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-sign-out"></i> <?=strtoupper($page_title)?></h3>
		</div>
		<div class="panel-body">
			<form class="form-horizontal admission-form" role="form" action="<?=$action?>">
				<div class="form-group">
					<label for="registration_number" class="col-sm-4 control-label">Nomor Pendaftaran <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="registration_number" name="registration_number">
					</div>
				</div>
				<div class="form-group">
					<label for="birth_date" class="col-sm-4 control-label">Tanggal Lahir <span style="color: red">*</span></label>
					<div class="col-sm-8">
						<div class="input-group">
	          			<input readonly="true" type="text" class="form-control" id="birth_date" name="birth_date">
	          			<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
	        			</div>
					</div>
				</div>
	  			<div class="form-group">
	    			<div class="col-sm-offset-4 col-sm-8">
	      			<button type="button" onclick="<?=$onclick?>; return false;" class="btn btn-success"><?=$button?></button>
	    			</div>
	  			</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('themes/cosmo/sidebar')?>