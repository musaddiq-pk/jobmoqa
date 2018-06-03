<div id="login_wraper">
  <h1>Welcome to Jackets 4 Bikers Admin Panel, Please Login to proceed</h1>
  <div class="errormessage"><?=$this->session->flashdata('login_error');?></div>
  <div id="login_inner">
      <div class="frmLogin">
      <div id="login_error"><?=$this->session->flashdata('message');?></div>
      <form method="post" action="<?=ADMIN_BASE_URL?>login">
      	
          	<?=form_error('txtUserName')?> 
            <?=form_error('txtPassword')?>
        <div>
          <label>User Name:</label>
        	<p> 
              <input type="text" name="txtUserName" id="txtUserName" value="" class="txtBox" />
            </p>
    	</div>
        <div>
          <label>Password:</label>
          <input type="password" name="txtPassword" id="txtPassword" value="" class="txtBox" />
        </div>
       
        <div>
        	<label>&nbsp;</label>
          <input type="submit" name="btnLogin" id="btnLogin" value="Login" class="btnAdd" />
        </div>
      </form>
    </div>
    <div class="clear"></div>
  </div>
</div>
