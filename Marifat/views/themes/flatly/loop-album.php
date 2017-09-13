<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	var page = 1;
	var total_pages = "<?=$total_pages;?>";
	$(document).ready(function() {
		if (parseInt(total_pages) == page || total_pages == 0) {
			$('button.load-more').remove();
		}
	});	
	function load_more() {
		page++;
		var data = {
			page_number: page
		};
		
		if ( page <= total_pages ) {
			$.post( _BASE_URL + 'public/gallery_photos/more_photos', data, function( response ) {
				var res = typeof response !== 'object' ? $.parseJSON( response ) : response;
				var rows = res.rows;
				var total_rows = res.total_rows;
				var idx = 3, html = '';
				for (var z in rows) {
					var result = rows[ z ];
					html += (idx % 3 == 0) ? '<div class="row loop-album">' : '';
					html += '<div class="col-md-4 col-xs-12">';
					html += '<div class="thumbnail">';
					html += '<img style="cursor: pointer; width: 100%; height: 250px;" onclick="preview(' + result.id + ')" src="' + _BASE_URL + 'media_library/albums/' + result.album_cover + '">';
					html += '<div class="caption">';
					html += '<h4>' + result.album_title + '</h4>';
					html += '<p>' + result.album_description + '</p>';
					html += '<button onclick="preview(' + result.id + ')" class="btn btn-success btn-sm"><i class="fa fa-search"></i></button>';
					html += '</div>';
					html += '</div>';
					html += '</div>';
					html += ((idx % 3 == 2) || total_rows + 2 == idx) ? '</div>' : '';
					idx++;
				}
				var el = $("div.loop-album:last"); 
				$( html ).insertAfter(el);
				if (page == total_pages) {
					$('button.load-more').remove();
				}
			});
		}
	}
</script>
<div class="col-xs-12 col-md-12">
	<ol class="breadcrumb post-header">
		<li><i class="fa fa-camera"></i> GALLERY PHOTO</li>
	</ol>
	<?php $idx = 3; $rows = $query->num_rows(); foreach($query->result() as $row) { ?>
		<?=($idx % 3 == 0) ? '<div class="row loop-album">':''?>
			<div class="col-md-4 col-xs-12">
				<div class="thumbnail">
					<img style="cursor: pointer; width: 100%; height: 250px;" onclick="preview(<?=$row->id?>)" src="<?=base_url('media_library/albums/'.$row->album_cover)?>">
					<div class="caption">
						<h4><?=$row->album_title?></h4>
						<p><?=$row->album_description?></p>
						<button onclick="preview(<?=$row->id?>)" class="btn btn-success btn-sm"><i class="fa fa-search"></i></button>
					</div>
				</div>
			</div>
		<?=(($idx % 3 == 2) || ($rows+2 == $idx)) ? '</div>':''?>
	<?php $idx++; } ?>
	<button class="btn btn-success btn-sm btn-block load-more" onclick="load_more()">MORE ALBUMS</button>
</div>