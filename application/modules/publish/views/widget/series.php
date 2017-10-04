<div class="widget">
    <h3 class="widget-title"><strong>Series</strong></h3>
    <ul>
    	<?php foreach($series as $key => $value) {
    		echo '<li><a href="/publish/series/'.$value['code'].'/' . $value['name'].'">'.$value['name'].'</a></li>';
    	}?>                     
    </ul>                       
</div>