
<? //echo''; print_r($Cats); echo''; exit;?>
	<form id="ad_form" name="ad_form" enctype="multipart/form-data" action="<?php echo BASE_URL.'post-your-ad'?>" method="post">
    	<input type="hidden" id="cat_id" name="cat_id" />
        <input type="hidden" id="search_field" name="search_field" />
<div class="" > <!--Contents container start--> 	
     <h2>Ad detail</h2>
     <div>
     	<?php
        	foreach($area as $row)
				echo '<p><a href="javascript:;" class="parent_cat" title="'.$row['name'].'" rel="'.$row['id'].'">'.$row['name'].'</a></p>';
		?>
     </div>
     <div id="ad_detail">
     	<div>
        	<label>Category</label>
            <select id="sub_cat_id" name="sub_cat_id">
                <option value="0">---Select---</option>
            </select>
        </div>
        <div>
        	<label>Brand</label>
            <select id="manufacturer_id" name="manufacturer_id">
                <option value="0">---Select---</option>
            </select>
        </div>
        <div>
        	<label>Model</label>
            <select id="model_id" name="model_id">
                <option value="0">---Select---</option>
            </select>
        </div>
        <div id="features"></div>
        <div>
        	<label>Ad Title</label>
            <input id="title" name="title" type="text" />
        </div>
        <div>
        	<label>Ad Image</label>
            <input id="image" name="image" type="file" />
            <input id="hdn_image" name="hdn_image" type="hidden" />
        </div>
         <div>
        	<label>Price(Pkr)</label>
            <input id="price" name="price" type="text" />
        </div>
        <div>
        	<label>Description</label>
            <textarea id="desc" name="desc"></textarea>
        </div>
        <h2>Seller Info</h2>
        <div>
        	<label>Create My Account</label>
            <p><label><input type="radio" name="create_account" class="create_account" checked="checked" value="0" />No</label></p>
            <p><label><input type="radio" name="create_account" class="create_account" value="1" />Yes</label></p>
        </div>
        <div id="business_type">
        	<label>I m</label>
            <p><label><input type="radio" name="business_type" class="business_type" checked="checked" value="<?=SELLER_INDIVIDUAL?>" />Individual</label></p>
            <p><label><input type="radio" name="business_type" class="business_type" value="<?=SELLER_BUSINESS?>" />Business</label></p>
        </div>
        <div>
        	<label>Name</label>
            <input id="seller_name" name="seller_name" type="text" />
        </div>
        <div>
        	<label>Email</label>
            <input id="email" name="email" type="text" />
        </div>
        <div>
        	<label>Phone</label>
            <input id="phone" name="phone" type="text" />
        </div>
        <div>
        	<label>Location</label>
            <select id="state_id" name="state_id">
            	<option value="0">--Select--</option>
            <?php
        	foreach($states as $row)
				echo '<option value="'.$row['id'].'" '.set_select('state_id',$ad['state_id'],($ad['state_id'] == $row['id'])).'>'.$row['name'].'</option>';
			?>
            </select>
        </div>
        <div>
        	<label>City</label>
            <select id="city_id" name="city_id">
            	<option value="0">--Select--</option>
            </select>
        </div>
        <div>
        	<label>Ad Address</label>
            <input id="address" name="address" type="text" />
        </div>
        <div>
            <input id="post_add" name="post_add" type="submit" value="Post Ad" />
        </div>
     </div>
      
</div><!--.Contents container end-->
</form>

<script type="text/javascript">
	$(document).ready(function(){
		
		$('.parent_cat').click(function(){
			var id = $(this).attr('rel');
			$('#cat_id').val(id);
			$.ajax({
				  type: 'POST',
				  url: "<?php echo BASE_URL?>ajax/get_sub_cat_options",
				  data: 'id='+id,
				  async : false,
				  success: function(result){
					$('#sub_cat_id').html(result);
					$('#sub_cat_id').change();
				  }
			  });
		});
		
		$('#sub_cat_id').change(function(){
			var id = $(this).val();	
			$.ajax({
				  type: 'POST',
				  url: "<?php echo BASE_URL?>ajax/get_sub_cat_manufacturers",
				  data: 'id='+id,
				  async : false,
				  success: function(result){
					$('#manufacturer_id').html(result);
				  }
			  });
		});
		
		$('#manufacturer_id').change(function(){
			var id = $(this).val();
			$.ajax({
				  type: 'POST',
				  url: "<?php echo BASE_URL?>ajax/get_manufacturer_models",
				  data: 'id='+id,
				  async : false,
				  success: function(result){
					$('#model_id').html(result);
				  }
			  });
		});
		
		$('#sub_cat_id').change(function(){
			var id = $(this).val();
			
			$.ajax({
				  type: 'POST',
				  url: "<?php echo BASE_URL?>ajax/get_sub_cat_features",
				  data: 'id='+id,
				  async : false,
				  success: function(result){
					$('#features').html(result);
				  }
			  });
		});	
		
		$('#state_id').change(function(){
			var id = $(this).val();
			
			$.ajax({
				  type: 'POST',
				  url: "<?php echo BASE_URL?>ajax/get_cities_options",
				  data: 'id='+id,
				  async : false,
				  success: function(result){
					$('#city_id').html(result);
				  }
			  });
		});	
		
		//Place the add
		/*$('#post_add').click(function(){
			var search_data = $('#title').val()+','+$('#cat_id').text()+','+$('#sub_cat_id').text()+','+$('#state_id').text()+','+$('#city_id').text();
			$('#search_field').val(search_data);
			$.ajax({
				  type: 'POST',
				  url: "<?php echo BASE_URL?>ajax/post_ad",
				  data: $('#ad_form').serialize(),
				  async : false,
				  success: function(result){
					$('#features').html(result);
				  }
			  });
		});*/
	});
</script>