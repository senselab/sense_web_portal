<?php
include "include/registration_funcs.php";

//request to cancel 
if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['cancel']) && isset($_POST['reftoken']) && $_POST['cancel'] == "1"){

	$reftoken = $_POST['reftoken'];
	$order = __getOrder("ref_token", $reftoken);

	if($order[0]['paid'] != 1){
		echo "Status is not paid.";
		return;
	}

	$data = array('ONO' => $order[0]['esun_payment_id'], 'MID' => '8080710660');
	$MACKey = 'MQBERSSCK1TPXPE7W3P4RXBBTYH5LROY';
	$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
	$hashData = hash('SHA256', $jsonData.$MACKey);
	$targetUrl = 'https://acq.esunbank.com.tw/ACQTrans/esuncard/txnf0150';

	$dataArr = array('data' => $jsonData, 'mac' => $hashData, 'ksn' => "1");
	$ch = curl_init($targetUrl);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, preparePostFields($dataArr));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($ch);
	curl_close($ch);
	
	$rc = substr($result, strpos($result,"returnCode",0) + 13, 2);
	// 00 cancelled
	if($rc == "00"){
		cancelPayment($_POST['reftoken']);
		echo "$reftoken is cancelled";
	}
	// G2 format error
	else if($rc == "G2"){
		echo "Format Error.";
	}
	// GF status error
	else if($rc == "GF"){
		cancelPayment($_POST['reftoken']);
		echo "Transaction Status Error.";
	}
	else{
		echo "Unhandled Error. Return Code: $rc";
	}
}
//return from cancel.php
else if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']){
	print(getOrderDetailsHtml($_POST['reftoken']));
	$reftoken = $_POST['reftoken'];
	$htmlPage = <<<EOF
	<form action="cancel.php" method="post">
		<table>
			<tr>
				<input type="hidden" name="cancel" value="1">
			</tr>
			<tr>
				<input type="hidden" name="reftoken" value="$reftoken">
			</tr>
		</table>
		<input type="submit" value="Cancel Order">
	</form>
EOF;
	print($htmlPage);
}
//default page
else{
	$htmlPage = <<<EOF
	<head>
	</head>
	<body>
		<form action="cancel.php" method="post">
			<table>
				<tr>	
						<h2>references token</h2><br/>
						<input name="reftoken" value="">
				</tr>	
			</table>
			<input type="submit" value="Query">
		</form>
	</body>
EOF;
	print ($htmlPage);
}

?>


