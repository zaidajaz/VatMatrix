<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" href="templates/css/style.css">
<?php 
if(!isset($_SESSON)){
session_start(); 
}
?>
<link rel="stylesheet" href="home/style/layout.css">
<link rel="stylesheet" href="home/style/index.css">
<title>Print View</title>
</head>
<body>
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
	<div id="content">
		<div class="headder">
			<label class="logo">New Super Time Court Road Lal Chowk Srinagar</label><br/>
            <label class="nst_tin">Tin no: 01382010881</label>
		</div>
        <div class="main">
        <a href="index.php">...Home</a>
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
					 ?></font>
                     <br/>
                     <label style="margin-left:500px;">Bill no: </label><font size="5"><?php if(isset($db_billno)){echo $db_billno;} ?> &nbsp;&nbsp; <?php echo 'Date: ';if(isset($db_date)){echo $db_date;}
					 ?></font><br/>
                	Name: <font size="5"><?php if(isset($db_name)){echo $db_name;} ?></font><br>
                    Address: <font size="5"><?php if(isset($db_address)){echo $db_address;} ?></font><br/>
                    <?php if(isset($db_tin)&& !empty($db_tin) ){echo "Tin: <font size='5'>".$db_tin;} ?></font>
                </div>
                <!--TABLE-->
                <div class="item_details">
    <table border="1" cellspacing="0" cellpadding="8" style="margin-top:0px;margin-bottom:10px;float:right; margin-right:50px;">
                	<?php
	$query="SELECT * FROM `bills` WHERE `sno`='".$_SESSION['NSTEBS']['bill_no']."';"; 
	$gamt=0;
	$gtotal=0;
	$gvatamt=0;
	$rows=0;
	 	if(mysql_connect(HOST,USER,PASSWORD)){
			if(mysql_select_db(DB)){
				if($result=mysql_query($query)){
					if(mysql_num_rows($result)>0){
						echo "<tr><th>Particulars</th><th>Quantity</th><th>Rate</th><th>Amount</th><th>Vat(%)</th><th>Vat Amount</th><th>Total</th><th>Comments</th></tr>";
						while($row=mysql_fetch_assoc($result)){
							echo"<tr>";
							echo "<td>".$row['item']."</td>";
							echo "<td>".$row['qty']."</td>";
							echo "<td>".$row['rate']."</td>";
							echo "<td>".$row['amt']."</td>";
							echo "<td>".$row['vatp']."</td>";
							echo "<td>".$row['vatamt']."</td>";
							echo "<td>".$row['total']."</td>";
							echo "<td>".$row['Comments']."</td>";
							echo"</tr>";
							
							$rows=$rows+1;
							$gamt=$gamt+(float)$row['amt'];
							$gtotal=$gtotal+(float)$row['total'];
							$gvatamt=$gvatamt+(float)$row['vatamt'];
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
			echo"<tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
			$rows=$rows+1;
		}
	
	?>
	<tr style="margin-top:200px;"><th>Grand Total</th><th></th><th></th><th><?php echo $gamt; ?></th><th></th><th><?php echo $gvatamt; ?></th><th><?php echo $gtotal; ?></th></tr>
    <?php } ?>
<table border="1" cellspacing="0" cellpadding="8" style="margin:auto; margin-top:25px;margin-bottom:10px;">

                </div>
                <?php 
 		if(isset($_SESSION['NSTEBS']['bill_no'])){
			echo "<table border='0' style='float:left; margin-top:100px; margin-left:50px;' cellspacing='7'>";
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
                <label style="float:right; margin-top:20px; margin-right:250px;">Signature</label>
            <?php
				}
				else{
			?>
          <div class="view_bill_form">
        	<form action="" method="post">
        		<label class="view_bill_lbl">Enter Bill no</label><br /><input type="text" required class="view_bill_field" name="bill_no"/><br />
        		<input type="submit" value="Print" class="view_bill_btn"/>
        	</form>
        </div>
            <?php
				}
			?>
        </div>
    </div>
    <?php require_once(COMMON.'footer.php'); ?>
</body>
</html>