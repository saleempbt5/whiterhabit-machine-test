$(document).ready(function() {
  $(".savethisbtn").hide();
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


$(document).on('click','.savethisbtn',function(e){
  //alert($(this).data('id'));
  $('.overlay').removeClass('invisible');
  console.log($(this));
  var controller = $(this).data('controller');
  var id = $(this).data('id');
  var wid=$(this).data('wid');
  var tabData = {};
  tabData['id']=  id;
  tabData['work']= $('#work-'+id).val();
  tabData['wid']=wid
  
  
  
  if(tabData['work']=="")
  {   
      alert("Add text in textarea");
      var msg="This field is required";
      $('#work-'+id).addClass('is-invalid');
      $('.overlay').addClass('invisible');
  }
  else{

    $('.nav-tabs .nav-link.active').closest('li').prevAll('li').find('.nav-link').removeClass('disabled');
    $('.nav-tabs .nav-link.active').closest('li').nextAll('li').find('.nav-link').removeClass('disabled');
  tabData[csrf_token_name]=  csrf_token;
  if(tabData.id !='') {
  $.ajax({
  type: 'POST',
  url: controller+'saveWork',
  data: tabData,
  success: function(data) {
    datr = JSON.parse(data);
    console.log(datr);
     if(datr.action == "success"){ 
       
      if(datr.pagesavedsts==true) 
      {
        $('#footercontainer').html('<button type="submit" class="btn btn-success float-right upall" id="upload" data-id='+tabData['wid']+'  data-controller='+controller+' >Upload</button');
      } 
      else{
        $('#footercontainer').html('');
      }    
      swal("Success","Saved Successfully","success")
      
      $('.blink').hide();
       $('.overlay').addClass('invisible');
      // $('.tab-content > .tab-pane.active').closest('.tab-pane').toggleClass('active').next().toggleClass('active').find('.viewer').zoomer();
      // $('.nav-tabs .nav-link.active').removeClass('active').addClass('disabled').closest('li').next('li').find('.nav-link').removeClass('disabled').addClass('active');
     
     
     }
     else if(datr.action == "failure") {
      swal("Error!","Something went Wrong!. Try Again","error")
  }
 
   }
 });
}
} 
});

$(document).on('keydown','.txtcls',function(e)
{
  var id = $(this).data('id'); 
  $('#work-'+id).removeClass('is-invalid');
  $(".savethisbtn").show();
  $('#nonvisible').removeClass('invisible');
  $('.blink').fadeOut(500);
    $('.blink').fadeIn(500);
    $('.upall').hide();
    $('.blink').text("Please save the work").css("color","black");
    $('.nav-tabs .nav-link.active').closest('li').prevAll('li').find('.nav-link').addClass('disabled');
    $('.nav-tabs .nav-link.active').closest('li').nextAll('li').find('.nav-link').addClass('disabled');

});

$(document).on('click','.upall',function(e){
  var id = $(this).data('id');
  var controller = $(this).data('controller');
  $('.overlay').removeClass('invisible');
  var tabData = {};
  tabData['wid']=  id;
  tabData[csrf_token_name]=  csrf_token;
  console.log(tabData);
  if(tabData.wid !=''){
    $.ajax({
    type: 'POST',
    url: controller+'uploadAll',
    data: tabData,
    
    success: function(data){
      datr = JSON.parse(data);
      console.log(datr);
       if(datr.action == "success") { 
      
          swal("Success",datr.msg,"success");
          window.setTimeout(function(){
            window.location=controller;
          },2000)
        $('.overlay').addClass('invisible');
       }else if(datr.action == "failure") {
         swal("Error!",datr.msg,"error")
       }
   
     }
   });
  }
  
});
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