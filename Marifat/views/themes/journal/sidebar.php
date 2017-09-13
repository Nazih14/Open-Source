<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!-- Sidebar -->
<div class="col-xs-12 col-md-3">
	<?php if ($this->uri->segment(1) != 'sambutan-kepala-sekolah') { ?>
	<div class="thumbnail">
		<img src="<?=base_url('media_library/images/').$this->session->userdata('headmaster_photo');?>" alt="..." style="width: 100%">
 		<div class="caption">
			<h3><?=$this->session->userdata('headmaster')?></h3>
			<p><?=word_limiter(strip_tags(get_welcome()), 20);?></p>
			<p>
				<a href="<?=site_url('sambutan-kepala-sekolah');?>" class="btn btn-success btn-sm" role="button">Selengkapnya <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
			</p>
	 	</div>
  	</div>
  	<?php } ?>
  	
  	<div class="form-group has-feedback">
		<input onkeydown="if (event.keyCode == 13) { subscriber(); return false; }" type="text" class="form-control" id="subscriber" placeholder="Berlangganan" autocomplete="off">
		<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
	</div>

	<?php $query = get_post_categories(); if ($query->num_rows() > 0) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
	  			<h3 class="panel-title">KATEGORI</h3>
			</div>
			<div class="list-group">
				<?php foreach($query->result() as $row) { ?>
				<a href="<?=site_url('category/'.$row->slug);?>" title="<?=$row->description;?>" class="list-group-item"><?=$row->category;?></a>
	        <?php } ?>
			</div>
		</div>
	<?php } ?>

	<?php $query = get_links(); if ($query->num_rows() > 0) { ?>
		<div class="panel panel-default">
			<div class="panel-heading">
	  			<h3 class="panel-title">TAUTAN</h3>
			</div>
			<div class="list-group">
				<?php foreach($query->result() as $row) { ?>
				<a href="<?=$row->url;?>" title="<?=$row->title;?>" target="<?=$row->target;?>" class="list-group-item"><?=$row->title;?></a>
	        <?php } ?>
			</div>
		</div>
	<?php } ?>
		
	<?php $query = get_archive_year(); if ($query->num_rows() > 0) { ?>
		<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
			<?php $idx = 0; foreach($query->result() as $row) { ?>
			<div class="panel panel-default">
	  			<div class="panel-heading" role="tab" id="heading_<?=$row->year?>">
		 			<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#archive_<?=$row->year?>" aria-expanded="true" aria-controls="archive_<?=$row->year?>">ARSIP <?=$row->year?></a>
		 			</h4>
	  			</div>
	  			<div id="archive_<?=$row->year?>" class="panel-collapse collapse <?=$idx==0?'in':''?>" role="tabpanel" aria-labelledby="heading_<?=$row->year?>">
		 			<div class="list-group">
		 				<?php $archives = get_archives($row->year); if ($archives->num_rows() > 0) { ?>
							<?php foreach($archives->result() as $archive) { ?>
								<a href="<?=site_url('archives/'.$row->year.'/'.$archive->code)?>" class="list-group-item"><?=bulan($archive->code)?> (<?=$archive->count?>)</a>
							<?php } ?>
						<?php } ?>
		 			</div>
	  			</div>
			</div>
			<?php $idx++; } ?>
	</div>
	<?php } ?>

	<?php $query = get_active_question(); if ($query) { ?>
	<div class="panel panel-default">
		<div class="panel-heading">
  			<h3 class="panel-title">JAJAK PENDAPAT</h3>
		</div>
		<div class="panel-body">
			<p><?=$query->question?></p>
			<?php $options = get_answers($query->id); foreach($options->result() as $option) { ?>
			<div class="radio">
			  <label>
			    <input type="radio" name="answer_id" id="answer_id" id="answer_id_<?=$option->id?>" value="<?=$option->id?>">
			    <?=$option->answer?>
			  </label>
			</div>
			<?php } ?>
			<div class="btn-group">
				<button type="submit" onclick="polling(); return false;" class="btn btn-success btn-sm"><i class="fa fa-send"></i> SUBMIT</button>
				<a href="<?=site_url('hasil-jajak-pendapat')?>" class="btn btn-sm btn-warning"><i class="fa fa-bar-chart"></i> LIHAT HASIL</a>		
			</div>			
		</div>
	</div>
	<?php } ?>

	<?php $query = get_banners(); if ($query->num_rows() > 0) { ?>
		<?php foreach($query->result() as $row) { ?>
			<a href="<?=$row->url?>" title="<?=$row->title?>" class="thumbnail"> <img src="<?=base_url('media_library/banners/'.$row->image)?>" style="width: 100%; display: block;"></a>
		<?php } ?>
	<?php } ?>
</div>