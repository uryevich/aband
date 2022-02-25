<?php
if (!defined("LAND_PAGE")) { // check call from index, not self
	header('Location: ./index.php'); 
	exit; 
}
error_reporting(E_ALL); //debug
// error_reporting(0);

include 'db_ini.php';

$query="SELECT * FROM ab_links WHERE active=1 ORDER BY id";
$result=mysqli_query($mysqli, $query);
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
<!DOCTYPE html>
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
</head>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<?php require ('menu.php'); ?>
<p align="right" class="stext">The links section contains a great collection of other internet sites made by people with similar interests.</p>
<hr width="40%" align="right">

<div align="left" class="itext">Friends</div>
<ul>
<ul align="left" class="linklist">
<li><a href="http://urban.cyberpunk.ru" target="_new">Urban Club</a> - only the name is enough. The Moscow Urban Club. Unfortunately, it's <font color="#ffffff">abandoned</font>. [rus] [eng]
<li><a href="http://cyberpunk.ru" target="_new">CYBERPUNK.RU</a> - The Russian cyberpunk project. [rus]
<li><a href="http://www.black-light.ru/urbantrip/index.php" target="_new">Urban Trip</a> - A photogallery of industrial abandoned sites inside and around of Moscow. [rus] [eng]
<!-- <li><a href="http://teenspirits.by.ru" target="_new">TeenSpirit's Trips</a> - Photos of abandoned and unusual buildings, urban and other trains, metro. -->
<li><a href="http://c25.ru" target="_new">c25.ru</a> - S-25 - Everything known about the Soviet Strategic Air Defense System. [rus]
</ul>
</ul>
<hr align="left" width="10%">
<div align="center">
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
<div align="left" class="itext">Industrial</div>
<ul class="itext">
<li>Russian (ex USSR)
<ul align="left" class="linklist">
Industrial photography:<br>
<li><a href="http://www.promzona.org" target="_new">Promzona.org</a> - Industrial walkarounds with technical comments. [rus]</li>
<li><a href="http://docent.msk.ru" target="_new">Docent's house</a> - Site with a gallery of abandoned areas. [rus][eng]</li>
<!-- <li><a href="http://promzona.myhome.ru" target="_new">Promzona</a> - A Russian industrial photoalbum. [rus]</li>
<li><a href="http://lost.biker.ru" target="_new">Lost somewhere in time</a> - This project is devoted to everything that created by people and resting now in dirt and silence. [rus]</li> -->
<li><a href="http://design.mykurkino.ru/euth/index.php" target="_new">EUTHANASIA</a> - Industrial photoalbum. [rus]</li>
<li><a href="http://1ndustr1al.tk" target="_new">Industrial Area</a> - An abandoned Byelorussian industrial sites. [rus]</li>
<li><a href="http://rust.michael.pp.ru" target="_new">Hryundels photos</a> - Industrial, abandoned, underground, military and other similar things. [rus]</li>
<li><a href="http://dark-foto.narod.ru/" target="_new">Industrial Decadence</a> - A photogallery of industrial zones. [rus]</li>
<br>
Diggers:
<li><a href="http://duskzone.xost.ru" target="_new">Dusk Zone</a> - The deep undeground of Russia. [rus]</li>
<li><a href="http://www.diggers.ru" target="_new">diggers.ru</a> - Web site of Moscow Diggers. [rus]</li>
</ul><br>


<li>Foreign
<ul align="left" class="linklist">

