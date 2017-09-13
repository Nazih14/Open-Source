<?php 
require_once "pengaturan/database.php"; 

# Tampilan
include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<div class="box featured">
	<div class="box-heading text-center">PENDAFTARAN BERHASIL</div>
</div>

<div style="background-color:#fff">
	<blockquote>
	<p class="text-center">"Selamat, Anda telah terdaftar. <a href="login-registrasi.php#masuk" style="font-size: 17.5px;">Klik disini</a> untuk masuk sebagai member dan melanjutkan pemesanan."</p>
	</blockquote>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>