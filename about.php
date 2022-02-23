<?php
if (!defined("LAND_PAGE")) { // check call from index, not self
	header('Location: ./index.php'); 
	exit; 
}
error_reporting(E_ALL); //debug
// error_reporting(0);
// require 'db_ini.php';

// $query="SELECT * FROM glrs WHERE trip=0";
// $result=mysql_query($query, $dbid);
// $objects=mysql_num_rows($result);

// $query="SELECT * FROM glrs WHERE trip=1";
// $result=mysql_query($query, $dbid);
// $trips=mysql_num_rows($result);

// $query="SELECT * FROM glrs";
// $result=mysql_query($query, $dbid);
// $objects=mysql_num_rows($result);

// $query="SELECT * FROM files";
// $result=mysql_query($query, $dbid);
// $photos=mysql_num_rows($result);
?>
<!DOCTYPE html>
<html>
<HEAD>
<title>Abandoned - About</title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="keywords" content="adventure, industrial, places, urban, abandoned, plant, base, zone, uryevich, завод, зона, место, брошенные, заброшенные, недостроенный, база">
 <meta name="Description" content="Photo base of abandonned plants, unfinished buildings, industrial sites">
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

<?php require ('gtag.js') ?>
<?php require ('adSence.js') ?>

</head>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<?php require 'menu.php'; ?>

<p align=right class=stext><font color="#ffffff">Abandoned</font> is a website with photographs of abandoned plants, unfinished buildings, industrial sites. Most of them are situated near in Russia. I will do my best to update this photo base with a lot of other objects and sites which exist somewhere in the world.<hr width="40%" align=right></p>
<table border=0 cellpadding=0 cellspacing=5 width="100%">
<tr>
<td align=right valign=top>
<img src="i.jpg" width=320 height=320 align=left alt="Uryevich"></td>
<td align=left class=text>
Who I am?<br><br>
&nbsp;&nbsp;&nbsp;I'm Uryevich. From my really happy childhood I developed a liking for any rusty metal constructions, cement blocks and for the silence of the wind which walks through this. I like them because there is an infinite life that stays there throughout the years...
<p>
&nbsp;&nbsp;&nbsp;Most abandoned buildings, plants and areas appeared in the Soviet Russia ('70-'80) because they belonged to the "state" (meaning nobody) and afterwards ('90) as a result of the economic crisis. But each place has its own story (in which I, to be honest, do not have much interest).
<p>
&nbsp;&nbsp;&nbsp;I think we are all not indifferent to abandoned things. The Abandoned have some sort of a strong and complicated connection with our souls; some people get scared and try to escape their impressions, some fight with them and try to destroy or rebuild or just leave their own footprint on the abandoned site to prove that they're stronger than this world. And some do not try to do anything - they just look and listen to the Abandoned, enjoying those impressions, feeling the real meaning of time. I am one of them.
<p>
&nbsp;&nbsp;&nbsp;If you have something to say about this site, your site or whatever, you can write me a <a href="mailto:uryevich@gmail.com?subject=www.abandoned.ru">letter</a>.

</td>
</tr>
</table>
<?php require ('copyright.php'); ?>
<hr>

<div align=right><?php include 'hotlog.php'; ?></div>
</body>
</html>