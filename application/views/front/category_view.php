<div class="category-list"> <!-- you may use table-responsive -->
      <h3 class="main-title"><?=$page_heading?></h3>


      <table class="table" width="100%">
          <thead>
            <tr>
              <th class="col-md-7">Job Ttitle</th>
              <th class="col-md-3">Newspaper</th>
              <th class="col-md-2">Date</th>
            </tr>
          </thead>
          <tbody>
          	<?
				foreach($arr_ad as $row) : 
					$url = BASE_URL.$row['url'];
					
					$papers = $row['papers'];
			?>
            <tr>
              <td ><a href="<?=$url?>"><?=$row['seo_title']?></a></td> 
              <td>
              	<? 
				$count = 0;
				foreach($papers as $p)
				{
					echo '<a href="'.PAPER_URL.$p['url'].'">'.$p['name'].'</a>';
					if($count < count($papers))
						echo '<br />';
					$count ++;
				}
				?>
              </td>
              <td><?=$this->general_lib->show_date($row['ad_date']);?></td>
            </tr>
            <? endforeach;?>
          </tbody>
        </table>
        <div><?=$paging?></div>
</div>