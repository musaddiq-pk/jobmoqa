<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ad extends CI_Controller{
	
	var $user_logged_in = '';
	
	var $segment = array();
	var $ad_data = array();
	function __construct()
	{
		parent::__construct();
		
		$this->user_logged_in = $this->user_model->is_logged_in();
		$this->load->model('ad_model');
		$this->ad_data = $this->config->item('table_data');
		$this->ad_data['table'] = 'ad';
	}
	
	public function index()
	{
		$this->manage();	
	}
	
	public function manage()
	{		
		$cat_id = $paper_id = $status = -1;
		if(isset($_POST['cat_id']))
		{
			$cat_id = $_POST['cat_id'];
			$paper_id = $_POST['paper_id'];
			$status = $_POST['status'];
		}
		else
		{	
			$sesseion_data = $this->session->userdata('ad_admin');
			if(isset($sesseion_data) && $sesseion_data != '')
			{	
				extract($sesseion_data);
			}
		}
		$search_data = array('cat_id'=>$cat_id,'paper_id'=>$paper_id,'status'=>$status);
		$this->general_lib->reset_admin_paging('ad_admin',$search_data);
		
		$arr_where = array();
		if($cat_id != -1)
			$arr_where['ad_category.cat_id'] = $cat_id;
		if($paper_id != -1)
			$arr_where['ad_newspaper.newspaper_id'] = $paper_id;
		if($status != -1)
			$arr_where['ad.status'] = $status;
			
		$ad_data = $ad_count = $cat_data = $paper_data = $this->ad_data;
		$ad_data['where'] = $ad_count['where'] = $arr_where;
		$ad_count['count'] = true;
		$segment = intval($this->uri->segment(4));
		$nStatus = 1;
		$config['base_url'] = ADMIN_BASE_URL.'ad/manage';
		$config['total_rows'] = $this->ad_model->get_ad($ad_count);
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
		
		//$data['user_logged_in'] = $this->user_logged_in;
		$data['title'] = 'Manage Ad';
		$data['content_heading'] =  'Manage Ad';
		$data['add_url'] =  ADMIN_BASE_URL.'ad/add';
		$data['view_all_url'] =  ADMIN_BASE_URL.'ad/manage';
		$data['total_records'] = $config['total_rows'];
		
		$data['search_data'] = $search_data;
		//print_r($search_data);exit;
		
		$ad_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		$arr_ad =  $this->ad_model->get_ad($ad_data);
		$temp = array();
		foreach($arr_ad as $row)
		{
			$temp1 = $temp2 = array();
			$id = $row['id'];
			$cats = $this->ad_model->get_ad_cats($id);
			foreach($cats as $cat)
				$temp1[] = $cat['name'];	
			$papers = $this->ad_model->get_ad_papers($id);
			foreach($papers as $paper)
				$temp2[] = $paper['name'];
				
			$row['cats'] = implode(', ',$temp1);
			$row['papers'] = implode(', ',$temp2);
			$temp[] = $row;
		}
		
		//echo '<pre>';print_r($temp);echo '</pre>';exit;
		$data['arr_ad'] = $temp;
		$data['offset']= $segment;
		
		$cat_data['table'] = 'category';
		$paper_data['table'] = 'news_paper';
		$data['categories'] = $this->general_model->get_records($cat_data);
		$data['papers'] = $this->general_model->get_records($paper_data);
		
		$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/manage_ad', $data);
	}
	
	
	
	function add($id = 0)
	{
		//echo validation_errors();
		$this->form_validation->set_error_delimiters('<p class="error error_msg">', '</p>');
				
		if($this->form_validation->run('ad') == FALSE)
		{
			$cat_ids = $paper_ids = array();
			$cur_date = $this->general_lib->get_fcurr_date();
			if($id == 0)
			{	
				$data['ad'] = array('name'=>'','required_skills'=>'','ad_date'=>$cur_date,'last_date'=>$cur_date,'region'=>'','desc'=>'','image'=>'','seo_title'=>'','seo_meta_desc'=>'');
				$data['button']='Add'; 
				$data['content_heading'] =  'Add New Ad';
				$data['action'] = ADMIN_BASE_URL.'ad/add';
			}
			else
			{
				$item_data = $ad_cat_data = $ad_paper_data = $this->ad_data;
				$item_data['where']  = array('id'=>$id);
				$item_data['single_row']  = true;
				$data['ad'] = $this->general_model->get_records($item_data);
				
				$ad_cat_data['table'] = 'ad_category';
				$ad_paper_data['table'] = 'ad_newspaper';
				$ad_cat_data['where'] = $ad_paper_data['where'] = array('ad_id'=>$id); 
				$ad_cats = $this->general_model->get_records($ad_cat_data);
				$ad_paers = $this->general_model->get_records($ad_paper_data);
				foreach($ad_cats as $row)
					$cat_ids[] = $row['cat_id'];
				foreach($ad_paers as $row)
					$paper_ids[] = $row['newspaper_id'];
				//print_r($paper_ids);exit;
				
				
				$data['button']='Update';
				$data['content_heading'] =  'Edit Ad';
				$data['action'] = ADMIN_BASE_URL.'ad/add/'.$id;
			}
			
			$region_data = $this->ad_data;
			$region_data['table']  = 'region';
			$data['regions'] = $this->general_model->get_records($region_data);
			//echo '<pre>';print_r($data['regions']);echo '</pre>';exit;
			$data['chk_cats'] = $this->general_model->chk_cats($cat_ids);
			$data['chk_news'] = $this->general_model->chk_news($paper_ids);
			//$data['user_logged_in'] = $this->user_logged_in;
			$data['selected_cats'] = implode(',',$cat_ids);
			$data['selected_papers'] = implode(',',$paper_ids);
			$data['title'] = 'Manage Ad';
			$data['view_all_url'] =  ADMIN_BASE_URL.'ad';
			$this->template->load(ADMIN_TEMPLATE_URL.'template_admin', 'admin/add_ad', $data);	
		}
		else
		{
			extract($_POST);
			
			$cur_date = date('Y-m-d');
			$url = strtolower(url_title($ad_name));
			$last_date = $this->general_lib->set_db_date($last_date);
			$ad_date = $this->general_lib->set_db_date($ad_date);
			$region = implode(',',$region);
			
			$data = array('name'=>$ad_name,'required_skills'=>$required_skills,'ad_date'=>$ad_date,'last_date'=>$last_date,'region'=>$region,'url'=>$url,'desc'=>$desc,'seo_title'=>$seo_title,'seo_meta_desc'=>$seo_desc,'cdate'=>$cur_date);
			//Adding new record...
			if($id == 0)
			{
				//$data['order'] = $this->general_model->count_all_records('feature')+1;
				$id = $this->general_model->add('ad',$data);
				if($id)
					$this->session->set_flashdata('success_message','Ad is added successfully.');
			}
			else
			{
				//print_r($data);exit;
				unset($data['cdate']);
				$result = $this->general_model->update('ad',$data,array('id'=>$id));
				if($result)
					$this->session->set_flashdata('success_message','Ad is updated successfully.');
			}
			//echo $_FILES['image']['name'];exit;
			if($id > 0 && (isset($_FILES['image']['name']) && $_FILES['image']['name'] != ''))
			{
				$file_name = 'ad-'.$id.'-'.$url;
				
				if(isset($old_img) && $old_img != '')
				{
					if(file_exists(FCPATH.AD_LARGE_IMG.$old_img))
						unlink(FCPATH.AD_LARGE_IMG.$old_img);
					if(file_exists(FCPATH.AD_SMALL_IMG.$old_img))
						unlink(FCPATH.AD_SMALL_IMG.$old_img);
				}
				$file_name = $this->upload_image('image',$file_name);
				if($file_name)
				{
					$img_data = array('image'=>$file_name);	
					$this->general_model->update('ad',$img_data,array('id'=>$id));
				}
			}
			
			//Add category and Newspaper...
			$cats = $cat_name;
			$papers = $paper_name;
			$old_cats = explode(',',$old_cats);
			$old_papers = explode(',',$old_papers);
			//Delete categories those are not selected...
			for($i=0; $i < count($old_cats); $i++)
			{
				if(!in_array($old_cats[$i],$cats))
					$this->general_model->delete('ad_category',array('cat_id'=>$old_cats[$i],'ad_id'=>$id));
			}
			//Delete papers those are not selected
			
			for($i=0; $i < count($old_papers); $i++)
			{
				if(!in_array($old_papers[$i],$papers))
					$this->general_model->delete('ad_newspaper',array('newspaper_id'=>$old_papers[$i],'ad_id'=>$id));
			}
			foreach($cats as $val)
			{	if(!in_array($val,$old_cats))
				{
					$cat_data = array('cat_id'=>$val,'ad_id'=>$id);
					$this->general_model->add('ad_category',$cat_data);
				}
			}
			foreach($papers as $val)
			{
				if(!in_array($val,$old_papers))
				{
					$paper_data = array('newspaper_id'=>$val,'ad_id'=>$id);
					$this->general_model->add('ad_newspaper',$paper_data);
				}
			}
			//$this->update_search_field($id);
			
			redirect(ADMIN_BASE_URL.'ad');
		}
	}
	
	public function  delete()
	{
		$id = $_POST['ad_id'];
		$ad_data = $this->ad_data;
		$ad_data['single_row'] = 1;
		$ad_data['select'] = array('id','image');
		$ad_data['where'] = array('id'=>$id);
		$row = $this->general_model->get_records($ad_data);
		$img = $row['image'];
		if(file_exists(FCPATH.AD_LARGE_IMG.$img))
			unlink(FCPATH.AD_LARGE_IMG.$img);
		if(file_exists(FCPATH.AD_SMALL_IMG.$img))
			unlink(FCPATH.AD_SMALL_IMG.$img);
		
		$status = $this->general_model->delete('ad',array('id'=>$id));		
		echo $status;
	}
	
	public function change_status()
	{
		$id = $_POST['ad_id'];
		$status = $_POST['status'];
		
		if($status == '1')
			$status = 0;
		else
			$status = 1;
		$data = array('status'=>$status);
		$res = $this->general_model->update('ad',$data,array('id'=>$id));
		if($res)
			echo 1;
		else
			echo 0;
	}
	
	function upload_image($txt_file='',$file_name='')
	{	
		set_time_limit(0);
		
		ini_set( 'memory_limit', '200M' );
		ini_set('upload_max_filesize', '200M');  
		ini_set('post_max_size', '200M');  
		ini_set('max_input_time', 3600);  
		ini_set('max_execution_time', 3600);
		
		//ini_set("memory_limit", "300M");		
		$config['upload_path'] = './uploads/ad/large_img/';
		$config['allowed_types'] = 'gif|jpg|jpeg|jpe|png';
		$config['max_size']	= '1000000';
		$config['max_width']  = '2048000';
		$config['max_height']  = '1436000';
		$config['file_name'] = $file_name;
					
		$this->load->library('upload');	
		$this->upload->initialize($config);			
		$this->upload->do_upload($txt_file);	
		
		$upload_data = $this->upload->data();
		//print_r($upload_data);exit;
		$config['source_image']	= $upload_data['full_path'];
		$config['image_library'] = 'gd2';
		$config['maintain_ratio'] = true;
		$config['create_thumb'] = TRUE;
		$config['thumb_marker'] = '';
		$config['width']	 = 380;
		$config['height']	=  220;
		$config['new_image'] = './uploads/ad/small_img/';
		
		$this->load->library('image_lib', $config); 		
		$this->image_lib->resize();
		$this->image_lib->clear();
		if($upload_data)
			return $upload_data['file_name'];
		else
			return false;
	}
		
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */