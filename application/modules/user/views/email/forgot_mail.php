<p>Chào bạn <?php echo isset($fullname) ? $fullname : null?>,</p>
<p>Chúng tôi đã nhận được thông báo bạn quên mật khẩu. Vui lòng click vào link dưới để cài đặt mật khẩu mới.</p>
<p><a href="<?php echo default_url() . 'app/User/reset/' . $active_code;?>"><?php echo default_url() . 'app/User/reset/' . $active_code;?></a></p>