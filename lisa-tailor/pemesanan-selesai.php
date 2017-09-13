<?php 
require_once "pengaturan/database.php"; 

# Bila Anda belum terdaftar
if(!isset($_SESSION['member'])) {
	# Alihkan kehalaman "login-registrasi.php"
	header("Location: login-registrasi.php");	
	exit();
}

# Tampilan
include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<div class="box featured">
	<div class="box-heading text-center">Pemesanan Berhasil</div>
</div>

<div style="background-color:#fff">
	<blockquote>
	<p class="text-center">"Terima kasih telah melakukan pemesanan. Anda bisa login kembali di website ini dalam jangka waktu 2x24 jam untuk menerima konfirmasi dari pihak kami terkait dapat atau tidaknya memenuhi pesanan Anda."</p>
	</blockquote>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>