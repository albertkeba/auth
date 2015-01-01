/*jslint devel: true, white: true*/
/*global App, $, hex_sha512*/
App.Validator = (function(){
	'use strict';
	
	function Validator( options ) {
		options = options || {};
		
		this.username	= options.username || 'username';
		this.password	= options.password || 'password';
		this.email		= options.email || 'email';
		this.pwdConfirm = options.pwdConfirm || 'passwordconfirm';
		this.debug		= options.debug || true;
		this.$form		= options.form || null;
		this.password_length = options.password_length || 6;
		this.error		= '';
	}
	
	Validator.prototype.formhash = function() {
		var $username = this.$form.find( '#'+this.username ),
			$password = this.$form.find( '#'+this.password );
	
		if ( $username.val().length === 0 || $password.val().length === 0 )
		{
			this.error = "Un nom d'utilisateur et un mot de passe sont requis";
			return false;
		}

		if ( ! this.checkUsername( $username ) )
		{
			return false;
		}
		
		if ( ! this.checkPassword( $password ) )
		{
			return false;
		}
		
		this.createPElement();
	};
	
	Validator.prototype.checkUsername = function( $field ) {
		var re =  /^\w+$/;
		
		if ( ! re.test($field.val()) )
		{
			$field.focus();
			return false;
		}
		
		return true;
	};
	
	Validator.prototype.checkPassword = function( $field ) {
		var re = new RegExp( "(?=.*\\d)(?=.*[a-z])(?=.*[A-Z]).{" + this.password_length + ",}" );
		
		if ( $field.val().length < this.password_length )
		{
			this.error = "Le mot de passe doit contenir au moins " + this.password_length + " caractères. Essayez de nouveau svp.";
			return false;
		}
		
		if ( ! re.test($field.val()) )
		{
			this.error = "Le mot de passe doit contenir un chiffre, un caractère en minuscule et un caractère en majuscule. Essayez de nouveau svp.";
			return false;
		}
		
		return true;
	};
	
	Validator.prototype.createPElement = function() {
		var $hidden_pwd = this.$form.find('#hidden_pwd'),
			$password = this.$form.find( '#'+this.password),
			$input,p;

		if ( $hidden_pwd.length === 0 )
		{
			$hidden_pwd  = $('<input />').attr({
				name: 'p',
				id	: 'hidden_pwd',
				type: 'hidden'
			});
			
			this.$form.append( $hidden_pwd  );	
		}
		
		$hidden_pwd.val( hex_sha512( $password.val() ) );
		
		$password.val('');
	};
		
	Validator.prototype.regformhash = function() {
		var $username	= this.$form.find( '#'+this.username ),
			$email		= this.$form.find( '#'+this.email ),
			$password	= this.$form.find( '#'+this.password ),
			$pwdConfirm	=  this.$form.find( '#'+this.pwdConfirm );
		
		if ( $username.val().length === 0 ||
		   $email.val().length === 0 ||
		   $password.val().length === 0 ||
		   $pwdConfirm.val().length === 0 )
		{
			this.error = "Vous devez renseigner tous les champs requis.";
			return false;
		}
		
		if ( $password.val() !== $pwdConfirm.val() )
		{
			this.error = "Le mot de passe n'a pas été correctement confirmé";
			return false;
		}
		
		if ( ! this.checkUsername( $username ) )
		{
			return false;
		}
		
		if ( ! this.checkPassword( $password ) )
		{
			return false;
		}
		
		this.createPElement();
	};
	
	return Validator;
}());