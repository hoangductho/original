$('#avatar').on('blur', function() {
	$("#avatar-show").attr("src",$('#avatar').val());
});

var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";
/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function filter_success(response) {
    $('#loading').modal('hide');

    $('#list_articles').html(response);

    $.datatableRender('datatable');

    // if(typeof response != 'object'){
    //   response = JSON.parse(response);
    // }

    // if(response != null) {
    //   if(response.status) {
    //     articles_reset_table();
    //     $('#article #message').html(message_success);
    //     $('#article')[0].reset();
    //   }else {
    //     $('#article #message').html("<span class='message-error'>" + response.message + "!</span>");
    //   }
    // }
    // else {
    //   $('#article #message').html(message_error);
    // }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function filter_error(error) {
  // if(typeof error === 'object'){
  //     error = JSON.parse(error.responseText);
  // }

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
function articles_filter() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_html_form ('article', 'get', '/app/writing/filter', filter_success, filter_error);
    return false;
}

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function articles_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        $('#article #message').html(message_success);
        // $('#article')[0].reset();
        window.location.href = "/app/writing/list";
      }else {
        $('#article #message').html("<span class='message-error'>" + response.message + "!</span>");
      }
    }
    else {
      $('#article #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function articles_error(error) {

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
function articles_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('article', 'post', '/content/article/edit', articles_success, articles_error);
    return false;
}

/**
 * ------------------------------------------------
 * Markdown Render
 * ------------------------------------------------
 */

markdown_render('md_content','html_content');