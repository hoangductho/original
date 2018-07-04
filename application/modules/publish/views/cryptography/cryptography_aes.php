
<div id="respond" class="comment-respond">

	<h3 id="reply-title" class="comment-reply-title">AES Encrypt/Decrypt Online</h3>

	<form id="commentform" class="comment-form respond-form">
		<div class="comment-form-comment form-group">
			<label for="url"><i class="fa fa-pencil"></i> Input Data</label>
			<textarea id="input_data" name="content" cols="45" rows="8" placeholder="Input string..."></textarea>			
		</div>
		<p class="comment-form-comment">
			<label for="url"><i class="fa fa-pencil"></i> AES Key</label>
			<input id="aeskey" class="txt" name="title" type="text" value="" placeholder="Hexa Key lenght 64 characters">			
		</p>
		<p class="comment-form-comment">
			<label for="url"><i class="fa fa-pencil"></i> AES Inner Vector</label>
			<input id="aesvector" class="txt" name="title" type="text" value="" placeholder="Hexa vector lenght 32 characters">			
		</p>
		<p class="comment-form-comment">
			<label for="url"><i class="fa fa-envelope"></i> Output Data</label>
			<textarea id="output_data" name="content" cols="45" rows="8" placeholder="Output string..."></textarea>			
		</p>
		<div class="comment-form-comment form-group">
			<button name="submit" type="button" id="submit" onclick="aesint()">Create Key</button>
			<button name="submit" type="button" id="submit" onclick="aesencrypt()">Encrypt</button>
			<button name="submit" type="button" id="submit" onclick="aesdecrypt()">Decrypt</button>
			<button name="cancel" type="reset" id="cancel" class="gray-button">Cancel</button>
		</div>
		<div class="comment-form-comment form-group">
			<p id="error" class="message-error"></p>
		</div>
	</form>

</div>