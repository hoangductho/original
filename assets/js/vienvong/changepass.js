var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function changepass_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        $('#changepass #message').html(message_success);
        $('#changepass')[0].reset();
      }else {
        $('#changepass #message').html("<span class='message-error'>" + response.message + "!</span>");
      }

      window.location.href ='/app/user/signout';
    }
    else {
      $('#changepass #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function changepass_error(error) {
  if(typeof error === 'object'){
      error = JSON.parse(error.responseText);
  }

  if(error != null && typeof error.message !== 'undefined') {
    $('#changepass #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#changepass #message').html(message_error);
  }

    $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function changepass_edit() {
  var form = $('#changepass').serializeArray();
  var json = {};      
  $.each(form, function(index, obj){
    json[obj.name] = obj.value;
  });

  if (json.new_password != json.retype_password) {
    $('#changepass #message').html("<span class='message-error'>Retype Password Invalid!</span>");
  }
  else {
    $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('changepass', 'post', '/user/profile/changepassword', changepass_success, changepass_error);
  }

  return false;
}