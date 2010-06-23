<?php
// fedex_register.php
// Register XML API request on Fedex Server
// http://curl.phptrack.com 
// Copyright imran@phptrack.com 
// set your AccountNumber 312397xxx
// set your account info etc.

set_time_limit(0);
	
	$xml = '<?xml version="1.0" encoding="UTF-8" ?>
<FDXSubscriptionRequest xmlns:api="http://www.fedex.com/fsmapi" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="FDXSubscriptionRequest.xsd">
<RequestHeader>
<CustomerTransactionIdentifier>String</CustomerTransactionIdentifier>
<AccountNumber>312397xxx</AccountNumber>
</RequestHeader>
<Contact>
<PersonName>Imran Khalid</PersonName>
<CompanyName>PHP computers</CompanyName>
<Department>IT</Department>
<PhoneNumber>8006117725</PhoneNumber>
<PagerNumber>4595746241</PagerNumber>
<FaxNumber>4655750245</FaxNumber>
<E-MailAddress>info@phptrack.com</E-MailAddress>
</Contact>
<Address>
<Line1>318 S</Line1>
<Line2>INTERSTATE 55E</Line2>
<City>CARROLLTON</City>
<StateOrProvinceCode>TX</StateOrProvinceCode>
<PostalCode>75006</PostalCode>
<CountryCode>US</CountryCode>
</Address>
</FDXSubscriptionRequest>';					

	$LOGINURL = "https://gatewaybeta.fedex.com:443/GatewayDC";
	$cookie_file_path = "C:/Inetpub/wwwroot/sept2005/phptrack/curl/forum_help_codes/hotmail/cookie.php"; 
	// Please set your Cookie File path
	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
    $reffer = "https://gatewaybeta.fedex.com";
	
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$LOGINURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$xml); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
    curl_close ($ch); 
	$result = str_replace('><',">\r\n<",$result);
	echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	


?>