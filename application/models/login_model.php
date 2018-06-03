<?php
//reference-link://http://www.codenameninja.com/display-messages-using-flashdata-in-codeigniter.html
class Login_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function is_logged_in()
	{
		$user_data = $this->session->all_userdata();
		if(!empty($user_data))
			return $user_data;
		else
			redirect(BASE_URL);
	}
	
	function is_admin()
	{
		$user_data = $this->is_logged_in();
		if($user_data['user_type'] != USER_ADMIN)
			redirect(ADMIN_BASE_URL);
		else
			return USER_ADMIN;		
	}
	
	function is_member()
	{
		$user_data = $this->is_logged_in();
		if($user_data['user_type'] != USER_MEMBER)
			redirect(ADMIN_BASE_URL);
		else
			return USER_MEMBER;		
	}
	/*Helllo.....*/	
	
	function reset_admin_paging($cur_page = '',$page_data = NULL)
	{
		//$admin_pages = array('order','item','sub_cat','raw_data');
		$admin_pages = array('order','sub_cat');
		//Unset all the pages sessein except current page
		foreach($admin_pages as $page)
		{
			if($page !== $cur_page)
				$this->session->unset_userdata($page);
		}
		//Reste session for the current page
		if($page_data != NULL)
			$this->session->set_userdata($cur_page,$page_data);	
	}
	
	function delete_older_items()
	{
		$date_limit = date('Y-m-d H:i:s',strtotime('-120 hour'));
		$this->db->where('OrderDate <=',$date_limit);
		$this->db->delete('basket');
	}
	
	function authenticat_user($user_name,$password,$user_type=USER_MEMBER)
	{
		$arrWhere = array('user_name' => $user_name, 'password' => sha1($password),'user_type'=>$user_type,'Status' => '1');
		$this->db->select('users.*');
		$row = $this->db->get_where('users', $arrWhere)->row_array();
		if (!empty($row))
			return $row;
		else
			return false;	
	}
	
	function cust_authentication($data)
	{
		$arrWhere = array('Password' => $data['Password'],'Email' => $data['Email'],'Status'=>2);
		$query = $this->db->get_where('customer', $arrWhere)->row_array();
		if ($query == TRUE)
			return $query;
		else
			return 0;	
	}
	
	function get_users($limits=0,$offsets=0)
	{
		if ($limits!=0)
			$query = $this->db->get('user',$limits,$offsets);
		else	
		{
			$query = $this->db->get('user');			
		}
		return $query->result_array(); 
	}
	function isUserExist($strName , $nId = '')
	{
		if ($nId > 0)
			$this->db->where('pkUserId <> ',$nId);
		$this->db->where('Name',$strName);
		return $this->db->get('user')->num_rows();
	}
	function change_password($nId, $newPwd)
	{
		echo 'password=>>>'.$newPwd;
		$data = array(
		'Password'=>$newPwd
		);
		$this->db->where('pkUserId',$nId);
		$this->db->update('user',$data);
		if($this->db->affected_rows() == '1')
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_states()
	{
		$query = $this->db->get('us_states');	
		return $query->result_array();
	}

	function isExistUser($strEmail='',$password='')
	{
			//$query = $this->db->get_where('customer',array('Email'=>$strEmail))->num_rows();
			$this->db->where('Email',$strEmail);
			if($password != '')
				$this->db->where('Password',sha1($password));
			$query = $this->db->get('customer')->num_rows();
			if($query > 0)
				return TRUE;
			else
				return	FALSE;
	}
	function isExistUserName($strFName)
	{
			$query = $this->db->get_where('customer',array('FirstName'=>$strFName))->num_rows();
			if($query > 0)
				return TRUE;
			else
				return	FALSE;
	}
	
	
	function change_customer_password($strEmail='',$password='')
	{
		$this->db->where('Email',$strEmail);
		$data = array('Password'=>$password);
		$this->db->update('customer',$data);
		return $password;
		
	}
	
	function genrate_pass($length = 8){
	
		$password = "";
		$possible = "[%$@$(2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
    	$maxlength = strlen($possible);  
   		if ($length > $maxlength) {
		  $length = $maxlength;
		}
		$i = 0;
		while ($i < $length) { 
		  $char = substr($possible, mt_rand(0, $maxlength-1), 1);
		  if (!strstr($password, $char)) { 
			$password .= $char;
			$i++;
		  }
		}
    	return $password;
	}
	
	function get_captch_chars()		
	{
		
		$chars = "abcdefghijkmnopqrstuvwxyz023456789";
		srand((double)microtime()*1000000);
		$i = 0;
		$pass = '' ;
		while ($i <= 7) {
			$num = rand() % 33;
			$tmp = substr($chars, $num, 1);
			$pass = $pass . $tmp;
			$i++;
		}
		$code=$pass;
		return $code;
	}
}
?>