<option value="">-- Select Role --</option>
<?php if(isset($roles)) {
	foreach ($roles as $key => $value) {
		echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
	}
}?>