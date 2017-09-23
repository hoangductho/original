<!-- Featured Content / Start -->
<div id="featured-content-2" class="category-box clearfix">
    <h3 class="section-title"><strong>Featured News</strong><span class="see-all"><a href="http://dev.theme-junkie.com/html/supernews/category.html">More</a></span></h3>
    <div class="featured-big">
            <a href="http://dev.theme-junkie.com/html/supernews/post.html"><img class="entry-thumbnail" src="/assets/images/41-472x265.jpg" alt=""></a>    
            <h2 class="entry-title"><a href="http://dev.theme-junkie.com/html/supernews/post.html">Fusce volutpat elementum augue felis</a></h2>
            <div class="entry-meta">
                <span class="entry-stars"></span>
                <span class="entry-date">Sep. 15, 2014</span>
                <span class="entry-comments"><a href="http://dev.theme-junkie.com/html/supernews/post.html#comments">3 Comments</a></span>                    
            </div>                      
            <div class="entry-summary">
                Lorem ipsum dolor sit amet, consectetur 
adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore 
magna aliqua. Ut enim ad minim veniam.
            </div>
            <div class="more-link">
                <a href="#">Read the rest of this entry</a>
            </div>
    </div>
    <div class="featured-small">
            <a href="http://dev.theme-junkie.com/html/supernews/post.html"><img class="entry-thumbnail" src="/assets/images/38-216x121.jpg" alt=""></a>    
            <h2 class="entry-title"><a href="http://dev.theme-junkie.com/html/supernews/post.html">Etiam maximus lacinia posuere nisl</a></h2>
            <div class="entry-meta">
                <span class="entry-date">Sep. 15, 2014</span>
                <span class="entry-comments"><a href="http://dev.theme-junkie.com/html/supernews/post.html#comments">3 Comments</a></span>                    
            </div>                             
    </div>
    <div class="featured-small last">               
            <a href="http://dev.theme-junkie.com/html/supernews/post.html"><img class="entry-thumbnail" src="/assets/images/38-216x121.jpg" alt=""></a>    
            <h2 class="entry-title"><a href="http://dev.theme-junkie.com/html/supernews/post.html">Aenean efficitur enim vel ultrices laoreet</a></h2>
            <div class="entry-meta">
                <span class="entry-date">Sep. 15, 2014</span>
                <span class="entry-comments"><a href="http://dev.theme-junkie.com/html/supernews/post.html#comments">3 Comments</a></span>                    
            </div>                                        
    </div>    
</div>
<!-- Featured Content / End -->

<div class="content-ad">
    <a href="http://www.theme-junkie.com/"><img src="/assets/images/728x90.png" alt=""></a>
</div>  

<!-- Content / Start -->
<div id="content" class="content-loop list category-box">

    <h3 class="section-title">
        <strong>List Articles</strong>
    </h3>

    <?php
        foreach ($articles as $key => $value) {
            $this->view('homepage/quickview_articles', $value);
        }
    ?>                                                      

    <nav class="pagination">
        <!-- <a class="page-numbers prev" href="#">Prev</a> -->                   
        <a class="page-numbers current" href="http://dev.theme-junkie.com/html/supernews/index.html">1</a>
        <a class="page-numbers" href="#">2</a>
        <a class="page-numbers" href="#">3</a>
        <span class="page-numbers dots">…</span>     
        <a class="page-numbers" href="#">5</a>
        <a class="page-numbers next" href="#">Next</a>                  
    </nav>                 

</div>
<!-- Content / End -->