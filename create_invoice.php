<?php 
session_start();
include('inc/header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_POST['companyName']) && $_POST['companyName']) {	
	$invoice->saveInvoice($_POST);
	header("Location:invoice_list.php");	
}
?>
<title>Create Invoice</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">

<div style="background-color : white"class="container content-invoice">
	<form name="myForm" onsubmit="return validateForm()" action="" id="invoice-form" method="post" class="invoice-form" role="form" > 
		<div class="load-animate animated fadeInUp">
			<div class="row">
				<div class="padding-left : 30px">
					
					<a href="invoice_list.php"><button style="margin-left : 30px" class="moreButton" type="button" href="invoice_list.php">< Back</button></a>
	
					<h1 style="padding-left : 30px"class="title">Create a New Invoice</h1>
						
					
				</div>		    		
			</div>
			<input id="currency" type="hidden" value="$">
			<div class="row">
				<div style="padding-left : 30px">
					<h3>From,</h3>
					<?php echo $_SESSION['user']; ?><br>	
					<?php echo $_SESSION['address']; ?><br>	
					<?php echo $_SESSION['mobile']; ?><br>
					<?php echo $_SESSION['email']; ?><br>	
				</div>      		
				<div style="margin-left : 700px; margin-top : -180px; padding-right : 100px">
					<h3>To,</h3>
					<div class="">
					
						<input class="forminput"  type="text"  name="companyName" id="companyName" placeholder="Company Name" autocomplete="off" required />

					</div>
					<div class="">
						<textarea class="forminput" rows="3" name="address" id="address" placeholder="Company Address" required></textarea>
					</div>
					
				</div>
			</div>
			<div class="row">
				<div style="margin-top : 50px; padding-left : 30px; padding-right : 50px">
					<table class="styled-table-create" id="invoiceItem">	
						<tr style="background-color : #2B7CE1; color : white; padding-right : 50px">
							<th width="2%"><input id="checkAll" class="forminput" type="checkbox"></th>
							<th width="15%">Item No</th>
							<th width="38%">Item Name</th>
							<th width="15%">Quantity</th>
							<th width="15%">Price</th>								
							<th width="25%">Total</th>
						</tr>							
						<tr>
							<td><input class="itemRow" type="checkbox"></td>
							<td><input type="text" name="productCode[]" id="productCode_1" class="forminput" autocomplete="off" required ></td>
							<td><input type="text" name="productName[]" id="productName_1" class="forminput" autocomplete="off" required></td>			
							<td><input type="number" name="quantity[]" id="quantity_1" class="forminput" autocomplete="off" required></td>
							<td><input type="number" name="price[]" id="price_1" class="forminput" autocomplete="off" required></td>
							<td><input style="margin-right : 250px ; width : 87%" type="number" name="total[]" id="total_1" class="forminput" autocomplete="off" required></td>
						</tr>						
					</table>
				</div>
			</div>
			<div class="row">
				<div style="padding-left : 30px">
					<button class="deleteButton" id="removeRows" type="button">Delete Item</button>
					<button class="moreButton"  id="addRows" type="button">Add Item</button>
				</div>
			</div>
			<div class="row">	
				<div style="width : 30%; padding-left : 30px; float: left ;background-color : white; padding-bottom : 30px; padding-right : 50px" >
					<h3 style="color : #2978DA">Notes: </h3>
					<div class="">
						<textarea class="forminput" rows="5" name="notes" id="notes" placeholder="Your Notes" required>Invoice to be paid in 30 Days.</textarea>
					</div>
					<br>
					<div class="">
						<input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="forminput" name="userId">
						<input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save Invoice" class="submitButton">						
					</div>
					
				</div>
				<div style="width : 30%; float:right; padding-right : 70px; padding-bottom : 100px; margin-top : -50px">
					<span>
						<div class="forminput">
							<label>Subtotal: R &nbsp;</label>
							<div class="">
								<div class=""></div>
								<input style="padding-right : 40px; width : 80%"value="" type="number" class="forminput" name="subTotal" id="subTotal" placeholder="Subtotal" required>
							</div>
						</div>
						<div class="forminput">
							<label>Tax Rate: %&nbsp;</label>
							<div class="">
								<input step="any" style="padding-right : 40px; width : 80%" type="number" class="forminput" name="taxRate" id="taxRate" placeholder="0" required>
								<div ></div>
							</div>
						</div>
						<div class="forminput">
							<label>Tax Amount: R&nbsp;</label>
							<div class="">
								<div ></div>
								<input step="any" value=""style="padding-right : 40px; width : 80%" type="number" class="forminput" name="taxAmount" id="taxAmount" placeholder="Tax Amount" required>
							</div>
						</div>							
						<div class="forminput">
							<label>Total: <b>R</b>&nbsp;</label>
							<div class="">
								<div></div>
								<input step="any" value="" style="padding-right : 40px; width : 80%"type="number" class="forminput" name="totalAftertax" id="totalAftertax" placeholder="Total" required>
							</div>
						</div>
						<div class="forminput">
							<label>Amount Paid: R &nbsp;</label>
							<div class="">
								<div ></div>
								<input step="any" value="0"style="padding-right : 40px; width : 80%" type="number" class="forminput" name="amountPaid" id="amountPaid" placeholder="Amount Paid" required>
							</div>
						</div>
						<div class="forminput">
							<label>Amount Due: R&nbsp;</label>
							<div class="">
								<div ></div>
								<input step="any" style="padding-right : 40px; width : 80%"type="number" class="forminput" name="amountDue" id="amountDue" placeholder="Amount Due" required>
							</div>
						</div>
					</span>
				</div>
			</div>
			<div class="clearfix"></div>		      	
		</div>
	</form>			
</div>
</div>
	

<?php include('inc/footer.php');?>