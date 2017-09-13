<?php 
require_once "pengaturan/database.php"; 

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>
	
<h1 class="text-center"><i class="fa fa-user"></i> Profil</h1>
<div class="contact-info" style="font-weight:normal">
	<?=$informasi->profil?>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>