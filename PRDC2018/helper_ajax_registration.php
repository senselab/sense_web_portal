<?php
header('Content-Type: application/json');
require_once 'include/registration_funcs.php';


$aResult = array();

if (!isset($_POST['func_name'])) {
	$aResult['error'] = 'No function name!';
}
else{
	$func = $_POST['func_name'];
}

if (!isset($_POST['func_args'])) {
	$aResult['error'] = 'No function arguments!';
}
else{
	$args = $_POST['func_args'];
}

if (!isset($aResult['error'])) {
	switch($func){
		case 'getPaymentStatus':
			if( !is_array($args) || (count($args) < 1) ) {
				$aResult['error'] = 'Error in arguments!';
			}
			else{
				$aResult['result'] = getPaymentStatus($args[0]);
			}
			break;

		default:
			$aResult['error'] = 'Not found function '.$func.'!';
			break;
	}
}

echo json_encode($aResult);


?>

