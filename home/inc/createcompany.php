<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="templates/css/style.css">
<link rel="stylesheet" href="templates/css/layout.css">

<?php 
if(!isset($_SESSON)){
session_start(); 
}
?>

<title>Create Company</title>
</head>
<body>
 <div id="header-inside-buttons">
        

        <a href="clear.php">Select Company</a>&nbsp;&nbsp;  
       
    </div>    
    <div id="header">
        <div id="header-inside">
            <div id="logo">
                <img src="templates/img/tcms2.png" alt="" />
            </div>
            <ul id="sub-menu">
                <li><a href="index.php" class="sub-current">Home</a>&nbsp;</li><a href="#" onclick="window.print()" class="sub-current">Print</a></li></ul>
        </div>
    </div>      
	<div id="content">
    <?php 
		require_once(INCLUDES.'createcompany_db.php');
	?>
    	<u><label style="letter-spacing:3px;">Create New Company</label></u><br>
        <center><h1 style="letter-spacing:10px;">Enter Company Details</h1></center>
        <form action="" method="post">
        <label style="float:right;color:red;"><?php if(isset($error)){echo $error;} ?></label>
        	<div class="container">
			<div class="labels">
            	<label class="caption">Name</label><br>
				<label class="caption">Address</label><br>
				<label class="caption">Tin no.</label><br>
				<label class="caption">Pan no.</label>
            </div>
			<div class="inputs" style="margin-top:25px;">
            	<input type="text" name="comp_name" required="required" class="new_input" value="<?php if(isset($_POST['comp_name'])){echo $_POST['comp_name'];} ?>"><br>
				<input type="text" required="required" name="comp_addr" class="new_input" value="<?php if(isset($_POST['comp_addr'])){echo $_POST['comp_addr'];} ?>"/><br>
				<input type="text" name="comp_tin" class="new_input" required="required" value="<?php if(isset($_POST['comp_tin'])){echo $_POST['comp_tin'];} ?>"><br>
				<input type="text" name="comp_pan" class="new_input" required="required" value="<?php if(isset($_POST['comp_pan'])){echo $_POST['comp_pan'];} ?>">
			</div>
		</div>
        <div class="buttons">
			<input type="submit" style="margin-left:350px;" class="new_add" value="Create">
          </div>
        </form>
    </div>
</div>
 </body>
<?php require_once(COMMON.'footer.php'); ?>