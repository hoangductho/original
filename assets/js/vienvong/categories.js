var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function categories_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        categories_reset_table();
        $('#category #message').html(message_success);
        $('#category')[0].reset();
      }else {
        $('#category #message').html("<span class='message-error'>" + response.message + "!</span>");
      }
    }
    else {
      $('#category #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function categories_error(error) {
  if(typeof response === 'object'){
      error = JSON.parse(response.responseText);
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
function categories_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('category', 'post', '/settings/category/edit', categories_success, categories_error);
    return false;
}

/**
 * ------------------------------------------------
 * Set data
 * ------------------------------------------------
 */
function categories_set_data(id) {
  $("#category [name=name]").val($('#' + id + ' .name').text());
  $("#category [name=status]").val($('#' + id + ' .status').text());
  $("#category [name=id]").val(id);
}

/**
 * ------------------------------------------------
 * reset table
 * ------------------------------------------------
 */
function categories_reset_table() {
  var data = $('#category').serializeArray();
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