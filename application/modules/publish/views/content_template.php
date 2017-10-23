<main id="main" class="site-main container layout-lc" role="main" style="display:block">
	<div id="primary" class="content-area column" style="height: 3209px;">

		<?php if(!empty($this->_MAIN_VIEW)) {$this->view($this->_MAIN_VIEW, $this->_MAIN_DATA);} ?>

	</div>
	<!-- Primary / End -->

	<!-- Sidebar #2 / Start -->
	<div id="secondary" class="widget-area widget-primary sidebar2 column" role="complementary" style="height: 3209px;">

	    <div class="widget widget_qc">
	        <!-- <h3 class="widget-title">Advertisement</h3>   -->
	        <?php $this->view('widget/ads_right_top');?>
	    </div><!-- .widget .widget_qc -->
	    
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
	    </div><!-- .widget .widget_social -->

	    <?php if(!empty($keyword)) {
	    	$this->view('widget/tags', array('keyword' => $keyword));
	    }?>

	    <?php if(!empty($series)) {
	    	$this->view('widget/series', array('series' => $series));
	    }?>
	    <div class="widget widget_qc">
	        <?php $this->view('widget/ads_right_bottom');?>
	    </div><!-- .widget .widget_qc -->
	    <!-- .widget -->

	</div>
	<!-- Secondary / End -->

	<div class="clearfix"></div>

	<!-- Sidebar #2 / End -->	
</main>

