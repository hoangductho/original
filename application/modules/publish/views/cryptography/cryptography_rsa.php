
<div id="respond" class="comment-respond">

	<h3 id="reply-title" class="comment-reply-title">RSA Encrypt/Decrypt Online</h3>

	<form id="commentform" class="comment-form respond-form">
		<div class="comment-form-comment form-group">
			<label for="url"><i class="fa fa-pencil"></i> Input Data</label>
			<textarea id="input_data" name="content" cols="45" rows="8" placeholder="Input string..."></textarea>			
		</div>
		<p class="comment-form-comment">
			<label for="url"><i class="fa fa-pencil"></i> RSA Public Key</label>
			<textarea id="publickey" name="content" cols="45" rows="8" placeholder="Input RSA public key"></textarea>			
		</p>
		<p class="comment-form-comment">
			<label for="url"><i class="fa fa-pencil"></i> RSA Private Key</label>
			<textarea id="privatekey" name="content" cols="45" rows="8" placeholder="Input RSA private key"></textarea>		
		</p>
		<p class="comment-form-comment">
			<label for="url"><i class="fa fa-envelope"></i> Output Data</label>
			<textarea id="output_data" name="content" cols="45" rows="8" placeholder="Output string..."></textarea>			
		</p>
		<div class="comment-form-comment form-group">
			<!-- <button name="submit" type="button" id="submit" onclick="aesint()">Create Key</button> -->
			<button name="submit" type="button" id="submit" onclick="rsaEncrypt()">Encrypt</button>
			<button name="submit" type="button" id="submit" onclick="rsaDecrypt()">Decrypt</button>
			<button name="cancel" type="reset" id="cancel" class="gray-button">Cancel</button>
		</div>
		<div class="comment-form-comment form-group">
			<p id="error" class="message-error"></p>
		</div>
	</form>

</div>