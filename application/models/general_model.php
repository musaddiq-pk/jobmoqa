<?php 
class General_model extends CI_Model {
		
	function __construct()
	{
		parent::__construct();
	}
	
	function get_records($data=NULL)
	{	//print_r($data);exit;
		extract($data);
		if($count)
			$this->db->select("$table.id");
		if(isset($select))
		{	
			$str_select = '';
			for($i=0;$i<count($select);$i++)
				$str_select .= "$table.".$select[$i].',';
			$this->db->select(trim($str_select,','));
		}
		else if($count != 1)
		{
			$this->db->select("$table.*");
		}
		if($where)
			$this->db->where($where);
		if(isset($segment))
		{
			extract($segment);
			$this->db->limit($limit,$offset);	
		}
		if(!empty($order))
		{
			$order_type = 'DESC';
			if(isset($order['order']))
				$order_type = $order['order'];
			$this->db->order_by($order['order_by'],$order_type);
		}
		$query = $this->db->get($table);
		if($count)
			return $query->num_rows();
		if($single_row)
			return $query->row_array();
		return $query->result_array();
	}
		
	function add($table_name='',$data)
	{
		$this->db->insert($table_name,$data);
		return $this->db->insert_id();
	}
	
	function update($table_name='',$data,$where)
	{
		$this->db->where($where);
		$this->db->update($table_name,$data);
		return $this->db->affected_rows();
	}
	
	function delete($table_name='',$where)
	{
		$this->db->where($where);
		$this->db->delete($table_name);
		return $this->db->affected_rows();	
	}
	
	function get_menu()
	{
		$regions = $this->db->get('region')->result_array();
		
		$str_where = array('status'=>1);
		$this->db->where($str_where);
		$pages = $this->db->get('page')->result_array();
		$this->db->where($str_where);
		$news_paper = $this->db->get('news_paper')->result_array();
		$this->db->where($str_where);
		$cats = $this->db->get('category')->result_array();
		
		$temp = array();
		foreach($pages as $p)
		{
			if($p['url'] == 'about-us')
			{
				$temp = $p;	
				break;
			}
		}
		
		return array('cats'=>$cats,'news_paper'=>$news_paper,'pages'=>$pages,'about-us'=>$temp,'regions'=>$regions);
	}
	
	function chk_cats($cat_ids=array())
	{
		$cat_data['select'] = 'category.id,category.name';
		$cat_data['table'] = 'category';
		$cat_data['where']['category.status'] = 1;
		$cat_data['order'] = array('order_by'=>'order','order'=>'ASC');
		$rows = $this->general_lib->exec_query($cat_data);
		
		$html = '';
		foreach($rows as $row)
		{
			$checked = '';
			if(in_array($row['id'],$cat_ids))
				$checked = 'checked="checked"';
			$html .= '<li><label>'.$row['name'].' <input type="checkbox" name="cat_name[]" value="'.$row['id'].'" '.$checked.' /></label></li>';
		}
		return $html;
	}
	
	function chk_news($news_ids=array())
	{
		$news_data['select'] = 'id,name';
		$news_data['table'] = 'news_paper';
		$news_data['where']['status'] = 1;
		$news_data['order'] = array('order_by'=>'order','order'=>'ASC');
		$rows = $this->general_lib->exec_query($news_data);
		//echo '<pre>';print_r($rows);exit;
		$html = '';
		foreach($rows as $row)
		{
			$checked = '';
			if(in_array($row['id'],$news_ids))
				$checked = 'checked="checked"';
			$html .= '<li><label>'.$row['name'].' <input type="checkbox" name="paper_name[]" value="'.$row['id'].'" '.$checked.' /></label></li>';
		}
		return $html;
	}
}
?>