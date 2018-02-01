<?php
require 'db_ini.php';

$query="SELECT * FROM ab_links WHERE active=1 ORDER BY cat4 DESC, id";
$result=mysql_query($query, $dbid);
// echo "<br>debug---------------------------------<br>";
// if($result == false)
// {
   // user_error("Query failed: " . mysql_error() . "<br />\n$query");
// }
// elseif(mysql_num_rows($result) == 0)
// {
   // echo "<p>Sorry, no rows were returned by your query.</p>\n";
// }
// else
// {
   // while($query_row = mysql_fetch_assoc($result))
   // {
      // foreach($query_row as $key => $value)
      // {
         // echo "$key: $value<br />\n";
      // }
      // echo "<br />\n";
   // }
// } 
// echo "<br>debug---------------------------------<br>";

// echo "<br>---<br>";
// print_r ($result);
// $row = mysql_fetch_assoc($result);
// echo "<br>---<br>";
// print_r ($row);
// $row = mysql_fetch_row($result);
// echo "<br>---<br>";
// print_r ($row);
// echo "<br>---<br>";
$counter=0;
?>
</table>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<html>
<head>
<title>Abandoned - Links</title>
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
 <META NAME="Keywords" CONTENT="industrial, places, urban, abandoned, plant, base, zone, завод, зона, место, брошенные, заброшенные, недостроенный, база">
 <META NAME="Description" CONTENT="Photo base of abandonned plants, unfinished buildings, industrial sites">
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
.linklist {  font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; text-decoration: none; line-height: 1.6; list-style: square; }
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
</head>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<?php require ('menu.php'); ?>
<p align="right" class="stext">The links section contains a great collection of other internet sites made by people with similar interests.</p>
<hr width="40%" align="right">
<div align="right">
<!-- google_ad_start -->
<script type="text/javascript"><!--
google_ad_client = "pub-9659481331039989";
/* 468x60, created 4/1/10 */
google_ad_slot = "6602157302";
google_ad_width = 468;
google_ad_height = 60;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<!-- google_ad_end -->
</div>
<ul align="left" class="linklist">
<?php
while ($row = mysql_fetch_array($result))
        {
        $id=$row[0];
        $link=$row[1];
        $name=$row[2];
        $descr=$row[3];
        $img=$row[4];
	$cat1=$row[5];
	$cat2=$row[6];
	$cat3=$row[7];
	$cat4=$row[8];
	// $active_e=$row[9];
	$counter++;
	printf ("<li><a name=\"%s\" href=\"%s\" target=\"_new\">%s</a> - %s</li>", $id, $link, $name, $descr);

}

echo "
</ul>
<div align=\"left\" class=\"text\">".$counter." links</div>";
?>

<hr align="left" width="10%">
<div class="stext" align="right">If you think that a link to your website should be in this list <a href="mailto:uryevich@gmail.com?subject=www.abandoned.ru%20links">let me know</a>.</div>
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
</body>
</html>
