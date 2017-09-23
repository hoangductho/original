$(document).ready(function(){
  // jQuery methods go here...
  $('.birthday-datepicker').datepicker({
    format: "dd/mm/yyyy",
    language: "vi",
    endDate: '-13y',
    clearBtn: true
  });

  $('.datepicker').datepicker({
    format: "dd/mm/yyyy",
    language: "vi",
    clearBtn: true
  });

  $('.datetimepicker').datetimepicker({
    format: "YYYY/MM/DD HH:mm:ss",
    icons: {
        time: "fa fa-clock-o",
        date: "fa fa-calendar",
        previous: "fa fa-chevron-left",
        next: "fa fa-chevron-right",
        up: "fa fa-arrow-up",
        down: "fa fa-arrow-down"
    },
    // inline: true,
    // locale: "vn",
    // sideBySide: true,
    // showClear: true
  });

  $('[data-toggle="tooltip"]').tooltip(); 

  $( "#account" ).submit(function( event ) {
    $('#account #submit')[0].click(function(){
     }); 
    return false;
  });

  /**
   * ----------------------------------------------
   * Render EditorMD
   * ----------------------------------------------
   */
  $(function() {
    editormdCreate('editormd');
  });

  /**
   * ----------------------------------------------
   * render datatables
   * ----------------------------------------------
   */
  $.datatableRender = function(id) {
    if($('#' + id).length) {
      $('#' + id).DataTable();
    }
  }
  
  $.datatableRender('datatable');
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
