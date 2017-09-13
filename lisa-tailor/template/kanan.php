							</div>
							<!-- // Kolom Kanan //-->
							<aside class="col-sm-3" id="column-left" style="width:24%">


							<?php if(isset($_SESSION['member'])) { ?>
								
								<!-- // Statistik Pengunjung //-->
								<div class="box account info">
									<div class="box-heading" style="background-color:pink">Informasi Profil</div>
									<div class="box-content">
										<ul class="acount">
											<li><a href="data-diri.php">Lihat Data Diri</a></li>
											<li><a href="riwayat-pemesanan.php">Riwayat Pemesanan</a></li>
											<li><a href="pemesanan.php">Proses Pemesanan Pakaian</a></li>
											<li><a href="konfirmasi-pembayaran.php">Konfirmasi Pembayaran</a></li>
											<li><a href="logout.php">Logout</a></li>
										</ul>
										</div>
									</div> <!-- // Akhir Statistik Pengunjung //-->

									<!-- // Chat via YM! //-->
									<div class="box specials">
										<div class="box-heading special-heading" style="background-color:pink">Chat via YM!</div>
										<div class="box-content">
											<center>
												<a href="ymsgr:sendIM?<?=$informasi->ym?>"> <img src="http://opi.yahoo.com/online?u=<?=$informasi->ym?>&m=g&t=14" border="0" />
													<br/>
													<br/>
													<p>Customer Service : <?=$informasi->ym?></p>
												</a>
											</center>
											<div class="clear"></div>
										</div>
									</div> <!-- // Akhir Chat via YM! //-->

									<!-- // Rekening Pembayaran //-->
									<div class="box specials">
										<div class="box-heading special-heading" style="background-color:pink">Rekening Pembayaran</div>
										<div class="box-content">
											<table style="width:300px">
												<tr>
													<td style="width: 80px;"><img src="assets/image/bri.png" style="width: 70px;"></td>
													<td>
									<p style="margin-top: 0px;margin-bottom: 0px;padding-top: 15px;"><?=$informasi->pemilik?></p><p><?=$informasi->rek1?></p>
													</td>
												</tr>
												<tr>
													<td><img src="assets/image/mandiri.png" style="width: 70px;"></td>
													<td>
									<p style="margin-top: 0px;margin-bottom: 0px;padding-top: 15px;"><?=$informasi->pemilik?></p><p><?=$informasi->rek2?></p>
													</td>
												</tr>
											</table>
											<div class="clear"></div>
										</div>
									</div> <!-- // Akhir Rekening Pembayaran //-->



							<?php } else { ?>

								<!-- // Statistik Pengunjung //-->
								<div class="box category info">
									<div class="box-heading" style="background-color:pink">Statistik Pengunjung</div>
									<div class="box-content">
										<p class="pengunjung">Pengunjung : <span><?=total('unique')?></span></p>
										<p class="halaman">Hits Per Halaman : <span><?=total('hits')?></span></p>
									</div>
								</div> <!-- // Akhir Statistik Pengunjung //-->

								<!-- // Chat via YM! //-->
								<div class="box specials">
									<div class="box-heading special-heading" style="background-color:pink">Chat via YM!</div>
									<div class="box-content">
										<center>
											<a href="ymsgr:sendIM?<?=$informasi->ym?>"> <img src="http://opi.yahoo.com/online?u=<?=$informasi->ym?>&m=g&t=14" border="0" />
												<br/>
												<br/>
												<p>Customer Service : <?=$informasi->ym?></p>
											</a>
										</center>
										<div class="clear"></div>
									</div>
								</div> <!-- // Akhir Chat via YM! //-->
								
								<!-- // Gambar Acak //-->
								<div class="box category info">
									<div class="box-heading" style="background-color:pink">Gambar</div>
									<div class="box-content">
										<center>
											<div id="slideshow">
												<div><img src="assets/image/baju1.jpg" style="max-width:80%"></div>
												<div><img src="assets/image/baju2.jpg" style="max-width:80%"></div>
												<div><img src="assets/image/baju3.jpg" style="max-width:80%"></div>
											</div>
										</center>
									</div>
								</div> <!-- // Akhir Gambar Acak //-->

								<!-- // Rekening Pembayaran //-->
								<div class="box specials">
									<div class="box-heading special-heading" style="background-color:pink">Rekening Pembayaran</div>
									<div class="box-content">
										<table style="width:300px">
											<tr>
												<td style="width: 80px;"><img src="assets/image/bri.png" style="width: 70px;"></td>
												<td>
								<p style="margin-top: 0px;margin-bottom: 0px;padding-top: 15px;"><?=$informasi->pemilik?></p><p><?=$informasi->rek1?></p>
												</td>
											</tr>
											<tr>
												<td><img src="assets/image/mandiri.png" style="width: 70px;"></td>
												<td>
								<p style="margin-top: 0px;margin-bottom: 0px;padding-top: 15px;"><?=$informasi->pemilik?></p><p><?=$informasi->rek2?></p>
												</td>
											</tr>
										</table>
										<div class="clear"></div>
									</div>
								</div> <!-- // Akhir Rekening Pembayaran //-->

							<?php } ?>								

							</aside> <!-- // Akhir Kolom Kanan //-->

						</div>
						<div class="clear"></div>
					</div>
				</div>
			</section>