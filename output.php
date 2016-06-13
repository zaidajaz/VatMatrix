<?php 
require_once('pathconfig.php'); 
require_once(COMMON.'headder.php');	
?>
<div id="content">
<h1 style="margin-left:100px; margin-top:20px;font:small-caption; font-size:25px;">Select a period to display records for</h1>
<div class="date_selects">
	<form class="output_form" method="post" action="">
		<input type="text" style="margin-left:100px;" size="12" autocomplete="off" id="inputField" name="inputField" value="<?php if(isset($_POST['inputField'])){echo $_POST['inputField'];} ?>"/>&nbsp;&nbsp;TO
		<input type="text" size="12" id="inputField2" autocomplete="off" name="inputField2" value="<?php if(isset($_POST['inputField2'])){echo $_POST['inputField2'];} ?>" onfocus="javascript:cal();" />
		<input type="submit" class="btn" value="Show">
 	</form>
 
 <label class="error_lbl"><?php if(isset($error)){echo $error;} ?></label>
</div>
<?php if($_SERVER['REQUEST_METHOD']=='POST' && !empty($_POST['inputField']) && !empty($_POST['inputField2']) && $_POST['inputField2'] >= $_POST['inputField']){?>
<table border="1" cellspacing="0" cellpadding="0" class="admin-table">
<tr><th>S.no</th><th>Name</th><th>Adress</th><th>Tin no</th><th>Bill no.</th><th>Date</th>
<?php } ?>
    <?php require_once(INCLUDES.'retreive_output.php');?>
    <tr>
    <?php 
	if($_SERVER['REQUEST_METHOD']=="POST" && !empty($_POST['inputField']) && !empty($_POST['inputField2']) && $datef >= $datei){?>
    <th></th><th style="border-left:none;"><label style="margin-left:2px; letter-spacing:15px; position:relative;">Grand</label></th><th><label style="letter-spacing:15px;" >Total</label></th><th></th><th></th><th></th>
    <?php }else{$error='Please Enter Dates Carefully!';} ?>
	<?php 
	/*echo $grandtotals['9'];
	if(isset($tablenum)){
		for($gen=0;$gen < $tablenum;$gen++){
			echo "<th></th>";
		}
	}*/
	error_reporting(0);
	foreach($amtat as $s){
		echo "<th>".$grandtotals[$s]."</th>";
	}	
	?>
    
    <th><?php if(isset($grandtotaloutput['Total'])){echo $grandtotaloutput['Total'];} ?></th><th><?php if(isset($grandtotaloutput['Output'])){echo $grandtotaloutput['Output'];} ?></th>
    </tr>
</table>
</div>
<label class="error_lbl" style="color:red; letter-spacing:5px; margin-left:30px; font:small-caption; font-size:20px;"><?php if(isset($error)){echo $error;} ?></label>
<?php 
require_once(COMMON.'footer.php'); 
?>
