<div class="col-sm-6 col-sm-offset-3 form-box">
	<div class="form-top">
		<div class="form-top-left">
			<h2>Login to our site</h2>
			<p id="login-info" <?=$can_logged_in ? '':'class="text-danger"';?>><?=$login_info;?></p>
		</div>
		<div class="form-top-right">
			<i class="fa fa-key"></i>
		</div>
	</div>
	<div class="form-bottom">
		<form role="form" class="login-form">
			<div class="form-group">
				<input <?=$can_logged_in ? '' : 'disabled="disabled"';?> autofocus autocomplete="off" type="text" name="username" placeholder="Username..." class="form-username form-control input-error" id="username">
			</div>
			<div class="form-group">
				<input <?=$can_logged_in ? '' : 'disabled="disabled"';?> type="password" name="password" placeholder="Password..." class="form-password form-control input-error" id="password">
			</div>
			<button <?=$can_logged_in ? '' : 'disabled="disabled"';?> onclick="login(); return false;" class="btn"><i class="fa fa-sign-out"></i> SIGN IN</button>
		</form>
	</div>
</div>