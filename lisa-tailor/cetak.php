<?php
require_once "pengaturan/database.php";

# Bila Anda belum terdaftar
if(!isset($_SESSION['member'])) {
	# Alihkan kehalaman "login-registrasi.php"
	header("Location: login-registrasi.php");	
	exit();
}

if(isset($_GET['pesan'])) {
	$id = $_GET['pesan'];
	$pesan = mysql_fetch_object(mysql_query("SELECT * FROM pemesanan WHERE id = '$id'"));
}

# Tampilan
include "template/head.php";
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
	<h1 class="text-center" style="padding-top: 10px;">Bukti Pemesanan</h1>
	<div class="contact-info" style="font-weight:normal;padding: 20px;">
		<div class="pull-right" style="padding-right:5px"><strong>Tanggal : <?=date("d M Y", strtotime($pesan->tgl_masuk))?></strong></div>
		<br/>
		<br/>
		<table class="table">
			<tbody>
				<tr>
					<td>1.</td>
					<td>No. Pemesanan</td>
					<td>:</td>
					<td>
						<?=$pesan->id?>
					</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>Tanggal Digunakan</td>
					<td>:</td>
					<td>
						<?=date("d M Y", strtotime($pesan->tgl_digunakan))?>
					</td>
				</tr>
				<tr>
					<td>3.</td>
					<td>Jenis Pakaian</td>
					<td>:</td>
					<td>
						<?php
						$set = $pesan->jenis_pakaian;
						$pilihan = mysql_fetch_object(mysql_query("SELECT * FROM kategori WHERE id = '$set' LIMIT 1"));
						echo $pilihan->nama;									
						?>
					</td>
				</tr>
				<tr>
					<td>4.</td>
					<td>Pengukuran Badan</td>
					<td>:</td>
					<td>
						<?=($pesan->pengukuran==1)?'Datang langsung ke Lisa Tailor':'Mengirim contoh pakaian (untuk pemesanan diluar Samarinda)'?>
					</td>
				</tr>
				<tr>
					<td>5.</td>
					<td>Model Pakaian</td>
					<td>:</td>
					<td>
						<img src="admin/upload/<?=$pesan->model?>" class="img-responsive" style="width:200px">
					</td>
				</tr>
				<tr>
					<td>6.</td>
					<td>Menggunakan Puring?</td>
					<td>:</td>
					<td>
						<?=($pesan->puring==1)?'Ya':'Tidak'?>
					</td>
				</tr>
				<tr>
					<td>7.</td>
					<td>Jumlah Pakaian</td>
					<td>:</td>
					<td>
						<?=$pesan->jumlah?> Lembar
					</td>
				</tr>
				<tr>
					<td>8.</td>
					<td>Jenis Kain</td>
					<td>:</td>
					<td>
						<?php
						$set = $pesan->jenis_kain;
						$pilihan = mysql_fetch_object(mysql_query("SELECT * FROM kain WHERE id = '$set' LIMIT 1"));
						echo $pilihan->jenis;			
						?>
					</td>
				</tr>

				<tr>
					<td>9.</td>
					<td>Ongkos</td>
					<td>:</td>
					<td>
						<strong><?=($pesan->ongkos==0)?'Belum Ada Respon dari Admin':rupiah($pesan->ongkos)?></strong>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>