<div class="row">
      <div class="col-md-12">
        <h3 class="main-title">Daily Newspaper Wise jobs</h3>
      </div>

	<? foreach($arr_papers as $paper) : 
		$ad_dates = array();
		$ad_dates[] = $this->general_lib->get_curr_date();
		$ad_dates[] = $this->general_lib->get_prev_date('-1 days');
		$ad_dates[] = $this->general_lib->get_prev_date('-2 days');
	?>
    <div class="col-md-12">
        <div class="all-newspaper-box">
          <div class="news-img col-md-4">
            <a href="<?=BASE_URL.'epaper/'.$paper['url']?>" title="View All <?=$paper['name']?> Jobs"><img src="<?=PAPER_IMG_PATH.$paper['image']?>" alt="<?=$paper['name']?> Jobs in Pakistan"></a>
          </div>
          <div class="col-md-8">
              <?php /*?><div class="news-name">
                <h3><a href="<?=BASE_URL.'epaper/'.$paper['url']?>"><?=$paper['name']?></a></h3>
              </div><?php */?>
              <div class="news-dates">
                <?
                    for($i=0; $i<count($ad_dates); $i++)
                        echo '<p><a href="javascript:;" rel="'.$paper['url'].'" data-value="'.$ad_dates[$i].'" class="paper_date">'.date('l, d M, Y',strtotime($ad_dates[$i])).'</a></p>';
                ?>
              </div>
           </div>
           <div class="clearfix"></div>
           <div class="view-all-news">
          <a href="<?=BASE_URL.'epaper/'.$paper['url']?>" class="btn btn-primary btn-block view-all-btn">View All <?=$paper['name']?> Jobs</a>
        </div>
        </div>
    </div>
    <? endforeach; ?>
</div>

<script type="application/javascript">
$(document).ready(function(){
	
	$('.paper_date').click(function(){
		var paper_link = $(this).attr('rel');
		var paper_date = $(this).attr('data-value');
		
		$.ajax({
			  type: 'POST',
			  url: "<?=BASE_URL?>ad/set_paper_date",
			  data: {'paper_link':paper_link,'paper_date':paper_date},
			  async: false,
			  success: function(data)
			  {	
			  	
				window.location = '<?=BASE_URL?>epaper/'+paper_link;
			}
		});	
	});
});
</script>