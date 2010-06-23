<?php
// Example reg007.php
// Simple Regular Expressions in PHP
// Copyright http://curl.phptrack.com
//Below Code also give me the Pretty good output for
// parsing the images links from html strings.

$str = '<P>Maximum runnSpeed: 2000 1/6 </P>
	<br clear="all">
	<a name="image_1"></a>
	<img src="/i/lkee_FR._ANGLE.jpg">
	<p>
	<p>
	<br clear="all">
	<img src="/i/50__TOP__BESTBUY.jpg">
	</div>
	<p>
	</body></html> ';
preg_match_all('/<img src="\/i\/[^"]+"/i', $str, $matches);
echo "<pre>"; print_r ($matches[0]); echo "</pre>";

$str = '<P>Maximum runnSpeed: 2000 1/6 </P>
	<br clear="all">
	<a name="image_1"></a>
	<img src="/i/lkee_FR._ANGLE.jpg">
	<p>
	<p>
	<br clear="all">
	<img src="/i/50__TOP__BESTBUY.jpg">
	</div>
	<p>
	</body></html> ';
preg_match_all("#<img.*?src=\"?([^\s>\"]+)[^>]+?>#is", $str, $matches);
echo "<pre>"; print_r ($matches); echo "</pre>";

/*
=======
OUTPUT
=======
<pre>Array
(
[0] => Array
(
[0] => <img src="/i/lkee_FR._ANGLE.jpg">
[1] => <img src="/i/50__TOP__BESTBUY.jpg">
)

[1] => Array
(
[0] => /i/lkee_FR._ANGLE.jpg
[1] => /i/50__TOP__BESTBUY.jpg
)

)
</pre>
*/
?>