<?php
$srl=$_SESSION['NSTEBS']['bill_no'];
//$check="SELECT * FROM `bill_owner` WHERE `bill_no`='$srl'";
$date=date("Y-m-d");
$query="INSERT INTO `bill_owner`(`bill_no`, `name`, `adress`, `tin_no`,`form_vat`,`date`,`sr_no`) VALUES ('$bill','$name','$adress','$tin','$formvat','$date','$srl')";
if(mysql_connect(HOST,USER,PASSWORD)){
			if(mysql_select_db(DB)){
				
						if(mysql_query($query)){
							$error='Bill Details updated Successfully!';
						}
						else{
							$error='Record Already Exists / Connection problem';
						}
			}
				else{
					$error='Could not connect to DB';
				}			
}
else{
	$error='Could not connect to host';
}
				
?>