<?php
	require_once 'core/initPublic.php';
	if (Session::exists('home')) {
		echo Session::flash('home');
	}

	$user = new User();
	
	if ($user->isLoggedIn()) {
		
	//Verificar tipo de Usuario
	$userType = $user->getUserType();

	//Llama todas la parte de arriba incluyendo los dos menus
	
	require_once(SYSTEM_URL.'views/header.php');
	print '<link href="'.SYSTEM_EURL.'css/style2.css" rel="stylesheet" />';
	?>
	<div class="container-fluid" id="pcont">

	<div class="cl-mcont">
		<h3 class="text-center">Content goes here!</h3>
	</div>
	
	</div> 
	
</div>

	<script src="js/jquery.js"></script>
	<script type="text/javascript" src="js/jquery.nanoscroller/jquery.nanoscroller.js"></script>
	<script type="text/javascript" src="js/jquery.sparkline/jquery.sparkline.min.js"></script>
	<script type="text/javascript" src="js/jquery.easypiechart/jquery.easy-pie-chart.js"></script>
  <script src="js/jquery.ui/jquery-ui.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.nestable/jquery.nestable.js"></script>
	<script type="text/javascript" src="js/bootstrap.switch/bootstrap-switch.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	<script src="js/jquery.select2/select2.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.gritter/js/jquery.gritter.min.js"></script>
	<script type="text/javascript" src="js/behaviour/general.js"></script>

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