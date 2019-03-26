//var j = jQuery.noconflict();
//jQuery(function($){
    jQuery(document).ready(function($){
    $('#filter').submit(function(){
        var filter=$('#filter');
        $.ajax({
               url:filter.attr('action'),
               data:filter.serialize(),
               type:filter.attr('method'),
               beforeSend:function(xhr){
                filter.find('button').text('Processing...');
               },
               success:function(res){
                 filter.find('button').text('Apply filter');  
                 $('#result').html(res);
               }
        });
     return false;
    });

   // jQuery('#PaginationExample a').live('click', function(e){
    //    e.preventDefault();
   //     var link = jQuery(this).attr('href');
   //     jQuery('#result').html('Loading...');
     //   jQuery('#result').load(link+' #result');
         
    //    });

});

  
