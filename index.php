<?php 
session_start();
include('inc/header.php');
$loginError = '';
if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
	include 'Invoice.php';
	$invoice = new Invoice();
	$user = $invoice->loginUsers($_POST['email'], $_POST['pwd']); 
	if(!empty($user)) {
		$_SESSION['user'] = $user[0]['first_name']."".$user[0]['last_name'];
		$_SESSION['userid'] = $user[0]['id'];
		$_SESSION['email'] = $user[0]['email'];		
		$_SESSION['address'] = $user[0]['address'];
		$_SESSION['mobile'] = $user[0]['mobile'];
		header("Location:invoice_list.php");
	} else {
		$loginError = "Invalid email or password!";
	}
}
?>
<title>D6 Developer Test</title>
<script src="js/invoice.js"></script>
<link href="css/style.css" rel="stylesheet">
<div class="row">	
	<div class="">
		
	</div>
	<div  style="margin-left : 600px " class="">		
		<h4 style="color : black ; text-align : left;">Invoice User Login:</h4>		
		<form method="post" action="">
			<div class="form-group">
			<?php if ($loginError ) { ?>
				<div class="alert alert-warning"><?php echo $loginError; ?></div>
			<?php } ?>
			</div>
			<div >
				<input style="width : 20%"name="email" id="email" type="email" class="forminput" placeholder="Email address" autofocus="" required>
			</div>
			<div class="">
				<input style="width : 20%" type="password" class="forminput" name="pwd" placeholder="Password" required>
			</div>  
			<div class="form-group">
				<button style="margin-left : 60px"type="submit" name="login" class="moreButton">Login</button>
			</div>
		</form>
		<br>
		<p style="color : black">Please log in with below details , these are only for demonstration purposes.</p>
		<p style="color : black"><b>Email</b> : admin@d6.co.za<br><b>Password</b> : 12345</p>			
	</div>		
</div>		
</div>
<?php include('inc/footer.php');?>