<?php
	require_once 'core/initPublic.php';
	if (Session::exists('home')) {
		echo Session::flash('home');
	}

	$user = new User();
	$services = new Services();
	if ($user->isLoggedIn()) {
		
	//Verificar tipo de Usuario
	$userType = $user->getUserType();
	$clientservices = $services->getServicios();
	Input::get('post_id')? $mode = 'edit' : $mode = '';
	if(Input::get('query')){
		print $services->getTags(Input::get('query'));
		
		exit();
	} 
	
	

	//Llama todas la parte de arriba incluyendo los dos menus
	
	require_once(SYSTEM_URL.'views/header.php');
	print '<link href="'.SYSTEM_EURL.'css/style2.css" rel="stylesheet" />';
	
	?>
	<div class="page-aside email">
      <div class="fixed nano nscroller">
        <div class="content">
          <div class="header">
            <button class="navbar-toggle" data-target=".mail-nav" data-toggle="collapse" type="button">
              <span class="fa fa-chevron-down"></span>
            </button>          
            <h2 class="page-title"><?php echo $lang['compose_message']; ?></h2>
           
          </div> 
              
          <div class="mail-nav collapse">
           <ul class="nav nav-pills nav-stacked ">
           	  <li><a href="compose.php"><i class="fa fa-envelope"></i> <?php echo $lang['compose_title']; ?></a></li>	
              <!--<li class="active"><a href="scheduled.php"><span class="label label-primary pull-right">6</span><i class="fa fa-clock-o"></i><?php echo $lang['compose_scheduled']; ?></a></li>
              <li class="active"><a href="draft.php"><span class="label label-primary pull-right">6</span><i class="fa fa-pencil"></i><?php echo $lang['compose_drafts']; ?></a></li>-->
              
            </ul>
            
           
          </div>
          
        </div>
      </div>
		</div>		
	<div class="container-fluid" id="pcont">
    <div class="message">
      <div class="head">
        <h3><?php echo $lang['compose_message']; ?> <span><a href="#"></a>
        	<!--<i class="fa fa-inbox"></i></a><a href="#"><i class="fa fa-reply"></i></span>
        		-->
        	</h3>
       
      </div>
       <div class="col-lg-12 pull-left">
       	<div style="background-color:#0096fd; padding:5px 0 5px 10px; color:#FFF ">
       		<span id="defaultText"><?php echo $lang['compose_header']; ?> </span> 
       		<span class="right-options" id="clearAll"><?php echo $lang['compose_clear']; ?></span>
       		<span class="right-options" id="selectAll"><?php echo $lang['compose_all']; ?></span>
       		<span id="selected"><span id="countSelected"></span><?php echo $lang['compose_services_selected']; ?></span>
       	</div>
					<div class="block-flat" style="background-color:#CCC; margin-bottom:0px; padding:0 0 10px 10px;" id="select_networks" data-preselected="<?php if($mode == 'edit') { print $editable->sendible_service; } ?>">
						
								<?php foreach ($clientservices as $client){
								
								$client->service_name = str_replace($client->client_label, '', $client->service_name);
								?>
									
									<span class="network" id="<?php print $client->sendible_code; ?>" style="">
									<?php print $client->service_name; ?></br>
									<small><?php print $client->client_label; ?></small>
									</span>	
									
								<? } ?>
									
								
								
								
								
					<br><span class="error" style="display:none;" id="service-error">Debes Seleccionar al menos un servicio</span>	
					</div>			
					<div class="block-flat" style="background-color:#DDD; padding:5px 0 5px 10px; margin-bottom:0px;">
							
									<button class="btn btn-rad btn-sm" id="photo-btn" ><?php echo $lang['compose_photo']; ?></button>	
									
									<button class="btn btn-rad btn-sm" id="tags-btn"><?php echo $lang['compose_tags']; ?></button>	
									<button class="btn btn-rad btn-sm" id="schedule-btn"><?php echo $lang['compose_scheduling']; ?></button>		
								
									<input type="hidden" value="<?php print $_SESSION['rowid']; ?>" id="user_id">
									<input type="hidden" value="<?php if($mode == 'edit') { print $editable->rowid; } ?>" id="post_id">
									<input type="file" id="fileupload" style="display: none" name="files"></input>
									<!-- The global progress bar -->
								    <div id="progress" style="padding:5px; background-color: #DDD; display:none;">
								    	<div class="img_wrap" style="position:relative; display:inline-block;">
								    		<img style="width: 150px; display:none;" id="loading" src="http://elpixel.com/socialmediamgt/socialmedia/images/ajax_loader.gif"></img> 
								        	<img style="width: 150px; display:none;" id="preview" src="" data-image-editable="<?php if($mode == 'edit') { print $editable->image_url; } ?>"></img>
								       		<i style="position:absolute; top: 2px; right:2px; z-index: 100; background-color: #FFF" class="fa fa-times close"></i>
								    	</div>
								    </div>
								    <!-- The container for the uploaded files -->
								    <div id="filesx" class="files" style="display:none;"></div>
								     <!-- The container for the tag input -->
								    <div id="tag" class="tagcontainer" data-pretag="<?php if($mode == 'edit') { print $editable->tags; } ?>">
								    	
								    	Tags:&nbsp;&nbsp;&nbsp;<input type="text" name="tags" id="tag-input" />
								    	<br>
								    	<span style="margin-left: 38px; margin-top:5px; display:none;" class="error" id="tags-error">Es un campo obligatorio</span>
								    	
								    </div>
								    <!-- The container for the schedule -->
								    <div id="schedule" class="schedule" data-predate="<?php if($mode == 'edit') { print $editable->post_date; } ?>">
								    	<?php print $lang['Send'];?>&nbsp;&nbsp;&nbsp;
								    	<select id="selectSchedule">
									    		<option value="now"><?php print $lang['Now'];?></option>
									    		<option value="specific"><?php print $lang['specific'];?></option>
									    		<option value="00:10"><?php print $lang['in 10'];?></option>
									    		<option value="00:15"><?php print $lang['in 15'];?></option>
									    		<option value="00:20"><?php print $lang['in 20'];?></option>
									    		<option value="00:30"><?php print $lang['in 30'];?></option>
									    		<option value="00:45"><?php print $lang['in 45'];?></option>
									    		<option value="01:00"><?php print $lang['in 1'];?></option>
									    		<option value="02:00"><?php print $lang['in 2'];?></option>
									    		<option value="04:00"><?php print $lang['in 4'];?></option>
									    	</select>
								    </div>
								    <div id="timeschedule" class="timeschedule">
								   <?php print $lang['When'];?>&nbsp;&nbsp;<select id="day">
								    	  <?php for($i = 1; $i <= 31; $i++){ 
								    	  	if($i == date('d')){$selected = "selected";} else {$selected = "";}?>
								    	  	<option value="<?php print $i; ?>"<?php print $selected; ?>><?php print $i; ?></option>
								    	  <?php } ?>
								    	  </select>
								    	  <select id="month">
								    	  <?php for($i = 1; $i <= 12; $i++){ 
								    	  	if($i == date('m')){$selected = "selected";} else {$selected = "";}?>
								    	  	<option value="<?php print str_pad($i, 2, "0", STR_PAD_LEFT); ?>"<?php print $selected; ?>><?php print date('F',mktime(0,0,0,$i,1,2000)); ?></option>
								    	  <?php } ?>
								    	  </select>
								    	   <select id="year">
								    	  <?php for($i = date('Y'); $i <= date('Y') + 10; $i++){ 
								    	  	if($i == date('Y')){$selected = "selected";} else {$selected = "";}?>
								    	  	<option value="<?php print $i; ?>"<?php print $selected; ?>><?php print $i; ?></option>
								    	  <?php } ?>
								    	  </select>
								    	    -<select id="hour">
								    	  <?php for($i = 0; $i <= 23; $i++){
								    	  	if($i == date('G')){$selected = "selected"; } else { $selected = '';} ?>
								    	  	<option value="<?php print str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php print $selected; ?>><?php print str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
								    	  <?php } ?>
								    	  </select>
								    	  :<select id="minutes">
								    	  <?php for($i = 0; $i <= 59; $i++){ 
											if($i == date('i')){$selected = "selected"; } else { $selected = '';} ?>
								    	  	<option value="<?php print str_pad($i, 2, "0", STR_PAD_LEFT); ?>" <?php print $selected; ?>><?php print str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
								    	  <?php } ?>
								    	  </select>
								    	&nbsp;
								    
								    </div>
								    
									
					</div>		
					<div class="block-flat" style="background-color:#000: margin-bottom:0px; padding: 5px 0 5px 10px;">
							
								<textarea class="input-block-level" id="summernote" name="content" style="width:100%; height: 300px;" rows="10"><?php if($mode == 'edit') { print $editable->description; } ?></textarea>					
							
					</div>	
					<div class="block-flat" style="background-color:#666; margin-top:-40px; text-align: right">
							<span class="draftsaved">Draft Saved on <span id="draftdate"></span></span>
							<span class="error" id="errores"></span>
							
							<?php if($mode == 'edit') {  ?>
								<button class="btn btn-rad btn-sm post-btn" id="edit-btn"><?php echo $lang['compose_edit_btn']; ?></button>	
								<?php  } else { ?>
							<button class="btn btn-rad btn-sm post-btn" id="submit2-btn"><?php echo $lang['compose_submit']; ?></button>	
							<?php } ?>
							<button class="btn btn-rad btn-sm post-btn" id="cancel-btn"><?php echo $lang['cancel']; ?></button>						
						
					</div>	
				</div>	  

      </div>
    </div>
	</div> 
	
</div>

	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.js"></script>
  	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/main.js"></script>
  	
  	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/behaviour/general.js"></script>
 	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.sparkline/jquery.sparkline.min.js"></script>
	
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.nestable/jquery.nestable.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/bootstrap.switch/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.autocomplete/jquery.autocomplete.js"></script>
  	<script src="<?php echo SYSTEM_EURL;?>js/jquery.select2/select2.min.js" type="text/javascript"></script>
  	
  	<script src="<?php echo SYSTEM_EURL;?>js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.gritter/js/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/bootstrap.summernote/dist/summernote.min.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/jquery.fileupload/fileupload.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/behaviour/ajaxfileupload.js"></script>
	<script type="text/javascript" src="<?php echo SYSTEM_EURL;?>js/socialmedia/compose.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        //initialize the javascript
        App.init();
      });
    </script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
 
  <script src="js/bootstrap/dist/js/bootstrap.min.js"></script>

</html>
	
	
		
<?php
	} else {
		Redirect::to('login.php');
	}	
?>