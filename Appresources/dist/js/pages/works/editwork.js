



  $(function () {
    $('#reservationdate').datetimepicker({

    icons: {
      time: "fa fa-clock",
      date: "fa fa-calendar",

  },format:"YYYY/MM/DD hh:mm:ss A"
      
  });

  });
  // $(function()
  // {
  //   $('#addworkform').validate({
  //     rules:{
  //       wrkname:{
  //       required:true,
  //       },
  //       datetime:{
  //         required:true,
  //       },
  //     },
  //     messages:{
  //       wrkname:{
  //         required:"please enter work name"
  //       }
  //     }
  
  //   });
  // });

  $(function () {
    $("#editworkform").validate({
        
        rules: {
          wrkname: {
            required: true,
            
          },
          cdate:{
            required:true,
          },
          activeusers:{
            required:true,
          }
          
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
         
          }
       
         });
        });
        $(function () {
          //Initialize Select2 Elements
          $('.select2').select2()
      
          //Initialize Select2 Elements
          $('.select2bs4').select2({
            theme: 'bootstrap4'
          });
        });
        
        $(function () {
          $(document).on('click', '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox({
              alwaysShowClose: true
            });
          });
      
        })
        
        
  var elems = [];
  limit=5;
  var x = $('.input_image').length;
  $(document).on("click",".remove_field", function(e){ 
        
        if($(this).data('id'))
        {
          elems.push($(this).data('id'));
          $('#removed_images').val(JSON.stringify(elems));
        }
         /*var fieldno = $(this).data('fieldno')-1;
         var newid = $('#removefield-'+fieldno).data('id');
        
        
         var string = '<a href="#" class="remove_field btn btn-sm btn-danger" data-fieldno="'+fieldno+'" data-id="'+newid+'"><i class="fas fa-trash"></i> Remove </a>';
              $('#removefield-'+fieldno).html(string);*/
        
        e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
   
    }); 
  