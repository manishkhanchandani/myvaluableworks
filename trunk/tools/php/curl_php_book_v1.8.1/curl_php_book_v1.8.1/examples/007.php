<?php
// Example 007
// Redirect Page where Sever transfer control after login varifaction etc.
// if this option is not provided then this will not go to welcome page.
// Copyright http://curl.phptrack.com

$url = "http://curl.phptrack.com/login.php"; // URL

$ch = curl_init();	// Initialize a CURL session.     
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); // Redirect to page where its goes after login.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.

$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.

echo $result; // Print page contents.

?>