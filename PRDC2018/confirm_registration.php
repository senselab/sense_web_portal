<?php
	include "common.php";
	include "include/registration_funcs.php";
?><!DOCTYPE html>
<html lang="en">
<head>
<?php	include "include/header.html"; ?>
<title>DSC17 - IEEE Conference on Dependable and Secure Computing 2017</title>
</head>
<body>

<?php	include "include/topnav.html"; ?>

<!--main-->
<div class="container">
	<div class="row">
	</br>
	<button id="downloadConfirmedCsv" class="btn btn-primary">
		Export Confirmed Order CSV
	</button>
	<button id="downloadPendingCsv" class="btn btn-primary">
		Export Pending Order CSV
	</button>
	</br>
		<?php
			global $OPT_REG_TYPE;

			if ( !allow_to_visit($_SERVER['REMOTE_ADDR']) ){
				header("Location: registration.php?err=&msg=You have no permission to visit the page!");
			}

			if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']){
				if ( isset($_POST["action"]) && isset($_POST['order_id']) ){
					if ( "confirmed" == $_POST["action"] ) {
						confirmedPayment($_POST['order_id']);
					}
					else if ( "unconfirmed" == $_POST["action"] ){
						unconfirmedPayment($_POST['order_id']);
					}
				}

			}

			$conn = dbconnect();
			$sql_cc_confirmed = "SELECT * FROM `orders` WHERE `payment_confirmed`=1 and `invalid`=0 ORDER BY `paid` DESC, ABS(`paper_id`) ASC, `payment_method` ASC";
			$sql_cc_unconfirmed = "SELECT * FROM `orders` WHERE `payment_confirmed`=0 and `invalid`=0 ORDER BY `paid` DESC, ABS(`paper_id`) ASC, `payment_method` ASC";

			$stmt_cc_confirmed = $conn->prepare($sql_cc_confirmed);
			$stmt_cc_unconfirmed = $conn->prepare($sql_cc_unconfirmed);

			try{
				$stmt_cc_confirmed->execute();
			}
			catch(PDOException $e){
				// echo $sql_cc_confirmed . "<br>" . $e->getMessage();
			}

			try{
				$stmt_cc_unconfirmed->execute();
			}
			catch(PDOException $e){
				// echo $sql_cc_unconfirmed . "<br>" . $e->getMessage();
			}

			$stmt_cc_confirmed->setFetchMode(PDO::FETCH_ASSOC);
			$stmt_cc_unconfirmed->setFetchMode(PDO::FETCH_ASSOC);
			$confirmed_orders = $stmt_cc_confirmed->fetchAll();
			$unconfirmed_orders = $stmt_cc_unconfirmed->fetchAll();
			$confirmed_paid_amount = 0;
			$confirmed_pending_amount = 0;
			$unconfirmed_paid_amount = 0;
			$unconfirmed_pending_amount = 0;

			$renderHtml = <<<EOF
			<div id="credit_card_status">
				<h2>Confirmed orders</h2>
				<table id="cc_confirmed_table" class="table table-hover">
				<thead><tr>
					<th>#</th>
					<th>Name</th>
					<th>Order num</th>
					<th>Reg Type</th>
					<th>Paper ID</th>
					<th>Banquet#</th>
					<th>Amount</th>
					<th>Payment Method</th>
					<th>Status</th>
					<th>Transaction ID</th>
					<th>Transaction Time</th>
					<th>Remark</th>
					<th></th>
				</tr></thead>
EOF;
			// ----- confirmed's list -----
			foreach($confirmed_orders as $__idx=>$order){
				$idx = $__idx+1;
				$orderid = $order['id'];
				$name = $order['name'];
				$reftoken = $order['ref_token'];
				$reg_type = $OPT_REG_TYPE[$order['reg_type']]['desc'];
				$paper_id = $order['paper_id'];
				$banquet = $order['banquet_tickets'];
				$amount = $order['amount'];
				$payment_method = ($order['payment_method'] == 0) ? "Card" : ($order['payment_method'] == 1 ? "Bank" : "Error");
				$status = ($order['paid'] == 0 ) ? "Pending" : ( $order['paid'] == 1 ? "Paid" : "Cancelled" );
				$trans_id = $order['esun_payment_id'];
				$trans_time = $order['transaction_time'];
				$remark = $order['remark'];

				$title = $OPT_TITLE[$order['title']];
				$affiliation = $order['affiliation'];
				$email = $order['email'];
				$member_id = $order['member_num'];
				$paper_title = $order['paper_title'];

				if("Paid" == $status)
					$confirmed_paid_amount += $amount;
				else if("Pending" == $status)
					$confirmed_pending_amount += $amount;

				$renderHtml .= <<<EOF
				<p><tr>
					<td>$idx</td>
					<td style="display: none">$title</td>
					<td>$name</td>
					<td style="display: none">$affiliation</td>
					<td style="display: none">$email</td>
					<td>#$reftoken</td>
					<td>$reg_type</td>
					<td style="display: none">$member_id</td>
					<td>$paper_id</td>
					<td style="display: none">$paper_title</td>
					<td>$banquet</td>
					<td>$amount</td>
					<td>$payment_method</td>
					<td>$status</td>
					<td>$trans_id</td>
					<td>$trans_time</td>
					<td>$remark</td>
					<td>
						<form method="post" id="form_$orderid">
							<input type="hidden" name="order_id" value="$orderid"/>
							<input type="hidden" name="action" value="unconfirmed"/>
						</form>
						<button data-orderid="$orderid" class="btn btn-danger unconfirm">unconfirm</button>
					</td>
				</tr></p>
EOF;
			}
			$renderHtml .= <<<EOF
				</table>

				<h3>Total confirmed Paid Amount: $confirmed_paid_amount</h3>
				<h3>Total confirmed Pending Amount: $confirmed_pending_amount</h3>

				<h2>Pending for confirmation orders</h2>
				<table id="cc_unconfirmed_table" class="table table-hover">
				<thead><tr>
					<th>#</th>
					<th>Name</th>
					<th>Order num</th>
					<th>Reg Type</th>
					<th>Paper ID</th>
					<th>Banquet#</th>
					<th>Amount</th>
					<th>Payment Method</th>
					<th>Status</th>
					<th>Transaction ID</th>
					<th>Transaction Time</th>
					<th>Remark</th>
					<th></th>
				</tr></thead>
EOF;
			// ----- unconfirmed list -----
			foreach($unconfirmed_orders as $__idx=>$order){
				$idx = $__idx+1;
				$orderid = $order['id'];
				$name = $order['name'];
				$reftoken = $order['ref_token'];
				$reg_type = $OPT_REG_TYPE[$order['reg_type']]['desc'];
				$paper_id = $order['paper_id'];
				$banquet = $order['banquet_tickets'];
				$amount = $order['amount'];
				$payment_method = ($order['payment_method'] == 0) ? "Card" : ($order['payment_method'] == 1 ? "Bank" : "Error");
				$status = ($order['paid'] == 0 ) ? "Pending" : ( $order['paid'] == 1 ? "Paid" : "Cancelled" );
				$trans_id = $order['esun_payment_id'];
				$trans_time = $order['transaction_time'];
				$remark = $order['remark'];

				$title = $OPT_TITLE[$order['title']];
				$affiliation = $order['affiliation'];
				$email = $order['email'];
				$member_id = $order['member_num'];
				$paper_title = $order['paper_title'];

				if("Paid" == $status)
					$unconfirmed_paid_amount += $amount;
				else if("Pending" == $status)
					$unconfirmed_pending_amount += $amount;

				$renderHtml .= <<<EOF
				<p><tr id="tr_$orderid">
					<td>$idx</td>
					<td style="display: none">$title</td>
					<td>$name</td>
					<td style="display: none">$affiliation</td>
					<td style="display: none">$email</td>
					<td>#$reftoken</td>
					<td>$reg_type</td>
					<td style="display: none">$member_id</td>
					<td>$paper_id</td>
					<td style="display: none">$paper_title</td>
					<td>$banquet</td>
					<td>$amount</td>
					<td>$payment_method</td>
					<td>$status</td>
					<td>$trans_id</td>
					<td>$trans_time</td>
					<td>$remark</td>
					<td>
						<form method="post" id="form_$orderid">
							<input type="hidden" name="order_id" value="$orderid"/>
							<input type="hidden" name="action" value="confirmed"/>
						</form>
						<button data-orderid="$orderid"class="btn btn-success confirm">confirm</button>
					</td>
				</tr></p>

EOF;
			}
			$renderHtml .= <<<EOF
				</table>
				<h3>Total unconfirmed Paid Amount: $unconfirmed_paid_amount</h3>
				<h3>Total unconfirmed Pending Amount: $unconfirmed_pending_amount</h3>
			</div>	<!-- close credit card tab -->
