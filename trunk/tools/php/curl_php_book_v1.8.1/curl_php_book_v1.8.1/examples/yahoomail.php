<?php
set_time_limit(0);
/*
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'   File:	                yahoomail.php
'
'   Description:            This script Login you on http://mail.yahoo.com website with SSL using cURl/PHP.
'
'   Written by:             Imran Khalid imranlink@hotmail.com
'
'   Languages:              PHP + CURL
'
'   Date Written:           December 20, 2005
'
'   Version:            	V.1.0
'
'   Platform:               Windows 2000 / IIS / Netscape 7.1
'
'   Copyright:              http://curl.phptrack.com
'
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
*/	

if($_POST['login'])
{
	$php_userid = $_POST['login'];
	$php_password = $_POST['passwd'];
	$cookie_file_path = "/home/phptrack/public_html/curl/cookie.txt"; // Please set your Cookie File path
	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
    $reffer = "http://mail.yahoo.com/";

	// log out.
	$LOGINURL = "http://us.ard.yahoo.com/SIG=12hoqklmn/M=289534.5473431.6553392.5333790/D=mail/S=150500014:HEADR/Y=YAHOO/EXP=1135053978/A=2378664/R=4/SIG=133erplvs/*http://login.yahoo.com/config/login?logout=1&.done=http://mail.yahoo.com/&.src=ym&.lg=us&.intl=us";	
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
    curl_close ($ch);
		
//1. Get first login page to parse hash_u,hash_challenge

	$LOGINURL = "http://mail.yahoo.com";	
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$LOGINURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $loginpage_html = curl_exec ($ch);
    curl_close ($ch);		
	
	preg_match_all("/name=\".u\" value=\"(.*?)\"/", $loginpage_html, $arr_hash_u);
	preg_match_all("/name=\".challenge\" value=\"(.*?)\"/", $loginpage_html, $arr_hash_challenge);
	
	$hash_u = $arr_hash_u[1][0];
	$hash_challenge = $arr_hash_challenge[1][0];
	
// 2- Post Login Data to Page https://login.yahoo.com/config/login?

	$LOGINURL = "https://login.yahoo.com/config/login?";
	$POSTFIELDS = '.tries=1&.src=ym&.md5=&.hash=&.js=&.last=&promo=&.intl=us&.bypass=&.partner=&.u='.$hash_u.'&.v=0&.challenge='.$hash_challenge.'&.yplus=&.emailCode=&pkg=&stepid=&.ev=&hasMsgr=0&.chkP=Y&.done=http%3A%2F%2Fmail.yahoo.com&login='.$php_userid.'&passwd='.$php_password;

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
    curl_close ($ch); 

	preg_match_all("/replace\(\"(.*?)\"/", $result, $arr_url);	
	$WelcomeURL = $arr_url[1][0];
	
// 3- Redirect to Welcome page. (Login Success)

	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$WelcomeURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
    curl_close ($ch);
	//	echo "<textarea rows=30 cols=90>".htmlentities($result)."</textarea>"; 	
	
// 4- Get Address Book.
	$addressURL = 'http://address.mail.yahoo.com/?A=B';
	
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$addressURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
    curl_close ($ch);
		
	//echo "<textarea rows=30 cols=90>".$result."</textarea>"; 	
	//print $result;
	preg_match_all("/\"\/yab\/us\/Yahoo\.csv\?(.*?)\"/", $result, $arr_address_url);	
	$randURL = html_entity_decode($arr_address_url[1][0]);	
	
	
// 5- show Address Book.
	$addressURL = 'http://address.mail.yahoo.com/yab/us/Yahoo.csv?'.$randURL;
	
	$POSTFIELDS = 'Yahoo=Export+Now';	
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$addressURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_POST, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS,$POSTFIELDS); 	
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
    curl_close ($ch);		
	echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	
	//print $result;

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
<title>Yahoo Mail</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


</head>

<body>
<form method="post" action="yahoomail.php" autocomplete=off name="login_form" >
<table id="yreglgtb" summary="form: login information">
					<tbody><tr>
						<th><label for="username">Yahoo! ID:</label></th>
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