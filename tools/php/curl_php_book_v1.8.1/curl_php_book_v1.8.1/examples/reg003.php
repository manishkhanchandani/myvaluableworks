<?php
// Example reg003.php
// Simple Regular Expressions in PHP
// Copyright http://curl.phptrack.com
// Match some text and replace it with a new string.

// Example string
$str = "We want to change amount $<h3>25.09</h3> of the item";

// Perform the preg replace
$result = preg_replace ("/<h3>(.*)<\/h3>/", '<h4>20.36</h4>', $str);

echo htmlentities($result);
?>