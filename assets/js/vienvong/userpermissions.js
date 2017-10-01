var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";

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
    $('#userpermission #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#userpermission #message').html(message_error);
  }

  $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Load Role Box
 * ------------------------------------------------
 *
 * When userpermission box changed the role box will be reload
 */
$('#group_id').change(function() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
  $.secure_html_form ('userpermission', 'get', '/app/roles/getRolesGroup', role_load_success, role_load_error);
  return false;
});

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function filter_success(response) {
    $('#loading').modal('hide');

    $('#list_userpermissions').html(response);

    $.datatableRender('datatable');
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function filter_error(error) {
  if(error != null && typeof error.message !== 'undefined') {
    $('#userpermission #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#userpermission #message').html(message_error);
  }

    $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function userpermissions_filter() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_html_form ('userpermission', 'get', '/app/userpermissions/filter', filter_success, filter_error);
    return false;
}