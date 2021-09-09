<!DOCTYPE html>
<html lang="en">
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

	<title>PRDC 2018</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="PRDC.ico" rel="shortcut icon" />
	<script>
        $(function(){
            $("#header").load("header.html");
			// $("#navigation").load("navigation.html");
        });
    </script>
</head>
<body>

<!--main-->
<div id="container">
	<div id="header"></div>
	<!-- <div id="navigation"></div> -->
	<div id="content">
	<?php
		include "include/registration_funcs.php";

		//request to pay for tickets 
		if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['reftoken']) && isset($_POST['amount']) && isset($_POST['for']) && isset($_POST['name']) && isset($_POST['email'])){
			$reftoken = $_POST['reftoken'];
			$amount = $_POST['amount'];
			$desp = $_POST['for'];
			$name = $_POST['name'];
			$email = $_POST['email'];
			$order = __getOrder("ref_token", $reftoken);
			$rqid = $order[0]['id'];
			$ono = genONO($rqid);

			inserMiscLog($rqid, $ono, $amount, $name, $desp, $email);
			$data = array('ONO' => $ono, 'U' => $prdc . "/registration/miscellaneous.php", 'MID' => '8080710660', 'TA' => $amount, 'TID' => 'EC000001');
			$MACKey = 'MQBERSSCK1TPXPE7W3P4RXBBTYH5LROY';
			$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
			$hashData = hash('SHA256', $jsonData.$MACKey);
			$targetUrl = 'https://acq.esunbank.com.tw/ACQTrans/esuncard/txnf014s';

			$htmlPage = <<<EOF
				<br>
				<br>
				<h3>Order Information (Miscellaneous Payment) #$reftoken</h3>
				<table class="table table-hover">
					<tr>
		  				<td width="60%">Miscellaneous Payment</td>
				  		<td width="35%">TWD $amount</td>
					</tr>
				</table>
				<form class="form" id="payment" action="$targetUrl" method="post">
					<div class="form-group">
						<!--  Additional banquet tickets  -->
						<input type="hidden" name="data" value=$jsonData />
						<input type="hidden" name="mac" value="$hashData" />
						<input type="hidden" name="ksn" value="1" />
					</div>
					<div class="form-group">
						<br>
						<button id="paymentBtn" name="button" class="btn btn-primary" onclick="proceedPayment()"><strong>Proceed to Payment (Visa, Mastercard, JCB, 銀聯​)</strong></button>
					</div>
				</form>
EOF;
				print($htmlPage);
		}

		// return from ESUN, judge if payment succeed
		else if(isset($_GET['DATA']) && isset($_SERVER['REQUEST_METHOD']) && 'GET' == $_SERVER['REQUEST_METHOD']){
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
				updateMiscLog($rqid, $ono);
				updateOrderAmount($rqid, $ono);
			}
			// 3-2. payment fail print the html and reason
			else if ($rc != '00') {
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
		}

		//return from miscellaneous.php for query order detail
		else if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['reftoken'])){
			$html = getOrderDetailsHtml($_POST['reftoken'], 1);	
			$reftoken = $_POST['reftoken'];
			if (!strpos($html, "Invalid")){
				if($reftoken != ""){
					$order = getEamilandName($reftoken);
					$name = $order['firstname'] . ' ' . $order['lastname'];
					$email = $order['email'];
					$htmlPage = <<<EOF
					<br>
					<br>
					<form class="form" action="miscellaneous.php" method="post" onSubmit="return validateForm()">
						<h3 for="banquet_tickets">Miscellaneous Payment</h3>
						<div class="form-group">
						  <label for="amount">Amount  (TWD) <span style="color:rgb(255,0,0);">*</span></label>
						  <input type="text" name="amount" id="amount" value="" class="form-control" required="required"/>
						</div>
						<div class="form-group">
						  <label for="for">For the Payment of <span style="color:rgb(255,0,0);">*</span></label>
						  <input type="text" name="for" id="for" value="" class="form-control" required="required"/>
						</div>
						<div class="form-group">
						  <label for="name">Name <span style="color:rgb(255,0,0);">*</span></label>
						  <input type="text" name="name" id="name" value="$name" readonly="readonly" class="form-control" required="required"/>
						</div>
						<div class="form-group">
						  <label for="email">Email <span style="color:rgb(255,0,0);">*</span></label>
						  <input type="text" name="email" id="email" value="$email" readonly="readonly" class="form-control" required="required"/>
						</div>
						<input type="hidden" name="reftoken" value="$reftoken">
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Submit</button>
						</div>
					</form>
EOF;
					print($htmlPage);
				}
			}
			else{
				print ($html);
			}
		}
		//default page
		else{
			$htmlPage = <<<EOF
			<br>
			<form class="form-inline" action="miscellaneous.php" method="post">
				<div class="form-group">
					<h3>Please input your registration reference ID</h3>
					<input class="form-control" name="reftoken" placeholder="Enter registration reference ID">
					<button type="submit" class="btn btn-primary">Submit</button>
				</div>
			</form>
EOF;
			print ($htmlPage);
		}
	?>
    </div><!--/content-->
    <div id="footer">
        <p>Copyright &copy; PRDC 2018</p>
    </div>
</div><!--/container-->
</body>
</html>