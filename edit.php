<?php
	require_once('pathconfig.php');
	require_once(COMMON.'headder.php');
	require_once(INCLUDES.'db_update_desc.php');
?>


<script type="text/javascript">
	function table_calculate(a){
	var chqty = document.getElementById("qty"+a);
	var chrate = document.getElementById("rate"+a);
	var bool=chrate.contentEditable && chqty.contentEditable;

	if(bool=='true'){

		var qty = document.getElementById("qty"+a).innerHTML;
		var rate = document.getElementById("rate"+a).innerHTML;
		var amt = document.getElementById("amt"+a).innerHTML;
		var vatp = document.getElementById("vatp"+a).innerHTML;
		var vatamt = document.getElementById("vatamt"+a).innerHTML;	
		var discount=document.getElementById("discount"+a).innerHTML;
		var extra = document.getElementById("extracharges"+a).innerHTML;
		var comments = document.getElementById("comments"+a).innerHTML;	
		var total = document.getElementById("total"+a).innerHTML;
		
		if(total=='' || total=='<br>'){
			total=0;
		}
		if(extra=='' || extra=='<br>'){
			extra=0;
			
		}
		if(discount=='' || discount=='<br>'){
			discount=0;
		}
		if(vatamt=='' || vatamt=='<br>'){
			vatamt=0;
		}
		if(vatp=='' || vatp=='<br>'){
			vatp=0;
		}
		if(amt=='' || amt=='<br>'){
			amt=0;
		}
		if(rate=='' || rate=='<br>'){
			rate=0;
		}
		if(qty=='' || qty=='<br>'){
			qty=0;
		}

		if(rate!=0){
			amt=(parseInt(qty)*parseFloat(rate)).toFixed(2);
			vatamt=(parseFloat(vatp)/100*parseFloat(amt)).toFixed(2);
			total=(parseFloat(amt)+parseFloat(vatamt)+parseFloat(extra)-parseFloat(discount)).toFixed(2);
		
			$('#amt'+a).html(amt);
			$('#vatamt'+a).html(vatamt);
			$('#total'+a).html(total);
			$('#extracharges'+a).html(extra);
			$('#discount'+a).html(discount);
		}
		if(rate==0){
			var t=parseFloat(total);
			var q=parseInt(qty);
			var b=1+parseFloat(vatp)/100;
			var r=(((t+parseFloat(discount))-parseFloat(extra))/(q*b)).toFixed(2);
			var am=q*r;
			var vatam=((b-1)*am).toFixed(2);
			
			rate=r;
			amt=am;
			vatamt=vatam;

			
			$('#amt'+a).html(amt);
			$('#vatamt'+a).html(vatamt);
			$('#rate'+a).html(rate);
		}
	}
	else{
		var amt = document.getElementById("amt"+a).innerHTML;
		var vatp = document.getElementById("vatp"+a).innerHTML;
		var vatamt = document.getElementById("vatamt"+a).innerHTML;	
		var discount=document.getElementById("discount"+a).innerHTML;
		var extra = document.getElementById("extracharges"+a).innerHTML;
		var comments = document.getElementById("comments"+a).innerHTML;	
		var total = document.getElementById("total"+a).innerHTML;
		
		if(total=='' || total=='<br>'){
			total=0;
		}
		if(extra=='' || extra=='<br>'){
			extra=0;
			
		}
		if(discount=='' || discount=='<br>'){
			discount=0;
		}
		if(vatamt=='' || vatamt=='<br>'){
			vatamt=0;
		}
		if(vatp=='' || vatp=='<br>'){
			vatp=0;
		}
		if(amt=='' || amt=='<br>'){
			amt=0;
		}
		
		if(amt!=0){
			vatamt=(parseFloat(amt)*parseFloat(vatp)/100).toFixed(2);
			$('#vatamt'+a).html(vatamt);;
			var nodiscount=(parseFloat(amt)+parseFloat(vatamt)+parseFloat(extra)).toFixed(2);
			total=nodiscount-discount;
			$('#total'+a).html(total);	
		}
		if(amt==0){
			var t=parseFloat(total);
			var b=1+parseFloat(vatp)/100;
			
			var am=(t+discount-extra)/b;
			
			amt=am.toFixed(2);
			vatamt=(am*(b-1)).toFixed(2);
			
			$('#amt'+a).html(amt);
			$('#vatamt'+a).html(vatamt);
		}
		
	}
}
function table_save(b){
	document.forms.edit_form.items.value=document.getElementById("item"+b).innerHTML;
	if(document.getElementById("qty"+b).innerHTML!='' && document.getElementById("rate"+b).innerHTML!=''){
		document.forms.edit_form.qty.value=document.getElementById("qty"+b).innerHTML;
		document.forms.edit_form.rate.value=document.getElementById("rate"+b).innerHTML;
	}
	else{
		document.forms.edit_form.qty.value=0;
		document.forms.edit_form.rate.value=0;
	}
	document.forms.edit_form.amt.value=document.getElementById("amt"+b).innerHTML;
	document.forms.edit_form.vatp.value=document.getElementById("vatp"+b).innerHTML;
	document.forms.edit_form.vatamt.value=document.getElementById("vatamt"+b).innerHTML;
	document.forms.edit_form.extra.value=document.getElementById("extracharges"+b).innerHTML;
	document.forms.edit_form.discount.value=document.getElementById("discount"+b).innerHTML;	
	document.forms.edit_form.total.value=document.getElementById("total"+b).innerHTML;
	document.forms.edit_form.comments.value=document.getElementById("comments"+b).innerHTML;
	document.forms.edit_form.NSTEBSp.value=document.getElementById("NSTEBS"+b).value;
	
	
	
	document.forms.edit_form.submit();
}
</script>

