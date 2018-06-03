<div id="forgot_pwd_overlay_cal" class="popupWindow">
	<div id="forgot_pwd_overlay">
			
		<div class="modal_wapper">
				<div class="inner_wrapper">
					<h3>Forgot Password</h3>
					<div class="pop_form user_form">    
                      <form action="<?=BASE_URL?>forgot_password" method="post" name="frmForgetPwd" onsubmit="return validate_forget_password();">
                        <div>
                        	<?php echo form_error('forgot_email')?>
                            <label>Email:</label>
                            <input type="text" name="forgot_email" class="text_box" id="forgot_email" value="" />
                        </div>
                        <div>
                           <label>&nbsp;</label>
                           <input  type="submit" name="signup" class="submit" id="submit_forgot_password" value="Submit" />
                        </div>
                        <div><label>&nbsp;</label><span>Please enter your Email and we'll send a message so you can get reset your password.</span>
                        </div>
                	</form>                            
                     </div>
				</div>
               
				<?php /*?><img src="<?=FRONT_STATIC_URL?>images/box-bottom.png" alt="" class="f_left iefix" /><?php */?>
				<div class="clear"></div>
		  </div>
	</div>
</div>