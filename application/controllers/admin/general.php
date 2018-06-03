<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General extends CI_Controller{
	
	var $user_logged_in = '';
	function __construct()
	{
		parent::__construct();
		
		$this->user_logged_in = $this->user_model->is_logged_in();
	}
		
	public function  delete()
	{
		$table = $_POST['table'];
		$id = $_POST['id'];
		if(isset($_POST['file']))
		{
			$file = $_POST['file'];
			$path = '/'.$_POST['path'].'/';
			if(file_exists(FCPATH.$path.$img))
				unlink(FCPATH.$path.$img);
		}
		$status = $this->general_model->delete($table,array('id'=>$id));		
		echo $status;
	}
	
	public function change_status()
	{
		$table = $_POST['table'];
		$id = $_POST['id'];
		$status = $_POST['status'];
		
		if($status == '1')
			$status = 0;
		else
			$status = 1;
		$data = array('status'=>$status);
		$res = $this->general_model->update($table,$data,array('id'=>$id));
		if($res)
			echo 1;
		else
			echo 0;
	}	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */