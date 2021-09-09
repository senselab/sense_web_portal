<?php
	require_once "include/registration_funcs.php";

	if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']){

		// Form field checking
		if( !isset($_POST['title']) ||
			!isset($_POST['name']) ||
			!isset($_POST['affiliation']) ||
			!isset($_POST['email']) ||
			!isset($_POST['reg_type']) ||
			!isset($_POST['member_num']) ||
			!isset($_POST['paper_id']) ||
			!isset($_POST['paper_title']) ||
			!isset($_POST['banquet_tickets']) ||
			!isset($_POST['payment_method']))
		{
			header("Location: registration.php?err=missing_form_field");
			exit();
		}
		else
		{
			// Check if IEEE member ID was provide if candidate is registering for IEEE member tickets.
			if(ieeeMemberNumRequired($_POST['reg_type']) && empty($_POST['member_num'])){
				header("Location: registration.php?err=missing_ieee_mem_num");
				exit();;
			}

			$conn = dbconnect();
			// prepare sql and bind parameters
			$stmt = $conn->prepare("INSERT INTO orders(title, name, affiliation, email, reg_type, member_num, paper_id, paper_title, banquet_tickets, amount, payment_method, paid, ref_token, created_at) VALUES(:title, :name, :affiliation, :email, :reg_type, :member_num, :paper_id, :paper_title, :banquet_tickets, :amount, :payment_method, :paid, :ref_token, :timenow)");
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':name', $name);
			$stmt->bindParam(':affiliation', $affiliation);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':reg_type', $reg_type);
			$stmt->bindParam(':member_num', $member_num);
			$stmt->bindParam(':paper_id', $paper_id);
			$stmt->bindParam(':paper_title', $paper_title);
			$stmt->bindParam(':banquet_tickets', $banquet_tickets);
			$stmt->bindParam(':amount', $amount);
			$stmt->bindParam(':payment_method', $payment_method);
			$stmt->bindParam(':paid', $paid);
			$stmt->bindParam(':ref_token', $ref_token);
			$stmt->bindParam(':timenow', $timenow);

			$title = $_POST["title"];
			$name = $_POST["name"];
			$affiliation = $_POST["affiliation"];
			$email = $_POST["email"];
			$reg_type = $_POST["reg_type"];
			$member_num = $_POST["member_num"];
			$paper_id = $_POST["paper_id"];
			$paper_title = $_POST["paper_title"];
			$banquet_tickets = $_POST["banquet_tickets"];
			switch($reg_type){
				case 0: $amount = 17000;
						break;
				case 1: $amount = 21500;
						break;
				case 2: $amount = 7500;
						break;
				case 3: $amount = 10500;
						break;
				case 4: $amount = 20000;
						break;
				case 5: $amount = 24500;
						break;
				case 6: $amount = 10500;
						break;
				case 7: $amount = 12000;
						break;
				default:
						break;
			}
			$amount += (2500 * $banquet_tickets);
			$payment_method = $_POST["payment_method"];
			$paid = 0;
			$ref_token = genRefToken();
			if(empty($ref_token)){
				header("Location: registration.php?err=reftoken&msg=fail_to_create_reftoken, please retry...");
				exit();
			}

			$timenow = null;

			try {
				$stmt->execute();;
				$last_id = $conn->lastInsertId();

				// send registration mail
				sendRegMail($name, $email, $ref_token, $payment_method);
			}
			catch(PDOException $e){
				echo "<h3>Unhandled situation</h3>";
				echo "Ops, bug appear... :( <br/><br/>";
				echo $sql . "<br>" . $e->getMessage();
				echo "<br/><br/>We would be appreciate if you could report this bug to us at dsc17<at>cs.nctu.edu.tw :)</br>";
				echo "Sorry for causing any inconvenience, please retry and check if the bugs still remained";
			}

		}
	}
	else{
		// redirect user to registration if incoming request isn't post request
		header("Location: registration.php");
	}
?>
