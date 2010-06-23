<?php
// Example custom_header.php
// Get Secure Page from www.neteller.com
// With Custom Header. 
// Copyright http://curl.phptrack.com 

   $cookie_file_path = "C:/Inetpub/wwwroot/07feb2005/phptrack/curl/cookie.txt"; 
   $url = 'http://www.neteller.com/ab/';
   $reffer = 'http://www.neteller.com';

	$header_array[0] = "GET /ab/ HTTP/1.1";
	$header_array[1]= "User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
	$header_array[2]= "Host: www.neteller.com";
	$header_array[3]= "Accept: text/xml,application/xml,application/xhtml+xml,text/html;q=0.9,text/plain;q=0.8,video/x-mng,image/png,image/jpeg,image/gif;q=0.2,*/*;q=0.1";
	$header_array[4]= "Accept-Language: en-us,en;q=0.5";
	$header_array[5]= "Accept-Encoding: gzip,deflate";
	$header_array[6]= "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7";
	$header_array[7]= "Keep-Alive: 300";		
	$header_array[8] = "Connection: Close"; 
   
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header_array); 
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
    curl_close ($ch);
	print $result;
 
?>

