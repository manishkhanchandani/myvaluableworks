<?php
// http://curl.phptrack.com
// PHP/CURL FTP delete a remote file
// Copyright imran@phptrack.com

$ftp_url = "ftp://id:password@phptrack.com/public_html/curl/examples/";

// this will delete file "dest.jpg" from ftp path "/public_html/curl/examples"
// please change your path/file name correctly.

$file_path = '/public_html/curl/examples';
$file_name = 'dest.jpg';

$POSTFIELDS[0]= 'CWD '.$file_path;
$POSTFIELDS[1]= 'DELE '.$file_name;

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $ftp_url);
curl_setopt($ch, CURLOPT_POSTQUOTE,$POSTFIELDS);
$result = curl_exec ($ch);
curl_close ($ch);
print $result;

?>

