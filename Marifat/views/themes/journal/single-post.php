<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<script type="text/javascript">
	var page = 1;
	var total_pages = "<?=$total_pages;?>";
	$(document).ready(function() {
		if (parseInt(total_pages) == page || parseInt(total_pages) == 0) {
			$('.panel-footer').remove();
		}
	});
	function more_comments() {
		page++;
		var data = {
			page_number: page,
			comment_post_id: '<?=$this->uri->segment(2)?>'
		};		
		if ( page <= parseInt(total_pages) ) {
			$('body').addClass('loading');
			$.post( _BASE_URL + 'public/post_comments/more_comments', data, function( response ) {
				var res = typeof response !== 'object' ? $.parseJSON( response ) : response;
				var comments = res.comments;
				var html = '';
				for (var z in comments) {
					var comment = comments[ z ];
					html += '<div class="panel panel-inverse" style="margin-bottom: 0px;">';
					html += '<div class="panel-heading" style="padding-bottom: 0px">';
					html += '<strong>' + comment.comment_author + '</strong> - <span class="text-muted">' + comment.created_at + '</span>';
					html += '</div>';
					html += '<div class="panel-body" style="padding-top: 0px">';
					html += '<p align="justify">' + comment.comment_content + '</p>';
					html += '</div>';
					html += '</div>';
				}
				var el = $(".panel-inverse:last"); 
				$( html ).insertAfter(el);
				if ( page == parseInt(total_pages) ) {
					$('.panel-footer').remove();
				}
				$('body').removeClass('loading');
			});
		}
	}
</script>
<div class="col-xs-12 col-md-9">
	<div class="thumbnail no-border">
		<?php if ($post_type == 'post' && file_exists('./media_library/posts/large/'.$query->post_image)) { ?>
		<img src="<?=base_url('media_library/posts/large/'.$query->post_image)?>" style="width: 100%; display: block;">
		<?php } ?>
		<div class="caption">
			<h3><?=$query->post_title?></h3>
			<p class="by-author">
				<?=day_name(date('N', strtotime($query->created_at)))?>, 
				<?=indo_date(substr($query->created_at, 0, 10))?> 
				~ Oleh <?=$post_author?>
				~ Dilihat <?=$query->post_counter?> Kali
			</p>
			<?=$query->post_content?>
			<div id="share1"></div>
			<script>
			$("#share1").jsSocials({
				shares: ["email", "twitter", "facebook", "googleplus", "linkedin", "pinterest", "stumbleupon", "whatsapp"]
			});
			</script>
			<?php 
        if ($query->post_tags) {
            $post_tags = explode(',', $query->post_tags);
            foreach ($post_tags as $tag) {
            	echo '<a style="margin-right:3px;" href="'.site_url('tag/'.url_title(strtolower(trim($tag)))).'">';
            	echo '<span class="label label-success">';
            	echo '<i class="fa fa-tags"></i> '.ucwords(strtolower(trim($tag)));
            	echo '</span>';
            	echo '</a>';
            }
        }
        ?>
		</div>
	</div>

	<?php if ($post_comments->num_rows() > 0) { ?>
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-comments-o"></i> KOMENTAR</h3>
		</div>
		<div class="panel-body">
			<?php foreach($post_comments->result() as $row) { ?>
			<div class="panel panel-inverse" style="margin-bottom: 0px;">
				<div class="panel-heading" style="padding-bottom: 0px">
					<strong><?=$row->comment_author?></strong> - <span class="text-muted"><?=day_name(date('N', strtotime($row->created_at)))?>, <?=indo_date($row->created_at)?></span>
				</div>
				<div class="panel-body" style="padding-top: 0px">
					<p align="justify"><?=strip_tags($row->comment_content)?></p>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="panel-footer">
			<button class="btn btn-sm btn-block btn-inverse load-more" onclick="more_comments()">KOMENTAR LAINNYA</button>
		</div>
	</div>
	<?php } ?>

	<?php if (
		(
			$query->post_comment_status == 'open' &&
			$this->session->userdata('comment_registration') == 'true' && 
			$this->auth->is_logged_in()
		) ||
		(
			$query->post_comment_status == 'open' &&
			$this->session->userdata('comment_registration') == 'false'
		)
	) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-comments-o"></i> KOMENTARI TULISAN INI</h3>
			</div>
			<div class="panel-body">
				<form class="form-horizontal">
					<div class="form-group">
						<label for="comment_author" class="col-sm-3 control-label">Nama Lengkap <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" id="comment_author" name="comment_author">
						</div>
					</div>
					<div class="form-group">
						<label for="comment_email" class="col-sm-3 control-label">Email <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" id="comment_email" name="comment_email">
						</div>
					</div>
					<div class="form-group">
						<label for="comment_url" class="col-sm-3 control-label">URL</label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" id="comment_url" name="comment_url">
						</div>
					</div>
					<div class="form-group">
						<label for="comment_content" class="col-sm-3 control-label">Komentar <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<textarea rows="5" class="form-control input-sm" id="comment_content" name="comment_content"></textarea>
						</div>
					</div>
					<div class="form-group">
						<label for="captcha" class="col-sm-3 control-label">Captcha <span style="color: red">*</span></label>
						<div class="col-sm-9">
							<?=$captcha['image'];?>
						</div>
					</div>
					<div class="form-group">
						<label for="captcha" class="col-sm-3 control-label"></label>
						<div class="col-sm-9">
							<input type="text" class="form-control input-sm" id="captcha" name="captcha" placeholder="Masukan 5 angka diatas">
						</div>
					</div>
					<div class="form-group">
			 			<div class="col-sm-offset-3 col-sm-9">
			 				<input type="hidden" name="comment_post_id" id="comment_post_id" value="<?=$this->uri->segment(2)?>">
			   			<button type="button" onclick="post_comment(); return false;" class="btn btn-success"><i class="fa fa-send"></i> SUBMIT</button>
			 			</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<?php 
	if ($query->post_type == 'post') {
		$posts = get_related_posts($query->post_categories, $this->uri->segment(2), 10); 
		if ($posts->num_rows() > 0) {
			$arr_posts = [];
			foreach ($posts->result() as $post) {
				array_push($arr_posts, $post);
			}
			?>
			<ol class="breadcrumb post-header">
				<li><i class="fa fa-sign-out"></i> TULISAN TERKAIT</li>
			</ol>
			<?php $idx = 2; $rows = $posts->num_rows(); foreach($posts->result() as $row) { ?>
				<?=($idx % 2 == 0) ? '<div class="row">':''?>
					<div class="col-md-6">
						<ul class="media-list main-list">
							<li class="media">
								<a class="pull-left" href="<?=site_url('read/'.$row->id.'/'.$row->post_slug)?>">
									<img class="media-object" src="<?=base_url('media_library/posts/thumbnail/'.$row->post_image)?>" alt="...">
								</a>
								<div class="media-body">
									<h4><a href="<?=site_url('read/'.$row->id.'/'.$row->post_slug)?>"><?=$row->post_title?></a></h4>
									<p class="by-author"><?=day_name(date('N', strtotime($row->created_at)))?>, <?=indo_date($row->created_at)?></p>
								</div>
							</li>
						</ul>
					</div>
				<?=(($idx % 2 == 1) || ($rows+1 == $idx)) ? '</div>':''?>
			<?php $idx++; } ?>
		<?php } ?>
	<?php } ?>
</div>
<?php $this->load->view('themes/journal/sidebar')?>