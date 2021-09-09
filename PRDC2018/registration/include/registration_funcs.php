<?php
require_once 'include/dbconfig.php';
require_once 'include/mailconfig.php';
require_once "include/servername.php";

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

$registration = "$prdc/registration";

$OPT_REG_TYPE = [
					[
						'desc' => '[Early] Members',
						// 'usd' => 550,
						'twd' => 19000
					],
					[
						'desc' => '[Early] Non-Members',
						// 'usd' => 700,
						'twd' => 23000
					],
					[
						'desc' => '[Early] Student Members',
						// 'usd' => 250,
						'twd' => 13000
					],
					[
						'desc' => '[Early] Student Non-Members',
						// 'usd' => 350,
						'twd' => 16000
					],
					[
						'desc' => '[Early] Life/Retired Members',
						// 'usd' => 350,
						'twd' => 13000
					],					
					[
						'desc' => 'Members',
						// 'usd' => 650,
						'twd' => 23000
					],
					[
						'desc' => 'Non Members',
						// 'usd' => 800,
						'twd' => 28000
					],
					[
						'desc' => 'Student Members',
						// 'usd' => 350,
						'twd' => 16000
					],
					[
						'desc' => 'Student Non-Members',
						// 'usd' => 400,
						'twd' => 20000
					],
					[
						'desc' => 'Life/Retired Members',
						// 'usd' => 350,
						'twd' => 16000
					]					
				];

$OPT_TITLE = ['Mr.', 'Ms.', 'Mrs.', 'Miss.', 'Prof.', 'Dr.'];
$OPT_PAYMENT_METHOD = ['Credit Card (Visa, Mastercard, JCB, 銀聯​)', 'Bank Transfer'];
$OPT_PAPER_TYPE = ['-', 'Regular Paper', 'Fast Abstracts', 'Industry Track Papers', 'Posters'];
// List to keep track of new additional payment to be made
$ADDITIONAL_PAYMENT_LIST = [ // id  => amount_been_paid		PaperID
								138 => 		7500,			// 10
								108 => 		7500,			// 30
								140 => 		13000,			// 53
								133 => 		7500,			// 55
								85  => 		7500,			// 72
								145 => 		7500,			// 91
								128 => 		10500,			// 113
								136 => 		10500,			// 125
								124 =>		21500,			// 49
								144 =>		21500,			// 48
								178 =>		10500			// 72
						   ];


function __getErrMsgHtml($err, $msg)
{
	$ret = <<<EOF
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>$err</strong> $msg
		</div>
EOF;

	return $ret;

}


function getPaymentSuccessHtml()
{
	$ret = <<<EOF
		<div class="alert alert-success">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Payment succeeded!</strong>
		</div>
EOF;

	return $ret;

}


function getPaymentFailureHtml($RC)
{	
	Global $MAILALIAS;
	Global $MAILHOST;

	$reason = "";
	if ($RC == '14'){
		$reason = "Bad card number.";
	}
	else if ($RC == '14'){
		$reason = "Expired card.";
	}
	else if ($RC == '62'){
		$reason = "Not opened card.";
	}
	else{
		$reason = "RC:" . $RC . " ";
		$reason .= "Unhandled error. Please connact $MAILALIAS@$MAILHOST";
	}
	$ret = <<<EOF
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Payment failed!Please retry...<strong><br>
		  <strong>$reason<strong><br>
		</div>
EOF;

	return $ret;
}


function getMissingFieldHtml()
{
	$ret = <<<EOF
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Registration failed!</strong> Missing field in registration form!
		</div>
EOF;

	return $ret;
}


function getMissingIEEEMemNumHtml(){
	$ret = <<<EOF
		<div class="alert alert-danger">
		  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Registration failed!</strong> IEEE Member Number is required for registering as IEEE Member / IEEE-Student Member.
		</div>
EOF;

	return $ret;
}


function dbconnect()
{
	global $DBUSER;
	global $DBPASS;
	global $DBHOST;
	global $DBNAME;

	try {
		$conn = new PDO("mysql:host=$DBHOST;dbname=$DBNAME;charset=UTF8MB4;port=3306", $DBUSER, $DBPASS);
		// set the PDO error mode to exception
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e) {
		echo "DB Connection failed: " . $e->getMessage();
	}

	return $conn;
}


function __getOrder($key, $val)
{
	$conn = dbconnect();
	$sql = 'SELECT * FROM `orders` WHERE `'.$key.'`="'.$val.'"';

	$stmt = $conn->prepare($sql);

	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();

	return($result);
}


/*
 * genRefToken()
 *
 *	return a unique ref_token, OR
 *	return null if unable to create a unique ref_token after `MAX_RETRY` tries.
 *
 */
function genRefToken()
{
	$MAX_RETRY = 5;
	$RETRY_TIME = 0;
	$token = bin2hex(openssl_random_pseudo_bytes(8));

	do{
		$conn = dbconnect();

		$sql = "SELECT * FROM `orders` WHERE `ref_token`= \"$token\"";

		$stmt1 = $conn->prepare($sql);

		try{
			$stmt1->execute();
		}
		catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}

		$stmt1->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt1->fetchAll();

		if($RETRY_TIME > $MAX_RETRY){
			$token = Null;
			break;
		}
		else if(0 != sizeof($result)){
			$token = bin2hex(openssl_random_pseudo_bytes(8));
			$RETRY_TIME++;
		}

	} while(0 != sizeof($result));

	return $token;
}


