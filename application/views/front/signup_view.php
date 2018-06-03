<div id="register_overlay_cal" class="popupWindow">
	<div id="register_overlay">
			
		<div class="modal_wapper">
				<div class="inner_wrapper">
					<h3>Register</h3>
					<div class="pop_form user_form">    
                      <form action="<?=BASE_URL?>register" method="post" name="signup" onsubmit="return validate_register();">
                        <div>
                        	<?php echo form_error('first_name')?>
                            <label>First Name:</label>
                            <input type="text" name="first_name" class="text_box" id="first_name" value="<?php echo set_value('first_name'); ?>" />
                        </div>
                        <div>
                        	<?php echo form_error('last_name')?>
                            <label>Last Name:</label>
                            <input type="text" name="last_name"  class="text_box" id="last_name" value="<?php echo set_value('last_name'); ?>" />							
                        </div>
                        <div>
                        	<?php echo form_error('email')?>
                            <label>Email:</label>
                            <input type="text" name="email" class="text_box" id="email" value="<?php echo set_value('email'); ?>" />
                        </div>
                        <div>
                        	<?php echo form_error('password')?>
                            <label>Password:</label>
                            <input type="password" name="password" class="text_box" id="password"  value=""/>
                        </div>
                         <div>
                         	<?php echo form_error('re_password')?>
                            <label>Re-Type Password:</label>
                            <input type="password" name="re_password" class="text_box" id="re_password"  value=""/>
                        </div>
                        <div>
                            <label class="captchaLabel">&nbsp;</label>
                            <label id="captcha"></label>
                            <label id="refresh" class="refresh">&nbsp;Refresh</label>
                        </div>
                        <div class="clear"></div>
                        <div>
                        	<?php echo form_error('code')?>
                            <label>Enter Code:</label>
                            <?php /*?><span class="errormessage"><?=$this->session->flashdata('incorect_code');?></span><?php */?>
                            <input type="text" name="code" class="text_box" id="code" />
                            <input type="hidden" name="hdn_code" class="hdn_code" id="hdn_code" value="" />
                        </div>
                        
                        <div>
                        	<label>&nbsp;</label>
                            <label><input  type="submit" name="signup" class="submit" id="signup_submit" value="Signup" /></label>
                            <a href="javascript:;"  class="login">Login</a>
                        </div>
                    </form>
                  
                     </div>
                	<div class="clear"></div>
				</div>
               
				<?php /*?><img src="<?=FRONT_STATIC_URL?>images/box-bottom.png" alt="" class="f_left iefix" /><?php */?>
				<div class="clear"></div>
		  </div>
	</div>
</div>
<script type="text/javascript">
	function get_captcha()
	{
		$.ajax({
				type : 'post',
				url: "<?php echo BASE_URL?>customer/get_captcha",
				data : {'reg' : 1},
				success : function(result){
					var rs = result.split('::'); 
				    $("#captcha").html(rs[0]);
					$("#hdn_code").val(rs[1]);
				}	
			});	
	}
	get_captcha();
	
	$(document).ready(function(){
		$('#refresh').click(function(){
			get_captcha();
		});
	});
</script>