<?php
$srl=$_SESSION['NSTEBS']['bill_no'];
$date=date("Y-m-d");
 $query="UPDATE `bill_owner` SET `bill_no`='$bill',`name`='$name',`adress`='$adress',`tin_no`='$tin',`form_vat`='$formvat',`date`='$date',`sr_no`='$srl' WHERE `sr_no`=$srl;";
if(mysql_connect(HOST,USER,PASSWORD)){
			if(mysql_select_db(DB)){
				
						if(mysql_query($query)){
							$error1='Bill Details updated Successfully!';
						}
						else{
							$error1='Record does not Exist / Connection problem';
						}
			}
				else{
					$error1='Could not connect to DB';
				}			
}
else{
	$error1='Could not connect to host';
}
				
?>