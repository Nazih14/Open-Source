<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

# Ambil nilai id untuk DELETE
$id = $_GET['kategori'];

# Ambil nilai id untuk UPDATE
$id_jenis = $_POST['id'];

# Inisialisasi Pesan
$pesan = '';

if($_POST['tambah'] || $_POST['ubah']) {
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		(empty($_POST["kategori"])) ? $kategoriError = "Kolom kategori belum diisi" : $kategori = tesInputan($_POST["kategori"]);

		if($_POST['tambah']) {

			# Bila semua validasi sukses
			if($kategori) {
				# Jenis & Tipe
				$jenis = $_POST['jenis'];
				$tipe = $_POST['tipe'];

				# Lakukan input data dengan perintah Query MySQL
				$masukin = mysql_query("
					INSERT INTO kategori VALUES ('', '$kategori', '$jenis', '$tipe')
				");	

				# Siapkan Pesan sukses
				$pesan = '
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check"></i> Kategori Baru berhasil ditambahkan.
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
			if($kategori) {
				# Jenis & Tipe
				$jenis = $_POST['jenis'];
				$tipe = $_POST['tipe'];

				# Siapkan Query MySQL
				$sql = "UPDATE kategori SET nama = '$kategori', jenis = '$jenis', tipe = '$tipe'
						WHERE id = '$id_jenis'";
				
				# Ubah isi database	
				$rubah = mysql_query($sql);

				# Siapkan Pesan sukses
				$pesan = '
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check"></i> Informasi kategori berhasil diubah.
					</div>
				';
				
			} else {
				# Siapkan pesan gagal
				$pesan = '
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-times"></i> Terjadi kesalahan dalam perubahan data. <a data-toggle="modal" data-target="#ubah'.$id_jenis.'">Klik disini</a> untuk melihat.
					</div>
				';
			}
		}
	}
}



# Kondisi SWITCH CASE berdasarkan proses yang diterima
switch($_GET['proses']){
	case 'hapus' :
		$sql = mysql_query("DELETE FROM kategori WHERE id = $id");
		$pesan = '
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa fa-times"></i> Salah satu jenis kategori berhasil dihapus.
			</div>
		';
		break;
}

$semua = mysql_query("SELECT * FROM kategori");

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Master</a>
		» <a href="#" class="last">Kategori</a>
	</div>
	<div class="contact-info" style="padding:20px;font-weight:normal;">
		<?=(isset($pesan))?$pesan:'';?>
		<h1>Daftar Kategori Jenis Pakaian <a href="#" class="pull-right" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Baru</a></h1>
		<hr/>
		<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Kategori</th>
					<th>Tipe</th>
					<th width="20px">Ubah</th>
					<th width="20px">Hapus</th>
				</tr>
			</thead>

			<tbody>
			<?php while ($daftar = mysql_fetch_array($semua)) { ?>
				<tr>
					<td><?=$daftar['nama']?></td>
					<td><?=($daftar['jenis']==1)?'Pria':'Wanita'?></td>
					<td><?=($daftar['tipe']==1)?'Atasan':'Bawahan'?></td>
					<td class="text-center"><a data-toggle="modal" data-target="#ubah<?=$daftar['id']?>"><i class="fa fa-pencil"></i></a></td>
					<td class="text-center">
						<a href="kategori.php?proses=hapus&kategori=<?=$daftar['id']?>" name="hapus" onclick="return confirm('Anda yakin akan menghapus kategori ini?')"><i class="fa fa-times"></i></a>
					</td>
				</tr>

				<!-- Modal Ubah -->
				<div class="modal fade" id="ubah<?=$daftar['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;">&times;</button>
								<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-pencil"></i> Ubah Informasi Kategori</h4>
							</div>
							<div class="modal-body row">
								<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group <?=($kategoriError)?'has-error':''?>">
										<label for="kategori" class="col-sm-3 control-label">Nama Kategori</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="kategori" placeholder="Nama Kategori?" value="<?=$daftar['nama']?>" >
											<span class="help-block small text-center merah"><?=$kategoriError?></span>
										</div>
									</div>
									<div class="form-group">
										<label for="jenis" class="col-sm-3 control-label">Jenis</label>
										<div class="col-sm-9" style="margin-bottom: 10px;">
											<select name="jenis">
												<option value="1">Pria</option>
												<option value="2">Wanita</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="tipe" class="col-sm-3 control-label">Tipe</label>
										<div class="col-sm-9">
											<select name="tipe">
												<option value="1">Atasan</option>
												<option value="2">Bawahan</option>
											</select>
										</div>
									</div>
							</div>
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
					<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Kategori Baru</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="form-group <?=($kategoriError)?'has-error':''?>">
							<label for="kategori" class="col-sm-3 control-label">Nama Kategori</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="kategori" placeholder="Nama Kategori?" value="<?=$kategori?>" >
								<span class="help-block small text-center merah"><?=$kategoriError?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="jenis" class="col-sm-3 control-label">Jenis</label>
							<div class="col-sm-9">
								<select name="jenis">
									<option value="1">Pria</option>
									<option value="2">Wanita</option>
								</select>
							</div>
						</div>
						<div class="form-group">
						<label for="tipe" class="col-sm-3 control-label">Tipe</label>
							<div class="col-sm-9">
							<select name="tipe">
									<option value="1">Atasan</option>
									<option value="2">Bawahan</option>
								</select>
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