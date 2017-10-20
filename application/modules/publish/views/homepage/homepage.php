<?php if(!empty($trends)) {
    $this->view('homepage/trending_articles', array('trends' => $trends));
}?>

<div class="content-ad">
    <a href='https://pub.accesstrade.vn/deep_link/4712106233689487615?url=http%3A%2F%2Ffptshop.com.vn%2F'> <img src='https://s3-ap-southeast-1.amazonaws.com/images.accesstrade.vn/47d1e990583c9c67424d369f3414728e/5249_970x90_20161118083256602.png'/> </a>
</div>  

<!-- Content / Start -->
<div id="content" class="content-loop list category-box">

    <h3 class="section-title">
        <strong>List Articles</strong>
    </h3>
    <?php
        foreach ($articles as $key => $value) {
            if($key%5 == 0) {
                $this->view('widget/ads_listpost');
            }

            $this->view('homepage/quickview_articles', $value);
        }
    ?>                                                      

    <?php if(isset($pages)) {
        echo pagination_render($pages);    
    }?>
</div>
<!-- Content / End -->