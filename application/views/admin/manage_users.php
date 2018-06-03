<div class="clear"></div> 
   <div class="count_msg"></div>
   <div class="table" id="user">
	   <form name="frmCatOutlet" id="frmCatOutlet" action="<?php echo ADMIN_BASE_URL?>users/manage" method="post">
   		<div class="tbl_heading">
        	<label class="chkbox"><input type="checkbox" name="selectall" id="selectall" /></label>
        	<label class="s_no">S.No</label>
            <label>Name</label>
            <label class="email">Email</label>
            <label>City</label>
			<label>Zip Code</label>
           	<label>Status</label>
            <label>Date</label>
            <label class="action"> Action</label>
            <div class="clear"></div>
        </div>
        <?php 
		if($users)
		{		
			$count=1;
			foreach($users as $row)
			{
				$s_no = (int)$offset+$count;
		?>
        <div class="row <?php if($s_no%2 == 0){echo "even";}?>" id="row_<?php echo $row['pkUserId']?>" >
        	<label class="chkbox"><input type="checkbox" name="chkGroup[]" class="case" id="chkGroup[]" value="<?php echo $row['pkUserId']?>"/></label>
            <label class="s_no"><?php echo $s_no?></label>
            <label><?php echo $row['first_name'].' '.$row['last_name']?></label>
            <label class="email"><?php echo $row['email']?></label>
            <label><?php echo $row['city']?></label>
            <label><?php echo $row['zip_code']?></label>
            <label>
            	<a href="javascript:;" id="<?php echo $row['pkUserId']?>" rel="<?php echo $row['status']?>" class="icon_status <?php if ($row['status'] == 1) echo ' status_active'; else echo ' status_deactive'; ?>" title="Active/Deactive"></a>  
			</label>
            <label><?php echo date('Y-m-d',strtotime($row['cdate']))?></label>
            <label class="action">
            	<?php /*?><a href="<?php echo ADMIN_BASE_URL.'users/add/'.$row['pkUserId']?>" class="icon_edit" title="Edit">&nbsp;</a><?php */?>
                <a href="JavaScript:;" rel="<?php echo $row['pkUserId']?>" class="icon_detail" title="Detail">&nbsp;</a>
                <a href="javascript:;" class="icon_delete" rel="<?php echo $row['pkUserId']?>" title="Delete">&nbsp;</a>
           </label>
            <div class="clear"></div>
            <div class="show_detail" id="show_detail_<?php echo $row['pkUserId']?>" style="display:none;">
               
            </div>
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
		var result = confirm('Are you sure to delete this user.');
		if(result == false)
			return false;
		
		var user_id = $(this).attr('rel');
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>users/delete",
			  data: 'user_id='+user_id,
			  success: 
			 	function(msg){
				  if(msg == 1)
				  {
					 	alert('Item is deleted successflly.'); 
						var cur_loc = window.location;
						window.location = cur_loc;
					}
				}
		});
	});
	
	$(".icon_detail").click(function(){
		var user_id = $(this).attr('rel');
		//show_detail_6
		$.ajax({
			type : 'POST',
			url :  '<?=ADMIN_BASE_URL?>users/get_user_detail',
			data : 'user_id='+user_id,
			async : false,
			success : function(user_detail){
				//alert(cat_detail);return;
				$(".detail1").hide('slow');
				$("#show_detail_"+user_id).html(user_detail);
				$("#show_detail_"+user_id).slideToggle('slow');
			}
		});	
	});
		
	$(".icon_status").live("click" ,function(){
		var user_id = $(this).attr('id');
		var parentId = '#row_'+user_id;
		var status = $(this).attr('rel');
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>users/change_status",
			  data: 'user_id='+user_id+'&status='+status,
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


