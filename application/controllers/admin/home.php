<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{
	var $user_logged_in = '';
	public function __construct()
	{
		parent::__construct();
		
		$this->user_logged_in = $this->user_model->is_logged_in();
	}

	public function index()
	{	
		$data['user_logged_in'] = $this->user_logged_in;
		$data['content_heading'] = 'Welcome to Jackets4Bicker Administration Panel!';
		$data['title'] = 'Home';
		$this->template->load('admin/template/template_admin', 'admin/home',$data);
			
	}
}

