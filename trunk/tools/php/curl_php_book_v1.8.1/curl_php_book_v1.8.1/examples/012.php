<?php
// Example 012
//We will process the Credit Card Transaction.
//PREAUTH of Credit Card.
// Copyright http://curl.phptrack.com
/////////////////////////////////////////////////////////////////////////////
function curl_process($data)
{	
	// set up transaction variables
	$debugging = 0;
	$key	= $data["keyfile"];
	$xml	= $data["xml"];
	$url	= $data["host"] .':'. $data['port'];
			
	$ch = curl_init ();
	curl_setopt ($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HEADER, 1); 
	curl_setopt ($ch, CURLOPT_POST, 1); 
	curl_setopt ($ch, CURLOPT_POSTFIELDS, $xml);
	curl_setopt ($ch, CURLOPT_SSLCERT, $key);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

	if ($debugging)
		curl_setopt ($ch, CURLOPT_VERBOSE, 1);

	#  use curl to send the xml SSL string
	$result = curl_exec ($ch);			
	curl_close($ch);
	return $result;
}	
///////////////////////////////////////////////////////////////////////////////////

// This XML String vary from Credit Card Processing company to company.
// Please your Read your Credit Card Processing company Manual.
$xml ="
		<order>
			<orderoptions>
				<result>GOOD</result>
				<ordertype>PREAUTH</ordertype>
			</orderoptions>
			<merchantinfo>
				<configfile>888999</configfile>
			</merchantinfo>
			<creditcard>
				<cardnumber>4111111111111111</cardnumber>
				<cardexpmonth>07</cardexpmonth>
				<cardexpyear>2006</cardexpyear>
				<cvmvalue>548</cvmvalue>
				<cvmindicator>provided</cvmindicator>						  
			</creditcard>
			<payment>
				<chargetotal>1</chargetotal>
			</payment>
			<transactiondetails>
				<oid>CODE1001</oid>
				<ponumber>web</ponumber>				
			</transactiondetails>
			<billing>
				<name>Muhammad Imran</name>
				<address1>4673 Blue Street</address1>
				<city>Los Angeles</city>
				<state>CA</state>
				<zip>90016</zip>
				<country>US</country>
				<phone>7135566443</phone>
				<email>test@mail.com</email>
				<addrnum>4673</addrnum>									
			</billing>		
			<notes>
				<comments>Shopping on web.</comments>
			</notes>
		</order>";

$myorder["host"]      = "secure.your_merchant_server.net"; 
$myorder["port"]      = "1027";
$myorder["keyfile"]   = "c:/inetpub/wwwroot/yoursite_path/certificate.pem"; 
$myorder["xml"]       = $xml;

$result = curl_process($myorder);  # use curl methods
print $result;

?>