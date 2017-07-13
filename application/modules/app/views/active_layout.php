<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>

<link href="/assets/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet">
<link href="/assets/css/lumino/styles.css" rel="stylesheet">
<link href="/assets/css/vienvong/default.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	
	<div class="row">
		<?php if(!empty($this->_MAIN_VIEW)) {$this->view($this->_MAIN_VIEW, $this->_MAIN_DATA);} ?>
	</div><!-- /.row -->	
	
	<div class="modal fade loading" id="loading" role="dialog">
	    <div class="modal-dialog modal-sm">
	      <div class="modal-content">
	        <div class="modal-body">
	          <p><i class="fa fa-spinner fa-spin" style="font-size:24px"></i></p>
	          <p>Đang xử lý...</p>
	        </div>
	      </div>
	    </div>
	</div>

	<script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="/assets/js/jsencrypt/jsencrypt.min.js"></script>
	<script src="/assets/js/crypto-js/crypto-js.js"></script>
	<script src="/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- <script src="/assets/js/lumino/chart.min.js"></script> -->
	<!-- <script src="/assets/js/lumino/chart-data.js"></script> -->
	<!-- <script src="/assets/js/lumino/easypiechart.js"></script> -->
	<!-- <script src="/assets/js/lumino/easypiechart-data.js"></script> -->
	<script src="/assets/js/lumino/bootstrap-datepicker.min.js"></script>
	<script src="/assets/js/lumino/bootstrap-datepicker.vi.min.js"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
	<script src="/assets/js/vienvong/common.js"></script>
	<script src="/assets/js/vienvong/vienvong_core.js"></script>
	<script src="/assets/js/vienvong/account.js"></script>
	<script src="/assets/js/vienvong/runtime.js"></script>
</body>

</html>
