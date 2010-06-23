<?php
// Example 005
// Pass Refferal to the Target Site. This insure that request is from this site.
// Copyright http://curl.phptrack.com

$url = "http://curl.phptrack.com/login.php"; // URL
$reffer = "http://curl.phptrack.com/index.php"; // Refferal site

$ch = curl_init();	// Initialize a CURL session.     
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
curl_setopt($ch, CURLOPT_REFERER, $reffer); // Refferal site Setting.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.

$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.

echo $result; // Print page contents.

?>