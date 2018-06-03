 <?php 	$this->load->view("admin/template/header.php"); ?>
    <div id="contents">  			
	<?php
    	if (isset($user_logged_in) && $user_logged_in != false)
        	$this->load->view("admin/template/toppanel.php"); 
    ?>
        <div id="left_pannel"><!--left_pannel open-->
        	 <?php 	$this->load->view("admin/template/leftpanel.php"); ?>
        </div><!--left_pannel_close-->
        <div id="main_contents"><!-- main contents started-->
         <?php 	$this->load->view("admin/template/top_contents.php"); ?>
	        <?=$contents ?>
            <div class="clear"></div>
	    </div>	<!--contents ended-->
        <div class="clear"></div>
       </div>
    </div><!--main close-->
    <div class="clear"></div>
 	<?php 	$this->load->view("admin/template/footer.php"); ?>