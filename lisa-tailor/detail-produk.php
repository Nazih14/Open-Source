<?php 
require_once "pengaturan/database.php"; 

$pakaian = $_GET['id'];
$set = mysql_fetch_object(mysql_query("SELECT * FROM pakaian WHERE id = '$pakaian' LIMIT 1"));

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<div class="product-info">
	<div class="row">
		<div class="col-sm-4">
			<div id="default_gallery" class="left spacing">
				<div class="image"> 
					<div style="height:auto;width:auto;" class="zoomWrapper"><img style="position: absolute;" id="zoom_01" data-zoom-image="admin/upload/<?=$set->foto?>" src="admin/upload/<?=$set->foto?>" title="<?=$set->nama?>" alt="<?=$set->nama?>"></div>
				</div>

			</div>
		</div>
		<div class="col-sm-8">
			<h1><?=$set->nama?></h1>
			<div class="description">
				<div class="price">
					<span class="text-price">Ongkos:</span>
					<span class="price-new" style="text-transform: none;padding-left: 10px;"><?=rupiah($set->ongkos)?></span>
				</div>
				<div class="cart">
					<div class="prod-row">
						<div class="cart-top">
							<div class="cart-top-padd form-inline">
								<a href="pemesanan.php?produk=<?=$set->id?>" class="button-prod"><i class="fa fa-shopping-cart"></i>Pesan Sekarang</a>
							</div>
							<div class="clear"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="tabs">
		<div class="tab-heading">
			Informasi		
		</div>
		<div class="tab-content" style="padding: 0px 0px;">
			<div class="contact-info" style="font-weight: normal;">
				<?=$set->informasi?>
			</div>
		</div>
	</div>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>