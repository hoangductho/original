
<!-- Featured Content / Start -->
<div id="featured-content-2" class="category-box clearfix">
    <h3 class="section-title">
        <strong>Featured News</strong>
        <span class="see-all"><a href="">More</a></span>
    </h3>

    <?php if(isset($trends[0])) {
            $trend = $trends[0];
        ?>
        <div class="featured-big">
            <a href="/publish/detail/<?php echo $trend['id'] . '/' . $trend['friendly']?>"><img class="entry-thumbnail" src="<?php echo $trend['image']?>" alt=""></a>    
            <h2 class="entry-title">
                <a href="/publish/detail/<?php echo $trend['id'] . '/' . $trend['friendly']?>">
                    <?php echo $trend['title']?>
                </a>
            </h2>
            <div class="entry-meta">
                <!-- <span class="entry-stars"></span> -->
                <span class="entry-date"><?php echo $trend['actived_date']?></span>
                <!-- <span class="entry-comments"><a href="http://dev.theme-junkie.com/html/supernews/post.html#comments">3 Comments</a></span>  -->
            </div>                      
            <div class="entry-summary">
                <?php echo $trend['description']?>
            </div>
            <div class="more-link">
                <a href="/publish/detail/<?php echo $trend['id'] . '/' . $trend['friendly']?>">Xem chi tiết</a>
            </div>
        </div>
    <?php }?>

    <?php if(isset($trends[1])) {
            $trend = $trends[1];
        ?>
        <div class="featured-small">
            <a href="/publish/detail/<?php echo $trend['id'] . '/' . $trend['friendly']?>"><img class="entry-thumbnail" src="<?php echo $trend['image']?>" alt=""></a>    
            <h2 class="entry-title"><a href="/publish/detail/<?php echo $trend['id'] . '/' . $trend['friendly']?>"><?php echo $trend['title']?></a></h2>
            <div class="entry-meta">
                <span class="entry-date"><?php echo $trend['actived_date']?></span>
                <!-- <span class="entry-comments"><a href="http://dev.theme-junkie.com/html/supernews/post.html#comments">3 Comments</a></span>               -->
            </div>                             
        </div>
    <?php }?>
    
    <?php if(isset($trends[2])) {
            $trend = $trends[2];
        ?>
        <div class="featured-small last">               
            <a href="/publish/detail/<?php echo $trend['id'] . '/' . $trend['friendly']?>"><img class="entry-thumbnail" src="<?php echo $trend['image']?>" alt=""></a>    
            <h2 class="entry-title"><a href="/publish/detail/<?php echo $trend['id'] . '/' . $trend['friendly']?>"><?php echo $trend['title']?></a></h2>
            <div class="entry-meta">
                <span class="entry-date"><?php echo $trend['actived_date']?></span>
                <!-- <span class="entry-comments"><a href="http://dev.theme-junkie.com/html/supernews/post.html#comments">3 Comments</a></span>                     -->
            </div>
        </div>
    <?php }?>
        
</div>
<!-- Featured Content / End -->