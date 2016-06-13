<?php 
	require_once('pathconfig.php');
	require_once(COMMON.'headder.php');
	require_once(INCLUDES.'ch_settings.php');
	require_once(INCLUDES.'ch_password.php');
?>
<div id="content">
	<label style="float:right; color:red;"><?php if(isset($error)){echo $error;} ?></label>
  <form method="post" action="" autocomplete="off">  
    <div class="container">
    <label class="page-caption"><u>Enter Company Details</u></label><br>
			<div class="labels">
            	<label class="caption">Name</label><br>
				<label class="caption">Address</label><br>
				<label class="caption">Tin No.</label><br>
				<label class="caption">Pan no.</label><br>
                <label class="caption">Password</label>
			</div>
			<div class="inputs">
            	<input type="text" required name="cmp_name" class="new_input" value="<?php if(isset($_POST['cmp_name'])){echo $_POST['cmp_name'];} ?>"><br>
				<input type="text" required name="cmp_adress" class="new_input" value="<?php if(isset($_POST['cmp_adress'])){echo $_POST['cmp_adress'];} ?>"/><br>
				<input type="text" name="cmp_tin" class="new_input" required="required" value="<?php if(isset($_POST['cmp_tin'])){echo $_POST['cmp_tin'];} ?>"><br>
				<input type="text" name="cmp_pan" class="new_input" required="required" value="<?php if(isset($_POST['cmp_pan'])){echo $_POST['cmp_pan'];} ?>"><br>
                <input type="password" name="cmp_pass" required="required" maxlength="16">
			</div>
		</div>
        <div class="buttons">
			<input type="submit" class="btn" style="margin-left:350px;" value="Save">
          </div>
    </form> <br/>
<label class="change_pass_settings"><u>Change Your Password</u></label>
<form method="post" action="" autocomplete="off">  
    <div class="container">
			<div class="labels">
            	<label class="caption">Old Password</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="old_pass" required="required" maxlength="16"><br>
				<label class="caption">New Password</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="password" name="new_pass" required="required" maxlength="16"><br>
				<label class="caption">Repeat Password</label>&nbsp;&nbsp;&nbsp;<input type="password" name="rep_pass" required="required" maxlength="16">
                <input type="submit" class="btn" value="Change">
			</div>
		</div>

    </form> <br/>
</div>
<?php require_once(COMMON.'footer.php'); ?>