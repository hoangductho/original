<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
	<div class="login-panel panel panel-default">
		<div class="panel-heading">Kích hoạt tài khoản</div>
		<div class="panel-body">
			<form role="form" id='account'>
				<fieldset>
					<div class="form-group">
						<input class="form-control" data-toggle="tooltip" placeholder="E-mail" name="email" type="email" autofocus="" value="<?php echo isset($email) ? $email : null;?>">
					</div>
					<div class="form-group" hidden="">
						<input class="form-control" data-toggle="tooltip" placeholder="Mã kích hoạt" name="code" type="text" value="<?php echo isset($code) ? $code : null;?>">
					</div>
					<div class="form-group">
						<a id='submit' href="javascript:resend();" class="btn btn-primary">Gửi lại</a>
					</div>
					<div class="form-group">
						<p id="message"></p>
					</div>
				</fieldset>
			</form>
		</div>
	</div>
</div><!-- /.col-->