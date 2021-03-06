$('#avatar').on('change', function() {
  var file = $(this)[0].files[0];
  var validType = '/image\/png, image\/jpeg, image\/bmp/i';

  if(file.size <= 1024 * 1024 && validType.search(file.type) >= 0
    ) {
    var name = $(this).attr('name');
    var success = function(data) {
      $('#avatar64').val(data.target.result);
      $("#avatar-show").attr("src", data.target.result);
    };
    var error = null;

    getFileBase64(file, success, error);
    
    // console.log(file, json);
  }
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
    $.secure_html_form ('article', 'get', '/app/articles/filter', filter_success, filter_error);
    return false;
}

/**
 * ------------------------------------------------
 * Set data
 * ------------------------------------------------
 */
function articles_set_data(id) {
  $("#article [name=name]").val($('#' + id + ' .name').text());
  $("#article [name=status]").val($('#' + id + ' .status').text());
  $("#article [name=id]").val(id);
}

/**
 * ------------------------------------------------
 * reset table
 * ------------------------------------------------
 */
function articles_reset_table() {
  var data = $('#article').serializeArray();
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
function redact_success(response) {
    $('#loading').modal('hide');

    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        articles_reset_table();
        $('#article #message').html(message_success);
        // $('#article')[0].reset();
        window.location.href = "/app/articles";
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
function redact_error(error) {
  if(typeof error === 'object'){
      console.log(error);
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
 * Redact Article
 * ------------------------------------------------
 */
function articles_redact() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_html_form ('article', 'post', '/content/article/redact', redact_success, redact_error);
    return false;
}