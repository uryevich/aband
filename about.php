<?php
require 'db_ini.php';

// $query="SELECT * FROM glrs WHERE trip=0";
// $result=mysql_query($query, $dbid);
// $objects=mysql_num_rows($result);

// $query="SELECT * FROM glrs WHERE trip=1";
// $result=mysql_query($query, $dbid);
// $trips=mysql_num_rows($result);

$query="SELECT * FROM glrs";
$result=mysql_query($query, $dbid);
$objects=mysql_num_rows($result);

$query="SELECT * FROM files";
$result=mysql_query($query, $dbid);
$photos=mysql_num_rows($result);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
<title>Abandoned - About</title>
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
</style>
<!-- G+ -->
<link href="https://plus.google.com/107941468976926491069" rel="publisher" />
<!-- G+ -->
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
<?php require 'menu.php'; ?>

<p align=right class=stext><font color="#ffffff">Abandoned</font> is a website with photographs of abandoned plants, unfinished buildings, industrial sites. Most of them are situated near in Russia. I will do my best to update this photo base with a lot of other objects and sites which exist somewhere in the world.<hr width="40%" align=right></p>
<table border=0 cellpadding=0 cellspacing=5 width="100%">
<tr>
<td align=right valign=top>
<img src="i.jpg" width=320 height=320 align=left alt="Uryevich himself"></td>
<td align=left class=text>
Who I am?<br><br>
&nbsp;&nbsp;&nbsp;I'm Uryevich. From my really happy childhood I developed a liking for any rusty metal constructions, cement blocks and for the silence of the wind which walks through this. I like them because there is an infinite life that stays there throughout the years...
<p>
&nbsp;&nbsp;&nbsp;Most abandoned buildings, plants and areas appeared in the Soviet Russia ('70-'80) because they belonged to the "state" (meaning nobody) and afterwards ('90) as a result of the economic crisis. But each place has its own story (in which I, to be honest, do not have much interest).
<p>
&nbsp;&nbsp;&nbsp;I think we are all not indifferent to abandoned things. The Abandoned have some sort of a strong and complicated connection with our souls; some people get scared and try to escape their impressions, some fight with them and try to destroy or rebuild or just leave their own footprint on the abandoned site to prove that they're stronger than this world. And some do not try to do anything - they just look and listen to the Abandoned, enjoying those impressions, feeling the real meaning of time. I am one of them.
<p>
&nbsp;&nbsp;&nbsp;If you have something to say about this site, your site or whatever, you can write me a <a href="mailto:uryevich@gmail.com?subject=www.abandoned.ru">letter</a>.
<p align=right class=text>
At the moment 'Abandoned' contains <i><?php echo $photos ?> photos</i> in <i><?php echo $objects ?> galeries</i>.<br>
<br>&nbsp;&nbsp;&nbsp;&nbsp;
<!-- G+ -->
<!-- Place this tag where you want the badge to render -->
<a href="https://plus.google.com/107941468976926491069?prsrc=3" style="text-decoration:none;"><img src="https://ssl.gstatic.com/images/icons/gplus-16.png" alt="" style="border:0;width:16px;height:16px;"/></a>
<!-- G+ -->
&nbsp;&nbsp;&nbsp;&nbsp;
</p>

</td>
</tr>
</table>
<?php require ('copyright.php'); ?>
<hr>
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