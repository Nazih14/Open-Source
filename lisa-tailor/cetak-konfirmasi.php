<?php
require_once "pengaturan/database.php";

# Bila Anda belum terdaftar
if(!isset($_SESSION['member'])) {
	# Alihkan kehalaman "login-registrasi.php"
	header("Location: login-registrasi.php");	
	exit();
}

if(isset($_GET['id'])) {
	$id = $_GET['id'];
	$pesan = mysql_fetch_object(mysql_query("SELECT * FROM konfirmasi WHERE id = '$id'"));
}

# Tampilan
include "template/head.php";
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
	<h1 class="text-center" style="padding-top: 10px;">Bukti Pembayaran</h1>
	<div class="contact-info" style="font-weight:normal;padding: 20px;">
		<div class="pull-right" style="padding-right:5px"><strong>Tanggal : <?=date("d M Y")?></strong></div>
		<br/>
		<br/>
		<table class="table">
			<tbody>
				<tr>
					<td>1.</td>
					<td>Nama Pemesan</td>
					<td>:</td>
					<td>
						<?=$pesan->nama?>
					</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>Email</td>
					<td>:</td>
					<td>
						<?=$pesan->email?>
					</td>
				</tr>
				<tr>
					<td>3.</td>
					<td>Telepon / HP</td>
					<td>:</td>
					<td>
						<?=$pesan->telp?>
					</td>
				</tr>
				<tr>
					<td>4.</td>
					<td>No. Pemesanan</td>
					<td>:</td>
					<td>
						<?=$pesan->no_pemesanan?>
					</td>
				</tr>
				<tr>
					<td>5.</td>
					<td>Total Kirim (Rp.)</td>
					<td>:</td>
					<td>
						<?=rupiah($pesan->total_kirim)?>
					</td>
				</tr>
				<tr>
					<td>6.</td>
					<td>Bank Tujuan</td>
					<td>:</td>
					<td>
						<?=($pesan->bank_tujuan==1)?'BRI':'Mandiri'?>
					</td>
				</tr>
				<tr>
					<td>7.</td>
					<td>Bank Pengirim</td>
					<td>:</td>
					<td>
						<?=$pesan->bank_pengirim?>
					</td>
				</tr>
				<tr>
					<td>8.</td>
					<td>Nama Pemilik Rekening</td>
					<td>:</td>
					<td>
						<?=$pesan->pemilik_rekening?>
					</td>
				</tr>

				<tr>
					<td>9.</td>
					<td>Catatan</td>
					<td>:</td>
					<td>
						<?=$pesan->catatan?>
					</td>
				</tr>
				
				<tr>
					<td>10.</td>
					<td>Resi</td>
					<td>:</td>
					<td>
						<img src="admin/upload/resi/<?=$pesan->bukti_resi?>" class="img-responsive" style="width:200px">
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>