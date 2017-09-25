var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function roles_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        roles_reset_table();
        $('#role #message').html(message_success);
        $('#role')[0].reset();
        location.reload();
      }else {
        $('#role #message').html("<span class='message-error'>" + response.message + "!</span>");
      }
    }
    else {
      $('#role #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function roles_error(error) {
  if(typeof error === 'object'){
      error = JSON.parse(error.responseText);
  }

  if(error != null && typeof error.message !== 'undefined') {
    $('#role #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#role #message').html(error.message);
  }

    $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function roles_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('role', 'post', '/settings/role/edit', roles_success, roles_error);
    return false;
}

/**
 * ------------------------------------------------
 * Set data
 * ------------------------------------------------
 */
function roles_set_data(id) {
  $("#role [name=name]").val($('#' + id + ' .name').text());
  $("#role [name=status]").val($('#' + id + ' .status').text());
  $("#role [name=group_id]").val($('#' + id + ' .group_id').text());
  $("#role [name=id]").val(id);
}

/**
 * ------------------------------------------------
 * reset table
 * ------------------------------------------------
 */
function roles_reset_table() {
  var data = $('#role').serializeArray();
  var json = {};
  $.each(data, function(index, obj){
    json[obj.name] = obj.value;
  });

  if(json.id == '0') {

  }
  else {
    var content = '';
    switch (json.status) {
      case '0':
          content = '<span hidden="" class="status">' +json.status+ '</span><i class="fa fa-close error" aria-hidden="true"></i>';
          break;
      case '1':
          content = '<span hidden="" class="status">' +json.status+ '</span><i class="fa fa-check success" aria-hidden="true"></i>';
          break;
      case '2':
          content = '<span hidden="" class="status">' +json.status+ '</span><i class="fa fa-lock error" aria-hidden="true"></i>';
          break;
      
      default:
          break;
    }
    $('#' +json.id+ ' .status-box').html(content);
  }
}