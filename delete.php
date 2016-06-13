<?php
	require_once('pathconfig.php');
	require_once(COMMON.'headder.php');
	
	
	if($_SERVER['REQUEST_METHOD']=='POST'){
		if(isset($_POST['bill_no'])){
			if(preg_match('%^[0-9]{1,9}$%',$_POST['bill_no'])){
				 $bill_no=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['bill_no']))));
				 $check="SELECT * FROM `bills` WHERE `sno`='$bill_no'";
				 $query="DELETE FROM `bills` WHERE `sno`='$bill_no'";
				 
				 if(mysql_connect(HOST,USER,PASSWORD)){
					if(mysql_select_db(DB)){
						if($check=mysql_query($check)){
					if(mysql_num_rows($check)>0){
						if(mysql_query($query)){
							$query="DELETE FROM `bill_owner` WHERE `bill_no`='$bill_no'";
							if(mysql_query($query)){
								$error='Deleted!';
							}
							else{
								$error='Delete Failed/Record not existing';
							}
						}
						else{
							$error='Delete Failed!';
						}
					}
					else{
						$error='Record Does not exist';

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
				?><script type="text/javascript">document.lcation='delete.php'</script><?php
			}
		}
	}
	
	
?>
<div id="content">
    	 <div class="view_bill_form">
        	<form action="" method="post">
            <label class="page-caption">Delete Bill by Reference no.</label><br />
        		<label class="view_bill_lbl">Enter Refernce no</label><br /><input type="text" required="required" class="view_bill_field" name="bill_no"/><br />
        		<input type="submit" value="Delete" class="btn"/>
        	</form>
            <label class="error_lbl1"><?php if(isset($error)){echo $error;} ?></label>
        </div>
    </div>
<?php
	require_once(COMMON.'footer.php');
?>