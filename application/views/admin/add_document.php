<div id="form_container">
  <form name="frmAddOutlet" method="post" action="<?php echo $action;?>" enctype="multipart/form-data">
  	<input type="hidden" name="id" id="id" value="<?php echo $document['id'];?>" />
    <div>
    	<?php echo form_error('type')?>
        <label> Type: </label>
      <p>
        <select id="type" name="type">
        	<option value="">Select</option>
            <?php
            	foreach($types as $key=> $val)
					echo '<option value="'.$val.'" '.set_select('type',$document['type'],($document['type'] == $val)).'>'.$key.'</option>';
			?>
        </select>
      </p>
    </div>
    <div class="clear"></div>
    <div>
		<?php echo form_error('doc_title')?>
        <label>Title: </label>
      <p>
        <input type="text" name="doc_title" id="doc_title" value="<?php echo set_value('doc_title',$document['title']);?>" />
      </p>
    </div>
    <div class="clear"></div>
    <div>
		<?php echo form_error('hdn_file')?>
        <label>File: </label>
      <p class="upload_img">
          <input type="file" name="file" id="file"  />
          <input type="hidden" name="hdn_file" id="hdn_file" value="<?php echo $document['file']?>" />
          <input type="hidden" name="old_file" id="old_file" value="<?php echo $document['file']?>" /> 
      </p>
    </div>
    <div class="clear"></div>
    <div>
		<?php echo form_error('hdn_image')?>
        <label>Image: </label>
      <p class="upload_img">
          <input type="file" name="image" id="image"  />
          <input type="hidden" name="hdn_image" id="hdn_image" value="<?php echo $document['image']?>" />
          <input type="hidden" name="old_img" id="old_img" value="<?php echo $document['image']?>" /> 
          <?php if($document['image']!='')echo '<img src="'.DOC_FILE_PATH.$document['image'].'" height="60" style="background:#E6BFBF;" />'?>  
      </p>
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
		
		$("#image").change(function(){
			var img = $(this).val();
			var replaced_val = img.replace("C:\\fakepath\\",'');
			$('#hdn_image').val(replaced_val);
		});
		
		$("#file").change(function(){
			var file = $(this).val();
			var replaced_val = file.replace("C:\\fakepath\\",'');
			$('#hdn_file').val(replaced_val);
		});
	});
</script>