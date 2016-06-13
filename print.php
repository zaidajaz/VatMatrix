
<?php error_reporting(0); require_once('pathconfig.php'); ?>
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

<title>Print bill</title>
</head>
<body onLoad="javascript:document.print();">
 <div id="header-inside-buttons">
        

        <a href="clear.php">Clear Session</a>&nbsp;&nbsp;  
       
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
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['bill_no'])){
			if(preg_match('%^[0-9]{1,9}$%',$_POST['bill_no'])){
				$bill_no=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['bill_no']))));
				$_SESSION['NSTEBS']['bill_no']=$bill_no;
			}
			else{
			?>
            	<script type="text/javascript">document.location='print.php'</script>
			<?php
			}
		}
	}
?>
   
   
   
   <?php
			require_once('pathconfig.php');
				if(isset($_SESSION['NSTEBS']['bill_no'])){
					$query="SELECT * FROM `bill_owner` WHERE `sr_no`='".$_SESSION['NSTEBS']['bill_no']."';";
if(mysql_connect(HOST,USER,PASSWORD)){
			if(mysql_select_db(DB)){
				if($res=mysql_query($query)){
					if(mysql_num_rows($res)>0){
						while($line=mysql_fetch_assoc($res)){
							$db_name=$line['name'];	
							$db_address=$line['adress'];
							$db_tin=$line['tin_no'];
							$db_formvat=$line['form_vat'];
							$db_date=$line['date'];
							$db_billno=$line['bill_no'];			
						}
					}
				}
			}
}
			?>
            	<div class="print_details">
               <span class="company_print_details" contenteditable="true"><u> <?php require_once(INCLUDES.'getdetails.php'); echo $com_name.", ".$com_adr." (Tin - ".$com_tin.")";?></u></span><br>
                	 <font size="6">
					 <?php
					  	if(isset($db_formvat)){
							if($db_formvat=='Form Vat 50'){
								echo $db_formvat;
								echo "<font size='4'> (Valid For Input Tax Credit)</font>";
							}
							else{
								echo $db_formvat;
							}
						} 
						$db_date = preg_split("/[-]+/" ,$db_date);
						$swapvar=$db_date[0];
						$db_date[0]=$db_date[2];
						$db_date[2]=$swapvar;
						$db_date[1]="-".$db_date[1]."-";
					 ?></font>
                     <br/>
                     <label style="margin-left:420px;">Bill no: </label><font size="5"><?php if(isset($db_billno)){echo $db_billno;} ?></font><br> &nbsp;&nbsp;<label style="float:right;"> <?php echo 'Date: ';if(isset($db_date)){foreach($db_date as $rightformat){echo $rightformat;}}
					 ?></label><br/>
                	Name: <font size="5"><?php if(isset($db_name)){echo $db_name;} ?></font><br>
                    Address: <font size="5"><?php if(isset($db_address)){echo $db_address;} ?></font><br/>
                    <?php if(isset($db_tin)&& !empty($db_tin) ){echo "Tin: <font size='5'>".$db_tin;} ?></font>
                </div>
                <!--TABLE-->
                <div class="item_details">
    <table border="1" cellspacing="0" cellpadding="8"  class="admin-table">
                	<?php
	$query="SELECT * FROM `bills` WHERE `sno`='".$_SESSION['NSTEBS']['bill_no']."';"; 
	$chk=$_SESSION['NSTEBS']['bill_no'];
	$gamt=0;
	$gtotal=0;
	$gvatamt=0;
	$gdiscount=0;
	$gextra=0;
	$rows=0;
	 	if(mysql_connect(HOST,USER,PASSWORD)){
			if(mysql_select_db(DB)){
				require_once(INCLUDES.'checkdiscount.php');
				if($result=mysql_query($query)){
					if(mysql_num_rows($result)>0){
						echo "<tr>";
						echo "<th>Particulars</th>";
						if($ch_qty==true){
							echo "<th>Quantity</th>";
						}
						if($ch_rate==true){
							echo "<th>Rate</th>";
						}
						echo "<th>Amount</th><th>Vat(%)</th><th>Vat Amount</th>";
						?>
						<?php if($extch==true){?><th>Extra Charges</th><?php }?>
    <?php if($disc==true){?><th>Discount</th><?php } ?>
						<?php
						echo "<th>Total</th>";
						?>
						<?php if($com==true){?><th>Comments</th><?php } ?>
						<?php
						echo "</tr>";
						while($row=mysql_fetch_assoc($result)){
							echo"<tr>";
							echo "<td>".$row['item']."</td>";
							if($ch_qty==true){
								if($row['qty']!=0){
									echo "<td>".$row['qty']."</td>";
								}
								else{
									echo"<td></td>";
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
							
							$rows=$rows+1;
							$gamt=$gamt+(float)$row['amt'];
							$gtotal=$gtotal+(float)$row['total'];
							$gvatamt=$gvatamt+(float)$row['vatamt'];
							$gextra=$gextra+(float)$row['extracharges'];
							$gdiscount=$gdiscount+(float)$row['discount'];
						}
					}
					else{
						die('No record exist for the specified bill no');
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
<?php if(isset($gamt,$gtotal,$gvatamt)){
		while($rows<=10){
			echo"<tr style='height:20px;'><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
			$rows=$rows+1;
		}
	
	?>
	<tr><th>Grand Total</th><?php if($ch_qty==true){ ?><th></th><?php } if($ch_rate==true){?><th></th><?php }?><th><?php echo $gamt; ?></th><th></th><th><?php echo $gvatamt; ?><?php if($extch==true){?><th><?php echo $gextra; ?></th><?php } if($disc==true){?><th><?php echo $gdiscount; ?></th><?php } ?><th><?php echo $gtotal; ?></th> <?php if($com==true){?><th></th><?php } ?></tr>
    <?php } ?>

                </div>
                <?php 
 		if(isset($_SESSION['NSTEBS']['bill_no'])){
			echo "<table border='0' style='margin-left:2px;' cellspacing='7'>";
			$sql="SELECT sum(amt) as Amount, vatp as VAT FROM bills where sno =".$_SESSION['NSTEBS']['bill_no']. " group by vatp;";
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
                <!--TABLE-->
                <label style="float:right; font:small-caption; font-size:18px; margin-top:10px;">Signature</label>
            <?php
				}
				else{
			?>
   
   
   
    
    
    	<div class="view_bill_form">
        	<form action="" method="post">
            <label class="page-caption">Print Bill by Reference no.</label><br>
        		<label class="view_bill_lbl">Enter Reference no</label><br /><input type="text" required class="view_bill_field" name="bill_no"/><br />
        		<input type="submit" value="Print" class="btn"/>
        	</form>
        </div>
    <?php } ?>
    </div>
</div>
 </body>
<?php require_once(COMMON.'footer.php'); ?>