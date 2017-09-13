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
		<div class="box-heading text-center">Riwayat Pemesanan</div>
	</div>

<?php
	$set = $_SESSION['member'];
	$member = mysql_fetch_object(mysql_query("SELECT * FROM member WHERE email = '$set' LIMIT 1"));
	$sql = mysql_query("SELECT * FROM pemesanan WHERE id_member = '$member->id' ORDER BY id DESC");
	while($pemesanan = mysql_fetch_assoc($sql)) {
?>
	<div style="background-color:#fff">
		<blockquote>
			<p>
				No. Pemesanan : <strong>#<?=$pemesanan['id']?></strong> | 
				STATUS : 
				<?php if($pemesanan['status']==0) {
					echo '<span class="label-warning" style="color: #fff;padding: 0 5px;"><strong>MENUNGGU</strong></span>';
				} elseif($pemesanan['status']==1) {
					echo '<span class="label-success" style="color: #fff;padding: 0 5px;"><strong>DISETUJUI</strong></span>';
				} else {
					echo '<span class="label-danger" style="color: #fff;padding: 0 5px;"><strong>TIDAK DITERIMA</strong></span>';
				}
				?>
			</p>
			<p><small>
				<i class="fa fa-calendar"></i> Tgl Masuk: <?=$pemesanan['tgl_masuk']?> 
				<i class="fa fa-calendar"></i> Tgl Digunakan: <?=$pemesanan['tgl_digunakan']?>
				<a href="cek-pemesanan.php?pesan=<?=$pemesanan['id']?>"><i class="fa fa-check"></i> Cek Pemesanan</a>
			</small></p>
		</blockquote>
	</div>
<?php
	}

include "template/kanan.php";
include "template/footer.php";
?>