 <?php
	require_once('pathconfig.php');
	require_once(COMMON.'headder.php');
?>
<div id="content">
<table border="1" cellspacing="0" cellpadding="8" class="admin-table">

	<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['bill_no'])){
			if(preg_match('%^[0-9]{1,9}$%',$_POST['bill_no'])){
				$bill_no=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['bill_no']))));
				$_SESSION['NSTEBS']['bill_no']=$bill_no;
			}
			else{
				?>
                <script type="text/javascript">document.location='view.php';</script>
                <?php
			}
		}
			if(isset($_POST['bill_name'],$_POST['bill_address'],$_POST['bill_tin'])){
			if(preg_match('%^[A-Za-z0-9. -_]{3,30}$%',$_POST['bill_name'])){
				if(preg_match('%^[A-Za-z0-9. -_]{3,50}$%',$_POST['bill_address'])){
					if(preg_match('%^[0-9NA]{0,30}$%',$_POST['bill_tin'])){
						if(preg_match('%^[A-Za-z0-9 ]{0,30}$%',$_POST['formvat'])){
							if(preg_match('%^[0-9]{1,30}$%',$_POST['bill_billno'])){
								$name=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['bill_name']))));
								$adress=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['bill_address']))));
								$tin=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['bill_tin']))));
								$formvat=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['formvat']))));
								$bill=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['bill_billno']))));
								require_once(INCLUDES.'db_ins.php');
							}
							else
							{
								$error='Invalid Bill no.';
							}
						}
						else{
							$error='Invalid Values Entered';
						}
					}
					else{
						$error = 'Invalid Tin no.';
					}
				}
				else{
					$error ='Invalid Characters in Adress';
				}
			}
			else{
				$error ='Invalid Characters in Name';
			}
		}
	}
	if(isset($_SESSION['NSTEBS']['bill_no'])){
		$bill_no=$_SESSION['NSTEBS']['bill_no'];
	 	require_once(INCLUDES.'db.php');
	}
	else{
		?>
        <div class="view_bill_form">
        	<form action="" method="post">
            <label class="page-caption">View bill by Reference no.</label><br />
        		<label class="view_bill_lbl">Enter Reference no.</label><br /><input type="text" required="required" class="view_bill_field" name="bill_no"/><br />
        		<input type="submit" value="Show" class="btn"/>
        	</form>
        </div>
     <?php
	}
	?>
	<?php if(isset($gvatamt,$gtotal,$gamt)){?>
    <tr><th>Grand Total</th><?php if($ch_qty==true){ ?><th></th><?php } ?><?php if($ch_rate==true){ ?><th></th><?php } ?><th><?php echo $gamt; ?></th><th></th><th><?php echo $gvatamt; ?></th><?php if($extch==true){?><th><?php echo $gextra; ?></th><?php } if($disc==true){?><th><?php echo $gdiscount; ?></th><?php } ?><th><?php echo $gtotal; ?></th> <?php if($com==true){?><th></th><?php } ?>
   <?php } ?>
   </tr>
 </table>
 	<?php 
 		if(isset($_SESSION['NSTEBS']['bill_no'])){
			echo "<table border='0' style='margin-left:390px;' cellspacing='7'>";
			$bill_no=$_SESSION['NSTEBS']['bill_no'];
			$sql="SELECT sum(amt) as Amount, vatp as VAT FROM bills where sno =".$bill_no. " group by vatp;";
			if($result=mysql_query($sql)){
				if(mysql_num_rows($result)>0){
					while($row=mysql_fetch_assoc($result)){
						echo"<tr><td style='font:small-caption; font-size:18px; letter-spacing:2px;'>Amount @ " .$row['VAT'] ."% </td><td>= &nbsp;&nbsp;".$row['Amount'] ."</tr></td>";
					}
					echo "<tr><td style='font:small-caption; font-size:18px; letter-spacing:2px;'>Total Vat Amount</td><td>=&nbsp;&nbsp;$gvatamt</td></tr><tr><td style='font:small-caption; font-size:18px; letter-spacing:2px;'>Grand Total</td><td>=&nbsp;&nbsp;$gtotal</td></tr></table>";
				}
			}
			else{
				die('OOPS! Something went wrong');
			}
		}
 	?>
</div>
<?php
	require_once(COMMON.'footer.php');
?>