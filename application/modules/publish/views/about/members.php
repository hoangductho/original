<?php if(!empty($team)) {?>
<br>
<hr>
<h3>Our Team</h3>
<div class="team-members">
	<ul class="members clearfix">
	<?php foreach($team as $value) {?>
		<li class="member">
			<div class="member-photo">
				<img src="<?php echo $value['user_avatar']?>" alt="Avatar" style="">
				<ul class="member-social clearfix">
					<!-- <li><a href="#"><i class="fa fa-twitter"></i></a></li> -->
					<!-- <li><a href="#"><i class="fa fa-facebook"></i></a></li> -->
					<!-- <li><a href="#"><i class="fa fa-google-plus"></i></a></li> -->
					<!-- <li><a href="#"><i class="fa fa-linkedin"></i></a></li> -->
					<!-- <li><a href="#"><i class="fa fa-pinterest"></i></a></li> -->
					<!-- <li><a href="#"><i class="fa fa-dribbble"></i></a></li> -->
				</ul>
			</div>
			<div class="member-content">
				<h3 class="member-name"><?php echo $value['username'];?></h3>
				<p class="member-position"><?php echo $value['role_name']?></p>
				<div class="member-desc"><p><?php echo $value['user_introduce']?></p>
				</div>
			</div>
		</li>
	<?php }?>
	</ul>
</div>
<?php }?>