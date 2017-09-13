<?php
session_start();

# Sembunyikan Pesan Error
error_reporting(0);

// Konfigurasi Database
$host = "localhost";
$user = "root";
$pass = "";
$db = "tailor";

# Periksa koneksi ke MySQL
mysql_connect($host, $user, $pass) or die("Maaf, sistem gagal terkoneksi dengan MySQL. <br/>Periksa konfigurasi database di <code>\"pengaturan/database.php\"</code>");
# Periksa sekaligus menentukan nama database yang digunakan
mysql_select_db($db) or die("Maaf, database dengan nama <strong>\"".$db."\"</strong> tidak ditemukan.");

# Sertakan seluruh isi fungsi.php
require_once "fungsi.php";

# Untuk Pengaturan Aplikasi
$informasi = mysql_fetch_object(mysql_query("SELECT * FROM `informasi` LIMIT 1"));

# Untuk membuat log pengunjung saat ini
kunjungan();

?>