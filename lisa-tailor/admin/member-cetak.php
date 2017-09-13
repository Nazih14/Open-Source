<?php
require_once "../pengaturan/database.php";
if(!isset($_SESSION["admin"])) { header("Location: login.php"); exit(); }
$pelanggan = mysql_query("SELECT * FROM member");
include "template/head.php";
?>
<header id="kepala" style="padding-top:0px;margin-top:0px">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="toko">
					<p class="nama"><?=$informasi->nama?></p>
					<p class="alamat"><?=$informasi->alamat?></p>
				</div>
				<div class="logo">
					<p style="font-family:Lobster;font-size: 9em;color:#e74c3c">Lt<span style="color:grey;font-size: 30px;position: absolute;margin-top: 6px;">Smd</span></p>
				</div>
			</div>
		</div>
	</div>
</header>
<h1>Laporan Daftar Pelanggan</h1>
<hr/>
<table class="table">
	<thead>
		<tr>
			<th>No</th>
			<th>Nama</th>
			<th>Email</th>
			<th>Jenis Kelamin</th>
			<th>Kota</th>
			<th>Provinsi</th>
			<th>Tanggal Daftar</th>
		</tr>
	</thead>
	<tbody>
		<?php 
			$id = 1;
			while($temp = mysql_fetch_object($pelanggan)) { 
		?>
		<tr>
			<td><?=$id?></td>
			<td><?=$temp->nama?></td>
			<td><?=$temp->email?></td>
			<td><?=($temp->jenis_kelamin==0) ? 'Perempuan' : 'Laki-laki'?></td>
			<td><?=ucwords($temp->kota)?></td>
			<td><?=ucwords($temp->provinsi)?></td>
			<td><?=date("d M Y", strtotime($temp->tanggal_daftar))?></td>
		</tr>
		<?php $id++; } ?>
	</tbody>
</table>