<?php
session_start();
// include "db_connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport"    content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author"      content="Sergey Pozhilov (GetTemplate.com)">
	
	<title>Sign in</title>
	
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css">

	<!-- Custom styles for our template -->
	<link rel="stylesheet" href="../assets/css/bootstrap-theme.css" media="screen" >
	<link rel="stylesheet" href="../assets/css/main.css">
	<style>
		.c1{
			margin-bottom: 100px !important;
		}
	</style>

</head>

<body>
	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse navbar-fixed-top headroom" >
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
				<a class="navbar-brand" href="index.php"><img src="../assets/images/logo.png" alt="Progressus HTML5 template"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right">
					<li class="active"><a class="btn" href="signup.php">SIGN UP</a></li>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div> 
	<!-- /.navbar -->

	<header id="head" class="secondary"></header>

	<!-- container -->
	<div class="c1">
	<div class="container">

		<div class="row">
			
			<!-- Article main content -->
			<article class="col-xs-12 maincontent">
				<header class="page-header">
					<h1 class="page-title">Sign in</h1>
				</header>
				
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="thin text-center">Sign in to your account</h3>
							<p class="text-center text-muted">Lorem ipsum dolor sit amet, <a href="signup.php">Register</a> adipisicing elit. Quo nulla quibusdam cum doloremque incidunt nemo sunt a tenetur omnis odio. </p>
							<hr>
							
							<form  action="login.php" method="post">
								<div class="top-margin">
									<label>Email <span class="text-danger">*</span></label>
									<input type="text" name="email" class="form-control">
								</div>
								<div class="top-margin">
									<label>Password <span class="text-danger">*</span></label>
									<input type="password" name="password" class="form-control">
								</div>

								<hr>

								<div class="row">
									<div class="col-lg-8">
										<!-- <b><a href="">Forgot password?</a></b> -->
									</div>
									<div class="col-lg-4 text-right">
										<button class="btn btn-action" name="sign" type="submit">Sign in</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>
				
			</article>
		</div>
	</div>
	</div>
	

	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
	<script src="assets/js/headroom.min.js"></script>
	<script src="assets/js/jQuery.headroom.min.js"></script>
	<script src="assets/js/template.js"></script>
</body>
</html>
