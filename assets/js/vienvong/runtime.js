$(document).ready(function(){
  // jQuery methods go here...
  $('.birthday-datepicker').datepicker({
    format: "dd/mm/yyyy",
    language: "vi",
    endDate: '-13y',
    clearBtn: true
  });

  $('[data-toggle="tooltip"]').tooltip(); 

  $( "#account" ).submit(function( event ) {
    $('#account #submit')[0].click(function(){
     }); 
    return false;
  });

  /**
   * ----------------------------------------------
   * auto run active method
   * ----------------------------------------------
   */
  $.auto_active = function() {
  	var pathname = window.location.pathname.toLowerCase();
	
  	var patt = new RegExp(/^\/app\/user\/active\//);  	

  	if(patt.test(pathname)) {
  		active();
  	}
  	
  }

  $.auto_active();
});
