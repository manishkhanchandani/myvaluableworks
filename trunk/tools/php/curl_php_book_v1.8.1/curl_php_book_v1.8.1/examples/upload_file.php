<?php
// Upload a file to remote server.
// Upload file field on form having multipart/form-data.
// written by imranlink@hotmail.com

	set_time_limit(0);
	$url = 'http://phptrack.com/upload.php'; // change to  your form action url.
	$field_name = 'file'; // please edit it according to your form file field name.

  if (isset($_FILES['file']))
  {
     $ch = curl_init($url);  
     curl_setopt($ch, CURLOPT_POSTFIELDS, array("$field_name"=>"@".$_FILES['file']['tmp_name']));
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
     $result = curl_exec($ch);
     curl_close($ch);
	echo $result;

  }
  else
  {
     print   "<form enctype=\"multipart/form-data\" "
                . "action=\"$PHP_SELF\" method=\"post\" >\n";
  print '<p>
				<input type="file" name="file">
			</p>
			  <p>
				<input type="submit" name="Submit" value="Submit">
			</p>';				

     print "</form>";
}

?>