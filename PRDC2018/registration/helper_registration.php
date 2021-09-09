<?php
	require_once "include/registration_funcs.php";
	require_once "include/servername.php";
	if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']){
		// Form field checking
		if( !isset($_POST['reg_type']) ||
			!isset($_POST['title']) ||
			!isset($_POST['first']) ||
			!isset($_POST['last']) ||
			!isset($_POST['affiliation']) ||
			!isset($_POST['job']) ||
			!isset($_POST['email']) ||
			!isset($_POST['address1']) ||
			!isset($_POST['zipcode']) ||
			!isset($_POST['city']) ||
			!isset($_POST['country']) ||
			!isset($_POST['phone']) ||
			!isset($_POST['paper_id']) ||
			!isset($_POST['paper_title']) ||
			!isset($_POST['meal']) ||
			!isset($_POST['banquet_tickets']) ||
			!isset($_POST['payment_method']))
		{	
			header("Location: $prdc/registration2018.php?err=missing_form_field");
			exit();
		}
		else
		{
			// Check if IEEE member ID was provide if candidate is registering for IEEE member tickets.
			if(ieeeMemberNumRequired($_POST['reg_type']) && empty($_POST['member_num'])){
				header("Location: $prdc/registration2018.php?err=missing_ieee_mem_num");
				exit();;
			}

			$conn = dbconnect();
			// prepare sql and bind parameters
			$stmt = $conn->prepare("INSERT INTO orders(title, firstname, lastname, affiliation, email, reg_type, member_num, paper_id, paper_title, paper_type, paper_add_pages, department, job, address, address2, address3, zipcode, city, country, phone, mealtype, banquet_tickets, visa_nation, passport, place, issue, expiration, birth, amount, payment_method, paid, ref_token, created_at) VALUES(:title, :first, :last, :affiliation, :email, :reg_type, :member_num, :paper_id, :paper_title, :paper_type, :paper_add_pages, :department, :job, :address1, :address2, :address3, :zipcode, :city, :country, :phone, :meal, :banquet_tickets, :visa_nation, :passport, :place, :issue, :expiration, :birth, :amount, :payment_method, :paid, :ref_token, :timenow)");
			$stmt->bindParam(':title', $title);
			$stmt->bindParam(':first', $first);
			$stmt->bindParam(':last', $last);
			$stmt->bindParam(':affiliation', $affiliation);
			$stmt->bindParam(':email', $email);
			$stmt->bindParam(':reg_type', $reg_type);
			$stmt->bindParam(':member_num', $member_num);
			$stmt->bindParam(':paper_id', $paper_id);
			$stmt->bindParam(':paper_title', $paper_title);
			$stmt->bindParam(':paper_type', $paper_type);
			$stmt->bindParam(':paper_add_pages', $paper_add_pages);
			$stmt->bindParam(':department', $department);
			$stmt->bindParam(':job', $job);
			$stmt->bindParam(':address1', $address1);
			$stmt->bindParam(':address2', $address2);
			$stmt->bindParam(':address3', $address3);
			$stmt->bindParam(':zipcode', $zipcode);
			$stmt->bindParam(':city', $city);
			$stmt->bindParam(':country', $country);
			$stmt->bindParam(':phone', $phone);
			$stmt->bindParam(':meal', $meal);
			$stmt->bindParam(':banquet_tickets', $banquet_tickets);
			$stmt->bindParam(':visa_nation', $visa_nation);
			$stmt->bindParam(':passport', $passport);
			$stmt->bindParam(':place', $place);
			$stmt->bindParam(':issue', $issue);
			$stmt->bindParam(':expiration', $expiration);
			$stmt->bindParam(':birth', $birth);
			$stmt->bindParam(':payment_method', $payment_method);
			$stmt->bindParam(':paid', $paid);
			$stmt->bindParam(':ref_token', $ref_token);
			$stmt->bindParam(':timenow', $timenow);
			$stmt->bindParam(':amount', $amount);

			$title = $_POST["title"];
			$first = $_POST["first"];
			$last = $_POST["last"];
			$affiliation = $_POST["affiliation"];
			$email = $_POST["email"];
			$reg_type = $_POST["reg_type"];
			$member_num = $_POST["member_num"];
			$paper_id = $_POST["paper_id"];
			$paper_title = $_POST["paper_title"];
			$paper_type = $_POST["paper_types"];
			$paper_add_pages = $_POST["paper_pages"];
			$department = $_POST["department"];
			$job = $_POST["job"];
			$address1 = $_POST["address1"];
			$address2 = $_POST["address2"];
			$address3 = $_POST["address3"];
			$zipcode = $_POST["zipcode"];
			$city = $_POST["city"];
			$country = $_POST["country"];
			$phone = $_POST["phone"];
			$meal = $_POST["meal"];
			$banquet_tickets = $_POST["banquet_tickets"];
			$visa_nation = $_POST["visa_nation"];
			$passport = $_POST["passport"];
			$place = $_POST["place"];
			$issue = $_POST["issue"];
			$expiration = $_POST["expiration"];
			$birth = $_POST["birth"];
			$payment_method = $_POST["payment_method"];


			switch($reg_type){
				case 0: $amount = $OPT_REG_TYPE[0]['twd'];
						break;
				case 1: $amount = $OPT_REG_TYPE[1]['twd'];
						break;
				case 2: $amount = $OPT_REG_TYPE[2]['twd'];
						break;
				case 3: $amount = $OPT_REG_TYPE[3]['twd'];
						break;
				case 4: $amount = $OPT_REG_TYPE[4]['twd'];
						break;
				case 5: $amount = $OPT_REG_TYPE[5]['twd'];
						break;
				case 6: $amount = $OPT_REG_TYPE[6]['twd'];
						break;
				case 7: $amount = $OPT_REG_TYPE[7]['twd'];
						break;
				case 8: $amount = $OPT_REG_TYPE[8]['twd'];
						break;
				case 9: $amount = $OPT_REG_TYPE[9]['twd'];
						break;
				default:
						break;
			}
			
			$amount += $paper_add_pages * 3200;
				
			$amount += (2500 * $banquet_tickets);
			$paid = 0;
			$ref_token = genRefToken();
			if(empty($ref_token)){
				header("Location: $prdc/registration2018.php?err=reftoken&msg=fail_to_create_reftoken, please retry...");
				exit();
			}

			$timenow = null;

			try {
				$amount = $amount;
				$stmt->execute();
				$last_id = $conn->lastInsertId();

				// send registration mail
				sendRegMail($first . " " . $last , $email, $ref_token, $payment_method);
			}
			catch(PDOException $e){
				echo "<h3>Unhandled situation</h3>";
				echo "Ops, bug appear... :( <br/><br/>";
				echo $sql . "<br>" . $e->getMessage();
				echo "<br/><br/>We would be appreciate if you could report this bug to us at prdc2018_registration<at>cs.nctu.edu.tw :)</br>";
				echo "Sorry for causing any inconvenience, please retry and check if the bugs still remained";
			}

		}
	}
	else{
		// redirect user to registration if incoming request isn't post request
		header("Location: $prdc/registration2018.php");
	}
?>




