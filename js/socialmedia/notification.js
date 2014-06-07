$(document).ready(function(){




setTimeout(function(){ searchNots(0) }, 3000);	
	
function searchNots(ln){
 
	var container = $('.nano').children();
	
	
	if(ln > - 1){
	    ln = ln + 1;
	}
	
	
	
	$.ajax({
            url : "ajax_files/searchnotifications.php?id="+'&last='+ln,
            type: "POST",
            dataType: "json",
            success: function(data, textStatus, jqXHR)
            {
                console.log(data);
              ln = data.rowid; 
              var html = '<li><a href="#"><i class="fa fa-cloud-upload info"></i><b>Daniel</b>'+ data.message +'<span class="date">2 minutes ago.</span></a></li>';	
			 
			}
                    
        }); 
        ln++;
        
setTimeout(function(){ searchNots() }, 3000);           

}




});