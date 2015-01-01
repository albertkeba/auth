<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" dir="ltr" >
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>vendors/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>styles/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>styles/login.css" />
</head>
<body id="login-view">
	<div class="container">
		<div id="login-content">
			<h2>Authentification</h2>
			<hr/>
			<div class="message-container">
				<div class="alert alert-danger"></div>
			</div>
			<form class="form-signin">
				<label class="sr-only" for="username"></label>
				<input id="username" class="form-control" type="text" autofocus="" placeholder="Nom d'utilisateur" />
				<label class="sr-only" for="password"></label>
				<input id="password" class="form-control" type="password" autofocus="" placeholder="Mot de passe" />
				<button class="btn btn-lg btn-primary btn-block" id="btn-submit" type="submit">Soumettre</button>
			</form>
		</div>
	</div>
	<div class="navbar-fixed-bottom">
		<a href="<?php echo base_url(); ?>registration">Créer un nouvel utilisateur</a>
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/sha512.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/validator.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/view.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/view.login.js"></script>
	<script>
	(function(){
		$(document).ready(function(){
			new App.Views.loginForm();
		});
	}());
	</script>
</body>
</html>