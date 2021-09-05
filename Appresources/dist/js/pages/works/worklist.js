$(function () {
  var status=$('#workfilter').val();
 console.log(status);
  var url = $('#worklist').data('controller');  
  var urlallusers = url+'getallworks';
  window.setTimeout(function(){
    $('.alert').hide()
  },5000);
  getworkbystatus(urlallusers,status)

});
function getworkbystatus(url,status)
{
var formData={};
formData[csrf_token_name]=  csrf_token;
formData['status']=status;

$('#worklist').DataTable({
   "processing": false, 
   "serverSide": true, 
  "destroy": true,

  "order": [], 
   "aoColumnDefs": [
     { 'bSortable': false, 'aTargets': [0,4,5,6 ] }
  ],

   "ajax": {
       "url": url,
       "type": "POST",
        data:formData
   },
       'columns': [
            {'data' : 'slno', 'width': '5%'},
            {'data' :'workid','width': '5%'},
            {'data' : 'workname','width': '30%'},
           {'data' : 'username','width': '8%'},
            {'data' : 'completiondate','width': '12%'},
            {'data' : 'status','width': '8%'},
            {'data' : 'action','width': '30%'},                
           ]
});
}
$(document).on('change','#workfilter',function(e){
  //table.destroy();
   var status=$(this).val();
 
   var url = $('#worklist').data('controller');  
   var urlallusers = url+'getallworks';
   //alert(status);
 
   getworkbystatus(urlallusers,status);
   
  
}); 
$(document).on('click','#workDeletebutton',function(e){
  var controller = $(this).data('controller');
  var id = $(this).data('id');
  var formData = {};
    formData['id']=  id;
    //alert(formData['id']);
    formData[csrf_token_name]=  csrf_token;
    if(formData.id !='') {
    swal({
     title:"Are you sure?",text:"Do you really want to delete it", type:"warning",showCancelButton:!0,
     confirmButtonColor:"#DA4453", confirmButtonText:"Yes, delete it!", cancelButtonText:"No, cancel!",
     closeOnConfirm:!1,closeOnCancel:1},function(isConfirm){
       if(isConfirm)
         {
            $.ajax({
       type: 'POST',
       url: controller+'deleteWork',
       data: formData,
       success: function(data) {
         // datr = JSON.parse(data);
         console.log(formData['id']);
         if(data == "success") {
           swal("Deleted!","You have deleted a work!","success")
           window.location.href = controller;
         }else if(data == "failure") {
           swal("Error!","Something went Wrong!. Try Again","error")
         }
         }
          });
         }
                 //isConfirm?swal("Deleted!","Your imaginary file has been deleted.","success"):swal("Cancelled","Your imaginary file is safe :)","error")
     })
    }

});
$(document).on('click','#workRestorebutton',function(e){
  var controller = $(this).data('controller');
 var id = $(this).data('id');
 var formData = {};
   formData['id']=  id;
   formData[csrf_token_name]=  csrf_token;
   if(formData.id !='') {
   swal({
    title:"Are you sure?",text:"Do you really want to restore it", type:"warning",showCancelButton:!0,
    confirmButtonColor:"#DA4453", confirmButtonText:"Yes, restore it!", cancelButtonText:"No, cancel!",
    closeOnConfirm:!1,closeOnCancel:1},function(isConfirm){
      if(isConfirm)
        {
           $.ajax({
      type: 'POST',
      url: controller+'restoreWorks',
      timeout:8000,
      data: formData,
      success: function(data) {
        // datr = JSON.parse(data);
        console.log(formData['id']);
        if(data == "success") {
          swal("Restored!","You have restored work","success")
          window.location.href = controller;
        }else if(data == "failure") {
          swal("Error!","Something went Wrong!. Try Again","error")
        }
        }
         });
        }
              
    })
   }
  
 });
 

