<div class="widget">
    <h3 class="widget-title"><strong>Series</strong></h3>
    <ul>
    	<?php foreach($series as $key => $value) {
    		echo '<li><a href="/publish/series/'.$value['id'].'/' . $value['friendly'].'">'.$value['name'].'</a></li>';
    	}?>                     
    </ul>                       
</div>