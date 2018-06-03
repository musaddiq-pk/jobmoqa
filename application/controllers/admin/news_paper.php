<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_paper extends CI_Controller{
	
	var $user_logged_in = '';
	
	var $segment = array();
	var $table_data = array();
	function __construct()
	{
		parent::__construct();
		
		$this->user_logged_in = $this->user_model->is_logged_in();
		//$this->load->model('ad_model');
		$this->table_data = $this->config->item('table_data');
		$this->table_data['table'] = 'news_paper';
	}
	
	public function index()
	{
		$this->manage();	
	}
	
	public function manage()
	{		
		$paper_data = $paper_count = $this->table_data;
		$paper_count['count'] = true;
		$segment = intval($this->uri->segment(4));
		$nStatus = 1;
		$config['base_url'] = ADMIN_BASE_URL.'news_paper/manage';
		$config['total_rows'] = $this->general_model->get_records($paper_count);
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
		
		$data['title'] = 'Manage News Papers';
		$data['content_heading'] =  'Manage News Papers';
		$data['add_url'] =  ADMIN_BASE_URL.'news_paper/add';
		$data['view_all_url'] =  ADMIN_BASE_URL.'news_paper/manage';
		$data['total_records'] = $config['total_rows'];
		
		$paper_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		$data['arr_papers'] =  $this->general_model->get_records($paper_data);
		$data['offset']= $segment;
		//echo '<pre>';print_r($data['arr_cats']);echo '</pre>';exit;
		$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/manage_news_papers', $data);
	}
	
	
	
	function add($id = 0)
	{
		$this->form_validation->set_error_delimiters('<p class="error error_msg">', '</p>');
		//echo '<pre>';print_r($_POST);echo '</pre>';
		if($this->form_validation->run('newspapaer') == FALSE)
		{
			if($id == 0)
			{
				$data['paper'] = array('id'=>$id,'name'=>'','image'=>'','desc'=>'','seo_title'=>'','seo_meta_desc'=>'');
				$data['button']='Add'; 
				$data['content_heading'] =  'Add New Paper';
				$data['action'] = ADMIN_BASE_URL.'news_paper/add';
			}
			else
			{
				$paper_data = $this->table_data;
				$paper_data['where']  = array('id'=>$id);
				$paper_data['single_row']  = true;
				$data['paper'] = $this->general_model->get_records($paper_data);
				
				$data['button']='Update';
				$data['content_heading'] =  'Edit News Paper';
				$data['action'] = ADMIN_BASE_URL.'news_paper/add/'.$id;
			}
			
			$data['title'] = 'Manage News Papers';
			$data['view_all_url'] =  ADMIN_BASE_URL.'news_paper';
			$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/add_news_paper', $data);	
		}
		else
		{
			extract($_POST);
			//$cur_date = $this->general_lib->get_curr_date();
			$url = strtolower(url_title($paper_name));
			$data = array('name'=>$paper_name,'url'=>$url,'desc'=>$desc,'seo_title'=>$seo_title,'seo_meta_desc'=>$seo_meta_desc);
			//Adding new record...
			if($id == 0)
			{
				$data['order'] = $this->db->count_all_results('news_paper');+1;
				$id = $this->general_model->add('news_paper',$data);
				if($id)
					$this->session->set_flashdata('success_message','News Paper is added successfully.');
			}
			else
			{
				$result = $this->general_model->update('news_paper',$data,array('id'=>$id));
				if($result)
					$this->session->set_flashdata('success_message','News Paper is updated successfully.');
			}
			if($id > 0 && (isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''))
			{
				$file_name = $url.'-'.$id;
				if(file_exists(FCPATH.'uploads/newspaper/'.$old_img))
					unlink(FCPATH.'uploads/newspaper/'.$old_img);
				$file_data = array('first_file'=>1,'txt_file'=>'image','file_name'=>$file_name,'upload_path'=>'./uploads/newspaper/');
				$file_name = $this->general_lib->upload_image($file_data);
				if($file_name)
				{
					$img_data = array('image'=>$file_name);	
					$this->general_model->update('news_paper',$img_data,array('id'=>$id));
				}
			}
			
			
			redirect(ADMIN_BASE_URL.'news_paper');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */