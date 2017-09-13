<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript" src="<?=base_url('assets/plugins/plupload-2.1.9/js/plupload.full.min.js');?>"></script>
<script type="text/javascript" src="<?=base_url('assets/plugins/plupload-2.1.9/js/jquery.plupload.queue/jquery.plupload.queue.min.js')?>"></script>
<section class="content-header">
    <h1><i class="fa fa-upload text-green"></i> <?=$title;?></h1>
</section>
 <section class="content">
	<div class="box">
		<div class="box-header with-border">
			<div class="row">
				<div class="col-sm-12">
					<div class="box-tools">
						<button class="btn btn-primary btn-sm" id="pickfiles"><i class="fa fa-paperclip"></i> PILIH GAMBAR</button>
						<button class="btn btn-info btn-sm" id="uploadfiles"><i class="fa fa-upload"></i> UPLOAD</button>
						<a href="<?=site_url('media/albums');?>" class="btn btn-default btn-sm pull-right"><i class="fa fa-mail-forward"></i> KEMBALI</a>
                        <span id="success"></span>
						<span id="failled"></span>
					</div>
				</div>
			</div>			
		</div>
		<div class="box-body table-responsive no-padding">
			<table class="table table-hover">
				<thead id="thead" style="display: none;">
				<tr>					
					<th>FILE NAME</th>
					<th width="20%">FILE TYPE</th>
					<th width="20%">FILE SIZE</th>
					<th width="10%">STATUS</th>
				</tr>
				</thead>
			<tbody id="filelist"></tbody>
			</table>
		</div>
		<div class="overlay" style="display: none;">
			<i class="fa fa-refresh fa-spin"></i>
      </div>
	</div>
</section>
<script type="text/javascript">
    $(document).ready(function() {
        var success = 0, failled =0;
        var uploader = new plupload.Uploader({
            runtimes: 'html5,flash,silverlight,html4',
            browse_button: 'pickfiles',
            container: $('#container_upload')[0],
            url: '<?=$action;?>',
            filters: {
                mime_types: [
                    { title:"Image files", extensions:'jpg,png,jpeg' }        
                ]
            }, 
            flash_swf_url: '<?=base_url("assets/plugins/plupload-2.1.9/js/Moxie.swf");?>',
            silverlight_xap_url: '<?=base_url("assets/plugins/plupload-2.1.9/js/Moxie.xap");?>',
            init: {
                PostInit: function() {
                    $('#filelist').html('');
                    $('#uploadfiles').on('click', function() {
                        $('.overlay').show();
                        uploader.start();
                        return false;
                    });
                },
                FilesAdded: function(up, files) {
                	$('#thead').show();
                 	var html = '';
                 	plupload.each(files, function(response) {
	                  html += '<tr id="row_' + response.size + '">' 
							+ '<td>' + response.name + '</td>'
							+ '<td>' + response.type + '</td>'
							+ '<td>' + plupload.formatSize(response.size) + '</td>'
							+ '<td id="status_'+response.size+'"></td>'
							+ '</tr>';
						});
						$('#filelist').html(html);
                },
                FileUploaded: function(up, file, info) {
                    var res = JSON.parse(info.response);
                    if (res.type == 'success') {
                        success++;
                        $('#success').html(success + ' file uploaded.');
                        $('#status_'+file.size).html('<i class="fa fa-check-circle-o"></i>');
                    } else {
                        failled++;
                        $('#failled').html(failled + ' file not uploaded.');
                        $('#status_'+file.size).html('<i class="fa fa-close"></i>');
                    }
                },
                UploadComplete:function(up, file) {
                    $('.overlay').hide();
                },
                Error: function(up, err) {
                    console.log(up, err);
                }
            }
        });
        uploader.init();
	});
</script>