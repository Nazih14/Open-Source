<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

# Bila yang ditekan tombol simpan
if($_GET['id']) {

	# Lakukan input data dengan perintah Query MySQL
	$sql = mysql_query("DELETE FROM testimonial WHERE id = '$_GET[id]'");

	# Pesan Sukses
	$pesan = '
	<div class="alert alert-success alert-dismissable">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		Informasi FAQ telah berhasil dirubah. Silahkan <a onclick="location.reload()">Refresh Halaman</a> untuk melihat perubahan.
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
		» <a href="#">Master</a>
		» <a href="#" class="last">Testimonial</a>
	</div>
	<?php
	$daftar = mysql_query("SELECT * FROM testimonial ORDER BY tanggal DESC");
	while($testimonial = mysql_fetch_assoc($daftar)) {
	?>
	<div style="background-color:#fff">
		<blockquote>
			<p><?=$testimonial['testimoni']?></p>
			<p><small>
				<a href="mailto:<?=$testimonial['email']?>"><?=$testimonial['nama']?></a> - 
				<i class="fa fa-calendar"></i> <?=date("d M Y, h:i", strtotime($testimonial['tanggal']))?> - 
				<?php if(isset($_SESSION['admin'])) { ?>
				<a href="testimonial.php?id=<?=$testimonial['id']?>" onclick="return confirm('Anda yakin akan menghapus testimonial ini?')"><i class="fa fa-times"></i> Hapus</a>
				<?php } ?>
			</small></p>
		</blockquote>
	</div>
	<?php
	}
	?>
</div>

<?php
include "template/footer.php";
?>