function ieeeMemberNumRequired($reg_type)
{
 	if( 0 == $reg_type || 2 == $reg_type || 4 == $reg_type || 6 == $reg_type){
		return true;
	}
	else{
		return false;
	}
}


function __getOrderDetailsHtml($order, $noButton)
{
	global $registration;
	global $OPT_REG_TYPE;
	global $OPT_TITLE;
	global $OPT_PAYMENT_METHOD;
	global $OPT_PAPER_TYPE;
	global $prdc;

	$rqid = $order['id'];
	$title = $OPT_TITLE[$order['title']] ? $OPT_TITLE[$order['title']] : "-";
	$name = $order['firstname'] . ' ' . $order['lastname']; 
	$affiliation = $order['affiliation'];
	$email = $order['email'];
	$member_num = $order['member_num'] ? $order['member_num'] : "-";
	$reg_type = $OPT_REG_TYPE[$order['reg_type']]['desc'];
	$ticket_price_twd = $OPT_REG_TYPE[$order['reg_type']]['twd'];
	$paper_id = $order['paper_id'] ? $order['paper_id'] : "-";
	$paper_title = $order['paper_title'] ? $order['paper_title'] : "-";
	$paper_type = $order['paper_type']? $order['paper_type'] : "-";
	$paper_add_pages = $order['paper_add_pages'] > 0? $order['paper_add_pages'] : 0;
	$paper_add_pages_price_twd = $paper_add_pages * 3200;
	$department = $order['department'];
	$job = $order['job'];
	$address = $order['address'];
	$address2 = $order['address2'];
	$address3 = $order['address3'];
	$zipcode = $order['zipcode'];
	$city = $order['city'];
	$country = $order['country'];
	$phone = $order['phone'];
	$meal = $order['mealtype'];
	$banquet_tickets_count = $order['banquet_tickets'];
	$banquet_tickets_price_twd = ($order['banquet_tickets']*2500);
	$visa = $order['visa_nation'] == ""?"No":"Yes";
	$amount_twd = $order['amount'] ;
	$payment_method = $order['payment_method'];
	$paid = $order['paid'];
	$ref_token = $order['ref_token'];
	$created_at = $order['created_at'];
	$ono = genONO($rqid);

	$data = array('ONO' => $ono, 'U' => $prdc . "/registration2018.php", 'MID' => '8080710660', 'TA' => $amount_twd, 'TID' => 'EC000001');
	$MACKey = 'MQBERSSCK1TPXPE7W3P4RXBBTYH5LROY';
	$jsonData = json_encode($data, JSON_UNESCAPED_SLASHES);
	$hashData = hash('SHA256', $jsonData.$MACKey);
	$targetUrl = 'https://acq.esunbank.com.tw/ACQTrans/esuncard/txnf014s';
	$order_details = <<<EOF
	<h3>Order Information #$ref_token</h3>

	<table class="table table-hover">
		<tr>
		  <td colspan="2">Title</td>
		  <td>$title</td>
		</tr>
		<tr>
		  <td colspan="2">Name</td>
		  <td>$name</td>
		</tr>
		<tr>
		  <td colspan="2">Affiliation</td>
		  <td>$affiliation</td>
		</tr>
		<tr>
		  <td colspan="2">Email</td>
		  <td>$email</td>
		</tr>
		<tr>
		  <td colspan="2">IEEE Member Number</td>
		  <td>$member_num</td>
		</tr>
		<tr>
		  <td colspan="2">Paper ID</td>
		  <td>$paper_id</td>
		</tr>
		<tr>
		  <td colspan="2">Paper Title</td>
		  <td>$paper_title</td>
		</tr>
		<tr>
		  <td colspan="2">Paper Type</td>
		  <td>$OPT_PAPER_TYPE[$paper_type]</td>
		</tr>
		<tr>
		  <td colspan="2">Department</td>
		  <td>$department</td>
		</tr>
		<tr>
		  <td colspan="2">Job Title</td>
		  <td>$job</td>
		</tr>
		<tr>
		  <td colspan="2">Address</td>
		  <td>$address</td>
		</tr>
		<tr>
		  <td colspan="2">Address 2</td>
		  <td>$address2</td>
		</tr>
		<tr>
		  <td colspan="2">Address 3</td>
		  <td>$address3</td>
		</tr>
		<tr>
		  <td colspan="2">Zip Code</td>
		  <td>$zipcode</td>
		</tr>
		<tr>
		  <td colspan="2">City</td>
		  <td>$city</td>
		</tr>
		<tr>
		  <td colspan="2">Country</td>
		  <td>$country</td>
		</tr>
		<tr>
		  <td colspan="2">Phone Number</td>
		  <td>$phone</td>
		</tr>
		<tr>
		  <td colspan="2">Paper ID</td>
		  <td>$paper_id</td>
		</tr>
		<tr>
		  <td colspan="2">Paper Title</td>
		  <td>$paper_title</td>
		</tr>
		<tr>
		  <td colspan="2">Meal Type</td>
		  <td>$meal</td>
		</tr>
		<tr>
		  <td colspan="2">Need Visa Support Letter</td>
		  <td>$visa</td>
		</tr>
		<tr>
		  <td colspan=2>Payment method</td>
		  <td> $OPT_PAYMENT_METHOD[$payment_method]</td>
		</tr>
		<tr>
		  <td>Registration Type - "$reg_type"</td>
		  <td>x 1</td>
		  <td> TWD $ticket_price_twd</td>
		</tr>
		<tr>
		  <td>Additional Banquet Tickets</td>
		  <td>x $banquet_tickets_count</td>
		  <td> TWD $banquet_tickets_price_twd</td>
		</tr>
		<tr>
		  <td>Purchase Addtional Pages</td>
		  <td>  $paper_add_pages</td>
		  <td> TWD $paper_add_pages_price_twd</td>
		</tr>
		<tr>
		  <td colspan=2><b>Total amount</b></td>
EOF;
	if(reqAdditionalPayment($rqid) && 0 == $paid){
		$pre_paid = getPrepaidAmount($rqid);
		$due_to_paid = $amount_twd - $pre_paid;
		$order_details .= <<<EOF
		  <td> TWD $pre_paid + TWD $due_to_paid </td>
EOF;
	}
	else{
		$order_details .= <<<EOF
		  <td> TWD $amount_twd</td>
EOF;
	}
	$order_details .= <<<EOF
		</tr>
		<tr>
		  <td colspan=2>Payment method</td>
		  <td> $OPT_PAYMENT_METHOD[$payment_method]</td>
		</tr>
EOF;

	if(2 == $paid){
		$order_details .= <<<EOF
		<tr>
		  <td colspan="2">Payment Status</td>
		  <td>Canceled</td>
		</tr>
		</table>
EOF;
	}
	else if(1 == $paid ){
		$order_details .= <<<EOF
		<tr>
		  <td colspan="2">Payment Status</td>
		  <td>Paid</td>
		</tr>
		</table>
EOF;
		if($noButton != 1){
			$order_details .= <<<EOF
			<a href="$registration/helper_pdf_registration.php?reftoken=$ref_token">
				<button class="btn btn-success"><strong>Download Receipt</strong></button>
			</a>
EOF;
		}
	}
	else if(0 == $paid){
		$order_details .= <<<EOF
		<tr>
		  <td colspan="2">Payment Status</td>
EOF;
		if(reqAdditionalPayment($rqid)){
			$additional_note = "";
			if(3000 == $due_to_paid){
				$additional_note = " (TWD 3000 per extra page)";
			}
			$order_details .= <<<EOF
		  <td id="payment_status">TWD $pre_paid Paid, TWD $due_to_paid pending$additional_note</td>
EOF;
		}
		else{
			$order_details .= <<<EOF
		  <td id="payment_status">Pending</td>
EOF;
		}
		$order_details .= <<<EOF
		</tr>
		</table>
EOF;
		if($payment_method == 0 && $noButton != 1){
			//<form id="payment" action="$targetUrl" method="post">
			$order_details .= <<<EOF
		<form id="payment" action="$targetUrl" method="post">
			<input type="hidden" name="data" value=$jsonData />
			<input type="hidden" name="mac" value="$hashData" />
			<input type="hidden" name="ksn" value="1" />
		</form>
		<button id="paymentBtn" name="button" class="btn btn-primary" onclick="proceedPayment()"><strong>Proceed to Payment (Visa, Mastercard, JCB, 銀聯​)</strong></button>

		<script>
		function proceedPayment(){
			jQuery.ajax({
				type: "POST",
				url: '$registration/helper_ajax_registration.php',
				dataType: 'json',
				data:
					{
						func_name: 'getPaymentStatus', func_args: [$rqid]
					},
				success: function (obj, textstatus)
					{
						if( !('error' in obj) ){
							if(1 == obj.result){
								$("#payment_status").replaceWith('<td>Paid</td>');
								$("#paymentBtn").remove();
							}
							else if(0 == obj.result){
								$("#payment").submit();
							}
							console.log(obj.result);
						}
						else{
							console.log(obj.error);
						}
					}
			});
		}


		</script>
EOF;
		}
	}
	else if(2 == $paid){
		$order_details .= <<<EOF
		<tr>
		  <td colspan="2">Payment Status</td>
		  <td>Canceled</td>
		</tr>
		</table>
EOF;
	}
	return $order_details;
}


