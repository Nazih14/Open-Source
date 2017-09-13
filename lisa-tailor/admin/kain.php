<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

# Ambil nilai id untuk DELETE
$id = $_GET['kain'];

# Ambil nilai id_kain untuk UPDATE
$id_kain = $_POST['id'];

# Inisialisasi Pesan
$pesan = '';

if($_POST['tambah'] || $_POST['ubah']) {
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		(empty($_POST["kain"])) ? $kainError = "Jenis kain belum diisi" : $kain = tesInputan($_POST["kain"]);

		if($_POST['tambah']) {

			# Bila semua validasi sukses
			if($kain) {
				# Lakukan input data dengan perintah Query MySQL
				$masukin = mysql_query("
					INSERT INTO kain VALUES ('', '$kain')
				");	

				# Siapkan Pesan sukses
				$pesan = '
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check"></i> Jenis Kain Baru berhasil ditambahkan.
					</div>
				';
				
			} else {
				# Siapkan pesan gagal
				$pesan = '
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-times"></i> Terjadi kesalahan dalam input data. <a data-toggle="modal" data-target="#tambah">Klik disini</a> untuk melihat.
					</div>
				';
			}

		} else if($_POST['ubah']) {
			# Bila semua validasi sukses
			if($kain) {

				# Siapkan Query MySQL
				$sql = "UPDATE kain SET jenis = '$kain'
						WHERE id = '$id_kain'";
				
				# Ubah isi database	
				$rubah = mysql_query($sql);

				# Siapkan Pesan sukses
				$pesan = '
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check"></i> Informasi jenis kain berhasil diubah.
					</div>
				';
				
			} else {
				# Siapkan pesan gagal
				$pesan = '
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-times"></i> Terjadi kesalahan dalam perubahan data. <a data-toggle="modal" data-target="#ubah'.$id_kain.'">Klik disini</a> untuk melihat.
					</div>
				';
			}
		}
	}
}



# Kondisi SWITCH CASE berdasarkan proses yang diterima
switch($_GET['proses']){
	case 'hapus' :
		$sql = mysql_query("DELETE FROM kain WHERE id = $id");
		$pesan = '
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa fa-times"></i> Salah satu jenis kain berhasil dihapus.
			</div>
		';
		break;
}

$semua = mysql_query("SELECT * FROM kain");

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Master</a>
		» <a href="#" class="last">Kain</a>
	</div>
	<div class="contact-info" style="padding:20px;font-weight:normal;">
		<?=(isset($pesan))?$pesan:'';?>
		<h1>Daftar Kain <a href="#" class="pull-right" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Baru</a></h1>
		<hr/>
		<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Jenis</th>
					<th width="20px">Ubah</th>
					<th width="20px">Hapus</th>
				</tr>
			</thead>

			<tbody>
			<?php while ($daftar = mysql_fetch_array($semua)) { ?>
				<tr>
					<td><?=$daftar['jenis']?></td>
					<td class="text-center"><a data-toggle="modal" data-target="#ubah<?=$daftar['id']?>"><i class="fa fa-pencil"></i></a></td>
					<td class="text-center">
						<a href="kain.php?proses=hapus&kain=<?=$daftar['id']?>" name="hapus" onclick="return confirm('Anda yakin akan menghapus kain ini?')"><i class="fa fa-times"></i></a>
					</td>
				</tr>

				<!-- Modal Ubah -->
				<div class="modal fade" id="ubah<?=$daftar['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;">&times;</button>
								<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-pencil"></i> Ubah Informasi Kain</h4>
							</div>
							<div class="modal-body">
								<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group <?=($kainError)?'has-error':''?>">
										<label for="kain" class="col-sm-3 control-label">Jenis Kain</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="kain" placeholder="Jenis Kain?" value="<?=$daftar['jenis']?>" >
											<span class="help-block small text-center merah"><?=$kainError?></span>
										</div>
									</div>
							</div>
							<br/>
							<br/>
							<br/>
							<div class="modal-footer" style="margin-top: -20px;padding: 10px 20px 10px;">
								<input type="submit" name="ubah" class="btn btn-success" value="Ubah Informasi">
								<input type="hidden" name="id" value="<?=$daftar['id']?>" />
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

	<!-- Modal Tambah -->
	<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;">&times;</button>
					<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Jenis Kain Baru</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="form-group <?=($kainError)?'has-error':''?>">
							<label for="kain" class="col-sm-3 control-label">Jenis Kain</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="kain" placeholder="Jenis Kain?" value="<?=$kain?>" >
								<span class="help-block small text-center merah"><?=$kainError?></span>
							</div>
						</div>
				</div>
				<div class="modal-footer" style="margin-top: -20px;padding: 10px 20px 10px;">
					<input type="submit" name="tambah" class="btn btn-success" value="Tambah">
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include "template/footer.php";
?>