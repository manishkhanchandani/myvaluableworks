<?php
// Example 003
// Download Image (Binnary File)
// Copyright http://curl.phptrack.com

$url = "http://curl.phptrack.com/images/header.jpg"; // URL to Download Image

$ch = curl_init();	// Initialize a CURL session.     
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return stream contents.
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1); // We'll be returning this transfer, and the data is binary
$data = curl_exec($ch);  // // Grab the jpg and save the contents in the $data variable
curl_close($ch);  // close curl resource, and free up system resources.

// Set the header to type image/jpeg, since that's what we're
// displaying
header("Content-type: image/jpeg");
echo $data; // Print stream contents.

?>