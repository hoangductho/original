// Takes a data URI and returns the Data URI corresponding to the resized image at the wanted size.
function resizedataURL(datas, wantedWidth, wantedHeight, targetID)
    {
        // We create an image to receive the Data URI
        var img = document.createElement('img');

        // When the event "onload" is triggered we can resize the image.
        img.onload = function()
            {        
                // We create a canvas and get its context.
                var canvas = document.createElement('canvas');
                var ctx = canvas.getContext('2d');

                // We set the dimensions at the wanted size.
                canvas.width = wantedWidth;
                canvas.height = wantedHeight;

                // We resize the image with the canvas method drawImage();
                ctx.drawImage(this, 0, 0, wantedWidth, wantedHeight);

                var dataURI = canvas.toDataURL();

                $('#' + targetID).val(dataURI);

                /////////////////////////////////////////
                // Use and treat your Data URI here !! //
                /////////////////////////////////////////
            };

        // We put the Data URI in the image's src attribute
        img.src = datas;
    }
// Use it like that : resizedataURL('yourDataURIHere', 50, 50);

// crop image function
var cropper;
function cropperImgData(data64, elementID, targetID) {
  $("#"+elementID).attr("src", data64);

  var image = document.getElementById(elementID);
  if(cropper) {
    cropper.destroy();
  }
  cropper = new Cropper(image, {
    aspectRatio: 9 / 9,
    background: false,
    autoCropArea: 1,
    zoomOnWheel: false,
    // modal: false,
    cropBoxResizable: false,
    autoCrop: true,
    cropend: function(e) {
      // Upload cropped image to server if the browser supports `HTMLCanvasElement.toBlob`
      this.cropper.getCroppedCanvas().toBlob(function (blob) {
        var formData = new FormData();

        formData.append('croppedImage', blob);

        var reader = new FileReader();

        reader.onload = function(){
          // here you'll call what to do with the base64 string result
          resizedataURL(this.result, 200, 200, targetID);
        };

        reader.readAsDataURL(blob);

      });
    },
    crop: function(e) {
      if($('#' + targetID).val().length == 0) {
        this.cropper.getCroppedCanvas().toBlob(function (blob) {
          var formData = new FormData();

          formData.append('croppedImage', blob);

          var reader = new FileReader();

          reader.onload = function(){
            // here you'll call what to do with the base64 string result
            resizedataURL(this.result, 200, 200, targetID);
          };

          reader.readAsDataURL(blob);

        });
      }
    }
  });
}
// end crop function

$('#avatar').on('change', function() {
  var file = $(this)[0].files[0];

  var validType = '/image\/png, image\/jpeg, image\/jpg, image\/bmp/i';

  if(validType.search(file.type) >= 0) {
    var name = $(this).attr('name');
    var success = function(data) {
      $('#avatar-save').prop('disabled', false);
      cropperImgData(data.target.result, 'avatar-cropper', 'avatar64');
    };
    var error = null;

    getFileBase64(file, success, error);
  }
});

var message_success = "<span class='message-success'>Thành công!</span>";
var message_error = "<span class='message-error'>Xảy ra sự cố. Xin vui lòng thử lại!</span>";
var form_id = 'profile'

/**
 * ------------------------------------------------
 * Callback function when success
 * ------------------------------------------------
 */
function profiles_success(response) {
    $('#loading').modal('hide');
    
    if(typeof response != 'object'){
      response = JSON.parse(response);
    }

    if(response != null) {
      if(response.status) {
        $('#'+form_id+' #message').html(message_success);
        // $('#profile')[0].reset();
      }else {
        $('#'+form_id+' #message').html("<span class='message-error'>" + response.message + "!</span>");
      }

      location.reload();
    }
    else {
      $('#'+form_id+' #message').html(message_error);
    }
  
}

/**
 * ------------------------------------------------
 * Callback function when error
 * ------------------------------------------------
 */
function profiles_error(error) {
  if(typeof error === 'object'){
      error = JSON.parse(error.responseText);
  }

  if(error != null && typeof error.message !== 'undefined') {
    $('#'+form_id+' #message').html("<span class='message-error'>" + error.message + "!</span>");
  }else {
    $('#'+form_id+' #message').html(message_error);
  }

    $('#loading').modal('hide');
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function profiles_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    $.secure_send_form ('profile', 'post', '/user/profile/edit', profiles_success, profiles_error);
    return false;
}
/**
 * Toggle form edit
 */
function profile_editing() {
	$('#profile-info').toggle();
	$('#profile').toggle();
}

/**
 * ------------------------------------------------
 * Singup submit form
 * ------------------------------------------------
 */
function avatar_edit() {
  $('#loading').modal({backdrop: 'static', keyboard: false, show: true});
    form_id = 'change-avatar'
    $.secure_send_form ('change-avatar', 'post', '/user/profile/changeavatar', profiles_success, profiles_error);
    return false;
}
