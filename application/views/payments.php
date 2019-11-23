<html lang="en">
<head>
    <title>Paypal Payment Gateway</title>
</head>
<body>

<?php
	$paypalUrl='https://www.sandbox.paypal.com/cgi-bin/webscr';
	$paypalId='2kbd.noyon-facilitator@gmail.com';
?>
 
<div class="container text-center">
	<div class="row">
		<div class="col-md-12">
			
			<div class="pay-box">

				<h2><strong>Paypal Payment</strong></h2><br>
				<!-- PRICE ITEM -->
				<form action="<?php echo html_escape($paypalUrl); ?>" method="post" name="frmPayPal1">
					<div class="panel price panel-red">
					    <input type="hidden" name="business" value="<?php echo html_escape($paypalId); ?>">
					    <input type="hidden" name="cmd" value="_xclick">
					    <input type="hidden" name="item_name" value="It Solution Stuff">
					    <input type="hidden" name="item_number" value="2">
					    <input type="hidden" name="amount" value="20">
					    <input type="hidden" name="no_shipping" value="1">
					    <input type="hidden" name="currency_code" value="USD">
					    <input type="hidden" name="cancel_return" value="http://demo.itsolutionstuff.com/paypal/cancel.php">
					    <input type="hidden" name="return" value="http://demo.itsolutionstuff.com/paypal/success.php">  
						    
						<div class="panel-heading  text-center">
						<h3>PRO PLAN</h3>
						</div>
						<div class="panel-body text-center">
							<p class="lead"><strong>$20 / month</strong></p>
						</div>
						<div class="panel-footer">
							<button class="btn btn-lg btn-block btn-info" href="#">PAY NOW!</button>
						</div>
					</div>
				</form>
				<!-- /PRICE ITEM -->
			</div>

		</div>
	</div>
</div>
</body>
</html>
