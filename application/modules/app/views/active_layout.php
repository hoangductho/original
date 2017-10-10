<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo isset($title) ? $title : null?></title>

<link href="/assets/css/lumino/bootstrap.min.css" rel="stylesheet">
<link href="/assets/css/lumino/datepicker3.css" rel="stylesheet">
<link href="/assets/css/lumino/styles.css" rel="stylesheet">
<link href="/assets/lib/editormd/css/editormd.min.css" rel="stylesheet" />
<link href="/assets/css/vienvong/github-markdown.css" rel="stylesheet">
<link href="/assets/css/vienvong/font-awesome.min.css" rel="stylesheet" >
<link href="/assets/lib/datatables/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="/assets/lib/datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet">

<?php if(!empty($stylesheet)) {
	foreach ($stylesheet as $key => $value) {	
		echo '<link rel="stylesheet" type="text/css" href="'.$value.'">';
	}
}?>
<!-- <link href="/assets/lib/combobox/style.css" rel="stylesheet"> -->
<link href="/assets/css/vienvong/default.css" rel="stylesheet">

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
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<?php if(!empty($profile)) {
									echo '<img src="' . $profile['avatar'] .'" width="25" alt="User Avatar" class="img-circle"> ' . $profile['email'];
								}
								else {
									echo '<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> User <span class="caret"></span>';
							}?>
						</a>
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
			<li class="<?php echo $this->uri->uri_string == 'app/dashboard' ? 'active' : null;?>"><a href="/app/dashboard"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			<li class="<?php echo $this->uri->uri_string == 'app/writing/list' ? 'active' : null;?>"><a href="/app/writing/list"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Artilces</a></li>
			<!-- <li class="<?php echo $this->uri->uri_string == 'app/writing/list' ? 'active' : null;?>"><a href="charts.html"><svg class="glyph stroked line-graph"><use xlink:href="#stroked-line-graph"></use></svg> Stocks</a></li> -->
			<li class="<?php echo $this->uri->uri_string == 'app/writing' ? 'active' : null;?>"><a href="/app/writing"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Writing</a></li>
			<!-- <li class="<?php echo $this->uri->uri_string == '/app/writing/list' ? 'active' : null;?>"><a href="panels.html"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> Note</a></li>
			<li class="<?php echo $this->uri->uri_string == '/app/writing/list' ? 'active' : null;?>"><a href="icons.html"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Bookmarks</a></li> -->
			<li class="parent ">
				<a data-toggle="collapse" href="#management-items">
					<span><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Managements 
				</a>
				<ul class="children collapse" id="management-items">
					<li class="<?php echo $this->uri->uri_string == 'app/articles' ? 'active' : null;?>">
						<a href="/app/articles">
							<i class="fa fa-newspaper-o" aria-hidden="true"></i> Articles
						</a>
					</li>
					<li class="<?php echo $this->uri->uri_string == 'app/usergroup' ? 'active' : null;?>">
						<a href="/app/usergroup">
							<i class="fa fa-users" aria-hidden="true"></i> User-Group
						</a>
					</li>
				</ul>
			</li>
			<li class="parent ">
				<a data-toggle="collapse" href="#setting-items">
					<span><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg></span> Settings 
				</a>
				<ul class="children collapse" id="setting-items">
					<li class="<?php echo $this->uri->uri_string == 'app/categories' ? 'active' : null;?>">
						<a href="/app/categories">
							<svg class="glyph stroked table"><use xlink:href="#stroked-clipboard-with-paper"></use></svg> Categories
						</a>
					</li>
					<li class="<?php echo $this->uri->uri_string == 'app/groups' ? 'active' : null;?>">
						<a class="" href="/app/groups">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-app-window"></use></svg> Groups
						</a>
					</li>
					<li class="<?php echo $this->uri->uri_string == 'app/groups' ? 'active' : null;?>">
						<a class="" href="/app/roles">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-app-window"></use></svg> Roles
						</a>
					</li>
					<li class="<?php echo $this->uri->uri_string == 'app/regions' ? 'active' : null;?>">
						<a class="" href="/app/regions">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-app-window"></use></svg> Regions
						</a>
					</li>
					<li class="<?php echo $this->uri->uri_string == 'app/permissions' ? 'active' : null;?>">
						<a class="" href="/app/permissions">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-app-window"></use></svg> Permissions
						</a>
					</li>
					<li class="<?php echo $this->uri->uri_string == 'app/rolepermissions' ? 'active' : null;?>">
						<a class="" href="/app/rolepermissions">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-app-window"></use></svg> Role-Permission
						</a>
					</li>
					<li class="<?php echo $this->uri->uri_string == 'app/userpermissions' ? 'active' : null;?>">
						<a class="" href="/app/userpermissions">
							<svg class="glyph stroked chevron-right"><use xlink:href="#stroked-app-window"></use></svg> User-Permission
						</a>
					</li>
				</ul>
			</li>
			<li role="presentation" class="divider"></li>
			<li><a href="/app/profiles"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg> Profile</a></li>
			<li><a href="/app/changepass"><svg class="glyph stroked male-user"><use xlink:href="#stroked-key"></use></svg> Change password</a></li>
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
				<!-- <h1 class="page-header"><?php echo isset($title) ? $title : null?></h1> -->
				<br>
			</div>
		</div>
		<!--/.row-->

		<?php if(!empty($this->_MAIN_VIEW)) {$this->view($this->_MAIN_VIEW, $this->_MAIN_DATA);} ?>
	</div>	<!--/.main-->

	<script src="/assets/js/lumino/jquery.min.js"></script>
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
	<script src="/assets/lib/datetimepicker/build/js/moment.min.js"></script>
	<script src="/assets/lib/datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="/assets/lib/datatables/js/jquery.dataTables.min.js"></script>
	<script src="/assets/lib/combobox/bootstrap-combobox.js"></script>

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

	<?php if(!empty($javascript)) {
			foreach ($javascript as $key => $value) {	
	?>
		<script type="text/javascript" src="<?php echo $value;?>"></script>
	<?php }
		}
	?>
</body>

</html>
