<?php 
require_once('pathconfig.php');
require_once(COMMON.'headder.php');
require_once(INCLUDES.'php_valid.php');
?>
    <div id="content">
    	
  <label style="float:right;">Want to create a no item voucher instead ? then <a href="noitem.php">Click Here</a></label>      
        <form method="post" action="" id="new_bill">
		<div class="container">
			<div class="labels">
            	<label class="caption">Reference</label><br>
				<label class="item_caption">Item</label><br>
				<label class="caption">Quantity</label><br>
				<label class="caption">Rate</label><br>
				<label class="caption">Amount</label><br>
				<label class="caption">Vat(%)</label><br>
				<label class="caption">Vat Amount</label><br>
                <label class="caption">Extra Charges</label><br />
                <label class="caption">Discount</label><br />
				<label class="caption">Total</label><br />
				<label class="caption">Comments</label>
            </div>
			<div class="inputs">
            	<input type="text" name="bill_no" class="new_input" value="<?php if(isset($_POST['bill_no'])){echo $_POST['bill_no'];} ?>"><br>
				<input type="text" name="new_select" class="new_input" value="<?php if(isset($_POST['new_select'])){echo $_POST['new_select'];} ?>"/><br>
				<input type="text" name="new_qty" class="new_input" required="required" value="<?php if(isset($_POST['new_qty'])){echo $_POST['new_qty'];} ?>"><br>
				<input type="text" name="new_rate" class="new_input" required="required" value="<?php if(isset($_POST['new_rate'])){echo $_POST['new_rate'];} ?>"><br>
				<input type="text" name="new_amt" class="new_input"  disabled="disabled" required="required" value="<?php if(isset($_POST['new_amt'])){echo $_POST['new_amt'];} ?>"><br>
				<input type="text" name="new_vatp" class="new_input" required="required" value="<?php if(isset($_POST['new_vatp'])){echo $_POST['new_vatp'];} ?>"><br>
				<input type="text" name="new_vatamt" class="new_input" disabled="disabled" required="required" value="<?php if(isset($_POST['new_vatamt'])){echo $_POST['new_vatamt'];} ?>"><br>
				<input type="text" name="new_extra" class="new_input"  value="<?php if(isset($_POST['new_extra'])){echo $_POST['new_discount'];} ?>"><br />
                <input type="text" name="new_discount" class="new_input"  value="<?php if(isset($_POST['new_discount'])){echo $_POST['new_extra'];} ?>"><br />
                <input type="text" name="new_total" disabled="disabled" class="new_input" required="required" value="<?php if(isset($_POST['new_total'])){echo $_POST['new_total'];} ?>"><br />
                
            
                <textarea name="comments" onfocus="if(this.value=='You can add some extra details about the item here(Optional)'){this.value='';}" style="max-width:150px; max-height:59px; min-height:58px;" onblur="if(this.value==''){this.value='You can add some extra details about the item here(Optional)';}" rows="3" cols="17"><?php if(isset($_POST['comments'])){echo $_POST['comments'];}else{echo "You can add some extra details about the item here(Optional)";} ?></textarea>
			</div>
		</div>
        <div class="buttons">
			<input type="button" class="new_add" value="Toggle" onclick="toggle();">
            <input type="button" class="new_add" value="Calculate" onclick="calculate();">
			<input type="submit" class="new_add" value="Add To Bill" id="add" disabled="disabled" onclick="javascript:return valid();">
            <input type="button" class="new_add" value="Grand Total" onclick="document.location='view.php'">
          </div>
          <label style="float:right; color:red;">
          	<?php 
				if(isset($error)){
					echo $error;
				}
			?>
          </label>
		</form>
            
 	</div>
    
  <?php require_once(COMMON.'footer.php') ?>