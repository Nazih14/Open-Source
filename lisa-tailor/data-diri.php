<?php
require_once "pengaturan/database.php";

# Bila Anda belum terdaftar
if(!isset($_SESSION['member'])) {
	# Alihkan kehalaman "login-registrasi.php"
	header("Location: login-registrasi.php");	
	exit();
}

# Set member
$set = $_SESSION['member'];

# Ambil Informasi member yang login berdasarkan email
$member = mysql_fetch_object(mysql_query("SELECT * FROM member WHERE email = '$set' LIMIT 1"));

# Tampilan
include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<h1 class="text-center">Informasi Akun Anda</h1>
<div class="contact-info">
	<form class="form-horizontal">
		<div class="form-group">
			<label for="nama" class="col-sm-3 control-label">Nama Lengkap</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" disabled="disabled" value="<?=$member->nama?>">
			</div>
		</div>
		<div class="form-group">
			<label for="email" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<input type="email" class="form-control" disabled="disabled" value="<?=$member->email?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label">Jenis Kelamin</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" disabled="disabled" value="<?=($member->jenis_kelamin==1)?'Laki-laki':'Perempuan'?>">
			</div>
		</div>
		<div class="form-group">
			<label for="telp1" class="col-sm-3 control-label">Kontak Person</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" disabled="disabled" value="<?=$member->telp1?>">
			</div>
			<div class="col-sm-4">
				<input type="text" class="form-control" disabled="disabled" value="<?=$member->telp2?>">
			</div>
		</div>
		<div class="form-group">
			<label for="alamat" class="col-sm-3 control-label">Alamat</label>
			<div class="col-sm-9">
				<textarea class="form-control" rows="5" disabled="disabled"><?=$member->alamat?></textarea>
			</div>
		</div>
		<div class="form-group">
			<label for="kota" class="col-sm-3 control-label">Daerah</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" disabled="disabled" value="<?=$member->kota?>">
			</div>
			<div class="col-sm-4">
				<input type="text" class="form-control" disabled="disabled" value="<?=$member->provinsi?>">
			</div>
		</div>
		<hr/>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<a href="ubah-profil.php" class="btn btn-success">Ubah Informasi</a>
			</div>
		</div>
	</form>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>