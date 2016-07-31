<?php
// dirk zaal juli 2016
//
// usage: find.php?url=imagefilename.png
//
//  Take one character at the end of the base filename
// if that exists, it will display that image
// if it doenst exist, it will do the same thing again.
// until the file is found
// if no file is found, it will return a not found header

 $name=  $_GET['url'];
 $info = new SplFileInfo($name);

 $ext  =  $info->getExtension();
 $base = $info->getBasename($ext);
 $path = $info->getPathInfo();
 if($path) $path =$path.'/';
 $length =strlen($base)-1;
 $error = 'find.php (digizaal 2016)<br /> You requested '.$name.' but that isnt found.<br />
 I went searching for alternatives:';
 while ($length>1) {
         $length -=1;
  	     $base =  substr($base,0, $length);
         $newname = $path.$base.'.'.$ext;
         if ( file_exists($newname) )
          {
          header('content-type: image/'.$ext,true);
          readfile($newname);
          exit();
          }
          else
          $error .='<br />'.$newname.' not found.';

  }
  $error .='<br /><br />Returned a 404 error.';
  header("HTTP/1.0 404 Not Found");
  echo $error;

?>