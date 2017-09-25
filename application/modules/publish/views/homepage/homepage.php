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

    <?php
        foreach ($articles as $key => $value) {
            $this->view('homepage/quickview_articles', $value);
        }
    ?>                                                      

    <?php if(isset($pages)) {
        $explode = explode('/', $this->uri->uri_string);
        $current_page = filter_var(end($explode), FILTER_VALIDATE_INT) ? end($explode) : 1;
        ?> 
        <nav class="pagination">
            <?php if($current_page > 1){
                echo '<a class="page-numbers prev" href="'.page_link_render($current_page - 1).'">Prev</a>';
            }?> 
            
            <a class="page-numbers current" href="<?php echo page_link_render(1)?>">1</a>

            <?php if($current_page - 3 > 1){
                echo '<span class="page-numbers dots">…</span>';
            }?>
            <?php if($current_page - 2 > 1){
                echo '<a class="page-numbers prev" href="'.page_link_render($current_page - 2).'">Prev</a>';
            }?>
            <?php if($current_page - 1 > 1){
                echo '<a class="page-numbers prev" href="'.page_link_render($current_page - 1).'">Prev</a>';
            }?>
            <?php if($current_page > 1 && $current_page < $pages){
                echo '<a class="page-numbers prev" href="'.page_link_render($current_page + 1).'">Prev</a>';
            }?>
            <?php if($current_page + 1 < $pages){
                echo '<a class="page-numbers prev" href="'.page_link_render($current_page + 1).'">Prev</a>';
            }?>
            <?php if($current_page + 2 < $pages){
                echo '<a class="page-numbers prev" href="'.page_link_render($current_page + 2).'">Prev</a>';
            }?>
            <?php if($current_page + 3 < $pages){
                echo '<span class="page-numbers dots">…</span>';
            }?>
            <?php if($pages > 1){
                echo '<a class="page-numbers current" href="'.page_link_render($pages).'"><?php echo $pages?></a>';
            }?>

            <?php if($current_page < $pages){
                echo $current_page.'<a class="page-numbers next" href="'.page_link_render($current_page + 1).'">Next</a>';
            }?>           
        </nav>   
    <?php }?>
</div>
<!-- Content / End -->