function getOrderDetailsHtml($ref_token, $noButton)
{
	global $MAILUSER;
	global $MAILHOST;
	global $MAILALIAS;
	$ret_html = "";

	$conn = dbconnect();
	$sql = 'SELECT * FROM `orders` WHERE `ref_token`="'.$ref_token.'" AND `invalid`=0';
	$stmt = $conn->prepare($sql);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		// echo $sql . "<br>" . $e->getMessage();
	}

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	if(0 == sizeof($result)){
		$ret_html .= <<<EOF
		<h2>Invalid references token '$ref_token'.</h2><br/>
		<h3>Kindly contact $MAILALIAS@$MAILHOST for helps.</h3><br/><br/>
EOF;
	}
	else if(1 != sizeof($result)){
		$ret_html .= <<<EOF
		<h2>ERROR</h2>
		<p>Somethings went wrong.</p><br/>
EOF;
	}
	else{
		$ret_html .= __getOrderDetailsHtml($result[0], $noButton);
	}

	return $ret_html;
}

function getEamilandName($ref_token)
{
	$conn = dbconnect();
	$sql = 'SELECT firstname, lastname, email FROM `orders` WHERE `ref_token`="'.$ref_token.'" AND `invalid`=0';
	$stmt = $conn->prepare($sql);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();

	return $result[0];
}

