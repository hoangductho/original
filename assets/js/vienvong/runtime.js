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
   * Render EditorMD
   * ----------------------------------------------
   */
  $(function() {
    if($('#editormd').length) {
      var editor = editormd("editormd", {
        path              : "../lib/", // Autoload modules mode, codemirror, marked... dependents libs path
        width             : "100%",
        height            : 640,
        path              : '/assets/editormd/lib/',
        lineNumbers       : true,
        tex               : true,
        tocm              : true,
        emoji             : true,
        taskList          : true,
        codeFold          : true,
        searchReplace     : true,
        htmlDecode        : "style,script,iframe",
        flowChart         : true,
        sequenceDiagram   : true,
      });
    }
  });

  /**
   * ----------------------------------------------
   * render datatables
   * ----------------------------------------------
   */
  $('#datatable').DataTable();

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
