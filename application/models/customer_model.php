<?php
//reference-link://http://www.codenameninja.com/display-messages-using-flashdata-in-codeigniter.html
class Customer_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function authenticat_user($email,$password,$user_type=USER_MEMBER)
	{
		$data = array('email' => $email, 'password' => sha1($password),'type'=>$user_type,'status' => '1');
		$this->db->select('customer.*');
		$row = $this->db->get_where('customer', $data)->row_array();
		if (!empty($row))
			return $row;
		else
			return false;	
	}
	
	function is_cust_exist($email , $pass = '')
	{
		$this->db->where('email',$email);
		$this->db->where('password',$strName);
		return $this->db->get('customer')->row_array();
	}
	
}
?>