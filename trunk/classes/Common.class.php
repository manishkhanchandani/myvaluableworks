<?php
class Common {
	public function __construct() {
		
	}
	public function templateBody($title='', $body='', $id='') {
		switch($id) {
			default:
				$result = '<div class="post">
							<h2 class="title">'.$title.'</h2>
							<div class="entry">'.$body.'</div>
							</div>';
				break;
		}
		return $result;
	}
	public function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
	  // For security, start by assuming the visitor is NOT authorized. 
	  $isValid = False; 

	  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
	  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
	  if (!empty($UserName)) { 
		// Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
		// Parse the strings into arrays. 
		$arrUsers = explode(",", $strUsers); 
		$arrGroups = explode(",", $strGroups); 
		if (in_array($UserName, $arrUsers)) { 
		  $isValid = true; 
		} 
		// Or, you may restrict access to only certain users based on their username. 
		if (in_array($UserGroup, $arrGroups)) { 
		  $isValid = true; 
		} 
		if (($strUsers == "") && true) { 
		  $isValid = true; 
		} 
	  } 
	  return $isValid; 
	}
	public function isAuthorizedDone($httphost) {
		$MM_authorizedUsers = "";
		$MM_donotCheckaccess = "true";
		$MM_restrictGoTo = $httphost."/users/login/";
		if (!((isset($_COOKIE['user_id'])) && ($this->isAuthorized("",$MM_authorizedUsers, $_COOKIE['user_id'], $_COOKIE['role'])))) {   
		  $MM_qsChar = "?";
		  $MM_referrer = $_SERVER['REQUEST_URI'];
		  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
		  //if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
		  //$MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
		  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
		  header("Location: ". $MM_restrictGoTo); 
		  exit;
		}
	}
	public function secondsToWords($seconds) {
		/*** return value ***/
		$ret = "";
	
		/*** get the hours ***/
		$hours = intval(intval($seconds) / 3600);
		if($hours > 0)
		{
			$ret .= "$hours hours ";
		}
		/*** get the minutes ***/
		$minutes = bcmod((intval($seconds) / 60),60);
		if($hours > 0 || $minutes > 0)
		{
			$ret .= "$minutes minutes ";
		}
	  
		/*** get the seconds ***/
		$seconds = bcmod(intval($seconds),60);
		//$ret .= "$seconds seconds";
	
		return $ret;
	}
	function converttime($var) {
		$array = explode(":",$var);
		$minute = $array[1];
		$hour = $array[0];
		settype($minute, "integer"); 
		if($minute >=0 && $minute <=7) {
			//echo "$minute is between 0 and 7";
			$newminute = 0;
		}
		if($minute >=8 && $minute <=22) {
			//echo "$minute is between 8 and 22";
			$newminute = 25;
		}
		if($minute >=23 && $minute <=37) {
			//echo "$minute is between 23 and 37";
			$newminute = 50;
		}
		if($minute >=38 && $minute <=52) {
			//echo "$minute is between 38 and 52";
			$newminute = 75;
		}
		if($minute >=53 && $minute <=59) {
			//echo "$minute is between 53 and 59";
			$newminute = 0;
			$hour = $hour+1;
		}
		$arr['hour'] = $hour;
		$arr['minute'] = $newminute;
		$arr['time'] = $hour.".".$newminute;
		return $arr;
	}
	public function getDays($time='') {
		if(!$time) {
			$time = mktime(0,0,0,date('m'),date('d'),date('Y'));
		} else {
			$d = date('d',$time);
			$m = date('m',$time);
			$y = date('Y',$time);
			$time = mktime(0,0,0,$m,$d,$y);
		}
		$today = getdate($time);
		switch($today['wday']) {
			case 1: // monday
				$monday = $time+(60*60*24*0); 
				$arr['monday'] = getdate($monday);
				$tuesday = $time+(60*60*24*1); 
				$arr['tuesday'] = getdate($tuesday);
				$wednesday = $time+(60*60*24*2); 
				$arr['wednesday'] = getdate($wednesday);
				$thursday = $time+(60*60*24*3); 
				$arr['thursday'] = getdate($thursday);
				$friday = $time+(60*60*24*4); 
				$arr['friday'] = getdate($friday);
				$saturday = $time+(60*60*24*5); 
				$arr['saturday'] = getdate($saturday);
				$sunday = $time+(60*60*24*6); 
				$arr['sunday'] = getdate($sunday);
				break;
			case 2: // tuesday
				$monday = $time-(60*60*24*1); 
				$arr['monday'] = getdate($monday);
				$tuesday = $time+(60*60*24*0); 
				$arr['tuesday'] = getdate($tuesday);
				$wednesday = $time+(60*60*24*1); 
				$arr['wednesday'] = getdate($wednesday);
				$thursday = $time+(60*60*24*2); 
				$arr['thursday'] = getdate($thursday);
				$friday = $time+(60*60*24*3); 
				$arr['friday'] = getdate($friday);
				$saturday = $time+(60*60*24*4); 
				$arr['saturday'] = getdate($saturday);
				$sunday = $time+(60*60*24*5); 
				$arr['sunday'] = getdate($sunday);
				break;
			case 3: // wednesday
				$monday = $time-(60*60*24*2); 
				$arr['monday'] = getdate($monday);
				$tuesday = $time-(60*60*24*1); 
				$arr['tuesday'] = getdate($tuesday);
				$wednesday = $time+(60*60*24*0); 
				$arr['wednesday'] = getdate($wednesday);
				$thursday = $time+(60*60*24*1); 
				$arr['thursday'] = getdate($thursday);
				$friday = $time+(60*60*24*2); 
				$arr['friday'] = getdate($friday);
				$saturday = $time+(60*60*24*3); 
				$arr['saturday'] = getdate($saturday);
				$sunday = $time+(60*60*24*4); 
				$arr['sunday'] = getdate($sunday);
				break;
			case 4: // thursday
				$monday = $time-(60*60*24*3); 
				$arr['monday'] = getdate($monday);
				$tuesday = $time-(60*60*24*2); 
				$arr['tuesday'] = getdate($tuesday);
				$wednesday = $time-(60*60*24*1); 
				$arr['wednesday'] = getdate($wednesday);
				$thursday = $time+(60*60*24*0); 
				$arr['thursday'] = getdate($thursday);
				$friday = $time+(60*60*24*1); 
				$arr['friday'] = getdate($friday);
				$saturday = $time+(60*60*24*2); 
				$arr['saturday'] = getdate($saturday);
				$sunday = $time+(60*60*24*3); 
				$arr['sunday'] = getdate($sunday);
				break;
			case 5: // friday
				$monday = $time-(60*60*24*4); 
				$arr['monday'] = getdate($monday);
				$tuesday = $time-(60*60*24*3); 
				$arr['tuesday'] = getdate($tuesday);
				$wednesday = $time-(60*60*24*2); 
				$arr['wednesday'] = getdate($wednesday);
				$thursday = $time-(60*60*24*1); 
				$arr['thursday'] = getdate($thursday);
				$friday = $time+(60*60*24*0); 
				$arr['friday'] = getdate($friday);
				$saturday = $time+(60*60*24*1); 
				$arr['saturday'] = getdate($saturday);
				$sunday = $time+(60*60*24*2); 
				$arr['sunday'] = getdate($sunday);
				break;
			case 6: // saturday
				$monday = $time-(60*60*24*5); 
				$arr['monday'] = getdate($monday);
				$tuesday = $time-(60*60*24*4); 
				$arr['tuesday'] = getdate($tuesday);
				$wednesday = $time-(60*60*24*3); 
				$arr['wednesday'] = getdate($wednesday);
				$thursday = $time-(60*60*24*2); 
				$arr['thursday'] = getdate($thursday);
				$friday = $time-(60*60*24*1); 
				$arr['friday'] = getdate($friday);
				$saturday = $time+(60*60*24*0); 
				$arr['saturday'] = getdate($saturday);
				$sunday = $time+(60*60*24*1); 
				$arr['sunday'] = getdate($sunday);
				break;
			case 0: // sunday
				$monday = $time-(60*60*24*6); 
				$arr['monday'] = getdate($monday);
				$tuesday = $time-(60*60*24*5); 
				$arr['tuesday'] = getdate($tuesday);
				$wednesday = $time-(60*60*24*4); 
				$arr['wednesday'] = getdate($wednesday);
				$thursday = $time-(60*60*24*3); 
				$arr['thursday'] = getdate($thursday);
				$friday = $time-(60*60*24*2); 
				$arr['friday'] = getdate($friday);
				$saturday = $time-(60*60*24*1); 
				$arr['saturday'] = getdate($saturday);
				$sunday = $time+(60*60*24*0); 
				$arr['sunday'] = getdate($sunday);
				break;
		}
		return $arr;
	}
}
?>