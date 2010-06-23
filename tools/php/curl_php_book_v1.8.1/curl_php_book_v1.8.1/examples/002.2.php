<?php
// Example 002.2
// Pass form Variables as method = POST
// Copyright http://curl.phptrack.com

$url = "http://curl.phptrack.com/subscribe.php"; // URL to POST FORM. (Action of Form)
// use PHP Fucntion url_encode() for post variable for application/x-www-form-urlencoded 
$post_fields = 'fuseaction=forum&name=imran%20khalid&age=30&press=OK'; // form Fields.

$ch = curl_init();	// Initialize a CURL session.     
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
curl_setopt($ch, CURLOPT_POST, 1); // use this option to Post a form
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); // Pass form Fields.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.

$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.

echo $result; // Print page contents.

?>