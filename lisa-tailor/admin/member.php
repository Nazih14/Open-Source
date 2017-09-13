<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

# Ambil nilai id untuk DELETE
$id = $_GET['member'];

# Ambil nilai member untuk UPDATE
$member = $_POST['member'];

# Inisialisasi Pesan
$pesan = '';

if($_POST['tambah'] || $_POST['ubah']) {
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		(empty($_POST["nama"])) ? $namaError = "Nama Anda belum diisi" : $nama = tesInputan($_POST["nama"]);
		(empty($_POST["email"])) ? $emailError = "Email Anda belum diisi" : $email = tesInputan($_POST["email"]);
		# Untuk tambah wajibkan ini, bila tidak abaikan
		if($_POST['tambah']) {
			(empty($_POST["password"])) ? $passwordError = "Belum diisi" : $password = md5(tesInputan($_POST["password"]));
			($_POST["password"]!=$_POST["password_lagi"]) ? $passwordLagiError = "Harus Sama" : $password_lagi = tesInputan($_POST["password_lagi"]);
		}
		(empty($_POST["telp1"])) ? $telp1Error = "Telp belum diisi" : $telp1 = tesInputan($_POST["telp1"]);
		(empty($_POST["telp2"])) ? $telp2Error = "Telp Rumah belum diisi" : $telp2 = tesInputan($_POST["telp2"]);
		(empty($_POST["alamat"])) ? $alamatError = "Alamat belum diisi" : $alamat = tesInputan($_POST["alamat"]);
		(empty($_POST["kota"])) ? $kotaError = "Kota belum diisi" : $kota = tesInputan($_POST["kota"]);
		(empty($_POST["provinsi"])) ? $provinsiError = "Provinsi belum diisi" : $provinsi = tesInputan($_POST["provinsi"]);

		# Inisialisasi variabel yang belum
		$jenis_kelamin = $_POST['jenis_kelamin'];

		if($_POST['tambah']) {
			# Bila semua validasi sukses
			if($nama&&$email&&$password&&$telp1&&$telp2&&$alamat&&$kota&&$provinsi) {

				# Lakukan input data dengan perintah Query MySQL
				$masukin = mysql_query("
					INSERT INTO member VALUES ('', '$nama', '$email', '$password', '$jenis_kelamin', '$telp1', '$telp2', 
						'$alamat', '$kota', '$provinsi', NOW())
				");	

				# Siapkan Pesan sukses
				$pesan = '
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check"></i> Pelanggan Baru berhasil ditambahkan.
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
			if($nama&&$email&&$telp1&&$telp2&&$alamat&&$kota&&$provinsi) {

				# Inisialisasi Inputan Password
				$password = $_POST['password'];

				# Bila password tidak diisi
				if($password=="") {
					$sql = "UPDATE member SET nama = '$nama', email = '$email', jenis_kelamin = '$jenis_kelamin', 
								telp1 = '$telp1', telp2 = '$telp2', alamat = '$alamat', kota = '$kota', 
								provinsi = '$provinsi' 
							WHERE id = '$member'";
				# Bila password diisi
				} else {
					$sql = "UPDATE member SET nama = '$nama', email = '$email', jenis_kelamin = '$jenis_kelamin', 
								telp1 = '$telp1', telp2 = '$telp2', alamat = '$alamat', kota = '$kota', 
								provinsi = '$provinsi', password = MD5('$password') 
							WHERE id = '$member'";
				}
				# Ubah isi database	
				$rubah = mysql_query($sql);

				# Siapkan Pesan sukses
				$pesan = '
					<div class="alert alert-success alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-check"></i> Informasi pelanggan berhasil diubah.
					</div>
				';
				
			} else {
				# Siapkan pesan gagal
				$pesan = '
					<div class="alert alert-danger alert-dismissable">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<i class="fa fa-times"></i> Terjadi kesalahan dalam perubahan data. <a data-toggle="modal" data-target="#ubah'.$member.'">Klik disini</a> untuk melihat.
					</div>
				';
			}
		}
	}
}



# Kondisi SWITCH CASE berdasarkan proses yang diterima
switch($_GET['proses']){
	case 'hapus' :
		$sql = mysql_query("DELETE FROM member WHERE id = $id");
		$pesan = '
			<div class="alert alert-danger alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				<i class="fa fa-times"></i> Salah satu pelanggan berhasil dihapus.
			</div>
		';
		break;
}

$member = mysql_query("SELECT * FROM member ORDER BY tanggal_daftar DESC");

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Master</a>
		» <a href="#" class="last">Pelanggan</a>
	</div>
	<div class="contact-info" style="padding:20px;font-weight:normal;">
		<?=(isset($pesan))?$pesan:'';?>
		<h1>Daftar Pelanggan <a href="#" class="pull-right" data-toggle="modal" data-target="#tambah"><i class="fa fa-plus"></i> Tambah Baru</a></h1>
		<hr/>
		<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Email</th>
					<th>Jenis Kelamin</th>
					<th>Kota</th>
					<th>Provinsi</th>
					<th>Tanggal Daftar</th>
					<th>Ubah</th>
					<th>Hapus</th>
				</tr>
			</thead>

			<tbody>
			<?php while ($daftar = mysql_fetch_array($member)) { ?>
				<tr>
					<td><?=$daftar['nama']?></td>
					<td><?=$daftar['email']?></td>
					<td><?=($daftar['jenis_kelamin']==1)?'Laki-laki':'Perempuan'?></td>
					<td><?=$daftar['kota']?></td>
					<td><?=$daftar['provinsi']?></td>
					<td><?=date('d M Y', strtotime($daftar['tanggal_daftar']))?></td>
					<td class="text-center"><a data-toggle="modal" data-target="#ubah<?=$daftar['id']?>"><i class="fa fa-pencil"></i></a></td>
					<td class="text-center">
						<a href="member.php?proses=hapus&member=<?=$daftar['id']?>" name="hapus" onclick="return confirm('Anda yakin akan menghapus pelanggan ini?')"><i class="fa fa-times"></i></a>
					</td>
				</tr>

				<!-- Modal Tambah -->
				<div class="modal fade" id="ubah<?=$daftar['id']?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;">&times;</button>
								<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-pencil"></i> Ubah Informasi Pelanggan</h4>
							</div>

							<div class="modal-body row">
								<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
									<div class="form-group <?=($namaError)?'has-error':''?>">
										<label for="nama" class="col-sm-3 control-label">Nama Lengkap</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap?" value="<?=$daftar['nama']?>" >
											<span class="help-block small text-center merah"><?=$namaError?></span>
										</div>
									</div>
									<div class="form-group <?=($emailError)?'has-error':''?>">
										<label for="email" class="col-sm-3 control-label">Email</label>
										<div class="col-sm-9">
											<input type="email" class="form-control" name="email" placeholder="Contoh : email@situs.com" value="<?=$daftar['email']?>" >
											<span class="help-block small text-center merah"><?=$emailError?></span>
										</div>
									</div>
									<div class="form-group <?=($passwordError||$passwordLagiError)?'has-error':''?>">
										<label for="password" class="col-sm-3 control-label">Kata Sandi</label>
										<div class="col-sm-4">
											<input type="password" class="form-control" name="password" placeholder="Password?">
											<span class="help-block small text-center merah"><?=$passwordError?></span>
										</div>
										<div class="col-sm-4">
											<input type="password" class="form-control" name="password_lagi" placeholder="Ulangi Password?">
											<span class="help-block small text-center merah"><?=$passwordLagiError?></span>
										</div>
									</div>
									<div class="form-group">
										<label class="col-sm-3 control-label">Jenis Kelamin</label>
										<div class="col-sm-8">
											<select class="form-control" name="jenis_kelamin" style="margin-bottom: 10px;">
												<option value="1">Laki-Laki</option>
												<option value="0">Perempuan</option>
											</select>
										</div>
									</div>
									<div class="form-group <?=($telp1Error||$telp2Error)?'has-error':''?>">
										<label for="telp1" class="col-sm-3 control-label">Kontak Person</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="telp1" placeholder="Nomor Handphone" value="<?=$daftar['telp1']?>" >
											<span class="help-block small text-center merah"><?=$telp1Error?></span>
										</div>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="telp2" placeholder="Telpon Rumah" value="<?=$daftar['telp2']?>" >
											<span class="help-block small text-center merah"><?=$telp2Error?></span>
										</div>
									</div>
									<div class="form-group <?=($alamatError)?'has-error':''?>">
										<label for="alamat" class="col-sm-3 control-label">Alamat</label>
										<div class="col-sm-9">
											<textarea class="form-control" rows="5" name="alamat" placeholder="Tuliskan Alamat Lengkap Anda disini..."><?=$daftar['alamat']?></textarea>
											<span class="help-block small text-center merah"><?=$alamatError?></span>
										</div>
									</div>
									<div class="form-group <?=($kotaError||$provinsiError)?'has-error':''?>">
										<label for="kota" class="col-sm-3 control-label">Daerah</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="kota" placeholder="Kota" value="<?=$daftar['kota']?>" >
											<span class="help-block small text-center merah"><?=$kotaError?></span>
										</div>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="provinsi" placeholder="Provinsi" value="<?=$daftar['provinsi']?>" >
											<span class="help-block small text-center merah"><?=$provinsiError?></span>
										</div>
									</div>
									<div class="form-group">
										<label for="nama" class="col-sm-3 control-label"></label>
										<div class="col-sm-9">
											<input type="submit" name="ubah" class="btn btn-success" value="Ubah Informasi">
										</div>
									</div>
									<input type="hidden" name="member" value="<?=$daftar['id']?>" />
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

	<div class="well">
		<iframe src="member-cetak.php" name="cetak" style="display:none;"></iframe>
		<a href="#" class="btn btn-info" onclick="frames['cetak'].print()" style="color: #fff;">
			<i class="fa fa-print"></i> Cetak Laporan Daftar Pelanggan
		</a>
	</div>

	<!-- Modal Tambah -->
	<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" style="color: black;">&times;</button>
					<h4 class="modal-title text-center" id="myModalLabel"><i class="fa fa-plus"></i> Tambah Pelanggan Baru</h4>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
						<div class="form-group <?=($namaError)?'has-error':''?>">
							<label for="nama" class="col-sm-3 control-label">Nama Lengkap</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap?" value="<?=$nama?>" >
								<span class="help-block small text-center merah"><?=$namaError?></span>
							</div>
						</div>
						<div class="form-group <?=($emailError)?'has-error':''?>">
							<label for="email" class="col-sm-3 control-label">Email</label>
							<div class="col-sm-9">
								<input type="email" class="form-control" name="email" placeholder="Contoh : email@situs.com" value="<?=$email?>" >
								<span class="help-block small text-center merah"><?=$emailError?></span>
							</div>
						</div>
						<div class="form-group <?=($passwordError||$passwordLagiError)?'has-error':''?>">
							<label for="password" class="col-sm-3 control-label">Kata Sandi</label>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password" placeholder="Password?">
								<span class="help-block small text-center merah"><?=$passwordError?></span>
							</div>
							<div class="col-sm-4">
								<input type="password" class="form-control" name="password_lagi" placeholder="Ulangi Password?">
								<span class="help-block small text-center merah"><?=$passwordLagiError?></span>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-3 control-label">Jenis Kelamin</label>
							<div class="col-sm-4">
								<select class="form-control" name="jenis_kelamin">
									<option value="1">Laki-Laki</option>
									<option value="0">Perempuan</option>
								</select>
							</div>
						</div>
						<div class="form-group <?=($telp1Error||$telp2Error)?'has-error':''?>">
							<label for="telp1" class="col-sm-3 control-label">Kontak Person</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="telp1" placeholder="Nomor Handphone" value="<?=$telp1?>" >
								<span class="help-block small text-center merah"><?=$telp1Error?></span>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="telp2" placeholder="Telpon Rumah" value="<?=$telp2?>" >
								<span class="help-block small text-center merah"><?=$telp2Error?></span>
							</div>
						</div>
						<div class="form-group <?=($alamatError)?'has-error':''?>">
							<label for="alamat" class="col-sm-3 control-label">Alamat</label>
							<div class="col-sm-9">
								<textarea class="form-control" rows="5" name="alamat" placeholder="Tuliskan Alamat Lengkap Anda disini..."><?=$alamat?></textarea>
								<span class="help-block small text-center merah"><?=$alamatError?></span>
							</div>
						</div>
						<div class="form-group <?=($kotaError||$provinsiError)?'has-error':''?>">
							<label for="kota" class="col-sm-3 control-label">Daerah</label>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="kota" placeholder="Kota" value="<?=$kota?>" >
								<span class="help-block small text-center merah"><?=$kotaError?></span>
							</div>
							<div class="col-sm-4">
								<input type="text" class="form-control" name="provinsi" placeholder="Provinsi" value="<?=$provinsi?>" >
								<span class="help-block small text-center merah"><?=$provinsiError?></span>
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