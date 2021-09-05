$(function () {
    var status=$('#usersfilter').val();
   
    var url = $('#userlist').data('controller');  
    var urlallusers = url+'readAllusers';
    window.setTimeout(function(){
      $('.alert').hide()
    },5000);
    getusersbystatus(urlallusers,status)


});
function getusersbystatus(url,status)
{
  var formData={};
  formData[csrf_token_name]=  csrf_token;
  formData['status']=status;

 $('#userlist').DataTable({
     "processing": false, 
     "serverSide": true, 
    "destroy": true,

    "order": [], 
     "aoColumnDefs": [
       { 'bSortable': false, 'aTargets': [ 0,3,4 ] }
    ],
     "ajax": {
         "url": url,
         "type": "POST",
          data:formData
     },
         'columns': [
              {'data' : 'slno'},
              {'data' : 'name'},
             {'data' : 'username'},
              {'data' : 'role'},
              {'data' : 'actions'}                 
             ]
 });
}
function restoreuser(url,status)
  {
  var formData={};
  formData[csrf_token_name]=  csrf_token;
  formData['status']=status;
   
 $('#userlist').DataTable({
     "processing": false, 
     "serverSide": true, 
    "destroy": true,

    "order": [], 
     "aoColumnDefs": [
       { 'bSortable': false, 'aTargets': [ 0,3,4 ] }
    ],
     "ajax": {
         "url": url,
         "type": "POST",
          data:formData
     },
         'columns': [
              {'data' : 'slno'},
              {'data' : 'name'},
             {'data' : 'username'},
              {'data' : 'role'},
              {'data' : 'actions'}                 
             ]
 });
}



    $(function () {
    $("#useraddform").validate({
        
        rules: {
          username: {
            required: true,
            
          },
          userphone: "required",
        
        useremail: {
            required: true,
            email: true
          },
          userrole: {
            required: true
        },
        userpswdid:{
            required: true,
            minlength:4,
        },
        usercpswdid:{
            required: true,
            equalTo : "#userpswdid"
        },
      },
        messages: {
            username: {
            required: "Please provide name"
      
          },
          userphone: "Please provide phone number",
          userpswdid:{
          
            minlength:"password length must be minimum 4"
          },
          usercpswdid:{
            equalTo :"password does not match"
          },
          required:"Password does not match"
          }
         });
         
      
 
  

  });
  $(document).on('click','#EditButton',function(e){
    var controller = $(this).data('controller');
   
    var id = $(this).data('id');
     var formData = {};
      formData['id']=  id;
      formData[csrf_token_name]=  csrf_token;
      if(formData.id !='') {
          $.ajax({
         type: 'POST',
         url: controller+'editmodal',
         data: formData,
         success: function(data) {
            datr = JSON.parse(data);
            console.log(datr);
             if(datr.action == "success") {  
               console.log(datr.returnresult)           
                $('#edituname').val(datr.returnresult.name);
                $('#edituphone').val(datr.returnresult.phoneno);
                $('#edituemail').val(datr.returnresult.email);
                $('#editurole').val(datr.returnresult.roleid);
                $('#edituadd').val(datr.returnresult.address);
                $('#idusr').val(datr.returnresult.id);
                $('#uname').text('Username: '+datr.returnresult.username);
                // $('#ediconclass').val(datr.returndata.iconclass);
                // $('#edmenustatus').select2().val(datr.returndata.status).trigger("change");
                // $('#edmenuid').val(datr.returndata.id);
             }else if(datr.action == "failure") {
               swal("Error!","Something went Wrong!. Try Again","error")
           }
         
           }
            });
 
 
      }
 
 });
 $(function () {
  $("#usereditform").validate({
      
      rules: {
        edituname: {
          required: true,
          
        },
        edituphone: "required",
     
        edituemail: {
          required: true,
          email: true
        },
        editupswdid:{
          required: true,
          minlength:4,
      },
      editurole: {
          required: true
      },
    },
      messages: {
          username: {
          required: "Please provide name"
    
        },
        userphone: "Please provide phone number",
        editupswdid:{
          minlength:"password length must be minimum 4"
        }
        }
       });
       
    

    });

$(function () {
  $("#resetuserpswd").validate({
      rules:{
        resetupswdid:{
          required: true,
          minlength:4,
      },
    
     
      resetucpswdid:{
          required: true,
          
          equalTo : "#resetupswdid"
      },
    },
      messages: {
        resetupswdid: {
          minlength: "Minimum 4 length is required"
    
        },
        resetucpswdid: 
        {
          required:"This field is required",
          equalTo :"password does not match"
        }
        
        }
       });
       
    



});
$(document).on('click','#resetbutton',function(e){
  var controller = $(this).data('controller');
 
  var id = $(this).data('id');
   var formData = {};
    formData['id']=  id;
    formData[csrf_token_name]=  csrf_token;
    if(formData.id !='') {
        $.ajax({
       type: 'POST',
       url: controller+'aj_resetpassword',
       data: formData,
       success: function(data) {
          datr = JSON.parse(data);
          console.log(datr);
           if(datr.action == "success") {  
             console.log(datr.returnresult)           
              //console.log( formData['id']);
              
              
              
              //$('#resetucpswdid').val(datr.returnresult.id);
              $('#uid').val(datr.returnresult.id);
              $('#reuname').text('Username: '+datr.returnresult.username);
           }else if(datr.action == "failure") {
             swal("Error!","Something went Wrong!. Try Agian","error")
         }
       
         }
          });


    }

});
$(document).on('click','#userdeletebutton',function(e){
  var controller = $(this).data('controller');
  var id = $(this).data('id');
  var formData = {};
    formData['id']=  id;
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
       url: controller+'deleteUsr',
       data: formData,
       success: function(data) {
         // datr = JSON.parse(data);
         console.log(formData['id']);
         if(data == "success") {
           swal("Deleted!","You have deleted a user!","success")
           window.location.href = controller;
         }else if(data == "failure") {
           swal("Error!","Something went Wrong!. Try Agian","error")
         }
         }
          });
         }
                 //isConfirm?swal("Deleted!","Your imaginary file has been deleted.","success"):swal("Cancelled","Your imaginary file is safe :)","error")
     })
    }

});


 
$(document).on('change','#usersfilter',function(e){
     //table.destroy();
      var status=$(this).val();
    
      var url = $('#userlist').data('controller');  
      var urlallusers = url+'readAllusers';
      //alert(status);
    
      getusersbystatus(urlallusers,status);
      
     
  }); 
  
  $(document).on('click','#restorebutton',function(e){
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
       url: controller+'restoreUsr',
       data: formData,
       success: function(data) {
         // datr = JSON.parse(data);
         console.log(formData['id']);
         if(data == "success") {
           swal("Restored!","You have restored a user","success")
           window.location.href = controller;
         }else if(data == "failure") {
           swal("Error!","Something went Wrong!. Try Agian","error")
         }
         }
          });
         }
               
     })
    }
   
  });

  