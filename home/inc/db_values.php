<?php
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
							$db_bill=$line['bill_no'];			
						}
					}
				}
			}
}			
?>