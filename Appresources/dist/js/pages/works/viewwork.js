$(document).ready(function() {
			$("#viewer-1").zoomer();
			});
	/*		
 $(document).on('click','.tabnav',function(e){
     alert('hi');
     $(".viewer").zoomer();
 });  */
 
 
  
//   $(document).on('click','.tabclick',function(e){
     
     
//  });
 
 $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
   $("#viewer-"+e.target.id).zoomer();
})
$(document).ready(function () {
  //Disable cut copy paste
  $('body').bind('cut copy paste', function (e) {
      e.preventDefault();
  });
 
  //Disable mouse right click
  $("body").on("contextmenu",function(e){
      return false;
  });
});
  
     