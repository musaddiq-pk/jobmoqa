<div class="row">
      <div class="col-md-12">
        <h3 class="main-title">Region Wise Jobs</h3>
      </div>

    <div class="col-md-12" id="region_list">
        <div class="all-newspaper-box">
          <div class="col-md-12">
              <div class="news-dates">
              	<ul>
                <?
                   foreach($regions as $region)
                        echo '<li><a href="'.BASE_URL.'region/'.$region['url'].'" title="'.$region['name'].'" class="region">'.$region['name'].'</a></li>';
                ?>
                </ul>
              </div>
           </div>
           <div class="clearfix"></div>
        </div>
    </div>
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