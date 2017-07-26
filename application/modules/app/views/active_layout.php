<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($title) ? $title : null?></title>

<link href="/assets/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="/assets/node_modules/bootstrap-datepicker/dist/css/bootstrap-datepicker3.css" rel="stylesheet">
<link href="/assets/css/lumino/styles.css" rel="stylesheet">
<link href="/assets/lib/editormd/css/editormd.min.css" rel="stylesheet" />
<link href="/assets/css/vienvong/github-markdown.css" rel="stylesheet">
<link href="/assets/lib/datatables/jquery.dataTables.min.css" rel="stylesheet" />
<link href="/assets/css/vienvong/default.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Viễn</span>Vọng</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<!-- <li><a href="#"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
							<li><a href="#"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Settings</a></li> -->
							<li><a href="/app/user/signout"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="/app/dashboard"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li><a href="widgets.html"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Calendar</a></li>
			<li><a href="charts.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Stocks</a></li>
			<li><a href="/app/categories"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Categories</a></li>
			<li><a href="/app/writing"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Writing</a></li>
			<li><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Note</a></li>
			<li><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Bookmarks</a></li>
			<li class="parent ">
				<a href="#">
					<span data-toggle="collapse" href="#sub-item-1"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Dropdown 
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 1
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 2
						</a>
					</li>
					<li>
						<a class="" href="#">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-chevron-right"></use></svg> Sub Item 3
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>
			<li><a href="login.html"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="/app/dashboard"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active"><?php echo isset($title) ? $title : null?></li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php echo isset($title) ? $title : null?></h1>
			</div>
		</div><!--/.row-->

		<?php if(!empty($this->_MAIN_VIEW)) {$this->view($this->_MAIN_VIEW, $this->_MAIN_DATA);} ?>
	</div>	<!--/.main-->

	<script src="/assets/node_modules/jquery/dist/jquery.min.js"></script>
	<script src="/assets/js/jsencrypt/jsencrypt.min.js"></script>
	<script src="/assets/js/crypto-js/crypto-js.js"></script>
	<script src="/assets/js/lumino/bootstrap.min.js"></script>
	<script src="/assets/js/lumino/bootstrap-datepicker.min.js"></script>
	<script src="/assets/js/lumino/bootstrap-datepicker.vi.min.js"></script>
	<script src="/assets/js/lumino/lumino.glyphs.js"></script>
	<script src="/assets/js/lumino/chart.min.js"></script>
	<!-- <script src="/assets/js/lumino/chart-data.js"></script> -->
	<script src="/assets/js/lumino/easypiechart.js"></script>
	<script src="/assets/js/lumino/easypiechart-data.js"></script>
	<script src="/assets/lib/editormd/editormd.min.js"></script>
	<script src="/assets/lib/editormd/languages/en.js"></script>
	<script src="/assets/lib/datatables/jquery.dataTables.min.js"></script>

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
