$(document).ready(function() {
	var activar = $('div#welcome').attr('value');
	var avatar 	= $('img#avatar').attr('src');
	var nombre  = $('div#nombre').attr('value');
	
	if(activar == 1){
		 $.gritter.add({
        title: 'Yey! ' + nombre ,
        text: "Ahora estamos seguros de que todo est&aacute; listo",
        image: avatar,
        class_name: 'clean',
        sticky: true, 
        time: 5000
      });
      return false;
	}
	

		  $('button#contactado').click(function(){
			  console.log('activa');
			 var id = $('button#contactado').attr('value'); 
			  var dataString = 'id=' + id;
		
		$.ajax({
			type: "POST",
			url: "../php/core/contactado.php",
			data: dataString,
			success: function() {
		    	
		        //alert('Usuario contáctado correctamente');
				$('#mod-'+ id).modal('hide');
				location.reload('#interesados');
		      
		    }
		});
		return false;
		  });
			   
						   
						
    
			
	
	
	
	
	$("#activarUsuario").click(function(){
		var userid = $("#activarUsuario").attr('value');
		
		var dataString = 'id=' + userid;
		
		$.ajax({
			type: "POST",
			url: "../php/core/activarUsuario.php",
			data: dataString,
			success: function() {
		    	
		        location.reload();
		      
		    }
		});
		return false;
		
	});


//Program a custom submit function for the form
$("#upload").click(function(event){
 
  //disable the default form submission
  event.preventDefault();
 
 
var data = new FormData($("#file"));
	jQuery.each($('#file')[0].files, function(i, file) {
    data.append('file-'+i, file);
	});
	
	
 
  $.ajax({
    url: 'users/profile_pic.php',
    type: 'POST',
    data: data,
    //async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
      $("img#avatar").attr("src",returndata);
    }
  });
	

	
	
	
 
  return false;
});
	
});