<?php 
require_once('pathconfig.php');
require_once(COMMON.'headder.php');
require_once(INCLUDES.'php_valid.php');
?>
<script type="text/javascript">
	function calculate_noitem(){
		var amt=document.forms.new_bill.new_amt;
		var vatp=document.forms.new_bill.new_vatp;
		var vatamt=document.forms.new_bill.new_vatamt;
		var total=document.forms.new_bill.new_total;
		var extra=document.forms.new_bill.new_extra;
		var discount=document.forms.new_bill.new_discount;
		var add=document.forms.new_bill.add;
		var nodiscount;
		var discountvar;
		var extravar;
		
		if(discount.value==''){
			discountvar=0;
		}
		else{
			discountvar=parseFloat(discount.value);
		}
		
		if(extra.value==''){
			extravar=0;
			
		}
		else{
			extravar=parseFloat(extra.value);
		}
		
		if(amt.disabled==false){
			
			vatamt.value=(parseFloat(amt.value)*parseFloat(vatp.value)/100).toFixed(2);
			nodiscount=(parseFloat(amt.value)+parseFloat(vatamt.value)+extravar).toFixed(2);
			total.value=nodiscount-discountvar;	
			add.disabled=false;	
		}
		else{
			var t=parseFloat(total.value);
			var a=1+parseFloat(vatp.value)/100;
			
			var am=(t+discountvar-extravar)/a;
			
			amt.value=am.toFixed(2);
			vatamt.value=(am*(a-1)).toFixed(2);
			
			add.disabled=false;
			
		}
		
	}
	function toggle_noitem(){
		var amt=document.forms.new_bill.new_amt;
		var total=document.forms.new_bill.new_total;
		
		if(amt.disabled==false){
			amt.disabled=true;
			total.disabled=false;
			
		}
		else{
			amt.disabled=false;
			total.disabled=true;
			
		}
	}
	function no_valid(){
		document.forms.new_bill.new_total.disabled=false;
		document.forms.new_bill.new_amt.disabled=false;
		document.forms.new_bill.new_vatamt.disabled=false;
		
	}
</script>
    <div id="content">
    	
  <label style="float:right;">Want to create an item voucher instead ? then <a href="index.php">Click Here</a></label>      
        <form method="post" action="" id="new_bill">
		<div class="container">
			<div class="labels">
            	<label class="caption">Reference</label><br>
				<label class="caption">Amount</label><br>
				<label class="caption">Vat(%)</label><br>
				<label class="caption">Vat Amount</label><br>
                <label class="caption">Extra Charges</label><br />
                <label class="caption">Discount</label><br />
				<label class="caption">Total</label><br />
				<label class="caption">Comments</label>
            </div>
			<div class="inputs">
            <input type="hidden" name="new_select" value="Sales"/>
				<input type="hidden" name="new_qty" required="required" value="0">
				<input type="hidden" name="new_rate" required="required" value="0">
            	<input type="text" name="bill_no" class="new_input" value="<?php if(isset($_POST['bill_no'])){echo $_POST['bill_no'];} ?>"><br>
				<input type="text" name="new_amt" class="new_input" required="required" value="<?php if(isset($_POST['new_amt'])){echo $_POST['new_amt'];} ?>"><br>
				<input type="text" name="new_vatp" class="new_input" required="required" value="<?php if(isset($_POST['new_vatp'])){echo $_POST['new_vatp'];} ?>"><br>
				<input type="text" name="new_vatamt" class="new_input" disabled="disabled" required="required" value="<?php if(isset($_POST['new_vatamt'])){echo $_POST['new_vatamt'];} ?>"><br>
				<input type="text" name="new_extra" class="new_input"  value="<?php if(isset($_POST['new_extra'])){echo $_POST['new_discount'];} ?>"><br />
                <input type="text" name="new_discount" class="new_input"  value="<?php if(isset($_POST['new_discount'])){echo $_POST['new_extra'];} ?>"><br />
                <input type="text" name="new_total" disabled="disabled" class="new_input" required="required" value="<?php if(isset($_POST['new_total'])){echo $_POST['new_total'];} ?>"><br />
                
            
                <textarea name="comments" onfocus="if(this.value=='You can add some extra details about the item here(Optional)'){this.value='';}" style="max-width:150px; max-height:59px; min-height:58px;" onblur="if(this.value==''){this.value='You can add some extra details about the item here(Optional)';}" rows="3" cols="17"><?php if(isset($_POST['comments'])){echo $_POST['comments'];}else{echo "You can add some extra details about the item here(Optional)";} ?></textarea>
			</div>
		</div>
        <div class="buttons">
			<input type="button" class="new_add" value="Toggle" onclick="toggle_noitem();">
            <input type="button" class="new_add" value="Calculate" onclick="calculate_noitem();">
			<input type="submit" class="new_add" value="Add To Bill" id="add" disabled="disabled" onclick="javascript:return no_valid();">
            <input type="button" class="new_add" value="Grand Total" onclick="document.location='view.php'">
          </div>
          <label style="float:right;">
          	<?php 
				if(isset($error)){
					echo $error;
				}
			?>
          </label>
		</form>
            
 	</div>
    
  <?php require_once(COMMON.'footer.php') ?>