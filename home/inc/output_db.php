<?php
global $j;
global $a;
global $tablenum;
global $grandtotaloutput;
$grandtotaloutput=array('Total'=>0,'Output'=>0);
$a=1;
$j=0;
$tablenum=0;
	if(mysql_connect(HOST,USER,PASSWORD)){
		if(mysql_select_db(DB)){
			$query="SELECT * FROM bill_owner where date between '$datei' and '$datef'";
			if($result=mysql_query($query)){
				if(mysql_num_rows($result)>0){
					while($row=mysql_fetch_assoc($result)){
						$sno=$row['sr_no'];
						$sql="SELECT sum(amt) as Amount, vatp as VAT FROM bills where sno =".$sno." group by vatp;";
						if($sql=mysql_query($sql)){
							if(mysql_num_rows($sql)>0){
								
								while($res=mysql_fetch_assoc($sql)){
									error_reporting(0);
									foreach($amtat as $z){
										if($res['VAT']==$z){
											$a=0;
											break;
										}
										else{
											$a=1;
										}
									}
									if($a!=0){
										
											
											$amtat[$j]=$res['VAT'];
											$tablenum++;
											$arraysize++;
											
										$j++;
									}
								}
								
							}

						}
						else{
							die('OOPS! Something went wrong');
						}

					}
					include(INCLUDES.'sort.php');
					echo "<th>Total</th><th>Output VAT</th></tr>";
				}
				else{
					$error='No records exist for the entered period';
				}
			}
			else{
				die('OOPS! Something went wrong');
			}
		}
		else{
			die('OOPS! Something went wrong');
		}
	}
	else{
		die('OOPS! Something went wrong');
	}
	
	mysql_close();
	
	
	
	
	if(mysql_connect(HOST,USER,PASSWORD)){
		if(mysql_select_db(DB)){
			$query="SELECT * FROM bill_owner where date between '$datei' and '$datef'";
			if($result=mysql_query($query)){
				if(mysql_num_rows($result)>0){
					$i=1;
					while($row=mysql_fetch_assoc($result)){
						echo"<tr>";
						echo "<td>".$i."</td>";
						echo "<td>".$row['name']."</td>";
						echo "<td>".$row['adress']."</td>";
						echo "<td>".$row['tin_no']."</td>";
						echo "<td>".$row['bill_no']."</td>";
						$db_date = preg_split("/[-]+/" ,$row['date']);
						$swapvar=$db_date[0];
						$db_date[0]=$db_date[2];
						$db_date[2]=$swapvar;
						$db_date[1]="-".$db_date[1]."-";
						echo "<td>";
						foreach($db_date as $right){
							echo $right;
						}
						echo "</td>";
						
						foreach($amtat as $k){
							$get="select Amount from (SELECT sum(amt) as Amount, vatp as VAT FROM bills where sno =".$row['sr_no']." group by vatp) tbl where VAT='$k'";
							$get= mysql_query($get) or die('Something went wrong');
							if(mysql_num_rows($get)>0){
								while($got=mysql_fetch_assoc($get)) {
									echo"<td>".$got['Amount']."</td>";
									$grandtotals[$k]=$grandtotals[(int)$k] + $got['Amount'];
								}
							}
							else
							{
								echo "<td></td>";
							}
						}
						require(INCLUDES.'getvalues.php');
						echo "</tr>";
						$i++;
					}

				}
				else{
					$error='No records exist for the entered period';
				}
			}
			else{
				die('OOPS! Something went wrong');
			}
		}
		else{
			die('OOPS! Something went wrong');
		}
	}
	else{
		die('OOPS! Something went wrong');
	}
	
	
	
?>