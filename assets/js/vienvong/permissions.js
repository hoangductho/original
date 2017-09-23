var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function permissions_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        permissions_reset_table();
        $('#permission #message').html(message_success);
        $('#permission')[0].reset();
      }else {
        $('#permission #message').html("<span class='message-error'>" + response.message + "!</span>");
      }
    }
    else {
      $('#permission #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function permissions_error(error) {
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
function permissions_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('permission', 'post', '/settings/permission/edit', permissions_success, permissions_error);
    return false;
}

/**
 * ------------------------------------------------
 * Set data
 * ------------------------------------------------
 */
function permissions_set_data(id) {
  $("#permission [name=name]").val($('#' + id + ' .name').text());
  $("#permission [name=status]").val($('#' + id + ' .status').text());
  $("#permission [name=id]").val(id);

  if($('#' + id + ' .readable').text() == 1) {
    $("#permission [name=readable]").prop( "checked", true );
  }
  if($('#' + id + ' .writable').text() == 1) {
    $("#permission [name=writable]").prop( "checked", true );
  }
  if($('#' + id + ' .executable').text() == 1) {
    $("#permission [name=executable]").prop( "checked", true );
  }
}

/**
 * ------------------------------------------------
 * reset table
 * ------------------------------------------------
 */
function permissions_reset_table() {
  var data = $('#permission').serializeArray();
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