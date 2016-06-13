<?php 
if(isset($_POST['bill_name'],$_POST['bill_address'],$_POST['bill_tin'])){
			if(preg_match('%^[A-Za-z0-9. -_]{3,30}$%',$_POST['bill_name'])){
				if(preg_match('%^[A-Za-z0-9. -_]{3,50}$%',$_POST['bill_address'])){
					if(preg_match('%^[0-9NA]{0,30}$%',$_POST['bill_tin'])){
						if(preg_match('%^[A-Za-z0-9 ]{0,30}$%',$_POST['formvat'])){
							if(preg_match('%^[0-9]{1,30}$%',$_POST['bill_billno'])){
								require_once(INCLUDES.'escape.tpl');
								$name=escape_data($_POST['bill_name']);
								$adress=escape_data($_POST['bill_address']);
								$tin=escape_data($_POST['bill_tin']);
								$formvat=escape_data($_POST['formvat']);
								$bill=escape_data($_POST['bill_billno']);
								require_once(INCLUDES.'db_update_owner.php');
							}
							else
							{
								$error1='Invalid Bill no.';
							}
						}
						else{
							$error1='Invalid Values Entered';
						}
					}
					else{
						$error1 = 'Invalid Tin no.';
					}
				}
				else{
					$error1 ='Invalid Characters in Adress';
				}
			}
			else{
				$error1 ='Invalid Characters in Name';
			}
		}
?>


<label class="page-caption">Edit bill owner details</label>
<form action="" method="post" name="bill_details" onsubmit="document.bill_details.formvat.disabled=false;">
    <div class="bill_details_form">
    	<?php require_once(INCLUDES.'db_values.php'); ?>
        <input type="text"  style="margin-left:130px; margin-top:5px; border:none; background:none; text-align:center; margin-bottom:5px;" value="<?php if(isset($db_formvat)){echo $db_formvat;}; ?>" disabled="disabled" name="formvat" /><br />
        <label class="bill_name">Name</label><input type="text" name="bill_name" class="billname_f" value="<?php if(isset($db_name)){echo $db_name;} ?>"/>
        <label class="bill_address">Adress</label><input type="text" name="bill_address" class="billaddress_f" value="<?php if(isset($db_address)){echo $db_address;} ?>"/><br />
        <label class="bill_tin">Tin no.</label><input type="text" name="bill_tin" class="billtin_f" value="<?php if(isset($db_tin)){echo $db_tin;} ?>"/>
        <label class="bill_billno">Bill No.</label><input type="text" name="bill_billno" class="billno_f" value="<?php if(isset($db_bill)){echo $db_bill;} ?>"/>
       <br /> <input type="submit" class="btn_confirm" style="margin-left:340px;" value="Edit" onclick="if(document.forms.bill_details.bill_tin.value==''){document.forms.bill_details.formvat.value='Form Vat 51';}else{document.forms.bill_details.formvat.value='Form Vat 50';}"/>
        <br/>
        <label class="error_lbl1"><?php if(isset($error1)){echo $error1;}?></label>
     </div>
    </form>