<?php
while ($row = mysqli_fetch_array($result))
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
<br>".$counter." links";
?>
<br><br>
<hr>
<li><a href="http://www.infiltration.org" target="_new">Infitration.Org</a> -  The Industrial and Undeground exploration web ring.</li>
<li><a href="http://www.zone-tour.com" target="_new">Zone Tour</a> - A great base of undeground and abandoned sites.</li>
<li><a href="http://www.dubtown.de" target="_new">Dubtown</a> - The Industrial culture of Deutchland. Extremely good photographs.</li>
<li><a href="http://www.abandoned-places.com" target="_new">Abandoned Places</a> - Photos of abandoned places. May be, the oldest and most popular site in the net.</li>
<li><a href="http://lostamerica.com/" target="_new">Lost America</a> - Night photographs of lost America.</li>
<li><a href="http://www.forgotten-places.com" target="_new">Forgotten places</a> - Photoraphs of forgotten places.</li>
<li><a href="http://www.tul.ca" target="_new">The Urban Landscape</a> - Explore a new world closer than you think.</li>
<li><a href="http://users.pandora.be/lab-wan" target="_new">L a b - W a n</a> - Day and night photography of Abandoned places in Belgium.</li>
<li><a href="http://www.lost-least.it" target="_new">Lost and Least</a> - Ruins, Abandoned buildings, old railways... A Fighting Photography to show that Nothing is only what seems. Never.</li>
<li><a href="http://www.ohiotrespassers.com" target="_new">Ohio Trespassers</a> - Photographs & information about abandoned locations in the midwest - hospitals, asylums, prisons lived alone & forgotten.</li>
<li><a href="http://www.lipinski.de" target="_new">Klaus Lipinski's SPLITSITE</a> - Photographs of abandoned industrial buildings and areas located in Germany and Belgium.</li>
<li><a href="http://www.worldoftheshadows.co.uk" target="_new">World of the shadows</a> - Photographs of Industrial areas.</li>
<li><a href="http://www.abandonedbutnotforgotten.com" target="_new">Abandoned But Not Forgotten</a> - About Abandoned Sites , Nature , Museums and Historical collections thru out USA.</li>
<li><a href="http://oabonny.freehostia.com/" target="_new">oabonny.tripod.com</a> - Old Abandoned Buildings of Northern NY.</li>
<li><a href="http://ericlusito.com/urss-vestiges/uk/index.html" target="_new">ericlusito.com</a> - The lost vestiges of the Soviet Empire. Eric Lucito photographs.</li>
<!-- <li><a href="http://www.derelict-uk.co.uk" target="_new">Derelict UK</a> - Abandoned places in United Kindom.</li> -->
<li><a href="http://www.hfinster.de/StahlArt/index.html" target="_new">Industrial Photography Archive</a> - Industrial photography, history and architecture.</li>
<li><a href="http://www.getfancy.net/" target="_new">The Getfancy Crew</a> - Great photograph from people who explore abandoned buildings 'n shit.</li>
<li><a href="http://www.urb-ex.pl/?lang=en" target="_new">Abandoned places</a> - abandoned places photography by Chris (Poland).</li>
<li><a href="http://www.comperes.org/" target="_new">Comperes' Exploration</a> - French urban exploration team. Good undeground photographs.</li>
<li><a href="http://www.m-u-d.ca/index.html" target="_new">m.u.d.</a> - Pure urban decay, modern ruins and dilapidated architecture.</li>
<li><a href="http://urbex.mikeonline.ca" target="_new">urbex.mikeonline.ca</a> - Galleries of Mike explorations, and resources for those just starting out.</li>
</ul>
</ul>
<!-- <a href="http://factorial.kotomsk.ru" target="_new">Factorial</a> - Russian urban exploration community -->
<!-- <p align="left" class="text">
<a href="http://www.diggers.ru" target="_new">Web site of Moscow Diggers</a> - Moscow digers. <font color="#ff1111">R</font> -->
<!--
<a href="http://digitalcity.boom.ru" target="_new">Digital City</a> - escape from reality. NeoFiction home page. <font color="#ff1111">R</font> -->
<!--
<a href="http://deadcities.boom.ru" target="_new">Dead Cityes</a> - Home Page of Pompeya (russian).
-->
<hr align="left" width="10%">
<div class="stext" align="right">If you think that a link to your website should be in this list <a href="mailto:uryevich@gmail.com?subject=www.abandoned.ru%20links">let me know</a>.</div>
<div class="stext" align="right">You can use <a href="/banners/index.html">that banners</a> for your links page.</div>
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
