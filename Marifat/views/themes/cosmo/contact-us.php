<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="col-xs-12 col-md-9">
	<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><i class="fa fa-phone"></i> <?=strtoupper($page_title)?></h3>
		</div>
		<div id="map"></div>
		<style>
			#map {
				width: 100%;
				height: 400px;
				background-color: grey;
				margin-bottom: 15px;
			}
		</style>
		<script>
			var latitude = <?=$latitude?>;
			var longitude = <?=$longitude?>;
			function initMap() {
				var coordinate = {lat: latitude, lng: longitude};
				var map = new google.maps.Map(document.getElementById('map'), {
					zoom: 15,
					center: coordinate
				});
				var marker = new google.maps.Marker({
					position: coordinate,
					map: map
				});
			}
		</script>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?=$api_key?>&callback=initMap"></script>
		<div class="panel-body">
			<form class="form-horizontal">
				<div class="form-group">
					<label for="comment_author" class="col-sm-3 control-label">Nama Lengkap <span style="color: red">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control input-sm" id="comment_author" name="comment_author">
					</div>
				</div>
				<div class="form-group">
					<label for="comment_email" class="col-sm-3 control-label">Email <span style="color: red">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control input-sm" id="comment_email" name="comment_email">
					</div>
				</div>
				<div class="form-group">
					<label for="comment_url" class="col-sm-3 control-label">URL</label>
					<div class="col-sm-9">
						<input type="text" class="form-control input-sm" id="comment_url" name="comment_url">
					</div>
				</div>
				<div class="form-group">
					<label for="comment_content" class="col-sm-3 control-label">Pesan <span style="color: red">*</span></label>
					<div class="col-sm-9">
						<textarea rows="5" class="form-control input-sm" id="comment_content" name="comment_content"></textarea>
					</div>
				</div>
				<div class="form-group">
					<label for="captcha" class="col-sm-3 control-label">Kode Keamanan <span style="color: red">*</span></label>
					<div class="col-sm-9">
						<?=$captcha['image'];?>
					</div>
				</div>
				<div class="form-group">
					<label for="captcha" class="col-sm-3 control-label"></label>
					<div class="col-sm-9">
						<input type="text" class="form-control input-sm" id="captcha" name="captcha" placeholder="Masukan 5 angka diatas">
					</div>
				</div>
				<div class="form-group">
		 			<div class="col-sm-offset-3 col-sm-9">
		   			<button type="button" onclick="contact_us(); return false;" class="btn btn-success"><i class="fa fa-send"></i> SUBMIT</button>
		 			</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('themes/cosmo/sidebar')?>