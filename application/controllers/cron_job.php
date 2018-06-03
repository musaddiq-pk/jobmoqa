<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class cron_job extends CI_Controller 
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
	
	function site_map()
	{
		
		/*
			1. Base Url									Done
			2. static pages (header and footer pages)	Done
			6. Your successgin							Pending
			3. categories								Done
			4. Newspaper								Done
			5. Regions (general and regions)			Done
			6. Docs										Pending
			7. Ad( only upto 30 days old)				Done
		*/
		
		$menu = $this->general_model->get_menu();
		$pages = array_shift($menu['pages']);
		$pages = $menu['pages'];
		$cats = $menu['cats'];
		$papers = $menu['news_paper'];
		$regions = $menu['regions'];
		
		$ad_data = $this->config->item('table_data');
		$ad_data['table'] = 'ad';
		$ad_data['select'] = array('url');
		$ad_data['where'] = array('ad_date >= '=>$this->general_lib->get_prev_date('-30 days'),'ad_date <= '=>$this->general_lib->get_curr_date());
		$arr_ad = $this->general_model->get_records($ad_data);
		
		//echo '<pre>';print_r($menu);echo '</pre>';exit;
		$cur_date = date('Y-m-d').'T'.date('H:i:s+00:00');
		$xml = '<?xml version="1.0" encoding="UTF-8"?>
				<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
				<url>
					<loc>'.BASE_URL.'</loc>
					<lastmod>'.$cur_date.'</lastmod>
					<changefreq>daily</changefreq>
					<priority>1.00</priority>	
				</url>';
		$xml .= '<url>
					<loc>'.BASE_URL.'industries</loc>
					<lastmod>'.$cur_date.'</lastmod>
					<changefreq>daily</changefreq>
					<priority>0.90</priority>	
				</url>';
		$xml .= '<url>
					<loc>'.BASE_URL.'all-news-papers</loc>
					<lastmod>'.$cur_date.'</lastmod>
					<changefreq>daily</changefreq>
					<priority>0.90</priority>	
				</url>';
		$xml .= '<url>
					<loc>'.BASE_URL.'regions</loc>
					<lastmod>'.$cur_date.'</lastmod>
					<changefreq>daily</changefreq>
					<priority>0.90</priority>	
				</url>';			
		
		foreach($pages as $page)
		{
			$xml .= '<url>
						<loc>'.BASE_URL.$page['url'].'</loc>
						<lastmod>'.$cur_date.'</lastmod>
						<changefreq>daily</changefreq>
						<priority>0.80</priority>
					</url>';
		}
		
		foreach($regions as $region)
		{
			$xml .= '<url>
						<loc>'.BASE_URL.'region/'.$region['url'].'</loc>
						<lastmod>'.$cur_date.'</lastmod>
						<changefreq>daily</changefreq>
						<priority>0.80</priority>
					</url>';
		}
		
		foreach($papers as  $paper) 
		{ 
			$xml .= '<url>
						<loc>'.BASE_URL .'epaper/'.$paper['url'].'</loc>
						<lastmod>'.$cur_date.'</lastmod>
						<changefreq>daily</changefreq>
						<priority>0.80</priority>
					</url>';
		}
		
		foreach($cats as  $cat) 
		{ 
			$xml .= '<url>
						<loc>'.BASE_URL .'industry/'.$cat['url'].'</loc>
						<lastmod>'.$cur_date.'</lastmod>
						<changefreq>daily</changefreq>
						<priority>0.80</priority>
					</url>';
		}
		
		foreach($arr_ad as  $ad) 
		{ 
			$xml .= '<url>
						<loc>'.BASE_URL .$ad['url'].'</loc>
						<lastmod>'.$cur_date.'</lastmod>
						<changefreq>daily</changefreq>
						<priority>0.70</priority>
					</url>';
		}
				
		$xml .= '</urlset>';
		
	   $FileHandle = fopen(FCPATH.'sitemap.xml','w+') or die("can't open file");
	   $res = fwrite($FileHandle,$xml);
	}
}
