<div class="col-sm-6 col-sm-offset-3 form-box">
	<div class="form-top">
		<div class="form-top-left">
			<h2>Reset Password</h2>
		</div>
		<div class="form-top-right">
			<i class="fa fa-key"></i>
		</div>
	</div>
	<div class="form-bottom">
		<form role="form" class="login-form">
			<div class="form-group">
				<input autofocus type="password" name="password" placeholder="New Password" class="form-password form-control input-error" id="password">
			</div>
			<div class="form-group">
				<input type="password" name="password" placeholder="Re-Type New Password" class="form-password form-control input-error" id="c_password">
			</div>
			<input type="hidden" id="forgot_password_key" name="forgot_password_key" value="<?=$this->uri->segment(2)?>">
			<button onclick="reset_password(); return false;" class="btn"><i class="fa fa-sign-out"></i> SUBMIT</button>
		</form>
	</div>
</div>