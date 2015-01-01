<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr-fr" lang="fr-fr" dir="ltr" >
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,700italic,700,600,400' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>vendors/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>vendors/bootstrap/css/bootstrap-theme.min.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>styles/main.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>styles/form.css" />
</head>
<body>
<div class="container">
	<div class="panel">
		<div class="panel-heading">
			<span class="glyphicon glyphicon-th-list"></span>
			Créer un nouvel utilisateur
		</div>
		<div class="panel-body">
			<div class="message-container">
				<div class="alert alert-danger"></div>
			</div>
			<form class="form-horizontal" id="registration-form">
				<div class="form-group">
					<label for="username" class="col-sm-3 control-label">Nom d'utilisateur</label>
					<div class="col-sm-9">
						<input type="text" id="username" name="username" class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="email" class="col-sm-3 control-label">Courriel</label>
					<div class="col-sm-9">
						<input type="email" id="email" name="email" class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="password" class="col-sm-3 control-label">Mot de passe</label>
					<div class="col-sm-9">
						<input type="password" id="password" name="password" class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
					<label for="passwordconfirm" class="col-sm-3 control-label">Confirmer le mot de passe</label>
					<div class="col-sm-9">
						<input type="password" id="passwordconfirm" name="passwordconfirm" class="form-control" />
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-3"></div>
					<div class="col-sm-9">
						<button type="button" id="btn-submit" class="btn btn-primary">Soumettre</button>
						<button type="button" id="btn-cancel" class="btn btn-danger">Annuler</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/sha512.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/validator.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/view.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>scripts/view.registration.js"></script>
	<script>
		(function(){
			$(document).ready(function(){
				new App.Views.registrationForm();
			});
		}());
	</script>
</div>
</body>
</html>