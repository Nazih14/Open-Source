<?php 
require_once "pengaturan/database.php"; 

$jenis = $_GET['jenis'];

$hasil = mysql_fetch_object(mysql_query("SELECT nama FROM kategori WHERE id = '$jenis'"));

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";

?>

	<div class="box featured">
		<div class="box-heading text-center">JENIS PAKAIAN <?=$hasil->nama?></div>
	</div>

	<div class="contact-info" style="font-weight:normal;">
		<div class="row">
			<div class="com-sm-12">

			<?php
			$pilihan = mysql_query("SELECT id, nama, foto FROM pakaian WHERE id_jenis = $jenis ORDER BY nama ASC");
			if(mysql_num_rows($pilihan)==0) {
				echo '<center>Maaf, Belum ada produk untuk Jenis Pakaian ini.</center>';
			} else {
				while(list($id, $nama_jenis, $foto) = mysql_fetch_row($pilihan)){
					echo '
						<div class="col-sm-4">
							<div class="panel panel-default">
								<div class="panel-body">
									<p class="text-center" style="margin-bottom: 0px;"><strong>'.$nama_jenis.'</strong></p>
									<img src="admin/upload/'.$foto.'" class="img-responsive">
									<div class="cart text-center" style="padding-bottom:5px">
										<a href="pemesanan.php?produk='.$id.'" class="button addToCart">
											<i class="fa fa-shopping-cart"></i>
											<span>Pesan</span>
										</a>	
									</div>
									<div class="cart text-center">
										<a href="detail-produk.php?id='.$id.'" class="button addToCart" style="background: #ea695b;">
											<i class="fa fa-file-text-o"></i>
											<span>Informasi</span>
										</a>
									</div>
								</div>
							</div>
						</div>';
				}
			}
			?>
				
			</div>
		</div>
	</div>
	

<?php
include "template/kanan.php";
include "template/footer.php";

?>