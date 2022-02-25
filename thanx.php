<?php
if (!defined("LAND_PAGE")) { // check call from index, not self
	header('Location: ./index.php'); 
	exit; 
}
error_reporting(E_ALL); //debug
// error_reporting(0);
?>
<!DOCTYPE html>
<html>
<head>
<title>Abandoned - Thanks</title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="keywords" content="adventure, industrial, places, urban, abandoned, plant, base, zone, завод, зона, место, брошенные, заброшенные, недостроенный, база">
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

<?php require ('gtag.js') ?>
<?php require ('adSence.js') ?>

</head>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<?php require ('menu.php'); ?>
<p align="right" class="stext">Peoples who opened to me and continue charge me to explore <font color="#ffffff">INDUSTRIAL</font>.
</p><hr width="40%" align="right">
<p align="left" class="text"><font color="#ffffff">Timophey</font> - His energy always force us to go. 
<a href="http://www.urbantrip.ru" target="_new" class="link">Link</a></p>
<p align="left" class="text"><font color="#ffffff">Volod</font> - the MAN who started all this and gather us under Urban Club.
<a href="http://urban.cyberpunk.ru" target="_new" class="link">Link</a></p>
<p align="left" class="text"><font color="#ffffff">NeoFiction</font> - she gives me a deep charge of Industrial by her storyes and ideas.
<!-- <a href="http://digitalcity.boom.ru" target="_new" class="link">Link</a> --></p>
<p align="left" class="text"><font color="#ffffff">Pompeya</font> - Designer, good friend.
<!-- <a href="http://deadcities.boom.ru" target="_new" class="link">Link</a> --></p>
<p align="left" class="text"><font color="#ffffff">nix[on]</font> - He is a man, who makes just a good mood in each trip.
<!-- <a href="http://cpt.nm.ru" target="_new" class="link">Link</a></p> -->
<p align="right" class="text">And I appreciate very much peoples who gave information, help or support me in Urban Exploration.
<br>
<?php require ('copyright.php'); ?>
<hr>
<div align="right"><?php include 'hotlog.php'; ?></div>
</BODY>
</HTML>