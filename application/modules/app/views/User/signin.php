<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
		<div class="panel-heading">Đăng nhập</div>
		<div class="panel-body">
			<form id="account">
				<div class="form-group">
						<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="" required="" >
					</div>
					<div class="form-group">
						<input class="form-control" placeholder="Mật khẩu" name="password" type="password" autocomplete="false" required="" >
					</div>
					<div class="checkbox">
						<label>
							<input name="remember" type="checkbox" value="Remember Me" >Ghi nhớ tài khoản
						</label>
					</div>
					<div class="form-group">
						<button id='submit' onclick="signin()" class="btn btn-primary">Đăng nhập</button>
					</div>
					<div class="form-group">
						<p id="message"></p>
					</div>
					<div class="form-group">
						<span class="pull-right"><a href="/app/user/signup">Đăng ký</a></span>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>
						<span class="pull-right"><a href="/app/user/forgot">Quên mật khẩu</a></span>
					</div>
			</form>
		</div>
	</div>
</div><!-- /.col-->