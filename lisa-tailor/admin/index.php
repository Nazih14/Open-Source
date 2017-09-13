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

<div class="col-sm-9">	
	<div class="box featured">
		<div class="box-heading text-center">Selamat Datang ADMINISTRATOR</div>
	</div>
	<div class="contact-info" id="cetak-bro">
		<h1>Jenis Pakaian Yang Sering Dipesan</h1>
		<?php
			$query = mysql_query("	SELECT jenis_pakaian, COUNT(*) 
									FROM pemesanan 
									GROUP BY jenis_pakaian 
									ORDER BY COUNT(*) DESC
								");
		?>
			<table class="table">
				<thead>
					<tr>
						<th>No</th>
						<th>Jenis Pakaian</th>
						<th>Banyak Pemesanan</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$id= 1;
				while($temp = mysql_fetch_array($query)) {
				?>
					<tr>
						<td><?=$id?></td>
						<td>
						<?php
							list($jp) = mysql_fetch_row(mysql_query("SELECT nama FROM kategori WHERE id = '$temp[0]'"));
							echo $jp;
						?>
						</td>
						<td><?=$temp[1]?> Kali</td>
					</tr>
				<?php $id++; } ?>
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
			<i class="fa fa-print"></i> Cetak Jenis Pakaian Yang Sering Dipesan
		</a>
	</div>
</div>

<?php
include "template/footer.php";
?>