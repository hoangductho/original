<div id="respond" class="comment-respond">

	<h3 id="reply-title" class="comment-reply-title">Contact</h3>

	<form id="commentform" class="comment-form respond-form">
		<p class="comment-form-comment">
			<label for="url"><i class="fa fa-pencil"></i> Title</label>
			<input id="url" class="txt" name="title" type="text" value="" size="100">			
		</p>
		<p class="comment-form-comment">
			<textarea id="comment" name="content" cols="45" rows="8" placeholder="Respond content"></textarea>
		</p>	

		<p class="comment-form-author">
			<label for="author"><i class="fa fa-user"></i> Name <span class="required">*</span></label> 
			<input id="author" class="txt" name="author" type="text" value="" size="30">
		</p>

		<p class="comment-form-email">
			<label for="email"><i class="fa fa-envelope"></i> Email <span class="required">*</span></label>		
			<input id="email" class="txt" name="email" type="text" value="" size="30">
		</p>

		<p class="comment-form-url">
			<label for="url"><i class="fa fa-link"></i> Website</label>
			<input id="url" class="txt" name="website" type="text" value="" size="30">			
		</p>									

		<div>
			<button name="submit" type="button" id="submit" onclick="commentform_send()">Post Comment</button>
			<button name="cancel" type="reset" id="cancel" class="gray-button">Cancel</button>
		</div>
		<div><p id="message"></p></div>
	</form>

</div>