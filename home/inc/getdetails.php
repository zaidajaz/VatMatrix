<?php
global $com_name;
require_once('pathconfig.php');
if(mysql_connect(HOST,USER,PASSWORD)){
	if(mysql_select_db(DB)){
		$query="SELECT * FROM `company_details`";
		if($result=mysql_query($query)){
			if(mysql_num_rows($result)>0){
				while($row=mysql_fetch_assoc($result)){
					$com_name=$row['Name'];
					$com_adr=$row['Adress'];
					$com_tin=$row['Tin'];
					$com_pan=$row['Pan'];
				}
			}
		}
	}
}

?>