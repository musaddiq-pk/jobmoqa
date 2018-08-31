<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class docs extends CI_Controller 
{
	var $table_data = array();

	public function docs()
	{
		parent::__construct();
		$this->table_data = $this->config->item('table_data');
		$this->table_data['table'] = 'docs';
	}
	
	public function index()
	{
		echo 'List all document type so that user can select...';exit;
	}
	
	function documents($url='')
	{
		echo 'Here..... in docdddd';exit;
		$data['menu'] = $this->general_model->get_menu();
		
		$page_data = $this->table_data;
		$page_data['where'] = array('url'=>$url); 
		$page_data['single_row'] = true;
		$page = $this->general_model->get_records($page_data);
		
		//$page = $this->general_model->get_single_record('pages','page_url',$page_url);
		$data['content_heading'] = $page['seo_title'];
		$data['contents'] = $page['desc'];
		$data['title'] = $page['seo_title'];
		$data['description'] = $page['seo_meta_desc'];
		echo '<pre>';print_r($data);exit;
		$this->template->load('template/front/template_inner', 'front/page_view', $data);
	}
}
