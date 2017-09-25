var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function usergroups_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        usergroups_reset_table();
        $('#usergroup #message').html(message_success);
        $('#usergroup')[0].reset();
        location.reload();
      }else {
        $('#usergroup #message').html("<span class='message-error'>" + response.message + "!</span>");
      }
    }
    else {
      $('#usergroup #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function usergroups_error(error) {
  if(typeof error === 'object'){
      error = JSON.parse(error.responseText);
  }

  if(error != null && typeof error.message !== 'undefined') {
    $('#usergroup #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#usergroup #message').html(message_error);
  }

    $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function usergroups_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('usergroup', 'post', '/settings/usergroups/edit', usergroups_success, usergroups_error);
    return false;
}

/**
 * ------------------------------------------------
 * Set data
 * ------------------------------------------------
 */
function usergroups_set_data(id) {
  $("#usergroup [name=account_id]").val($('#' + id + ' .account_id').text());
  $("#usergroup [name=group_id]").val($('#' + id + ' .group_id').text());

  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});

  var rolegroup_load_success = function(response) {
    $('#loading').modal('hide');

    // $('#roles-combobox .combobox-container').remove();

    $('#role_id').html(response);

    $("#usergroup [name=role_id]").val($('#' + id + ' .role_id').text());
  }

  $.secure_html_form ('usergroup', 'get', '/app/roles/getRolesGroup', rolegroup_load_success, role_load_error);
  
    
}

/**
 * ------------------------------------------------
 * reset table
 * ------------------------------------------------
 */
function usergroups_reset_table() {
  var data = $('#usergroup').serializeArray();
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
/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function role_load_success(response) {
    $('#loading').modal('hide');

    // $('#roles-combobox .combobox-container').remove();

    $('#role_id').html(response);

    // $('#roles-combobox .combobx').combobox();
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function role_load_error(error) {
  // if(typeof error === 'object'){
  //     error = JSON.parse(error.responseText);
  // }
  $('#role_id').html(null);

  if(error != null && typeof error.message !== 'undefined') {
    $('#usergroup #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#usergroup #message').html(message_error);
  }

  $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Load Role Box
 * ------------------------------------------------
 *
 * When usergroup box changed the role box will be reload
 */
$('#group_id').change(function() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
  $.secure_html_form ('usergroup', 'get', '/app/roles/getRolesGroup', role_load_success, role_load_error);
  return false;
});