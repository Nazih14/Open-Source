<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html>
<head>
	<title><?=$this->session->userdata('school_name')?></title>
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
	<link rel="icon" href="<?=base_url('media_library/images/'.$this->session->userdata('favicon'));?>">
	<?=link_tag('assets/css/bootstrap.css');?>
	<?=link_tag('assets/css/font-awesome.css');?>
	<?=link_tag('assets/css/toastr.css');?>
	<?=link_tag('assets/css/bootstrap-datepicker.css');?>
	<?=link_tag('assets/css/AdminLTE.css');?>
	<?=link_tag('assets/css/jquery.timepicker.css');?>
	<?=link_tag('assets/css/backend-style.css');?>
	<?=link_tag('assets/css/magnific-popup.css');?>
	<?=link_tag('assets/css/bootstrap-colorpicker.css');?>
	<?=link_tag('assets/css/jquery-clockpicker.css');?>
	<?=link_tag('assets/css/select2.css');?>
	<?=link_tag('assets/css/jquery.tagsinput.min.css');?>
	<?=link_tag('assets/css/loading.css');?>
	<script type="text/javascript">
		const _BASE_URL = '<?=base_url();?>', _CURRENT_URL = '<?=current_url();?>';
	</script>
	<script type="text/javascript" src="<?=base_url('assets/js/backend.min.js');?>"></script>
</head>
<!-- sidebar-collapse -->
<body class="hold-transition skin-blue sidebar-mini <?=$this->session->userdata('sidebar_collapse') ? 'sidebar-collapse':''?>">
<div class="wrapper">
	<header class="main-header">
		<a href="#" class="logo">
			<span class="logo-mini"><i class="fa fa-cogs"></i></span>
			<span class="logo-lg"><b>CONTROL</b> PANEL</span>
		</a>
	 	<nav class="navbar navbar-static-top">
			<a onclick="sidebarCollapse(); return false;" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="collapse navbar-collapse pull-right" id="navbar-collapse">
				<ul class="nav navbar-nav">
					<li><a href="#" class="current-time"></a></li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-question-circle-o"></i> Help <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="https://www.sekolahku.web.id" target="_blank"><i class="fa fa-globe"></i> Official Site</a></li>
							<li><a href="https://www.facebook.com/groups/cmssekolahku" target="_blank"><i class="fa fa-facebook"></i> Official Support Forum</a></li>
							<li><a href="#" data-toggle="modal" data-target="#cms-info"><i class="fa fa-info-circle"></i> About</a></li>
						</ul>
					</li>
					<?php if ($this->session->userdata('user_type') === 'super_user' || $this->session->userdata('user_type') === 'administrator') { ?>
					<li <?=isset($user_profile) ? 'class="active"' : '';?>><a href="<?=site_url('profile');?>"><i class="fa fa-edit"></i> Ubah Profil</a></li>
					<?php } ?>
					<li <?=isset($change_password) ? 'class="active"' : '';?>><a href="<?=site_url('change_password');?>"><i class="fa fa-key"></i> Ubah Kata Sandi</a></li>
					<li class="logout"><a href="<?=site_url('logout');?>"><i class="fa fa-power-off"></i> Keluar</a></li>
				</ul>
			</div>
		</nav>
	</header>
	<aside class="main-sidebar">
		<?php $this->load->view('backend/sidebar');?>
	</aside>
	<div class="content-wrapper">
		<?php $this->load->view($content);?>
	</div>
	<div class="modal" id="cms-info">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span></button>
					<h4 class="modal-title"><i class="fa fa-info-circle"></i> About</h4>
				</div>
				<div class="modal-body">
					<p>CMS (Content Management System) dan PPDB Online GRATIS untuk sekolah SD, SMP/Sederajat, SMA/Sederajat, dan Perguruan Tinggi.</p>
					<table class="table table-condensed table-bordered">
						<tbody>
							<tr>
								<td width="20%">Code Name</td>
								<td width="1px">:</td>
								<td><?=config_item('apps')?></td>
							</tr>
							<tr>
								<td>Author</td>
								<td>:</td>
								<td><a href="https://www.facebook.com/antonsofyan">Anton Sofyan</a></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?=config_item('email')?></td>
							</tr>
							<tr>
								<td>CMS Version</td>
								<td>:</td>
								<td><?=config_item('version')?></td>
							</tr>
							<tr>
								<td>Link</td>
								<td>:</td>
								<td><a href="<?=config_item('website')?>">sekolahku.web.id</a></td>
							</tr>
							<tr>
								<td>Copyright</td>
								<td>:</td>
								<td>&copy; 2014-<?=date('Y')?></td>
							</tr>
						</tbody>
					</table>
					<p>SYARAT DAN KETENTUAN :</p>
					<ol>
						<li>CMS ini bersifat open source, Pengguna diperkenankan untuk menyebarluaskan, menggunakan, maupun memodifikasinya.</li>
						<li>Tidak diperkenankan memperjualbelikan CMS ini tanpa seizin dari <a href="https://www.facebook.com/antonsofyan">Pengembang CMS Sekolahku</a>.</li>
						<li>Tidak diperkenankan membuat Aplikasi turunan dari CMS ini dengan nama baru.</li>
						<li>Tidak diperkenankan menghapus kode sumber aplikasi yang berada di bagian footer CMS.</li>
						<li>Tidak diperkenankan menyertakan link komersil seperti Layanan Hosting maupun domain yang menguntungkan sepihak.</li>
					</ol>
				</div>
			</div>
		</div>
	</div>

	<footer class="main-footer">
		<div class="pull-right hidden-xs">
			<p>Powered by <a href="<?=$this->config->item('website');?>" target="_blank"><?=$this->config->item('apps');?> <?=$this->config->item('version');?></a></p>
		</div>
		<p>Copyright &copy; <?=date('Y');?> <?=$this->session->userdata('school_name')?>. All rights reserved.</p>
	</footer>
	<div class="control-sidebar-bg"></div>
</div>
<a href="javascript:" id="return-to-top"><i class="fa fa-angle-double-up"></i></a>
</body>
<script type="text/javascript">
	// Scroll Top
	$(window).scroll(function() {
		if ($(this).scrollTop() >= 50) {
			$('#return-to-top').fadeIn(200);
	 	} else {
			$('#return-to-top').fadeOut(200);
	 	}
	});

	// Return to Top
	$('#return-to-top').click(function() {
		$('body,html').animate({
			scrollTop : 0
	 	}, 500);
	});
</script>
</html>
