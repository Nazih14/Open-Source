<?php 
require_once "pengaturan/database.php"; 

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>
	
	<div class="box featured">
		<div class="box-heading text-center">JENIS PAKAIAN PRIA</div>
	</div>

	<div class="contact-info" style="font-weight:normal;">
		<div class="row">
			<div class="com-sm-12">
				<div class="col-sm-6 text-center">
					<h1><a href="daftar-jenis.php?jenis=1&tipe=1"><i class="fa fa-arrow-up"></i> ATASAN</a></h1>
				</div>
				<div class="col-sm-6 text-center">
					<h1><a href="daftar-jenis.php?jenis=1&tipe=2"><i class="fa fa-arrow-down"></i> BAWAHAN</a></h1>
				</div>
			</div>
		</div>
	</div>

	<div class="box featured">
		<div class="box-heading text-center">JENIS PAKAIAN WANITA</div>
	</div>

	<div class="contact-info" style="font-weight:normal;">
		<div class="row">
			<div class="com-sm-12">
				<div class="col-sm-6 text-center">
					<h1><a href="daftar-jenis.php?jenis=2&tipe=1"><i class="fa fa-arrow-up"></i> ATASAN</a></h1>
				</div>
				<div class="col-sm-6 text-center">
					<h1><a href="daftar-jenis.php?jenis=2&tipe=2"><i class="fa fa-arrow-down"></i> BAWAHAN</a></h1>
				</div>
			</div>
		</div>
	</div>

<?php
include "template/kanan.php";
include "template/footer.php";

?>