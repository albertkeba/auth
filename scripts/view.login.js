/*jslint devel: true, white: true*/
/*global App, View, validator, $*/
App.Views.loginForm = (function(){
	'use strict';
	
	function ViewLoginForm(){
		View.call(this, {
			el: '#login-content',
			events: {
				click: [{
					element	: '#btn-submit',
					attach	: 'submit'
				}]
			}
		});

		this.bindEvents();
	}
	
	ViewLoginForm.prototype = Object.create( View.prototype );
	
	ViewLoginForm.prototype.submit = function( e ) {
		var self		= e.data.self,
			$username	= self.$el.find('#username'),
			$password	= self.$el.find('#password'),
			$error		= self.$el.find('.message-container'),
			validator	= new App.Validator({
				form: self.$el
			}), $hiddenPwd;

		validator.formhash();
		
		$hiddenPwd = self.$el.find('#hidden_pwd');

		if ( validator.error.length > 0 )
		{
			$('.alert').html( validator.error );
			$error.show();
		}
		else
		{
			$.ajax({
				url		: 'auth/login',
				data	: {
					username: $username.val(),
					password: $hiddenPwd.val()
				},
				type	: 'POST',
				success	: function( r ){
					window.location = 'home';
				},
				error	: function(){}
			});
		}
		
		
		return false;
	};
	
	return ViewLoginForm;
}());