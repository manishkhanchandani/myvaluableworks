<?php
set_time_limit(0);
/*
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'   File:	                hotmail.php
'
'   Description:            This script Login you on http://mail.hot.com website with SSL using cURl/PHP.
'
'   Written by:             Imran Khalid imranlink@hotmail.com
'
'   Languages:              PHP + CURL
'
'   Date Written:           April 27, 2006
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
	$php_userid = rawurlencode($_POST['login']);
	$php_password = rawurlencode($_POST['passwd']);
	
	$cookie_file_path = "/home/public_html/site/cookie.txt"; // Please set your Cookie File path
	//$cookie_file_path = "C:\Inetpub\wwwroot\sept2005\phptrack\curl\forum_help_codes\cookie.txt"; // Please set your Cookie File path
	
	$fp = fopen($cookie_file_path,'wb');	
	fclose($fp);
	
	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
    $reffer = "http://mail.hot.com/";
		
//1. Get first login page to parse hash_u,hash_challenge

	$LOGINURL = "http://login.live.com/login.srf?id=2&vv=400&lc=1033";	
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
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	


	// 2- Post Login Data to Page https://login.hot.com/config/login?
	
	$LOGINURL = "http://login.live.com/login.srf?id=2&vv=400&lc=1033";
	$POSTFIELDS = 'PPStateXfer=1';
	
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
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	

	preg_match_all("/action=\"(.*?)\"/", $result, $arr_post);	
	$url_login = $arr_post[1][0];
	preg_match_all("/PPFT(.*?)\>/", $result, $arr_post);	
	$PPFT = $arr_post[1][0];
	preg_match_all("/value=\"(.*?)\"/", $PPFT, $arr_post);	
	$PPFT = urlencode($arr_post[1][0]);

	//print "\r\n<br>".$url_login;
	//print "\r\n<br>".$PPFT;	


// 2- Post Login Data to Page https://login.hot.com/config/login?
	$LOGINURL = $url_login;
	$POSTFIELDS='PPSX=PassportR&PwdPad=IfYouAreReadingThisYouHaveTooMu&login='.$php_userid.'&passwd='.$php_password.'&LoginOptions=3&PPFT='.$PPFT;
	
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
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	
	preg_match_all("/replace\(\"(.*?)\"/", $result, $arr_post);	
	$url_login = $arr_post[1][0];
	//print "\r\n<br> url:".$url_login;

	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$url_login);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
    curl_close ($ch); 
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	
	preg_match_all("/_UM=\"(.*?)\"/", $result, $arr_post);	
	$url_login = $arr_post[1][0];
	//print "\r\n<br> contact:".$url_login;


	

// 4- Get Address Book.
	$addressURL = 'http://hotmail.msn.com/cgi-bin/addresses?'.$url_login;
	
	$ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL,$addressURL);
	curl_setopt($ch, CURLOPT_USERAGENT, $agent);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_REFERER, $reffer);
	curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
	curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
    $result = curl_exec ($ch);
    curl_close ($ch); 
	//echo "<textarea rows=30 cols=130>".$result."</textarea>"; 	
	//print $result;
	preg_match_all("/id=\"ListTable\"\>(.*?)\<input type=\"hidden\"/", $result, $arr_post);	
	$url_login = $arr_post[1][0];
	print "\r\n<br>".'<table border=0 cellpadding=0 cellspacing=0 width=100% class="EE" id="ListTable">'.$url_login;

	preg_match_all("/event\);return false;\"\>(.*?)\<\/a/",$arr_post[1][0],$arr_r);
	$email_arr = $arr_r[1];
	$retarr = array();
		$n = 0;
		while (isset($email_arr[$n]))
		{
			$retarr[$email_arr[$n]] = trim($email_arr[$n+1]);
			$n=$n+2; 
		}
	
	foreach($retarr as $name=>$email)
	{
		print "\r\n<br>".$name ."=". $email;
		
	}

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
<title>hot Mail</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">


</head>

<body>
Get Hotmail Email Address Contact List
<form method="post" action="hotmail.php" autocomplete=off name="login_form" >
<table id="yreglgtb" summary="form: login information">
					<tbody><tr>
						<th><label for="username">hotmail Email:</label></th>
						<td><input name="login" id="login" value="@hotmail.com" size="17" class="yreg_ipt" type="text"></td>
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