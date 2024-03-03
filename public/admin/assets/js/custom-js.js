jQuery(document).ready(function(){

    // get user data
    jQuery('body').on('click','.edit-btn', function(){
       var id =  jQuery(this).data('id');
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
         });  

        $.ajax({
           type:'GET',
           url:'/dashboard/'+ id+'/edit',
           success:function(response) {
             if(response.status == 400){
                // empty
               }
               else{
                   //$('.update-image').remove();
                   $('#name').val(response.emp.name);
                   $('#email').val(response.emp.email);
                   $('#department').val(response.emp.department);
                   $('#update-form').attr('data-id',response.emp.id);

               } 
           }
        });

    });

    // Update user data
    jQuery('body').on('submit','#update-form', function(e){
        e.preventDefault();
        var id =  jQuery(this).data('id');
        var formData = new FormData(this);   
        var data_update = {
                'name': $('#name').val(),   
                'email': $('#email').val(),
                'department': $('#department').val(),
            }

         $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
          });  
 
         $.ajax({
            type:'PUT',
            url:'/dashboard/'+ id,
            data: data_update,
            datatype: "json",
            success:function(response) {
                console.log(response);
                if(response.status == 200){
                     jQuery('.modal-body').before('<div class="alert alert-success" role="alert">Data Updated Successfully</div>');
                     setTimeout(location.reload(), 7000);
                }
                
            }
         });
 
     });
      
     // Delete user data
     jQuery('body').on('click','.delete-btn', function(e){
        e.preventDefault();
        var id =  jQuery(this).data('id');  

         $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
          });  
              if (confirm('Are you sure you want to delete this?')) {
              
         $.ajax({
            type:'DELETE',
            url:'/dashboard/'+ id,
            success:function(response) {
                console.log(response);
                if(response.status == 200){
                    // jQuery('.modal-body').before('<div class="alert alert-success" role="alert">Data Updated Successfully</div>');
                     setTimeout(location.reload(), 7000);
                }
                
            }
         });
        }
 
     })
     
 
 });