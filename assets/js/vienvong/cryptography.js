/**
 * MD5 Hash
 * ------------------------------------------------
 * 
 */
function md5() {
	try {
		$('#error').text("");
		var input = $('textarea#input_data').val();
		var output = CryptoJS.MD5(input);
		$('input#output_data').val(output.toString());
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
	
}

/**
 * SHA-1 Hash 
 * ------------------------------------------------
 */
 function sha1() {
 	try {
 		$('#error').text("");
		var input = $('textarea#input_data').val();
		var output = CryptoJS.SHA256(input);
		$('input#output_data').val(output.toString());
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
 }

/**
 * AES Init key 
 * ------------------------------------------------
 */
 function aesint() {
 	try {
 		$('#error').text("");
		// Create AES Key and AES Initilization Vector
	    var key = CryptoJS.lib.WordArray.random(256 / 8).toString(); 
	    var iv = CryptoJS.lib.WordArray.random(128 / 8).toString();
	    // Init aeskey in this page
	    $('input#aeskey').val(key.toString());
	    $('input#aesvector').val(iv.toString());
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
 }

/**
 * AES Encrypt 
 * ------------------------------------------------
 */
 function aesencrypt() {
 	try {
 		$('#error').text("");
		var input = $('textarea#input_data').val();
	 	var aeskey = $('input#aeskey').val();
	 	var vector = $('input#aesvector').val();
		// create Hexa format for initialization vector
	    var iv = CryptoJS.enc.Hex.parse(vector);
	    // create Hexa format for key to encrypt
	    var key = CryptoJS.enc.Hex.parse(aeskey);
	    // setup initializtion vector for AES Method
	    var options = {iv: iv};
	    // Encrypt data input
	    var encrypted = CryptoJS.AES.encrypt(input, key, options); 
	    // Get Base64 string of data encrypted
	    var text64 = encrypted.ciphertext.toString(CryptoJS.enc.Base64);
	    // Return string of json request data
		$('textarea#output_data').val(text64.toString());
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
 }

 /**
 * AES Decrypt 
 * ------------------------------------------------
 */
 function aesdecrypt() {
 	try {
 		$('#error').text("");
		var input = $('textarea#input_data').val();
	 	var aeskey = $('input#aeskey').val();
	 	var vector = $('input#aesvector').val();
		var iv = CryptoJS.enc.Hex.parse(vector);
	    // create Hexa format for key to encrypt
	    var key = CryptoJS.enc.Hex.parse(aeskey);
	    // setup initializtion vector for AES Medtho
	    var options = {iv: iv};
	    // Decrypt data response
	    var decrypted = CryptoJS.AES.decrypt(input, key, options);
	    // return string of data responsed
	    var output = CryptoJS.enc.Utf8.stringify(decrypted)

		$('textarea#output_data').val(output.toString());
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
 }
 /**
 * Base64 Encode 
 * ------------------------------------------------
 */
 function base64encode() {
 	try {
 		$('#error').text("");
		var input = $('textarea#input_data').val();
	    // Encrypt data response
	    var wordArray = CryptoJS.enc.Utf8.parse(input);
		var base64 = CryptoJS.enc.Base64.stringify(wordArray);
	    // return string of data responsed
		$('textarea#output_data').val(base64.toString());
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
 }
/**
 * Base64 Decode
 * ------------------------------------------------
 */
 function base64decode() {
 	try {
 		$('#error').text("");
		var input = $('textarea#input_data').val();
	    // Decrypt data response
	    var parsedWordArray = CryptoJS.enc.Base64.parse(input);
		var parsedStr = parsedWordArray.toString(CryptoJS.enc.Utf8);
	    // return string of data responsed
		$('textarea#output_data').val(parsedStr.toString());
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
 }

/**
 * RSA Encrypt
 * ------------------------------------------------
 */
function rsaEncrypt() {
	try {
 		$('#error').text("");
		var input = $('textarea#input_data').val();
		var publickey = $('textarea#publickey').val();
		var privatekey = $('textarea#privatekey').val();
	    // Encrypt data response
	    if(input.length > 245) {
	    	$('#error').text('Error: RSA data max lenght 255 characters');
	        return false;
	    }

	    if(publickey) {
	        // Encrypt with the public key...
	        var encrypt = new JSEncrypt();
	        encrypt.setPublicKey(publickey);
	        var encrypted = encrypt.encrypt(input);
	        // return string of data responsed
			$('textarea#output_data').val(encrypted.toString());
	    }else {
	    	$('#error').text('Error: RSA Public Key not existed');
	        return false;
	    }
	    
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
    
}

/**
 * RSA Decrypt
 * ------------------------------------------------
 */
function rsaDecrypt() {
	try {
 		$('#error').text("");
		var input = $('textarea#input_data').val();
		var publickey = $('textarea#publickey').val();
		var privatekey = $('textarea#privatekey').val();
	    // Encrypt data response
	    // if(input.length > 245) {
	    // 	$('#error').text('Error: RSA data max lenght 255 characters');
	    //     return false;
	    // }

	    if(privatekey) {
	        // Encrypt with the public key...
	        var decrypt = new JSEncrypt();
	        decrypt.setPrivateKey(privatekey);
          	var uncrypted = decrypt.decrypt(input);
	        // return string of data responsed
			$('textarea#output_data').val(uncrypted.toString());
	    }else {
	    	$('#error').text('Error: RSA privatekey Key not existed');
	        return false;
	    }
	    
	}
	catch(err) {
		$('#error').text('Error: ' + err.message);
	}
    
}