<?php
// Example reg002.php
// Simple Regular Expressions in PHP
// Copyright http://curl.phptrack.com
// parsing name, email from hotmail contact html page.
// using php function preg_match_all
$str = '
		<html>
		<body>
		<table border=0 cellpadding=0 cellspacing=0 width=100% class="EE" id="ListTable">
		<form name=doaddy action="/cgi-bin/doaddresses" method=POST>
		<input type=hidden name="" value="">
		<input type=hidden name=_HMaction value="">
		<input type=hidden name=i>
		<input type=hidden name=IsGroup>
		<input type=hidden name=strUsrFltr value="">
		<input type=hidden name=strUsrView value="">
		<input type=hidden name=strAlphNav value="">
		<input type=hidden name=a value=0aee4eac7ebe5d67fa50eb5267e959b02eb61cb9ba63cb9598857c5a311822e5>
		<tr height=26>
		<td colspan=6 align=right style="BORDER-TOP:none;COLOR:#8D8D8D">
		<font class="K">ALL</font>&nbsp;#&nbsp;A&nbsp;B&nbsp;<a href="javascript:AN("","","C")">C</a>&nbsp;D&nbsp;E&nbsp;F&nbsp;G&nbsp;H&nbsp;I&nbsp;J&nbsp;<a href="javascript:AN("","","K")">K</a>&nbsp;L&nbsp;M&nbsp;N&nbsp;O&nbsp;P&nbsp;Q&nbsp;R&nbsp;S&nbsp;T&nbsp;U&nbsp;V&nbsp;W&nbsp;X&nbsp;Y&nbsp;Z&nbsp;&nbsp;</td>
		</tr>
		<tr id="messPrompt">
		</tr>
		<tr bgcolor=#DBEAF5>
		<td width=1% height=24 align=center>&nbsp;<input name=allbox type=checkbox onClick="CA()">&nbsp;</td>
		<td width=1%>&nbsp;</td>
		<td bgcolor=#A0C6E5>
		<a href="javascript:AD("addrrev=1&addrsort=nick&strUsrFltr=&strUsrView=&strAlphNav=")" title="Sort by Name" class="FF">
		<img src="http://gfx1.hotmail.com/i.p.sort.asc.gif" hspace=3 border=0 alt="sorted in ascending order">Name</a>
		</td>
		<td >
		<a href="javascript:AD("addrrev=1&addrsort=email&strUsrFltr=&strUsrView=&strAlphNav=")" title="Sort by E-Mail" class="FF">E-Mail</a>
		</td>
		<td>
		<font class="FF">Phone</font>
		</td>
		</tr>
		<tr name="" id="13bf6320-da8e-4d40-8759-3c4ab27e36a0">
		<td align=center>
		<input type=checkbox name="ADDR13bf6320-da8e-4d40-8759-3c4ab27e36a0" onClick="CCA(this)" id="hotmail">
		</td>
		<td width=1%>
		</td>
		<td nowap>
		<a href="#" onclick="javascript:DoAD("","&strUsrView=",event);return false;">cheema</a>
		</td>
		<td>
		<a href="#" onclick="javascript:DC(event);return false;">cheema@gmail.com</a>
		</td>
		<td>
		</td>
		</tr>
		<tr name="" id="2b151594-b7ed-4994-8953-44ace5bfc483">
		<td align=center>
		<input type=checkbox name="ADDR2b151594-b7ed-4994-8953-44ace5bfc483" onClick="CCA(this)" id="hotmail">
		</td>
		<td width=1%>
		</td>
		<td nowap>
		<a href="#" onclick="javascript:DoAD("","&strUsrView=",event);return false;">kahlid</a>
		</td>
		<td>
		<a href="#" onclick="javascript:DC(event);return false;">khalid@yahoo.com</a>
		</td>
		<td>
		</td>
		</tr>
		<tr name="" id="e7615392-aac4-45e2-87e8-96afa21eb928">
		<td align=center>
		<input type=checkbox name="ADDRe7615392-aac4-45e2-87e8-96afa21eb928" onClick="CCA(this)" id="hotmail">
		</td>
		<td width=1%>
		</td>
		<td nowap>
		<a href="#" onclick="javascript:DoAD("","&strUsrView=",event);return false;">khalid, imran</a>
		</td>
		<td>
		<a href="#" onclick="javascript:DC(event);return false;">imran@hotmail.com</a>
		</td>
		<td>
		</td>
		</tr>
		<td colspan=5>&nbsp;</td>
		</table>
		</td>
		<tr>
		</table>
		<br>
		</form>
		<br>
		</td>
		</tr>
		</table>
		</body>
		</html>
		';

// Let's perform the regex
$flag = preg_match_all("/event\);return false;\"\>(.*?)\<\/a/", $str, $matches);

// Check if regex was successful
if ($flag = true) 
{
	// Matched something, show the matched string
	print_r($matches['1']);
}

else 
{
	// No Match
	echo "Couldn't find a match";
}

?>