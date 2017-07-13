<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
		<div class="panel-heading">Đổi mật khẩu</div>
		<div class="panel-body">
			<form role="form">
				<fieldset>
					<div class="form-group">
						<input class="form-control" placeholder="Mã xác thực" name="code" type="text" value="<?php echo isset($code) ? $code : null;?>">
					</div>
					<div class="form-group">
						<input class="form-control" placeholder="Mật khẩu" name="password" type="password" value="">
					</div>
					<div class="form-group">
						<input class="form-control" placeholder="Nhập lại mật khẩu" name="retype" type="password" value="">
					</div>
					<div class="form-group">
						<a id='submit' href="javascript:reset();" class="btn btn-primary">Gửi</a>
					</div>
					<div class="form-group">
						<p id="message"></p>
					</div>
					<div class="form-group">
						<span class="pull-right"><a href="/app/user/signup">Đăng ký</a></span>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>
						<span class="pull-right"><a href="/app/user/signin">Đăng nhập</a></span>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div><!-- /.col-->