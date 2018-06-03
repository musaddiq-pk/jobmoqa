<div id="form_container1">
  <form name="frmAddOutlet" method="post" action="<?php echo $action;?>" enctype="multipart/form-data" onsubmit="return valdiate_item();">
    <div>
		<?php echo form_error('ad_name')?>
        <label>Name: </label>
      <p>
        <input type="text" name="ad_name" id="ad_name" value="<?php echo set_value('ad_name',$ad['name']);?>" />
      </p>
    </div>
    <div>
		<?php //echo form_error('txt_cost_price')?>
        <label>Category: </label>
      <ul id="cats" style="width:747px;float:right;border:1px solid #ccc;">
      	
        <?=$chk_cats?>
        <input type="hidden" name="old_cats" value="<?=$selected_cats?>" />
      </ul>
    </div>
    <div class="clear"></div>
    <div>
		<?php //echo form_error('txt_sale_price')?>
        <label> News Paper: </label>
      <ul id="papers" style="width:747px;float:right;border:1px solid #ccc;margin-top:10px;">
        <?=$chk_news?>
        <input type="hidden" name="old_papers" value="<?=$selected_papers?>" />
      </ul>
    </div>
    <div class="clear"></div>
    <div>
		<?php echo form_error('hdn_image')?>
        <label>Image: </label>
      <p class="upload_img">
          <input type="file" name="image" id="image"  />
          <input type="hidden" name="hdn_image" id="hdn_image" value="<?php echo $ad['image']?>" />
          <input type="hidden" name="old_img" id="old_img" value="<?php echo $ad['image']?>" /> 
          <?php if($ad['image']!='') :?>
          	<a href="<?=AD_LARGE_IMG_PATH.$ad['image']?>" target="_blank"><img src="<?=AD_SMALL_IMG_PATH.$ad['image']?>"  width="100" height="60" style="background:#E6BFBF;" /></a>
          <? endif;?>  
      </p>
    </div>
    <div class="clear"></div>
     <div>
         <?=form_error('ad_date')?>
        <label> Publish date: </label>
      <p>
        <input type="text" name="ad_date" id="ad_date" class="start_date" value="<?php echo set_value('ad_date',$this->general_lib->show_date($ad['ad_date']));?>" placeholder="dd-mm-yyyy" />
      </p>
      <?php //=form_error('txtMetaDesc')?>
    </div>
     <div class="clear"></div>
     <div>
         <?=form_error('last_date')?>
        <label> Last date: </label>
      <p>
        <input type="text" name="last_date" id="last_date" class="end_date" value="<?php echo set_value('last_date',$this->general_lib->show_date($ad['last_date']));?>" placeholder="dd-mm-yyyy" />
      </p>
      <?php //=form_error('txtMetaDesc')?>
    </div>
     
     <div class="clear"></div>
     <div>
         <?=form_error('region')?>
        <label> Job Region: </label>
      <p>
      	
        <select name="region[]" id="region" multiple="multiple" style="height:140px;">
        	<?
				$ad_regions = array();
				if($ad['region'] != '')
					$ad_regions = explode(',',$ad['region']);
				
            	foreach($regions as $region)
				{
					$selected = '';
					if(in_array($region['id'],$ad_regions))
						$selected = 'selected="selected"';
					echo '<option value="'.$region['id'].'" '.$selected.'>'.$region['name'].'</option>';
				}
			?>
        </select>
      </p>
      <?php //=form_error('txtMetaDesc')?>
    </div>
     <div class="clear"></div>
     <div>
         <?=form_error('required_skills')?>
        <label> Required Skills: </label>
      <p>
        <textarea name="required_skills" id="required_skills" cols="37" rows="5" ><?php echo set_value('required_skills',$ad['required_skills']);?></textarea>
      </p>
      <?php //=form_error('txtMetaDesc')?>
    </div>
     
     <div class="clear"></div>
     <div>
     	<?=form_error('desc')?>
        <label>Description: </label>
      <p style="width:600px;float:left;">
        <textarea name="desc" id="editor" cols="37" rows="5" ><?php echo set_value('desc',$ad['desc']);?></textarea>
      </p>
    </div>
     
     
    
    <div class="clear"></div>
    <div><label style="font-size:16px;font-family:Arial, Helvetica, sans-serif;">Site SEO</label></div>
     <div class="clear"></div>
    <div>
    	<span class="note">Recommended Page Title size = 50 char</span>
         <?=form_error('seo_title')?>
        <label >Page Title: </label>
      <p>
        <input type="text" name="seo_title" id="seo_title" value="<?php echo set_value('seo_title',$ad['seo_title']);?>"  />
      </p>
    </div>
    <div>
    	<span class="note">Recommended Meta Description size = 200 char.</span>
         <?=form_error('seo_desc')?>
        <label> Meta Description: </label>
      <p>
        <textarea name="seo_desc" id="seo_desc" cols="37" rows="5" ><?php echo set_value('seo_desc',$ad['seo_meta_desc']);?></textarea>
      </p>
      <?php //=form_error('txtMetaDesc')?>
    </div>
    <div>
      <label>&nbsp;</label>
      <p id="submit"><input type="submit" name="btnAddOutlet" id="btnAddOutlet" value="<?php echo $button;?>" class="btnAdd" />
      </p>
    </div>
  </form>
  <div class="clear"></div>
</div>

<style type="text/css">
	#form_container #txt_desc_parent{display:inline;padding-left:0;}
	#cats li,#papers li{
		display:block;
		float:left;
		width:184px;	
	}
	#papers li{
		width:148px;	
	}
	#cats li label, #papers li label{display:inline;width:auto;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#ad_name").blur(function(){
			$("#seo_title").val($(this).val());
		});	
		
		$("#desc").blur(function(){
			$("#seo_desc").val($(this).val());
		});	
		
		$("#image").change(function(){
			var img = $(this).val();
			var replaced_val = img.replace("C:\\fakepath\\",'');
			$('#hdn_image').val(replaced_val);
		});
		
		<?php /*?>CKEDITOR.replace('txtDescription',
		{
			filebrowserBrowseUrl :'<?=BASE_URL?>static/js/ckeditor/filemanager/browser/default/browser.html?Connector=<?=BASE_URL?>static/js/ckeditor/filemanager/connectors/php/connector.php',
			filebrowserImageBrowseUrl : '<?=BASE_URL?>static/js/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?=BASE_URL?>static/js/ckeditor/filemanager/connectors/php/connector.php',
			filebrowserFlashBrowseUrl :'<?=BASE_URL?>static/js/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?=BASE_URL?>static/js/ckeditor/filemanager/connectors/php/connector.php',
			filebrowserUploadUrl  :'<?=BASE_URL?>static/js/ckeditor/filemanager/connectors/php/upload.php?Type=File',
			filebrowserImageUploadUrl : '<?=BASE_URL?>static/js/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
			filebrowserFlashUploadUrl : '<?=BASE_URL?>static/admin/theme1/js/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
		});<?php */?>
	});
</script>