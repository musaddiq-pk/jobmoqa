<?php 
class Page_model extends CI_Model {
	
	
	function __construct()
	{
		parent::__construct();
	}
	
	function add_page($page_data='')
	{
		$this->db->insert('pages',$page_data);
		return true;
	}
	
	function edit_page($page_data='',$nId=0)
	{
		$this->db->update('pages',$page_data,"pkPageId = $nId");	
		return true;
	}
	
	function count_pages()
	{
			return $this->db->get('pages')->num_rows;		
	}
	
	function get_pages($limit=0,$offset=0)
	{
		$this->db->limit($limit,$offset);
		$query = $this->db->get('pages');			
		return $query->result_array();
	}
	
	function get_page_by_id($nId)
	{
		$this->db->where('pkPageId',$nId); 
		$query = $this->db->get('pages');
		return $query->row_array();
	}
	
	function get_page_by_url($page_url = '')
	{
		$this->db->where('page_url',$page_url); 
		$query = $this->db->get('pages');
		return $query->row_array();
	}
}
?>