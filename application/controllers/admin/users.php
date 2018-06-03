<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		//$isLogin = $this->session->all_userdata();	
		$this->user_logged_in = $this->user_model->is_admin();		
	} 
	
	
	public function index(){
		$this->manage_users();
	}
		
	public function manage_users($arrValue = array())
	{		
		$segment = intval($this->uri->segment(4));
		$config['base_url'] = ADMIN_BASE_URL.'users/manage';
		$search_data = array('name'=>NULL,'email'=>NULL,'city'=>NULL,'phone'=>NULL,'zip_code'=>NULL,'status'=>NULL,'user_type'=>NULL);
		$config['total_rows'] = $this->user_model->count_users($search_data);
		$config['per_page'] = LIMIT; 
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<p class="paging_link">';
		$config['first_link'] = 'First';
		$config['next_link'] = 'Next';
		$config['num_links'] = 1;
		$config['prev_link'] = 'Previous';
		$config['last_link'] = 'Last';
		$config['full_tag_close'] = '</p>';			
		
		$this->pagination->initialize($config); 
		$data['paging'] =  $this->pagination->create_links();
		
		$data['user_logged_in'] = $this->user_logged_in;
		$data['title'] = 'Manage Users';
		$data['content_heading'] =  'Manage Users';
		$data['add_url'] =  ADMIN_BASE_URL.'users/add';
		$data['view_all_url'] =  ADMIN_BASE_URL.'users';
		$data['total_records'] = $config['total_rows'];
		
		$data['users'] =  $this->user_model->get_users(LIMIT,$segment,$search_data,'DESC');
		$data['offset']= $segment;
		$this->template->load('template/admin/template_admin', 'admin/manage_users', $data);
	}
	
	public function add($id=0)
	{
		
		$nSegment = $this->uri->segment(4);
		$this->form_validation->set_error_delimiters('<div class="error error_msg">', '</div>');
		if($this->form_validation->run('users') == FALSE)
		{
			
			$data['action'] = ADMIN_BASE_URL.'users/add';
			if($id == 0)
			{
				$data['button']='Add'; 
				$data['action'] = ADMIN_BASE_URL.'users/add';
				$data['edit_user'] = array('UserName'=>'','Password'=>'');							
			}
			else
			{
				
				$data['button']='Update';
				$data['edit_user'] = $this->user_model->getUserById($id) ;
				$data['action'] = ADMIN_BASE_URL.'users/add/'.$id;
			}
				$this->manage_users($data);
			
		}
		else
		{
			$strName = $this->input->post('txtUserName');
			$rsSearch = $this->user_model->isUserExist($strName , $id);
			if($rsSearch)
			{
				$this->session->set_flashdata('message','Record already exist.');
				redirect(ADMIN_BASE_URL.'users');
				exit;
			}
			else
			{
				$data = array(
						   'Name'	  =>	$this->input->post('txtUserName'),
						   'Password' =>	$this->input->post('txtPassword'),
						   'Login' 	  =>	'',
						   'UserType' =>	0,
						   'Email'    =>	''
						   
														  
						 );
				if($id == 0)
				{
					$rsUser = $this->user_model->add_user($data);			
				}
				else
				{
					$rsUser = $this->user_model->edit_user($data,$id);
				}
				if($rsUser)
				{
					redirect(ADMIN_BASE_URL.'users');
				}
				else
				{
					redirect(ADMIN_BASE_URL.'users');
				}
			}
		}
	}
	public function  delete($id)
	{
		$this->user_model->delete($id);
		redirect(ADMIN_BASE_URL.'users');
	}
	
	public function get_user_detail()
	{
		$user_id = $_POST['user_id'];
		$row = $this->general_model->get_single_record('users','pkUserId',$user_id);
		$html = '<div class="show_detail">
                <label class="detail_heading">Phone:</label>
         		<label>'.$row['phone'].'</label>
            	<div class="clear"></div>
                <label class="detail_heading">Address:</label>
         		<label>'.$row['address'].'</label>
            	<div class="clear"></div>            
            </div>';
		echo $html;
	}
	
	public function change_status()
	{
		 $user_id = $_POST['user_id'];
		 $status = $_POST['status'];
		 //$row = $this->user_model->getUserById($nUser);
		 $session_row = $this->session->all_userdata();
		 if($user_id == $session_row['pkUserId'])
		 {
			echo 2;	 
			exit;
		}
		if($status == '1' )
			$status = 0;
		else
			$status = 1;
		$rsChang = $this->general_model->edit_record('users',array('status'=>$status),'pkUserId',$user_id);
		if($rsChang)
			echo 1;
		else
			echo 0;
	}
	
}




/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */