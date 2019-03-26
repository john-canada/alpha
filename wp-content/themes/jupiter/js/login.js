
jQuery(function($){
      $('#form_login').submit(function(){
          var filter=$('#form_login');
          $.ajax({
              type:filter.attr('method'),
              url:filter.attr('action'),
              data:filter.serialize(),
              beforeSend:function(){
                  filter.find('button').text('Processing..');    
              },
              success:function(res){
                  filter.find('button').text('Login');
                  filter.find(':input').each(function(){$(this).val('');});
               alert(res); exit;   
                     
              },

          }); 
      return false;
      });


});





               


 