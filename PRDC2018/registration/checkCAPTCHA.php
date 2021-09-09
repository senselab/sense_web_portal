<?php	
	header('Access-Control-Allow-Origin: *');
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
	header('Access-Control-Allow-Headers: X-Requested-With, Content-Type, Accept');
	require_once "libs/securimage/securimage.php";
	if(isset($_SERVER['REQUEST_METHOD']) && 'POST' == $_SERVER['REQUEST_METHOD']){
		$image = new Securimage();
	    if ($image->check($_POST['captcha_code']) == false) {
			echo "false";
			return;
	    }
	    echo "true";
	    return;
	}
?>