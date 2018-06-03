<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ad extends CI_Controller 
{
	var $table_data = array();
	
	var $query_data = array();
	var $menu = array();
	var $about_us = array();
	var $regions = array();
	
	public function __construct()
	{	
		parent::__construct();
		
		
		/*if ($qury_string = $this->input->server('QUERY_STRING', TRUE)) {
			echo 'first => '.$qury_string.'<br />';
            # Check whether the method exists
			$arr = explode('=',$qury_string);
			$method = $arr[0];
			echo 'here => '.$method;exit;
            if (method_exists($this, $method)) {
                # Invoke the method
                call_user_func(array($this, $method));
				echo 'here => '.$method;exit;
            }
        }*/
		
		$this->load->model('ad_model');
		
		$this->menu = $this->general_model->get_menu();
		$this->about_us = $this->menu['about-us'];
		$this->regions = $this->menu['regions'];
		
		$this->table_data = $this->config->item('table_data');
		$this->table_data['table'] = 'ad';
	}
	
	function index()
	{	
		$this->jobs();
	}
	
	function jobs()
	{	
		$segment = intval($this->uri->segment(2));
		$prev_date = $this->general_lib->get_prev_date('-7 days');
		$ad_data = $page_data = $this->table_data;
		
		$ad_data['where'] = array('cdate > '=>$prev_date,'status'=>1); //only one week older jobs
		$ad_data['segment'] = array('limit'=>10,'offset'=>$segment);
		$ad_data['order'] = array('order_by'=>'ad.cdate'); //Order by two different fileds cdate and visits...
		$arr_temp = $this->ad_model->get_ad($ad_data);
		$arr_ad = $this->get_ad_meta($arr_temp);
		//echo '<pre>';print_r($arr_ad);echo '</pre>';exit;
		
		$data['arr_papers'] = $this->get_paper();
		$data['arr_ad'] = $arr_ad;
		$page_data['table'] = 'page';
		$page_data['urls'] = 'home';
		$page_data['single_row'] = true; 
		$page = $this->general_model->get_records($page_data);
		$data['meta_desc'] = $page['seo_meta_desc'];
		$data['title'] = $page['seo_title']. ' | '.SITE_NAME;
		
		$data['menu'] = $this->menu;
		/*$data['about_us'] = $this->about_us;
		$data['about_us'] = $this->about_us;*/
		
		$data['canonical'] = trim(BASE_URL,'/');
		$data['index_follow'] = true;
		$data['is_home'] = true;
		//echo '<pre>';print_r($data['about-us']);echo '</pre>';exit;
		$this->template->load(FRONT_TEMPLATE_URL.'template_home', 'front/home',$data);
	}
	
	function category($url='')
	{	
		$segment = 2;
		$start_date = $this->general_lib->get_curr_date();
		$end_date = $this->general_lib->get_prev_date('-30 days');
		$paper_id = 0;
		
		if(isset($_POST['start_date']))
		{
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$paper_id = $_POST['paper_id'];
		}
		else
		{	
			$sesseion_data = $this->session->userdata('front_cat');
			if(isset($sesseion_data) && $sesseion_data != '')
			{	
				extract($sesseion_data);
			}
		}
		$search_data = array('start_date'=>$start_date,'end_date'=>$end_date,'paper_id'=>$paper_id);
		$this->general_lib->reset_front_paging('front_cat',$search_data);
		
		$cat_data = $ad_count = $ad_data = $this->table_data;
		$cat_data['table'] = 'category';
		$cat_data['where'] = array('url'=>$url); 
		$cat_data['single_row'] = true;
		
		$arr_cat = $this->general_model->get_records($cat_data);
		
		if(empty($arr_cat) || $arr_cat['status'] == 0)
			header('Location: ' .BASE_URL, true, 301);
		
		$cat_id = $arr_cat['id'];
		$ad_count['where'] = $ad_data['where'] = array('ad.status'=>1,'ad_category.cat_id'=>$cat_id,'ad_newspaper.newspaper_id'=>$paper_id,'cdate <='=>$start_date,'cdate >='=>$end_date);
		if($paper_id == 0)
		{
			unset($ad_count['where']['ad_newspaper.newspaper_id']);
			unset($ad_data['where']['ad_newspaper.newspaper_id']);
		}
		$ad_count['count'] = true;
		//print_r($ad_count);exit;
		$segment = intval($this->uri->segment(3));
		$config['base_url'] = BASE_URL.'industry/'.$url;
		$config['total_rows'] = $this->ad_model->get_ad($ad_count);
		$config['per_page'] = LIMIT; 
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['first_link'] = FALSE;
		$config['next_link'] = '&#187';
		$config['num_links'] = NUM_LINKS;
		$config['prev_link'] = '&#171;';
		$config['last_link'] = FALSE;
		$config['full_tag_close'] = '</ul>';			
		$this->pagination->initialize($config); 
		$data['paging'] =  $this->pagination->create_links();
		
		$ad_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		$temp = $this->ad_model->get_ad($ad_data);
		
		$data['search_data'] = $search_data;
		$data['arr_ad'] = $this->get_ad_meta($temp);
		$data['page_heading'] = $arr_cat['name'];
		$data['title'] = $arr_cat['seo_title']. ' | '.SITE_NAME;
		$data['meta_desc'] = $arr_cat['seo_meta_desc'];
		$data['menu'] = $this->general_model->get_menu();
		$data['canonical'] = $config['base_url'];
		$data['index_follow'] = true;
		//echo '<pre>';print_r($arr_cat);echo '</pre>';exit;
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/category_view',$data);
	}
	
	public function news_paper($url='')
	{	
		$segment = 3;
		$start_date = $this->general_lib->get_curr_date();
		$end_date = $this->general_lib->get_prev_date('-30 days');
		$cat_id = 0;
		
		if(isset($_POST['start_date']))
		{
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$cat_id = $_POST['cat_id'];
		}
		else
		{	
			$sesseion_data = $this->session->userdata('front_paper'.$url);
			if(isset($sesseion_data) && $sesseion_data != '')
			{	//echo '<pre>';print_r($sesseion_data);echo '</pre>';exit;
				extract($sesseion_data);
			}
		}
		$search_data = array('start_date'=>$start_date,'end_date'=>$end_date,'cat_id'=>$cat_id);
		$this->general_lib->reset_front_paging('front_paper',$search_data);
		
		$paper_data = $ad_count = $ad_data = $this->table_data;
		$paper_data['table'] = 'news_paper';
		$paper_data['where'] = array('url'=>$url); 
		$paper_data['single_row'] = true;
		
		$arr_paper = $this->general_model->get_records($paper_data);
		
		if(empty($arr_paper) || $arr_paper['status'] == 0)
			header('Location: ' .BASE_URL, true, 301);
		
		$paper_id = $arr_paper['id'];
		$ad_count['where'] = $ad_data['where'] = array('ad.status'=>1,'ad_category.cat_id'=>$cat_id,'ad_newspaper.newspaper_id'=>$paper_id,'ad_date <='=>$start_date,'ad_date >='=>$end_date);
		if($cat_id == 0)
		{
			unset($ad_count['where']['ad_category.cat_id']);
			unset($ad_data['where']['ad_category.cat_id']);
		}
		$ad_count['count'] = true;
		
		//print_r($ad_count);exit;
		$segment = intval($this->uri->segment(2));
		$config['base_url'] = BASE_URL.'epaper/'.$url;
		$config['total_rows'] = $this->ad_model->get_ad($ad_count);
		$config['per_page'] = LIMIT; 
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['first_link'] = FALSE;
		$config['next_link'] = '&#187';
		$config['num_links'] = NUM_LINKS;
		$config['prev_link'] = '&#171;';
		$config['last_link'] = FALSE;
		$config['full_tag_close'] = '</ul>';			
		$this->pagination->initialize($config); 
		$data['paging'] =  $this->pagination->create_links();
		
		$ad_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		
		$temp = $this->ad_model->get_ad($ad_data);

		$data['search_data'] = $search_data;
		$data['arr_ad'] = $this->get_ad_meta($temp);
		$data['page_heading'] = $arr_paper['name'];
		$data['title'] = $arr_paper['seo_title']. ' | '.SITE_NAME;
		$data['meta_desc'] = $arr_paper['seo_meta_desc'];
		$data['menu'] = $this->general_model->get_menu();
		$data['canonical'] = $config['base_url'];
		$data['index_follow'] = true;
		//echo '<pre>';print_r($data['arr_ad']);echo '</pre>';exit;
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/newspaper_view',$data);
	}
	
	function search()
	{	echo 'search...';exit;
		$segment = 2;
		$start_date = $this->general_lib->get_curr_date();
		$end_date = $this->general_lib->get_prev_date('-30 days');
		$cat_id = $paper_id = 0;
		
		
		if(isset($_POST['start_date']))
		{
			$start_date = $_POST['start_date'];
			$end_date = $_POST['end_date'];
			$cat_id = $_POST['cat_id'];
			$paper_id = $_POST['paper_id'];
		}
		else
		{	
			$sesseion_data = $this->session->userdata('front_search');
			/*if(isset($sesseion_data) && $sesseion_data != '')
			{	
				extract($sesseion_data);
			}*/
		}
		
		$search_data = array('start_date'=>$start_date,'end_date'=>$end_date,'cat_id'=>$cat_id,'paper_id'=>$paper_id);
		$this->general_lib->reset_front_paging('front_search',$search_data);
		
		$ad_count = $ad_data = $this->table_data;
		$ad_count['where'] = $ad_data['where'] = array('ad_category.cat_id'=>$cat_id,'ad_newspaper.newspaper_id'=>$paper_id,'cdate <='=>$start_date,'cdate >='=>$end_date);
		//echo '<pre>';print_r($ad_data);exit;
		if($cat_id == 0)
		{
			unset($ad_count['where']['ad_category.cat_id']);
			unset($ad_data['where']['ad_category.cat_id']);
		}
		if($paper_id == 0)
		{
			unset($ad_count['where']['ad_newspaper.newspaper_id']);
			unset($ad_data['where']['ad_newspaper.newspaper_id']);
		}
		$ad_count['count'] = true;
		//print_r($ad_count);exit;
		$segment = intval($this->uri->segment(2));
		$config['base_url'] = BASE_URL.'search';
		$config['total_rows'] = $this->ad_model->get_ad($ad_count);
		$config['per_page'] = LIMIT; 
		$config['uri_segment'] = 2;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['first_link'] = FALSE;
		$config['next_link'] = '&#187';
		$config['num_links'] = NUM_LINKS;
		$config['prev_link'] = '&#171;';
		$config['last_link'] = FALSE;
		$config['full_tag_close'] = '</ul>';			
		$this->pagination->initialize($config); 
		$data['paging'] =  $this->pagination->create_links();
		
		$ad_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		$temp = $this->ad_model->get_ad($ad_data);
		
		$data['search_data'] = $search_data;
		$data['arr_ad'] = $this->get_ad_meta($temp);
		$data['title'] = 'Search | '.SITE_NAME;
		$data['meta_desc'] = 'Search Page';
		$data['menu'] = $this->general_model->get_menu();
		//$data['canonical'] = $config['base_url'];
		$data['index_follow'] = false;
		echo '<pre>';print_r($data);echo '</pre>';exit;
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/category_view',$data);
	}
	
	function detail($url='')
	{	
		$user_ip = $this->input->ip_address();
		$cur_date = $this->general_lib->get_curr_date();
				
		$ad_data = $this->table_data;
		$ad_data['where'] = array('ad.url'=>$url,'ad.status'=>STATUS_ACTIVE);
		//$ad_data['single_row'] = true;
		$temp = $this->ad_model->get_ad($ad_data);
		$res = $this->get_ad_meta($temp);
		$ad_info = $res[0];
		$ad_cat_url = $ad_info['cats'][0]['url'];
		if(empty($ad_info))
			header('Location: ' .BASE_URL, true, 301);
			
		$index_follow = true;
		if($ad_info['status'] == 0)
			$index_follow = false;
		$prev_date = $this->general_lib->get_prev_date('-30 days');
		if($prev_date > $ad_info['cdate'])
			$index_follow = false;
		
		$prev_date = $this->general_lib->get_prev_date('-60 days');	
		if($prev_date > $ad_info['cdate'])
			header('Location: ' .BASE_URL.$ad_cat_url, true, 301);
		
		$data['menu'] = $this->general_model->get_menu();
		$data['page_heading'] = $ad_info['name'];
		$data['title'] = $ad_info['seo_title'].' | '.SITE_NAME;
		$data['meta_desc'] = $ad_info['seo_meta_desc'];
		$data['ad_info'] = $ad_info;
		$data['index_follow'] = $index_follow;
		$data['canonical'] = $url;
		//echo '<pre>';print_r($data['ad_info']);exit;
		$this->update_ad_visits($ad_info['id'],$user_ip);
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/ad_detail',$data);
	}
	
	function all_news_papers()
	{
		$data['arr_papers'] = $this->get_paper();
		
		$page_data = $this->table_data;
		$page_data['table'] = 'page';
		$page_data['urls'] = 'news_paper';
		$page_data['single_row'] = true; 
		$page = $this->general_model->get_records($page_data);
		$data['meta_desc'] = $page['seo_meta_desc'];
		$data['title'] =  'All Newspaper Jobs in Pakistan | '.SITE_NAME;
		$data['page_heading'] = 'All NewsPapers';
		$data['menu'] = $this->menu;
		$data['index_follow'] = $index_follow;
		$data['canonical'] = $url;
		//echo '<pre>';print_r($data);exit;
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/news_paper_list',$data);
	}
	
	function categories()
	{
		$arr_cats = $this->get_categories();
		$temp = array();
		
		foreach($arr_cats as $cat)
		{
			$ad_data = $page_data = $this->table_data;
			
			$ad_data['where'] = array('ad_category.cat_id'=>$cat['id']); //only one week older jobs
			$ad_data['segment'] = array('limit'=>3,'offset'=>$segment);
			$ad_data['order'] = array('order_by'=>'ad.cdate'); //Order by two different fileds cdate and visits...
			$arr_temp = $this->ad_model->get_ad($ad_data);
			
			$temp[$cat['id']][] = $cat;
			$temp[$cat['id']]['jobs'] = $arr_temp; 
		}
		$data['arr_cats'] = $temp;
		//echo '<pre>';print_r($temp);exit;
		$page_data = $this->table_data;
		$page_data['table'] = 'page';
		$page_data['where'] = array('url'=>'categories');
		$page_data['single_row'] = true; 
		$page = $this->general_model->get_records($page_data);
		
		$data['meta_desc'] = $page['seo_meta_desc'];
		$data['title'] = 'Jobs in Pakistan Of All Types | '.SITE_NAME;
		$data['page_heading'] = 'Categories';
		$data['menu'] = $this->menu;
		$data['index_follow'] = $index_follow;
		$data['canonical'] = $url;
		
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/categories_list',$data);
	}
	
	function regions()
	{
		$data['regions'] = $this->menu['regions'];
		
		$page_data = $this->table_data;
		$page_data['table'] = 'page';
		$page_data['url'] = 'region';
		$page_data['single_row'] = true; 
		$page = $this->general_model->get_records($page_data);
		
		$data['meta_desc'] = $page['seo_meta_desc'];
		$data['title'] =  'Jobs In Pakistan | '.SITE_NAME;
		$data['page_heading'] = 'Region Wise Jobs';
		$data['menu'] = $this->menu;
		$data['index_follow'] = $index_follow;
		$data['canonical'] = $url;
		//echo '<pre>';print_r($data);exit;
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/region_list',$data);
	}
	
	function region($url='')
	{
		$region_data = $ad_count = $ad_data = $this->table_data;
		
		$region_data['table'] = 'region';
		$region_data['where'] = array('url'=>$url); 
		$region_data['single_row'] = true;
		$arr_region = $this->general_model->get_records($region_data);
		
		$ad_count['where'] = $ad_data['where'] = array('ad.status'=>1);
		$ad_count['like'] = $ad_data['like'] = array('ad.region like'=>'%'.$arr_region['id'].'%');
		
		$ad_count['count'] = true;
		
		//print_r($ad_count);exit;
		$segment = intval($this->uri->segment(2));
		$config['base_url'] = BASE_URL.'region/'.$url;
		$config['total_rows'] = $this->ad_model->get_ad($ad_count);
		$config['per_page'] = LIMIT; 
		$config['uri_segment'] = 3;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['first_link'] = FALSE;
		$config['next_link'] = '&#187';
		$config['num_links'] = NUM_LINKS;
		$config['prev_link'] = '&#171;';
		$config['last_link'] = FALSE;
		$config['full_tag_close'] = '</ul>';			
		$this->pagination->initialize($config); 
		$data['paging'] =  $this->pagination->create_links();
		
		$ad_data['limit'] = array('limit'=>LIMIT,'offset'=>$segment);
		
		$temp = $this->ad_model->get_ad($ad_data);
		$data['search_data'] = $search_data;
		$data['arr_ad'] = $this->get_ad_meta($temp);
				
		$data['meta_desc'] = 'Jobs in '.$arr_region['name'].' of all type';
		$data['title'] =  'Jobs In '.$arr_region['name'].' | '.SITE_NAME;
		$data['page_heading'] = 'Jobs In '.$arr_region['name'];
		$data['menu'] = $this->menu;
		$data['index_follow'] = $index_follow;
		$data['canonical'] = $url;
		//echo '<pre>';print_r($data);exit;
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/region_view',$data);
	}
	
	function large_image($url='')
	{	
		//$user_ip = $this->input->ip_address();
		$cur_date = $this->general_lib->get_curr_date();
				
		$ad_data = $this->table_data;
		$ad_data['where'] = array('ad.url'=>$url,'ad.status'=>STATUS_ACTIVE);
		//$ad_data['single_row'] = true;
		$temp = $this->ad_model->get_ad($ad_data);
		/*$res = $this->get_ad_meta($temp);
		$ad_info = $res[0];
		$ad_cat_url = $ad_info['cats'][0]['url'];*/
		if(empty($ad_info))
			header('Location: ' .BASE_URL, true, 301);
			
		$index_follow = true;
		if($ad_info['status'] == 0)
			$index_follow = false;
		$prev_date = $this->general_lib->get_prev_date('-30 days');
		if($prev_date > $ad_info['cdate'])
			$index_follow = false;
		
		$prev_date = $this->general_lib->get_prev_date('-60 days');	
		if($prev_date > $ad_info['cdate'])
			header('Location: ' .BASE_URL.$ad_cat_url, true, 301);
		
		//$data['menu'] = $this->general_model->get_menu();
		$data['page_heading'] = $ad_info['name'].' Large Image';
		$data['title'] = $ad_info['seo_title'].' Large Image| '.SITE_NAME;
		$data['meta_desc'] = $ad_info['seo_meta_desc'].' Large Image';
		$data['ad_info'] = $ad_info;
		$data['index_follow'] = $index_follow;
		$data['canonical'] = $url;
		//echo '<pre>';print_r($data['ad_info']);exit;
		//$this->update_ad_visits($ad_info['id'],$user_ip);
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/ad_image',$data);
	}
	
	function show_404()
	{	echo '404';exit;
		$data['menu'] = $this->general_model->get_menu();
		$data['title'] = '404 Page Not Found | '.SITE_NAME;
		$data['meta_desc'] = '';
		$this->template->load(FRONT_TEMPLATE_URL.'template_inner', 'front/ad_detail',$data);	
	}
	
	function set_paper_date()
	{
		$paper_data = array();
		$paper_data['start_date'] = $paper_data['end_date'] = $_POST['paper_date'];
		$paper_link = $_POST['paper_link'];
		$this->session->set_userdata('front_paper'.$paper_link,$paper_data);
		echo 1;
		exit;
	}
	
	function update_ad_visits($ad_id=0,$user_ip='')
	{
		$prev_date = $this->general_lib->get_prev_date('-1 days');
		$ad_visit_data = $this->table_data;
		$ad_visit_data['table'] = 'ad_visits';
		$ad_visit_data['where'] = array('ad_id'=>$ad_id,'cdate'=>$prev_date);
		$ad_visit_data['single'] = true;
		$arr_ad = $this->general_model->get_records($ad_visit_data);
		
		$cur_date = $this->general_lib->get_curr_date();
		$add_data = array('cdate'=>$cur_date);
		if(empty($arr_ad))
		{
			$this->general_model->add('ad_visits',$add_data);
		}
		else
		{
			$this->general_model->update('ad_visits',$add_data,array('ad_id'=>$ad_id,'cdate'=>$cur_date));
		}
		return;
	}
	
	function get_paper($data=array())
	{
		$paper_data['table'] = 'news_paper';
		$paper_data['select'] = array('name','url','image');
		$paper_data['where'] = array('status'=>1);
		$paper_data['order'] = array('order_by'=>'order','order_type'=>'ASC');
		$arr_papers = $this->general_model->get_records($paper_data);
		return $arr_papers;
	}
	
	function get_categories($data=array())
	{
		$cat_data['table'] = 'category';
		$cat_data['select'] = array('id','name','url');
		$cat_data['where'] = array('status'=>1);
		$cat_data['order'] = array('order_by'=>'order','order_type'=>'ASC');
		$arr_cats = $this->general_model->get_records($cat_data);
		return $arr_cats;
	}
	
	function get_ad_meta($arr_ad=NULL)
	{
		$temp = array();
		foreach($arr_ad as $row)
		{	$temp1 = $temp2 = array();
			$id = $row['id'];
			$cats = $this->ad_model->get_ad_cats($id);
			foreach($cats as $cat)
				$temp1[] = $cat;	
			$papers = $this->ad_model->get_ad_papers($id);
			foreach($papers as $paper)
				$temp2[] = $paper;
				
			$row['cats'] = $temp1;
			$row['papers'] = $temp2;
			$temp[] = $row;
		}
		return $temp;
	}
	
	function test()
	{
		$this->load->view('front/test');
	}
}