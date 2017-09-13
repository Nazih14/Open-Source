<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	var page = 1;
	var total_pages = "<?=$total_pages;?>";
	$(document).ready(function() {
		if (parseInt(total_pages) == page || total_pages == 0) {
			$('button.load-more').remove();
		}
	});
	function load_more_files() {
		page++;
		var data = {
			page_number: page,
			slug: '<?=$this->uri->segment(2)?>'
		};		
		if ( page <= total_pages ) {
			$.post( _BASE_URL + 'public/download/more_files', data, function( response ) {
				var res = typeof response !== 'object' ? $.parseJSON( response ) : response;
				var rows = res.rows;
				var html = '';
				var no = parseInt($('.number:last').text()) + 1;
				for (var z in rows) {
					var result = rows[ z ];
					html += '<tr>';
					html += '<td class="text-center number">' + no + '</td>';
					html += '<td>' + result.file_title + '</td>';
					html += '<td>' + result.file_size + '</td>';
					html += '<td>' + result.file_type + '</td>';
					html += '<td>' + result.file_counter + '</td>';
					html += '<td class="text-center">';
					html += '<a href="' + _BASE_URL + 'public/download/force_download/' + result.id + '"><i class="fa fa-download"></i></a>';
					html += '</td>';
					html += '</tr>';
					no++;					
				}
				var el = $("tbody > tr:last"); 
				$( html ).insertAfter(el);
				if ( page == total_pages ) {
					$('button.load-more').remove();
				}
			});
		}
	}
</script>
<div class="col-xs-12 col-md-9">
	<div class="panel panel-default">
	  	<div class="panel-heading"><i class="fa fa-download"></i> <?=strtoupper($page_title)?></div>
  		<table class="table table-hover table-striped table-condensed">
			<thead>
				<tr>
					<th width="20px">NO</th>
					<th>NAMA FILE</th>
					<th>UKURAN (KB)</th>
					<th>TIPE</th>
					<th>DIUNDUH</th>
					<th width="40px" class="text-center"><i class="fa fa-download"></i></th>
				</tr>
			</thead>
			<tbody>
				<?php $no = 1; foreach($query->result() as $row) { ?>
				<tr>
					<td class="text-center number"><?=$no?></td>
					<td><?=$row->file_title?></td>
					<td><?=$row->file_size?></td>
					<td><?=$row->file_type?></td>
					<td><?=$row->file_counter?> Kali</td>
					<td class="text-center">
						<a href="<?=site_url('public/download/force_download/'.$row->id)?>"><i class="fa fa-download"></i></a>						
					</td>
				</tr>
				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
	<button class="btn btn-success btn-sm btn-block load-more" onclick="load_more_files()">MORE FILES</button>
</div>
<?php $this->load->view('themes/cosmo/sidebar')?>