<?php
	include_once 'core/initPublic.php';
	
	$user = new User();
	if($user->isLoggedIn()){
		Redirect::to('index.php');
	}
	
	
	if (Input::exists()) {
		if (Token::check(Input::get('token'))) {
			$validate = new Validate();
			$validation = $validate->check($_POST, array(
				'username'	=> array(
					'fieldName'	=> 'Username',
					'required' 	=> true
				),
				'password'	=> array(
					'fieldName'	=> 'Password',
					'required' 	=> true
				)
			));

			if ($validation->passed()) {
				
				$remember 	= (Input::get('remember') == true) ? true : false;
				$login 		= $user->login(Input::get('username'),Input::get('password'), $remember);

				if ($login) {
					Redirect::to('index.php');
				} else {
					$errors[0][] = 'Ups! No coinciden nuestros registros';
				}
			} else {
					$errors[] = $validation->errors();
				}
			}
		}
	
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="shortcut icon" href="images/favicon.png">

	<title>elPixel Social Media</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,400italic,700,800' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300,200,100' rel='stylesheet' type='text/css'>

	<!-- Bootstrap core CSS -->
	<link href="js/bootstrap/dist/css/bootstrap.css" rel="stylesheet">

	<link rel="stylesheet" href="fonts/font-awesome-4/css/font-awesome.min.css">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	  <script src="../../assets/js/html5shiv.js"></script>
	  <script src="../../assets/js/respond.min.js"></script>
	<![endif]-->

	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet" />	

</head>

<body class="texture">

<div id="cl-wrapper" class="login-container">

	<div class="middle-login">
		<div class="block-flat">
			<div class="header">							
				<h3 class="text-center"><img class="logo-img" src="http://socialmediaapi.elpixel.net/images/logo.png" alt="logo"/></h3>
			</div>
			<div>
				<form style="margin-bottom: 0px !important;" class="form-horizontal" method="post" action="">
					<div class="content">
						<h4 class="title">Iniciar Sesi&oacute;n</h4>
						 <?php 

		if(empty($errors) === false){
			echo '<p class="error">' . implode('</p><p class="error">', $errors[0]) . '</p>';	
		}
		

		?>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-user"></i></span>
										<input type="text" placeholder="Usuario" id="username" name="username" value="<?php echo escape(Input::get('username')); ?>" class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-lock"></i></span>
										<input type="password" placeholder="Contraseña" id="password" name="password"  class="form-control">
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<div class="input-group">
										<span>Recordarme</span>
										<input type="checkbox" name="remember" id="remember" class="form-control" /> 
										
									</div>
								</div>
							</div>
							
					</div>
					<div class="foot">
						<input type="hidden" name="token" value="<?php echo Token::generate(); ?>" />
						<button class="btn btn-danger" data-dismiss="modal" type="submit">Iniciar Sesi&oacute;n</button>
					</div>
				</form>
			</div>
		</div>
		<div class="text-center out-links"><a href="#">Powered by elPixel</a></div>
	</div> 
	
</div>

<script src="js/jquery.js"></script>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.pie.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="js/jquery.flot/jquery.flot.labels.js"></script>
</body>
</html>