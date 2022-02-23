<?php
if (!defined("LAND_PAGE")) { // check call from index, not self
	header('Location: ./index.php'); 
	exit; 
}
error_reporting(E_ALL); //debug
// error_reporting(0);

?>
<!DOCTYPE html>
<HTML>
<HEAD>
<title>Abandoned - News</title>
 <meta charset="UTF-8">
 <META NAME="Keywords" CONTENT="industrial, places, urban, abandoned, plant, base, zone, завод, зона, место, брошенные, заброшенные, недостроенный, база">
 <META NAME="Description" CONTENT="Photo base of abandonned plants, unfinished buildings, industrial sites. News section.">
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
<p align="right" class="stext">The news section say you what I have done to the site, what trips were and other things, that I have to point you attention on.
</p><hr width="40%" align="right">

<p align="left" class="text"><font color="#ffffff">26.04.2011</font> - Photos from Zone of Alienation (Chernobyl) added. <a href="thumb.php?gal=15">Zone of Alienation</a> and <a href="thumb.php?gal=15">Venicle graveyard</a>. Photos taken after 20 years of Chernobyl disaster.</p>

<p align="left" class="text"><font color="#ffffff">13.02.2006</font> - <a href="linx.php">Links section</a> updated.</p>

<p align="left" class="text"><font color="#ffffff">26.08.2005</font> - Great video footage and photographs of abandoned sites over the world you can see on a DVD "Echoes of Forgotten Places". <a href="http://www.scribblemedia.com/echoes.html" target="_blank">Check it out!</a>.</p>

<p align="left" class="text"><font color="#ffffff">16.05.2005</font> - New gallery: photographs of a <a href="thumb.php?gal=14">Sleeping Giants</a>.</p>

<p align="left" class="text"><font color="#ffffff">26.11.2004</font> - Site is not abandoned. After a long delay new photographs from <a href="thumb.php?gal=13">Abandoned indusrial Area</a> added.</p>

<p align="left" class="text"><font color="#ffffff">20.10.2003</font> - Photos from trip added: <a href="thumb.php?gal=20031019">Trip to Automobile Plant</a>.</p>

<p align="left" class="text"><font color="#ffffff">05.10.2003</font> - Photos from trip added: <a href="thumb.php?gal=20031005">Trip to Abandoned Hotel</a>.</p>

<p align="left" class="text"><font color="#ffffff">05.10.2003</font> - Photos from trip added: <a href="thumb.php?gal=20030906">Trip to Unfinished Printing Plant</a>.</p>

<p align="left" class="text"><font color="#ffffff">06.09.2003</font> - New gallery added: <a href="thumb.php?gal=12">Acetylene - Abandoned gas Plant</a>.</p>

<p align="left" class="text"><font color="#ffffff">13.07.2003</font> - Trip to Abandoned Industrial Aria taken. Photos for new gallery in progress.</p>

<p align="left" class="text"><font color="#ffffff">06.07.2003</font> - Another one trip to <a href="thumb.php?gal=20020331">Abandoned Gas Plant</a> taken. Photos will be added.</p>

<p align="left" class="text"><font color="#ffffff">22.06.2003</font> - New gallery added: <a href="thumb.php?gal=11">Derelict silicate plant</a>.</p>


<p align="left" class="text"><font color="#ffffff">02.04.2003</font> - New gallery added: <a href="thumb.php?gal=10">Unfinished abandoned hospital</a>.</p>
<p align="left" class="text"><font color="#ffffff">01.01.2003</font> - <font color="#ffffff"><u>www.abandoned.ru</u> now working.</font> Happy New Year!</p>
<p align="right" class="text">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;
What's now? I have to reorganize and add new galleries, add a forum and work on design.</p>
<p align="left" class="text"><font color="#ffffff">12.10.2002</font> - Photos from <a href="thumb.php?gal=20020331">trip to abandoned gas Plant</a> added.</p>
<p align="left" class="text"><font color="#ffffff">21.07.2002</font> - Trip to 'Tsemgigant' plant site taken. <!-- (Voskresensk area, Moscow countryside). --> Photos in progress.</p>
<p align="left" class="text"><font color="#ffffff">27.05.2002</font> - Domain 'abandoned.ru' registered.</p>
<p align="left" class="text"><font color="#ffffff">21.04.2002</font> - Site php test version started.</p>
<p align="left" class="text"><font color="#ffffff">26.11.2001</font> - Site new design pre addon.</p>
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