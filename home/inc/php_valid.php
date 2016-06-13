
<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(preg_match('%^[0-9]{1,30}$%',$_POST['bill_no'])){
			if(preg_match('%^[0-9]{1,30}$%',$_POST['new_qty'])){
				if(preg_match('%^[0-9.]{1,30}$%',$_POST['new_rate'])){
					if(preg_match('%^[0-9.]{1,30}$%',$_POST['new_vatp'])){
						if(preg_match('%^[0-9.-]{1,30}$%',$_POST['new_total'])){
							if(preg_match('%^[0-9.]{1,30}$%',$_POST['new_amt'])){
								if(preg_match('%^[0-9.]{1,30}$%',$_POST['new_vatamt'])){
									if(preg_match('%^[0-9.]{0,30}$%',$_POST['new_discount'])){
										if(preg_match('%^[0-9.]{0,30}$%',$_POST['new_extra'])){
											if(preg_match('%^[A-Za-z0-9 /.*\+_-]{0,30}$%',$_POST['new_select'])){
									
									require_once(INCLUDES.'escape.tpl');
									
									$extra=escape_data($_POST['new_extra']);
									$discount=escape_data($_POST['new_discount']);	
									
									if($extra==''){
										$extra=0;
									}
									if($discount==''){
										$discount=0;
									}
																	
									$item=escape_data($_POST['new_select']);
									$sr_no=escape_data($_POST['bill_no']);
									$qty=escape_data($_POST['new_qty']);
									$rate=escape_data($_POST['new_rate']);
									$vatp=escape_data($_POST['new_vatp']);
									$vatamt=escape_data($_POST['new_vatamt']);
									$amt=escape_data($_POST['new_amt']);
									$total=escape_data($_POST['new_total']);
									if(function_exists('mysql_real_escape_string')){
										$comments=mysql_real_escape_string(($_POST['comments']));
										if($comments==(string)'You can add some extra details about the item here(Optional)'){
											$comments='N/A';
										}
									}
									else{
										$comments=mysql_escape_string($_POST['comments']);
										if($comments==(string)'You can add some extra details about the item here(Optional)'){
											echo $comments='N/A';
										}
										
									}
									$date=date("d/m/y");
									$_SESSION['NSTEBS']['bill_no']=$sr_no;
									$query="INSERT INTO `bills`(`sno`, `item`, `qty`, `rate`, `amt`, `vatp`, `vatamt`, `total`,`comments`,`extracharges`,`discount`) VALUES ('$sr_no','$item','$qty','$rate','$amt','$vatp','$vatamt','$total','$comments','$extra','$discount')";
									if(mysql_connect(HOST,USER,PASSWORD)){
										if(mysql_select_db(DB)){
											if(mysql_query($query)){
												$error='Item added to specified Reference';
											}
											else{
												$error='Item not added';
											}
										}
										else{
											$error='Could not connect to DB';
										}
									}
									else{
										$error='Could not connect to host';
									}

								}
								else{
									$error='Item name is invalid';
								}
							}
								else{
									$error='Invlid Characters in Extra Charges Field';
								}
							}
								else{
									$error='Invlid Characters in Discount Field';
								}
							}
								else{
									$error='Vat Amount is invalid';
								}
							}
							else{
								$error='Amount is invlid';
							}
						}
						else{
							$error='Total is invalid';
						}
					}
					else{
						$error='Vat(%) is invalid';
					}
				}
				else{
					$error='Invalid Rate';
				}
			}
			else{
				$error='Invalid Quantity';
			}
		}
		else{
			$error='Invalid Bill no.';
		}
	}
?>