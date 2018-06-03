<?
	$fburl= 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	
	$temp = 's= 100&amp;p[title]=Musaddiq&amp;p[url]=http://www.jobmoqa.pk/managing-director-tip-ministry-of-it-and-telecom&amp;p[images][0]=http://www.jobmoqa.pk/uploads/ad/large_img/ad-1-managing-director-tip-ministry-of-it-and-telecom.jpg&amp;p[summary]=Test Summary';
?>
      <h3 class="main-title">Job Details</h3>
        <div class="job-details">
          <div class="col-md-12">
            <ul class="social-share">
            	<?php /*?><li><a href="whatsapp://send?text=<?=$fburl?>" data-action="share/whatsapp/share">Share via Whatsapp</a></li><?php */?>
              <li><a class="facebook1" data-original-title="facebook" href="javascript:;" onClick="window.open('https://www.facebook.com/sharer/sharer.php?<?=$fburl?>', 'mywin',
                        'left=200,top=100,width=800,height=500,toolbar=1,resizable=1')"><img src="<?=FRONT_STATIC_URL?>images/fb.jpg" alt="" class="img-responsive"></a></li>
              <li><a href="#"><img src="<?=FRONT_STATIC_URL?>images/email.jpg" alt="" class="img-responsive"></a></li>
              <li><a href="#"><img src="<?=FRONT_STATIC_URL?>images/linkedin.jpg" alt="" class="img-responsive"></a></li>
              <li><a href="javascript:;" id="print"><span class="glyphicons glyphicons-print"></span>dsflkjs</a></li>
            </ul>
          </div>
          <?php /*?><div class="col-md-12">
            <ul class="print-pdf">
              <li><a href="javascript:;" id="print"><img src="<?=FRONT_STATIC_URL?>images/print.png" alt="" class="img-responsive"></a></li>
              <li><a href="#"><img src="<?=FRONT_STATIC_URL?>images/pdf-icon.png" alt="" class="img-responsive"></a></li>
            </ul>
          </div><?php */?>
          <div class="clear"></div>
          <div class="job-details-table">
                <?php /*?><div class="col-md-3 col-sm-3">
                <img src="<?=FRONT_STATIC_URL?>images/img-banner.png" alt="" class="img-responsive">ss
              </div><?php */?>
              <div class="col-md-12 col-sm-12">
              <h3 class="no-margin"><?=$ad_info['name']?></h3>
              
                <table class="table">
                  <tr>
                    <th>Department</th>
                    <? 
						$cats = array();
						foreach($ad_info['cats'] as $row)
						 	$cats[] = '<a href="'.CAT_URL.$row['url'].'">'.$row['name'].'</a>';
					?>
                    <td><?=implode(' , ',$cats);?></td>
                  </tr>
                   <tr>
                    <th>Newspaper</th>
                    <? 
						$papers = array();
						foreach($ad_info['papers'] as $row)
						 	$papers[] = '<a href="'.PAPER_URL.$row['url'].'">'.$row['name'].'</a>';
					?>
                    <td><?=implode(' , ',$papers);?></td>
                  </tr>
                  <tr>
                    <th>Posted On</th>
                    <td><?=$this->general_lib->show_fdate($ad_info['ad_date'])?></td>
                  </tr>
                   <tr>
                    <th>Last date of apply</th>
                    <td><?=$this->general_lib->show_fdate($ad_info['last_date'])?></td>
                  </tr>
                </table>
              </div>
              <div class="clear"></div>
              <hr>
			
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h4 class="panel-title">
                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Job Description
                    </a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                	<?=$ad_info['desc']?>
                    <p>See Full Add Just <a href="<?=AD_LARGE_IMG_PATH.$ad_info['image']?>" target="_blank">Click Here</a></p>
                </div>
            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h4 class="panel-title">
                    <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <i class="more-less glyphicon glyphicon-plus"></i>
                        Required Skills
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                   <?=$ad_info['required_skills']?>
                </div>
            </div>
        </div>

    </div>
                
              <div class="job-detail-add" id="ad_img">
                  <a href="<?=AD_LARGE_IMG_PATH.$ad_info['image']?>" target="_blank">
                    <img src="<?=AD_LARGE_IMG_PATH.$ad_info['image']?>" itemprop="image" class="img-responsive" alt="<?=$ad_info['seo_title']?>">
                   </a>
            </div>

            <hr>

                <!-- panel-group -->


          </div>
        </div> 
        
        
<script type="text/javascript">
	$(document).ready(function(){
		$('#print').click(function(){
			var prtContent = document.getElementById("ad_img");
			var WinPrint = window.open('', '', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
			WinPrint.document.write(prtContent.innerHTML);
			WinPrint.document.close();
			WinPrint.focus();
			WinPrint.print();
			WinPrint.close();
		});
	});
</script>