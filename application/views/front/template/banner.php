<div class="latest-jobs">
          <h3 class="main-title">Latest Jobs 2016</h3>
	<div class="latest-job-arrows text-right">
           <!-- <ul class="sy-controls">
              <li class="sy-prev">
                <a href="javascript:;" class="new-prev btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span></a>
              </li>
              <li class="sy-next">
                <a href="javascript:;" class="new-next btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></a>
              </li>
            </ul>-->
          </div>
          <div class="newproducts-box">
            <div class="table-responsive">
            	<table class="table table-hover" width="100%">
                    <tr class="active">
                        <th width="40%">Title</th>
                        <th width="50%">Description</th>
                        <th>Date</th>
                    </tr>
                    <tbody>
					<? 
						$count = 0;
						foreach($arr_ad as $ad) : 
                        $ad_url = BASE_URL.$ad['url'];
                        $ad_paper = $ad['papers'][0];
						
						$row_class = '';
						if($count%2 == 0)
							$row_class = 'even';
						$count ++;
						
                    ?>
            			
                        <tr class="ad_row <?=$row_class?>">
                        	<td><a href="<?=$ad_url?>"><?=$ad['name']?></a></td>
                            <td>
                                	<button type="button" class="btn btn-info btn-read" data-toggle="collapse" data-target="#desc_<?=$ad['id']?>">Read More &nbsp;<span class="glyphicon glyphicon-plus"></span></button>
                                  <div id="desc_<?=$ad['id']?>" class="collapse">
                                   <?=$ad['desc']?>
                                  </div>
                                
                                <?php /*?><div id="desc_<?=$ad['id']?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><?=$ad['name']?></h4>
                                      </div>
                                      <div class="modal-body">
                                        <?=$ad['desc']?>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                
                                  </div>
                                </div><?php */?>
                                
                                
                            </td>
                            <td><?=$this->general_lib->show_date($ad['ad_date']);?></td>
                            <?php /*?><td><a href="<?=$ad_url?>"><?=$ad['desc']?></a></td><?php */?>
                        </tr>
            	<?php /*?><div class="item">
                <div class="latest-box">
                  <div class="latest-img-box">
                    <a href="<?=$ad_url?>>">
                      <img src="<?=AD_SMALL_IMG_PATH.$ad['image']?>" alt="<?=$ad['seo_title']?>" class="img-responsive">
                    </a>
                  </div>
                  <div class="latest-details-box">
                    <h5 class="latest-job-title">
                      Title
                    </h5>
                    <p> <a href="<?=$ad_url?>"><?=$ad['name']?></a> </p>
                    <h5 class="latest-job-title">
                      Date
                    </h5>
                    <p><?=$this->general_lib->show_date($ad['cdate']);?></p>
                    <h5 class="latest-job-title">
                      Newspaper
                    </h5>
                    <p> <a href="<?=$ad_paper['url']?>"><?=$ad_paper['name']?></a> </p>
                  </div>
                </div>
              </div><?php */?>
			<? endforeach; ?>
            	</tbody>
			</table>

		<div class="view-all-news">
          	<h5 class="col-md-3 col-md-offset-5"><a href="javascript:;" id="view_all_jobs" class="btn btn-primary btn-block view-all-btn" data-value="<?=date('d-m-Y')?>">View all latest jobs</a></h5>
        </div>
     </div>