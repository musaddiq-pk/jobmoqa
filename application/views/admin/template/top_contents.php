<div id="category_wraper">
<h1>
  <?php echo $content_heading;?>
</h1>
<div class="link_btn">
  <div class="btn_add_new">
   <?php if(isset($add_url))
  {
  	echo '<a href="'.$add_url.'"><img src="'.ADMIN_STATIC_URL.'images/plus_add_new.jpg" alt="" title="Add new record" /><span>Add New</span></a>'; 
  }
  ?>
  </div>
  <?php if(isset($view_all_url))
  {
  	echo '<div class="btn_view_all"><a href="'.$view_all_url.'"><img src="'.ADMIN_STATIC_URL.'images/search_32.jpg" alt="" title="View all records" /><span>View All</span></a></div>';
  }
  ?>
  <div class="clear"></div>
</div>
<div class="clear"></div>
<?php 
if(isset($total_records))
{
	echo '<div class="count_record"> Total '.$total_records.' Records Found </div>';

}
		echo $this->general_lib->show_flash_message('success_message');
		//echo '<div class="success_message">'.$success_message.'</div>'
?>
</div>

