<?php
session_start();
include 'Invoice.php';
$invoice = new Invoice();
$invoice->checkLoggedIn();
if(!empty($_GET['invoice_id']) && $_GET['invoice_id']) {
	echo $_GET['invoice_id'];
	$invoiceValues = $invoice->getInvoice($_GET['invoice_id']);		
	$invoiceItems = $invoice->getInvoiceItems($_GET['invoice_id']);		
}
$invoiceDate = date("d/M/Y, H:i:s", strtotime($invoiceValues['order_date']));
$output = '';
$output .= '<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr>
	<td style="background-color : #2B7CE1; color : white" colspan="2" align="center" style="font-size:18px"><b>Invoice</b></td>
	</tr>
	<tr>
	<td colspan="2">
	<table width="100%" cellpadding="5">
	<tr>
	
	<td width="35%">
	<img style="margin-top : 20px" src="images/logo.png" width="100" height="100"> <br />
	<h2>D6 Group,</h2>
	<b>Building 1 Floor 3, Pegasus, 210 Amarand Ave, Waterkloof Glen, Pretoria, 0010</b><br />
	Tel : 087 820 0088<br /> 
	Website : d6group.co.za<br />
	</td>
	<td width="35%">         
    <h4 style="border : solid 1px grey">Invoice No. : '.$invoiceValues['order_id'].'</h4>
	<h4  style="border : solid 1px grey" >Invoice Date : '.$invoiceDate.'</h4>
	</td>

	<tr>
	
	<td width="65%">
	
	To,<br />
	<b>RECEIVER (BILL TO)</b><br />
	Name : '.$invoiceValues['order_receiver_name'].'<br /> 
	Billing Address : '.$invoiceValues['order_receiver_address'].'<br />
	</td>
	


	</tr>
	</table>
	<br />
	<table width="100%" border="1" cellpadding="5" cellspacing="0">
	<tr style="background-color : #2B7CE1; color : white">
	<th class="floater" align="left">Sr No.</th>
	<th align="left">Item Code</th>
	<th align="left">Item Name</th>
	<th align="left">Quantity</th>
	<th align="left">Price</th>
	<th align="left">Actual Amt.</th> 
	</tr>';
$count = 0;   
foreach($invoiceItems as $invoiceItem){
	$count++;
	$output .= '
	<tr >
	<td align="left">'.$count.'</td>
	<td align="left">'.$invoiceItem["item_code"].'</td>
	<td align="left">'.$invoiceItem["item_name"].'</td>
	<td align="left">'.$invoiceItem["order_item_quantity"].'</td>
	<td align="left">'.$invoiceItem["order_item_price"].'</td>
	<td align="left">'.$invoiceItem["order_item_final_amount"].'</td>   
	</tr>';
}
$output .= '
	<tr>
	<td align="right" colspan="5"><b>Sub Total</b></td>
	<td align="left"><b>'.$invoiceValues['order_total_before_tax'].'</b></td>
	</tr>
	<tr>
	<td align="right" colspan="5"><b>Tax Rate :</b></td>
	<td align="left">'.$invoiceValues['order_tax_per'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="5">Tax Amount: </td>
	<td align="left">'.$invoiceValues['order_total_tax'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="5">Total: </td>
	<td align="left">'.$invoiceValues['order_total_after_tax'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="5">Amount Paid:</td>
	<td align="left">'.$invoiceValues['order_amount_paid'].'</td>
	</tr>
	<tr>
	<td align="right" colspan="5"><b>Amount Due:</b></td>
	<td align="left">'.$invoiceValues['order_total_amount_due'].'</td>
	</tr>';
$output .= '
	</table>

	</td>
	</tr>
	<p style="text-align : center">D6 , 087 820 0088 , accounts@d6.co.za </p>
	<p style="text-align : center">If you have any questions about this invoice, please contact</p>
	</table>';


// create pdf of invoice	
$invoiceFileName = 'Invoice-'.$invoiceValues['order_id'].'.pdf';
require_once 'dompdf/src/Autoloader.php';
Dompdf\Autoloader::register();
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$dompdf->loadHtml(html_entity_decode($output));
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();
$dompdf->stream($invoiceFileName, array("Attachment" => false));
?>   
   