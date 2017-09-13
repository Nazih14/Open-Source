<?php
function tesInputan($data) {
	return $data = htmlspecialchars(stripslashes(trim($data)));
}

function kunjungan() {
     $ip = $_SERVER['REMOTE_ADDR']; // menangkap ip pengunjung
     $lokasi = $_SERVER['PHP_SELF']; // menangkap server path
     //membuat log dalam tabel database 'kunjungan'
     $create_log = mysql_query("INSERT INTO kunjungan(ip, lokasi)VALUES('$ip', '$lokasi') ");
}

function total($mode, $lokasi = NULL) {
	if(is_null($lokasi)) {
		$lokasi = $_SERVER['PHP_SELF'];
	}
	if($mode == "unique") {
		$get_res = mysql_query("SELECT DISTINCT ip FROM kunjungan WHERE lokasi = '$lokasi' ");
	} else {
		$get_res = mysql_query("SELECT ip FROM kunjungan WHERE lokasi = '$lokasi' ");
	}
	$res = mysql_num_rows($get_res);
	return $res;
}

function rupiah($string) {
	return 'Rp. '. number_format($string, 0, '', '.') . ',-'; 
}

?>