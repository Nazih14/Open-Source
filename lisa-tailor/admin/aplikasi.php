<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

# Bila yang ditekan tombol simpan
if($_POST['simpan']) {

	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		(empty($_POST["nama"])) ? $namaError = "Nama Toko belum diisi" : $nama = tesInputan($_POST["nama"]);
		(empty($_POST["alamat"])) ? $alamatError = "Alamat Toko belum diisi" : $alamat = tesInputan($_POST["alamat"]);
		(empty($_POST["pemilik"])) ? $pemilikError = "Pemilik Toko belum diisi" : $pemilik = tesInputan($_POST["pemilik"]);
		(empty($_POST["telp"])) ? $telpError = "Nomor Telpon belum diisi" : $telp = tesInputan($_POST["telp"]);
		(empty($_POST["ym"])) ? $ymError = "Akun YM pemilik belum diisi" : $ym = tesInputan($_POST["ym"]);
		(empty($_POST["rek1"])) ? $rek1Error = "Nomor Rekening 1 belum diisi" : $rek1 = tesInputan($_POST["rek1"]);
		(empty($_POST["rek2"])) ? $rek2Error = "Nomor Rekening 2 belum diisi" : $rek2 = tesInputan($_POST["rek2"]);

		# Bila semua validasi sukses
		if($nama&&$alamat&&$pemilik&&$telp&&$ym&&$rek1&&$rek2) {

			# Lakukan input data dengan perintah Query MySQL
			$sql = mysql_query("UPDATE informasi SET nama = '$nama', alamat = '$alamat', 
									pemilik = '$pemilik', telp = '$telp', ym = '$ym', 
									rek1 = '$rek1', rek2 = '$rek2' WHERE id = '$informasi->id'");
			# Pesan Sukses
			$pesan = '
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Informasi Toko telah berhasil dirubah. Silahkan <a onclick="location.reload()">Refresh Halaman</a> untuk melihat perubahan.
			</div>
			';
		}
	}
}

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9" id="content">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Pengaturan</a>
		» <a href="#" class="last">Informasi</a>
	</div>
	<form class="form-horizontal contact-info" method="POST" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>">
		<?=(isset($pesan))?$pesan:'';?>
		<div class="form-group <?=($namaError)?'has-error':''?>">
			<label for="nama" class="col-sm-3 control-label">Nama Toko</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="nama" placeholder="Nama Toko?" value="<?=$informasi->nama?>" >
				<span class="help-block small text-center merah"><?=$namaError?></span>
			</div>
		</div>
		<div class="form-group <?=($alamatError)?'has-error':''?>">
			<label for="alamat" class="col-sm-3 control-label">Alamat Toko</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="alamat" rows="3"><?=$informasi->alamat?></textarea>
				<span class="help-block small text-center merah"><?=$alamatError?></span>
			</div>
		</div>
		<div class="form-group <?=($pemilikError)?'has-error':''?>">
			<label for="pemilik" class="col-sm-3 control-label">Nama Pemilik</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="pemilik" placeholder="Nama Pemilik?" value="<?=$informasi->pemilik?>" >
				<span class="help-block small text-center merah"><?=$pemilikError?></span>
			</div>
		</div>
		<div class="form-group <?=($telpError)?'has-error':''?>">
			<label for="telp" class="col-sm-3 control-label">Telpon</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="telp" placeholder="Nomor Telepon?" value="<?=$informasi->telp?>" >
				<span class="help-block small text-center merah"><?=$telpError?></span>
			</div>
		</div>
		<div class="form-group <?=($ymError)?'has-error':''?>">
			<label for="ym" class="col-sm-3 control-label">Akun Yahoo!</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="ym" placeholder="Akun Yahoo Messanger?" value="<?=$informasi->ym?>" >
				<span class="help-block small text-center merah"><?=$ymError?></span>
			</div>
		</div>
		<div class="form-group <?=($rek1Error)?'has-error':''?>">
			<label for="rek1" class="col-sm-3 control-label">Rekening BRI</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="rek1" placeholder="Rekening BRI?" value="<?=$informasi->rek1?>" >
				<span class="help-block small text-center merah"><?=$rek1Error?></span>
			</div>
		</div>
		<div class="form-group <?=($rek2Error)?'has-error':''?>">
			<label for="rek2" class="col-sm-3 control-label">Rekening Mandiri</label>
			<div class="col-sm-6">
				<input type="text" class="form-control" name="rek2" placeholder="Rekening Mandiri?" value="<?=$informasi->rek2?>" >
				<span class="help-block small text-center merah"><?=$rek2Error?></span>
			</div>
		</div>
				
		<hr/>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<input type="submit" name="simpan" class="btn btn-success" value="Simpan Perubahan">
			</div>
		</div>
	</form>
</div>

<?php
include "template/footer.php";
?>