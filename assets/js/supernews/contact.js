var message_success = "<span class='message-success'>Cảm ơn đóng góp của bạn. Góp ý của bạn đã được gửi tới ban quản trị!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function commentform_success(response) {
    $('#commentform button').prop('disabled', false);
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        $('#commentform #message').html(message_success);
        $('#commentform')[0].reset();
        // location.reload();
      }else {
        $('#commentform #message').html("<span class='message-error'>" + response.message + "!</span>");
      }
    }
    else {
      $('#commentform #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function commentform_error(error) {
  $('#commentform button').prop('disabled', false);

  if(typeof error === 'object'){
      error = JSON.parse(error.responseText);
  }

  if(error != null && typeof error.message !== 'undefined') {
    $('#commentform #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#commentform #message').html(message_error);
  }
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function commentform_send() {
  $('#commentform button').prop('disabled', true);
  $.secure_send_form ('commentform', 'post', '/content/respond/send', commentform_success, commentform_error);
    return false;
}

/**
 * ------------------------------------------------
 * Set data
 * ------------------------------------------------
 */
function commentform_set_data(id) {
  $("#commentform [name=name]").val($('#' + id + ' .name').text());
  $("#commentform [name=status]").val($('#' + id + ' .status').text());
  $("#commentform [name=id]").val(id);
}