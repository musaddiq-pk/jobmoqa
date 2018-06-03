<? //echo''; print_r($Cats); echo''; exit;?>
	<form action="<?php echo BASE_URL.'profile'?>" method="post">
    <div class="shipping_info" style="width:1014px"> <!--Contents container start--> 
		 <h2>Personal Information</h2>
         <?=$this->general_lib->show_flash_message('message_success','success');?>
      <div>
      	<?php echo form_error('txtFirstName')?>
      	<label>First Name:</label><input type="text" class="text_box" name="txtFirstName" value="<?php echo set_value('txtFirstName',$user['f_name'])?>"/></div>
      <div>
      	<?php echo form_error('txtlastName')?>
      	<label>Last Name:</label><input type="text" class="text_box" name="txtlastName" value="<?php echo set_value('txtlastName',$user['l_name'])?>" /></div>
      <div>
      	<?php echo form_error('txtEmail')?>
      	<label>E-mail:</label><input type="text" class="text_box" name="txtEmail" value="<?php echo set_value('txtEmail',$user['email'])?>" /></div>
      <div>
      	<?php echo form_error('txtPhone1')?>
      	<label>Phone:</label><input type="text" class="text_box" name="txtPhone1" value="<?php echo set_value('txtPhone1',$user['cell1'])?>" /></div>
       <div>
      	<?php echo form_error('txtPhone2')?>
      	<label>Phone:</label><input type="text" class="text_box" name="txtPhone2" value="<?php echo set_value('txtPhone2',$user['cell2'])?>" /></div>
      <div>
      	<?php echo form_error('txtCity')?>
      	<label>City:</label><input type="text" class="text_box" name="txtCity" id="txtCity" value="<?php echo set_value('txtCity',$user['city'])?>" /></div>
      <div>
      	<?php echo form_error('txtAddress')?>
      	<label>Address:</label><textarea name="txtAddress" id="txtAddress"  style="width:345px;height:80px;"><?php echo set_value('txtAddress',$user['address'])?></textarea></div>
      <div>
      	<label>&nbsp;</label><input type="submit" name="edit_profile" id="edit_profile" class="popup_btn" value="Save" />
      </div>
       <div class="clear"></div>
</div><!--.Content Top ended-->
   	</form>
<div class="clear"></div>
</div><!--.Contents container end-->