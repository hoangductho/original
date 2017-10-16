<div class="content-ad">
    <a href="http://www.theme-junkie.com/"><img src="/assets/images/728x90.png" alt=""></a>
</div>  

<!-- Content / Start -->
<div id="content" class="content-loop list category-box">

    <h3 class="section-title">
        <strong>Series: <?php echo $name?></strong>
    </h3>

    <?php
        foreach ($articles as $key => $value) {
            $this->view('homepage/quickview_articles', $value);
        }
    ?>                                                      

    <?php if(isset($pages)) {
        echo pagination_render($pages);    
    }?>
</div>
<!-- Content / End -->