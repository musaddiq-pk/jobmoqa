<div id="form_container">
  <form name="frmAddOutlet" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
  	<input type="hidden" name="id" id="id" value="<?php echo $paper['id'];?>" />
    <div>
		<?php echo form_error('paper_name')?>
        <label>Name: </label>
      <p>
        <input type="text" name="paper_name" id="paper_name" value="<?php echo set_value('paper_name',$paper['name']);?>" />
      </p>
    </div>
    <div class="clear"></div>
    <div>
		<?php echo form_error('hdn_image')?>
        <label>Image: </label>
      <p class="upload_img">
          <input type="file" name="image" id="image"  />
          <input type="hidden" name="hdn_image" id="hdn_image" value="<?php echo $paper['image']?>" />
          <input type="hidden" name="old_img" id="old_img" value="<?php echo $paper['image']?>" /> 
          <?php if($paper['image']!='')echo '<img src="'.PAPER_IMG_PATH.$paper['image'].'"  width="100" height="60" style="background:#E6BFBF;" />'?>  
      </p>
    </div>
    
     
     
     <div class="clear"></div>
     <div>
     	<?=form_error('desc')?>
        <label>Description: </label>
      <p>
        <textarea name="desc" id="desc" cols="37" rows="5" ><?php echo set_value('desc',$paper['desc']);?></textarea>
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
        <input type="text" name="seo_title" id="seo_title" value="<?php echo set_value('seo_title',$paper['seo_title']);?>"  />
      </p>
    </div>
    <div>
    	<span class="note">Recommended Meta Description size = 200 char.</span>
         <?=form_error('seo_meta_desc')?>
        <label> Meta Description: </label>
      <p>
        <textarea name="seo_meta_desc" id="seo_meta_desc" cols="37" rows="5" ><?php echo set_value('seo_meta_desc',$paper['seo_meta_desc']);?></textarea>
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
	});
</script>