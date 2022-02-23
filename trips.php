<?php
if (!defined("LAND_PAGE")) { // check call from index, not self
	header('Location: ./index.php'); 
	exit; 
}
error_reporting(E_ALL); //debug
// error_reporting(0);

include 'db_ini.php';
?>
<!DOCTYPE html>
<HTML>
<HEAD>
<title>Abandoned - Trips</title>
 <meta charset="UTF-8">
 <meta NAME="Keywords" CONTENT="industrial, places, urban, abandoned, plant, base, zone, завод, зона, место, брошенные, заброшенные, недостроенный, база">
 <meta NAME="Description" CONTENT="Photo base of abandonned plants, unfinished buildings, industrial sites">
<style type=text/css>
body {
background-color: #000017;
background-image: url("abg.png");
background-repeat: no-repeat;
}
hr { border: 1px solid #747687; }
.text {  font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; text-decoration: none}
.stext {  font-family: Arial; font-size: 10pt; color: #cfcfcf; font-weight: bold; text-decoration: none}
.snbtext {  font-family: Arial; font-size: 9pt; color: #cfcfcf; text-decoration: none}
.itext {  font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; font-style: italic; text-decoration: none}
.ctext {  font-family: Verdana, Arial; font-size: 8pt; color: #a4b6c7; font-weight: bold; font-style: italic; text-decoration: none}
.utext {  font-family: Arial; font-size: 8pt; color: #a4b6c7; font-style: italic; text-decoration: none}
.link {  font-family: Verdana, Arial; font-size: 9pt; font-weight: bold}
</style>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-15607830-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
</HEAD>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<?php require ('menu.php'); ?>
<p align="right" class="stext">The trips section say to you what trips were taken. A short photo galleries, texts and related topics.
</p><hr width="40%" align="right">
<?php
$query="SELECT dir,dat,descr FROM glrs WHERE trip=1 ORDER BY dir DESC";
$result=mysqli_query($mysqli, $query);
echo '<table border=0>';
while (list($dir, $date, $descr) = mysqli_fetch_row ($result)) {

	echo '
    <tr>
    <td align=right class=text><a href="./index.php?do=thumb&dir='.$dir.'">'.$date.'</a></td>
    <td align=left class=text> - '.$descr.'</td>
    </tr>
    ';
/*
   echo '
   <p align="left" class="text">
   <a href="thumb.php?gal='.$dir.'"><!-- <font color="#ffffff"> -->'.$date.'</font></a> - '.$descr.'</p>';
*/
	}
echo "</table>";

/*
for ($tr=0; $tr<=$s_dbrows-1; $tr++) {
   $query="SELECT * FROM glrs WHERE dir='$directories[$tr]' ORDER BY dir";
   $result=mysql_query($query, $dbid);
   $particular_row=mysql_fetch_array($result, $dbid);
   $dir=$particular_row[dir];
   $descr=$particular_row[descr];
   $date=$particular_row[dat];
   echo '
   <p align="left" class="text">
   <a href="thumb.php?gal='.$dir.'"><!-- <font color="#ffffff"> -->'.$date.'</font></a> - '.$descr.'</p>';
   }
*/
?>
<br>
<br>
<?php require ('copyright.php'); ?>
<hr>
<div align=right><?php include 'hotlog.php'; ?></div>
<script type="text/javascript">
var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
</script>
<script type="text/javascript">
try {
var pageTracker = _gat._getTracker("UA-15607830-1");
pageTracker._trackPageview();
} catch(err) {}</script>
</BODY>
</HTML>