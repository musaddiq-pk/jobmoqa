<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class page extends CI_Controller 
{
	var $table_data = array();

	public function page()
	{
		parent::__construct();
		$this->table_data = $this->config->item('table_data');
		$this->table_data['table'] = 'page';
	}
	
	public function index()
	{
		//
	}
	
	function view($url='')
	{	
		$data['menu'] = $this->general_model->get_menu();
		
		$page_data = $this->table_data;
		$page_data['where'] = array('url'=>$url); 
		$page_data['single_row'] = true;
		$page = $this->general_model->get_records($page_data);
		
		//$page = $this->general_model->get_single_record('pages','page_url',$page_url);
		$data['content_heading'] = $page['name'];
		$data['contents'] = $page['desc'];
		$data['title'] = $page['seo_title'];
		$data['page_heading'] = $page['name'];
		$data['meta_desc'] = $page['seo_meta_desc'];
		//echo '<pre>';print_r($data);exit;
		$this->template->load('front/template/template_inner', 'front/page_view', $data);
	}
}
