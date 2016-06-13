<?php
	if(isset($_POST['items'],$_POST['qty'],$_POST['rate'],$_POST['amt'],$_POST['vatp'],$_POST['vatamt'],$_POST['discount'],$_POST['extra'],$_POST['total'],$_POST['comments'],$_POST['NSTEBSp'])){
		if(preg_match('%^[A-Za-z0-9 /.*\+_-]{1,30}$%',$_POST['items'])){
			if(preg_match('%^[0-9]{1,30}$%',$_POST['qty'])){
				if(preg_match('%^[0-9.]{1,30}$%',$_POST['rate'])){
					if(preg_match('%^[0-9.]{1,30}$%',$_POST['vatp'])){
						if(preg_match('%^[0-9.-]{1,30}$%',$_POST['total'])){
							if(preg_match('%^[0-9.]{1,30}$%',$_POST['amt'])){
								if(preg_match('%^[0-9.]{1,30}$%',$_POST['vatamt'])){
									if(preg_match('%^[0-9.]{0,30}$%',$_POST['discount'])){
										if(preg_match('%^[0-9.]{0,30}$%',$_POST['extra'])){
									
									require_once(INCLUDES.'escape.tpl');
									
									$extra=escape_data($_POST['extra']);
									$discount=escape_data($_POST['discount']);	
									
									if($extra==''){
										$extra=0;
									}
									if($discount==''){
										$discount=0;
									}
																	
									$item=escape_data($_POST['items']);
									$sr_no=$_SESSION['NSTEBS']['bill_no'];
									$qty=escape_data($_POST['qty']);
									$rate=escape_data($_POST['rate']);
									$vatp=escape_data($_POST['vatp']);
									$vatamt=escape_data($_POST['vatamt']);
									$amt=escape_data($_POST['amt']);
									$total=escape_data($_POST['total']);
									$prim=escape_data($_POST['NSTEBSp']);
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
									$query="UPDATE `bills` SET `sno`='$sr_no',`item`='$item',`qty`='$qty',`rate`='$rate',`amt`='$amt',`vatp`='$vatp',`vatamt`='$vatamt',`total`='$total',`Comments`='$comments',`extracharges`='$extra',`discount`='$discount' WHERE `primary_ref`='$prim'";
									if(mysql_connect(HOST,USER,PASSWORD)){
										if(mysql_select_db(DB)){
											if(mysql_query($query)){
												$error='Item Details Updated';
											}
											else{
												$error='Error Updating Item Details';
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
			$error='Item name is invalid';
		}

	}
?>