<?php
if (!defined("LAND_PAGE")) { // check call from index, not self
	header('Location: ./index.php'); 
	exit; 
}
error_reporting(E_ALL); //debug
// error_reporting(0);

include 'db_ini.php';

// filter id
if (!filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT)) {
    $id=1;
} else {
    $id=$_GET["id"];
}

$file_data=get_id($id);
$dir=$file_data["dir"];
$file_name=$file_data['fil'];
$file='./images/'.$dir.'/'.$file_name;
$file_descr=$file_data["descr"];
$file_descrm=$file_data["descrm"];
$file_size_temp=getimagesize($file.'.jpg');
$file_pan=$file_data["pan"];
$file_size=$file_size_temp[3];

// if pan picture in gallery
// put it first in id list

$query="SELECT * FROM glrs WHERE dir=$dir";
$result=mysqli_query($mysqli, $query) or die ("<font color=#bb0000><b>Can not select from database</b></font>");
$dir_data=mysqli_fetch_array($result);
$dir_descr=$dir_data["descr"];
$dir_locat=$dir_data["locat"];
$dir_date=$dir_data["dat"];


 $x=0;
 $z=0;
 $query="SELECT pan,id FROM files WHERE dir='$dir' ORDER BY fil";
 $result=mysqli_query($mysqli, $query) or die ("
<font color=#bb0000><b>Can not select from database</b></font>");
    while ($file_id_count=mysqli_fetch_array($result)) {
       if ($file_id_count["pan"]!=1) {
       $id_all[$x]=$file_id_count["id"];
         if ($id_all[$x]==$id) {
         $z=$x;
         }
       $x++;
       }
       else {
       $pan=$file_id_count["id"];
       }
    }
mysqli_close($mysqli);
// title
if ($file_descr!="") {
	$title=$file_descr.", ".$dir_descr; 
	}
	else {	
	$title=$dir_descr; 
	}
?>
<!DOCTYPE html>
<html>
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta name="keywords" content="adventure, industrial, places, urban, abandoned, plant, base, zone, завод, зона, место, брошенные, заброшенные, недостроенный, база">
 <meta name="Description" content=<?php echo "\"$dir_descr"," ", "$file_descr\"" ?>>
<title><?php echo strip_tags($title); ?>, Abandoned</title>
<style type="text/css">
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
<body alink="#ff2040" link="#00b0f0" text="#ffffff" vlink="#00b0d0">
<!-- menu -->
<?php require ('menu.php') ?>
<!-- header end -->

<!-- picture part begining -->
<table align="center" border="0" cellspacing="5" cellpadding="0" width="90%">
    <tr>
		<td width="80%">
			<table align="center" cellspacing="5" cellpadding="0" width="70%">
				<tr>
					<td align="center" class="link" colspan="3">
<a href=<?php echo '"./index.php?do=thumb&dir='.$dir.'"' ?> class="link">Preview screen</a>
					</td>
				</tr>
<!-- gallery navigation -->
<?php
if (isset ($pan)) { // if there is pan flag in gallery
	if ($file_pan==1) { // if current file is pan
		echo '
   <tr>
   <td align="center" class="link" colspan="3">
      <table align="center" bgcolor="#747687" cellpadding="2" cellspacing="0">
      <tr><td class="link">Panorama</td></tr></table>
   </td>
   </tr>
   ';
		}
	else {
		echo '
   <tr>
   <td align="center" class="link" colspan="3">
<a href="pic.php?id='.$pan.'" class="link">Panorama</a>
   </td>
   </tr>
   ';
		}
	}
?>
				<tr>
					<td class="link" align="right">
   <?php
   // навигациЯ "previous"
   if (($z!=0) and ($file_pan!=1)) {
      echo '
      <a href="./index.php?do=pic&id='.$id_all[$z-1].'" title="Previous"> &lt;&lt; </a>
      ';
      }
   else {
      echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
      }
   ?>
					</td>
					<td>
<table align="center" cellpadding="0" cellspacing="0">
<tr>
<?php
// links to all files in gallery
for ($c=0; $c<(ceil ($x/2)); $c++) {
if ($c<9) { $space="&nbsp;"; } else { $space=""; }
echo '<td class="link" align="center">';
if ($file_pan==1) {
	      echo '
      <a href="./index.php?do=pic&id='.$id_all[$c+1].'">'.$space.($c+1).$space.'</a>
      </td>
      ';
	}
	else {
		if ($c==$z) {
			echo '
			<table align="center" bgcolor="#747687" cellpadding="2" cellspacing="1">
			<tr><td class="link">
			'.$space.($c+1).$space.'
			</td></tr></table>
			</td>
			';
			}
			else {
			echo '
			<a href="./index.php?do=pic&id='.$id_all[$c].'">'.$space.($c+1).$space.'</a>
			</td>
			';
			}
	}
   if ($c+1!=(ceil ($x/2))) {
      echo '
      <td class="link">
      <font color="#747687">|</font>
      </td>
      ';
      }
}
?>
</tr></table>
<table align="center" cellpadding="0" cellspacing="0">
<tr>
<?php
// second navigation row
for ($d=$c+1; $d<=$x; $d++) {
if ($c<9) { $space="&nbsp;"; } else { $space=""; }
echo '<td class="link" align="center">';
   if ($d-1==$z) {
   echo '
   <table align="center" bgcolor="#747687" cellpadding="2" cellspacing="0">
   <tr><td class="link">'.$space.($d).$space.'</td></tr></table>
   </td>
   ';
   }
   else {
   echo '
   <a href="./index.php?do=pic&id='.$id_all[$d-1].'">'.$space.($d).$space.'</a>
   </td>
   ';
   }
   if ($d!=$x) {
   echo '
   <td class="link">
   <font color="#747687">|</font>
   </td>
   ';
   }
}
?>
</tr>
</table>
   </td>
   <td class="link" align="left">
   <?php
   // "next" navigation link
	if ($file_pan==1) {
		echo '
		<a href="./index.php?do=pic&id='.$id_all[$z].'" title="Next"> &gt;&gt; </a>
		';
		}
	else {
		if ($z+1!=$x) {
			echo '
			<a href="./index.php?do=pic&id='.$id_all[$z+1].'" title="Next"> &gt;&gt; </a>
			';
			}
		else {
			echo '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
		}
	}
   ?>
   </td>
   </tr></table>
<!--   // gallery navigation end -->
</td>
<td bgcolor="#747687" width="1"><img src="sp.gif" width="1" height="1" border="0">
</td>
<td width="198" valign="bottom">
<!-- galery description -->
<?php echo '<p align="right" class="stext">'.$dir_descr.' <br>('.$dir_locat.')</p>
' ?>

</td>
</tr>
<tr>
<td style="height:2px;background-color:#747687" colspan=3><!-- <img src="sp.gif" width="2" height="2" border="0"> --> </td>
<tr>
<td align="center" class="link" rowspan="3">

<?php

	if ($file_pan==1) {
		if ($z+1!=$x) { // if current file not last, bind link to next file 
						// if current file is last, then link to thumb page
			echo '<a href="./index.php?do=pic&id='.$id_all[$z].'">
			<img src="'.$file.'.jpg" '.$file_size.' border="0" alt="'.$file_descr.'">
			</a>';
		} else {
			echo '<a href="./index.php?do=thumb&dir='.$dir.'">
			<img src="'.$file.'.jpg" '.$file_size.' border="0" alt="'.$file_descr.'">
			</a>';
		}
	}
	else {	
		if ($z+1!=$x) { // if current file not last, bind link to next file 
						// if current file is last, then link to thumb page
			echo '<a href="./index.php?do=pic&id='.$id_all[$z+1].'">
			<img src="'.$file.'.jpg" '.$file_size.' border="0" alt="'.$file_descr.'">
			</a>';
		} else {
			echo '<a href="./index.php?do=thumb&dir='.$dir.'">
			<img src="'.$file.'.jpg" '.$file_size.' border="0" alt="'.$file_descr.'">
			</a>';
		}
	}
?>
</td>
<td rowspan="3" bgcolor="#747687">
<img src="sp.gif" width="1" height="1" border="0"></td>
<td align="right" class="text" valign="top">
<br>
<p class="itext">
<?php echo $file_descr; ?>
</p>
<p class="snbtext">
<?php echo $file_descrm; ?>
</p>

</td>
</tr>
<tr>
<td valign="bottom" rowspan="2">
<p align="right" class="utext"> Added
<?php echo $dir_date; ?>
</p>
<div align="left">
<!-- google_ad_start -->
<script type="text/javascript"><!--
google_ad_client = "pub-9659481331039989";
/* 200x90, created 4/1/10 */
google_ad_slot = "4436538283";
google_ad_width = 200;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
<!-- google_ad_end -->
</div>
<hr>
<?php require ('copyright.php'); ?>
</td>
</tr>
</table>
<hr>
<div align=right><?php include 'hotlog.php'; ?></div>

</body>
</html>
<?php
function get_id ($idf)
	{
    require 'db_ini.php';
	$query="SELECT * FROM files WHERE id=$idf";
	$result=mysqli_query($mysqli, $query);
	$file_data=mysqli_fetch_array($result);
    return ($file_data);
	}
?>