<?php
require_once "pengaturan/database.php";

# Bila Anda belum terdaftar
if(!isset($_SESSION['member'])) {
	# Alihkan kehalaman "login-registrasi.php"
	header("Location: login-registrasi.php");	
	exit();
}

if(isset($_GET['produk'])) {
	$id = $_GET['produk'];
	$jenis = mysql_fetch_object(mysql_query("SELECT * FROM pakaian WHERE id = '$id'"));
}

if($_POST['pesan']) {
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		(empty($_POST['tgl_digunakan'])) ? $tgl_digunakanError = "Kapan pakaian akan digunakan?" : $tgl_digunakan = $_POST['tgl_digunakan'];
		(empty($_POST['jenis_pakaian'])) ? $jenis_pakaianError = "Jenis pakaian yang diinginkan?" : $jenis_pakaian = tesInputan($_POST['jenis_pakaian']);
		(empty($_POST['ukuran'])) ? $ukuranError = "Nentuin ukurannya gimana?" : $ukuran = tesInputan($_POST['ukuran']);
		(empty($_POST['jumlah'])) ? $jumlahError = "Berapa lembar yang diinginkan?" : $jumlah = tesInputan($_POST['jumlah']);
		(empty($_POST['jenis_kain'])) ? $jenis_kainError = "Jenis kainnya apaan?" : $jenis_kain = tesInputan($_POST['jenis_kain']);
		if($tgl_digunakan&&$jenis_pakaian&&$ukuran&&$jumlah&&$jenis_kain) {
			# Inisialisasi inputan
			$id = $_POST['id'];
			$puring = $_POST['puring'];
			$status = 0;

			# Ambil Informasi member yang login berdasarkan email
			$set = $_SESSION['member'];
			$member = mysql_fetch_object(mysql_query("SELECT * FROM member WHERE email = '$set' LIMIT 1"));
			$id_member = $member->id;

			if(isset($_GET['produk'])) {
				$id = $_GET['produk'];
				$jenis = mysql_fetch_object(mysql_query("SELECT * FROM pakaian WHERE id = '$id'"));
				$model = $jenis->model;
			} else {
				if((isset($_FILES['model']['name'])?$_FILES['model']['name']:'') != ""){
					//buat folder baru jika belum ada
					if(!file_exists("admin/upload")){
						mkdir("admin/upload");
						chmod("admin/upload", 0777);
					}
					//Uploading foto...
					$asal 	= $_FILES['model']['tmp_name'];
					$tujuan = "admin/upload/";
					$model = uniqid("acak").$_FILES['model']['name'];
					move_uploaded_file($asal, $tujuan.$model);
				}elseif(isset($_POST['ada'])) {
					$model = $_POST['ada'];
				} else {
					$model = "";
				}
			}

			

			# Masukkan kedalam database
			$sql = "INSERT INTO pemesanan VALUES ('$id', NOW(), '$tgl_digunakan', '$jenis_pakaian', '$ukuran', 
						'$model', '$puring', '$jumlah', '$jenis_kain', '', '$status', '$id_member')";
			$masukin = mysql_query($sql);

			header("Location: pemesanan-selesai.php");
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

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
	<h1 class="text-center">Pemesanan</h1>
	<div class="contact-info" style="font-weight:normal;padding: 20px;">
		<div class="pull-right" style="padding-right:5px"><strong>Tanggal : <?=date("d M Y")?></strong></div>
		<br/>
		<br/>
		<table class="table">
			<tbody>
				<tr>
					<td>1.</td>
					<td>No. Pemesanan</td>
					<td>:</td>
					<td>
					<?php $id_terakhir = mysql_fetch_object(mysql_query("SELECT id FROM pemesanan ORDER BY id DESC LIMIT 1")); ?>
						<input type="text" name="id" disabled="disabled" width="10px" value="<?=$id_terakhir->id+1?>">
					</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>Tanggal Digunakan</td>
					<td>:</td>
					<td>
						<input type="text" id="tgl_digunakan" name="tgl_digunakan" placeholder="Tentukan Tanggal">
						<span class="help-block small merah"><?=$tgl_digunakanError?></span>
						<script type="text/javascript">
							$(function() { $( "#tgl_digunakan" ).datepicker({ dateFormat: 'yy-m-d' }).val(); });
						</script>

					</td>
				</tr>
				<tr>
					<td>3.</td>
					<td>Jenis Pakaian</td>
					<td>:</td>
					<td>
						<select name="jenis_pakaian">
							<option value="0">-- Pilih Salah Satu --</option>
							<optgroup label="Pria">
								<?php
								$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 1 ORDER BY nama ASC");
								while(list($id, $nama) = mysql_fetch_row($pilihan)){
									echo "<option value='$id' ";
										if($jenis->id_jenis==$id) {
											echo 'selected';
										} else {
											echo '';
										}
									echo ">$nama</option>";
								}
								?>
							</optgroup>
							<optgroup label="Wanita">
								<?php
								$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 2 ORDER BY nama ASC");
								while(list($id, $nama) = mysql_fetch_row($pilihan)){
									echo "<option value='$id' ";
										if($jenis->id_jenis==$id) {
											echo 'selected';
										} else {
											echo '';
										}
									echo ">$nama</option>";
								}
								?>
							</optgroup>
						</select>
						<span class="help-block small merah"><?=$jenis_pakaianError?></span>
					</td>
				</tr>
				<tr>
					<td>4.</td>
					<td>Pengukuran Badan</td>
					<td>:</td>
					<td>
						<p style="margin-bottom: -5px;">
							<input type="radio" name="ukuran" id="1" value="1" /> 
							<label for="1"><small>Datang langsung ke Lisa Tailor</small></label>
						</p>
						<p style="margin-bottom: -5px;">
							<input type="radio" name="ukuran" id="2" value="2" /> 
							<label for="2"><small>Mengirim contoh pakaian (untuk pemesanan diluar Samarinda)</small></label>
						</p>
						<span class="help-block small merah"><?=$ukuranError?></span>
					</td>
				</tr>
				<tr>
					<td>5.</td>
					<td>Model Pakaian</td>
					<td>:</td>
					<td>
						<?php
							if(isset($_GET['produk'])) {
								echo '<img src="admin/upload/'.$jenis->foto.'" style="width:200px">';
								echo '<input type="hidden" name="ada" value="'.$jenis->foto.'">';
							} else {
								echo '<input type="file" name="model" class="img-responsive" />';
							}
						?>
					</td>
				</tr>
				<tr>
					<td>6.</td>
					<td>Menggunakan Puring?</td>
					<td>:</td>
					<td>
						<select name="puring">
							<option value="1">Ya</option>
							<option value="0">Tidak</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>7.</td>
					<td>Jumlah Pakaian</td>
					<td>:</td>
					<td>
						<input type="text" name="jumlah">
						<span class="help-block small merah"><?=$jumlahError?></span>
					</td>
				</tr>
				<tr>
					<td>8.</td>
					<td>Jenis Kain</td>
					<td>:</td>
					<td>
						<select name="jenis_kain">
							<option value="0">-- Pilih Kategori --</option>
							<?php
								$pilihan = mysql_query("SELECT id, jenis FROM kain ORDER BY jenis ASC");
								while(list($id, $jenis) = mysql_fetch_row($pilihan)){
									echo "<option value='$id'>$jenis</option>";
								}
							?>
						</select>
						<span class="help-block small merah"><?=$jenis_kainError?></span>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td>
						<input type="submit" value="Simpan" class="btn btn-info" name="pesan" />
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</form>

<?php
include "template/kanan.php";
include "template/footer.php";
?>