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
		<?=link_tag('assets/css/bootstrap.css');?>
		<?=link_tag('assets/css/font-awesome.css');?>
		<?=link_tag('assets/css/toastr.css');?>
		<?=link_tag('assets/css/login-form-elements.css');?>
		<?=link_tag('assets/css/login-style.css');?>
		<?=link_tag('assets/css/loading.css');?>
		<link rel="icon" href="<?=base_url('media_library/images/favicon.png');?>">
		<script type="text/javascript">
			const _BASE_URL = '<?=base_url();?>', _CURRENT_URL = '<?=current_url();?>';
		</script>
		<script src="<?=base_url('assets/js/frontend.min.js');?>"></script>
	</head>
	<body>
		<div class="top-content">
			<div class="inner-bg">
				<div class="container">
					<div class="row">
						<?php $this->load->view($content);?>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<p class="login-footer">
							<?php if ($this->uri->segment(1) == 'lost-password') { ?>
								<a href="<?=site_url('login');?>">Login</a><br>
							<?php } else if ($this->uri->segment(1) == 'login') { ?>
								<a href="<?=site_url('lost-password');?>">Lost your password ?</a><br>
							<?php } ?>
							Copyright &copy; 2014 - <?=date('Y');?> sekolahku.web.id All Rights Reserved<br>
							Powered by <a href="http://sekolahku.web.id">sekolahku.web.id</a> &sdot; Back to <a href="<?=base_url()?>"><?=$this->session->userdata('school_name')?></a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>