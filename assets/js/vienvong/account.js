var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

// jQuery methods go here...
/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function signup_success(response) {
  	$('#loading').modal('hide');
  	
  	if(typeof response != 'object'){
  		response = JSON.parse(response);
  	}

  	if(response != null) {
  		if(response.status) {
			$('#account #message').html(message_success);
			
			// similar behavior as an HTTP redirect
			window.location.replace("/app/User/signin");
		}else {
			$('#account #message').html("<span class='message-error'>" + response.message + "!</span>");
		}
  	}
  	else {
  		$('#account #message').html(message_error);
  	}
	
}

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function signin_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
      $('#account #message').html(message_success);
      console.log(response);
      createCookie('session_token', response.message.token);
      
      // similar behavior as an HTTP redirect
      //window.location.replace("/app/User/signin");
    }else {
      $('#account #message').html("<span class='message-error'>" + response.message + "!</span>");
    }
    }
    else {
      $('#account #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function signup_error(error) {
	if(typeof error != 'object'){
  		error = JSON.parse(error);
  	}

	if(error != null && typeof error.message !== 'undefined') {
		$('#account #message').html("<span class='message-error'>" + error.message + "!</span>");
	}else {
		$('#account #message').html(message_error);
	}

  	$('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function signup() {
	$('#loading').modal({backdrop: 'static', keyboard: false, show: true});
  	$.secure_send_form ('account', 'post', '/user/account/signup', signup_success, signup_error);
  	return false;
}

/**
 * ------------------------------------------------
 * Active submit form
 * ------------------------------------------------
 */
function active() {
	$('#loading').modal({backdrop: 'static', keyboard: false, show: true});
  	$.secure_send_form ('account', 'post', '/user/account/active', signup_success, signup_error);
  	return false;
}

/**
 * ------------------------------------------------
 * Resend active code submit form
 * ------------------------------------------------
 */
function resend() {
	$('#loading').modal({backdrop: 'static', keyboard: false, show: true});
  	$.secure_send_form ('account', 'post', '/user/account/resend', signup_success, signup_error);
  	return false;
}
/**
 * ------------------------------------------------
 * Reset password submit form
 * ------------------------------------------------
 */
function reset() {
	$('#loading').modal({backdrop: 'static', keyboard: false, show: true});
  	$.secure_send_form ('account', 'post', '/user/account/reset', signup_success, signup_error);
  	return false;
}
/**
 * ------------------------------------------------
 * Forgot password submit form
 * ------------------------------------------------
 */
function forgot() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('account', 'post', '/user/account/forgot', signup_success, signup_error);
    return false;
}
/**
 * ------------------------------------------------
 * Sign In submit form
 * ------------------------------------------------
 */
function signin() {
	$('#loading').modal({backdrop: 'static', keyboard: false, show: true});
  	$.secure_send_form ('account', 'post', '/user/account/signin', signin_success, signup_error);
  	return false;
}
