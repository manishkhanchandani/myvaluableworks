<?php
// Example reg006.php
// Simple Regular Expressions in PHP
// Copyright http://curl.phptrack.com
// This example will match a string string with 
// some text and ending with some text

//starting from = <input type="hidden" name="__VIEWSTATE" value="
// ending with = "

$str = '
		<html>
		goes some txt etc <b>some thsm tags</b>etc
		and here is the price $25.66 of tie tem
		<input type="hidden" name="__VIEWSTATE" value="55555">
		goes some txt etc <b>some thsm tags</b>etc
		</html>
';

preg_match_all("/input type=\"hidden\" name=\"__VIEWSTATE\" value=\".*?\"/i",$str,$out);
//print_r($out);

$viewstate=str_replace("input type=\"hidden\" name=\"__VIEWSTATE\" value=\"", "", $out[0][0]);
$viewstate=trim($viewstate,'"');
print $viewstate;
?>