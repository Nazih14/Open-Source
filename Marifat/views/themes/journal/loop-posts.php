<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	function remove_tags(input) {
		return input.replace(/(<([^>]+)>)/ig,"");
	}
	var page = 1;
	var total_page = "<?=$total_page;?>";
	$(document).ready(function() {
		if (parseInt(total_page) == page || total_page == 0) {
			$('button.load-more').remove();
		}
	});

	function load_more() {
		page++;
		var segment_1 = '<?=$this->uri->segment(1)?>';
		var segment_2 = '<?=$this->uri->segment(2)?>';
		var segment_3 = '<?=$this->uri->segment(3)?>';
		var url = '';
		var data = {
			'page_number': page
		};
		if (segment_1 == 'category') {
			data['slug'] = segment_2;
			url = _BASE_URL + 'public/post_categories/more_posts';
		} else if (segment_1 == 'tag') {
			data['tag'] = segment_2;
			url = _BASE_URL + 'public/post_tags/more_posts';
		} else if (segment_1 == 'archives') {
			data['year'] = segment_2;
			data['month'] = segment_3;
			url = _BASE_URL + 'public/archives/more_posts';
		}
		if ( page <= total_page ) {
			$.post( url, data, function( response ) {
				var res = typeof response !== 'object' ? $.parseJSON( response ) : response;
				var rows = res.rows;
				var html = '';
				var idx = 3;
				for (var z in rows) {
					var result = rows[ z ];
					if (idx % 3 == 0) {
						html += '<div class="row loop-posts">';
					}
					html += '<div class="col-md-4">';
					html += '<div class="thumbnail no-border">';
					html += '<img src="' + _BASE_URL + 'media_library/posts/medium/' + result.post_image + '" style="width: 100%; display: block;">';
					html += '<div class="caption">';
					html += '<h4><a href="' + _BASE_URL + 'read/' + result.id + '/' + result.post_slug + '">' + result.post_title + '</a></h4>';
					html += '<p class="by-author">' + (new Date(result.created_at)).toString().substr(0, 24) + '</p>';
					html += '<p>' + remove_tags(result.post_content, '').substr(0, 150) + '</p>';
					html += '<p>';
					html += '<a href="' + _BASE_URL + 'read/' +result.id + '/' + result.post_slug + '" class="btn btn-primary btn-sm" role="button">Selengkapnya <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
					html += '</p>';
					html += '</div>';
					html += '</div>';
					html += '</div>';
					if (idx % 3 == 2 || (res.result_rows + 2) == idx) {
						html += '</div>';
					}
					idx++;
				}
				var el = $(".loop-posts:last"); 
				$( html ).insertAfter(el);
				if (page == total_page) {
					$('button.load-more').remove();
				}
			});
		}
	}
</script>
<div class="col-xs-12 col-md-9">
	<ol class="breadcrumb post-header">
		<li><?=strtoupper($title)?></li>
	</ol>
	<?php $idx = 3; $rows = $query->num_rows(); foreach($query->result() as $row) { ?>
		<?=($idx % 3 == 0) ? '<div class="row loop-posts">':''?>
		<div class="col-md-4">
			<div class="thumbnail no-border">
				<img src="<?=base_url('media_library/posts/medium/'.$row->post_image)?>" style="width: 100%; display: block;">
				<div class="caption">
					<h4><a href="<?=site_url('read/'.$row->id.'/'.$row->post_slug)?>"><?=$row->post_title?></a></h4>
					<p class="by-author"><?=date('D M d Y H:i:s', strtotime($row->created_at))?></p>
					<p><?=substr(strip_tags($row->post_content), 0, 150)?></p>
					<p>
						<a href="<?=site_url('read/'.$row->id.'/'.$row->post_slug)?>" class="btn btn-primary btn-sm" role="button">Selengkapnya <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
					</p>
				</div>
			</div>
		</div>
		<?=(($idx % 3 == 2) || ($rows+2 == $idx)) ? '</div>':''?>
	<?php $idx++; } ?>
	<button class="btn btn-success btn-sm btn-block load-more" onclick="load_more()">MORE POSTS</button>
</div>
<?php $this->load->view('themes/journal/sidebar')?>