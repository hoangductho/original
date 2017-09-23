$(document).ready(function(){
  // jQuery methods go here...
  /**
   * ----------------------------------------------
   * Auto send form data
   * ----------------------------------------------
   *
   * @param form_id html id of form
   * @param method name of method to send
   * @param url url services accept
   * @param success callback funtion when successful
   * @param error callback function when error
   *
   */
  $.auto_send_form = function(form_id, method, url, success, error) {
    var data = $('#'+form_id).serializeArray();
    var json = {};
    $.each(data, function(index, obj){
      json[obj.name] = obj.value;
    });

    $.ajax({
      type: method,
      url: url,
      data: json,
      dataType: 'json',
      // contentType: 'application/json; charset=UTF8',
      success: success,
      error: error,
    });
  }
  // -----------------------------------------------------------------
  /**
   * ----------------------------------------------
   * Send form with Secure
   * ----------------------------------------------
   *
   * @param form_id html id of form
   * @param method name of method to send
   * @param url url services accept
   * @param success callback funtion when successful
   * @param error callback function when error
   *
   */
  $.secure_send_form = function(form_id, method, url, success, error) {
    var form = $('#'+form_id).serializeArray();
    var json = {};
    var aeskey = aesKeyInit();
    var data = {};

    $.each(form, function(index, obj){
      json[obj.name] = obj.value;
    });

    data.encrypted = aesEncrypt(json, aeskey);
    data.encrypt = rsaEncryptData(aeskey.key + '/' + aeskey.iv);
    data.expired = parseInt(readCookie('expired_key'));

    $.ajax({
      type: method,
      beforeSend: function(request) {
        request.setRequestHeader("Session_token", readCookie('session_token'));
      },
      url: url,
      data: data,
      dataType: 'json',
      // contentType: 'application/json; charset=UTF8',
      success: success,
      error: error,
    });
  }
  // -----------------------------------------------------------------
  /**
   * ----------------------------------------------
   * Send form with Secure
   * ----------------------------------------------
   *
   * @param form_id html id of form
   * @param method name of method to send
   * @param url url services accept
   * @param success callback funtion when successful
   * @param error callback function when error
   *
   * Return data is html string
   */
  $.secure_html_form = function(form_id, method, url, success, error) {
    var form = $('#'+form_id).serializeArray();
    var json = {};
    var aeskey = aesKeyInit();
    var data = {};

    $.each(form, function(index, obj){
      json[obj.name] = obj.value;
    });

    data.encrypted = aesEncrypt(json, aeskey);
    data.encrypt = rsaEncryptData(aeskey.key + '/' + aeskey.iv);
    data.expired = parseInt(readCookie('expired_key'));

    $.ajax({
      type: method,
      beforeSend: function(request) {
        request.setRequestHeader("Session_token", readCookie('session_token'));
      },
      url: url,
      data: data,
      // dataType: 'json',
      // contentType: 'application/json; charset=UTF8',
      success: success,
      error: error,
    });
  }
  // -----------------------------------------------------------------
  /**
   * ----------------------------------------------
   * Compare data between 2 elements
   * ----------------------------------------------
   * 
   * function to compare content of 2 elements
   * @param element_id html id of the goal element 
   */

  $.fn.compare = function(element_id) {
    var data = $(this).val();
    var compare = $('#'+element_id).val();

    if(data == compare) {
      return true;
    }

    return false;
  }
});
