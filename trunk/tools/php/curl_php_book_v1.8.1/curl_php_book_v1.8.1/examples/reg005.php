<?php
// Example reg005.php
// Simple Regular Expressions in PHP
// Copyright http://curl.phptrack.com
// Use of php functions 'ereg','eregi','ereg_replace'
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Regular expressions</title>
</head>

<body>

      <?php
         $search = "Time of your PC";
         print( "Testing string is: '$search'<br /><br />" );

         // call function ereg to search for pattern ’Now’
         // in variable search
         if ( ereg( "Now", $search ) )
            print( "String 'Now' was found.<br />" );

         // search for pattern ’Now’ in the beginning of 
         // the string
         if ( ereg( "^Now", $search ) ) 
            print( "String 'Now' found at beginning 
               of the line.<br />" );
            
         // search for pattern ’Now’ at the end of the string
         if ( ereg( "Now$", $search ) ) 
            print( "String 'Now' was found at the end 
               of the line.<br />" ); 
            
         // search for any word ending in ’ow’
         if ( ereg( "[[:<:]]([a-zA-Z]*ow)[[:>:]]", $search,
            $match ) ) 
            print( "Word found ending in 'ow': " .
               $match[ 1 ] . "<br />" );
            
         // search for any words beginning with ’t’
         print( "Words beginning with 't' found: ");

         while ( eregi( "[[:<:]](t[[:alpha:]]+)[[:>:]]",
            $search, $match ) ) {
            print( $match[ 1 ] . " " );

           // remove the first occurrence of a word beginning 
           // with ’t’ to find other instances in the string
           $search = ereg_replace( $match[ 1 ], "", $search );
         }   

         print( "<br />" );
      ?>
   </body>
</html>