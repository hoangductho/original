<?php if(!empty($trends)) {
    $this->view('homepage/trending_articles', array('trends' => $trends));
}?>

<div class="content-ad">
    <a href="http://www.theme-junkie.com/"><img src="/assets/images/728x90.png" alt=""></a>
</div>  

<!-- Content / Start -->
<div id="content" class="content-loop list category-box">

    <h3 class="section-title">
        <strong>List Articles</strong>
    </h3>
    <ins class="adsbygoogle"
         style="display:block"
         data-ad-format="fluid"
         data-ad-layout-key="-fg+56+9c-gk-1g"
         data-ad-client="ca-pub-5355896671501389"
         data-ad-slot="7444950490"></ins>
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