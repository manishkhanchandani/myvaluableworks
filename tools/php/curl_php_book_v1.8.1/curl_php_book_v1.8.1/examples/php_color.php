<?php
if( $_GET['file'] == '')  $_GET['file'] = '001.php';
$x = highlight_file ( $_GET['file'],1 );
echo $x;
?>