<div id="search">	<!-- contnet left started -->
    <h2 class="f_left"><?php echo $content_heading;?></h2>
    <?php if(!empty($paging)) echo $paging;?>
    <div class="clear"></div>
    <div class="clear"></div>
    <?php if($arr_items) :
        $count = 0; 
        foreach($arr_items as $item):
            $first_product = $separator = '';
            if($count%4 == 0)
                $first_product = ' first_product';
			if($count %4 == 3)
				$separator = '<div class="clear"></div>';
            $count ++;
    ?>
    <table border="0" class="product_list <?php echo $first_product?>">
        <tr>
            <td  class="prod_img" align="center" valign="middle"><a href="<?php echo BASE_URL.'item_detail/'.$item['item_url'].'/'.$item['pkItemId']?>"><img src="<?php echo BASE_URL?>uploads/<?php echo $item['Image']?>" alt="" /></a></td>
        </tr>
        <tr>
            <td>
                <a href="<?php echo BASE_URL.'item_detail/'.$item['item_url'].'/'.$item['pkItemId']?>" class="product_title"><?php echo $item['page_title']?></a>
                <span class="product_price">$ <?php echo $item['sale_price']?></span>
            </td>
        </tr>
    </table>
    <?php
		echo $separator;
    	endforeach;
		else :
			echo '<div style="text-align:center;color:red;">No Item found with this search.</div>';
		endif;
		
	?>
    <div class="clear"></div>
    <div id="main_brands">
    </div>
</div>	<!-- content left ended -->