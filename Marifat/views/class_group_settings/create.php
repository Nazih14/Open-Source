<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?=link_tag('assets/css/jquery-ui.css');?>
<script type="text/javascript" src="<?=base_url('assets/js/jquery-ui.js');?>"></script>
<section class="content-header">
   <h1><i class="fa fa-sign-out text-green"></i> <?=ucwords(strtolower($title));?></h1>
 </section>
 <section class="content">
 	<div class="panel panel-default">
		<div class="panel-body">
			<form class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
                  <label for="academic_year_id" class="col-sm-3 control-label">Tahun Akademik</label>
                  <div class="col-sm-9">
                  	<?=form_dropdown('academic_year_id', $ds_academic_years, '', 'class="form-control" id="academic_year_id"');?>
                  </div>
               </div>
               <div class="form-group">
                  <label for="class_group_id" class="col-sm-3 control-label">Kelas</label>
                  <div class="col-sm-9">
                    	<?=form_dropdown('class_group_id', $ds_class_groups, '', 'class="form-control" id="class_group_id"');?>
                  </div>
               </div>
               <div class="form-group">
                  <label for="students" class="col-sm-3 control-label"><?=get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik'?></label>
                  <div class="col-sm-9">
                    	<textarea name="students" id="students" class="form-control tm-input-info tm-tag-mini" rows="10" placeholder="Type NIS (Nomor Induk Siswa) here..."></textarea>
                  </div>
               </div>               
               <div class="btn-group col-md-9 col-md-offset-3">
                  <button type="submit" onclick="save(); return false;" class="btn btn-primary submit"><i class="fa fa-save"></i> SAVE</button>
               </div>
      	  	</div>
         </form>
		</div>
	</div>
 </section>
 <script type="text/javascript">
	// Save
	function save() {
		var values = {
			academic_year_id: $('#academic_year_id').val(),
			class_group_id: $('#class_group_id').val(),
			students: $('#students').val()
		};
		$.post(_BASE_URL + 'students/class_group_settings/save', values, function(response) {
			var res = H.stringToJSON(response);
			H.growl(res.type, H.message(res.message));
			if (res.type == 'success') {
				$('#students').importTags('');
			}
		});
	}
	
	// Get autocomplete URL
	function get_url() {
		var academic_year_id = $('#academic_year_id').val() || 0;
		var class_group_id = $('#class_group_id').val() || 0;
		var params = '?academic_year_id=' + academic_year_id + '&class_group_id=' + class_group_id;
		var url = _BASE_URL + 'students/class_group_settings/autocomplete' + params;
		return url;
	}

	$( document ).ready( function() {
		// Select2
		$('.select2').select2();

		/* Get Students */
		$('#students').tagsInput({
			width: 'auto',
			height:'300px',
			autocomplete_url: function(request, response) {
				var url = get_url() + '&term=' + request.term;
				$.get(url, function(data) {
					response(data);
				});
			},
		   interactive:true,
		   defaultText:'Add New',
		   delimiter: [', '],
		   removeWithBackspace: true,
		   minChars: '3',
		   maxChars: 0,
		   placeholderColor: '#666666'
		});
	});
</script>