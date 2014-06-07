  $(document).ready(function(){
  
 var if_like = $('.if_like');

    $.each(if_like, function(){
    if($(this).html() == 'Aún no has valorado este post'){
        $(this).parents('.like').find('img.fb-like').hide();
    
    }
    });
  

  
        $( document ).tooltip({ 
            items: ".product-image",
            content: function() { alert('santi feo');
                var url = $(this);
            return '<img class="map" src="' + url.attr('src') +'" />';
            }
        });
        
       
        
        $('#desde').datepicker();
        
        
         
                
         $('.image-zoom').magnificPopup({ 
        type: 'image',
        mainClass: 'mfp-with-zoom', // this class is for CSS animation below
        zoom: {
        enabled: true, // By default it's false, so don't forget to enable it


        duration: 300, // duration of the effect, in milliseconds
        easing: 'ease-in-out', // CSS transition easing function 

        // The "opener" function should return the element from which popup will be zoomed in
        // and to which popup will be scaled down
        // By defailt it looks for an image tag:
        opener: function(openerElement) {
          // openerElement is the element on which popup was initialized, in this case its <a> tag
          // you don't need to add "opener" option if this code matches your needs, it's defailt one.
          var parent = $(openerElement).parents("div.img");
          return parent;
        }
        }

      });       
  
  
  $('.aprobar_post').click(function()
  {	
	var post_id      = $(this).attr('id');
	var user_id = $('.user_id').val();
  
	  $.ajax({
		    url : "ajax_files/approve_post.php",
		    type: "POST",
		    data : 'action=approve&postid=' + post_id + '&userid=' + user_id,
		    success: function(data, textStatus, jqXHR)
		    {
		      $(this).hide();	
		      $('#no_aprobado').hide();	
		      $('#ajax_approved').show();
		      
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		 
		    }
		});
  	
  		
  });
	  
$('#view_grid').click(function(){
$('.checkbox').hide();
$('#like_all').hide();
$('#all-txt').hide();
$(this).addClass('active');
$('#view_list').removeClass('active');

$('.item-list').hide();
$('.item-grid').show();
$('#main_container').removeClass('items products');
$('#main_container').addClass('gallery-cont');

});

$('#view_list').click(function(){
    $('.checkbox').show();
$('#like_all').show();
$('#all-txt').show();
$(this).addClass('active');
$('#view_grid').removeClass('active');

$('.item-list').show();
$('.item-grid').hide();
$('#main_container').addClass('items products');
$('#main_container').removeClass('gallery-cont');

});


$('.unlike_post').click(function(){	
	$(this).parents(".item").children(".comments").show();
	$(this).parents(".item").find(".text-holder").focus();
	$(this).parents(".item").find('.links').hide();
	var count = parseFloat($('#count').html()) + 1;
			$('#if_like').html('No aprobaste este.');
			$('#likecontent').hide();
	$(this).parents('.item').find('.fb-like').addClass('unlike');
}); 









$('#submit-btn').click(function(){
        
       var selection = $('#campañas option:selected').val();
      
       var networks = [];
       $('#send_to option:selected').each(function(i, selected){
           networks[i] = $(selected).val();
       });
       
       
       var send_to = networks.join();    
     
       
       var desde = $('input[name="desde"]').val();
       var hasta = $('input[name="hasta"]').val();
       
       var status = $('select[name="status"] option:selected').val();
       
   
       
    
       $('#filtro').submit();
        
     
    });
    
    $('input').iCheck({
       checkboxClass: 'icheckbox_square-blue checkbox',
       radioClass: 'iradio_square-blue'
     });
     var selected = [];
     $("#check-all").on('ifChanged',function(){
        $('#all-btns').toggle();
       var checkboxes = $(".items").find(':checkbox');
       if($(this).is(':checked')) {
           checkboxes.iCheck('check');
           $.each(checkboxes,function(){
            selected.push($(this).closest('.item').data('id'));
            });
        } else {
           checkboxes.iCheck('uncheck');
        $.each(checkboxes,function(){
        var id = $(this).closest('.item').data('id');
                     var index = jQuery.inArray(id, selected);
        if (index > -1) {
            selected.splice(index, 1);
        }
            });
       }
        console.log(selected);

     });

//Aprobar Todos los posts
    $('#like_all').on('click',function(){
    if(selected.length > 0) 
    { 
    	$('.loading').fadeIn();
        var user_id = $('#pcont').data('user-id');
         $.ajax({
            url : "ajax_files/approve_posts.php",
            type: "POST",
            data : 'action=approve&posts=' + selected + '&user=' + user_id,
        }).done(function(){
        	$('.loading').fadeOut(); 
        	$('.loading').closest('p').append('<span class="label label-success pull-right"><i class="fa fa-check"></i> Aprobado</span>')
        });
    } 
    });
    $('#reject_all').on('click',function(){
    if(selected.length > 0) { 
    //ajax call
    } 
    });

  

});
  
