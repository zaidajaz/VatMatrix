
<?php
	if($_SERVER['REQUEST_METHOD']=="POST"){
		if(isset($_POST['inputField']) && isset($_POST['inputField2'])){
				 $datei=$_POST['inputField'];
				 $datef=$_POST['inputField2'];
				 
				 if($datef<$datei){
				 	$error='Please Check Your Dates!!';
				 }
				 else{
					require_once(INCLUDES.'output_db.php');
				 }
		}
		else{
			$error="Please enter both dates Carefully!";
		}
	}
?>