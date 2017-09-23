<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"><!--<![endif]--><head>

	<!-- Meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="An Unlimited WordPress News &amp; Magazine Theme with WooCommerce Support">
	<meta name="keywords" content="magazine template, news template">
	<meta name="author" content="themejunkie">

	<!-- Title -->
	<title>Viễn Vọng</title>

	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/style.css">	
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/prettyPhoto.css">	
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/default.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/responsive.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/custom.css">

	<!-- Favicon -->
	<link type="image/x-icon" href="http://dev.theme-junkie.com/html/supernews/images/favicon.png" rel="shortcut icon">

</head>

<body class="layout-narrow">

	<!-- Page / Start -->	
	<div id="page" class="hfeed site clearfix">

		<!-- Masthead / Start -->
		<header id="masthead" class="site-header container clearfix" role="banner">

			<div id="primary-bar" class="clearfix">
				
				<a id="primary-mobile-menu" href="#"><i class="fa fa-bars"></i> Primary Menu</a>

				<!-- Primary Navigation / Start -->
				<nav id="primary-nav">

					<ul id="primary-menu" class="sf-menu sf-js-enabled sf-arrows">
						<li><a href="/publish/about">About</a></li>			
						<li><a href="http://dev.theme-junkie.com/html/supernews/typography.html">Typography</a></li>
					</ul>

				</nav>
				<!-- Primary Navigation / End -->			

			</div><!-- #primary-bar -->	
			
			<div id="logo">
				<a href="/"><img src="/assets/images/logo.png" alt="Logo Title"></a>
				<!-- <h1 class="site-title"><a href="index.html">SuperNews</a></h1> -->
			</div>

			<div class="header-ad">
				<a href="#"><img src="/assets/images/728x90.png" alt=""></a>
			</div>

			<div class="clearfix"></div>

			<!-- Secondary Bar / Start -->
			<div id="secondary-bar" class="clearfix">

				<a id="secondary-mobile-menu" href="#"><i class="fa fa-bars"></i> <span>Secondary Menu</span></a>

				<!-- Secondary Navigation / Start -->
				<nav id="secondary-nav">
					<ul id="secondary-menu" class="sf-menu sf-js-enabled sf-arrows">
						<li class="home_item current_item"><a href="/"><i class="fa fa-home"></i> Home</a></li>
						<?php if(isset($categories)) {
							foreach ($categories as $key => $value) {
								echo '<li><a href="/publish/'.$value['id'].'/'.$value['friendly'].'">'.$value['name'].'</a></li>';
							}
						}?>
						<!-- <li><a href="http://dev.theme-junkie.com/html/supernews/listing_grid2.html">Travel</a></li>			
						<li><a href="http://dev.theme-junkie.com/html/supernews/listing_blog.html">Lifestyle</a></li>							
						<li><a href="http://dev.theme-junkie.com/html/supernews/category.html">Culture</a></li> -->
					</ul>
				</nav>
				<!-- Secondary Navigation / End -->

				<div class="header-search">

                    <i class="fa fa-search"></i>
                    <i class="fa fa-times"></i>

	                <div class="search-form">
						<form action="search.html" id="searchform" method="get">
							<input name="s" type="text">
							<button type="submit">Search</button>
						</form>
					</div><!-- .search-form -->		  

				</div><!-- .header-search -->		

			</div>	
			<!-- Secondary Bar / End -->

		</header>
		<!-- Masthead / End -->

		<!-- Site Main / Start -->
		<?php if(!empty($this->_TEMPLATE_VIEW)) {$this->view($this->_TEMPLATE_VIEW, $this->_TEMPLATE_DATA);} ?>
		<!-- Site Main / End -->
		
		<!-- Footer / Start -->	
		<footer id="footer" class="container clearfix">

			<div class="footer-column footer-column-1">
				<div class="widget">
					<h3 class="widget-title">About</h3>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
 eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad 
minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
ex ea commodo consequat.</p>
				</div><!-- .widget -->
			</div><!-- .footer-column .footer-column-1 -->

			<div class="footer-column footer-column-2">
				<div class="widget widget_posts_thumbnail">
					<h3 class="widget-title">Popular Posts</h3>
					<ul>
						<?php 
							for ($i=0; $i <3 ; $i++) { 
								$this->view('homepage/quickview_bottom');
							}
						?>								
					</ul>
				</div><!-- .widget .widget_posts_thumbnail -->
			</div><!-- .footer-column .footer-column-2 -->

			<div class="footer-column footer-column-3">
			    <div class="widget widget_twitter">
			        <h3 class="widget-title"><strong>Latest Tweets</strong></h3>
			        <ul>
			            <li>RT <a href="#">@envato</a>: <a href="#">#WordPress</a> 3.9.2 is now available as a security release. It is strongly advised to update immediately. <a href="#">http://t.co/PPcIPyrkZz</a> <span class="timestamp"><a href="#">3 hours ago</a></span></li>
			            <li>Heatwave Offer. Sign up for an annual plan and get 3 months of free WP Engine <a href="#">#WordPress</a> hosting! Code: "HeatWave14" <a href="#">http://t.co/bsg79FCgvy</a> <span class="timestamp"><a href="#">1 day ago</a></span></li>       
			        </ul>
				</div><!-- .widget .widget_twitter -->
			</div><!-- .footer-column .footer-column-3 -->

			<div class="footer-column footer-column-4">
				<div class="widget widget_newsletter">
					<h3 class="widget-title">Newsletter</h3>
					<p>Make sure you don't miss interesting happenings by joining our newsletter program. We don't do spam.</p>		
					<form role="form">
						<input placeholder="Enter your email..." type="text">
						<button class="btn" type="button">Signup</button>
					</form>     
				</div><!-- .widget .widget_newsletter -->
			</div><!-- .footer-column .footer-column-4 -->							

			<!-- Site Bottom / Start -->
			<div id="site-bottom" class="container clearfix">

				<nav id="footer-nav">
					<ul>
						<li><a href="/publish/about">About</a></li>
						<li><a href="#">Subscribe</a></li>													
						<li><a href="#">Contact</a></li>
						<li><a href="#">Advertise</a></li>							
						<li><a href="#">Privacy</a></li>
					</ul>
				</nav><!-- #footer-nav -->

				<div class="copyright">
					© 2014 <a href="http://dev.theme-junkie.com/html/supernews/index.html">SuperNews</a> · Designed by <a href="http://www.theme-junkie.com/">Theme Junkie</a>
				</div><!-- .copyright -->

			</div>
			<!-- Site Bottom / End -->

		</footer>
		<!-- Footer / End -->	

	</div>
	<!-- Page / End -->

	<!-- JavaScripts -->
	<!-- <script type="text/javascript" async="" src="/assets/images/ga.js"></script> -->
	<script type="text/javascript" src="/assets/js/supernews/jquery_002.js"></script>
	<script type="text/javascript" src="/assets/js/supernews/jquery-ui.js"></script>
	<script type="text/javascript" src="/assets/js/supernews/jquery.js"></script>		
	<script type="text/javascript" src="/assets/js/supernews/hoverIntent.js"></script>
	<script type="text/javascript" src="/assets/js/supernews/superfish.js"></script>	
	<script type="text/javascript" src="/assets/js/supernews/jquery_005.js"></script>
	<script type="text/javascript" src="/assets/js/supernews/jquery_004.js"></script>
	<script type="text/javascript" src="/assets/js/supernews/retina.js"></script>
	<script type="text/javascript" src="/assets/js/supernews/jquery_006.js"></script>
	<script type="text/javascript" src="/assets/js/supernews/jquery_003.js"></script>
	<script type="text/javascript" src="/assets/js/supernews/jquery_007.js"></script>
	<!-- <script type="text/javascript" src="/assets/images/analytics.js"></script> -->
	<!-- FOR DEMO ONLY --> 



	<div id="sidr-existing-primary" class="sidr left">
		<div class="sidr-inner">
			<ul id="sidr-id-primary-menu" class="sidr-class-sf-menu sidr-class-sf-js-enabled sidr-class-sf-arrows">
				<li><a href="/publish/about">About</a></li>				
				<li><a href="http://dev.theme-junkie.com/html/supernews/typography.html">Typography</a></li>
			</ul>
		</div>
	</div>
	<div id="sidr-existing-secondary" class="sidr left">
		<div class="sidr-inner">
			<ul id="sidr-id-secondary-menu" class="sidr-class-sf-menu sidr-class-sf-js-enabled sidr-class-sf-arrows">
				<li class="sidr-class-home_item sidr-class-current_item"><a href="/"><i class="sidr-class-fa sidr-class-fa-home"></i> Home</a></li>
				<?php if(isset($categories)) {
					foreach ($categories as $key => $value) {
						echo '<li><a href="/publish/'.$value['id'].'/'.$value['friendly'].'">'.$value['name'].'</a></li>';
					}
				}?>
				<!-- <li><a href="http://dev.theme-junkie.com/html/supernews/listing_grid2.html">Travel</a></li>			
				<li><a href="http://dev.theme-junkie.com/html/supernews/listing_blog.html">Lifestyle</a></li>							
				<li><a href="http://dev.theme-junkie.com/html/supernews/category.html">Culture</a></li> -->
			</ul>
		</div>
	</div>
</body>
</html>