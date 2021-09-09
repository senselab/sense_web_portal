<?php
	include "include/registration_funcs.php";
	// Cross-Origin Resource Sharing Header
	// header('Access-Control-Allow-Origin: http://prdc.dependability.org https://sense.cs.nctu.edu.tw');
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<title>PRDC 2018</title>
	<meta http-equiv="Content-Type" content="text/html; 
	charset=utf-8" />
    <link href="style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.0.3/cookieconsent.min.css" />
    <link href="PRDC.ico" rel="shortcut icon" />
</head>
<body>
<?php
	if(isset($_SERVER['REQUEST_METHOD']) && 'GET' == $_SERVER['REQUEST_METHOD']){
		///// 0. err msg handling
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
		// 2. return from ESUN, judge if payment succeed
		else if(isset($_GET['DATA'])){
			$data = $_GET['DATA'];
			$data = strtojson($data);
			$rc = $data['RC'];
			$ono = $data['ONO'];
			$rqid = getrqid($ono);
			$order = __getOrder('id', $rqid)[0];
			$reftoken = $order['ref_token'];

			// 3-1. payment succeed
			if($rc == '00'){
				print(getPaymentSuccessHtml());
				clearPayment($rqid, $ono);
				sendComfirmationMail($order['firstname'] . " " . $order['lastname'], $order['email'], $order['ref_token']);
			}
			// 3-2. payment fail print the html and reason
			else if ($rc != '00') {
				setRC($ono, $rc);
				print(getPaymentFailureHtml($rc));
			}
			else {
				$html_text = <<<EOF
				<h3>Unhandled situation: </h3>
				<ul>
					<li>RC: $rc</li>
					<li>ONO: $ono</li>
				</ul>
EOF;
				print($html_text);
			}
			print(getOrderDetailsHtml($reftoken));
		}
		// 3. first visit, show main page
		else{
			print(getRegIntroHtml());
			if(isset($_GET['onlyintro']) == '1'){
				$html_text = <<< EOF
				<br>
        		    <button class="btn btn-primary"   onclick="javascript:location.href='https://prdc2018.cs.nctu.edu.tw/PRDC2018/registration2018.php'">
    	            <strong>Register Now</strong>
            	</button> 
EOF;
				print($html_text);
			} else{
				include "registration_form.php";
			}
		}
	}
?>
</body>