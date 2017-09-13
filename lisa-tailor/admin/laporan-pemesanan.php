<?php 
require_once "../pengaturan/database.php"; 

# Bila admin belum login dan mengakses halaman ini
if(!isset($_SESSION["admin"])) {
	# Alihkan ke halaman login
	header("Location: login.php");
	exit();
}

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
?>

<style type="text/css">
	select {
		width: auto;
	}
</style>

<div class="col-sm-9">	
	<div class="breadcrumb">
		<a href="index.php">Beranda</a>
		» <a href="#">Toko</a>
		» <a href="#" class="last">Laporan Pemesanan</a>
	</div>
	<form id="form1" name="form1" method="post" action="?proses=cetak">
	Filter Laporan : 
		<select name="tgl1" id="tgl1">
		<?php for ($i = 1; $i <= 31; $i++) {
			echo "<option value='".sprintf("%02s", $i)."'>".sprintf("%02s", $i)."</option>";
		} ?>
		</select>
		<select name="bln1" id="bln1">
			<option	value="01">Januari</option>
			<option	value="02">Februari</option>
			<option	value="03">Maret</option>
			<option	value="04">April</option>
			<option	value="05">Mei</option>
			<option	value="06">Juni</option>
			<option	value="07">Juli</option>
			<option	value="08">Agustus</option>
			<option	value="09">September</option>
			<option	value="10">Oktober</option>
			<option	value="11">Nopember</option>
			<option	value="12">Desember</option>
		</select>
		<select name="thn1" id="thn1">
			<?php for($i=2014; $i<=date("Y"); $i++) { 
				echo "<option>$i</option>";
			} ?>
		</select>
		S.d 
		<select name="tgl2" id="tgl2">
			<?php for ($i = 1; $i <= 31; $i++) {
				echo "<option value='".sprintf("%02s", $i)."'>".sprintf("%02s", $i)."</option>";
			} ?>
		</select>
		<select name="bln2" id="select2">
			<option	value="01">Januari</option>
			<option	value="02">Februari</option>
			<option	value="03">Maret</option>
			<option	value="04">April</option>
			<option	value="05">Mei</option>
			<option	value="06">Juni</option>
			<option	value="07">Juli</option>
			<option	value="08">Agustus</option>
			<option	value="09">September</option>
			<option	value="10">Oktober</option>
			<option	value="11">Nopember</option>
			<option	value="12">Desember</option>
		</select>
		<select name="thn2" id="select3">
			<?php for($i=2014; $i<=date("Y"); $i++) { 
				echo "<option>$i</option>";
			} ?>
		</select>
		<input type="submit" name="Submit" value="Tampilkan" class="btn btn-success" />
	</form>

	<br/>

	<?php
		$proses = $_GET['proses'];
		$tgl1 = $_POST['tgl1'];
		$bln1 = $_POST['bln1'];
		$thn1 = $_POST['thn1'];
		$tgl2 = $_POST['tgl2'];
		$bln2 = $_POST['bln2'];
		$thn2 = $_POST['thn2'];
		
		if($proses=='cetak') {
	?>

		<?php
			$sql = mysql_query("SELECT pemesanan.*, member.id, member.nama, member.telp1 
								FROM pemesanan, member 
								WHERE  pemesanan.id_member = member.id
								AND tgl_masuk >= '{$thn1}-{$bln1}-{$tgl1}' AND tgl_masuk <= '{$thn2}-{$bln2}-{$tgl2}'");
			if(mysql_num_rows($sql)==0) {
		?>
			<div class='well text-center'>Maaf Data Yang anda cari tidak ada</div>
		<?php
			} else {
		?>
		<div class="table-responsive contact-info" id="cetak-bro">
			<h1>Laporan Pemesanan</h1>
			<table class="table" border="1">
				<thead>
					<tr>
						<th>No. Order</th>
						<th>Nama Pemesan</th>
						<th>Nomor Telepon</th>
						<th>Tanggal Masuk</th>
						<th>Tanggal Digunakan</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php
						while($temp = mysql_fetch_array($sql)) {
					?>
					<tr>
						<td><?=$temp['id']?></td>
						<td><?=$temp['nama']?></td>
						<td><?=$temp['telp1']?></td>
						<td><?=date("d M Y", strtotime($temp['tgl_masuk']))?></td>
						<td><?=date("d M Y", strtotime($temp['tgl_digunakan']))?></td>
						<td>
						<?php
							if($temp['status']==0) {
								echo "Menunggu";
							} elseif($temp['status']==1) {
								echo "Disetujui";
							} else {
								echo "Ditolak";
							}
						?>
						</td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="well">
			<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
			<script type="text/javascript">
			function printDiv(kepala, elementId) {
				var a = "../assets/css/bootstrap.css";
				var a1 = "../assets/css/stylesheet.css";
				var a2 = "../assets/css/lisa.css";
				var a3 = "../assets/css/lobster.css";
				var b = document.getElementById(kepala).innerHTML;
				var c = document.getElementById(elementId).innerHTML;
				window.frames["print_frame"].document.title = document.title;
				window.frames["print_frame"].document.body.innerHTML = '<link rel="stylesheet" href="' + a + '">' + '<link rel="stylesheet" href="' + a1 + '">' + '<link rel="stylesheet" href="' + a2 + '">' + '<link rel="stylesheet" href="' + a3 + '">' + b + c;
				window.frames["print_frame"].window.focus();
				window.frames["print_frame"].window.print();
			}
			</script>
			<a href="javascript:printDiv('kepala', 'cetak-bro');" class="btn btn-info no-print" style="color: #fff;">
				<i class="fa fa-print"></i> Cetak Laporan Pemesanan
			</a>
		</div>
	<?php
		}
	}
	?>
</div>

<?php
include "template/footer.php";
?>