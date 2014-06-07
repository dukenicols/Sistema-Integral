  $(document).ready(function(){ 
      
      var page_id = gup('id');
      
      $('.addUserToGroup').click(function() {
         
         var client_id = $(this).attr('id');
         var user = $('select#'+ client_id + ' option:selected');
         var user_id = user.val();
         
         
            $.ajax({
            url : "perfil_cliente.php?id="+page_id,
            type: "POST",
            data : 'action=add_user&client_id=' + client_id + '&user_id=' + user_id,
            dataType: "json",
            success: function(data, textStatus, jqXHR)
            {
             
             var none_user = $('#noneuser-' + client_id);
             if(none_user.length){
                 none_user.hide();
             }
            
            var html = '<tr><td><i class="fa fa-user"></i>'+ data.login +'</td><td>'+ data.name +'</td><td><button type="button" class="btn btn-sm btn-default btn-google-plus bg deleteUser" id="'+ data.rowid +'"><i class="fa fa-trash-o"></i></button><input type="hidden" class="client" value="'+ client_id +'" ></td></tr>';
            
            
            $('#tabla-'+client_id + ' > tbody:last').append(html);
            user.remove();
            
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
         
            }
        }); 
          
      });
      
      
     $('body').on('click', '.deleteUser', function(){
         
            var user_id = $(this).attr('id');
            var client_id = $(this).next('.client').val();
            var tr = $(this).closest('tr');

           $.ajax({
            url : "perfil_cliente.php?id="+page_id,
            type: "POST",
            data : 'action=remove_user&client_id=' + client_id + '&user_id=' + user_id,
            dataType: "json",
            success: function(data, textStatus, jqXHR)
            {
                 tr.hide();
                 var html = '<option value="'+ data.rowid +'" selected>'+ data.name + '</option>';
                 $('select#' + client_id).prepend(html); 
           
            
          
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
         
            }
        }); 
          
      });
      
      $('#submit-dependency').click(function(){
         
         var nombre = $('#crear-dependencia').val();
         var error  = 0; 
         $('#crear-dependencia').change(function(){
            nombre = $('#crear-dependencia').val();
            $('#input-error').hide();
            error--;
         });
         
         if(nombre.length < 5)
         {
            $('#input-error').show();
            $('#input-error').append('Campo Obligatorio');   
            error++;
         }
        
         
         
         if(error < 1){
         
          $.ajax({
            url : "perfil_cliente.php?id="+page_id,
            type: "POST",
            data : 'action=add_child&client_id=' + page_id + '&label=' + nombre,
            
            success: function(data, textStatus, jqXHR)
            {
                window.location.reload();
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
         
            }
        }); 
         }
      });
      
      $('.deleteDependency').click(function(){
         
         var child_id = $(this).val();
         
          $.ajax({
            url : "perfil_cliente.php?id="+page_id,
            type: "POST",
            data : 'action=remove_child&child_id=' + child_id,
            
            success: function(data, textStatus, jqXHR)
            {
                window.location.reload();
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
         
            }
        }); 
          
      });
      
      
        $("table.no-border").tableDnD({
                onDrop: function(table, row){
                    
                    var rows = table.tBodies[0].rows;
                    var orden = [];
                    for (var i=0; i<rows.length; i++) {
                      orden += rows[i].id + ',';
                      
                      
                  }
                    
                    var n = 1;
                    $.each($('#' + table.id + '> tbody > tr'), function(k, v) {
                      $(this).find('td.nivel').text(n);
                      n++;
                    });
                    
                var data  = orden.replace(/(^,)|(,$)/g, "");  
                
                 $.ajax({
                        url : "perfil_cliente.php?id="+page_id,
                        type: "POST",
                        data : 'action=update_order&data='+ data
                       
                     }); 
                
                
                
         }
         });
       
      
      
      });
      
    function gup( name )
        {
          name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
          var regexS = "[\\?&]"+name+"=([^&#]*)";
          var regex = new RegExp( regexS );
          var results = regex.exec( window.location.href );
          if( results == null )
            return null;
          else
            return results[1];
        }
      