<?php 
require_once "pengaturan/database.php"; 

# Pesan Kosong
$pesan = '';

# Bila yang diterima adalah halaman $_POST
if (!empty($_POST)) {
	
	# Deklarasi variabel
	$namaError = $emailError = $testimonialError = "";
	$nama = $email = $testimonial = "";
	
	# Validasi
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		# Validasi Bila Nama Belum Diisi
		(empty($_POST["nama"])) ? $namaError = "Nama Anda belum diisi" : $nama = tesInputan($_POST["nama"]);
		# Validasi Email Belum Diisi
		(empty($_POST["email"])) ? $emailError = "Email Anda belum diisi" : $email = tesInputan($_POST["email"]);
		# Validasi Testimonial Belum Diisi
		(empty($_POST["testimoni"])) ? $testimonialError = "Testimonial belum diisi" : $testimoni = tesInputan($_POST["testimoni"]);
		
		# Bila validasi ketiganya sukses
		if($nama&&$email&&$testimoni) {
			# Lakukan perintah Query MySQL
			$masukin = mysql_query("INSERT INTO testimonial () VALUES ('', '$nama', '$email', '$testimoni', NOW())") or die(mysql_error());
			# Pesan Sukses
			$pesan = '
			<div class="alert alert-success alert-dismissable">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				Terima Kasih Atas Testimonial yang Anda berikan.
			</div>
			';
			# Kosongkan Semua variabel berikut
			$namaError = $emailError = $testimonialError = $nama = $email = $testimonial = "";
		}
	} 

}

# Tampilan
include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>
<h1>Beri Kami Testimoni</h1>
<hr/>
<div class="contact-info">
	<?=(isset($pesan))?$pesan:'';?>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form-horizontal">
		<div class="form-group <?=($namaError)?'has-error':''?>">
			<label for="nama" class="col-sm-3 control-label">Nama</label>
			<div class="col-sm-9">
				<input type="text" class="form-control" name="nama" placeholder="Siapa Nama Kamu?" value="<?=$nama?>" autocomplete="off">
				<span class="help-block small text-center merah"><?=$namaError?></span>
			</div>
		</div>
		<div class="form-group <?=($emailError)?'has-error':''?>">
			<label for="email" class="col-sm-3 control-label">Email</label>
			<div class="col-sm-9">
				<input type="email" class="form-control" name="email" placeholder="Boleh Tau Email Kamu?" value="<?=$email?>" autocomplete="off">
				<span class="help-block small text-center merah"><?=$emailError?></span>
			</div>
		</div>
		<div class="form-group <?=($testimonialError)?'has-error':''?>">
			<label for="testimoni" class="col-sm-3 control-label">Testimonial</label>
			<div class="col-sm-9">
				<textarea class="form-control" name="testimoni" placeholder="Tuangkan Testimoni Kamu Disini..." value="<?=$testimoni?>" ></textarea>
				<span class="help-block small text-center merah"><?=$testimonialError?></span>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-9">
				<input type="submit" class="btn btn-success" name="tombol" value="Kirim">
			</div>
		</div>
	</form>
</div>
<hr/>
<h1>Terima Kasih Kepada Teman-teman atas Testinya</h1>
<hr/>

<?php
$daftar = mysql_query("SELECT * FROM testimonial ORDER BY tanggal DESC");
while($testimonial = mysql_fetch_assoc($daftar)) {
?>
<div style="background-color:#fff">
	<blockquote>
		<p><?=$testimonial['testimoni']?></p>
		<p><small>
			<a href="mailto:<?=$testimonial['email']?>"><?=$testimonial['nama']?></a> - 
			<i class="fa fa-calendar"></i> <?=date("d M Y, h:i", strtotime($testimonial['tanggal']))?>
		</small></p>
	</blockquote>
</div>
<?php
}
?>

<?php
include "template/kanan.php";
include "template/footer.php";
?>