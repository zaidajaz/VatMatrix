<?php

	$quer="SELECT amt,vatamt FROM `bills` WHERE `sno`='".$row['sr_no']."';"; 
	$gamt=0;
	$gvatamt=0;
				if($resul=mysql_query($quer)){
					if(mysql_num_rows($resul)>0){
						while($row=mysql_fetch_assoc($resul)){
						
							$gamt=$gamt+(float)$row['amt'];
							$gvatamt=$gvatamt+(float)$row['vatamt'];
						}
						echo"<td>".$gamt."</td>";
						echo "<td>".$gvatamt."</td>";
						
						$grandtotaloutput['Total']=$grandtotaloutput['Total']+$gamt;
						$grandtotaloutput['Output']=$grandtotaloutput['Output']+$gvatamt;
					}
				}
?>
