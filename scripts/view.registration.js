/*jslint devel: true, white: true*/
/*global App, View, validator, $*/
App.Views.registrationForm = (function(){
	'use strict';
	
	function ViewRegistrationForm(){
		View.call(this, {
			el: '.panel-body',
			events: {
				click: [{
					element	: '#btn-submit',
					attach	: 'submit'
				},{
					element	: '#btn-cancel',
					attach	: 'cancel'
				}]
			}
		});

		this.bindEvents();
	}
	
	ViewRegistrationForm.prototype = Object.create( View.prototype );
	
	ViewRegistrationForm.prototype.submit = function( e ) {
		var self		= e.data.self,
			$username	= self.$el.find('#username'),
			$email		= self.$el.find('#email'),
			$password	= self.$el.find('#password'),
			$pwdConfirm	= self.$el.find('#passwordconfirm'),
			$error		= self.$el.find('.message-container'),
			validator	= new App.Validator({
				form: self.$el
			}), $hiddenPwd;
	
		validator.regformhash();
		
		$hiddenPwd = self.$el.find('#hidden_pwd');
		
		if ( validator.error.length > 0 )
		{
			$('.alert').html( validator.error );
			$error.show();
		}
		else
		{
			$.ajax({
				url		: 'auth/addUser',
				data	: {
					username: $username.val(),
					email	: $email.val(),
					password: $hiddenPwd.val()
				},
				type	: 'POST',
				success	: function( r ){
					console.log(r);
				},
				error	: function(){}
			});
			
			$error.hide();
		}
		
		return false;
	};
	
	ViewRegistrationForm.prototype.cancel = function() {
		alert('cancel');
	};
	
	return ViewRegistrationForm;
}());