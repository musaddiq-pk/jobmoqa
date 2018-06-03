<?php
class Ad_model extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function get_ad($ad_data=NULL)
	{	
		$ad_data['select'] = 'ad.*';
		$ad_data['table'] = 'ad';
		$ad_data['join'][] = array('table'=>'ad_category','on'=>'ad_category.ad_id = ad.id');
		$ad_data['join'][] = array('table'=>'ad_newspaper','on'=>'ad_newspaper.ad_id = ad.id');
		if(!isset($ad_data['order']))
			$ad_data['order'] = array('order_by'=>'ad.ad_date');
		//$ad_data['where']['ad.status'] = 1;
		//$ad_data['count'] = TRUE;
		//echo '<pre>';print_r($ad_data);echo '</pre>';exit;
		return $this->general_lib->exec_query($ad_data);
	}
	
	function get_ad_cats($id=0)
	{
		$ad_data['select'] = 'category.id,category.name,category.url';
		$ad_data['table'] = 'category';
		$ad_data['join'][] = array('table'=>'ad_category','on'=>'ad_category.cat_id = category.id');
		$ad_data['where']['ad_category.ad_id'] = $id;
		return $this->general_lib->exec_query($ad_data);
	}
	
	function get_ad_papers($id=0)
	{
		$ad_data['select'] = 'news_paper.id,news_paper.name,news_paper.url';
		$ad_data['table'] = 'news_paper';
		$ad_data['join'][] = array('table'=>'ad_newspaper','on'=>'ad_newspaper.newspaper_id = news_paper.id');
		$ad_data['where']['ad_newspaper.ad_id'] = $id;
		return $this->general_lib->exec_query($ad_data);
	}
}
?>