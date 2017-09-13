<?php 
require_once "../pengaturan/database.php"; 

# Bila admin telah login dan mengakses halaman ini
if(isset($_SESSION["admin"])) {
	# Alihkan ke halaman index admin
	header("Location: index.php");
	exit();
}

# Jika tombol masuk ditekan, eksekusi perintah berikut
if($_POST['masuk']) {

	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		# Bila Email Belum Diisi
		(empty($_POST["username"])) ? $usernameError = "Username Anda belum diisi" : $username = tesInputan($_POST["username"]);
		# Bila Password Belum Diisi
		(empty($_POST["password"])) ? $passwordError = "Kata Sandi Anda belum diisi" : $password = tesInputan($_POST["password"]);
		
		# Bila validasi sukses
		if($username&&$password) {
			# Lakukan perintah Query MySQL
			$query = mysql_query("SELECT * FROM admin WHERE username = '$username'");
			# Periksa apakah username yang dimaksud ada dalam database?
			$periksa = mysql_num_rows($query);
			# Bila username yang dimaksud ada
			if($periksa!=0) {
				# Ambil username dan passwordnya
				while ($row = mysql_fetch_assoc($query)) {
					$dbUser = $row['username'];
					$dbPass = $row['password'];
				}
				# Lalu cocokan dengan inputan, dan bila cocok
				if($username==$dbUser&&md5($password)==$dbPass) {
					# Anda masuk dengan session admin
					$_SESSION['admin'] = $username;
					header("Location: index.php");
					exit();
				# Sedangkan bila tidak cocok
				} else {
					# Tampilkan alert error
					echo "<script>alert('Kata Sandi yang Anda masukkan salah.')</script>";
				}
			# Untuk username yang belum terdaftar
			} else {
				# Tampilkan alert error
				echo "<script>alert('Username yang Anda masukkan salah.')</script>";
			}
		}
	}
}

include "template/head.php";
include "template/header.php";
?>

<div class="col-sm-12">  
	<div class="box-container">
		<div class="login-content row">
			<div class="col-sm-4 col-sm-offset-4">
				<div class="right">
					<div class="heading">
						<i class="fa fa-key"></i>
						<div class="extra-wrap">
							<h2>ADMIN PANEL</h2>
							<b>Masuk sebagai Administrator</b>
						</div>
					</div>
					<form class="form-horizontal" action="<?=htmlspecialchars($_SERVER["PHP_SELF"])?>" method="POST">
						<div class="content">
							<div class="form-group <?=($usernameError)?'has-error':''?>">
								<label class="padd-form control-label col-sm-5" for="username">Username:</label>
								<div class="controls col-sm-7">
									<input class="q1 margen-bottom" type="text" name="username" value="<?=$username?>">
									<span class="help-block small text-center merah"><?=$usernameError?></span>
								</div>
							</div>
							<div class="form-group <?=($passwordError)?'has-error':''?>">
								<label class="padd-form control-label col-sm-5" for="password">Password:</label>
								<div class="controls col-sm-7">
									<input class="q1 margen-bottom" type="password" name="password">
									<span class="help-block small text-center merah"><?=$passwordError?></span>
								</div>
							</div>
							<div class="login-buttons">
								<input type="submit" name="masuk" class="btn btn-info pull-right" value="Login">
							</div>
							<br/>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
include "template/footer.php";
?>