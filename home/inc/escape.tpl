<?php
	function escape_data($data){
		if(function_exists('mysql_real_escape_string')){
			global $var;
			$data= htmlspecialchars(trim($data));
			$data=strip_tags($data);
			$data=htmlentities($data);
		}else{
				$data=mysql_escape_string(trim($data));
				$data=strip_tags($data);
				$data=htmlentities($data);
		}return $data;
	}
?>