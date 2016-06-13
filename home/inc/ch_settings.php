<?php
	if(isset($_POST['cmp_name'],$_POST['cmp_adress'],$_POST['cmp_tin'],$_POST['cmp_pan'],$_POST['cmp_pass'])){
		if(preg_match('%^[A-Za-z .0-9]{3,30}$%',$_POST['cmp_name'])){
			if(preg_match('%^[0-9]{3,30}$%',$_POST['cmp_tin'])){
				if(preg_match('%^[A-Za-z -_0-9]{3,30}$%',$_POST['cmp_pan'])){
					if(preg_match('%^[A-Za-z !@\./-_0-9]{8,16}$%',$_POST['cmp_pass'])){
						
						require_once(INCLUDES.'escape.tpl');
						$name = escape_data($_POST['cmp_name']);
						$adress = escape_data($_POST['cmp_adress']);
						$tin = escape_data($_POST['cmp_tin']);
						$pan = escape_data($_POST['cmp_pan']);
						$pass = escape_data($_POST['cmp_pass']);
						
						$pass = base64_encode(md5(sha1(json_encode(sha1(base64_encode(sha1(md5(sha1($pass)))))))));
						
						if(mysql_connect(HOST,USER,PASSWORD)){
							if(mysql_select_db(DB)){
								$sql="SELECT * FROM `company_details`;";
								if($result=mysql_query($sql)){
									if(mysql_num_rows($result)>0){
										while($row=mysql_fetch_assoc($result)){
											$db_pass=$row['Password'];											
										}
										if($pass==$db_pass){
												$query="DELETE FROM `company_details`";
												if(mysql_query($query)){
													$query="INSERT INTO `company_details` VALUES('$name','$adress','$tin','$pan','$pass');";
													if(mysql_query($query)){
														$error = 'Company Details updated Successfully!';
													}
													else{
														die('Something went wrong');
													}
												}
												else{
													die('OOPS! Something went wrong');
												}
										}
										else{
											$error='Wrong Password Entered!';
										}
									}
									else{
										$sql="INSERT INTO `company_details` VALUES('$name','$adress','$tin','$pan','$pass');";
										if(mysql_query($sql)){
											$error='Company Details Updated Successfully';
										}
										else{
											die('Something Went wrong');
										}
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
					}
					else{
						$error='Invalid Characters in Password';
					}
				}
				else{
					$error='Invalid Characters in PAN no.';
				}
			}
			else{
				$error='Invalid Characters in TIN no.';
			}
		}
		else{
			$error='Invalid Characters in Name';
		}
	}
	else{
		$error='All fields are required';
	}
?>