<?php
	include "include/registration_funcs.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<title>PRDC 2018</title>
	<meta http-equiv="Content-Type" content="text/html; 
	charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link href="PRDC.ico" rel="shortcut icon" />
    <style type="text/css">
        <!-- .STYLE1 {
            font-size: 14px
        }
        -->
    </style>
</head>
<body>
<?php
	if(isset($_SERVER['REQUEST_METHOD']) && 'GET' == $_SERVER['REQUEST_METHOD']){
		////// 0. err msg handling
		if( isset($_GET['err']) )
		{
			if( 'missing_form_field' == $_GET['err'] ){
				print(getMissingFieldHtml());
			}
			if( 'missing_ieee_mem_num' == $_GET['err'] ){
				print(getMissingIEEEMemNumHtml());
			}
			if( isset($_GET['msg']) ){
				print(__getErrMsgHtml($_GET['err'], $_GET['msg']));
			}
		}

		// 1. revisit via token, show order details
		if( isset($_GET['reftoken']) ){
			print(getOrderDetailsHtml($_GET['reftoken']));
		}
		// 2. first visit, show main page
		else{
			print(getRegIntroHtml());
			include "registration_form.php";
		}
	}
	// 3. return from ESUN, judge if payment succeed
	else if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']){
		$rqid = $_POST['rqID'];
		$ono = $_POST['ONO'];
		$amount = $_POST['Amount'];
		$rc = $_POST['RC'];
		$trandate = $_POST['TranDate'];
		$trantime = $_POST['TranTime'];
		$keystate = $_POST['KeyState'];

		$ref_token = __getOrder('id', $rqid)[0]['ref_token'];

		// 3-1. payment fail
		if(1 == $keystate && '00' != $rc){
			print(getPaymentFailureHtml());
		}
		// 3-2. payment succeed
		else if (1 == $keystate && '00' == $rc) {
			print(getPaymentSuccessHtml());
			clearPayment($rqid, $ono);
			$order = __getOrder('id', $rqid)[0];
			sendComfirmationMail($order['name'], $order['email'], $order['ref_token']);
		}
		else {
			$html_text = <<<EOF
			<h3>Unhandled situation: </h3>
			<ul>
				<li>rqID: $rqid</li>
				<li>ONO: $ono</li>
				<li>Amount: $amount</li>
				<li>RC: $rc</li>
				<li>TranDate: $trandate</li>
				<li>TranTime: $trantime</li>
				<li>KeyState: $keystate</li>
			</ul>
EOF;
			print($html_text);
		}
		print(getOrderDetailsHtml($ref_token));

	}
?>
</body>