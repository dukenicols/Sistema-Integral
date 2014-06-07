<div class="page-aside app filters">
      <div>
        <div class="content">
          <button class="navbar-toggle" data-target=".app-nav" data-toggle="collapse" type="button">
            <span class="fa fa-chevron-down"></span>
          </button>          
          <h2 class="page-title">Posteos</h2>
        </div>        
        <div class="app-nav collapse">
        	<form id="filtro" action="posts.php" method="post">
        		<input type="hidden" name="action" value="filter" />
          <div class="content">
          	  <div class="form-group">
              <label class="control-label">Campañas:</label>
              <select class="select2" id="campañas" name="tags">
                <option value="All">Todos</option>
                <?php foreach($tagsArray as $tag)
                {
                	print '<option value="'.$tag->label.'">'.$tag->label.'</option>';
                } ?>
              </select>
            </div>
            <div class="form-group">
              <label class="control-label">Red Social:</label>
              <select multiple="" id="send_to" name="send_to[]" class="form-control">
                    <?php
						foreach($serviciosArray as $servicio)
						{ 
							$title = $servicio->service_name;
						?>
						<option value="<?php print $servicio->sendible_code; ?>"><?php print $title; ?></option>
						<?php } ?>
                  </select>
            </div>
            <div class="form-group">
              <label class="control-label">Desde:</label>
              <div class="input-group date datetime" data-min-view="2" data-date-format="yyyy-mm-dd">
                <input class="form-control" size="16" type="text" name="desde" value="<?php print date ('Y-m-d'); ?>" readonly>
                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
              </div>	
            </div>
             <div class="form-group">
              <label class="control-label">Hasta:</label>
              <div class="input-group date datetime" data-min-view="2" data-date-format="yyyy-mm-dd">
                <input class="form-control" size="16" type="text" name="hasta" value="" readonly>
                <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span>
              </div>	
            </div>
          	<div class="form-group">
              <label class="control-label">Estado:</label>
              <select name="status" id="status" class="select2">
													<option value="0" >Todos</option>
													<option value="Pending" >En Aprobación</option>
													<option value="Scheduled" >Agendado</option>
													<option value="Sent" >Enviado</option>
												</select>
            </div>
            <div class="form-group pull-right">
            	<button class="btn btn-default" id="submit-btn">Filtrar</button>
            	
            </div>
            
          </div>
		</form>
          
        </div>
      </div>
		</div>		
	<div class="container-fluid" data-user-id="<?php print $_SESSION['rowid']; ?>" id="pcont">
    <div class="main-app">
      <div class="head">
        
        <div class="options">
          <div class="btn-group pull-right">
            <button class="btn btn-default active" type="button" id="view_list"><i class="fa fa-list"></i></button>
            <button class="btn btn-default" type="button" id="view_grid"><i class="fa fa-th-large"></i></button>
          </div>
          <div class="form-group" style="width:100%; height: 22px">
           
          </div>
        </div>
      </div>
      <div class="filters">
      	<div class="btn-group" id="all-btns" style="display:none;">
        	       	 <button class="btn btn-sm btn-default" id="like_all">Aprobar</button>
        	       	 
        </div>   
        <input id="check-all" type="checkbox" name="checkall" />
        <span id="all-txt">Seleccionar Todo</span>
        <div class="btn-group" id="all-btns" style="display:none;">
        	       	 <button class="btn btn-sm btn-default" id="like_all">Aprobar</button>
        	       	 <button class="btn btn-sm btn-default" id="reject_all">Rechazar</button>
        </div>   
        <div class="btn-group pull-right">
         
          <button class="btn btn-sm btn-flat btn-default" type="button"><i class="fa fa-angle-left"></i></button> 
          <button class="btn btn-sm btn-flat btn-default" type="button"><i class="fa fa-angle-right"></i></button> 
        </div>
         <!--<div class="btn-group pull-right">
 
          <button data-toggle="dropdown" class="btn btn-sm btn-flat btn-default dropdown-toggle" type="button">
          Ordenar por <span class="caret"></span>
          </button>
          <ul role="menu" class="dropdown-menu">
            <li><a href="#">Date</a></li>
            <li><a href="#">From</a></li>
            <li><a href="#">Subject</a></li>
            <li class="divider"></li>
            <li><a href="#">Size</a></li>
          </ul>
        </div>   -->
           
       

      </div>
      <div id="main_container" class="items products">
        	
        	<?php foreach($mensajes as $mensaje){
        		
				$data1        = $posts->get_post_current_autorization($mensaje->rowid);
				$data2        = $posts->get_client_needed_autorization($mensaje->client_id);
                $rejects      = $posts->get_reject_info($mensaje->rowid,$_SESSION['rowid']);
				
			
				in_array($_SESSION['rowid'] , $data1) ? $approved = 1 : $approved = 0;
				
				
			  	!in_array($_SESSION['rowid'] , $data2) ? $viewer = true : $viewer = false;
				
				$autorization = array();
				if($data1 <> NULL && $data2 <> NULL)
				{
					$autorization = array_diff($data2, $data1);
				}
				
				$data1 == NULL ? $data1 = array() : $data1;
				
				$level = $clientes->approvation_level($_SESSION['rowid'], $mensaje->client_id);
				
				
				if($level == 0){
					$approve = true;
				} elseif(array_key_exists($level - 1, $data1)){
					$approve = true;
				} else {
					$approve = false;
				}
				
			
				 
        		switch($mensaje->sendible_service){
				case '3188157': $service = "Facebook Fan Page - Claro Argentina";  $logo = "http://socialmediaapi.elpixel.net/images/favicon_facebook.png"; break;
				case '3188158': $service = "Facebook Fan Page - Claro Paraguay";  $logo = "http://socialmediaapi.elpixel.net/images/favicon_facebook.png"; break;
				case '3188159': $service = "Facebook Fan Page - Claro Uruguay"; $logo = "http://socialmediaapi.elpixel.net/images/favicon_facebook.png"; break;
				case '3188149': $service = "Twitter - Claro Argentina"; $logo = "http://twitter.com/phoenix/favicon.ico";  break;
				case '3188151': $service = "Twitter - Claro Paraguay"; $logo = "http://twitter.com/phoenix/favicon.ico";  break;
				case '3188150': $service = "Twitter - Claro Uruguay"; $logo = "http://twitter.com/phoenix/favicon.ico";  break;
                default: $service = ''; $logo = '';
                }
				$date = new DateTime($mensaje->post_date);
				
				$hora  = explode(" ",$mensaje->post_date);	
				$dias  = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
				$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
				$date1 = $dias[$date->format('w')]." ".date($date->format('d'))." de ".$meses[$date->format('n')-1]. " del ".$date->format('Y') ;
				
				switch($mensaje->status){
				case 'Pending': $status = "Pendiente"; break;
				case 'Draft':   $status = "Borrador"; break;
				case 'Sent':    $status = "Enviado"; break;
			}	
			
				
				in_array($_SESSION['rowid'],$data2) ? $hide_links = false: $hide_links = true;
				
				if((!empty($rejects))) { $if_like = "Ya rechazaste este post"; $unlike = true; }
				elseif(in_array($_SESSION['rowid'], $data1)) { $if_like = 'Ya has aprobado este post  <i class="fa fa-times cancel_like" style="margin-left:5px; cursor:pointer;"></i> '; $hide_links = true; $unlike = false;} 
				else { $if_like = "Aún no has valorado este post"; $unlike = false; }
				
				
        		?>
        		
        <div class="item item-list"  data-id="<?php print $mensaje->rowid; ?>" data-approved="<?php print $approved; ?>">
        	<div>
				<input type="checkbox" name="c[]" /> 
		  	</div>
          	<div>
				<span class="date pull-right"><?php print $hora[0]; ?>
						<small><?php print $hora[1]; ?></small>
					</span>
					
            	<?php if(!empty($mensaje->image_url)){ ?>
              	<a href="<?php print $servicios->replaceImage($mensaje->image_url); ?>" class="preview2" title="<?php  print htmlentities($mensaje->description); ?>"><img class="product-image" style="max-width:50px" src="<?php print $servicios->replaceImage($mensaje->image_url); } ?>" /></a>
				
            	<h4 class="from"><?php print $service; ?></h4>
            	<p class="msg"><?php  print htmlentities($mensaje->description); ?><img style="width:15px; display:none;" class="loading pull-right" src="http://upload.wikimedia.org/wikipedia/commons/a/a7/HAPPI_Loading.gif">
            		<?php if($approved){ ?>
            			<span class="label label-success pull-right"><i class="fa fa-check"></i> Aprobado</span>
            			<?php } ?> 
            	</p>
          	</div>
        </div>
		  
		  <!-- grid view -->
		<div class="item item-grid" style="float:left;padding-bottom:0px; display:none; border: 1px solid #C4CDE0; width:380px; margin-left:10px;" data-id="<?php print $mensaje->rowid; ?>">
          <div class="photo">
            <div class="header-list" style="border-bottom:none;">
              	<div class="izquierda">
				  <img src="http://socialmediaapi.elpixel.net/images/logo-claro.png">
			  	</div>
				<div class="derecha"  style="position:relative;">
					<span class="title"><?php print $service; ?></span>
					<img src="<?php print $logo; ?>" style="right:0; top:0; width:16px; position: absolute;">
					<br>
					<span class="campania"> <?php print $status; ?></span>
					<br>
					<span class="date"><?php print $date1; ?>
						<small><?php print $hora[1]; ?></small>
					</span>
				</div>
				<div class="clear"></div><hr>
              <span style="padding:10px 0 0 15px;"><?php print htmlentities($mensaje->description); ?> </span>
            </div>     
            
            <div class="img" style="width:auto;">
            	<?php if(!empty($mensaje->image_url)){ ?>
              <img src="<?php print $servicios->replaceImage($mensaje->image_url); ?>" />
              <div class="over">
                <div class="func"><a class="image-zoom" href="<?php print $servicios->replaceImage($mensaje->image_url); ?>"><i class="fa fa-search"></i></a></div>
              </div>
              <?php } ?>            
            </div>
            </div>
            
            
			            <input type="hidden" name="user_id" value="<?php print $_SESSION['rowid'];?>" class="user_id"> 	
                       	
                       
                      
                       
                       	           
			            <div id="fb-container">
			            	 <?php if($_SESSION['rowid'] == $mensaje->user_id){ ?>
						    <div class="links">
									<a class="like_post" href="compose.php?post_id=<?php print $mensaje->rowid; ?>">Editar</a> 
									  
								</div>
						    <?php } ?>
			           <?php
			            if(!$viewer){
                       
                       if (count($rejects) < 1){
                       	  if($hide_links == false){ 
				            	if($approve == true){ ?>	
				            
				            	<div class="links">
									<a class="like_post" id="<?php print $mensaje->rowid; ?>" href="javascript:;">Aprobar</a> · 
									<a class="unlike_post" id="<?php print $mensaje->rowid; ?>" href="javascript:;">Rechazar</a>  
								</div>
							<?php }
						   }
						    }  
						   ?>
							<div class="like clearfix">
	                            <img style="width:14px;" src="http://www.akshitsethi.me/labs/comments/img/like.png" class="pull-left fb-like 
	                            <?php $unlike ? print 'unlike':''; ?>">
	                            <div class="pull-left">
	                            <span class="if_like"><?php print $if_like; ?></span>
	                            <!-- <span id="likecontent"><span id="count" class="color">8</span> <span id="people" class="color">people</span> like this</span> -->
	                            </div>
	                         </div>
							
				            <div class="commentscontainer">
				                <?php if($rejects <> NULL) { 
				                    foreach($rejects as $r){	
	                                $user = $posts->get_user_data_from_post($r->user_id);	$user = $user[0]; ?>
				                        
				                     	<div class="comments clearfix">
	                                    	<div class="pull-left lh-fix">
	                                    	<img src="http://www.akshitsethi.me/labs/comments/img/default.gif">
	                                	</div>
	
	                                	<div class="comment-text">
	                                   	 <span class="color strong" style="margin-left:5px;"><a href="#"><?php print $user->userFullName; ?></a></span> 
	                                   	 &nbsp;<?php print $r->description; ?> <button style="float:right;" class="btn btn-sm"><i class="fa fa-edit"></i></button>
	                                    	<span class="info" ><abbr style="margin-left:5px;" class="time" title="<?php print $r->datec; ?>"></abbr></span>
	                                	</div>
	                            	</div>
				                
				                <?php } 
	                                } ?>
				                    
				            </div>
			           
			            <?php } ?> 
 </div>
			            <div class="comments clearfix" style="display:none;">
							<div class="pull-left lh-fix">
							<img src="http://www.akshitsethi.me/labs/comments/img/default.gif">
						</div>
						<div class="comment-text" >  
							<textarea id="<?php print $mensaje->rowid; ?>" placeholder="Escribe un comentario.." class="text-holder message" style="overflow: hidden; margin-left:5px; margin-top:5px;  word-wrap: break-word; width:360px resize: none; height: 20px;"></textarea>
						</div>
			</div>
			            <span class="label facebook-btn" id="ajax_approved" style="display:none;"><i class="fa fa-check"></i>Aprobaste este</span>

		
        	
        </div>
		  
		  
             <? } ?>
      
      </div>
    </div>
	</div> 
</div>

	
	
	
	
	
	
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.js"></script>
  	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/main.js"></script>
  	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/behaviour/general.js"></script>
 	<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.sparkline/jquery.sparkline.min.js"></script>
	
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.nestable/jquery.nestable.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/bootstrap.switch/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
  	<script src="<?php echo SYSTEM_EURL;?>js/jquery.select2/select2.min.js" type="text/javascript"></script>
  	
  	<script src="<?php echo SYSTEM_EURL;?>js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.gritter/js/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/bootstrap.summernote/dist/summernote.min.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.fileupload/fileupload.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/tooltip/dw_tooltip,js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.autosize/jquery.autosize.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.timeago/jquery.timeago.js"></script>

	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/socialmedia/posts.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/socialmedia/preview.js"></script>
	
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.magnific-popup/dist/jquery.magnific-popup.min.js"></script>
   <script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.icheck/icheck.min.js"></script>
   
   
   
	
	
	
	
	
	
	

  <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript">
      $(document).ready(function(){
      	

      	$('.time').timeago();
        App.init();
	    App.dashBoard();
	    
	    var msg = '.message';
	    
		$(msg).autosize();
		
		
		
	$(msg).keydown(function(e){
		if(e.keyCode == 13)
		{
			var val = $(this).val();
            var postid = $(this).attr('id');
			var comcontainer = $(this).parents('.item').find('.commentscontainer');
			 $.ajax({
				url: 'ajax_files/reject_post.php',
				type: 'GET',
				data: 'msg='+escape(val)+'&user=<?php echo $_SESSION["rowid"]; ?>&post='+postid,
				success: function(data) {
					$(msg).val('');
					$(msg).css('height','25px');
					$(comcontainer).append(data);
					$('.time').timeago();
					$('.time').css('margin-left','5px');
				}
			});
			
			
			return false;
		}
	});
		
		
		
		$(msg).keypress(function(e) {
		if(e.which == 13 || e.keyCode == 13) {
          
			
                
               
                  }
        val = '';
		});
		
		$('.item').on('click', '.like_post', function(){
			var item = $(this).closest('.item');
			item.find('.fb-like').show();
			var postid = item.data('id');
			
			var if_like = item.find('.if_like');
			var links = item.find('.links');
				$.ajax({
				url: 'ajax_files/approve_post.php',
				type: 'POST',
				data: 'user=<?php echo $_SESSION["rowid"]; ?>&post='+postid,
				success: function(data) {
					item.find('.like').show();
					$(links).hide();
					$(if_like).html('<span>Te gusta esto</span><i style="margin-left:5px; cursor:pointer; " class="fa fa-times cancel_like"><i>');
					
				}
			});
		});

				
				});		
      
    </script>
  <script src="<?php echo SYSTEM_EURL;?>js/bootstrap/dist/js/bootstrap.min.js"></script>

  </body>
</html>