function getRegIntroHtml()
{
	global $OPT_REG_TYPE;
	$price = array($OPT_REG_TYPE[0]['twd'] / 1000, $OPT_REG_TYPE[1]['twd'] / 1000, $OPT_REG_TYPE[2]['twd'] / 1000, $OPT_REG_TYPE[3]['twd'] / 1000, $OPT_REG_TYPE[4]['twd'] / 1000, $OPT_REG_TYPE[5]['twd'] / 1000, $OPT_REG_TYPE[6]['twd'] / 1000, $OPT_REG_TYPE[7]['twd'] / 1000, $OPT_REG_TYPE[8]['twd'] / 1000, $OPT_REG_TYPE[9]['twd'] / 1000,);
	$ret_html=<<<EOF
	<h3 id="fees">Registration Fees</h3>
	The registration system charges in Taiwan Dollar (TWD).<br/>
	As a references, the approximate exchange rate between Taiwan Dollar and US Dollor is TWD 30 = USD 1.<br/><br/>
	<table border=1 class="table table-hover">
	<tr>
	  <td></td>
	  <td>Early Registration (till Nov. 4, 2018)</td>
	  <td>Late Registration</td>
	</tr>
	<tr>
	  <td>Member</td>
	  <td>TWD $price[0],000</td>
	  <td>TWD $price[5],000</td>
	</tr>
	<tr>
	  <td>Non Member</td>
	  <td>TWD $price[1],000</td>
	  <td>TWD $price[6],000</td>
	</tr>
	<tr>
	  <td>Student Member</td>
	  <td>TWD $price[2],000</td>
	  <td>TWD $price[7],000</td>
	</tr>
	<tr>
	  <td>Student Non-Member</td>
	  <td>TWD $price[3],000</td>
	  <td>TWD $price[8],000</td>
	</tr>
	<tr>
	  <td>Life/Retired Member</td>
	  <td>TWD $price[4],000</td>
	  <td>TWD $price[9],000</td>
	</tr>
	</table>
	

	<h4>NOTE:</h4>
	<ul>
		<li>“Member” refers to a valid member status of IEEE or IFIP.</li>
		<li>IEEE allows students to become student members at a very low cost. Please see the IEEE Web site for details.</li>
	</ul>

	<br/><br/>


	<h3 id="policy">Registration policy</h3>
	<ul>
		<li>For each accepted paper (including fast abstracts, industry track papers, and posters), at least one paid full registration (i.e., Member or Non-Member) is required. Note that a student registration is not sufficient.</li>
		<li>As a precondition for an accepted paper to appear in the proceedings, the registration should be done before <b>October 1, 2018 for main track papers</b> and before <b>October 15, 2018 for fast abstracts, industry track papers, and posters</b>.</li>
		<li>Authors with more than one paper must ensure each accepted paper has a separate full registration.</li>
		<li>Student registration does not include ticket for conference banquet.</li>
		<li>Only full-time students are eligible for student registration.</li>
		<li>For main track and industry track papers, up to two additional pages may be purchased at a rate of TWD 3200 (about USD 100) per page.</li>
		<li>For fast abstracts and posters, no additional pages are permitted.</li>
		<li>Member registrations and student registrations should provide the valid IDs at the registration desk or via e-mail (to prdc2018@gmail.com).</li>
	</ul>
EOF;

	return $ret_html;
}


