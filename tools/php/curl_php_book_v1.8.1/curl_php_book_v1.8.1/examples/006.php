<?php
// Example 006
// Pass User Agent to the Target Site. This insure that request is from which Browser and Operating System.
// Copyright http://curl.phptrack.com

$url = "http://curl.phptrack.com/login.php"; // URL to POST Login Data.
$agent = "Mozilla/4.0 (compatible; MSIE 5.01; Windows NT 5.0)"; //Agent Setting for Internet Explorer
$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)"; //Agent Setting for Netscape

$ch = curl_init();	// Initialize a CURL session.     
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
curl_setopt($ch, CURLOPT_USERAGENT, $agent); // Agent Setting.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.

$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.

echo $result; // Print page contents.

?>