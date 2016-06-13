<?php

	if(isset($_POST['comp_name'],$_POST['comp_addr'],$_POST['comp_tin'],$_POST['comp_pan'])){
		if(preg_match('%^[A-Z a-z.-_]{3,30}&%',$_POST['comp_name'])){
			if(preg_match('%^[0-9]{13,15}&%',$_POST['comp_tin'])){
				if(preg_match('%^[A-Za-z-_ 0-9]{13,15}&%',$_POST['comp_pan'])){
					require_once(INCLUDES.'escape.tpl');
					$com_name=escape_data($_POST['comp_name']);
					if(function_exists('mysql_real_escape_string')){
						$com_addr=mysql_real_escape_string($_POST['comp_addr']);
					}
					else{
						$com_addr=mysql_escape_string($_POST['comp_addr']);
					}
					$com_tin=escape_data($_POST['comp_tin']);	
					$com_pan=escape_data($_POST['comp_pan']);														
					

						if(mysql_connect(HOST,USER,PASS)){
							if(mysql_select_db(DB)){
								$query='CREATE TABLE ';
							}
							else{
								die('OOPS! Something Went Wrong');
							}
						}
						else{
							die('OOPS! Something went wrong');
						}		
				
				}
				else{
					$error='Invlaid Pan no.';
				}
			}
			else{
				$error='Invalid Tin no.';
			}
		}
		else{
			$error='Invalid Characters in Name';
		}
	}
	else{
		$error='All Fields are required';
	}
?>