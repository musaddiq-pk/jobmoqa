<div id="form_container">
  <form name="frmAddOutlet" method="post" action="<?php echo $action;?>" >
  	<input type="hidden" name="id" id="id" value="<?php echo $cat['id'];?>" />
    <div>
    	<?php echo form_error('cat_name')?>
        <label> Category Name: </label>
      <p>
        <input type="text" name="cat_name" id="cat_name" value="<?php echo set_value('cat_name',$cat['name']);?>" class="txtBox" />
      </p>
      
    </div>
    <div>
    	<?php echo form_error('desc')?>
        <label>Category Description: </label>
      <p>
        <textarea name="desc" id="desc" cols="37" rows="5"><?php echo set_value('desc',$cat['desc']);?></textarea>
      </p>
    </div>
    <div class="clear"></div>
    <div><label style="font-size:16px;font-family:Arial, Helvetica, sans-serif;">Site SEO</label></div>
     <div class="clear"></div>
    <div>
    	<?php echo form_error('seo_title')?>
    	<span>Recommended Page Title size = 50 char</span>
        <label >Page Title: </label>
      <p>
        <input type="text" name="seo_title" id="seo_title" value="<?php echo set_value('seo_title',$cat['seo_title']);?>" class="txtBox" />
      </p>
      <?php //=form_error('txtPageTitle')?>
    </div>
    <div>
    	<?php echo form_error('seo_meta_desc')?>
    	<span>Recommended Meta Description size = 200 char.</span>
        <label> Meta Description: </label>
      <p>
        <textarea name="seo_meta_desc" id="seo_meta_desc" cols="37" rows="5" ><?php echo set_value('seo_meta_desc',$cat['seo_meta_desc']);?></textarea>
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


<script type="text/javascript">
	$(document).ready(function(){
		$("#cat_name").blur(function(){
			var id = $('#id').val();
			if(id == 0)
				$("#seo_title").val($(this).val());
		});	
	});
</script>
