var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function regions_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        regions_reset_table();
        $('#region #message').html(message_success);
        $('#region')[0].reset();
        location.reload();
      }else {
        $('#region #message').html("<span class='message-error'>" + response.message + "!</span>");
      }
    }
    else {
      $('#region #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function regions_error(error) {
  if(typeof error === 'object'){
      error = JSON.parse(error.responseText);
  }

  if(error != null && typeof error.message !== 'undefined') {
    $('#article #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#article #message').html(message_error);
  }

    $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function regions_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('region', 'post', '/settings/region/edit', regions_success, regions_error);
    return false;
}

/**
 * ------------------------------------------------
 * Set data
 * ------------------------------------------------
 */
function regions_set_data(id) {
  $("#region [name=name]").val($('#' + id + ' .name').text());
  $("#region [name=status]").val($('#' + id + ' .status').text());
  $("#region [name=id]").val(id);
}

/**
 * ------------------------------------------------
 * reset table
 * ------------------------------------------------
 */
function regions_reset_table() {
  var data = $('#region').serializeArray();
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