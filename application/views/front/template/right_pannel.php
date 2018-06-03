<div class="col-md-3 right-side-bar">
  <h3 class="left-cat-title">Newspaper Wise Jobs <i id="city-drop" class="pull-right hidden-lg hidden-md  glyphicon glyphicon-chevron-down"></i></h3>
    <ul id="city-drop-list">
    	<?
        	$news_paper = $menu['news_paper'];
			foreach($news_paper as $row)
				echo '<li><a href="'.BASE_URL.'epaper/'.$row['url'].'"><img src="'.FRONT_STATIC_URL.'images/list-check.png" alt="img"> '.$row['name'].' </a></li>';
		?>
        
        
        <?php /*?><li><a href="#"><img src="<?=FRONT_STATIC_URL?>images/list-check.png" alt="img"> Jang Newpaper Jobs </a> <span class="pull-right">(825)</span></li><?php */?>
	</ul>

      <img src="<?=FRONT_STATIC_URL?>images/add-4.jpg" class="img-responsive" alt="Images">
</div>