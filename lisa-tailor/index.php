<?php 
require_once "pengaturan/database.php"; 

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>
	<script>
		jQuery(function(){
			jQuery('#camera_wrap_0').camera({
				fx: 'stampede',
				navigation: true,
				playPause: false,
				thumbnails: false,
				navigationHover: false,
				barPosition: 'top',
				loader: false,
				time: 3000,
				transPeriod:800,
				alignment: 'center',
				autoAdvance: true,
				mobileAutoAdvance: true,
				barDirection: 'leftToRight', 
				barPosition: 'bottom',
				easing: 'easeInOutExpo',
				fx: 'simpleFade',
				height: '65%',
				minHeight: '90px',
				hover: true,
				pagination: false,
				loaderColor			: '#1f1f1f', 
				loaderBgColor		: 'transparent',
				loaderOpacity		: 1,
				loaderPadding		: 0,
				loaderStroke		: 3
			});
		});
	</script>
	<div class="fluid_container" >
		<div id="camera_wrap_0">
			<div title="slide-3" data-thumb="assets/image/slide-2-870x402.jpg"  data-link="#" data-src="assets/image/slide-2-870x402.jpg"></div>
			<div title="slide-1" data-thumb="assets/image/slide-1-870x402.jpg"  data-link="#" data-src="assets/image/slide-1-870x402.jpg"></div>
			<div title="slide-2" data-thumb="assets/image/slide-3-870x402.jpg"  data-link="#" data-src="assets/image/slide-3-870x402.jpg"></div>
		</div>
		<div class="clear"></div>
	</div>
	<script type="text/javascript">
		if ($('body').width() > 767) {
			(function($){$.fn.equalHeights=function(minHeight,maxHeight){tallest=(minHeight)?minHeight:0;this.each(function(){if($(this).height()>tallest){tallest=$(this).height()}});if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;return this.each(function(){$(this).height(tallest)})}})(jQuery)
			$(window).load(function(){
				if($(".maxheight-feat").length){
					$(".maxheight-feat").equalHeights()
				}
			});
		};
	</script>
	
	<div class="box featured">
		<div class="box-heading text-center" style="background-color:pink">Selamat Datang di Website Pemesanan Pembuatan Pakaian <?= $informasi->nama ?></div>
	</div>

<?php
include "template/kanan.php";
include "template/footer.php";

?>