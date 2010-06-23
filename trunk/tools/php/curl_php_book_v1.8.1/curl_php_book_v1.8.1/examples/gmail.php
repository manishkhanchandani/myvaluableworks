<?php
set_time_limit(0);
/*
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'   File:	                gmail.php
'
'   Description:            This script Login you on http://mail.google.com website with SSL using cURL/PHP.
'
'   Written by:             Imran Khalid info@phptrack.com
'
'   Languages:              PHP + CURL
'
'   Date Written:           April 18,2006/ May 27, 2006
'
'   Version:            	V.1.1
'
'   Platform:               Windows 2000 / IIS / Netscape 7.1
'
'   Copyright:              http://curl.phptrack.com
'
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
*/	

if($_POST['login'])
{
	$php_userid = rawurlencode($_POST['login']);
	$php_password = rawurlencode($_POST['passwd']);
	
	$cookie_file_path = "C:\Inetpub\wwwroot\sept2005\phptrack\curl\forum_help_codes\cookie.txt"; // Please set your Cookie File path
	$cookie_file_path = "/home/public_html/curl/cookie.txt"; // Please set your Cookie File path
		
	$fp = fopen($cookie_file_path,'wb');	
	fclose($fp);
	
	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7";
    $reffer = "http://mail.google.com/mail/";
		
//1. Get first login page to parse hash_u,hash_challenge

	$LOGINURL = "http://mail.google.com/mail/";	
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$LOGINURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
//echo $result;
    curl_close ($ch);		
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	
	$POSTFIELDS = "ltmpl=yj_blanco&ltmplcache=2&continue=http%3A%2F%2Fmail.google.com%2Fmail%3F&service=mail&rm=false&ltmpl=yj_blanco&hl=en&Email=".$php_userid."&Passwd=".$php_password."&rmShown=1&null=Sign+in";

	// 2- Post Login Data to Page https://login.hot.com/config/login?
	
	$LOGINURL = "https://www.google.com/accounts/ServiceLoginAuth";
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$LOGINURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$POSTFIELDS); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
    ////echo $result;
	curl_close ($ch); 
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	

	preg_match_all("/url=(.*?)\"/", $result, $arr_post);	
	$url_login = $arr_post[1][0];
	//print "\r\n<br>".$url_login;

	//print "\r\n<br>".$PPFT;	

	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,"https://www.google.com/accounts/CheckCookie?continue=http%3A%2F%2Fmail.google.com%2Fmail%3F&service=mail&hl=en&chtml=LoginDoneHtml");
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
   //echo "cookie" . $result;
    curl_close ($ch); 

// 2- Post Login Data to Page https://login.hot.com/config/login?
	$LOGINURL = $url_login;
	
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$LOGINURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
	//echo $result;
    curl_close ($ch); 
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	
	preg_match_all("/loading&amp;ver=(.*?)\"/", $result, $arr_post);	
	$url_login = $arr_post[1][0];
	
	$url = 'http://mail.google.com/mail/?view=page&amp;name=loading&amp;ver='.$url_login;
	//print "\r\n<br> loading:".$url;

	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
	//echo $result;
	
    curl_close ($ch); 
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	

	$url = 'http://mail.google.com/mail/?ik\u003d4577fd1fac&view\u003dcl&search\u003dcontacts&pnl\u003dd&zx\u003dw4dgfwfhb77x&fs\u003d1';
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
//    //echo $result;
	curl_close ($ch); 
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	

	$url = 'http://mail.google.com/mail/?view=page&name=contacts&ver=d202237fbf0582fa';
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
	////echo $result;
    curl_close ($ch); 
	echo "<textarea rows=20 cols=100>".$result."</textarea>"; 		

} 
else
{
	login_form();
}	

////////////////////////////////////////////////////////////////////////////////////////////////
function login_form()
{

?>
<html>
<head>
<title>g Mail</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


</head>

<body>
Get gmail Email Address Contact List
<form method="post" action="gmail.php" autocomplete=off name="login_form" >
<table id="yreglgtb" summary="form: login information">
					<tbody><tr>
						<th><label for="username">gmail Email:</label></th>
						<td><input name="login" id="login" value="" size="17" class="yreg_ipt" type="text"></td>
					</tr>
					<tr>
						<th><label for="passwd">Password:</label></th>
						<td><input name="passwd" id="passwd" value="" size="17" class="yreg_ipt" type="password"></td>
					</tr>
				
				</tbody></table>
<input value="Sign In" type="submit">
</form>

</body>
</html>
<?
}
?>