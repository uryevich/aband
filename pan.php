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
    $current_id=1;
} else {
    $current_id=$_GET["id"];
}

/* 
$query="SELECT * FROM files WHERE id=$current_id";
$query="SELECT * FROM files WHERE dir='$dir' ORDER BY fil";

$query="SELECT * FROM files WHERE dir=(SELECT dir FROM files WHERE id=$current_id) ORDER BY fil";
 */

$query="SELECT * FROM files WHERE id=$current_id";
$result=mysqli_query($mysqli, $query) or die ("
<font color=#bb0000><b>Can not select from database</b></font>");
$file_data=mysqli_fetch_array($result);
$dir=$file_data[1];
$file_name=$file_data[2];
$file='./images/'.$dir.'/'.$file_name;
$file_descr=$file_data[3];
$file_descrm=$file_data[4];
$file_size_temp=getimagesize($file.'.jpg');
$file_size=$file_size_temp[3];

$query="SELECT * FROM glrs WHERE dir=$dir";
$result=mysqli_query($mysqli, $query) or die ("
<font color=#bb0000><b>Can not select from database</b></font>");
$dir_data=mysqli_fetch_array($result);
$dir_descr=$dir_data[1];
$dir_locat=$dir_data[2];
$dir_date=$dir_data[3];

 $x=0;
 $z=0;
 $query="SELECT * FROM files WHERE dir='$dir' ORDER BY fil";
 $result=mysqli_query($mysqli, $query) or die ("
<font color=#bb0000><b>Can not select from database</b></font>");
    while ($file_id_count=mysqli_fetch_array($result)) {
       if ($file_id_count['pan']!=1) {
       $id_all[$x]=$file_id_count[0];
         if ($id_all[$x]==$current_id) { $z=$x; 
		 }; //переменная $z определяет положение id текушего фото в массиве $id_all.
       $x++;
       }
    }
    $x--;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
<?php
echo '<title>Panorama of '.$dir_descr.' - Abandoned</title>';
?>
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
 <META NAME="Keywords" CONTENT="adventure, industrial, places, urban, abandoned, plant, base, zone, завод, зона, место, брошенные, заброшенные, недостроенный, база">
 <META NAME="Description" CONTENT=<?php echo '"'.$dir_descr.' - '.$file_descr.'"' ?>>
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
</HEAD>
<BODY alink=#ff2040 link=#00b0f0 text=#ffffff vlink=#00b0d0>
<!-- menu -->
<?php require ('menu.php') ?>
<!-- header end -->

<!-- the picture part begining -->
<br>
<table align="center" border="0" width="100%" cellpadding="1" cellspacing="0">
<tr>
<td width="30%">
   <table align="center" border="0" bgcolor="#747687"  cellpadding="2" cellspacing="0" height="100%" width="100%">
        <tr>
        <td>
        <table align="center" border="0" cellpadding="2" cellspacing="0" height="100%" width="100%">
                <tr>
                <td align="left" class="stext">
<?php echo $dir_descr.' ('.$dir_locat.') <font class="utext">'.$dir_date.'</font>' ?>
                </td>
                </tr>
        </table>
        </td>
        </tr>
   </table>
</td>
<td>
   <table align="center" bgcolor="#747687"  cellpadding="2" cellspacing="0" height="100%" width="100%">
        <tr>
        <td>
        <table align="center" cellpadding="2" cellspacing="0" height="100%" width="100%">
                <tr>
                <td align="center" class="link">


<table align="center" cellpadding="0" cellspacing="0">
<tr>
<td class="link">
<a href=<?php echo '"./index.php?do=thumb&dir='.$dir.'"' ?> class="link">Preview screen</a>&nbsp;&nbsp;
</td>
<td class="link">
<font color="#747687">|</font>
</td>
<?php
for ($d=0; $d<=$x; $d++) {
echo '<td class="link" align="center">';
   echo '
   <a href="./index.php?do=pic&id='.$id_all[$d].'">'.($d+1).'</a>
   </td>
   ';
   echo '
   <td class="link">
   <font color="#747687">|</font>
   </td>
   ';
}
   if (isset($id_all[0])) {
   echo '<td class="link">
<a href="./index.php?do=pic&id='.$id_all[0].'">&nbsp;&nbsp;&gt;&gt; </a>
</td>
   ';
   }
   else {
   echo '<td class="link"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>';
   }
   ?>
</tr>
</table>

                </td>
                </tr>
                </table>
        </td>
        </tr>
   </table>
</td>
</tr>
</table>
<?php
if (isset($id_all[0])) {
	echo '
<div align="center"><a href="./index.php?do=pic&id='.$id_all[0].'">
<img src="'.$file.'.jpg" '.$file_size.' border="0">
</a></div>
	'; } 
	else {
	echo '
<div align="center"><img src="'.$file.'.jpg" '.$file_size.' border="0"></div>
	'; }
require ('copyright.php'); ?>
<hr>
<div align=right><?php include 'hotlog.php'; ?></div>
</BODY>
</HTML>