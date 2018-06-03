<?php
	$pages = array('ad'=>'Manage Ad','category'=>'Manage Categories','news_paper'=>'Manage News Paper','docs'=>'Manage Documents','page'=>'Manage Pages','users'=>'Manage Users');
	/*$url = explode('/',$_SERVER['PHP_SELF']);

	$cur_page = '';
	if(isset($url[4]))
		$cur_page = $url[4];*/
?>
<ul>
	<?php
		foreach($pages as $key=>$page)
		{
			/*$class_name = '';
			if($cur_page == $key)
				$class_name = ' class="selected"';*/
  			echo '<li><a href="'.ADMIN_BASE_URL.$key.'">'.$page.'</a></li>';
		}
  	?>
</ul>
