<div class="clear"></div> 
   <div class="count_msg"></div>
   <div class="table" id="news_paper">
	   <form name="frmCatOutlet" id="frmCatOutlet" action="<?php echo ADMIN_BASE_URL?>news_paper/manage" method="post">
   		<div class="tbl_heading">
        	<label class="chkbox"><input type="checkbox" name="selectall" id="selectall" /></label>
        	<label class="s_no">S.No</label>
            <label class="paper_name">Name</label>
			<label class="seo_title">SEO Title</label>
            <label class="seo_desc">SEO Desc</label>
            <label class="action"> Action</label>
            <div class="clear"></div>
        </div>
        <?php 
		if($arr_papers)
		{		
			$count=1;
			foreach($arr_papers as $row)
			{
				$s_no = (int)$offset+$count;
				$status_class = 'status_deactive';
				if ($row['status'] == 1)
					$status_class = 'status_active';
				
		?>
        <div class="row <?php if($s_no%2 == 0){echo "even";}?>" id="row_<?php echo $row['id']?>" >
        	<input type="hidden" name="img" class="image" value="<?=$row['image']?>" />
        	<label class="chkbox"><input type="checkbox" name="chkGroup[]" class="case" id="chkGroup[]" value="<?php echo $row['id']?>"/></label>
            <label class="s_no"><?php echo $s_no?></label>
            <label class="paper_name"><?php echo $row['name']?> --- <img src="<?=PAPER_IMG_PATH.$row['image']?>" alt="" height="30" /></label>
            <label class="seo_title"><?=$row['seo_title']?></label>
            <label class="seo_desc"><?=$row['seo_meta_desc']?></label>
            <label class="action">
            	<a href="javascript:;" id="<?php echo $row['id']?>" rel="<?php echo $row['status']?>" class="icon_status <?=$status_class?>" title="Active/Deactive"></a>
            	<a href="<?php echo ADMIN_BASE_URL.'news_paper/add/'.$row['id']?>" class="icon_edit" title="Edit">&nbsp;</a>
                <a href="<?php echo ADMIN_BASE_URL.'news_paper/detail/'.$row['id']?>" rel="<?php echo $row['id']?>" class="icon_detail" title="Detail">&nbsp;</a>
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
		var result = confirm('Are you sure to delete this News Paper.');
		if(result == false)
			return false;
		
		var id = $(this).attr('id');
		var parent_id = '#row_'+id;
		var file = $(parent_id+' .image').val();
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>general/delete",
			  data: 'table=news_paper&file='+file+'&path=uploads/newspaper&id='+id,
			  success: 
			 	function(msg){
				  if(msg == 1)
				  {
					 	alert('News Paper is deleted successflly.'); 
						var loc = window.location;
						window.location;
					}
				}
		});
	});
		
	$(".icon_status").live("click" ,function(){
		var id = $(this).attr('id');
		var parentId = '#row_'+id;
		var status = $(this).attr('rel');
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>general/change_status",
			  data: 'table=news_paper&id='+id+'&status='+status,
			  success: function(msg){
				  if(status == 1)
				  {
				  	$(parentId+' .icon_status').removeClass('status_active');
					$(parentId+' .icon_status').addClass('status_deactive');
					$(parentId+' .icon_status').attr('rel', '0');
					alert("News Paper is deactivated successfully");
				  }
				 else
				 {
				  	$(parentId+' .icon_status').removeClass('status_deactive');
				  	$(parentId+' .icon_status').addClass('status_active');
					$(parentId+' .icon_status').attr('rel', '1');					
					alert("News Paper is activated successfully");
				 }
			  }
		  });
	});
});
</script>


