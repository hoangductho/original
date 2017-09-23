var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function profiles_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        $('#profile #message').html(message_success);
        $('#profile')[0].reset();
      }else {
        $('#profile #message').html("<span class='message-error'>" + response.message + "!</span>");
      }

      location.reload();
    }
    else {
      $('#profile #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function profiles_error(error) {
  if(typeof error === 'object'){
      error = JSON.parse(error.responseText);
  }

  if(error != null && typeof error.message !== 'undefined') {
    $('#profile #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#profile #message').html(message_error);
  }

    $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function profiles_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('profile', 'post', '/user/profile/edit', profiles_success, profiles_error);
    return false;
}
/**
 * Toggle form edit
 */
function profile_editing() {
	$('#profile-info').toggle();
	$('#profile').toggle();
}