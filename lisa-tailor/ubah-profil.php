<?php
require_once "pengaturan/database.php";

# Bila Anda belum terdaftar
if(!isset($_SESSION['member'])) {
	# Alihkan kehalaman "login-registrasi.php"
	header("Location: login-registrasi.php");	
	exit();
}

# Set member
$set = $_SESSION['member'];

# Ambil Informasi member yang login berdasarkan email
$member = mysql_fetch_object(mysql_query("SELECT * FROM member WHERE email = '$set' LIMIT 1"));

# Bila yang ditekan tombol simpan
if($_POST['simpan']) {
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		(empty($_POST["nama"])) ? $namaError = "Nama Anda belum diisi" : $nama = tesInputan($_POST["nama"]);
		(empty($_POST["email"])) ? $emailError = "Email Anda belum diisi" : $email = tesInputan($_POST["email"]);
		($_POST["password"]!=$_POST["password_lagi"]) ? $passwordLagiError = "Harus Sama" : $password_lagi = tesInputan($_POST["password_lagi"]);
		(empty($_POST["telp1"])) ? $telp1Error = "Telp belum diisi" : $telp1 = tesInputan($_POST["telp1"]);
		(empty($_POST["telp2"])) ? $telp2Error = "Telp Rumah belum diisi" : $telp2 = tesInputan($_POST["telp2"]);
		(empty($_POST["alamat"])) ? $alamatError = "Alamat belum diisi" : $alamat = tesInputan($_POST["alamat"]);
		(empty($_POST["kota"])) ? $kotaError = "Kota belum diisi" : $kota = tesInputan($_POST["kota"]);
		(empty($_POST["provinsi"])) ? $provinsiError = "Provinsi belum diisi" : $provinsi = tesInputan($_POST["provinsi"]);

		# Inisialisasi variabel yang belum
		$password = md5($_POST['password']);
		$jenis_kelamin = $_POST['jenis_kelamin'];

		# Bila semua validasi sukses
		if($nama&&$email&&$telp1&&$telp2&&$alamat&&$kota&&$provinsi) {

			# Lakukan input data dengan perintah Query MySQL
			$sql = "UPDATE member SET 
						nama = '$nama', 
						email = '$email', 
						jenis_kelamin = '$jenis_kelamin', 
						telp1 = '$telp1', 
						telp2 = '$telp2', 
						alamat = '$alamat', 
						kota = '$kota', 
						provinsi = '$provinsi', ";
			if($password!='') 
			$sql .= "password = '$password'";
			$sql .= "WHERE id = '$member->id'";	

			
			$masukin = mysql_query($sql) or die(mysql_error());

			# Alihkan kehalaman profil sukses
			header('Location: profil.php');
			exit();
		}
	}
}

# Tampilan
include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<h1 class="text-center">Informasi Akun Anda</h1>
<form class="form-horizontal contact-info" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	<div class="form-group <?=($namaError)?'has-error':''?>">
		<label for="nama" class="col-sm-3 control-label">Nama Lengkap</label>
		<div class="col-sm-9">
			<input type="text" class="form-control" name="nama" placeholder="Nama Lengkap?" value="<?=$member->nama?>" >
			<span class="help-block small text-center merah"><?=$namaError?></span>
		</div>
	</div>
	<div class="form-group <?=($emailError)?'has-error':''?>">
		<label for="email" class="col-sm-3 control-label">Email</label>
		<div class="col-sm-9">
			<input type="email" class="form-control" name="email" placeholder="Contoh : email@situs.com" value="<?=$member->email?>" >
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
		<span class="help-block small merah text-center">*Abaikan bila tidak ingin melakukan perubahan kata sandi.</span>
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
			<input type="text" class="form-control" name="telp1" placeholder="Nomor Handphone" value="<?=$member->telp1?>" >
			<span class="help-block small text-center merah"><?=$telp1Error?></span>
		</div>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="telp2" placeholder="Telpon Rumah" value="<?=$member->telp2?>" >
			<span class="help-block small text-center merah"><?=$telp2Error?></span>
		</div>
	</div>
	<div class="form-group <?=($alamatError)?'has-error':''?>">
		<label for="alamat" class="col-sm-3 control-label">Alamat</label>
		<div class="col-sm-9">
			<textarea class="form-control" rows="5" name="alamat" placeholder="Tuliskan Alamat Lengkap Anda disini..."><?=$member->alamat?></textarea>
			<span class="help-block small text-center merah"><?=$alamatError?></span>
		</div>
	</div>
	<div class="form-group <?=($kotaError||$provinsiError)?'has-error':''?>">
		<label for="kota" class="col-sm-3 control-label">Daerah</label>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="kota" placeholder="Kota" value="<?=$member->kota?>" >
			<span class="help-block small text-center merah"><?=$kotaError?></span>
		</div>
		<div class="col-sm-4">
			<input type="text" class="form-control" name="provinsi" placeholder="Provinsi" value="<?=$member->provinsi?>" >
			<span class="help-block small text-center merah"><?=$provinsiError?></span>
		</div>
	</div>
	<hr/>
	<div class="form-group">
		<div class="col-sm-offset-3 col-sm-9">
			<input type="submit" name="simpan" class="btn btn-success" value="Simpan Perubahan">
		</div>
	</div>
</form>

<?php
include "template/kanan.php";
include "template/footer.php";
?>