<div id="content">
<form action="" method="post" name="edit_form">
	<input type="hidden" id="items" name="items" value="<?php if(isset($_POST['name'])){echo $_POST['name'];} ?>">
    <input type="hidden" name="qty" value="<?php if(isset($_POST['qty'])){echo $_POST['qty'];} ?>">
    <input type="hidden" name="rate" value="<?php if(isset($_POST['rate'])){echo $_POST['rate'];} ?>">
    <input type="hidden" name="amt" value="<?php if(isset($_POST['amt'])){echo $_POST['amt'];} ?>">
    <input type="hidden" name="vatp" value="<?php if(isset($_POST['vatp'])){echo $_POST['vatp'];} ?>">
    <input type="hidden" name="vatamt" value="<?php if(isset($_POST['vatamt'])){echo $_POST['vatamt'];} ?>">
    <input type="hidden" name="extra" value="<?php if(isset($_POST['extra'])){echo $_POST['extra'];} ?>">
    <input type="hidden" name="discount" value="<?php if(isset($_POST['discount'])){echo $_POST['discount'];} ?>">
    <input type="hidden" name="total" value="<?php if(isset($_POST['total'])){echo $_POST['total'];} ?>">
    <input type="hidden" name="comments" value="<?php if(isset($_POST['comments'])){echo $_POST['comments'];} ?>"> 
    <input type="hidden" name="NSTEBSp"  value="<?php if(isset($_POST['NSTEBSp'])){echo $_POST['NSTEBSp'];} ?>"> 
</form>
<?php 
	if(isset($_POST['bill_no'])){
		if(preg_match('%^[0-9]{1,9}$%',$_POST['bill_no'])){
				$bill_no=htmlentities(stripslashes(strip_tags(mysql_real_escape_string($_POST['bill_no']))));
				$_SESSION['NSTEBS']['bill_no']=$bill_no;
			}
			else{
				?>
                <script type="text/javascript">document.location='edit.php';</script>
                <?php
			}
	}
	if(!isset($_SESSION['NSTEBS']['bill_no'])){
?>
        <div class="view_bill_form">
        	<form action="" method="post">
            <label class="page-caption">Edit bill by Reference no.</label><br />
        		<label class="view_bill_lbl">Enter Reference no.</label><br /><input type="text" required="required" class="view_bill_field" name="bill_no"/><br />
        		<input type="submit" value="Edit" class="btn"/>
        	</form>
        </div>
 </div>
<?php } 
		else{
			require_once(INCLUDES.'desc_edit.php');
			require_once(INCLUDES.'owner_edit.php');
			
		}
?>
<label ><?php if(isset($error)){echo $error;} ?></label>
<?php
	require_once(COMMON.'footer.php');
?>