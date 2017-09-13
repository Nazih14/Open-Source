<?php 
require_once "pengaturan/database.php"; 

include "template/head.php";
include "template/header.php";
include "template/kiri.php";
include "template/nav.php";
?>

<h1 class="text-center"><i class="fa fa-question"></i> FAQ (Frequently Answer Question)</h1>	
<div class="contact-info" style="font-weight:normal">
	<?=$informasi->faq?>
</div>

<?php
include "template/kanan.php";
include "template/footer.php";
?>