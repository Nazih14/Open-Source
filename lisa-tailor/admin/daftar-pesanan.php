<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST') {
	if(isset($_POST['simpan'])) {
		$id = $_POST['id'];
		$ongkos = tesInputan($_POST["ongkos"]);
		$status = tesInputan($_POST["status"]);
		if($status) {
			$sql = mysql_query("UPDATE pemesanan SET ongkos = '$ongkos', status = '$status'
					WHERE id = '$id'");
			$pesan = "<script>alert('Status dan ongkos pesanan berhasil diubah.')</script>";
		}
	}
}

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Toko</a>
		» <a href="#" class="last">Daftar Pesanan</a>
	</div>

<?php
	$sql = mysql_query("SELECT * FROM pemesanan ORDER BY id DESC");

	if(mysql_num_rows($sql)!=0) {
		while($pemesanan = mysql_fetch_assoc($sql)) {
?>
	<div class="contact-info" style="padding:20px;font-weight:normal;">
		<blockquote>
			<p>
				No. Pemesanan : <strong>#<?=$pemesanan['id']?></strong> | 
				<?php
					$set = $pemesanan['id_member'];
					$anggota = mysql_fetch_object(mysql_query("SELECT * FROM member WHERE id = '$set' LIMIT 1"));
				?>
				A/N : <strong><?=$anggota->nama?></strong> | 
				STATUS : 
				<?php if($pemesanan['status']==0) {
					echo '<span class="label-warning" style="color: #fff;padding: 0 5px;"><strong>MENUNGGU</strong></span>';
				} elseif($pemesanan['status']==1) {
					echo '<span class="label-success" style="color: #fff;padding: 0 5px;"><strong>DISETUJUI</strong></span>';
				} else {
					echo '<span class="label-danger" style="color: #fff;padding: 0 5px;"><strong>TIDAK DITERIMA</strong></span>';
				}
				?>
				<a data-toggle="modal" data-target="#kelola<?=$pemesanan['id']?>"><i class="fa fa-pencil"></i> Kelola</a>
			</p>

			<!-- Modal Kelola -->
			<div class="modal fade" id="kelola<?=$pemesanan['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;">&times;</button>
							<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-eye"></i> Kelola Pemesanan</h4>
						</div>
						<div class="modal-body">
							<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
								<div class="form-group">
									<label for="ongkos" class="col-sm-3 control-label">Ongkos (Rp.)</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" name="ongkos" placeholder="Berapa Rupiah Kira-kira? (Rp.)">
									</div>
								</div>
								<div class="form-group">
									<label for="ongkos" class="col-sm-3 control-label">Status</label>
									<div class="col-sm-9">
										<select name="status">
											<option value="1">Terima</option>
											<option value="2">Tidak Diterima</option>
										</select>
									</div>
								</div>
								<hr/>
								<div class="form-group">
									<label class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<input type="hidden" value="<?=$pemesanan['id']?>" name="id" />
										<input name="simpan" value="Simpan" type="submit" class="btn btn-info" />
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>

			<p><small>
				<i class="fa fa-calendar"></i> Tgl Masuk: <?=$pemesanan['tgl_masuk']?> 
				<i class="fa fa-calendar"></i> Tgl Digunakan: <?=$pemesanan['tgl_digunakan']?>
				<a data-toggle="modal" data-target="#ubah<?=$pemesanan['id']?>"><i class="fa fa-eye"></i> Detail Lengkap</a>
			</small></p>
		</blockquote>
	</div>

	<!-- Modal Detail Lengkap -->
	<div class="modal fade" id="ubah<?=$pemesanan['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="border-bottom:0">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;">&times;</button>
					<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-eye"></i> Informasi Pemesanan</h4>
				</div>
				<div class="modal-body">
					<table class="table">
						<tbody>
							<tr>
								<td>1.</td>
								<td>No. Pemesanan</td>
								<td>:</td>
								<td>
									<?=$pemesanan['id']?>
								</td>
							</tr>
							<tr>
								<td>2.</td>
								<td>Tanggal Digunakan</td>
								<td>:</td>
								<td>
									<?=date("d M Y", strtotime($pemesanan['tgl_digunakan']))?>
								</td>
							</tr>
							<tr>
								<td>3.</td>
								<td>Jenis Pakaian</td>
								<td>:</td>
								<td>
									<?php
									$set = $pemesanan['jenis_pakaian'];
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
									<?=($pemesanan['pengukuran']==1)?'Datang langsung ke Lisa Tailor':'Mengirim contoh pakaian (untuk pemesanan diluar Samarinda)'?>
								</td>
							</tr>
							<tr>
								<td>5.</td>
								<td>Model Pakaian</td>
								<td>:</td>
								<td>
									<img src="upload/<?=$pemesanan['model']?>" class="img-responsive" style="width:200px">
								</td>
							</tr>
							<tr>
								<td>6.</td>
								<td>Menggunakan Puring?</td>
								<td>:</td>
								<td>
									<?=($pemesanan['puring']==1)?'Ya':'Tidak'?>
								</td>
							</tr>
							<tr>
								<td>7.</td>
								<td>Jumlah Pakaian</td>
								<td>:</td>
								<td>
									<?=$pemesanan['jumlah']?> Lembar
								</td>
							</tr>
							<tr>
								<td>8.</td>
								<td>Jenis Kain</td>
								<td>:</td>
								<td>
									<?php
									$set = $pemesanan['jenis_kain'];
									$pilihan = mysql_fetch_object(mysql_query("SELECT * FROM kain WHERE id = '$set' LIMIT 1"));
									echo $pilihan->jenis;			
									?>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	

<?php
		}
	} else {
		echo "<div class='well text-center' style='padding-top:20px'><strong>Anda belum memiliki Daftar Pemesanan.</strong>";
	}
?>
</div>

<?php
include "template/footer.php";
?>