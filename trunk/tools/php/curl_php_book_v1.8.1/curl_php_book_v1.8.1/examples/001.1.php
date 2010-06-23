<?php
// Example 001
// Simple Get Webpage
// Copyright http://curl.phptrack.com

//The curl_init() will initialize a new session and return a CURL handle.
//curl_exec($ch) This function should be called after you initialize a CURL session and all the options for the session are set. Its purpose is simply to execute the predefined CURL session (given by the ch). 
//curl_setopt( $ch, option, value) Set an option for a CURL session identified by the ch parameter. option specifies which option to set, and value specifies the value for the option given.

$url = "http://curl.phptrack.com/index.php"; // From URL to get webpage contents.

$ch = curl_init();	// Initialize a CURL session.     
// set URL and other appropriate options
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.

echo $result; // Print page contents.

?>