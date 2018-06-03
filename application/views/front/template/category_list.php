<?
	$hidden_xs = 'hidden-xs';
	if(isset($is_home) && $is_home == true)
		$hidden_xs = '';
?>
<div class="col-md-3 left-side-bar <?=$hidden_xs?>">
    <h3 class="left-cat-title">Category Wise Jobs <i id="cat-drop" class="pull-right hidden-lg hidden-md  glyphicon glyphicon-chevron-down"></i></h3>
    	<ul id="cat-drop-list">
        	<?
            	$cats = $menu['cats'];
				foreach($cats as $cat)
					echo '<li><a href="'.BASE_URL.'industry/'.$cat['url'].'"><img src="'.FRONT_STATIC_URL.'images/list-check.png" alt="img"> '.$cat['name'].' </a></li>';
			?> 
        </ul>

        <h3 class="left-cat-title">Region Wise Jobs <i id="city-drop" class="pull-right hidden-lg hidden-md  glyphicon glyphicon-chevron-down"></i></h3>
        <ul id="city-drop-list">
        	 <?
			 	$regions = $this->menu['regions'];
                   foreach($regions as $region)
				   		echo '<li>
            <a href="'.BASE_URL.'region/'.$region['url'].'" title="'.$region['name'].'"><img src="'.FRONT_STATIC_URL.'images/list-check.png" alt="img"> '.$region['name'].' </a> <!--<span class="pull-right">(825)</span> --></li>';
                ?>
        </ul>
      </div>