function clearPayment($rqid, $ono)
{
	$conn = dbconnect();
	$sql = 'UPDATE `orders` SET `paid`=1, `esun_payment_id`="'. $ono .'", `transaction_time`=\''.date('Y-m-d H:i:s').'\' WHERE id='.$rqid;
	$stmt = $conn->prepare($sql);
	try{
		$stmt->execute();

	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}


function getPaymentStatus($rqid)
{
	$conn = dbconnect();
	$sql = "SELECT * FROM `orders` WHERE `id`= $rqid";

	$stmt = $conn->prepare($sql);

	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();

	if(1 != sizeof($result)){
		echo "invalid query: more than one record returned";
	}
	else{
		return($result[0]['paid']);
	}
}


function confirmedPayment($rqid)
{
	$conn = dbconnect();
	$sql = 'UPDATE `orders` SET `payment_confirmed`=1 WHERE id='.$rqid;
	$stmt = $conn->prepare($sql);
	try{
		$stmt->execute();

	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}

}


function unconfirmedPayment($rqid)
{
	$conn = dbconnect();
	$sql = 'UPDATE `orders` SET `payment_confirmed`=0 WHERE id='.$rqid;
	$stmt = $conn->prepare($sql);
	try{
		$stmt->execute();

	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}

}


function sendRegMail($name, $email, $ref_token, $payment_method)
{
	require_once 'libs/phpmailer/PHPMailerAutoload.php';
	global $MAILUSER;
	global $MAILPASS;
	global $MAILHOST;
	global $MAILPORT;
	global $MAILNAME;
	global $MAILALIAS;

	$m = new PHPMailer;
	$m->isSMTP();
	// $m->SMTPDebug = 3;
	$m->SMTPAuth = true;
	$m->Host = "smtp.$MAILHOST";
	$m->Username = "$MAILUSER";
	$m->Password = "$MAILPASS";
	$m->SMTPSecure = 'ssl';
	$m->Port = $MAILPORT;
	$m->CharSet='UTF-8';
	$m->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
	);
	$m->isHTML();

	$m->Subject = "PRDC'18 Registration #$ref_token";

	$m->Body = getMailBody(1, $name, $ref_token, $payment_method);

	$m->setFrom("$MAILALIAS@$MAILHOST", "$MAILNAME");
	$m->AddAddress($email, $name);

	if(!$m->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $m->ErrorInfo;
	} else {
		$html_text=<<<EOF
		Thank you for registering with PRDC'18.<br/><br/>

		To confirm your registration, an e-mail has been sent to '$email'.<br/><br/>

		<strong>Please follow the instructions in the e-mail to complete your registration.</strong><br/><br/>
EOF;
		print($html_text);
	}
}


function sendComfirmationMail($name, $email, $ref_token)
{
	require_once 'libs/phpmailer/PHPMailerAutoload.php';
	global $MAILUSER;
	global $MAILPASS;
	global $MAILHOST;
	global $MAILPORT;
	global $MAILNAME;
	global $MAILALIAS;

	$m = new PHPMailer;
	$m->isSMTP();
	$m->SMTPAuth = true;
	$m->Host = "smtp.$MAILHOST";
	$m->Username = "$MAILUSER";
	$m->Password = "$MAILPASS";
	$m->SMTPSecure = 'ssl';
	$m->Port = $MAILPORT;
	$m->CharSet='UTF-8';
	$m->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
	);

	$m->isHTML();

	$m->Subject = "PRDC'18 Registration #$ref_token: Order confirmed";

	$m->Body = getMailBody(2, $name, $ref_token, 0);
	$m->setFrom("$MAILALIAS@$MAILHOST", "$MAILNAME");
	$m->AddAddress($email, $name);

	if(!$m->send()) {
	    echo 'Message could not be sent.';
	    echo 'Mailer Error: ' . $m->ErrorInfo;
	} else {
	}

}


