
<?php
	$index=1;
	$bill_no=$_SESSION['NSTEBS']['bill_no'];
	$query="SELECT * FROM `bills` WHERE `sno`='$bill_no';"; 
	$chk=$bill_no;
	 	if(mysql_connect(HOST,USER,PASSWORD)){
			if(mysql_select_db(DB)){
				if($result=mysql_query($query)){
					if(mysql_num_rows($result)>0){ ?>
                    <label class="page-caption">Edit Bill Description</label>
                    <table border="1" cellspacing="0" cellpadding="8" class="admin-table">
						<tr><th>Item</th><th>Quantity</th><th>Rate</th><th>Amount</th><th>Vat(%)</th><th>Vat Amount</th><th>Extra Charges</th>
    <th>Discount</th><th>Total<th>Comments</th><th>Calculate And Save</th></tr>
                        <?php
						while($row=mysql_fetch_assoc($result)){
							echo"<tr>";
							
							if($row['qty']!=0 && $row['rate']!=0){
								echo "<td id='item".$index."' contenteditable='true'>".$row['item']."</td>";
								echo "<td id='qty".$index."' contenteditable='true'>".$row['qty']."</td>";
								echo "<td id='rate".$index."' contenteditable='true'>".$row['rate']."</td>";
							}
							else{
								echo "<td id='item".$index."' contenteditable='false'>".$row['item']."</td>";
								echo "<td id='qty".$index."' contenteditable='false'></td>";
								echo "<td id='rate".$index."' contenteditable='false'></td>";
							}
							echo "<td id='amt".$index."' contenteditable='true'>".$row['amt']."</td>";
							echo "<td id='vatp".$index."' contenteditable='true'>".$row['vatp']."</td>";
							echo "<td id='vatamt".$index."' contenteditable='true'>".$row['vatamt']."</td>";
							echo "<td id='extracharges".$index."' contenteditable='true'>".$row['extracharges']."</td>";
							echo "<td id='discount".$index."' contenteditable='true'>".$row['discount']."</td>";
							echo "<td id='total".$index."' contenteditable='true'>".$row['total']."</td>";
							echo "<td id='comments".$index."' contenteditable='true'>".$row['Comments']."</td>";
							echo "<td><input id='".$index."' type='button' class='btn' value='Calculate' onclick='javascript:table_calculate(this.id);table_save(this.id);'></td>";
							echo "<input type='hidden' id='NSTEBS".$index."' value='".$row['primary_ref']."'>";
							echo"</tr>";
							$index++;
						}
					}
					else{
						die('No records exits for specified reference');
					}
				}
				else{
					die('OOPS! something went wrong');
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

</table>