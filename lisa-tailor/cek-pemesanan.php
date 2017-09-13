<?php
require_once "pengaturan/database.php";

# Bila Anda belum terdaftar
if(!isset($_SESSION['member'])) {
	# Alihkan kehalaman "login-registrasi.php"
	header("Location: login-registrasi.php");	
	exit();
}

if(isset($_GET['pesan'])) {
	$id = $_GET['pesan'];
	$pesan = mysql_fetch_object(mysql_query("SELECT * FROM pemesanan WHERE id = '$id'"));
}

# Tampilan
include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" enctype="multipart/form-data">
	<h1 class="text-center">Cek Pemesanan</h1>
	<div class="contact-info" style="font-weight:normal;padding: 20px;">
		<div class="pull-right" style="padding-right:5px"><strong>Tanggal : <?=date("d M Y", strtotime($pesan->tgl_masuk))?></strong></div>
		<br/>
		<br/>
		<table class="table">
			<tbody>
				<tr>
					<td>1.</td>
					<td>No. Pemesanan</td>
					<td>:</td>
					<td>
						<input type="text" name="id" disabled="disabled" width="10px" value="<?=$pesan->id?>">
					</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>Tanggal Digunakan</td>
					<td>:</td>
					<td>
						<input type="text" id="tgl_digunakan" name="tgl_digunakan" placeholder="Tentukan Tanggal" value="<?=date("d M Y", strtotime($pesan->tgl_digunakan))?>">
						<span class="help-block small merah"><?=$tgl_digunakanError?></span>
						<script type="text/javascript">
							$(function() { $( "#tgl_digunakan" ).datepicker({ dateFormat: 'd MM yy' }).val(); });
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
									echo "<option value='$id'";
										if($pesan->jenis_pakaian==$id) {
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
										if($pesan->jenis_pakaian==$id) {
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
							<input type="radio" name="ukuran" id="1" value="1" <?=($pesan->pengukuran==1)?'checked':''?>/> 
							<label for="1"><small>Datang langsung ke Lisa Tailor</small></label>
						</p>
						<p style="margin-bottom: -5px;">
							<input type="radio" name="ukuran" id="2" value="2" <?=($pesan->pengukuran==2)?'checked':''?>/> 
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
							if(isset($_GET['pesan'])) {
								echo '<img src="admin/upload/'.$pesan->model.'" style="width:200px">';
							}
						?>
						<!-- <input type="file" name="model" class="img-responsive" /> -->
					</td>
				</tr>
				<tr>
					<td>6.</td>
					<td>Menggunakan Puring?</td>
					<td>:</td>
					<td>
						<select name="puring">
							<option value="1" <?=($pesan->puring==1)?'selected':''?>>Ya</option>
							<option value="0" <?=($pesan->puring==0)?'selected':''?>>Tidak</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>7.</td>
					<td>Jumlah Pakaian</td>
					<td>:</td>
					<td>
						<input type="text" name="jumlah" value="<?=$pesan->jumlah?>">
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
								?>
								<option value=<?=$id?> <?=($pesan->jenis_kain==$id) ? 'selected' : '';?>><?=$jenis?></option>
							<?php
								}
							?>
						</select>
						<span class="help-block small merah"><?=$jenis_kainError?></span>
					</td>
				</tr>

				<tr>
					<td>9.</td>
					<td>Ongkos</td>
					<td>:</td>
					<td>
						<strong>
							<?php
								if($pesan->status==0) {
									echo "Belum Ada Respon dari Admin";
								} elseif($pesan->status==1) {
									echo rupiah($pesan->ongkos);
								} else {
									echo "Maaf, pesanan Anda kami tolak untuk alasan tertentu.";
								}
							?>
						</strong>
					</td>
				</tr>
			</tbody>
		</table>
		
		<?php
			if($pesan->status==0) {
				echo "";
			} elseif($pesan->status==1) {
				echo "<p style='text-decoration:underline'>Keterangan</p><p>Pemesanan dapat dikerjakan.</p><p>Bagi pelanggan yang berada disamarinda silahkan datang langsung ke Toko Lisa Tailor dan membawa bukti pemesanan serta bahan kain untuk melakukan Pengukuran badan, dan jika pelanggan yang berada diluar samarinda silahkan kirim bahan kain beserta contoh pakaian dan Bukti pemesanan kealamat kami agar dapat segera diproses.</p>";
			} else {
				echo "<p style='text-decoration:underline'>Keterangan</p><p>Maaf, pemesanan yang anda inginkan tidak dapat kami proses.</p>";
			}
		?>
	</div>
	<input type="hidden" value="<?=$pesan->id?>" name="id" />

	<?php
		if(!empty($pesan->ongkos)) {
	?>
	<iframe src="cetak.php?pesan=<?=$pesan->id?>" name="cetak" style="display:none;"></iframe>
	<a href="#" class="btn btn-info pull-right" onclick="frames['cetak'].print()" style="color: #fff;">
		<i class="fa fa-print"></i> Cetak Bukti Pemesanan
	</a>
	<?php
	}
	?>
</form>

<?php
include "template/kanan.php";
include "template/footer.php";
?>