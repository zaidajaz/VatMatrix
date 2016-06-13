<?php
$query="SELECT `sno` FROM `bills` ORDER BY `sno`;";
if(mysql_connect(HOST,USER,PASSWORD)){
			if(mysql_select_db(DB)){
				if($result=mysql_query($query)){
					if(mysql_num_rows($result)>0){
						while($row=mysql_fetch_assoc($result)){
							$last=$row['sno'];
						}
					}
				}
			}
}

?>