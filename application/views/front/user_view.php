<div class="container content">
	<div style="width:250px;float:left;">
    	<div>
        	<label>Price</label>
            <form id="price_form" method="post" action="">
                <div id="price_slider"></div>
                <span style="font-size:15px;">$</span> <input type="text" name="price_from" id="price_from" value="<?=$price_from?>" /> 
                <span style="font-size:15px;">to </span><input name="price_to" id="price_to" value="<?=$price_to?>" />
                <input type="submit" name="search_by_price" id="search_price" value="Submit" />
            </form>
        </div>
	</div>
    <div style="width:700px;float:right;">
    	<?php foreach($arr_ad as $row) : ?>
                <div style="padding:20px;">
                	<a href="<?=BASE_URL.$row['sub_cat_url'].'/'.$row['url'].'/'.$row['id']?>"><?=$row['title']?></a><br />
                    <label>R.s <?=$row['price']?></label><br />
                    <label><?=$row['city_name']?></label><br />
                    <label><? //echo $row['c_date'];
					echo date('d-m-Y g:i a',strtotime($row['c_date']))?></label><br />
                    <label>See all <a href="<?=BASE_URL.'brand/'.$row['manufacturer_url']?>"><?=$row['manufacturer_name']?></a> Products</label><br />
                </div>
                <div class="clearfix"></div>   
        <?php endforeach; ?>
    </div>
</div>
<script type="text/javascript">
	$(document).ready(function(e) {
		
		$('.sub_cat_brand').change(function(){
			var brands = '';
			$('.sub_cat_brand:checked').each(function(index, element) {
				brands = $(this).val()+',';
			});
			
			$('#brands').val(brands);
			$('#price_form').submit();
		});
		
		$('.rdb_seller').change(function(){
			$('#seller_type').val($(this).val());
			$('#price_form').submit();
		});
		
		
    });
</script>