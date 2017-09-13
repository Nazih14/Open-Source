<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

# Kondisi SWITCH CASE berdasarkan proses yang diterima
switch($_GET['proses']){
	case 'hapus' :
		$id = $_GET['konfirm'];
		$sql = mysql_query("DELETE FROM konfirmasi WHERE id = $id");
		$pesan = '
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa fa-times"></i> Salah satu konfirmasi berhasil dihapus.
			</div>
		';
		break;
}

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Toko</a>
		» <a href="#" class="last">Daftar Konfirmasi</a>
	</div>

	<div class="contact-info" style="padding:20px;font-weight:normal;">
		<?=(isset($pesan))?$pesan:'';?>
		<h1>Daftar Konfirmasi Pembayaran</h1>
		<hr/>
		<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th width="70px">No. Order</th>
					<th>Nama</th>
					<th width="70px">Total</th>
					<th width="100px">Tanggal</th>
					<th width="20px">Selengkapnya</th>
				</tr>
			</thead>

			<tbody>
			<?php 
				$semua = mysql_query("SELECT * FROM konfirmasi ORDER BY tanggal DESC");
				while ($daftar = mysql_fetch_array($semua)) { 
			?>
				<tr>
					<td><?=$daftar['no_pemesanan']?></td>
					<td><?=$daftar['nama']?></td>
					<td><?=rupiah($daftar['total_kirim'])?></td>
					<td><?=date("d M Y", strtotime($daftar['tanggal']))?></td>
					<td class="text-center">
						<a data-toggle="modal" data-target="#ubah<?=$daftar['id']?>"><i class="fa fa-pencil"></i> Detail</a> - 
						<a href="daftar-konfirmasi.php?proses=hapus&konfirm=<?=$daftar['id']?>" name="hapus" onclick="return confirm('Anda yakin akan menghapus konfirmasi pembayaran ini?')"><i class="fa fa-times"></i> Hapus</a>
					</td>
				</tr>

				<!-- Modal Ubah -->
				<div class="modal fade" id="ubah<?=$daftar['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;">&times;</button>
								<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-pencil"></i> Informasi Pembayaran</h4>
							</div>
							<div class="modal-body row">
								<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group">
										<label class="col-sm-3 control-label">Nama Pemesan</label>
										<div class="col-sm-9">
											<p><strong><?=$daftar['nama']?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Email</label>
										<div class="col-sm-9">
											<p><strong><?=$daftar['email']?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Telp / HP</label>
										<div class="col-sm-9">
											<p><strong><?=$daftar['telp']?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">No. Pemesanan</label>
										<div class="col-sm-9">
											<p><strong>#<?=$daftar['no_pemesanan']?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Total Kirim</label>
										<div class="col-sm-9">
											<p><strong><?=rupiah($daftar['total_kirim'])?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Bank Tujuan</label>
										<div class="col-sm-9">
											<p><strong><?=($daftar['bank_tujuan']==1)?'BNI - '.$informasi->rek1:'Mandiri - '.$informasi->rek2?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Bank Pengirim</label>
										<div class="col-sm-9">
											<p><strong><?=$daftar['bank_pengirim']?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Pemilik Rekening</label>
										<div class="col-sm-9">
											<p><strong><?=$daftar['pemilik_rekening']?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Catatan</label>
										<div class="col-sm-9">
											<p><strong><?=$daftar['catatan']?></strong></p>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Bukti Resi</label>
										<div class="col-sm-9">
											<img src="upload/resi/<?=$daftar['bukti_resi']?>" class="img-responsive">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				
			<?php } ?>
			</tbody>
		</table>

		<script type="text/javascript">
			$(document).ready(function() {
				$('#datatable').dataTable();
			});
		</script>
	</div>
</div>

<?php
include "template/footer.php";
?>