
<?php 
session_start();
include('inc/header.php');
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
?>
<title>Invoice List</title>
<link rel="icon" type="image" href="/images/logo.png">
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
	<div class=" floater">	
    <h2 style="padding-top : 30px; margin-left : 20px">Invoice List</h2>
    <a href="invoice_list.php"><button style="margin-left : 20px" class="moreButton" type="button" href="invoice_list.php">Invoice List </button></a>
	 <a href="create_invoice.php"><button  class="moreButton" type="button" href="create_invoice.php">Capture Invoice</button></a>
	 		  
      <table class="styled-table" style="padding-bottom : 100px; border : solid 3px silver; width : 70%" >
        <thead>
          <tr>
            <th>Invoice No.</th>
            <th>Create Date</th>
            <th>Customer Name</th>
            <th>Invoice Total</th>
            <th>View</th>
            <th>Delete</th>
          </tr>
        </thead>
        <?php		
		$invoiceList = $invoice->getInvoiceList();
        foreach($invoiceList as $invoiceDetails){
			$invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceDetails["order_date"]));
            echo '
              <tr>
                <td>'.$invoiceDetails["order_id"].'</td>
                <td>'.$invoiceDate.'</td>
                <td>'.$invoiceDetails["order_receiver_name"].'</td>
                <td>'.$invoiceDetails["order_total_after_tax"].'</td>
                <td><a href="print_invoice.php?invoice_id='.$invoiceDetails["order_id"].'" title="Print Invoice"><span>View</span></a></td>
                <td><a href="#" id="'.$invoiceDetails["order_id"].'" class="deleteInvoice"  title="Delete Invoice"><span>Delete</span></a></td>
              </tr>
            ';
        }       
        ?>
      </table style="padding-bottom : 50px">	
      <br>
</div style="padding-bottom : 50px">	
<?php include('inc/footer.php');?>