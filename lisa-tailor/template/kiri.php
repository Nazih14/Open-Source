<style type="text/css">
<!--
.style1 {color: #000000}
-->
</style>
							<aside class="col-sm-3" id="column-left" style="width:24%">
								<div class="box category info">
									<div class="box-heading style1" style="background-color:pink">Jenis Pakaian</div>
									<div class="box-content">
										<div class="box-category">
											<ul>
												<li class="cat-header parent">
													<a href="#">Pria</a>
													<ul>
														<li class=" parent">
															<a  href="daftar-jenis.php?jenis=1&tipe=1">Atasan</a>
															<ul>
																<?php
																$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 1 AND tipe = 1 ORDER BY nama ASC");
																while(list($id, $nama_jenis) = mysql_fetch_row($pilihan)){
																	echo '<li><a href="daftar-produk.php?jenis='.$id.'">' .$nama_jenis. '</a></li>';
																}
																?>
															</ul>
														</li>
														<li class=" parent">
															<a  href="daftar-jenis.php?jenis=1&tipe=2">Bawahan</a>
															<ul>
																<?php
																$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 1 AND tipe = 2 ORDER BY nama ASC");
																while(list($id, $nama_jenis) = mysql_fetch_row($pilihan)){
																	echo '<li><a href="daftar-produk.php?jenis='.$id.'">' .$nama_jenis. '</a></li>';
																}
																?>
															</ul>
														</li>
													</ul>
												</li>
												<li class="cat-header parent">
													<a href="#">Wanita</a>
													<ul>
														<li class=" parent">
															<a  href="daftar-jenis.php?jenis=2&tipe=1">Atasan</a>
															<ul>
																<?php
																$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 2 AND tipe = 1 ORDER BY nama ASC");
																while(list($id, $nama_jenis) = mysql_fetch_row($pilihan)){
																	echo '<li><a href="daftar-produk.php?jenis='.$id.'">' .$nama_jenis. '</a></li>';
																}
																?>
															</ul>
														</li>
														<li class=" parent">
															<a  href="daftar-jenis.php?jenis=2&tipe=2">Bawahan</a>
															<ul>
																<?php
																$pilihan = mysql_query("SELECT id, nama FROM kategori WHERE jenis = 2 AND tipe = 2 ORDER BY nama ASC");
																while(list($id, $nama_jenis) = mysql_fetch_row($pilihan)){
																	echo '<li><a href="daftar-produk.php?jenis='.$id.'">' .$nama_jenis. '</a></li>';
																}
																?>
															</ul>
														</li>
													</ul>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<script type="text/javascript">
									if ($('body').width() > 767) {
										(function($){
											$.fn.equalHeights=function(minHeight,maxHeight){
												tallest=(minHeight)?minHeight:0;this.each(function(){
													if($(this).height()>tallest){
														tallest=$(this).height()
													}
												});
												if((maxHeight)&&tallest>maxHeight)tallest=maxHeight;
												return this.each(function(){
													$(this).height(tallest)
												})
											}
										})(jQuery)
										$(window).load(function(){
											if($(".maxheight-spec").length){
												$(".maxheight-spec").equalHeights()
											}
										});
									};
								</script>
								<div id="banner0" class="banner">
									<div>
										<a href="#"><img src="assets/image/banner-1-270x129.jpg" alt="banner-1" title="banner-1" />
											<div class="s-desc">
												<h3><?=current(explode(' ', $informasi->pemilik));?></h3>
												<h4><?=$informasi->telp?></h4>
											</div>
										</a>
									</div>
								</div>
								<div id="banner1" class="banner">
									<div>
										<a href="profil.php"><img src="assets/image/mesin.jpg" alt="banner-2" title="banner-2" />
											<div class="s-desc" style="margin-top:25px">
												<h2 style="color:#000;text-shadow:3px 2px 0px rgba(0,0,0,0.2)">Lihat Profil Kami</h2>
												<span style="color:#000;border:2px solid #000">DISINI!</span>
											</div>
										</a>
									</div>
								</div>
								<div id="banner1" class="banner">
									<div>
										<a href="testimonial.php"><img src="assets/image/banner-2-270x238.jpg" alt="banner-2" title="banner-2" />
											<div class="s-desc">
												<h1>Ragu?</h1>
												<h2>Baca Deh Testimonial Kami</h2>
												<span>DISINI!</span>
											</div>
										</a>
									</div>
								</div>
							</aside>