<?php
	if(isset($_POST['old_pass'],$_POST['new_pass'],$_POST['rep_pass'])){
		if(preg_match('%^[A-Za-z !@\./-_0-9]{8,16}$%',$_POST['old_pass'])){
			if(preg_match('%^[A-Za-z !@\./-_0-9]{8,16}$%',$_POST['new_pass'])){
				if(preg_match('%^[A-Za-z !@\./-_0-9]{8,16}$%',$_POST['rep_pass'])){
					require_once(INCLUDES.'escape.tpl');
					$old=escape_data($_POST['old_pass']);
					$new=escape_data($_POST['new_pass']);
					$rep=escape_data($_POST['rep_pass']);
					
					$old= base64_encode(md5(sha1(json_encode(sha1(base64_encode(sha1(md5(sha1($old)))))))));
					
					if($new==$rep){
						$sql="SELECT * FROM `company_details`";
						if($result=mysql_query($sql)){
							if(mysql_num_rows($result)>0){
								while($row=mysql_fetch_assoc($result)){
									$db_pass=$row['Password'];
								}
								if($old==$db_pass){
									$new=base64_encode(md5(sha1(json_encode(sha1(base64_encode(sha1(md5(sha1($new)))))))));
									$sql="UPDATE `company_details` SET `Password`='$new';";
									if(mysql_query($sql)){
										$error='Password Changed Successfully';
									}
									else{
										die('OOPS! Something Went wrong');
									}
								}
								else{
									die('Old Password is incorrect');
								}
							}
							else{
								$error='Company details dont exist please set them first';	
							}
						}
						else{
							die('OOPS! Something Went Wrong');
						}
					}
					else{
						$error="New password and Repeat password don't match";
					}
			
				}
				else{
					$error='Invalid Characters in Repeat Password';
				}
			}
			else{
				$error='Invalid Characters in New Password';
			}
		}
		else{
			$error='Invalid Characters in Old Password';
		}
	}
?>