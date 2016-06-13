<?php
	$length=0;
		foreach($amtat as $srt){
			$length++;
		}
		
		$length-=1;
		for($sort=0;$sort<=$length;$sort++){
			for($sort1=$sort+1;$sort1<=$length;$sort1++){
				if($amtat[$sort] > $amtat[$sort1]){
					$swap = $amtat[$sort];
					$amtat[$sort]=$amtat[$sort1];
					$amtat[$sort1]=$swap;
				}
			}
		}
		
		foreach($amtat as $srt){
			if($srt!=0){
				echo"<th>Amount at ".$srt."%</th>";
			}
			else{
				echo"<th>EXEMPT</th>";
			}
			
		}
		
?>