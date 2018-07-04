
<div id="respond" class="comment-respond">

	<h3 id="reply-title" class="comment-reply-title">Base64 Encode/Decode Online</h3>

	<form id="commentform" class="comment-form respond-form">
		<div class="comment-form-comment form-group">
			<label for="url"><i class="fa fa-pencil"></i> Input Data</label>
			<textarea id="input_data" name="content" cols="45" rows="8" placeholder="Input string..."></textarea>			
		</div>
		<p class="comment-form-comment">
			<label for="url"><i class="fa fa-envelope"></i> Output Data</label>
			<textarea id="output_data" name="content" cols="45" rows="8" placeholder="Output string..."></textarea>			
		</p>
		<div class="comment-form-comment form-group">
			<button name="submit" type="button" id="submit" onclick="base64encode()">Encode</button>
			<button name="submit" type="button" id="submit" onclick="base64decode()">Decode</button>
			<button name="cancel" type="reset" id="cancel" class="gray-button">Cancel</button>
		</div>
		<div class="comment-form-comment form-group">
			<p id="error" class="message-error"></p>
		</div>
	</form>

</div>