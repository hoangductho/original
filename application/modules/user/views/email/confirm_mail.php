<p>Chào bạn <?php echo isset($fullname) ? $fullname : null?>,</p>
<p>Bạn đã đăng ký thành công tài khoản vienvong. Vui long click vào link dưới đây để kích hoạt tài khoản của bạn.</p>
<p><a href="<?php echo default_url() . 'app/User/active/' . $active_code;?>"><?php echo default_url() . 'app/User/active/' . $active_code;?></a></p>