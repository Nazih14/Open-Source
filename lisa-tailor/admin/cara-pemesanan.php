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

	# Tarik inputan
	$cara_pesan = $_POST['cara_pesan'];

	# Lakukan input data dengan perintah Query MySQL
	$sql = mysql_query("UPDATE informasi SET cara_pesan = '$cara_pesan' WHERE id = '$informasi->id'");
	# Pesan Sukses
	$pesan = '
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		Informasi Cara Pemesanan berhasil dirubah. Silahkan <a onclick="location.reload()">Refresh Halaman</a> untuk melihat perubahan.
	</div>
	';
}

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Toko</a>
		» <a href="#" class="last">FAQ</a>
	</div>
	<form action="" method="POST" class="contact-info" style="padding: 10px;">
		<?=(isset($pesan))?$pesan:'';?>
		<textarea id="summernote" name="cara_pesan"><?=$informasi->cara_pesan?></textarea>
		<script type="text/javascript">
			$(document).ready(function() {
				$('#summernote').summernote({height:450});
			});
		</script>
		<hr/>
		<input type="submit" name="simpan" value="Simpan Perubahan" class="btn btn-success" />
	</form>
</div>

<?php
include "template/footer.php";
?>