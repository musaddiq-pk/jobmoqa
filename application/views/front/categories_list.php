<div class="row">
      <div class="col-md-12">
        <h3 class="main-title">Daily Newspaper Wise jobs</h3>
      </div>

	<? foreach($arr_cats as $c) : 
		$cat = $c[0];
		$jobs = $c['jobs'];
	?>
    <div class="col-md-12">
        <div class="all-newspaper-box">
          <?php /*?><div class="news-img col-md-4">
            <a href="<?=BASE_URL.'industry/'.$cat['url']?>" title="View All <?=$cat['name']?> Jobs"><?=$cat['name']?></a>
          </div><?php */?>
          <div class="col-md-12">
              <h3 class="text-center"><?=$cat['name']?></h3>
              <div class="news-dates">
                <?
                    foreach($jobs as $job)
                        echo '<p><a href="'.BASE_URL.$job['url'].'" class="paper_date">'.$job['name'].'</a></p>';
                ?>
              </div>
           </div>
           <div class="clearfix"></div>
           <div class="view-all-news">
          <a href="<?=BASE_URL.'industry/'.$cat['url']?>" class="btn btn-primary btn-block view-all-btn">View All <?=$cat['name']?> Jobs</a>
        </div>
        </div>
    </div>
    <? endforeach; ?>
</div>