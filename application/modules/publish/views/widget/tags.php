<div class="widget widget_tabs">

    <!-- Tabs Nav -->
    <!-- <ul class="tabs-nav">
        <li><a href="#tab4s" title="Tags">Tags <i class="fa fa-tags"></i></a></li>
    </ul> -->
    <h3 class="widget-title"><strong>Tags</strong></h3>  
    <!-- Tabs Container -->
    <div class="tabs-container">
        <div class="tab-content" id="tab4">
            
            <?php 
            $explode = explode(',',$keyword);

            foreach($explode as $key => $value) {
                $value = trim($value);
                echo '<a href="/publish/tags/'.$value.'">'.$value.'</a>';
            }?>
        </div>

    </div>

</div><!-- .widget .widget_tabs -->