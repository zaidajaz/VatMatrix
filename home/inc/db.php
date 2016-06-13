 <?php
 	if(isset($_POST['move'])){
		if($_POST['move']=='forward'){
			if($_SESSION['NSTEBS']['bill_no']>1){
				$_SESSION['NSTEBS']['bill_no']-=1;
				?><script type="text/javascript">document.location='view.php'</script><?php
			}
		}
		else{
				$_SESSION['NSTEBS']['bill_no']+=1;
				?><script type="text/javascript">document.location='view.php'</script><?php
		}
	}
 ?>
<?php
	$query="SELECT * FROM `bills` WHERE `sno`='$bill_no';"; 
	$chk=$bill_no;
	$gamt=0;
	$gtotal=0;
	$gvatamt=0;
	$gdiscount=0;
	$gextra=0;
	 	if(mysql_connect(HOST,USER,PASSWORD)){
			if(mysql_select_db(DB)){
				require_once(INCLUDES.'checkdiscount.php');
				if($result=mysql_query($query)){
					if(mysql_num_rows($result)>0){
						?>

                        <label class="sno">Reference: <?php if(isset($_SESSION['NSTEBS']['bill_no'])){echo $_SESSION['NSTEBS']['bill_no'];} ?></label>
                        <form action="" method="post" name="navigate">
                        	<input type="submit" value="<<" class="nav_btn" onClick="document.forms.navigate.move.value='forward'"/>
                            <input type="submit" value=">>" class="nav_btn" onClick="document.forms.navigate.move.value='back'"/>
                            <input type="hidden" value="" name="move"/>
                        </form>
     <form action="" method="post" name="bill_details" onsubmit="document.bill_details.formvat.disabled=false;">
    <div class="bill_details_form">
    	<?php require_once(INCLUDES.'db_values.php'); ?>
        <input type="text"  style="margin-left:130px; margin-top:5px; border:none; background:none; text-align:center; margin-bottom:5px;" value="<?php if(isset($db_formvat)){echo $db_formvat;}; ?>" disabled="disabled" name="formvat" /><br />
        <label class="bill_name">Name</label><input type="text" name="bill_name" class="billname_f" value="<?php if(isset($db_name)){echo $db_name;} ?>"/>
        <label class="bill_address">Adress</label><input type="text" name="bill_address" class="billaddress_f" value="<?php if(isset($db_address)){echo $db_address;} ?>"/><br />
        <label class="bill_tin">Tin no.</label><input type="text" name="bill_tin" class="billtin_f" value="<?php if(isset($db_tin)){echo $db_tin;} ?>"/>
        <label class="bill_billno">Bill No.</label><input type="text" name="bill_billno" class="billno_f" value="<?php if(isset($db_bill)){echo $db_bill;} ?>"/>
       <br /> <input type="submit" class="btn_confirm" value="Confirm Details" onclick="if(document.forms.bill_details.bill_tin.value==''){document.forms.bill_details.formvat.value='Form Vat 51';}else{document.forms.bill_details.formvat.value='Form Vat 50';}"/>
        <input type="button" value="Print view" class="btn_print" onclick="document.location='print.php'"/>
        <br/>
        <label class="error_lbl1"><?php if(isset($error)){echo $error;}?></label>
     </div>
    </form>
    <tr><th>Particulars</th><?php if($ch_qty==true){ ?><th>Quantity</th><?php } ?><?php if($ch_rate==true){ ?><th>Rate</th><?php } ?><th>Amount</th><th>Vat(%)</th><th>Vat Amount</th><?php if($extch==true){?><th>Extra Charges</th><?php }?>
    <?php if($disc==true){?><th>Discount</th><?php } ?><th>Total</th><?php if($com==true){?><th>Comments</th><?php } ?></tr>
                        <?php
						while($row=mysql_fetch_assoc($result)){
							echo"<tr>";
							echo "<td>".$row['item']."</td>";
							if($ch_qty==true){
								if($row['qty']!=0){
									echo "<td>".$row['qty']."</td>";
								}
								else{
									echo "<td></td>";
								}
							}
							if($ch_rate==true){
								if($row['rate']!=0){
									echo "<td>".$row['rate']."</td>";
								}
								else{
									echo "<td></td>";
								}
							}
							echo "<td>".$row['amt']."</td>";
							echo "<td>".$row['vatp']."</td>";
							echo "<td>".$row['vatamt']."</td>";
							
							if($extch==true){
								echo "<td>".$row['extracharges']."</td>";
							}
							
							if($disc==true){
								echo "<td>".$row['discount']."</td>";
							}
							
							echo "<td>".$row['total']."</td>";
							if($com==true){
								echo "<td>".$row['Comments']."</td>";
							}
							echo"</tr>";
							
							$gamt=$gamt+(float)$row['amt'];
							$gtotal=$gtotal+(float)$row['total'];
							$gvatamt=$gvatamt+(float)$row['vatamt'];
							$gextra=$gextra+(float)$row['extracharges'];
							$gdiscount=$gdiscount+(float)$row['discount'];
						}
					}
					else{
						?>
                        <?php
							if($_SERVER['REQUEST_METHOD']=="POST"){
								$_SESSION['NSTEBS']['bill_no']-=1;
								?><script type="text/javascript">document.location='view.php'</script><?php
							}
						?>
                        <form name="navigate_ex" action="" method="post">
                        	<input type="submit" value="Back" class="btn"/>
						</form>
						<?php
						die('NO records exist for specified Reference no');
					}
				}
				else{
					die('Error!');
				}
			}
			else{
				die('Could not connect to DB');
			}
		}
		else{
			die('Could not connect to host');
		}
?>
