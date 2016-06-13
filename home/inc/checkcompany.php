<?php
	if(mysql_connect(HOST,USER,PASSWORD)){
		$query="SELECT COUNT(*) as Companies FROM information_schema.tables WHERE table_schema = 'nst';";
		if($result=mysql_query($query)){
			if(mysql_num_rows($result)>0){
				while($row=mysql_fetch_assoc($result)){
					$num=$row['Companies'];
					if($num>0){
						$exists=true;
					}
					else{
						$exists=false;
					}
				}
			}
			else{
				die('OOPS! Something Went Wrong');
			}
		}
		else{
			die('OOPS!Something Went Wrong');		
		}
	}
	else{
		die('OOPS! Something went wrong');
	}
?>