function getMailBody($idx, $name, $ref_token, $payment_method)
{
	global $registration;
	global $OPT_PAYMENT_METHOD;
	global $prdc;

	if(1 == $idx){
		$email_body = <<<EOF
		<html>
			<head><meta charset="utf-8"></head>
			<body>
			Dear $name, <br/><br/>

			Thank you for registering with PRDC 2018!<br/><br/>

			Your registration reference id is <strong>#$ref_token</strong>.<br/><br/>

			To complete the registration, please click the following link to confirm your registration information and finish the payment of registration fee.<br/><br/>

			$prdc/registration2018.php?reftoken=$ref_token<br/><br/>
EOF;
		if($payment_method == 0){
			$email_body .= <<<EOF
			Credit card payments for PRDC'18 are handled by <img src="$registration/media/esun_logo.png" class="img-responsive"><br/><br/>
EOF;
		}
		else if($payment_method == 1){
			$email_body .= <<<EOF
			The PRDC'18 account for international bank transfer is<br/><br/>

			<blockquote>
			Bank Name: E.Sun Commercial Bank, Ltd., Taipei, Taiwan<br/>
            Address: No.77, Sec. 1, Wuchang St., Zhongzheng Dist., Taipei City 100, Taiwan (R.O.C.) <br/>
            SWIFT Code: ESUNTWTP <br/>
            Account Number: 0532940104340 <br/>
			Account Name：COMPUTER SOCIETY OF REPUBLIC OF CHINA<br/>
			</blockquote>

			<br/>

			The PRDC'18 account for domestic bank transfer is<br/><br/>

			<blockquote>
			玉山銀行(808)城中分行<br/>
			帳戶：0532-940-104340<br/>
			戶名：中華民國電腦學會<br/>
			</blockquote>
			<br/>
			
			Please mark your <strong>name</strong> and <strong>registration reference id</strong> on the bank transfer form.<br/>
			(請於匯款單上註明註冊者姓名以及註冊編號)<br/><br/>
EOF;
		}
			$email_body .= <<<EOF
			We appreciate your participation in PRDC'18 and look forward to seeing you in Taipei.<br/><br/>
			
EOF;
		// $email_body .= getRegIntroHtml();
		$email_body .= <<<EOF
			<br/><br/><br/><br/>



			Most sincerely, <br/>
			PRDC'18 Team.
			</body>
		</html>
EOF;
	}
	else if(2 == $idx){
		$email_body = <<<EOF
		<html>
			<head><meta charset="utf-8"></head>
			<body>
			Dear $name, <br/><br/>

			This is to confirm the receipt of the payment for your registration (#$ref_token) with The 23rd IEEE Pacific Rim International Symposium on Dependable Computing (PRDC 2018)<br/><br/>

EOF;
		$email_body .= getOrderDetailsHtml($ref_token);
		$email_body .= <<<EOF
			<br/><br/>
			Your order confirmation can also be accessed through the link below: <br/><br/>
			$prdc/registration2018.php?reftoken=$ref_token<br/><br/>
			<br/><br/><br/>





			Best, <br/>
			PRDC'18 Team.
			</body>
		</html>

EOF;
	}

	return $email_body;
}


/*
 * getOrderDetailsPdf
 *	return well format html for valid ref_token that payment has been made
 *	return empty string for ref_token that payment weren't made
 */
function getOrderDetailsPdf($ref_token)
{
	global $OPT_REG_TYPE;
	global $OPT_TITLE;
	global $OPT_PAYMENT_METHOD;
	global $MAILUSER;
	global $MAILHOST;
	global $MAILALIAS;

	$ret_html = "";

	$conn = dbconnect();
	$sql = 'SELECT * FROM `orders` WHERE `ref_token`="'.$ref_token.'" AND `invalid`=0';
	$stmt = $conn->prepare($sql);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		//echo $sql . "<br>" . $e->getMessage();
	}

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();
	if(0 == sizeof($result)){
		$ret_html .= <<<EOF
		<h2>Invalid references token '$ref_token'.</h2><br/>
		<h3>Kindly contact $MAILALIAS@$MAILHOST for helps.</h3><br/><br/>
EOF;
	}
	else if(1 != sizeof($result)){
		$ret_html .= <<<EOF
		<h2>ERROR</h2>
		<p>Somethings went wrong.</p><br/>
EOF;
	}
	else{
		$order = $result[0];

		$rqid = $order['id'];
		$title = $OPT_TITLE[$order['title']] ? $OPT_TITLE[$order['title']] : "-";
		$name = $order['firstname'] . ' ' . $order['lastname']; 
		$affiliation = $order['affiliation'];
		$email = $order['email'];
		$member_num = $order['member_num'] ? $order['member_num'] : "-";
		$reg_type = $OPT_REG_TYPE[$order['reg_type']]['desc'];
		$ticket_price_twd = $OPT_REG_TYPE[$order['reg_type']]['twd'];
		$paper_id = $order['paper_id'] ? $order['paper_id'] : "-";
		$paper_title = $order['paper_title'] ? $order['paper_title'] : "-";
		$paper_type = $order['paper_type']? $order['paper_type'] : "-";
		$paper_add_pages = $order['paper_add_pages'] > 0? $order['paper_add_pages'] : 0;
		$paper_add_pages_price_twd = $paper_add_pages * 3200;
		$department = $order['department'];
		$job = $order['job'];
		$address = $order['address'];
		$address2 = $order['address2'];
		$address3 = $order['address3'];
		$zipcode = $order['zipcode'];
		$city = $order['city'];
		$country = $order['country'];
		$phone = $order['phone'];
		$meal = $order['mealtype'];
		$banquet_tickets_count = $order['banquet_tickets'];
		$banquet_tickets_price_usd = ($order['banquet_tickets']*85);
		$banquet_tickets_price_twd = ($order['banquet_tickets']*2500);
		$amount_twd = $order['amount'];
		$payment_method = $order['payment_method'] == 0? "Credit Card":"Bank Transfer";
		$paid = $order['paid'];
		$ref_token = $order['ref_token'];
		$created_at = $order['created_at'];
		$transaction_id = $order['esun_payment_id'];
		$transaction_time = $order['transaction_time'];
		$invalid = $order['invalid'];
		$updated_at = $order['updated_at'];

		// receipe is only avalibale to those who had paid
		if(1 == $invalid || 1 != $paid){
			return "";
		}

		$ret_html = <<<EOF
		<html>
			<head><meta charset="utf-8"></head>
			<body>
			<div>
				<table style="border-bottom:2px #696969" cellpadding="5">
					<tbody>
						<tr>
							<td width="15%">
								<img src="prdc2018-logo.svg" width="100" height="100">
							</td>
							<td width="85%"  align="center">
								<h2>The 23rd IEEE Pacific Rim International Symposium on Dependable Computing (PRDC 2018)</h2>
								<I>
									Academia Sinica<br>
									128 Academia Road, Section 2, Nankang, Taipei 11529, Taiwan<br>
										December 4-7, 2018
								</I>
							</td>

						</tr>
					</tbody>
				</table>
				<table cellpadding="6">
					<h3>Order Information #$ref_token</h3>
					<tbody>
						<tr>
							<td width="83%" align="left">
								This is to confirm that our accounting department has received the
							amount of:
							</td>
							<td width="17%" align="right">
								<strong> $amount_twd TWD</strong>
							</td>
						</tr>
						<tr>
							<td width="20%">
								From 	
							</td>
							<td width="80%" align="left">
									<strong>$title $name</strong><br>
									$affiliation $department<br>
									$address $address2 $address3<br>
									$city<br>
									$country<br>
							</td>
						</tr>
					</tbody>
				</table>
			</div>

			<div>
			<h3>For the payment of</h3>
			<table border="2" cellpadding="5">
				<tr>
				  <td width="60%">Registration Type - "$reg_type"</td>
				  <td width="5%">x 1</td>
				  <td width="35%">TWD $ticket_price_twd</td>
				</tr>
				<tr>
				  <td width="60%">Additional Banquet Tickets</td>
				  <td width="5%">x $banquet_tickets_count</td>
				  <td width="35%">TWD $banquet_tickets_price_twd</td>
				</tr>
				<tr>
				  <td width="60%">Purchase Addtional Pages</td>
				  <td width="5%">x $paper_add_pages</td>
				  <td width="35%">TWD $paper_add_pages_price_twd</td>
				</tr>
				<tr>
				  <td width="65%" colspan="2">Total amount</td>
				  <td width="35%">TWD $amount_twd</td>
				</tr>
			</table>
			</div>
			<div>
			<h3>Transaction information </h3>
			<table class="table" border="2" cellpadding="5">
				<tr>
				  <td width="65%">Payment method</td>
				  <td width="35%">$payment_method</td>
				</tr>
				<tr>
				  <td width="65%">Credit card transaction ID</td>
				  <td width="35%">$transaction_id</td>
				</tr>
				<tr>
					<td width="65%">Transaction amount</td>
					<td width="35%">TWD $amount_twd</td>
				</tr>
				<tr>
					<td>Transaction time</td>
					<td>$transaction_time (UTC +8)</td>
				</tr>
			</table>
			</div>
			</body>
		</html>
EOF;
	}

	return $ret_html;

}


