<?php 
require_once "pengaturan/database.php"; 

# Bila Anda belum terdaftar
if(!isset($_SESSION['member'])) {
	# Alihkan kehalaman "login-registrasi.php"
	header("Location: login-registrasi.php");	
	exit();
}

# Eksekusi ini saat tombol konfirmasi ditekan
if($_POST['konfirmasi']) {

	# Pastikan REQUEST yang diterima adalah 'POST'
	if($_SERVER['REQUEST_METHOD'] == 'POST') {

		# Validasi semua Inputan. Jangan biarkan ada inputan kosong / belum diisi
		(empty($_POST["nama"])) ? $namaError = "Nama Anda belum diisi" : $nama = tesInputan($_POST["nama"]);
		(empty($_POST["email"])) ? $emailError = "Email belum diisi" : $email = tesInputan($_POST["email"]);
		(empty($_POST["telp"])) ? $telpError = "Nomor Telepon belum diisi" : $telp = tesInputan($_POST["telp"]);
		(empty($_POST["id_pemesanan"])) ? $idError = "No Pemesanan belum diisi" : $id_pemesanan = tesInputan($_POST["id_pemesanan"]);
		(empty($_POST["ongkos"])) ? $ongkosError = "Total kirim belum diisi" : $ongkos = tesInputan($_POST["ongkos"]);
		(empty($_POST["bank_pemilik"])) ? $bank_pemilikError = "Bank Pengirim belum diisi" : $bank_pemilik = tesInputan($_POST["bank_pemilik"]);
		(empty($_POST["rek_pemilik"])) ? $rek_pemilikError = "Nama Pemilik Rekening belum diisi" : $rek_pemilik = tesInputan($_POST["rek_pemilik"]);
		(empty($_POST["catatan"])) ? $catatanError = "Tuliskan catatan apapun disini" : $catatan = tesInputan($_POST["catatan"]);
		(empty($_FILES['resi']['name'])) ? $resiError = "Pilih dulu resi." : $resi = tesInputan($_FILES['resi']['name']);

		# Inisialisasi Nilai dari Bank Tujuan
		$bank_tujuan = $_POST['bank_tujuan'];

		########## Logika Upload Resi ###############
		# Tetapkan lokasi file yang akan diupload
		define('UPLOAD_DIR', 'admin/upload/resi/');

		# Pastikan nama file yang diupload ada
		if(!empty($_FILES['resi']['name'])) {

			# Tetapkan jenis file yang boleh di upload
			$tipeFile = exif_imagetype($_FILES['resi']['tmp_name']);
			$izinkan = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG); 

			# Jika tidak memenuhi aturan / file yg diupload bukan .gif, .jpg atau .png
			if(!in_array($tipeFile, $izinkan)) {
				echo '<script>alert("Maaf, hanya diijinkan untuk meng-upload file gambar (.gif, .jpg, atau .png)")</script>';
			} else {
				# Ambil semua informasi foto yang diupload
				$resi = $_FILES['resi'];

				# ubah paksa nama file yg mengandung selain huruf, angka, ".", "_", dan "-" dengan regex
				$nama_resi = preg_replace("/[^A-Z0-9._-]/i", "_", $resi['name']);

				# Periksa Ekstensi file
				$cek = pathinfo($nama_resi);

				# Bila benar ekstensi sesuai perizinan
				if(isset($cek['extension'])) {

					# Simpan extensi resi kedalam variabel
					$ext = $cek['extension'];

					# Gunakan variabel untuk validasi ekstensi
					if ($ext !== 'jpg' && $ext !== 'gif' && $ext !== 'png')

						# Bila ekstensi yang masuk bukan ketiganya, umumkan .jpg
						$ext = "jpg";

					# Simpan nama file lengkap dengan ekstensi
					$nama_resi = $cek['filename'] . '.' . $ext;

				# Untuk file yang tidak memiliki ekstensi maka patenkan ekstensi .jpg
				} else { 
					$ext = 'jpg';

					# Lalu gunakan nama_foto ini
					$nama_resi = $cek['filename'] . '.jpg';
				}
				
				# Terakhir, salin file yang diupload kelokasi upload yang ditentukan dgn nama foto yang juga ditentukan
				move_uploaded_file($resi['tmp_name'], UPLOAD_DIR . $nama_resi);
			}

		}

		########## Akhir Logika Upload Resi ###############
		# Bila semua validasi terpenuhi
		if($nama&&$email&&$telp&&$id_pemesanan&&$ongkos&&$bank_pemilik&&$rek_pemilik&&$catatan&&$resi) {

			# Masukkan kedalam database
			$sql = "INSERT INTO konfirmasi VALUES ('', '$nama', '$email', '$telp', '$id_pemesanan', '$ongkos', 
						'$bank_tujuan', '$bank_pemilik', '$rek_pemilik', '$catatan', '$nama_resi', NOW())";
			
			$masukin = mysql_query($sql);

			# Buat pesan sukses untuk ditempilkan dihalaman
			$pesan = '
				<div class="alert alert-success alert-dismissable">
					<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					Terima kasih, konfirmasi pembayaran Anda akan segera kami proses.
				</div>
				';

			# Normalkan semua variabel menjadi kosong / null
			$namaError=$emailError=$telpError=$idError=$ongkosError=$bank_pemilikError=$rek_pemilikError=$catatanError=$resiError='';
			$nama=$email=$telp=$id_pemesanan=$ongkos=$bank_pemilik=$rek_pemilik=$catatan=$resi='';
		}
	}

}

