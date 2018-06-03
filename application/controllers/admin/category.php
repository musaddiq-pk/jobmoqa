<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller{
	
	var $user_logged_in = '';
	
	var $segment = array();
	var $table_data = array();
	function __construct()
	{
		parent::__construct();
		
		$this->user_logged_in = $this->user_model->is_logged_in();
		//$this->load->model('ad_model');
		$this->table_data = $this->config->item('table_data');
		$this->table_data['table'] = 'category';
	}
	
	public function index()
	{
		$this->manage();	
	}
	
	public function manage()
	{		
		$cat_data = $cat_count = $this->table_data;
		$cat_count['count'] = true;
		$segment = intval($this->uri->segment(4));
		$nStatus = 1;
		$config['base_url'] = ADMIN_BASE_URL.'category/manage';
		$config['total_rows'] = $this->general_model->get_records($cat_count);
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
		
		$data['title'] = 'Manage Categries';
		$data['content_heading'] =  'Manage Categries';
		$data['add_url'] =  ADMIN_BASE_URL.'category/add';
		$data['view_all_url'] =  ADMIN_BASE_URL.'category/manage';
		$data['total_records'] = $config['total_rows'];
		//print_r($search_data);exit;
		
		$cat_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		$data['arr_cats'] =  $this->general_model->get_records($cat_data);
		$data['offset']= $segment;
		//echo '<pre>';print_r($data['arr_cats']);echo '</pre>';exit;
		$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/manage_categories', $data);
	}
	
	
	
	function add($id = 0)
	{	//echo validation_errors();exit;
		$this->form_validation->set_error_delimiters('<p class="error error_msg">', '</p>');
		//echo '<pre>';print_r($_POST);echo '</pre>';
		if($this->form_validation->run('category') == FALSE)
		{
			if($id == 0)
			{
				$data['cat'] = array('id'=>$id,'name'=>'','desc'=>'','seo_title'=>'','seo_meta_desc'=>'');
				$data['button']='Add'; 
				$data['content_heading'] =  'Add New Category';
				$data['action'] = ADMIN_BASE_URL.'category/add';
			}
			else
			{
				$cat_data = $this->table_data;
				$cat_data['where']  = array('id'=>$id);
				$cat_data['single_row']  = true;
				$data['cat'] = $this->general_model->get_records($cat_data);
				$data['button']='Update';
				$data['content_heading'] =  'Edit Category';
				$data['action'] = ADMIN_BASE_URL.'category/add/'.$id;
			}
			
			$data['title'] = 'Manage Category';
			$data['view_all_url'] =  ADMIN_BASE_URL.'category';
			$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/add_category', $data);	
		}
		else
		{
			extract($_POST);
			//$cur_date = $this->general_lib->get_curr_date();
			$url = strtolower(url_title($cat_name));
			$data = array('name'=>$cat_name,'parent_id'=>1,'url'=>$url,'desc'=>$desc,'seo_title'=>$seo_title,'seo_meta_desc'=>$seo_meta_desc);
			//Adding new record...
			if($id == 0)
			{
				$data['order'] = $this->db->count_all_results('category');+1;
				$id = $this->general_model->add('category',$data);
				if($id)
					$this->session->set_flashdata('success_message','Category is added successfully.');
			}
			else
			{
				$result = $this->general_model->update('category',$data,array('id'=>$id));
				if($result)
					$this->session->set_flashdata('success_message','Category is updated successfully.');
			}
			redirect(ADMIN_BASE_URL.'category');
		}
	}		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */