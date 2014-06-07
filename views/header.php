<?php 

if(isset($_GET['leftmenu'])){	
$leftmenu = $_GET['leftmenu'];
} elseif(isset($_POST['leftmenu'])) {
	$leftmenu = $_POST['leftmenu'];
} else {
	$leftmenu = 'tasks';
}

$currentfile = $_SERVER["PHP_SELF"].'?'.$_SERVER["QUERY_STRING"];



print '<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">';
print"
    <title></title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:100' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,700' rel='stylesheet' type='text/css'>";
	
	// Bootstrap core CSS
print '    <link href="'.SYSTEM_EURL.'js/bootstrap/dist/css/bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="'.SYSTEM_EURL.'fonts/font-awesome-4/css/font-awesome.min.css">
	      <link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.gritter/css/jquery.gritter.css" />

   
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
 	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.nanoscroller/nanoscroller.css" />
  	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.easypiechart/jquery.easy-pie-chart.css" />
	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/bootstrap.switch/bootstrap-switch.css" />
	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css" />
	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.select2/select2.css" />
	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/bootstrap.slider/css/slider.css" />
	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/dropzone/css/dropzone.css" />
	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.timeline/css/component.css" />
	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.fullcalendar/fullcalendar/fullcalendar.css" />
  	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.fullcalendar/fullcalendar/fullcalendar.print.css"  media="print" />
	<link href="'.SYSTEM_EURL.'js/jquery.icheck/skins/square/blue.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.niftymodals/css/component.css" />
	   <link href="'.SYSTEM_EURL.'js/fuelux/css/fuelux.css" rel="stylesheet">
    <link href="'.SYSTEM_EURL.'js/fuelux/css/fuelux-responsive.min.css" rel="stylesheet">
    <link href="'.SYSTEM_EURL.'js/bootstrap.summernote/dist/summernote.css" rel="stylesheet">
  <!-- Custom styles for this template -->
	    <link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.datatables/bootstrap-adapter/css/datatables.css" />
	    <link rel="stylesheet" type="text/css" href="'.SYSTEM_EURL.'js/jquery.magnific-popup/dist/magnific-popup.css" />
  <link href="'.SYSTEM_EURL.'css/style.css" rel="stylesheet" />';
	  
	

?>
</head>
<body>

	
	
  <!-- Fixed navbar --> 
	<div id="head-nav" class="navbar navbar-default navbar-fixed-top">
    	<div class="container-fluid">
      		<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          			<span class="fa fa-gear"></span>
        		</button>
				<img src="http://socialmediaapi.elpixel.net/images/logo.png" style="margin-right: 80px;"></img>
      		</div>
      <div class="navbar-collapse collapse">
       <!-- <ul class="nav navbar-nav">
			
      
        
			<li <?php if(strstr($currentfile,"/project/tasks") !== false){ echo 'class="active"'; } ?> >
				<a href="<?php echo SYSTEM_EURL; ?>project/tasks/index.php?leftmenu=tasks&mode=mine">Tasks</a>
			</li>
      		
			<li class="dropdown  <?php if(strstr($currentfile,"/agenda/index") !== false){ echo 'active'; } ?>">
            <a href="<?php echo SYSTEM_EURL; ?>agenda/index.php?leftmenu=tasks&mode=mine" class="dropdown-toggle" data-toggle="dropdown">Calendar <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo SYSTEM_EURL; ?>agenda/index.php?leftmenu=tasks&mode=mine">My Calendar</a></li>
              <li><a href="<?php echo SYSTEM_EURL; ?>agenda/index.php?leftmenu=tasks&mode=section">Section Calendar</a></li>
           
               
      </ul>
          </li>
			
          </li> 
			<?php if($_SESSION['admin'] == 1){ ?>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administrator <b class="caret"></b></a>
      			<ul class="dropdown-menu col-menu-2">
        			<li class="col-sm-6 no-padding">
			          <ul>
				          <li class="dropdown-header"><i class="fa fa-group"></i>Users</li>
				          <li><a href="<?php echo SYSTEM_EURL; ?>users/index.php?leftmenu=config">Users</a></li>
				          <li><a href="<?php echo SYSTEM_EURL; ?>users/groups/index.php?leftmenu=config">Groups</a></li>
				         
				          <li class="dropdown-header"><i class="fa fa-gear"></i>Tasks</li>
				          <li><a href="<?php echo SYSTEM_EURL; ?>project/tasks/index.php?leftmenu=tasks">View All <?php print '('.countAllTasks().')'; ?></a></li>
				          
			          </ul>
			        </li>
        <li  class="col-sm-6 no-padding">
          <ul>
          <li class="dropdown-header"><i class="fa fa-gear"></i>Config</li>
          <li><a href="<?php echo SYSTEM_EURL; ?>core/config.php?edit=sections&leftmenu=config">Sections</a></li>
          <li><a href="<?php echo SYSTEM_EURL; ?>core/config.php?edit=categories&leftmenu=config">Categories</a></li>
          <li><a href="<?php echo SYSTEM_EURL; ?>core/config.php?edit=business_unit&leftmenu=config">Business Units</a></li> 
          <li><a href="<?php echo SYSTEM_EURL; ?>core/config.php?edit=regions&leftmenu=config">Regions</a></li>
          <li><a href="<?php echo SYSTEM_EURL; ?>core/config.php?edit=positions&leftmenu=config">Positions</a></li>
          
          </ul>
        </li> 
      </ul>
			</li> 
			<?php } ?> 
   </ul> -->
		    <ul class="nav navbar-nav navbar-right user-nav">
		      <li class="dropdown profile_menu">
				  <?php 
				  
					$url = 'http://educacionsiglo21.com/admin/users/default/default.png';
				 
				  ?>
				  <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img alt="Avatar" src="<?php echo $url; ?>" id="avatar" style="
    height: 30px;" /><?php echo $user->data()->name; ?> <b class="caret"></b></a>
		        <ul class="dropdown-menu">
		          
		          <!-- <li><a href="<?php echo SYSTEM_EURL; ?>users/profile.php?id=<?php echo $_SESSION['rowid']; ?>">Perfil</a></li>
		          <li><a href="#">Mensajes</a></li> 
		          <li class="divider"></li> -->
		          <li><a href="<?php echo SYSTEM_EURL; ?>core/logout.php">Cerrar Sesi&oacute;n</a></li>
		        </ul>
		      </li>
		    </ul>			
     <ul class="nav navbar-nav navbar-right not-nav">
     <!-- <li class="button dropdown">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class=" fa fa-comments"></i></a>
        <ul class="dropdown-menu messages">
          <li>
            <div class="nano nscroller">
              <div class="content">
                <ul>
                  <li>
                    <a href="#">
                      <img src="images/avatar2.jpg" alt="avatar" /><span class="date pull-right">13 Sept.</span> <span class="name">Daniel</span> I'm following you, and I want your money! 
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="images/avatar_50.jpg" alt="avatar" /><span class="date pull-right">20 Oct.</span><span class="name">Adam</span> is now following you 
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="images/avatar4_50.jpg" alt="avatar" /><span class="date pull-right">2 Nov.</span><span class="name">Michael</span> is now following you 
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <img src="images/avatar3_50.jpg" alt="avatar" /><span class="date pull-right">2 Nov.</span><span class="name">Lucy</span> is now following you 
                    </a>
                  </li>
                </ul>
              </div>
            </div>
            <ul class="foot"><li><a href="#">View all messages </a></li></ul>           
          </li>
        </ul>
     </li> 
      <!-- <li class="button dropdown">
        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-globe"></i><span class="bubble">2</span></a>
        <ul class="dropdown-menu">
          <li>
            <div class="nano nscroller">
              <div class="content">
                <ul>
                  <li><a href="#"><i class="fa fa-cloud-upload info"></i><b>Daniel</b> is now following you <span class="date">2 minutes ago.</span></a></li>
                  <li><a href="#"><i class="fa fa-male success"></i> <b>Michael</b> is now following you <span class="date">15 minutes ago.</span></a></li>
                  <li><a href="#"><i class="fa fa-bug warning"></i> <b>Mia</b> commented on post <span class="date">30 minutes ago.</span></a></li>
                  <li><a href="#"><i class="fa fa-credit-card danger"></i> <b>Andrew</b> killed someone <span class="date">1 hour ago.</span></a></li>
                </ul>
              </div>
            </div>
           <ul class="foot"><li><a href="#">View all activity </a></li></ul>     
          </li>
        </ul>
      </li> -->
      <!-- <li class="button"><a href="javascript:;"><i class="fa fa-microphone"></i></a></li> -->				
    </ul>  

      </div> <!--/.nav-collapse -->
    </div>
</div>
	<?php include_once(SYSTEM_URL.'views/left_menu.php'); ?>
	