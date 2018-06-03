<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Docs extends CI_Controller{
	
	//var $user_logged_in = '';
	
	var $segment = array();
	var $table_data = array();
	function __construct()
	{
		parent::__construct();
		
		$this->user_logged_in = $this->user_model->is_logged_in();
		//$this->load->model('ad_model');
		$this->table_data = $this->config->item('table_data');
		$this->table_data['table'] = 'docs';
	}
	
	public function index()
	{
		$this->manage();	
	}
	
	public function manage()
	{	
		$type = $status = -1;
		if(isset($_POST['type']))
		{
			$type = $_POST['type'];
			$status = $_POST['status'];
		}
		else
		{	
			$sesseion_data = $this->session->userdata('docs_admin');
			if(isset($sesseion_data) && $sesseion_data != '')
			{	
				extract($sesseion_data);
			}
		}
		$search_data = array('type'=>$type,'status'=>$status);
		$this->general_lib->reset_admin_paging('docs_admin',$search_data);
		
		$arr_where = array();
		if($type != -1)
			$arr_where['type'] = $type;
		if($status != -1)
			$arr_where['status'] = $status;
		
		$docs_data = $docs_count = $this->table_data;
		$docs_count['count'] = true;
		$segment = intval($this->uri->segment(4));
		$nStatus = 1;
		$config['base_url'] = ADMIN_BASE_URL.'docs/manage';
		$config['total_rows'] = $this->general_model->get_records($docs_count);
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
		
		$data['title'] = 'Manage Documents';
		$data['content_heading'] =  'Manage Documents';
		$data['add_url'] =  ADMIN_BASE_URL.'docs/add';
		$data['view_all_url'] =  ADMIN_BASE_URL.'docs/manage';
		$data['total_records'] = $config['total_rows'];
		//print_r($search_data);exit;
		
		$docs_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		$data['arr_docs'] =  $this->general_model->get_records($docs_data);
		$data['offset']= $segment;
		//echo '<pre>';print_r($data['arr_cats']);echo '</pre>';exit;
		$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/manage_documents', $data);
	}
		
	function add($id = 0)
	{
		$this->form_validation->set_error_delimiters('<p class="error error_msg">', '</p>');
		//echo '<pre>';print_r($_POST);echo '</pre>';
		if($this->form_validation->run('document') == FALSE)
		{
			if($id == 0)
			{
				$data['document'] = array('id'=>$id,'title'=>'','file'=>'','image'=>'','type'=>'');
				$data['button']='Add'; 
				$data['content_heading'] =  'Add New Document';
				$data['action'] = ADMIN_BASE_URL.'docs/add';
			}
			else
			{
				$docs_data = $this->table_data;
				$docs_data['where']  = array('id'=>$id);
				$docs_data['single_row']  = true;
				$data['document'] = $this->general_model->get_records($docs_data);
				
				$data['button']='Update';
				$data['content_heading'] =  'Edit Document';
				$data['action'] = ADMIN_BASE_URL.'docs/add/'.$id;
			}
			
			$data['types'] = $this->config->item('doc_types');
			$data['title'] = 'Manage Documents';
			$data['view_all_url'] =  ADMIN_BASE_URL.'docs';
			$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/add_document', $data);	
		}
		else
		{
			extract($_POST);
			$data = array('title'=>$doc_title,'type'=>$type);
			//Adding new record...
			if($id == 0)
			{
				$this->db->where('type', $type);
				$this->db->from('docs');
				$data['order'] = $this->db->count_all_results()+1;
				//$data['order'] = $this->db->count_all_results('docs');+1;
				$id = $this->general_model->add('docs',$data);
				if($id)
					$this->session->set_flashdata('success_message','Document is added successfully.');
			}
			else
			{
				$result = $this->general_model->update('docs',$data,array('id'=>$id));
				if($result)
					$this->session->set_flashdata('success_message','Document is updated successfully.');
			}
			//echo FCPATH.'uploads/docs/'.$old_img;exit;
			if($id > 0 && (isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''))
			{
				$img_name = url_title($doc_title);
				if(file_exists(FCPATH.'uploads/docs/'.$old_img))
					unlink(FCPATH.'uploads/docs/'.$old_img);
				
				$file_data = array('first_file'=>1,'txt_file'=>'image','file_name'=>$img_name,'upload_path'=>'./uploads/docs/');
				$file_name = $this->general_lib->upload_image($file_data);
				if($file_name)
				{
					$img_data = array('image'=>$file_name);	
					$this->general_model->update('docs',$img_data,array('id'=>$id));
				}
			}
			
			if($id > 0 && (isset($_FILES['file']['name']) && $_FILES['file']['name'] != ''))
			{
				$file_name = url_title($doc_title);
				if(file_exists(FCPATH.'uploads/docs/'.$old_file))
					unlink(FCPATH.'uploads/docs/'.$old_file);
				
				$file_data = array('txt_file'=>'file','file_name'=>$file_name,'upload_path'=>'./uploads/docs/','allowed_types'=>'docx');
				$file_name = $this->general_lib->upload_image($file_data);
				if($file_name)
				{
					$img_data = array('file'=>$file_name);	
					$this->general_model->update('docs',$img_data,array('id'=>$id));
				}
			}
			redirect(ADMIN_BASE_URL.'docs');
		}
	}
	
	public function  delete()
	{
		$id = $_POST['id'];
		$ad_data = $this->table_data;
		$ad_data['single_row'] = 1;
		$ad_data['select'] = array('id','file','image');
		$ad_data['where'] = array('id'=>$id);
		$row = $this->general_model->get_records($ad_data);
		$img = $row['image'];
		$file = $row['file'];
		$doc_path = 'uploads/docs/';
		if(file_exists(FCPATH.$doc_path.$img))
			unlink(FCPATH.$doc_path.$img);
		if(file_exists(FCPATH.$doc_path.$file))
			unlink(FCPATH.$doc_path.$file);
		
		$status = $this->general_model->delete('docs',array('id'=>$id));		
		echo $status;
	}	
}

/* End of file Docs.php */
/* Location: ./application/controllers/welcome.php */