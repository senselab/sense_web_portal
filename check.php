<?php

$rip= $_SERVER['REMOTE_ADDR'];
$host = gethostbyaddr($rip);
$show_page = False;

$allowed_domain = array(".edu.tw", ".edu", ".nchc.org.tw", ".itri.org.tw" );

function countryCityFromIP($ipAddr)
{
	//function to find country and city from IP address
	//Developed by Roshan Bhattarai http://roshanbh.com.np
	
	//verify the IP address for the
	ip2long($ipAddr)== -1 || ip2long($ipAddr) === false ? trigger_error("Invalid IP", E_USER_ERROR) : "";
	$ipDetail=array(); //initialize a blank array
	
	//get the XML result from hostip.info
	$xml = file_get_contents("http://api.hostip.info/?ip=".$ipAddr);
	
	
	
	//get the country name inside the node <countryName> and </countryName>
	preg_match("@<countryName>(.*?)</countryName>@si",$xml,$matches);
	
	//assign the country name to the $ipDetail array
	$ipDetail['country']=$matches[1];
	
	//get the country name inside the node <countryName> and </countryName>
	preg_match("@<countryAbbrev>(.*?)</countryAbbrev>@si",$xml,$cc_match);
	$ipDetail['country_code']=$cc_match[1]; //assing the country code to array
	
	//return the array containing city, country and country code
	
	if ( strspn($ipDetail['country_code'],"ABCDEFGHIJKLMNOPQRSTUVWXYZ") != 2) {
		TRIGGER_ERROR("invalid code", E_USER_ERROR);
		die();
	}
	
	
	
	return $ipDetail;

}


if (!strncmp($rip,"140.11",6) ) {
	$show_page=True;
}
else {
	
	$r_host = strrev($host);
	
	for ($i=0; $i < count($allowed_domain); $i++) {
		
		$r_allow = strrev($allowed_domain[$i]);
		
		if( !strncmp($r_host, $r_allow,strlen($r_allow)) ) {
			$show_page=True;
			break;
		}
	}
	
	$ipDetail = countryCityFromIP($rip);
	
	$handle = @fopen("allowed_country.txt", "r");

	if ($handle) {
	    while (!feof($handle)) {
	        $buffer = fgets($handle, 4096);
	        $cc = strtok( $buffer, " \n\r\t");
	        
	        if (strspn($cc,"ABCDEFGHIJKLMNOPQRSTUVWXYZ")==2) {
							if ( !strcmp($ipDetail['country_code'], $cc) ) {
								$show_page = True;
								break;
							}

	        }
	    }
	    fclose($handle);
	}

	

		
}

?>