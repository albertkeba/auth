<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function index()
	{
		$this->load->view('login');
	}
	
	public function login()
	{
		$this->load->model( 'Users' );
		$username	= $this->input->post( 'username' );
		$password	= $this->input->post( 'password' );
		
		if ( $this->Users->login( $username, $password ) == true )
		{
			echo json_encode(array('success'=>true));
		}
		else
		{
			echo json_encode(array('success'=>false));
		}
	}
	//-- eo login
	
	public function logout()
	{
		$this->session->unset_userdata( 'user_id' );
		$this->session->unset_userdata( 'login_string' );
		$this->session->unset_userdata( 'username' );
		$this->session->unset_userdata( 'is_logged_in' );

		$this->session->sess_destroy();
		
		redirect('/','refresh');
	}
	//-- eo logout
	
	public function addUser()
	{
		$this->load->model( 'Users' );
		$username	= $this->input->post( 'username' );
		$email		= $this->input->post( 'email' );
		$password	= $this->input->post( 'password' );
		
		if ( $this->Users->register( $username, $email, $password ) == true )
		{
			echo json_encode(array('success'=>true));
		}
		else
		{
			echo json_encode(array('success'=>false));
		}
	}
}