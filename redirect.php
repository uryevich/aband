<?php 
//   error_reporting(0);
//   session_start();
//   if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }

// if something posted
// print_r ($_GET["link"]);
if (isset ($_GET["link"])) {
   $link=$_GET["link"];
   }
   else { die ('<font color=#bb0000><b>No link given</b></font>'); }
?>
<html>
<head>
<title>Goodbye</title>
<?php
header("HTTP/1.1 301 Moved Permanently"); 
header("Location: ".$link.""); 
exit(); 
?>