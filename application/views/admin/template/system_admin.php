 <?php 	$this->load->view("template/admin/header.php"); ?>
    <div id="contents">
        <div id="left_pannel"><!--left_pannel open-->
        	 <?php 	$this->load->view("template/admin/leftpanel.php"); ?>
        </div><!--left_pannel_close-->
        <div id="main_contents"><!--right_pannel open-->
            <?=$contents ?>
           </div>
	    </div><!--right_pannel-->
         <div class="clear"></div>
    <!--contents close-->    
 	<?php 	$this->load->view("template/admin/footer.php"); ?>
   