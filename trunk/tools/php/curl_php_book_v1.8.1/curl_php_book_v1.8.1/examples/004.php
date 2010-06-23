<?php
// Example 004
// Login to site where Dialog Box Open for Authentication
// Copyright http://curl.phptrack.com

$url = "http://curl.phptrack.com/login.php"; // URL to POST Login Data.
$post_fields = 'username:password'; // PopUp Dialog Login Fields.
// Do not remove the ":" sign between username and password.
$ch = curl_init();	// Initialize a CURL session.     
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
curl_setopt($ch, CURLOPT_ USERPWD, $post_fields);  // Dialog Box Authentication.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.

$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.

echo $result; // Print page contents.

?>