<div class="clear"></div> 
	<div class="search_form">
   <strong>Search</strong>
   <form name="frmRawDataSearch" method="post" action="<?=ADMIN_BASE_URL?>ad">
   <div class="search_item_inner skyType">
       <div>
       	<p>
       		<label for="">Category:</label>
            <select name="cat_id" id="cat_id">
              <option value="0">--select--</option>
              <?php foreach($categories as $cat): ?>
              <option value="<?php echo $cat['id']?>" <?php if($cat['id']== $search_data['cat_id']){echo 'selected="selected"';}?>><?php echo $cat['name']?></option>
              <?php endforeach;?>
            </select>
       </p>
       <p>
       		<label for="">News Paper:</label>
            <select name="paper_id" id="paper_id">
              <option value="0">--select--</option>
              <?php foreach($papers as $row): ?>
              <option value="<?php echo $row['id']?>" <?php if($row['id']== $search_data['paper_id']){echo 'selected="selected"';}?>><?php echo $row['name']?></option>
              <?php endforeach;?>
            </select>
       </p>
       </div>
       <div class="clear"></div>
          <div>
          <p>&nbsp;</p>
           <p>
       		<label>Status:</label>
            <select name="status" id="status" >
            	<option value="-1" <?php if($search_data['status'] == -1) echo 'selected="selected"';?>>All</option>
                <option value="1" <?php if($search_data['status'] == 1) echo 'selected="selected"';?>>Active</option>
                <option value="0" <?php if($search_data['status'] == 0) echo 'selected="selected"';?>>Deactive</option>
           </select>
          </p>
       </div>
       <div>
          <p style="padding-left:117px;">
          	 <input type="submit" name="btnSearch" id="btnSearch" value="Search" class="btnAdd" />
          </p>
       </div>   
        <div class="clear"></div>
   </div>
   </form>
  <div class="clear"></div>
   </div>

   <div class="count_msg"></div>
   <div class="table" id="ad">
	   <form name="frmCatOutlet" id="frmCatOutlet" action="<?php echo ADMIN_BASE_URL?>item/manage" method="post">
   		<div class="tbl_heading">
        	<label class="chkbox"><input type="checkbox" name="selectall" id="selectall" /></label>
        	<label class="s_no">S.No</label>
            <label class="ad_name">Name</label>
            <label class="category">Category</label>
			<label class="category">News Paper</label>
            <label class="date">Date</label>
            <label class="action"> Action</label>
            <div class="clear"></div>
        </div>
        <?php 
		if($arr_ad)
		{		
			$count=1;
			foreach($arr_ad as $row)
			{
				$s_no = (int)$offset+$count;
				$status_class = 'status_deactive';
				if ($row['status'] == 1)
					$status_class = 'status_active';
				
		?>
        <div class="row <?php if($s_no%2 == 0){echo "even";}?>" id="row_<?php echo $row['id']?>" >
        	<label class="chkbox"><input type="checkbox" name="chkGroup[]" class="case" id="chkGroup[]" value="<?php echo $row['id']?>"/></label>
            <label class="s_no"><?php echo $s_no?></label>
            <label class="ad_name"><?php echo $row['name']?></label>
            <label class="category"><?=$row['cats']?></label>
            <label class="category"><?=$row['papers']?></label>
            <label class="date"><?php echo $this->general_lib->show_date($row['cdate'])?></label>
            <label class="action">
            	<a href="javascript:;" id="<?php echo $row['id']?>" rel="<?php echo $row['status']?>" class="icon_status <?=$status_class?>" title="Active/Deactive"></a>
            	<a href="<?php echo ADMIN_BASE_URL.'ad/add/'.$row['id']?>" class="icon_edit" title="Edit">&nbsp;</a>
                <a href="<?php echo ADMIN_BASE_URL.'ad/detail/'.$row['id']?>" rel="<?php echo $row['id']?>" class="icon_detail" title="Detail">&nbsp;</a>
                <a href="javascript:;" class="icon_delete" rel="<?php echo $row['id']?>" title="Delete">&nbsp;</a>
                </label>
            <div class="clear"></div>
        </div> 
        <div class="clear"></div>
          <?php
		   $count++;
			}	//endforeach
		}
		else
		{
		   echo "No Record Found.";
		}
		?>
       
       <div class="paging_link"><?php echo $paging; ?></div>
 <div class="clear"></div>
 
 	</form>
</div>


<script type="text/javascript">
$(document).ready(function(){
	$(".icon_delete").click(function(){
		var result = confirm('Are you sure to delete this Ad.');
		if(result == false)
			return false;
		
		var ad_id = $(this).attr('rel');
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>ad/delete",
			  data: 'ad_id='+ad_id,
			  success: 
			 	function(msg){
				  if(msg == 1)
				  {
					 	alert('Ad is deleted successflly.'); 
						location.reload;
					}
				}
		});
	});
		
	$(".icon_status").live("click" ,function(){
		var ad_id = $(this).attr('id');
		var parentId = '#row_'+ad_id;
		var status = $(this).attr('rel');
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>ad/change_status",
			  data: 'ad_id='+ad_id+'&status='+status,
			  success: function(msg){
				  if(status == 1)
				  {
				  	$(parentId+' .icon_status').removeClass('status_active');
					$(parentId+' .icon_status').addClass('status_deactive');
					$(parentId+' .icon_status').attr('rel', '0');
					alert("Item is deactivated successfully");
				  }
				 else
				 {
				  	$(parentId+' .icon_status').removeClass('status_deactive');
				  	$(parentId+' .icon_status').addClass('status_active');
					$(parentId+' .icon_status').attr('rel', '1');					
					alert("Item is activated successfully");
				 }
			  }
		  });
	});
});
</script>


