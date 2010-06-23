<?php
/*
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
'   File:	                ebay_login.php
'
'   Description:            This script Login you on Ebay.com website with SSL using curl in php.
'
'   Written by:             Imran Khalid imranlink@hotmail.com
'
'   Languages:              PHP + CURL
'
'   Date Written:           January 08, 2005
'
'   Version:            	V.2.0
'
'   Platform:               Windows 2000 / IIS / Netscape 7.1
'
'   Copyright:              Imran Khalid imranlink@hotmail.com
'
''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''''
*/	

// 1-Get First Login Page http://signin.ebay.com/ws2/eBayISAPI.dll?SignIn
// This page will set some cookies and we will use them for Posting in Form data.
if($_POST['ebay_user_id'])
{
	$ebay_user_id = $_POST['ebay_user_id']; // Please set your Ebay ID
	$ebay_user_password = $_POST['ebay_user_password']; // Please set your Ebay Password
	$cookie_file_path = "C:/Inetpub/wwwroot/spiders/cookie/cook"; // Please set your Cookie File path

	// log out.
	$LOGINURL = "http://signin.ebay.com/ws/eBayISAPI.dll?SignIn";
	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
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
		
	$LOGINURL = "http://signin.ebay.com/ws2/eBayISAPI.dll?SignIn";
	$agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
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

// 2- Post Login Data to Page https://signin.ebay.com/ws/eBayISAPI.dll?co_partnerid=2&siteid=0&UsingSSL=1

	$LOGINURL = "https://signin.ebay.com/ws/eBayISAPI.dll?co_partnerid=2&siteid=0&UsingSSL=1";
	$POSTFIELDS = 'MfcISAPICommand=SignInWelcome&siteid=0&co_partnerId=2&UsingSSL=1&ru=&pp=&pa1=&pa2=&pa3=&i1=-1&pageType=-1&userid='. $ebay_user_id .'&pass='. $ebay_user_password .'&keepMeSignInOption=1';
    $reffer = "https://signin.ebay.com/ws/eBayISAPI.dll?SignIn&favoritenav=&sid=&ruproduct=&pp=&co_partnerId=2&ru=&i1=&ruparams=&pageType=&pa2=&bshowgif=&pa1=&pUserId=&errmsg=&UsingSSL=&runame=&siteid=0";

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
	
	if (stristr($result, "Your sign in information is not valid"))
	{
		echo "\r\n<br><p>Your sign in information is not valid.</p>";
		login_form();
	}
	else
	{
	
		$LOGINURL = "https://arribada.ebay.com/saw-cgi/eBayISAPI.dll?PlaceCCInfo";
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
		//print $result;
		$LOGINURL = "https://signin.ebay.com/ws/eBayISAPI.dll?co_partnerid=2&siteid=0&UsingSSL=1";
		$POSTFIELDS = 'MfcISAPICommand=SignInWelcome&siteid=0&co_partnerId=2&UsingSSL=1&ru=https%3A%2F%2Farribada.ebay.com%2Fsaw-cgi%2FeBayISAPI.dll%3FPlaceCCInfo%26page%3D0%26adult%3D0%26ru%3Ddefault%26BillingAccountType%3Ddefault%26pass%3D%7B_pass_%7D%26fromsyi%3D0%26reporting%3D0%26userid%3D&pp=pass&pa1=&pa2=&pa3=&i1=0&pageType=955&userid='. $ebay_user_id .'&pass='. $ebay_user_password;
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$LOGINURL);
		curl_setopt($ch, CURLOPT_USERAGENT, $agent);
		curl_setopt($ch, CURLOPT_POST, 1); 
		curl_setopt($ch, CURLOPT_POSTFIELDS,$POSTFIELDS); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
		$address = curl_exec ($ch);
		curl_close ($ch); 

		print $address;
	} // if login success
} // if form post
else
{
	login_form();
}	
//////////////////////////////////////////////////////////////////////////
function filter_text( $start, $end, $str_page ){

	$pos =  strpos ( $str_page, $start );
	if ( $pos != false ) {
			$pos = $pos + strlen($start);
			$field_value = substr( $str_page, $pos );
    		$pos =  strpos ( $field_value, $end );
	    	$field_value = substr( $field_value, 0, $pos );
			$field_value = trim($field_value);
	} // if
	else {
		$field_value = "";
	}		
	return $field_value;
} // function
function login_form()
{
?>
<form method="post" name="SignInForm" action="ebay_account.php">

<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><img src="https://securepics.ebaystatic.com/aw/pics/spacer.gif" width="1" height="10" alt=" " title=""></td>
</tr>
<tr>
      <td valign="top"> <font color="#ff0000" size="4">&nbsp;</font><font size="4">eBay 
        members, sign in to save time for bidding, selling, and other activities. 
        </font><br></td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><img src="https://securepics.ebaystatic.com/aw/pics/spacer.gif" width="1" height="10" alt=" " title=""></td>
</tr>
<tr>

<td valign="top"><b>eBay User ID</b><br><input type="text" name="ebay_user_id" maxlength="64" tabindex="1" value="" size="27"><br>
      </td>
</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
<tr>
<td><img src="https://securepics.ebaystatic.com/aw/pics/spacer.gif" width="1" height="10" alt=" " title=""></td>
</tr>
<tr>
<td valign="top"><b>Password</b><br><input type="password" name="ebay_user_password" maxlength="64" value="" tabindex="2" size="27"><br>
      </td>

</tr>
</table>
<table border="0" cellpadding="0" cellspacing="0" width="350">
<tr>
<td colspan="2"><img src="https://securepics.ebaystatic.com/aw/pics/spacer.gif" width="1" height="10" alt=" " title=""></td>
</tr>
<tr>
<td width="35%"><input type="submit" tabindex="3" value="Sign In Securely >"></td>
</tr>
</table>

</form>

<?
}
?>