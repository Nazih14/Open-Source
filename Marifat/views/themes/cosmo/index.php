<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title><?=isset($page_title) ? $page_title . ' | ' : ''?><?=$this->session->userdata('school_name')?></title>
		<meta charset="utf-8" />
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<meta name="keywords" content="<?=$this->session->userdata('meta_keywords');?>"/>
		<meta name="description" content="<?=$this->session->userdata('meta_description');?>"/>
		<meta name="subject" content="Situs Pendidikan">
		<meta name="copyright" content="<?=$this->session->userdata('school_name')?>">
		<meta name="language" content="Indonesia">
		<meta name="robots" content="index,follow" />
		<meta name="revised" content="Sunday, July 18th, 2010, 5:15 pm" />
		<meta name="Classification" content="Education">
		<meta name="author" content="Anton Sofyan, 4ntonsofyan@gmail.com">
		<meta name="designer" content="Anton Sofyan, 4ntonsofyan@gmail.com">
		<meta name="reply-to" content="4ntonsofyan@gmail.com">
		<meta name="owner" content="Anton Sofyan">
		<meta name="url" content="http://www.sekolahku.web.id">
		<meta name="identifier-URL" content="http://www.sekolahku.web.id">
		<meta name="category" content="Admission, Education">
		<meta name="coverage" content="Worldwide">
		<meta name="distribution" content="Global">
		<meta name="rating" content="General">
		<meta name="revisit-after" content="7 days">
		<meta http-equiv="Expires" content="0">
		<meta http-equiv="Pragma" content="no-cache">
		<meta http-equiv="Cache-Control" content="no-cache">
		<meta http-equiv="Copyright" content="<?=$this->session->userdata('school_name');?>" />
		<meta http-equiv="imagetoolbar" content="no" />
		<meta name="revisit-after" content="7" />
		<meta name="webcrawlers" content="all" />
		<meta name="rating" content="general" />
		<meta name="spiders" content="all" />
		<meta itemprop="name" content="<?=$this->session->userdata('school_name');?>" />
		<meta itemprop="description" content="<?=$this->session->userdata('meta_description');?>" />
		<meta itemprop="image" content="<?=base_url('media_library/images/'. $this->session->userdata('logo'));?>" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="csrf-token" content="<?=$this->session->userdata('csrf_token')?>">
		<link rel="icon" href="<?=base_url('media_library/images/'.$this->session->userdata('favicon'));?>">
		<?=link_tag('views/themes/cosmo/css/bootstrap.css')?>
		<?=link_tag('views/themes/cosmo/css/font-awesome.min.css')?>
		<?=link_tag('views/themes/cosmo/css/sm-core-css.css')?>
		<?=link_tag('views/themes/cosmo/css/jquery.smartmenus.bootstrap.css')?>
		<?=link_tag('assets/css/magnific-popup.css');?>
		<?=link_tag('assets/css/toastr.css');?>
		<?=link_tag('assets/css/jssocials.css');?>
		<?=link_tag('assets/css/jssocials-theme-flat.css');?>
		<?=link_tag('assets/css/bootstrap-datepicker.css');?>
		<?=link_tag('views/themes/cosmo/css/style.css')?>
		<?=link_tag('assets/css/loading.css');?>
		<script type="text/javascript">
    		const _BASE_URL = '<?=base_url();?>';
		</script>
	 	<script src="<?=base_url('assets/js/frontend.min.js');?>"></script>
	</head>
	<body>
		<!-- Top Nav -->
		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div id="navbar" class="navbar-collapse collapse">
					<ul class="nav navbar-nav">
						<li><a href="<?=base_url()?>"><i class="fa fa-home"></i></a></li>
						<?php 
						foreach ($menus as $menu) {
							echo '<li>';
							$sub_nav = recursive_list($menu['child']);
							$url = base_url() . $menu['menu_url'];
							if ($menu['menu_type'] == 'links') {
								$url = $menu['menu_url'];
							}
							echo anchor($url, strtoupper($menu['menu_title']). ($sub_nav ? ' <span class="caret"></span>':''), 'target="'.$menu['menu_target'].'"');
							if ($sub_nav) {
								echo '<ul class="dropdown-menu">';
								echo recursive_list($menu['child']);
								echo '</ul>';
							}
							echo '</li>';
						}?>
					</ul>
					<form style="margin-top: 10px;" class="navbar-form navbar-right" action="<?=site_url('hasil-pencarian')?>" method="POST">
			        <div class="form-group">
			          <input type="text" class="form-control input-sm" placeholder="Pencarian" name="keyword">
			        </div>
			        <button type="submit" class="btn btn-sm btn-success"><i class="fa fa-search"></i></button>
			      </form>
				</div>
			</div>
		</nav>
		<!-- Header -->
		<div class="header">
			<div class="container">
				<div class="row">
					<div class="col-md-7 col-xs-12">
						<div class="header-logo">
							<a href="<?=base_url()?>"><img src="<?=base_url('media_library/images/'.$this->session->userdata('logo'))?>" alt="" class="img-responsive"></a>
						</div>
						<div class="header-text">
							<h2 style="color: #ff0; font-weight: bold;"><?=$this->session->userdata('school_name')?></h2>
							<p><strong><?=$this->session->userdata('street_address')?></strong></p>
							<p><?=$this->session->userdata('tagline')?></p>
						</div>
					</div>
					<div class="col-md-5 col-xs-12">
						<ul class="social-network social-circle pull-right">
							<li><a href="<?=$this->session->userdata('facebook')?>" title="Facebook"><i class="fa fa-facebook"></i></a></li>
                     <li><a href="<?=$this->session->userdata('twitter')?>" title="Twitter"><i class="fa fa-twitter"></i></a></li>
                     <li><a href="<?=$this->session->userdata('google_plus')?>" title="Google +"><i class="fa fa-google-plus"></i></a></li>
                     <li><a href="<?=$this->session->userdata('linked_in')?>" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
                     <li><a href="<?=$this->session->userdata('youtube')?>" title="Youtube"><i class="fa fa-youtube"></i></a></li>
                     <li><a href="<?=$this->session->userdata('instagram')?>" title="Instagram"><i class="fa fa-instagram"></i></a></li>
                     <li><a href="<?=site_url('feed')?>"><i class="fa fa-rss"></i></a></li>
                 	</ul>
					</div>
				</div>
			</div>
		</div>
		<!-- End Header -->

		<?php $query = get_quotes(); if ($query->num_rows() > 0) { ?>
		<div class="text-slider">
			<div class="container">
				<ul id="marquee" class="marquee">
					<?php foreach($query->result() as $row) { ?>
						<li><?=$row->quote?>. <strong><i><font color="yellow"><?=$row->quote_by?></font></i></strong></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php } ?>

		<div class="container">
			<!-- Content -->
			<div class="row">
				<!-- Right Content -->
				<?php $this->load->view($content)?>
			</div>
	 	</div> <!-- /container -->

	 	<!-- FOOTER -->
		<div class="footer">
	 		<div class="container">
		  		<div class="row">
					<div class="col-md-3">
						<h4>TAUTAN</h4>
				 		<ul>
			 				<?php 
                    	$links = get_links(); 
                    	if ($links->num_rows() > 0) {
                     	foreach($links->result() as $row) {
                        	echo '<li>'. anchor($row->url, $row->title, ['target' => $row->target]) . '</li>';
                     	}  
                    	}
                    	?>
						</ul>
					</div>
					<div class="col-md-3">
						<h4>KATEGORI</h4>
					 	<ul>
					 		<?php 
                     $query = get_post_categories(); 
                     if ($query->num_rows() > 0) {
                         foreach($query->result() as $row) {
                             echo '<li>'.anchor(site_url('category/'.$row->slug), $row->category, ['title' => $row->description]).'</li>';
                         }
                     }
                     ?>
						</ul>
					</div>
					<div class="col-md-3">
						<h4>TAGS</h4>
					 	<ul>
				 			<?php 
                 		$query = get_tags();
                    	if ($query->num_rows() > 0) {
                     	foreach ($query->result() as $row) {
                     		echo '<li>'.anchor(site_url('tag/'.$row->slug), $row->tag).'</li>';
                     	}
                    	}
                    	?>
						</ul>
					</div>
					<div class="col-md-3">
						<h4>HUBUNGI KAMI</h4>
                  <p>
                  <?=$this->session->userdata('street_address')?><br>
                  Email : <?=$this->session->userdata('email')?><br>
                  Telp : <?=$this->session->userdata('phone')?><br>
                  Fax : <?=$this->session->userdata('fax')?>
                  </p>
					</div>
		  		</div>
	 		</div>
		</div>
		<!-- END FOOTER -->
		
		<!-- COPYRIGHT -->
		<div class="copyright">
			<p><?=copyright(2017, base_url(), $this->session->userdata('school_name'))?></p>
		  	<p>Powered by <a href="http://sekolahku.web.id">sekolahku.web.id</a></p>
		</div>
		<!-- END COPYRIGHT -->
		
		<!-- Back to Top -->
		<a href="javascript:" id="return-to-top"><i class="fa fa-angle-double-up"></i></a>
	 	<script>
		  // Scroll Top
			$(window).scroll(function() {
				if ($(this).scrollTop() >= 50) {
					$('#return-to-top').fadeIn(200);
			 	} else {
					$('#return-to-top').fadeOut(200);
			 	}
			});
			$('#return-to-top').click(function() {
				$('body,html').animate({
					scrollTop : 0
			 	}, 500);
			});
		</script>
  	</body>
</html>