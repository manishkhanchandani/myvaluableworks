<?php
// Example reg001.php
// Simple Regular Expressions in PHP
// Copyright http://curl.phptrack.com
// Match some sub text inside a text string.

// Example string
$str = "Let's find the Name :<B>Muhammad Imran</B> <table> some table</table>and some fonts tags of </html>";

// Let's perform the regex
$flag = preg_match("/<B>(.*)<\/B>/", $str, $matches);

// Check if regex was successful
if ($flag = true) {
	// Matched something, show the matched string
	echo htmlentities($matches['0']);

	// Also how the text in between the tags
	echo '<br />' . $matches['1'];
} else {
	// No Match
	echo "Couldn't find a match";
}

?>