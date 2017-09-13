<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<?=link_tag('assets/css/jquery-ui.css');?>
<script type="text/javascript" src="<?=base_url('assets/js/jquery-ui.js');?>"></script>
<script type="text/javascript">
	$( document ).ready( function() {
		$('#reset').on('click', function() {
			$('#registrants').importTags('');
		});

		/* Registrants */
		$('#registrants').tagsInput({
			'width': 'auto',
			'height':'300px',
			'autocomplete_url': _BASE_URL + 'admission/selection_process/autocomplete',
		   'interactive':true,
		   'defaultText':'Add New Registrants',
		   'delimiter': [', '],
		   'removeWithBackspace' : true,
		   'minChars' : '3',
		   'maxChars' : 0,
		   'placeholderColor' : '#666666'
		});

		/* Submit */
		$('#submit').on('click', function(e) {
			e.preventDefault();
			var values = {
				selection_result: $('#selection_result').val(),
				registrants: $('#registrants').val()
			};
			$.post(_BASE_URL + 'admission/selection_process/save', values, function(response) {
				var res = H.stringToJSON(response);
				H.growl(res.type, H.message(res.message));
				if (res.type == 'success') {
					$('#registrants').importTags('');
				}
			});
		});
	});
</script>
<section class="content-header">
   <h1><i class="fa fa-hourglass-start text-green"></i> <?=ucwords(strtolower($title));?></h1>
 </section>
 <section class="content">
 	<div class="panel panel-default">
		<div class="panel-body">
			<form class="form-horizontal">
				<div class="box-body">
					<div class="form-group">
                  <label for="selection_result" class="col-sm-3 control-label">Hasil Seleksi</label>
                  <div class="col-sm-9">
                  	<?=form_dropdown('selection_result', $options, '', 'class="form-control" id="selection_result"');?>
                  </div>
               </div>
               <div class="form-group">
                  <label for="registrants" class="col-sm-3 control-label">Calon <?=get_school_level() == 5 ? 'Mahasiswa' : 'Peserta Didik'?> Baru</label>
                  <div class="col-sm-9">
                    	<textarea name="registrants" id="registrants" class="form-control tm-input-info tm-tag-mini" rows="10" placeholder="Type registration number here..."></textarea>
                  </div>
               </div>               
               <div class="btn-group col-md-9 col-md-offset-3">
                  <button id="submit" class="btn btn-primary submit"><i class="fa fa-save"></i> SAVE</button>
                  <button id="reset" type="reset" class="btn btn-warning"><i class="fa fa-refresh"></i> RESET</button>
               </div>
      	  	</div>
         </form>
		</div>
	</div>
 </section>