<?php
global $com;global $extch;global $disc;global $ch_qty;global $ch_rate;
$com=$extch=$disc=$ch_qty=$ch_rate=$ch_item=false;
	$chdis_query="SELECT `item` ,`qty`,`rate`,`Comments`,`extracharges`,`discount` FROM `bills` WHERE `sno`='$chk';";
	if($chdis_query=mysql_query($chdis_query)){
		if(mysql_num_rows($chdis_query)>0){
			while($chdis_res=mysql_fetch_assoc($chdis_query)){
				if($chdis_res['Comments']!='N/A'){
					$com=true;
				}
				if($chdis_res['extracharges']!=0){
					$extch=true;
				}
				if($chdis_res['discount']!=0){
					$disc=true;
				}
				if($chdis_res['rate']!=0){
					$ch_rate=true;
				}
				if($chdis_res['qty']!=0){
					$ch_qty=true;
				}

			}
		}
	}
?>