# Tampilan
include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<h1 class="text-center">Konfirmasi Pembayaran</h1>
<div class="contact-info" style="font-weight:normal">
	<?php
		if(isset($pesan)) {
			echo $pesan;
			echo "<br/>";
		$sql = mysql_fetch_object(mysql_query("SELECT * FROM konfirmasi ORDER BY id DESC LIMIT 1"));
	?>
		<iframe src="cetak-konfirmasi.php?id=<?=$sql->id?>" name="cetak" style="display:none;"></iframe>
		<a href="#" class="btn btn-info text-center" onclick="frames['cetak'].print()" style="color: #fff;">
			<i class="fa fa-print"></i> Cetak Bukti Konfirmasi
		</a>
		<br/><br/><br/>
	<?php } else { ?>
	<p>Silahkan melakukan konfirmasi pembayaran dengan mengisi secara lengkap form berikut:</p>
	<hr/>

	<script type="text/javascript"></script>
	<form class="form-horizontal" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
		<div class="form-group <?=($namaError)?'has-error':''?>">
			<label for="nama" class="col-sm-4 control-label">Nama Pemesan</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="nama" name="nama" value="<?=$nama?>">
				<span class="help-block small text-center merah"><?=$namaError?></span>
			</div>	
		</div>
		<div class="form-group <?=($emailError)?'has-error':''?>">
			<label for="email" class="col-sm-4 control-label">Email</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="email" name="email" value="<?=$email?>">
				<span class="help-block small text-center merah"><?=$emailError?></span>
			</div>	
		</div>
		<div class="form-group <?=($telpError)?'has-error':''?>">
			<label for="telp" class="col-sm-4 control-label">Telepon / HP</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="telp" name="telp" value="<?=$telp?>">
				<span class="help-block small text-center merah"><?=$telpError?></span>
			</div>	
		</div>
		<div class="form-group <?=($idError)?'has-error':''?>">
			<label for="id_pemesanan" class="col-sm-4 control-label">No. Pemesanan</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" id="id_pemesanan" name="id_pemesanan" value="<?=$id_pemesanan?>">
				<span class="help-block small text-center merah"><?=$idError?></span>
			</div>
		</div>
		<div class="form-group <?=($ongkosError)?'has-error':''?>">
			<label for="ongkos" class="col-sm-4 control-label">Total Kirim (Rp.)</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="ongkos" name="ongkos" value="<?=$ongkos?>">
				<span class="help-block small text-center merah"><?=$ongkosError?></span>
			</div>
		</div>
		<div class="form-group">
			<label for="bank_tujuan" class="col-sm-4 control-label">Bank Tujuan</label>
			<div class="col-sm-8">
				<select class="form-control" name="bank_tujuan" style="margin-bottom: 10px;">
					<option value="1">BRI - <?=$informasi->rek1?></option>
					<option value="0">Mandiri - <?=$informasi->rek2?></option>
				</select>
			</div>
		</div>
		<div class="form-group <?=($bank_pemilikError)?'has-error':''?>">
			<label for="bank_pemilik" class="col-sm-4 control-label">Bank Pengirim</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="bank_pemilik" name="bank_pemilik" value="<?=$bank_pemilik?>">
				<span class="help-block small text-center merah"><?=$bank_pemilikError?></span>
			</div>
		</div>
		<div class="form-group <?=($rek_pemilikError)?'has-error':''?>">
			<label for="rek_pemilik" class="col-sm-4 control-label">Nama Pemilik Rekening</label>
			<div class="col-sm-8">
				<input type="text" class="form-control" id="rek_pemilik" name="rek_pemilik" value="<?=$rek_pemilik?>">
				<span class="help-block small text-center merah"><?=$rek_pemilikError?></span>
			</div>
		</div>
		<div class="form-group <?=($catatanError)?'has-error':''?>">
			<label for="catatan" class="col-sm-4 control-label">Catatan</label>
			<div class="col-sm-8">
				<textarea class="form-control" id="catatan" name="catatan"><?=$catatan?></textarea>
				<span class="help-block small text-center merah"><?=$catatanError?></span>
			</div>
		</div>
		<div class="form-group <?=($resiError)?'has-error':''?>">
			<label for="resi" class="col-sm-4 control-label">Upload Resi</label>
			<div class="col-sm-8">
				<input type="file" name="resi" >
				<span class="help-block small merah"><?=$resiError?></span>
			</div>
		</div>
		<hr/>
		<div class="form-group">
			<div class="col-sm-offset-4 col-sm-8">
				<input type="submit" class="btn btn-success" name="konfirmasi" value="Konfirmasi Pembayaran" />	
			</div>
		</div>
	</form>
	<?php } ?>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>