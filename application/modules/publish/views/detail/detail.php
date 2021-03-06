<?php if(!empty($article)) {?>
	<div id="breadcrumbs-sticky-wrapper" class="sticky-wrapper" style="height: 27px;">
		<div id="breadcrumbs">
			<strong>You are here:</strong> <span class="home-page"><a href="/">Home</a></span> 
			<span class="seps">→</span> 
			<span class="category-page"><a href="/publish/<?php echo $article['category_id'] . '/' . $article['category_friendly']?>"><?php echo $article['category_name']?></a></span> 
			<!-- <span class="sep">→</span> <span class="title">Just another example post</span> -->
			<span class="post-nav see-all"><div class="fb-share-button" data-href="<?php echo '/' . $this->uri->uri_string?>" data-layout="button_count"></div></span>
		</div>
	</div>
	<article class="hentry post">
		<h1 class="entry-title"><?php echo $article['title'];?></h1>

		<div class="entry-meta">
			<span class="entry-author"><i class="fa fa-user"></i> <a href="/">Viễn Vọng</a></span>
			<span class="entry-date"><i class="fa fa-clock-o"></i> <?php echo $article['actived_date']?></span>
			<!-- <span class="entry-comment"><i class="fa fa-comments"></i> <a href="#comments">6 Comments</a></span> -->
			<!-- <span class="entry-tags"><i class="fa fa-tags"></i> <a href="#">Lorem</a>, <a href="#">ipsum</a></span>						 -->
		</div>

		<img class="entry-thumbnail" src="<?php echo $article['image']?>" alt="" width="100%">

		<div class="entry-content">
			<?php $this->view('widget/ads_detail_top'); ?>
			<br/>
			<pre class="row" id='md_content'><?php echo htmlentities($article['content'])?></pre>
			<div class="article-content markdown-body" id='html_content'></div>	
			<br>
			<div class="row">
				<?php if(!empty($series_list)){
					echo "<h5>{$article['series']}</h5>";
					foreach ($series_list as $key => $value) {
						echo "<p><a  href='/publish/detail/{$value['id']}/{$value['friendly']}'>{$value['title']}</a></p>";
					}
				}?>
			</div>
		</div><!-- .entry-content -->

		<footer class="entry-footer clearfix">
			<?php $this->view('widget/ads_detail_content'); ?>
		</footer><!-- .entry-footer -->

	    <div class="related-posts">
	    	<h3>You might also like:</h3>
	    	<ul class="clearfix">
	    		<?php if(!empty($relations)) {
	    			foreach ($relations as $key => $value) {
	    				echo '<li><a href="/publish/detail/'.$value['id'] . '/' . $value['friendly'] .'"><div class="related-thumbnail"><img src="'.$value['image'].'" alt=""></div><h2 class="entry-title">'.$value['title'].'</h2></a></li>';
	    			}
	    		}?>
	    				        
	    	</ul>
	    </div><!-- .related-posts -->						

		<div class="clearfix"></div>
	</article>
<?php }?>

<?php //$this->view('detail/comment');?>
<?php //$this->view('detail/respond');?>