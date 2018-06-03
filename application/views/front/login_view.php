<div id="login_overlay_cal" class="popupWindow">
	<div id="login_overlay">
			
		<div class="modal_wapper">
				<div class="inner_wrapper">
                    <div class="clear"></div>
					<h3>Login</h3>
					<div class="pop_form user_form">
                    <?=$this->general_lib->show_flash_message('login_error');?>
                    <form action="<?=BASE_URL?>login" method="post" name="login" onsubmit="return validate_login();">  	
                        <div>
                        	<?php echo form_error('login_email')?>
                            <label>Email:</label>
                            <input type="text" name="login_email" id="login_email" class="text_box"/>
                        </div>
                        <div>
                        	<?php echo form_error('login_pass')?>
                            <label>Password:</label>
                            <input type="password" name="login_pass" id="login_pass" class="text_box" />
                        </div>
                        <div>
                        	<label>&nbsp;</label>
                            <input  type="submit" name="signup" class="submit" id="login_submit" value="Login" />
                            <a href="javascript:;"  class="forgot_pass">Forgot Password</a>
                        </div>
               		 </form>            
                              
                     </div>
                	<div class="clear"></div>
				</div>
				<div class="clear"></div>
		  </div>
	</div>
</div>