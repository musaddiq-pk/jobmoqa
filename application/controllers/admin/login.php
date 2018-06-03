<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		//if($this->user_model->is_admin())
			//redirect(ADMIN_BASE_URL.'home');
		$this->load->model('user_model');
	}

	public function index()
	{	
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if($this->form_validation->run('admin_login')=== FALSE)
		{
			$data['title'] = 'Login';
			$this->template->load('admin/template/template_login', 'admin/login',$data);			
		}
		else
		{
			$row = $this->user_model->authenticat_user($_POST['txtUserName'],$_POST['txtPassword']);
			//echo '<pre>';print_r($row);echo '</pre><hr />';
			$session_data = array('admin_id'=>$row['id'],'admin_user_email'=>$row['email'],'admin_login_name'=>$row['name'],'admin_role_type'=>$row['role'],'admin_id'=>$row['id']);
			if(!empty($row))
			{
				$this->session->set_userdata($session_data);
				redirect(ADMIN_BASE_URL.'home');
			}
			else
			{
				
				$this->session->set_flashdata('login_error', 'Invalid username or password!');
				redirect(ADMIN_BASE_URL);				
			}
		}
	}
	
	public function logout()
	{
		$user_data = $this->session->all_userdata();
		/*$user_type = $user_data['user_type'];
		$redirect_url = BASE_URL ;
		if($user_type == USER_ADMIN)*/
		$redirect_url = ADMIN_BASE_URL ;
		$this->session->unset_userdata($user_data);
		redirect($redirect_url);
	}
	
	public function site_admin()
	{
		$data['title'] = 'System Administration';
		$this->template->load('fn/template_admin/template_system_admin', 'admin/system_admin',$data);	
	}
	
	public function change_password()
	{
		
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$newPwd = $this->input->post('txtNewPwd');		
		if($this->form_validation->run('change_pwd')=== FALSE)
		{
			$data['title'] = 'Change Password';
			$this->template->load('fn/template_admin/template_login', 'admin/change_password',$data);			
		}
		else
		{
			$nId = $this->session->userdata('userid');			
			$rsChange = $this->user_model->change_password($nId, $newPwd);	
			if($rsChange)
			{
				$this->session->set_flashdata('message','Your password has been changed successfully.');
				redirect(ADMIN_BASE_URL.'main/change_password');	
					
			}
			else
				echo 'Fail to change password';		
		}
		
	}
}