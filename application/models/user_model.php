<?php
//reference-link://http://www.codenameninja.com/display-messages-using-flashdata-in-codeigniter.html
class User_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}	
	
	function authenticat_user($email,$password)
	{
		$data = array('name' => $email, 'password' => sha1($password),'status' => '1');
		$this->db->select('user.*');
		$row = $this->db->get_where('user', $data)->row_array();
		if (!empty($row))
			return $row;
		else
			return false;	
	}
	
	function is_logged_in()
	{
		$admin_id = intval($this->session->userdata('admin_id'));
		if($admin_id > 0)
			return $admin_id;
		else
			redirect(ADMIN_BASE_URL);
	}
}
?>