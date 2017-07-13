<!DOCTYPE html>
<html>
<head>
	<title>Vienvong.com</title>
	<style>
		* {
			margin: 0;
			padding: 0;
			font-family: 'Helvetica', 'arial', 'nimbussansl', 'liberationsans', 'freesans', 'clean', 'sans-serif', "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
			-webkit-box-sizing: border-box; 
			-moz-box-sizing: border-box; 
			box-sizing: border-box;
		}

		header {
			float: left;
			width: 100%;
			height: 50px;
			line-height: 50px;
			background-color: #ececec;
			border-bottom: 1px solid #cecece;
		}

		section {
			float: left;
			width: 100%;
			min-height: 320px;
			text-align: justify;
		}

		section p {
			text-align: justify;
			padding: 7px;
		}

		footer {
			float: left;
			width: 100%;
			height: 50px;
			line-height: 50px;
			border-top: 1px solid #ccc;
			text-align: center;
			color: #777;
		}

		a.opacity {
			color: #333; 
			text-decoration: none;
		}
	</style>
</head>
<body>
	<div style="float: left; border: 1px solid #ccc; width: 100%; max-width: 520px;">
		<header>
			<div style="padding: 0 10px; height: 50px; box-shadow: 1px 1px 1px #cecece;">
				<span style="float: left; display: inline-block;">
					<a class="opacity" href="//vienvong.com"><h2>Vienvong</h2></a>
				</span>
				<span style="float: right; display: inline-block;">
					<a class="opacity" href="//vienvong.com"><span class='large-text'>&#8962;</span> Trang chủ</a>
				</span>
			</div>
		</header>
		<section>
			<div  style="padding 10px">
				<?php if(!empty($this->_MAIN_VIEW)) {$this->view($this->_MAIN_VIEW, $this->_MAIN_DATA);} ?>
				
				<p>Cảm ơn bạn đã đồng hành cùng chúng tôi.</p>
				<p>Chúng tôi hi vọng sẽ nhận được những ý kiến đóng góp của bạn để nâng cao chất lượng hoạt động.</p>
				<p>Trân trọng!</p>
				<p>	&#8881;&#8880;</p>
			</div>
		</section>
		<footer>
			<div>@Vienvong Team</div>
		</footer>
	</div>
</body>
</html>
