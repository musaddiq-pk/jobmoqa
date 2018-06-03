<div class="container-fluid hidden-xs">
  <div class="row cat-search">
    <div class="col-md-8 col-md-offset-2 ">
      <form class="form-inline" role="form" action="<?=BASE_URL?>search" method="post">
        <div class="form-group">
        <input type="text" class="form-control" name="key_word" placeholder="Job KeyWord" value="<?=$search_data['key_word']?>">
        </div>
        <div class="form-group">
          <input type="text" class="form-control start_date" name="start_date" placeholder="Date From" value="<?=$search_data['start_date']?>">
        </div>
        <div class="form-group">
          <input type="text" class="form-control end_date" name="end_date" placeholder="Date To" value="<?=$search_data['end_date']?>">
        </div>
        <div class="form-group">
          <select class="form-control" name="paper_id" >
            <option value="">News Paper</option>
            <? 
				$arr_papers = $menu['news_paper']; 
				foreach($arr_papers as $paper)
				{
					$selected = '';
					if($search_data['paper_id'] == $paper['id'])
						$selected = 'selected="selected"';
					echo '<option value="'.$paper['id'].'" '.$selected.'>'.$paper['name'].'</option>';
				}
            ?>
          </select>
        </div>
        <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
      </form>
    </div>
  </div>
</div>

<div class="container">
	<div class="row">
    <div class="col-md-8 breadcrumbs-div">
        <ul class="breadcrumbs">
          <li><a href="<?=BASE_URL?>"> HOME </a>/</li>
          <li><?=$page_heading?></li>
        </ul>
    </div>
</div>
</div>
