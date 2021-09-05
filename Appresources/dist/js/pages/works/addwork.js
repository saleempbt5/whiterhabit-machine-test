



  $(function () {
    $('#reservationdate').datetimepicker({
      
    icons: {
      time: "fa fa-clock",
      date: "fa fa-calendar",
     
  },format:"DD/MM/YYYY hh:mm:ss A",
  minDate: new Date(),
  
  messages:{
    minDate:"Only current date should allowed"
  }
      
  });
 
  });
  

  $(function () {
    $("#addworkform").validate({
      
        rules: {
          wrkname: {
            required: true,
            
          },
          cdate:{
            required:true,
          },
          activeusers:{
            required:true,
          },
          img:{
            required:true,
            maxlength:20,
          },
         
        },
        messages: {
            wrkname: {
            required: "Please provide work name"
      
          },
          cdate:{
         
            required:"Please provide date"
          }, 
         activeusers:{
           required:"Please select user"
         },
          },
          errorPlacement: function(error, element) {
            $('.select2bs4').removeClass('error');
         if (element.attr("name") == "cdate" ) {
      error.insertBefore("#reservationdate");
    } else {
       error.insertBefore(element);
    }
   
  }
       
         });
        
        });
      
        $(function () {
         
          //Initialize Select2 Elements
          $('.select2').select2();
          
         
          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4',
            

          });
         
          $('.select2').select2(null).trigger('change');
         
          
        });
        
       
        //$( ".select2bs4" ).find('option').first()