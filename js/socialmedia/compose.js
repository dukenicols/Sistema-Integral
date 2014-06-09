  $(document).ready(function(){
     //SELECTED SERVICES
     $('#summernote').summernote({
         height: 300,
     });
       $('#selected').hide();
       
       var numSelect = 0; 
       
       var selectedIDS = [];
       
        $(".network").click(function(){
        	$('#service-error').hide();
        	var id = $(this).attr('id');
	        	
	        	if(!$(this).hasClass('selected'))
	        	{
		        		$(this).addClass('selected');
		        		numSelect = numSelect + 1;
		        		selectedIDS.push(id);
	        	} 
	        	else 
	        	{
	        		$(this).removeClass('selected');
	        		numSelect = numSelect - 1;
	        		var index = selectedIDS.indexOf(id);
	        		if (index > -1)
	        		{
	        			selectedIDS.splice(index, 1);
	        		}
	        	}
        	
        	if(numSelect == 0)
        	{
        		$('#defaultText').show();
        		$('#selected').hide();
        	}
        	
        	if(numSelect != 0 ) 
        	{
        		$('#defaultText').hide();
        		$('#selected').show();
        	}
        	
        	$('#countSelected').html(numSelect);
        	
        	
        });
        
       
      $('#selectAll').click(function(){
      	numSelect = 0;
      	$.each($('.network'), function(k,b){
      		selectedIDS.push($(this).attr('id'));
      		$(this).addClass('selected');
      		numSelect = numSelect + 1;
      	});
      	$('#defaultText').hide();
        $('#selected').show();
      	$('#countSelected').html(numSelect);
      });
      $('#clearAll').click(function(){
      	
      		selectedIDS = [];
      		$('.network').removeClass('selected');
      		numSelect = 0;
      		$('#defaultText').show();
        	$('#selected').hide();
      	
     
      });
     
      //SERVICES END
      
      //UPLOAD VIA AJAX
      
       $("#photo-btn").click(function (e) {
	    e.preventDefault;
	    $("#fileupload").click();
	    
	    $("#fileupload").change(function ()
	    {  
	        $('#progress').show();
	        
	    	$('#loading').show();
	    	sendFile();
	    });
	});
	
	
	//SCHEDULED

	var schedule = false;
	$("#schedule-btn").click(function() {
		if(schedule == false)
		{
			$("#schedule").show();
			$(this).addClass('btn-primary');
			schedule = true;
		}
		else
		{
			$("#schedule").hide();
			$("#timeschedule").hide();
			$(this).removeClass('btn-primary');
			schedule = false;
		}	
	});
	
	//Datepicker
	
	
	$('#selectSchedule').change(function(){
	
	
	var date 	= new Date();
	var hour 	= date.getHours();
	var minutes	= pad(date.getMinutes());
	var option 	= $('#selectSchedule option:selected').val();
	
	if(option == 'now'){
		$('#timeschedule').hide();
		$('#minutes').val(minutes);
		$('#hour').val(hour);
	}
	
	if(option == 'specific'){
		$('#timeschedule').show();
	}
	if(option == '00:10'){
		$('#timeschedule').show();
		minutes = minutes + 10;
		if(minutes > 59){
			var resto    = minutes - 60;
			var hourplus = (hour + 1);
			resto        = pad(resto);
			hourplus     = pad(hourplus);
			$('#minutes').val(resto);
			$('#hour').val(hourplus);
		} else {
			$('#minutes').val(minutes);
		}
		
	}
	if(option == '00:15'){
		$('#timeschedule').show();
		minutes = minutes + 15;
		if(minutes > 59){
			var resto    = minutes - 60;
			var hourplus = (hour + 1);
			resto        = pad(resto);
			hourplus     = pad(hourplus);
			$('#minutes').val(resto);
			$('#hour').val(hourplus);
		} else {
			$('#minutes').val(minutes);
		}
		
	}
	if(option == '00:20'){
		$('#timeschedule').show();
		minutes = minutes + 20;
		if(minutes > 59){
			var resto    = minutes - 60;
			var hourplus = (hour + 1);
			resto        = pad(resto);
			hourplus     = pad(hourplus);
			$('#minutes').val(resto);
			$('#hour').val(hourplus);
		} else {
			$('#minutes').val(minutes);
		}
		
	}
	if(option == '00:30'){
		$('#timeschedule').show();
		minutes = minutes + 30;
		if(minutes > 59){
			var resto    = minutes - 60;
			var hourplus = (hour + 1);
			resto        = pad(resto);
			hourplus     = pad(hourplus);
			$('#minutes').val(resto);
			$('#hour').val(hourplus);
		} else {
			$('#minutes').val(minutes);
		}
		
	}
	if(option == '00:45'){
		$('#timeschedule').show();
		minutes = minutes + 45;
		if(minutes > 59){
			var resto    = minutes - 60;
			var hourplus = (hour + 1);
			resto        = pad(resto);
			hourplus     = pad(hourplus);
			$('#minutes').val(resto);
			$('#hour').val(hourplus);
		} else {
			$('#minutes').val(minutes);
		}
		
	}
	if(option == '01:00'){
		$('#timeschedule').show();
		$('#minutes').val(minutes);
		$('#hour').val(hour + 1);
			
	}
	if(option == '02:00'){
		$('#timeschedule').show();
		$('#minutes').val(minutes);
		$('#hour').val(hour + 2);
			
	}
	if(option == '04:00'){
		$('#timeschedule').show();
		$('#minutes').val(minutes);
		$('#hour').val(hour + 4);
			
	}		
		
	
	});
		
     //SCHEDULE END
     
     //TAGS
     var tags = false;
     $('#tags-btn').click(function(){
     	if(tags == false)
     	{
     		$('div#tag').show();	
     		$(this).addClass('btn-primary');
     		tags = true;
     	} 
     	else 
     	{
     		$('div#tag').hide();
     		$(this).removeClass('btn-primary');
     		tags = false;
     	}
     	
     	
     });
     var countries = [
   { value: 'ENGAGEMENT - FRASES' },
   { value: 'ENGAGEMENT - JUEGOS' },
   { value: 'BRAND - PROMOCIONES' },
   { value: 'BRAND - CLAROCLUB' },
   { value: 'BRAND - SCL' },
   { value: 'ENGAGEMENT' },
   
   { value: 'ENGAGEMENT - ANIMALES' }
];
var test;
$.getJSON("compose.php?query=e", function(data) {
	test = data;
});
var tag_text;
$('#tag-input').autocomplete({
    serviceUrl: test,
    onSearch: function (suggestion) {
        tag_text = suggestion.value;
    }
});
    
     //TAGS END  
 	 
       //DESCRIPTION FIELD
      
       
         
        
        //SUBMIT BUTTON
         
        $('#submit2-btn').on('click',function(){
        	
        	
 
        	if(selectedIDS.length == 0)
            {
                $('#service-error').show();
              return false;
               
            }
        	
        	
        	
        	
        	var content 	  = $('#summernote').code();
        	
	    	var schedule_time = $('#year').val() + '-' + $('#month').val() + '-' + $('#day').val() + ' ' + $('#hour').val() + ':' + $('#minutes').val() + ':00';
			var date 		  = new Date();	    
	    	var imagen_url	  = $('#preview').attr('src');
	    	var status 		  = 'pending';
	    	var user_id       = $('#user_id').val();
	    	var error		  = [];
	    	tag_text;
	    	
	    	
	    	if(user_id.length < 1)
	    	{
	    	  alert('Ha ocurrido un error, por favor refresque la página');
	    	  return;
	    	} 

	    	if((content == '<p><br></p>') || (content == null)){
	    	
	    	  $('#note-editable').focus();
	    	//return;
	    	}
	    	
	    	if(imagen_url.length == 0)
	    	{
	    	
	    	var approval = confirm('No has subido una imágen, ¿Deseas continuar?');
	    	
	    	
	    	  
		    	if(approval == false)
		    	{
		    		return;
		    	}
		    	
	    	}
	    	
	    	
	    	if(tag_text.length == 0)
	    	{
    	    	$('#tags-btn').click();
    	    	$('#tags-error').show();
    	    	$('#tag-input').focus();
	    	      return false;
	    	}
	    	
	    	
	    	
	    	
	    	
	    	
	    	
	    	
	    	
	        
	    	
	    	
	    	
	    	$.ajax({
		    url : "ajax_files/save_post.php",
		    type: "POST",
		    data : 'action=submit&networks='+ selectedIDS + '&tags=' + tag_text + '&schedule=' + schedule_time + '&description=' + content +'&user_id=' + user_id +'&image=' + imagen_url +'&status=' + status,
		    success: function(data, textStatus, jqXHR)
		    {
		      window.location.href = 'posts.php';
		    },
		    error: function (jqXHR, textStatus, errorThrown)
		    {
		 
		    }
		});
        	
        });
        
        
        
        //END SUBMIT BUTTON
        //CANCEL BUTTON
        
        $('#cancel-btn').click(function(){
        	if(confirm('Are you sure?') == true ) {
        		window.location.href = 'posts.php';
        	}
        	
        	
        });
        
        

        
 
/*EDIT MODE ONLY */        
var preselected_networks = $('#select_networks').data('preselected');

if(preselected_networks > 0)
{
    $('#'+preselected_networks).click();
}

var imagen_editable = $('#preview').data('image-editable');

if(imagen_editable.length > 0){

    $('#progress').show();
    $('#preview').show();
    $('#preview').attr('src',imagen_editable);

}

 $('.img_wrap').on('click', '.close', function(){
    var cont = $(this).closest('.img_wrap');
    $(this).hide(); 
    cont.find('#preview').hide();
    cont.find('#preview').attr('src', '');
    $('#progress').hide();
    });

var pretag = $('#tag').data('pretag');

if(pretag.length > 0){ 
$('#tags-btn').click();
$('#tag-input').val(pretag);
}

var predate = $('#schedule').data('predate');

if(predate.length > 0) {
 var Ymd = predate.split('-');
 var Y = Ymd[0];
 var m = Ymd[1];
 var dhis = Ymd[2].split(' ');
 var d = dhis[0];
     d = d.replace(/^0+/, '');

var his = dhis[1].split(':'); 
 var h = his[0];
 var i = his[1];

$('#schedule-btn').click();
$('#selectSchedule option[value="specific"]').prop("selected",true);
$('#timeschedule').show();

$('#day').val(d);
$('#month').val(m);
$('#year').val(Y);
$('#hour option[value="'+ h +'"]').prop("selected", true);
$('#minutes option[value="'+ i +'"]').prop("selected", true);

}

   //EDIT SAVE CHANGES BUTTON
         var counter = 0;
        $('#edit-btn').click(function(){
            
            
 
            if(selectedIDS.length == 0)
            {
                $('#service-error').show();
              return false;
               
            }
            
            
            counter++;
            
            var content       = $('#summernote').code();
            var post_id       = $('#post_id').val();
            var schedule_time = $('#year').val() + '-' + $('#month').val() + '-' + $('#day').val() + ' ' + $('#hour').val() + ':' + $('#minutes').val() + ':00';
            var date          = new Date();     
            var imagen_url    = $('#preview').attr('src');
            var status        = 'pending';
            var user_id       = $('#user_id').val();
            var error         = [];
            var tag_text      = $('#tag-input').val();
            
            
            if(user_id.length < 1)
            {
              alert('Ha ocurrido un error, por favor refresque la página');
              return;
            } 

            if((content == '<p><br></p>') || (content == null)){
            
              $('#note-editable').focus();
            //return;
            }
            
            if(imagen_url.length == 0)
            {
            
            var approval = confirm('No has subido una imágen, ¿Deseas continuar?')
            
            console.log(approval);
              
                if(approval == false)
                {
                    return;
                }
                
            }
            
            
            if(tag_text.length == 0)
            {
                $('#tags-btn').click();
                $('#tags-error').show();
                $('#tag-input').focus();
                  return false;
            }
            
            
            
            
            
            
            
            if(counter == 1) {
            
            
            
            
            
            $.ajax({
            url : "ajax_files/save_post.php",
            type: "POST",
            data : 'action=edit&networks='+ selectedIDS + '&tags=' + tag_text + '&schedule=' + schedule_time + '&description=' + content +'&user_id=' + user_id +'&image=' + imagen_url +'&status=' + status + '&post_id=' + post_id,
            success: function(data, textStatus, jqXHR)
            {
              window.location.href = 'posts.php';
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
         
            }
        });
            }
        });
        
        
        
        //END SUBMIT BUTTON
/* EDIT MODE ONLY */
         
		}); // ESTE CIERRA DOCUMENT . READY
		
		
		
		var postForm = function() 
		{
		var content = $('textarea[name="content"]').html($('#summernote').code());
		}
		
	    function sendFile()
    	{
	        $.ajaxFileUpload({
	            url:'ajax_files/fileupload.ajax.php', 
	            secureuri:false,
	            fileElementId:'fileupload',
	            dataType: "json",
	            success: function (data, status)
	            {
	            	
	              $('#preview').attr('src',data.url);
	                
				        
				        $('#loading').hide();
				        $('#preview').show();
				   
	               
	               
	            },
	            error: function (data, status, e)
	            {
	                alert(e.JSONparse);
	                
	            }
	        });
    }
    function pad(n) {
    if (n < 10)
        return "0" + n;
    return n;
}

	    
	    //DESCRIPTION FIELD
	     

 
		