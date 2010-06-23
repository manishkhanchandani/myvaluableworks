<?php
// Example 002.1
// Pass Form Variables as method = GET
// Copyright http://curl.phptrack.com

$domain = "http://curl.phptrack.com/"; // URL to POST FORM.
$post_fields = 'get_page.php?fuseaction=forum&name=imran&age=30&press=OK';
$url = $domain . $post_fields;

$ch = curl_init();	// Initialize a CURL session.     
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);  // Return Page contents.
curl_setopt($ch, CURLOPT_URL, $url);  // Pass URL as parameter.
$result = curl_exec($ch);  // grab URL and pass it to the variable.
curl_close($ch);  // close curl resource, and free up system resources.

echo $result; // Print page contents.

?>