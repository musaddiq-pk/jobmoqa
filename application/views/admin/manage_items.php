<div class="clear"></div> 
	<div class="search_form">
   <strong>Search</strong>
   <form name="frmRawDataSearch" method="post" action="<?=ADMIN_BASE_URL?>item">
   <div class="search_item_inner skyType">
       <div>
       	<p>
       		<label for="">Category:</label>
            <select name="lstCatSearch" id="lstCatSearch">
              <option value="0">--select--</option>
              <?php foreach($categories as $cat): ?>
              <option value="<?php echo $cat['pkCategoryId']?>" <?php if($cat['pkCategoryId']==$search_data['lstCatSearch']){echo 'selected="selected"';}?>><?php echo $cat['cat_name']?></option>
              <?php endforeach;?>
            </select>
       </p>
       <p>
       		<label>User SKU:</label>
            <input type="text" name="txtUserSKU" id="txtUserSKU" value="<?php echo $search_data['txtUserSKU']?>" />
          </p>
       <p style="display:none">
       <label for="">Sub Category:</label>
        <select name="lstSubCatSearch" id="lstSubCatSearch">
          <option value="0">--select--</option>
         <?php /*?> <? foreach($subCatSearch as $subCat):?>
          <option value="<?=$subCat['pkCategoryId']?>" <? if($subCat['pkCategoryId']==$searchData['lstSubCatSearch']){echo 'selected="selected"';}?>><?=$subCat['Name']?>      </option>
          <? endforeach;?><?php */?>
        </select>
       </p>
       </div>
       <div class="clear"></div>
       <div>
           <p>
           	<label for="">Brand:</label>
            <select name="lstBrand" id="lstBrand">
              <option value="0">--select--</option>
              <?php foreach($brands as $row):?>
              <option value="<?php echo $row['pkBrandId']?>" <?php if($row['pkBrandId']==$search_data['lstBrand']){echo 'selected="selected"';}?>><?php echo $row['brand_name']?>       </option>
              <?php endforeach;?>
            </select>
           </p>
           <p>
       		<label>Item Name:</label>
            <input type="text" name="txtItemName" id="txtItemName" value="<?=$search_data['txtItemName']?>" />
           </p>
       </div>	
          <div>
          <p>&nbsp;</p>
           <p style="display:none">
       		<label>Status:</label>
            <select name="lstStatus" id="lstStatus" >
            	<option value="-1" <?php if($search_data['lstStatus'] == -1) echo 'selected="selected"';?>>All</option>
                <option value="1" <?php if($search_data['lstStatus'] == 1) echo 'selected="selected"';?>>Active</option>
                <option value="0" <?php if($search_data['lstStatus'] == 0) echo 'selected="selected"';?>>Deactive</option>
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
   <div class="table" id="item">
	   <form name="frmCatOutlet" id="frmCatOutlet" action="<?php echo ADMIN_BASE_URL?>item/manage" method="post">
   		<div class="tbl_heading">
        	<label class="chkbox"><input type="checkbox" name="selectall" id="selectall" /></label>
        	<label class="s_no">S.No</label>
            <label class="cat_name">Name</label>
            <label class="img">Image</label>
            <label class="price">C.Price</label>
			<label class="price">S.Price</label>
           	<label class="status">Status</label>
            <label class="status">Featured</label>
            <label class="date">Date</label>
            <label class="action"> Action</label>
            <div class="clear"></div>
        </div>
        <?php 
		if($items)
		{		
			$count=1;
			foreach($items as $row)
			{
				$s_no = (int)$offset+$count;
		?>
        <div class="row <?php if($s_no%2 == 0){echo "even";}?>" id="row_<?php echo $row['pkItemId']?>" >
        	<label class="chkbox"><input type="checkbox" name="chkGroup[]" class="case" id="chkGroup[]" value="<?php echo $row['pkItemId']?>"/></label>
            <label class="s_no"><?php echo $s_no?></label>
            <label class="cat_name"><?php echo $row['item_name']?></label>
            <label class="sku"><img src="<?php echo BASE_URL.'uploads/'.$row['Image']?>" alt="" width="100" /></label>
            <label class="price">
            	<input type="text" value="<?php echo $row['cost_price']?>" hdn_class="old_cost_price" db_field="cost_price" name="item_price" class="cost_price">
                <input type="hidden" value="<?php echo $row['cost_price']?>" name="old_cost_price" class="cost_price">
            </label>
            <label class="price">
				<input type="text" value="<?php echo $row['sale_price']?>" hdn_class="old_sale_price" db_field="sale_price" name="sale_price" class="sale_price">
                <input type="hidden" value="<?php echo $row['sale_price']?>" name="old_sale_price" class="old_sale_price">
            </label>
            <label class="status">
            	<a href="javascript:;" id="<?php echo $row['pkItemId']?>" rel="<?php echo $row['status']?>" class="icon_status <?php if ($row['status'] == 1) echo ' status_active'; else echo ' status_deactive'; ?>" title="Active/Deactive"></a>  
			</label>
            <label class="status">
            	<a href="javascript:;" item_id="<?php echo $row['pkItemId']?>" is_featured="<?php echo $row['is_featured']?>" class="icon_featured <?php if ($row['is_featured'] == 1) echo ' featured'; else echo ' un_featured'; ?>" title="Featured/Unfeatured"></a>  
			</label>
            <label class="date"><?php echo date('Y-m-d',strtotime($row['c_date']))?></label>
            <label class="action">
            	<a href="<?php echo ADMIN_BASE_URL.'item/add/'.$row['pkItemId']?>" class="icon_edit" title="Edit">&nbsp;</a>
                <a href="<?php echo ADMIN_BASE_URL.'item/matching/'.$row['pkItemId']?>" class="icon_matching" title="Matching">&nbsp;</a>
                <a href="<?php echo ADMIN_BASE_URL.'item/detail/'.$row['pkItemId']?>" rel="<?php echo $row['pkItemId']?>" class="icon_detail" title="Detail">&nbsp;</a>
                <a href="javascript:;" class="icon_delete" rel="<?php echo $row['pkItemId']?>" title="Delete">&nbsp;</a>
                </label>
            <div class="clear"></div>
            <div class="show_detail" id="show_detail_<?php echo $row['pkItemId']?>" style="display:none;">
               
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
		var result = confirm('Are you sure to delete this item.');
		if(result == false)
			return false;
		
		var item_id = $(this).attr('rel');
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>item/delete",
			  data: 'item_id='+item_id,
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
	
	/*$(".icon_detail").click(function(){
		var item_id = $(this).attr('rel');
		//show_detail_6
		$.ajax({
			type : 'POST',
			url :  '<?=ADMIN_BASE_URL?>item/get_item_detail',
			data : 'item_id='+item_id,
			async : false,
			success : function(item_detail){
				//alert(cat_detail);return;
				$(".detail1").hide('slow');
				$("#show_detail_"+item_id).html(item_detail);
				$("#show_detail_"+item_id).slideToggle('slow');
			}
		});	
	});*/
		
	$(".icon_status").live("click" ,function(){
		var item_id = $(this).attr('id');
		var parentId = '#row_'+item_id;
		var status = $(this).attr('rel');
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>item/change_status",
			  data: 'item_id='+item_id+'&status='+status,
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
	
	$(".icon_featured").live("click" ,function(){
		var item_id = $(this).attr('item_id');
		var parentId = '#row_'+item_id;
		var featured = $(this).attr('is_featured');
		
		$.ajax({
			  type: 'POST',
			  url: "<?php echo ADMIN_BASE_URL?>item/change_featured_status",
			  data: 'item_id='+item_id+'&is_featured='+featured,
			  success: function(msg){
				  if(featured == 1)
				  {
				  	$(parentId+' .icon_featured').removeClass('featured');
					$(parentId+' .icon_featured').addClass('un_featured');
					$(parentId+' .icon_featured').attr('is_featured', '0');
					alert("Item is un featured successfully.");
				  }
				 else
				 {
				  	$(parentId+' .icon_featured').removeClass('un_featured');
				  	$(parentId+' .icon_featured').addClass('featured');
					$(parentId+' .icon_featured').attr('is_featured', '1');					
					alert("Item is make featured successfully");
				 }
			  }
		  });
	});
});
</script>


