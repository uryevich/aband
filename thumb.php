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
<html>
<head>

<?php

// filter id
if (!filter_input(INPUT_GET, "dir", FILTER_VALIDATE_INT)) {
    $dir=1;
} else {
    $dir=$_GET["dir"];
}

$query="SELECT * FROM glrs WHERE dir=$dir";
$result=mysqli_query($mysqli, $query) or die ("
<font color=#bb0000><b>Can not select from database, wrong parameter used</b><//// font>");
$dir_data=mysqli_fetch_array($result);
   if ($dir_data == "") {
   $dir=1;
   $dir_data=select_gal($dir);
   }
$dir_descr=$dir_data['descr'];
$dir_locat=$dir_data['locat'];
$dir_date=$dir_data['dat'];

 $x=0;
 $query="SELECT * FROM files WHERE dir='$dir' ORDER BY fil";
 $result=mysqli_query($mysqli, $query);
    while ($file_data=mysqli_fetch_array($result)) {
       if ($file_data["pan"]==1) {
       	$pan=$file_data["fil"];
       	$pan_id=$file_data["id"];
       	$pan_file='./images/'.$dir.'/s/'.$pan.'.jpg';
		 	$pan_file_info=@getimagesize($pan_file);
		 	$pan_size=$pan_file_info[3];
       	}
       	else {
       	$id[$x]=$file_data["id"];
       	$pic[$x]=$file_data["fil"];
   		$descr[$x]=$file_data["descr"];
   		$file[$x]='./images/'.$dir.'/s/'.$pic[$x].'.jpg';
   		$file_info=@getimagesize($file[$x]);
   		$pic_size[$x]=$file_info[3];
       	$x++;
       	}
    }
$s_dbrows=$x;
mysqli_close($mysqli);

echo '<title>Abandoned - '.$dir_descr.'</title>';
?>
 <meta charset="UTF-8">
 <meta NAME="Keywords" CONTENT="industrial, places, urban, abandoned, plant, base, zone, завод, зона, место, брошенные, заброшенные, недостроенный, база">
 <meta NAME="Description" CONTENT="Photo base of abandonned plants, unfinished buildings, industrial sites. <?php echo $dir_descr ?>.">
<style type=text/css>
body { background-color: #000017; background-image: url("abg.png"); background-repeat: no-repeat; }
hr { border: 1px solid #747687; }
.text { font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; text-decoration: none; }
.stext { font-family: Arial; font-size: 10pt; color: #cfcfcf; font-weight: bold; text-decoration: none; }
.snbtext { font-family: Arial; font-size: 9pt; color: #cfcfcf; text-decoration: none; }
.itext { font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; font-style: italic; text-decoration: none; }
.ctext { font-family: Verdana, Arial; font-size: 8pt; color: #a4b6c7; font-weight: bold; font-style: italic; text-decoration: none; }
.utext { font-family: Arial; font-size: 8pt; color: #a4b6c7; font-style: italic; text-decoration: none; }
.link { font-family: Verdana, Arial; font-size: 9pt; font-weight: bold; }
</style>
<?php require ('gtag.js') ?>
<?php require ('adSence.js') ?>
</HEAD>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<?php require ('menu.php') ?>
<?php
echo '<p align="right" class="stext">'.$dir_descr.' ('.$dir_locat.')<br>
<font class="utext">Added '.$dir_date.'</font>
<center>
<a href="/." class="link">Main page</a><hr width="20%">
';
// build table now
// set variables for table size
$rows=ceil($s_dbrows/5); // set rows numder in table
echo '<table align="center" cellpadding="0" cellspacing="0" border=0>
<colgroup>
<col width=130>
<col width=1>
<col width=130>
<col width=1>
<col width=130>
<col width=1>
<col width=130>
<col width=1>
<col width=130>
</colgroup>
';
	if (isset($pan)){ 
		echo '
	<tr>
		<td colspan=9 align="center">
			<table cellpadding=5><tr><td>
			<a href="index.php?do=pan&id='.$pan_id.'"><img src="'.$pan_file.'" '.$pan_size.' border=0 alt="Panorama"></a>
			</td></tr></table>
		</td>
	</tr>
	<tr>
		<td colspan=9 style="height:2px;background-color:#747687"><img src="sp.gif" border=0 width=1 height=2></td>
	</tr>
';
   }

for ($r=0; $r<=($rows-1); $r++){ // loop for table rows
echo '
<tr>';
   for ($c=0; $c<=4; $c++){ // loop for table columns
   $x=$r*5+$c; // define cell number
      if (isset ($id[$x])){
   		echo '
   	<td align="center">
		<table cellpadding=5><tr><td>
     	<a href="index.php?do=pic&id='.$id[$x].'">
     	<img src="'.$file[$x].'" '.$pic_size[$x].' border=0 alt="'.$descr[$x].'"></a></td></tr>
	  	</table>
	</td>';
      }
      else { echo '
	<td>&nbsp;</td>'; } // cell without image
      	if ($c<4) { // column divider
      		if (isset ($id[($x+1)])) {
      			echo '
	<td bgcolor="#747687"><img src="sp.gif" border=0 width=2 height=1></td>'; // separator
        	} else { echo '
	<td></td>'; } // very empty space (for divider)
      }
   }
echo '
</tr>
';
if ($r<>($rows-1)) echo '<tr><td style="height:2px;background-color:#747687" colspan=9 ></td></tr>'; // rows separator
}
?>
</table>
</center>
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
<?php function select_gal ($dir)
	{
    require 'db_ini.php';
    $query="SELECT * FROM glrs WHERE dir=$dir";
	$result=mysqli_query($query, $dbid);
	$dir_data=mysqli_fetch_array($result);
    return $dir_data;
    }
?>