<article id="post-2" class="hentry post clearfix">
    <div class="contain-thumbnail">
        <a href="/publish/detail/<?php echo $id . '/' . $friendly?>">
            <img class="entry-thumbnail" src="<?php echo $image?>" alt="<?php echo $title?>">
        </a>
    </div>
    <h2 class="entry-title"><a href="/publish/detail/<?php echo $id . '/' . $friendly?>"><?php echo $title?></a></h2>

	<div class="entry-meta">
		<!-- <span class="entry-stars"></span> -->
		<span class="entry-date"><?php echo $actived_date?></span>
		<!-- <span class="entry-comments"><a href="http://dev.theme-junkie.com/html/supernews/post.html#comments">3 Comments</a></span> -->
	</div><!-- .entry-meta -->

    <div class="entry-summary">
        <?php echo $description?>
    </div>
    <div class="more-link">
        <a href="#">Read the rest of this entry</a>
        <!-- <a href="/publish/detail/<?php echo $id . '/' . $friendly?>">Xem chi tiết</a> -->
    </div><!-- .more-link -->	 	                    
</article>