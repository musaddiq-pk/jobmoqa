<div id="form_container1">
  <form name="frmAddOutlet" method="post" action="<?php echo $action;?>" onsubmit="">
  	<input type="hidden" name="id"  value="<?=$page['id']?>" />
    <div>
		<?php echo form_error('page_name')?>
        <label>Name: </label>
      <p>
        <input type="text" name="page_name" id="page_name" value="<?php echo set_value('page_name',$page['name']);?>" />
      </p>
    </div>

     <div class="clear"></div>
     <div>
     	<?=form_error('desc')?>
        <label>Description: </label>
      <p style="width:600px;float:left;">
        <textarea name="desc" id="editor" cols="37" rows="5" ><?php echo set_value('desc',$page['desc']);?></textarea>
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
        <input type="text" name="seo_title" id="seo_title" value="<?php echo set_value('seo_title',$page['seo_title']);?>"  />
      </p>
    </div>
    <div>
    	<span class="note">Recommended Meta Description size = 200 char.</span>
         <?=form_error('seo_meta_desc')?>
        <label> Meta Description: </label>
      <p>
        <textarea name="seo_meta_desc" id="seo_meta_desc" cols="37" rows="5" ><?php echo set_value('seo_meta_desc',$page['seo_meta_desc']);?></textarea>
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
		$("#page_name").blur(function(){
			$("#seo_title").val($(this).val());
		});	
		
		$("#desc").blur(function(){
			$("#seo_desc").val($(this).val());
		});	
	});
</script>