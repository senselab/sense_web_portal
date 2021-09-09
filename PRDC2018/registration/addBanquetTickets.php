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
		require_once "include/servername.php";
		//request to pay for tickets 
		if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD'] && isset($_POST['banquet_tickets']) && isset($_POST['reftoken'])){
			$reftoken = $_POST['reftoken'];
			$order = __getOrder("ref_token", $reftoken);
			$rqid = $order[0]['id'];
			$ono = genONO($rqid);
			$banquet_tickets = $_POST['banquet_tickets'];
			$amount_twd = $_POST['banquet_tickets'] * 2500;
			insertBanquetLog($rqid, $ono, $amount_twd);;


			$data = array('ONO' => $ono, 'U' => $prdc . "/registration/addBanquetTickets.php", 'MID' => '8080710660', 'TA' => $amount_twd, 'TID' => 'EC000001');
			$MACKey = 'MQBERSSCK1TPXPE7W3P4RXBBTYH5LROY';
			$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
			$hashData = hash('SHA256', $jsonData.$MACKey);
			$targetUrl = 'https://acq.esunbank.com.tw/ACQTrans/esuncard/txnf014s';

			$htmlPage = <<<EOF
				<br>
				<br>
				<h3>Order Information(additional banquet tickets) #$reftoken</h3>
				<table class="table table-hover">
					<tr>
		  				<td width="60%">Additional Banquet Tickets</td>
				  		<td width="5%">x $banquet_tickets</td>
				  		<td width="35%">TWD $amount_twd</td>
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
				updateBanquetLog($rqid, $ono);
				updateBanquetTickets($rqid, $ono);
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

		//return from addBanquetTickets.php for query order detail
		else if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']){
			$html = getOrderDetailsHtml($_POST['reftoken'], 1);			
			print($html);
			if (!strpos($html, "Invalid")){
				$reftoken = $_POST['reftoken'];
				if($reftoken != ""){
					$htmlPage = <<<EOF
					<br>
					<br>
					<form class="form" action="addBanquetTickets.php" method="post">
						<div class="form-group">
							<!--  Additional banquet tickets  -->
							<label for="banquet_tickets">Additional banquet tickets</label>
							<select class="form-control" id="banquet_tickets" name="banquet_tickets">
								<option value=1>1</option>
								<option value=2>2</option>
								<option value=3>3</option>
								<option value=4>4</option>
								<option value=5>5</option>
							</select>
							<small id="notehelp_banquet_tickets" class="form-text text-muted">TWD 2500 (USD 85) per ticket</small>
							<input type="hidden" name="reftoken" value="$reftoken">

						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-primary">Confirm</button>
						</div>
					</form>
EOF;
					print($htmlPage);
				}
			}
		}
		//default page
		else{
			$htmlPage = <<<EOF
			<br>
			<form class="form-inline" action="addBanquetTickets.php" method="post">
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





