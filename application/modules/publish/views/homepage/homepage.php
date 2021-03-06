<?php if(!empty($trends)) {
    $this->view('homepage/trending_articles', array('trends' => $trends));
}?>

<?php $this->view('widget/content_qc');?> 

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