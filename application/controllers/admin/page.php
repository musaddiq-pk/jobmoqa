<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page extends CI_Controller{
	
	var $user_logged_in = '';
	
	var $segment = array();
	var $table_data = array();
	function __construct()
	{
		parent::__construct();
		
		$this->user_logged_in = $this->user_model->is_logged_in();
		$this->load->model('ad_model');
		$this->table_data = $this->config->item('table_data');
		$this->table_data['table'] = 'page';
	}
	
	public function index()
	{
		$this->manage();	
	}
	
	public function manage()
	{					
		$page_data = $page_count = $this->table_data;
		$page_count['count'] = true;
		$segment = intval($this->uri->segment(4));
		$nStatus = 1;
		$config['base_url'] = ADMIN_BASE_URL.'ad/manage';
		$config['total_rows'] = $this->general_model->get_records($page_count);
		$config['per_page'] = LIMIT; 
		$config['uri_segment'] = 4;
		$config['full_tag_open'] = '<p class="paging_link">';
		$config['first_link'] = '&lt;&lt;';
		$config['next_link'] = 'Next';
		$config['num_links'] = 1;
		$config['prev_link'] = 'Previous';
		$config['last_link'] = '&gt;&gt;';
		$config['full_tag_close'] = '</p>';			
		
		$this->pagination->initialize($config); 
		$data['paging'] =  $this->pagination->create_links();
		$page_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		$data['arr_page'] =  $this->general_model->get_records($page_data);
		//$data['user_logged_in'] = $this->user_logged_in;
		
		$data['title'] = 'Manage Pages';
		$data['content_heading'] =  'Manage Pages';
		$data['add_url'] =  ADMIN_BASE_URL.'page/add';
		$data['view_all_url'] =  ADMIN_BASE_URL.'page/manage';
		$data['total_records'] = $config['total_rows'];
		$data['offset'] = $segment;
		//echo '<pre>';print_r($data['arr_ad']);echo '</pre>';exit;
		$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/manage_pages', $data);
	}
	
	
	
	function add($id = 0)
	{
		
		$this->form_validation->set_error_delimiters('<p class="error error_msg">', '</p>');
		
		//echo '<pre>';print_r($_POST);echo '</pre>';exit;
		if($this->form_validation->run('page') == FALSE)
		{
			$cat_ids = $paper_ids = array();
			if($id == 0)
			{
				$data['page'] = array('id'=>0,'name'=>'','desc'=>'','seo_title'=>'','seo_meta_desc'=>'');
				$data['button']='Add'; 
				$data['content_heading'] =  'Add New Page';
				$data['action'] = ADMIN_BASE_URL.'page/add';
			}
			else
			{
				$page_data = $this->table_data;
				$page_data['where']  = array('id'=>$id);
				$page_data['single_row']  = true;
				$data['page'] = $this->general_model->get_records($page_data);
				
				$data['button']='Update';
				$data['content_heading'] =  'Edit Page';
				$data['action'] = ADMIN_BASE_URL.'page/add/'.$id;
			}
			$data['title'] = 'Manage Pages';
			$data['view_all_url'] =  ADMIN_BASE_URL.'page';
			$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/add_page', $data);	
		}
		else
		{
			extract($_POST);
			$url = strtolower(url_title($page_name));
			$data = array('name'=>$page_name,'url'=>$url,'desc'=>$desc,'seo_title'=>$seo_title,'seo_meta_desc'=>$seo_meta_desc);
			//Adding new record...
			if($id == 0)
			{
				$data['order'] = $this->db->count_all_results('page');+1;
				$id = $this->general_model->add('page',$data);
				if($id)
					$this->session->set_flashdata('success_message','Page is added successfully.');
			}
			else
			{
				//print_r($data);exit;
				unset($data['cdate']);
				$result = $this->general_model->update('page',$data,array('id'=>$id));
				if($result)
					$this->session->set_flashdata('success_message','Page is updated successfully.');
			}
			redirect(ADMIN_BASE_URL.'page');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */