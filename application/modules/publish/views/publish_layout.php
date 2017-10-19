<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"><!--<![endif]--><head>
	<!-- Title -->
	<title><?php echo isset($title) ? $title : 'Viễn Vọng'?></title>

	<!-- Meta -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="<?php echo isset($description) ? $description : null; ?>">
    <meta name="keywords" content="<?php echo isset($keyword) ? $keyword : null; ?>">
    <meta property="fb:app_id" content="550251971759267">
    <meta property="og:site_name" content="Viễn Vọng">
    <meta property="og:type" content="article">
    <meta property="og:url" content="<?php echo 'https://vienvong.com/'. $this->uri->uri_string;?>">
    <meta property="og:title" content="<?php echo isset($title) ? $title : 'Viễn Vọng'?>">
    <meta property="og:description" content="<?php echo isset($description) ? $description : null; ?>">
    <meta property="og:image" content="<?php echo 'https://vienvong.com' . (isset($image) ? $image : '/assets/images/logo.png'); ?>">
    <meta property="og:locale" content="vi_VN">
    <meta property="article:author" content="https://vienvong.com" />
	<!-- Stylesheets -->
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/weather.css">	
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/style.css">	
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/font-awesome.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/prettyPhoto.css">	
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/default.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/responsive.css">

	<?php if(!empty($stylesheet)) {
			foreach ($stylesheet as $key => $value) {	
				echo '<link rel="stylesheet" type="text/css" href="'.$value.'">';
			}
		}?>

	<link rel="stylesheet" type="text/css" href="/assets/css/supernews/custom.css">

	<!-- Favicon -->
	<link type="image/x-icon" href="/assets/images/favicon.ico" rel="shortcut icon">

	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
	<script>
	  (adsbygoogle = window.adsbygoogle || []).push({
	    google_ad_client: "ca-pub-5355896671501389",
	    enable_page_level_ads: true
	  });
	</script>
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
						<!-- <li><a href="#">Subscribe</a></li>													 -->
						<li><a href="/publish/contact">Contact</a></li>
						<!-- <li><a href="#">Advertise</a></li>							 -->
						<li><a href="/publish/privacy">Privacy</a></li>
					</ul>

				</nav>
				<!-- Primary Navigation / End -->			

			</div><!-- #primary-bar -->	
			
			<div id="logo">
				<a href="/"><img src="/assets/images/logo.png" alt="Logo Title"></a>
				<!-- <h1 class="site-title"><a href="index.html">SuperNews</a></h1> -->
			</div>

			<div class="header-ad">
				<?php $this->view('widget/ads_header'); ?>
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
						<form action="/publish/search" id="searchform" method="post">
							<input name="keyword" type="text">
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
					<p>Thông tin là một nguồn tài nguyên, tài sản không giới hạn, không phân biệt biên giới, sắc tộc, tôn giáo. Tuy nhiên, thông tin chỉ có giá trị khi được xác thực, chọn lọc, đánh giá và đáng tin cậy.</p>
		
			        <blockquote>Thông tin giúp làm tăng hiểu biết của con người, là nguồn gốc của nhận thức và là cơ sở của quyết định.</blockquote>
				</div><!-- .widget -->
			</div><!-- .footer-column .footer-column-1 -->

			<div class="footer-column footer-column-2">
				<div class="widget widget_posts_thumbnail">
					<h3 class="widget-title">Popular Posts</h3>
					<ul>
						<?php if(!empty($populars)) {
							foreach ($populars as $key => $value) {
								$this->view('homepage/quickview_bottom', $value);
							}
						}?>								
					</ul>
				</div><!-- .widget .widget_posts_thumbnail -->
			</div><!-- .footer-column .footer-column-2 -->

			<div class="footer-column footer-column-3">
			    <div class="widget">
			        <h3 class="widget-title"><strong>Categories</strong></h3>
			        <ul>
			            <?php if(isset($categories)) {
			            	foreach ($categories as $key => $value) {
			            		echo '<li class="entry-title"><a href="/publish/detail/'.$value['id'].'">'.$value['name'].'</a></li>';
			            	}
			            }?>
			        </ul>
				</div><!-- .widget .widget_twitter -->
			</div><!-- .footer-column .footer-column-3 -->

			<div class="footer-column footer-column-4">
				<div class="widget widget_newsletter">
					<!-- <h3 class="widget-title">Newsletter</h3>
					<p>Make sure you don't miss interesting happenings by joining our newsletter program. We don't do spam.</p>		
					<form role="form">
						<input placeholder="Enter your email..." type="text">
						<button class="btn" type="button">Signup</button>
					</form>      -->
					<div class="fb-page" data-href="https://www.facebook.com/vienvong.vn/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/vienvong.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/vienvong.vn/">Viễn vọng</a></blockquote></div>
				</div><!-- .widget .widget_newsletter -->
			</div><!-- .footer-column .footer-column-4 -->							

			<!-- Site Bottom / Start -->
			<div id="site-bottom" class="container clearfix">

				<nav id="footer-nav">
					<ul>
						<li><a href="/publish/about">About</a></li>
						<!-- <li><a href="#">Subscribe</a></li>													 -->
						<li><a href="/publish/contact">Contact</a></li>
						<!-- <li><a href="#">Advertise</a></li>							 -->
						<li><a href="/publish/privacy">Privacy</a></li>
					</ul>
				</nav><!-- #footer-nav -->

				<div class="copyright">
					© 2017 <a href="/">VienVong</a> · Founded by <a href="https://www.facebook.com/hoangbatho">Hoàng Đức Thọ</a>
				</div><!-- .copyright -->

			</div>
			<!-- Site Bottom / End -->

		</footer>
		<!-- Footer / End -->	

	</div>
	<!-- Page / End -->
	<div id="fb-root"></div>

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
	<script type="text/javascript" src="/assets/lib/simpleweather/jquery.simpleWeather.min.js"></script>
	<script type="text/javascript" src="/assets/js/vienvong/weather.js"></script>
	<!-- <script type="text/javascript" src="/assets/images/analytics.js"></script> -->
	<?php if(!empty($javascript)) {
			foreach ($javascript as $key => $value) {	
				echo '<script type="text/javascript" src="'.$value.'"></script>';
			}
		}?>

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

	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.10";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<!-- FOR DEMO ONLY --> 

	<!-- Global Site Tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-107194872-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments)};
	  gtag('js', new Date());

	  gtag('config', 'UA-107194872-1');
	</script>
</body>
</html>