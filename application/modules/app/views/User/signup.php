<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
		<div class="panel-heading">Tạo tài khoản mới</div>
		<div class="panel-body">
			<form role="form" id="account">
				<fieldset>
					<div class="form-group">
						<input class="form-control" data-toggle="tooltip" placeholder="E-mail" name="email" type="email" autofocus="">
					</div>
					<div class="form-group">
						<input class="form-control" data-toggle="tooltip" placeholder="Mật khẩu" name="password" type="password" value="" title="Tối đa 128 ký tự, không gồm khoảng trắng">
					</div>
					<div class="form-group">
						<input class="form-control" data-toggle="tooltip" placeholder="Họ" name="lastname" type="text" title="Tối đa 64 ký tự">
					</div>
					<div class="form-group">
						<input class="form-control" data-toggle="tooltip" placeholder="Tên" name="firstname" type="text" title="Tối đa 64 ký tự">
					</div>
					<div class="form-group">
						<input class="form-control birthday-datepicker" data-toggle="tooltip" placeholder="Ngày sinh" name="birthday" type="text">
					</div>
					<div class="form-group">
						<input class="form-control" data-toggle="tooltip" placeholder="Số điện thoại" name="mobile" type="text">
					</div>
					<div class="form-group">
						<input placeholder="Nam" name="sex" type="radio" value="1" checked="">
						<label>Nam</label>
						<span>&nbsp;&nbsp;&nbsp;</span>
						<input placeholder="Nữ" name="sex" type="radio" value="0">
						<label>Nữ</label>
					</div>
					<div class="form-group">
						<a id='submit' href="javascript:signup()" class="btn btn-primary">Đăng ký</a>
					</div>
					<div class="form-group">
						<p id="message"></p>
					</div>
					<div class="form-group">
						<span class="pull-right"><a href="/app/user/forgot">Quên mật khẩu</a></span>
						<span class="pull-right">&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;</span>
						<span class="pull-right"><a href="/app/user/signin">Đăng nhập</a></span>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div><!-- /.col-->