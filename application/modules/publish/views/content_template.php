<main id="main" class="site-main container layout-lc" role="main" style="display:block">
	<div id="primary" class="content-area column" style="height: 3209px;">

		<?php if(!empty($this->_MAIN_VIEW)) {$this->view($this->_MAIN_VIEW, $this->_MAIN_DATA);} ?>

	</div>
	<!-- Primary / End -->

	<!-- Sidebar #2 / Start -->
	<div id="secondary" class="widget-area widget-primary sidebar2 column" role="complementary" style="height: 3209px;">

	    <!-- <div class="widget widget_ads">
	        <h3 class="widget-title">Advertisement</h3>
	        <a href="http://www.theme-junkie.com/" target="_blank"><img src="/assets/images/ad_300x250.png" alt="Ad Widget"></a>
	    </div> --><!-- .widget .widget_ads -->
	    <div class="widget widget_weather">
	        <h3 class="widget-title">Weather</h3>
	        <div class="newsletter-container">
		        <div id="weather"></div>
	        </div>
	    </div> 
	    <div class="widget widget_social clearfix">
	        <!-- <ul>
	            <li><a href="#" title="Twitter"><i class="fa fa-twitter"></i><span><strong>5,600</strong></span><span>Followers</span></a></li>
	            <li><a href="#" title="Facebook"><i class="fa fa-facebook"></i><span><strong>1,986</strong></span><span>Fans</span></a></li>            
	            <li><a href="#" title="GooglePlus"><i class="fa fa-google-plus"></i><span><strong>1,300</strong></span><span>In Circle</span></a></li>
	            <li><a href="#" title="RSS"><i class="fa fa-rss"></i><span><strong>20,000</strong></span><span>Subscribers</span></a></li>
	        </ul> -->
	        <div class="fb-page" data-href="https://www.facebook.com/vienvong.vn/" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/vienvong.vn/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/vienvong.vn/">Viễn vọng</a></blockquote></div>
	        <!-- <?php if($this->uri->segment(2) == 'detail') {?>
	        	<div class="fb-like" data-href="<?php echo '/' . $this->uri->uri_string .'-';?>" data-width="300" data-layout="box_count" data-action="like" data-size="small" data-show-faces="true" data-share="false"></div>
	        <?php } else {?>
	        	<div class="fb-follow" data-href="https://www.facebook.com/vienvong.vn/" data-layout="box_count" data-size="small" data-show-faces="true"></div>
	        <?php }?> -->
	    </div><!-- .widget .widget_social -->

	    <!-- <div class="widget widget_newsletter">
	        <h3 class="widget-title">Newsletter</h3>
	        <div class="newsletter-container">
	        <p>Subscribe to our newsletter to receive breaking news by email.</p>    
	        <form role="form">
	            <input placeholder="Enter your email..." type="text">
	            <button class="btn" type="button">Signup</button>
	        </form>
	        </div>
	    </div> --><!-- .widget .widget_newsletter -->
	    
	    <!-- <div class="widget widget_ads">
	        <h3 class="widget-title">Advertisement</h3>  
	        <a href="http://www.theme-junkie.com/" target="_blank"><img src="/assets/images/ad_300x250_2.png" alt="Ad Widget"></a>
	    </div> --><!-- .widget .widget_ads -->

	    <?php if(!empty($keyword)) {
	    	$this->view('widget/tags', array('keyword' => $keyword));
	    }?>

	    <!-- <div class="widget widget_125">
	        <h3 class="widget-title"><strong>Sponsors</strong></h3> 
	        <a href="#"><img src="/assets/images/125x125c.png" alt=""></a>
	        <a href="#"><img class="img-right" src="/assets/images/125x125e.jpg" alt=""></a>
	        <a href="#"><img src="/assets/images/125x125d.jpg" alt=""></a>
	        <a href="#"><img class="img-right" src="/assets/images/125x125f.png" alt=""></a>
	    </div> --><!-- .widget.widget_125 -->

	    <?php if(!empty($series)) {
	    	$this->view('widget/series', array('series' => $series));
	    }?>
	    <!-- .widget -->
	    
	    <!-- <div class="widget widget_ads">
	        <h3 class="widget-title">Advertisement</h3>  
	        <a href="http://www.theme-junkie.com/" target="_blank"><img src="/assets/images/ad_300x600.jpeg" alt="Ad Widget"></a>
	    </div> --><!-- .widget .widget_ads -->

	</div>
	<!-- Secondary / End -->

	<div class="clearfix"></div>

	<!-- Sidebar #2 / End -->	
</main>