EOF;

			print($renderHtml);

		?>
		<div class="modal fade" id="myModal" role="dialog">
			<div class="modal-dialog">

				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-body" style="padding:40px 50px;">
						<form role="form">
							<input type="hidden" id="targetForm">
							<div class="form-group">
								<label for="psw">Passcode</label>
								<input type="text" class="form-control" id="unconfirm_passcode" placeholder="Enter passcode">
							</div>
						</form>
						<button class="btn btn-danger btn-block" id="unconfirm_btn">Yes, I want to unconfirm entry!</button>
					</div>
				</div>
			</div>
		</div>
		<?php include "include/footer.html"; ?>
	</div><!--/row-->
</div><!--/container-->
<?php	include "include/script.html"; ?>
<script type="text/javascript">
	var keys = ["#", "Title", "Name", "Affiliation", "Email", "Order num", "Reg Type", "Member Num", "Paper ID", "Paper Title", "Banquet#", "Amount", "Payment Method", "Status", "Transaction ID", "Transaction Time", "Remark"];
	var confirmedCsv = [];
	confirmedCsv.push(keys);

	$('#cc_confirmed_table tr').each(function() {
		var entry = [];
		var fields = $(this).find('td');
		if (fields.length > 0){
			fields.slice(0, 17).each(function(){ entry.push($(this).text()); });
			confirmedCsv.push(entry);
		}
	});

	var pendingCsv = [];
	pendingCsv.push(keys);
	$('#cc_unconfirmed_table tr').each(function() {
		var entry = [];
		var fields = $(this).find('td');
		if (fields.length > 0){
			fields.slice(0, 17).each(function(){ entry.push($(this).text()); });
			pendingCsv.push(entry);
		}
	});

    function convertArrayOfObjectsToCSV(args) {
        var result, ctr, keys, columnDelimiter, lineDelimiter, data;

        data = args.data || null;
        if (data == null || !data.length) {
            return null;
        }

        columnDelimiter = args.columnDelimiter || ',';
        lineDelimiter = args.lineDelimiter || '\n';

        keys = Object.keys(data[0]);

        result = '';

        data.forEach(function(item) {
            ctr = 0;
            keys.forEach(function(key) {
                if (ctr > 0) result += columnDelimiter;

                result = result + '"' + item[key] + '"';
                ctr++;
            });
            result += lineDelimiter;
        });

        return result;
    }

    window.downloadCSV = function(args) {
        var data, filename, link;

        var csv = convertArrayOfObjectsToCSV({
            data: args.data_array
        });
        if (csv == null) return;

        filename = args.filename || 'export.csv';

        if (!csv.match(/^data:text\/csv/i)) {
            csv = 'data:text/csv;charset=utf-8,' + csv;
        }
        data = encodeURI(csv);

        link = document.createElement('a');
        link.setAttribute('href', data);
        link.setAttribute('download', filename);
        link.click();
    }

	$('#downloadConfirmedCsv').click(function(){
		downloadCSV({ filename: "confirmed_order.csv", data_array: confirmedCsv });
	});

	$('#downloadPendingCsv').click(function(){
		downloadCSV({ filename: "pending_order.csv", data_array: pendingCsv });
	});

</script>
</body>
</html>
