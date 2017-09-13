<?php 
require_once "pengaturan/database.php"; 

# Bila member telah login mengakses halaman ini,
if(isset($_SESSION["member"])) {
	# Alihkan ke halaman profil
	header("Location: profil.php");
	exit();
}

# Bila yang ditekan tombol daftar
if($_POST['daftar']) {
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		(empty($_POST["nama"])) ? $namaError = "Nama Anda belum diisi" : $nama = tesInputan($_POST["nama"]);
		(empty($_POST["email"])) ? $emailError = "Email Anda belum diisi" : $email = tesInputan($_POST["email"]);
		(empty($_POST["password"])) ? $passwordError = "Belum diisi" : $password = md5(tesInputan($_POST["password"]));
		($_POST["password"]!=$_POST["password_lagi"]) ? $passwordLagiError = "Harus Sama" : $password_lagi = tesInputan($_POST["password_lagi"]);
		(empty($_POST["telp1"])) ? $telp1Error = "Telp belum diisi" : $telp1 = tesInputan($_POST["telp1"]);
		(empty($_POST["telp2"])) ? $telp2Error = "Telp Rumah belum diisi" : $telp2 = tesInputan($_POST["telp2"]);
		(empty($_POST["alamat"])) ? $alamatError = "Alamat belum diisi" : $alamat = tesInputan($_POST["alamat"]);
		(empty($_POST["kota"])) ? $kotaError = "Kota belum diisi" : $kota = tesInputan($_POST["kota"]);
		(empty($_POST["provinsi"])) ? $provinsiError = "Provinsi belum diisi" : $provinsi = tesInputan($_POST["provinsi"]);

		# Inisialisasi variabel yang belum
		$jenis_kelamin = $_POST['jenis_kelamin'];

		# Bila semua validasi sukses
		if($nama&&$email&&$password&&$telp1&&$telp2&&$alamat&&$kota&&$provinsi) {

			# Lakukan input data dengan perintah Query MySQL
			$masukin = mysql_query("
				INSERT INTO member VALUES ('', '$nama', '$email', '$password', '$jenis_kelamin', '$telp1', '$telp2', 
					'$alamat', '$kota', '$provinsi', NOW())
			");

			# Alihkan kehalaman registrasi sukses sukses
			header('Location: registrasi-berhasil.php');
			exit();
			
		}
	
	}

# Dan bila yang ditekan tombol login
} elseif ($_POST['masuk']) {
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		# Bila Email Belum Diisi
		(empty($_POST["emailLogin"])) ? $emailLoginError = "Email Anda belum diisi" : $emailLogin = tesInputan($_POST["emailLogin"]);
		# Bila Password Belum Diisi
		(empty($_POST["passwordLogin"])) ? $passwordLoginError = "Kata Sandi Anda belum diisi" : $passwordLogin = tesInputan($_POST["passwordLogin"]);
		
		# Bila validasi sukses
		if($emailLogin&&$passwordLogin) {
			# Lakukan perintah Query MySQL
			$query = mysql_query("SELECT * FROM member WHERE email = '$emailLogin'");
			# Periksa apakah email yang dimaksud ada dalam database?
			$periksa = mysql_num_rows($query);
			# Bila email yang dimaksud ada
			if($periksa!=0) {
				# Ambil email dan passwordnya
				while ($row = mysql_fetch_assoc($query)) {
					$dbEmail = $row['email'];
					$dbSandi = $row['password'];
				}
				# Lalu cocokan dengan inputan, dan bila cocok
				if($emailLogin==$dbEmail&&md5($passwordLogin)==$dbSandi) {
					# Anda masuk dengan session member
					$_SESSION['member'] = $emailLogin;
					header("Location: profil.php");
					exit();
				# Sedangkan bila tidak cocok
				} else {
					# Tampilkan alert error
					echo "<script>alert('Kata Sandi yang Anda masukkan salah.')</script>";
				}
			# Untuk email yang belum terdaftar
			} else {
				# Tampilkan alert error
				echo "<script>alert('Email yang Anda masukkan belum terdaftar.')</script>";
			}
		}
	}
}

# Tampilan
include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<h1>Registrasi Akun Baru</h1>
<div class="box-container">
	<p>Jika ingin melakukan pemesanan namun belum memiliki Akun, maka Anda diharuskan melakukan registrasi terlebih dahulu.</p>
	<form class="form-horizontal contact-info" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
		<hr/>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<input type="submit" name="daftar" class="btn btn-success" value="Daftar Sekarang">
			</div>
		</div>
	</form>
</div>
<hr/>
<h1 id="masuk">Langsung Login</h1>
<div class="box-container">
	<p>Dan jika Anda telah memiliki Akun, maka dapat langsung Login menggunakan panel dibawah ini.</p>
	<form class="form-horizontal contact-info" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div class="form-group <?=($emailLoginError)?'has-error':''?>">
			<label for="email" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<input type="email" class="form-control" name="emailLogin" placeholder="Email" value="<?=$emailLogin?>" >
				<span class="help-block small text-center merah"><?=$emailLoginError?></span>
			</div>
		</div>
		<div class="form-group <?=($passwordLoginError)?'has-error':''?>">
			<label for="password" class="col-sm-3 control-label">Password</label>
			<div class="col-sm-9">
				<input type="password" class="form-control" name="passwordLogin" placeholder="Kata Sandi / Password">
				<span class="help-block small text-center merah"><?=$passwordLoginError?></span>
			</div>
		</div>
		<hr/>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<input type="submit" name="masuk" class="btn btn-success" value="Masuk">
			</div>
		</div>
	</form>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>