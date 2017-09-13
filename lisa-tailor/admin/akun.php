<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

# Set admin
$set = $_SESSION['admin'];

# Ambil Informasi admin yang login berdasarkan email
$admin = mysql_fetch_object(mysql_query("SELECT * FROM admin WHERE username = '$set' LIMIT 1"));

# Bila yang ditekan tombol simpan
if($_POST['simpan']) {
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		(empty($_POST["nama"])) ? $namaError = "Nama Anda belum diisi" : $nama = tesInputan($_POST["nama"]);
		(empty($_POST["username"])) ? $usernameError = "Username Anda belum diisi" : $username = tesInputan($_POST["username"]);
		($_POST["password"]!=$_POST["password_lagi"]) ? $passwordLagiError = "Harus Sama" : $password_lagi = tesInputan($_POST["password_lagi"]);

		# Inisialisasi variabel yang belum
		$password = md5($_POST['password']);

		# Bila semua validasi sukses
		if($nama&&$username) {

			# Lakukan input data dengan perintah Query MySQL
			$sql = "UPDATE admin SET nama = '$nama', username = '$username', ";
			if($password!='') 
			$sql .= "password = '$password'";
			$sql .= "WHERE id = '$admin->id'";	

			
			$masukin = mysql_query($sql) or die(mysql_error());

			# Pesan Sukses
			$pesan = '
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Informasi Akun berhasil dirubah. Silahkan Refresh Halaman untuk melihat perubahan.
			</div>
			';
		}
	}
}

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<div class="col-sm-9" id="content">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Pengaturan</a>
		» <a href="#" class="last">Akun</a>
	</div>
	<form class="form-horizontal contact-info" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?=(isset($pesan))?$pesan:'';?>
		<div class="form-group <?=($namaError)?'has-error':''?>">
			<label for="nama" class="col-sm-2 control-label">Nama Lengkap</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap?" value="<?=$admin->nama?>" >
				<span class="help-block small text-center merah"><?=$namaError?></span>
			</div>
		</div>
		<div class="form-group <?=($usernameError)?'has-error':''?>">
			<label for="username" class="col-sm-2 control-label">Username</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="username" placeholder="Nama Pengguna?" value="<?=$admin->username?>" >
				<span class="help-block small text-center merah"><?=$usernameError?></span>
			</div>
		</div>
		<div class="form-group <?=($passwordError||$passwordLagiError)?'has-error':''?>">
			<label for="password" class="col-sm-2 control-label">Kata Sandi</label>
			<div class="col-sm-5">
				<input type="password" class="form-control" name="password" placeholder="Password?">
				<span class="help-block small text-center merah"><?=$passwordError?></span>
				<span class="help-block small merah">*Abaikan bila tidak ingin melakukan perubahan kata sandi.</span>
			</div>
			<div class="col-sm-5">
				<input type="password" class="form-control" name="password_lagi" placeholder="Ulangi Password?">
				<span class="help-block small text-center merah"><?=$passwordLagiError?></span>
			</div>
		</div>		
		<hr/>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<input type="submit" name="simpan" class="btn btn-success" value="Simpan Perubahan">
			</div>
		</div>
	</form>
</div>

<?php
include "template/footer.php";
?>