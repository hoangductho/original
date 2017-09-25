var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function groups_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        groups_reset_table();
        $('#group #message').html(message_success);
        $('#group')[0].reset();
        location.reload();
      }else {
        $('#group #message').html("<span class='message-error'>" + response.message + "!</span>");
      }
    }
    else {
      $('#group #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function groups_error(error) {
  if(typeof error === 'object'){
      error = JSON.parse(error.responseText);
  }

  if(error != null && typeof error.message !== 'undefined') {
    $('#group #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#group #message').html(message_error);
  }

    $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function groups_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('group', 'post', '/settings/group/edit', groups_success, groups_error);
    return false;
}

/**
 * ------------------------------------------------
 * Set data
 * ------------------------------------------------
 */
function groups_set_data(id) {
  $("#group [name=name]").val($('#' + id + ' .group-name').text());
  $("#group [name=description]").val($('#' + id + ' .group-description').text());
  $("#group [name=status]").val($('#' + id + ' .group-status').text());
  $("#group [name=type]").val($('#' + id + ' .group-type').text());
  $("#group [name=privacy]").val($('#' + id + ' .group-privacy').text());
  $("#group [name=region]").val($('#' + id + ' .group-region').text());
  $("#group [name=id]").val(id);
}

/**
 * ------------------------------------------------
 * reset table
 * ------------------------------------------------
 */
function groups_reset_table() {
  var data = $('#group').serializeArray();
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