function reqAdditionalPayment($rqid)
{
	global $ADDITIONAL_PAYMENT_LIST;
	return array_key_exists($rqid, $ADDITIONAL_PAYMENT_LIST);
}


function getPrepaidAmount($rqid)
{
	global $ADDITIONAL_PAYMENT_LIST;
	return $ADDITIONAL_PAYMENT_LIST[$rqid];
}


function allow_to_visit( $ip )
{
	$range = "140.113.0.0/16";

	$whitelist = array(
		"140.113.167.190",
        "140.113.167.162",
        "140.113.213.140",
        "140.113.194.70",
        "140.113.213.212",
        "140.113.167.178",
        "140.113.213.140",
        "111.251.202.189"
	);

	if ( strpos( $range, '/' ) == false ) {
		$range .= '/32';
	}
	// $range is in IP/CIDR format eg 127.0.0.1/24
	list( $range, $netmask ) = explode( '/', $range, 2 );
	$range_decimal = ip2long( $range );
	$ip_decimal = ip2long( $ip );
	$wildcard_decimal = pow( 2, ( 32 - $netmask ) ) - 1;
	$netmask_decimal = ~ $wildcard_decimal;

	$is_nctu_ip = ( ( $ip_decimal & $netmask_decimal ) == ( $range_decimal & $netmask_decimal ) );

	return $is_nctu_ip && in_array($ip, $whitelist);
}


function strtojson( $data ){
	$data = preg_split("[,]", $data);
	$jsonData = [];
	foreach ($data as $str) {
		if (($str = preg_split("[=]", $str)) == False){
			trigger_error("StrtoJson split error", E_USER_ERROR);
		}
		if (sizeof($str) == 2){
			$jsonData[$str[0]] = $str[1];
		}
	}
	return $jsonData;
}

function getrqid($ono){
	$conn = dbconnect();
	$sql = "SELECT `rqid` FROM `r_rqid_ono` WHERE `ono`= \"$ono\"";

	$stmt = $conn->prepare($sql);

	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$result = $stmt->fetchAll();

	if(1 != sizeof($result)){
		echo "invalid query: more than one record returned";
	}
	else{
		return($result[0]['rqid']);
	}
}

function genONO($rqid){
	$MAX_RETRY = 20;
	$RETRY_TIME = 0;

	$ono = random_str();
	do{
		$conn = dbconnect();

		$sql = "SELECT ono FROM `r_rqid_ono` WHERE `ono`= \"$ono\"";

		$stmt1 = $conn->prepare($sql);

		try{
			$stmt1->execute();
		}
		catch(PDOException $e){
			echo $sql . "<br>" . $e->getMessage();
		}

		$stmt1->setFetchMode(PDO::FETCH_ASSOC);
		$result = $stmt1->fetchAll();

		if($RETRY_TIME > $MAX_RETRY){
			$token = Null;
			break;
		}
		else if(0 != sizeof($result)){
			$ono = random_str();
			$RETRY_TIME++;
		} else if(0 == sizeof($result)){
			$conn = dbconnect();

			$sql = "INSERT INTO `r_rqid_ono` (rqid, ono) VALUES ($rqid, \"$ono\")";

			$stmt1 = $conn->prepare($sql);

			try{
				$stmt1->execute();
			}
			catch(PDOException $e){
				echo $sql . "<br>" . $e->getMessage();
			}
		}

	} while(0 != sizeof($result));

	return $ono;
}

