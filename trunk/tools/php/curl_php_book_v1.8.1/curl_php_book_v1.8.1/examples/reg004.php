<?php
// Example reg004.php
// Simple Regular Expressions in PHP
// Copyright http://curl.phptrack.com
// Match some text inside a text string and 
//replace it with new string and also add the old string in result.

// Example string
$str = "We want to change amount $<h3>25.09</h3> of the item";

// Do the preg replace
$result = preg_replace ("/<h3>(.*)<\/h3>/", "<h3>new Price 20.36 (the old: $1)</h3>", $str);

echo htmlentities($result);
?>