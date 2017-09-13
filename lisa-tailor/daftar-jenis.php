<?php 
require_once "pengaturan/database.php"; 

$jenis = $_GET['jenis'];
$tipe = $_GET['tipe'];

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

	<div class="box featured">
		<div class="box-heading text-center">JENIS PAKAIAN <?=($tipe==1)?'Atasan':'Bawahan'?> <?=($jenis==1)?'Pria':'Wanita'?></div>
	</div>

	<div class="contact-info" style="font-weight:normal;">
		<div class="row">
			<div class="com-sm-12">
			<?php
			$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = $jenis AND tipe = $tipe ORDER BY nama ASC");
			while(list($id, $nama_jenis) = mysql_fetch_row($pilihan)){
				echo '
						<div class="col-sm-4 text-center">
							<h1><a href="daftar-produk.php?jenis='.$id.'"><i class="fa fa-arrow-right"></i> ' .$nama_jenis. '</a></h1>
						</div>';
			}
			?>
			</div>
		</div>
	</div>
	

<?php
include "template/kanan.php";
include "template/footer.php";

?>