function setRC($ono, $rc)
{
	$conn = dbconnect();

	$sql = 'UPDATE `r_rqid_ono` SET `rc` = "' . $rc . '" WHERE `ono` = "' . $ono . '"';

	$stmt = $conn->prepare($sql);

	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}

function random_str($type = 'alphanum', $length = 20)
{
    switch($type)
    {
        case 'basic'    : return mt_rand();
            break;
        case 'alpha'    :
        case 'alphanum' :
        case 'num'      :
        case 'nozero'   :
                $seedings             = array();
                $seedings['alpha']    = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $seedings['alphanum'] = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $seedings['num']      = '0123456789';
                $seedings['nozero']   = '123456789';
                
                $pool = $seedings[$type];
                
                $str = '';
                for ($i=0; $i < $length; $i++)
                {
                    $str .= substr($pool, mt_rand(0, strlen($pool) -1), 1);
                }
                return $str;
            break;
        case 'unique'   :
        case 'md5'      :
                    return md5(uniqid(mt_rand()));
            break;
    }
}

function cancelPayment($reftoken)
{
	$conn = dbconnect();
	$sql = 'UPDATE `orders` SET `paid`=2, `esun_payment_id`="", `transaction_time`=\''.date('Y-m-d H:i:s').'\' WHERE ref_token="'.$reftoken.'"';
	$stmt = $conn->prepare($sql);
	try{
		$stmt->execute();

	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}


function insertBanquetLog($rqid, $ono, $amount)
{
	$conn = dbconnect();
	$stmt = $conn->prepare("INSERT INTO `banquetticket` (rqid, esun_payment_id, amount) VALUES (:rqid, :ono, :amount)");
	$stmt->bindParam(':rqid', $rqid);
	$stmt->bindParam(':ono', $ono);
	$stmt->bindParam(':amount', $amount);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}

function updateBanquetLog($rqid, $ono)
{
	$conn = dbconnect();
	$stmt = $conn->prepare('UPDATE `banquetticket` SET transaction_time = :dt WHERE rqid = :rqid AND esun_payment_id = :ono');
	$dt = date('Y-m-d H:i:s');
	$stmt->bindParam(':rqid', $rqid);
	$stmt->bindParam(':ono', $ono);
	$stmt->bindParam(':dt', $dt);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}

function updateBanquetTickets($rqid, $ono){
	$conn = dbconnect();

	$stmt = $conn->prepare('SELECT amount from `banquetticket` WHERE rqid = :rqid AND esun_payment_id = :ono');
	$stmt->bindParam(':rqid', $rqid);
	$stmt->bindParam(':ono', $ono);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$amount = $stmt->fetchAll()[0]['amount'];

	$count = $amount / 2500;
	$stmt = $conn->prepare('UPDATE `orders` SET banquet_tickets = banquet_tickets + :count, amount = amount + :amount WHERE id = :rqid');
	$stmt->bindParam(':rqid', $rqid);
	$stmt->bindParam(':count', $count);
	$stmt->bindParam(':amount', $amount);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}

function inserMiscLog($rqid, $ono, $amount, $name, $descp, $email)
{
	$conn = dbconnect();
	$stmt = $conn->prepare("INSERT INTO `miscellaneous` (rqid, ono, amount, name, descp, email) VALUES (:rqid, :ono, :amount, :name, :descp, :email)");
	$stmt->bindParam(':rqid', $rqid);
	$stmt->bindParam(':ono', $ono);
	$stmt->bindParam(':amount', $amount);
	$stmt->bindParam(':name', $name);
	$stmt->bindParam(':descp', $descp);
	$stmt->bindParam(':email', $email);

	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}

function updateMiscLog($rqid, $ono)
{
	$conn = dbconnect();
	$stmt = $conn->prepare('UPDATE `miscellaneous` SET transaction_time = :dt WHERE rqid = :rqid AND ono = :ono');
	$dt = date('Y-m-d H:i:s');
	$stmt->bindParam(':rqid', $rqid);
	$stmt->bindParam(':ono', $ono);
	$stmt->bindParam(':dt', $dt);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}

function updateOrderAmount($rqid, $ono){
	$conn = dbconnect();

	$stmt = $conn->prepare('SELECT amount from `miscellaneous` WHERE rqid = :rqid AND ono = :ono');
	$stmt->bindParam(':rqid', $rqid);
	$stmt->bindParam(':ono', $ono);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$amount = $stmt->fetchAll()[0]['amount'];

	$stmt = $conn->prepare('UPDATE `orders` SET amount = amount + :amount WHERE id = :rqid');
	$stmt->bindParam(':rqid', $rqid);
	$stmt->bindParam(':amount', $amount);
	try{
		$stmt->execute();
	}
	catch(PDOException $e){
		echo $sql . "<br>" . $e->getMessage();
	}
}

function preparePostFields($array) {
  $params = array();

  foreach ($array as $key => $value) {
    $params[] = $key . '=' . urlencode($value);
  }

  return implode('&', $params);
}

?>

