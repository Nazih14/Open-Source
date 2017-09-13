<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

# Inisialisasi Pesan
$pesan = '';

# Ambil nilai id_kain untuk UPDATE
$id_pakaian = $_POST['id'];

if($_POST['tambah'] || $_POST['ubah']) {
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		(empty($_POST["nama"])) ? $namaError = "Nama pakaian belum diisi" : $nama = tesInputan($_POST["nama"]);
		(empty($_POST["informasi"])) ? $informasiError = "Informasi belum diisi" : $informasi = $_POST["informasi"];
		(empty($_POST["ongkos"])) ? $ongkosError = "Ongkos belum diisi" : $ongkos = tesInputan($_POST["ongkos"]);
		# Khusus untuk Tambah
		if($_POST['tambah']) {
			(empty($_FILES['foto']['name'])) ? $fotoError = "Pilih dulu foto." : $foto = tesInputan($_FILES['foto']['name']);
		}
		# inisialisasi jenis
		$id_jenis = $_POST['kategori'];

		# Defile lokasi upload file
		define("UPLOAD_DIR", "upload/");

		# Cek file yang diupload
		if (!empty($_FILES['foto']['name'])) {

  	// verifikasi file gambar (GIF, JPEG, atau PNG)
			$tipeFile = exif_imagetype($_FILES['foto']['tmp_name']);
			$izinkan = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
			if (!in_array($tipeFile, $izinkan)) {
				echo "<script>alert('Maaf, hanya diijinkan untuk meng-upload file gambar (gif, jpg, atau png)')</script>";
			} else {
				$foto = $_FILES['foto'];
    // ubah paksa nama file yg mengandung selain huruf, angka, ".", "_", dan "-" dengan regex
				$nama_foto = preg_replace("/[^A-Z0-9._-]/i", "_", $foto['name']);
    // periksa ekstensi file
				$parts = pathinfo($nama_foto);
				if (isset($parts['extension'])) {
					$ext = $parts['extension'];
					if ($ext !== 'jpg' && $ext !== 'gif' && $ext !== 'png')
						$ext = "jpg";
					$nama_foto = $parts['filename'] . '.' . $ext;
				} else { 
	// jika file tidak memiliki ekstensi maka berikan ekstensi .jpg
					$ext = 'jpg';
					$nama_foto = $parts['filename'] . '.jpg';
				}
	// simpan file kelokasi upload yang ditentukan
				move_uploaded_file($foto['tmp_name'], UPLOAD_DIR . $nama_foto);
			}
		}

		if($_POST['tambah']) {

			# Bila semua validasi sukses
			if($nama&&$informasi&&$ongkos&&$foto) {
				# Lakukan input data dengan perintah Query MySQL
				$masukin = mysql_query("
					INSERT INTO pakaian VALUES ('', '$nama', '$ongkos', '$informasi', '$nama_foto', NOW(), '$id_jenis')
				");	

				# Siapkan Pesan sukses
				$pesan = '
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check"></i> Pakaian Baru berhasil ditambahkan.
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
			if($nama&&$informasi&&$ongkos) {
				# Bila ada perubahan pada foto
				if(!empty($_FILES['foto']['name'])) {
					# Siapkan Query MySQL
					$sql = "UPDATE pakaian SET nama = '$nama', ongkos = '$ongkos', informasi = '$informasi', 
								foto = '$nama_foto', id_jenis = '$id_jenis'
							WHERE id = '$id_pakaian'";
				} else {
					# Siapkan Query MySQL
					$sql = "UPDATE pakaian SET nama = '$nama', ongkos = '$ongkos', informasi = '$informasi', 
								id_jenis = '$id_jenis'
							WHERE id = '$id_pakaian'";
				}

				# Ubah isi database	
				$rubah = mysql_query($sql);

				# Siapkan Pesan sukses
				$pesan = '
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check"></i> Informasi pakaian berhasil diubah.
					</div>
				';
				
			} else {
				# Siapkan pesan gagal
				$pesan = '
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-times"></i> Terjadi kesalahan dalam perubahan data. <a data-toggle="modal" data-target="#ubah'.$id_pakaian.'">Klik disini</a> untuk melihat.
					</div>
				';
			}
		}
	}
}

# Kondisi SWITCH CASE berdasarkan proses yang diterima
switch($_GET['proses']){
	case 'hapus' :
		# Ambil nilai id untuk DELETE
		$id = $_GET['pakaian'];

		$sql = mysql_query("DELETE FROM pakaian WHERE id = $id");
		
		$pesan = '
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa fa-times"></i> Salah satu pakaian berhasil dihapus.
			</div>
		';
		break;
}

$semua = mysql_query("SELECT * FROM pakaian");

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Master</a>
		» <a href="#" class="last">Pakaian</a>
	</div>
	<div class="contact-info" style="padding:20px;font-weight:normal;">
		<?=(isset($pesan))?$pesan:'';?>
		<h1>Daftar Pakaian <a href="#" class="pull-right" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Baru</a></h1>
		<hr/>
		<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th width="150px">Foto</th>
					<th>Nama Pakaian</th>
					<th>Ongkos</th>
					<th>Jenis</th>
					<th width="20px">Ubah</th>
					<th width="20px">Hapus</th>
				</tr>
			</thead>

			<tbody>
			<?php while ($daftar = mysql_fetch_array($semua)) { ?>
				<tr>
					<td>
						<a href="upload/<?=$daftar['foto']?>" target="_blank">
							<img src="upload/<?=$daftar['foto']?>">
						</a>
					</td>
					<td><?=$daftar['nama']?></td>
					<td><?=rupiah($daftar['ongkos'])?></td>
					<td>	
					<?php
						$jenis = mysql_fetch_object(mysql_query("SELECT nama FROM kategori WHERE id = '$daftar[id_jenis]' LIMIT 1"));
						echo $jenis->nama;
					?>
					</td>
					<td class="text-center"><a data-toggle="modal" data-target="#ubah<?=$daftar['id']?>"><i class="fa fa-pencil"></i></a></td>
					<td class="text-center">
						<a href="pakaian.php?proses=hapus&pakaian=<?=$daftar['id']?>" name="hapus" onclick="return confirm('Anda yakin akan menghapus pakaian ini?')"><i class="fa fa-times"></i></a>
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
							<div class="modal-body row">
								<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
									<div class="form-group <?=($namaError)?'has-error':''?>">
										<label for="nama" class="col-sm-3 control-label">Nama Pakaian</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="nama" placeholder="Nama Pakaian?" value="<?=$daftar['nama']?>" >
											<span class="help-block small text-center merah"><?=$namaError?></span>
										</div>
									</div>
									<div class="form-group <?=($informasiError)?'has-error':''?>">
										<label for="informasi" class="col-sm-3 control-label">Informasi</label>
										<div class="col-sm-9">
											<textarea class="form-control" name="informasi" ><?=$daftar['informasi']?></textarea>
											<span class="help-block small text-center merah"><?=$informasiError?></span>
										</div>
									</div>
									<div class="form-group <?=($ongkosError)?'has-error':''?>">
										<label for="ongkos" class="col-sm-3 control-label">Harga</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="ongkos" placeholder="Harga Pakaian?" value="<?=$daftar['ongkos']?>" >
											<span class="help-block small text-center merah"><?=$ongkosError?></span>
										</div>
									</div>
									<div class="form-group">
										<label for="kategori" class="col-sm-3 control-label">Kategori Jenis</label>
										<div class="col-sm-9">
											<select name="kategori" style="margin-bottom: 10px;">
												<optgroup label="Pria">
													<?php
													$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 1 ORDER BY nama ASC");
													while(list($id, $nama) = mysql_fetch_row($pilihan)){
														echo "<option value='$id'>$nama</option>";
													}
													?>
												</optgroup>
												<optgroup label="Wanita">
													<?php
													$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 2 ORDER BY nama ASC");
													while(list($id, $nama) = mysql_fetch_row($pilihan)){
														echo "<option value='$id'>$nama</option>";
													}
													?>
												</optgroup>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"></label>
										<div class="col-sm-9" style="margin-bottom: 10px;">
											<img src="upload/<?=$daftar['foto']?>" width="150px">
										</div>
									</div>
									<div class="form-group <?=($fotoError)?'has-error':''?>">
										<label for="foto" class="col-sm-3 control-label">Upload Gambar</label>
										<div class="col-sm-9">
											<input type="file" name="foto" >
											<span class="help-block small merah"><?=($fotoError)?$fotoError:'*Abaikan bila tidak ada perubahan pada gambar.'?></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label"></label>
										<div class="col-sm-9">
											<input type="submit" name="ubah" class="btn btn-success" value="Ubah Informasi">
										</div>
									</div>
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
					<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Pakaian Baru</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
						<div class="form-group <?=($namaError)?'has-error':''?>">
							<label for="nama" class="col-sm-3 control-label">Nama Pakaian</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nama" placeholder="Nama Pakaian?" value="<?=$nama?>" >
								<span class="help-block small text-center merah"><?=$namaError?></span>
							</div>
						</div>
						<div class="form-group <?=($informasiError)?'has-error':''?>">
							<label for="informasi" class="col-sm-3 control-label">Informasi</label>
							<div class="col-sm-9">
								<textarea class="form-control" name="informasi"></textarea>
								<span class="help-block small text-center merah"><?=$informasiError?></span>
							</div>
						</div>
						<div class="form-group <?=($ongkosError)?'has-error':''?>">
							<label for="ongkos" class="col-sm-3 control-label">Harga</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="ongkos" placeholder="Harga Pakaian?" value="<?=$ongkos?>" >
								<span class="help-block small text-center merah"><?=$ongkosError?></span>
							</div>
						</div>
						<div class="form-group">
							<label for="kategori" class="col-sm-3 control-label">Kategori Jenis</label>
							<div class="col-sm-9">
								<select name="kategori">
									<optgroup label="Pria">
										<?php
											$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 1 ORDER BY nama ASC");
											while(list($id, $nama) = mysql_fetch_row($pilihan)){
												echo "<option value='$id'>$nama</option>";
										}
										?>
									</optgroup>
									<optgroup label="Wanita">
										<?php
											$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 2 ORDER BY nama ASC");
											while(list($id, $nama) = mysql_fetch_row($pilihan)){
												echo "<option value='$id'>$nama</option>";
										}
										?>
									</optgroup>
								</select>
							</div>
						</div>

						<div class="form-group <?=($fotoError)?'has-error':''?>">
							<label for="foto" class="col-sm-3 control-label">Upload Gambar</label>
							<div class="col-sm-9">
								<input type="file" name="foto" >
								<span class="help-block small text-center merah"><?=$fotoError?></span>
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