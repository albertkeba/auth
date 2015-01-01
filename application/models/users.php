<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Model 
{
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * validation de l'utilisateur
	 * @param string $username
	 * @param string $password
	 * return bool
	 */
	public function login( $username, $password )
	{
		$this->db->from( 'members' );
		$this->db->where( 'username', $username );
		$this->db->limit( 1 );
		$query = $this->db->get();
		
		if ( $query->num_rows() == 1 )
		{
			$user = $query->result()[0];
			$password = hash('sha512', $password . $user->salt );
			
			if ( $this->checkbrute( $user->id ) === true )
			{
				echo 'Erreur';
				return false;
			}
			else
			{
				if ( $user->password === $password )
				{
					$user_browser	= $_SERVER['HTTP_USER_AGENT'];
					$user_id		= preg_replace('/[^0-9]+/', '', $user->id);
					$username		= preg_replace('/[^a-zA-Z0-9_\-]+/', '', $user->username);
					
					$this->session->set_userdata(array(
						'username'		=> $username,
						'user_id'		=> $user_id,
						'login_string'	=> hash('sha512', $password . $user_browser),
						'is_logged_in'	=> true
					));
					
					return true;
				}
				else
				{
					$data = array(
						'user_id'	=> $user->id, 
						'time'		=> time()
					);
					
					$this->db->insert('login_attempts', $data);
					
					return false;
				}
			}
		}
		else
		{
			return false;
		}
	}
	//-- eo login
	
	/**
	 * check brute force attacks
	 * @param int user_id
	 * return bool
	 */
	public function checkbrute( $user_id )
	{
		$now = time();
		$valid_attempts = $now - ( 2 * 60 * 60 );
		
		$this->db->select( 'time' );
		$this->db->from( 'login_attempts' );
		$this->db->where( 'user_id', $user_id );
		$this->db->where( 'time >', $valid_attempts );
		$attempt = $this->db->get();
		
		if ( $attempt->num_rows() > 5 )
			return true;
		else
			return false;
	}
	//-- eo checkbrute
	
	/**
	 * login check
	 * return bool
	 */
	public function login_check()
	{
		if ($this->session->userdata( 'user_id' )	&&
			$this->session->userdata( 'username' )	&&
			$this->session->userdata( 'login_string' )
		)
		{
			$user_id	 = $this->session->userdata( 'user_id' );
			$login_string= $this->session->userdata( 'login_string' );
			$username	 = $this->session->userdata( 'username' );
			$user_browser= $_SERVER['HTTP_USER_AGENT'];
			
			$this->db->select( 'password' );
			$this->db->from( 'members' );
			$this->db->where( 'id', $user_id );
			$this->db->limit( 1 );
			$stmt = $this->db->get();
			
			if ( $stmt->num_rows() == 1 )
			{
				$login_check = hash( 'sha512', $password . $user_browser );
				if ( $login_check == $login_string )
					return true;
				else
					return false;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}
	//-- eo login_check
	/**
	 * sanitizes the output
	 * @param string $url
	 * return string
	 */ 
	public function esc_url( $url )
	{
		if ( '' == $url )
			return $url;
		
		$url	= preg_replace( '|[^a-z0-9-~+_.?#=!&;,/:%@$\|*\'()\\x80-\\xff|i]', '', $url );
		$strip	= array( '%0d', '%0a', '%0D', '%0A' );
		$url	= (string) $url;
		$count	= 1;
		
		while ( $count )
		{
			$url = str_replace( $strip, '', $url, $count );
		}
		$url	= str_replace( ';//', '://', $url );
		$url	= htmlentities( $url );
		$url	= str_replace( '&amp;', '&#038', $url );
		$url	= str_replace( "'", '&#039', $url );
		
		if ( $url[0] !== '/' )
			return '';
		else
			return $url;
	}
	//-- eo esc_url
	
	/**
	 * création d'un nouvel utilisateur
	 * @param string username	nom d'utilisateur
	 * @param string email		courriel
	 * @param string password	mot de passe
	 * return bool
	 */
	public function register( $username, $email, $password )
	{
		$this->db->from( 'members' );
		$this->db->where( 'email', $email );
		$this->db->limit( 1 );
		$query = $this->db->get();
		
		if ( $query->num_rows() == 1 )
			return false;
		
		//-- l'extension extension=php_openssl.dll doit être activée
		$random_salt= hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));
		$password	= hash('sha512', $password . $random_salt);
		
		$data = array(
			'username'	=> $username,
			'email'		=> $email,
			'password'	=> $password,
			'salt'		=> $random_salt
		);
		$this->db->insert('members', $data);
		return ($this->db->affected_rows() != 1) ? false : true;
	}
	//-- eo register
}