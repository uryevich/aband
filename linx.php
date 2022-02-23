<?php
if (!defined("LAND_PAGE")) { // check call from index, not self
	header('Location: ./index.php'); 
	exit; 
}
error_reporting(E_ALL); //debug
// error_reporting(0);

include 'db_ini.php';

$query="SELECT * FROM ab_links WHERE active=1 ORDER BY cat4 DESC, id";
$result=mysqli_query($mysqli, $query);
$counter=0;
?>

<!DOCTYPE html>
<html>
<head>
<title>Abandoned - Links</title>
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
.linklist {  font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; text-decoration: none; line-height: 1.6; list-style: square; }
</style>

<?php require ('gtag.js') ?>
<?php require ('adSence.js') ?>

</head>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<?php require ('menu.php'); ?>
<p align="right" class="stext">The links section contains a great collection of other internet sites made by people with similar interests.</p>
<hr width="40%" align="right">
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
<div align=\"left\" class=\"text\">".$counter." links</div>";
?>

<hr align="left" width="10%">
<div class="stext" align="right">If you'd like add to this list link to your website related to UE or similar <a href="mailto:uryevich@gmail.com?subject=www.abandoned.ru%20links">let me know</a>.</div>
<?php require ('copyright.php'); ?>
<hr>
<div align=right><?php include 'hotlog.php'; ?></div>
</body>
</html>
