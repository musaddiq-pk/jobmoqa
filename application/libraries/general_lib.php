<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class General_lib
{
	public function __construct()
	{
		$this->CI =& get_instance();
	}
		
	function send_mail($email_data='')
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.SITE_NAME;
		
		extract($email_data);
		return mail($to,$subject,$message,$headers);
	}	
	
	function get_curr_date()
	{
		return 	date('Y-m-d');
	}
	
	function get_fcurr_date()
	{
		return 	date('d-m-Y');
	}
	
	function get_prev_date($time='')
	{
		return date('Y-m-d',strtotime($time));
	}
	
	function show_date($date)
	{
		return 	date('d-m-Y',strtotime($date));	
	}
	
	function set_db_date($date)
	{
		if($date == '')
			return '0000-00-00';
		return 	date('Y-m-d',strtotime($date));	
	}
	
	function show_fdate($date)
	{
		return 	date('l, d F  Y',strtotime($date));	
	}
	
	
	function reset_admin_paging($cur_page = '',$page_data = NULL)
	{
		$admin_pages = array('category','sub_cat');
		$this->CI =& get_instance();
		//Unset all the pages sessein except current page
		foreach($admin_pages as $page)
		{
			if($page !== $cur_page)
				$this->CI->session->unset_userdata($page);
		}
		//Reste session for the current page
		if($page_data != NULL)
			$this->CI->session->set_userdata($cur_page,$page_data);	
	}
	
	function reset_front_paging($cur_page = '',$page_data = NULL)
	{
		$front_pages = array('front_cat','front_paper','front_search');
		$this->CI =& get_instance();
		//Unset all the pages sessein except current page
		foreach($front_pages as $page)
		{
			if($page !== $cur_page)
				$this->CI->session->unset_userdata($page);
		}
		//Reste session for the current page
		if($page_data != NULL)
			$this->CI->session->set_userdata($cur_page,$page_data);	
	}
	
	function show_flash_message($msg_name='', $type='error')
	{
		$this->CI =& get_instance();
		$message = $this->CI->session->flashdata($msg_name);
		$return_msg = '';
		if($message != '')
		{
			if($type == 'error')
				$return_msg = '<p class="flash_error_msg">'.$message.'</p>';
			else
				$return_msg = '<p class="flash_success_msg">'.$message.'</p>';	
		}
		return $return_msg;
	}
	
	function genrate_pass($length = 8){
	
		$password = "";
		$possible = "[%$@$({2346789bcdfghjkmnpqrtvwxyzBCDFGHJKLMNPQRTVWXYZ";
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
	
	function upload_image($file_data=NULL)
	{	
		$this->CI =& get_instance();
		set_time_limit(0);
		
		ini_set( 'memory_limit', '200M' );
		ini_set('upload_max_filesize', '200M');  
		ini_set('post_max_size', '200M');  
		ini_set('max_input_time', 3600);  
		ini_set('max_execution_time', 3600);
		
		$allowed_types = 'gif|jpg|jpeg|jpe|png';
		extract($file_data);
		
		//ini_set("memory_limit", "300M");		
		$config['upload_path'] = $upload_path;
		$config['allowed_types'] = $allowed_types;
		$config['max_size']	= '1000000';
		$config['max_width']  = '1024000';
		$config['max_height']  = '768000';
		$config['file_name'] = $file_name;
		
		if(isset($first_file) && $first_file == 1)			
			$this->CI->load->library('upload');	
		$this->CI->upload->initialize($config);			
		$this->CI->upload->do_upload($txt_file);	
		
		$upload_data = $this->CI->upload->data();
		//print_r($upload_data);exit;
		if($upload_data)
			return $upload_data['file_name'];
		else
			return false;
	}
	
	//DB functions
	function exec_query($data=NULL)
	{	
		//echo '<pre>';print_r($data);echo '</pre>';exit;
		$this->CI =& get_instance();
		extract($data);
		
		$this->CI->db->distinct();
		if($select)
			$this->CI->db->select($select);
			 
	  	if(isset($join))
		{
		   foreach($join as $j)
		   { if(isset($j['type']))
			 $this->CI->db->join($j['table'],$j['on'],$j['type']);
			else
			 $this->CI->db->join($j['table'],$j['on']);
			}
		 }
		if(isset($where) && $where != '')
			$this->CI->db->where($where);
		if(isset($like) && $like != '')
			$this->CI->db->where($like);
		if(isset($where_in))
			$this->CI->db->where_in($where_in);
		if(isset($group_by))
			$this->CI->db->group_by($group_by);
		if(isset($having))
			$this->CI->db->having($having);
	  
	  if(isset($limit))
	   $this->CI->db->limit($limit['limit'],$limit['offset']);
	  
	  if(!empty($order))
		{
			$order_type = 'DESC';
			if(isset($order['order']))
				$order_type = $order['order'];
			$this->CI->db->order_by($order['order_by'],$order_type);
		}
	  
	  
	  $query = $this->CI->db->get($table);
	  if(isset($count) && $count == 1)
	   return $query->num_rows();
	  if(isset($single_row) && $single_row == 1)
	   return $query->row_array();
	  return $query->result_array();	
	}
}
?>