<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Simple config file based ACL
 *
 * @author Kevin Phillips <kevin@kevinphillips.co.nz>
 */
class Acl {

	private $_CI;
	private $acl;

	function __construct() 
	{
		$this->_CI = & get_instance();
		$this->_CI->load->library('session');
		$this->_CI->load->config('acl');
		$this->acl = $this->_CI->config->item('permission');
	}

	/**
	 * function that checks that the user has the required permissions
	 *
	 * @param string $controller
	 * @param array $required_permissions
	 * @param integer $author_uid
	 * @return boolean
	 */
	public function has_permission($controller, $required_permissions = array('delete all'), $author_uid = NULL)
	{
		//echo"permission against controller $controller<br><pre>";print_r($this->acl[$controller]);echo'</pre><hr>';
		
		/* make sure that the required permissions is an array */
		if ( ! is_array($required_permissions))
		{
			$required_permissions = explode( ',', $required_permissions );	
		}
			
		/* Get the vars from ci_session */
		$uid = $this->_CI->session->userdata('uid');
		$arr_sess = $this->_CI->session->all_userdata();
		//print_r($arr_sess);
		//exit;
		if(isset($arr_sess['roles']))
			$user_roles = explode(',',$arr_sess['roles']);
		//echo'user_roles===>>><pre>'; print_r($this->acl); echo'</pre><hr>'; 
		/* Shouldn't happen but if we stick to belt and braces we should be OK */
		if ( ! $uid OR ! $user_roles)
		{
			return FALSE;		
		}	
		
		if(!array_key_exists($controller,$this->acl))
		{
			return FALSE;
		}

		/* set empty array */
		$permissions = array();

		/* Load the permissions config */

		foreach ($this->acl[$controller] as $actions => $roles)
		{
			//echo'action===>>>'.$actions.'<hr>';
			foreach ($user_roles as $user_role)
			{
				//echo'user_roles===>>>'.$user_role.'='.$actions.'<br>';
				if (in_array( $user_role, $roles ))
				{
					//echo'user_roles===>>>'.$user_role.'='.$actions.'<br>';
					$permissions[$actions] = $roles;	
				}					
			}
		}
		//echo'<hr>permissions===>>><pre>'; print_r($permissions); echo'</pre>'; exit;
		foreach ($permissions as $action => $role)
		{
			//echo'action==>>'.$action.'<br>';
			//echo'<pre>';print_r($required_permissions);echo'</pre>';
			if (in_array($action, $required_permissions))
			{
				if (($action == 'edit own' OR $action == 'delete own') && ( ! isset($author_uid) OR $author_uid != $uid))
				{
					return FALSE;
				}
				return TRUE;
			}
		}
	}
	
	/**
	 * Function to see if a user is logged in
	 */
	public function is_logged_in()
	{
		$uid = $this->_CI->session->userdata('uid');
		if ($uid)
		{
			return TRUE;
		}
	}

}

/* End of application/libraries/acl.php */