<?php
<<<<<<< HEAD
 error_reporting(E_ALL);
include 'db_ini.php';
$d=0;
$query="SELECT * FROM glrs WHERE trip=0 ORDER BY dir";;
if (!$result=mysql_query($query, $dbid)) { echo '<br>error!<br>'; echo mysql_errno() . ": " . mysql_error(). "\n"; };
   while ($row=mysql_fetch_row($result)) {
   $directories[$d]=$row[0];
   $d++;
   }
$s_dbrows=mysql_num_rows($result);

// define epigraph corresponding to visitor language
// $pos_lgv_ru=substr_count($_SERVER["HTTP_ACCEPT_LANGUAGE"],"ru");
// if ($pos_lgv_ru<1) {
$epigraph = "\n <div align=\"right\" class=\"text\">Future is waiting for us. With hollow skeletons<br>
or downsized ugly creatures with bulgy eyes - it's not important.<br>
Important thing is that there will be a footprint left.<br>
Footprint of civilization. Cement, metal and dust not claimed by anyone.<br>
<font color=\"#ffffff\">
They are eternity.</font></div>
";
//	}
// else {
//	$epigraph = "\n <div align=\"right\" class=\"text\">������� ��� ���. �������������� ���������<br>
// ��� ������������ ������������� �������� - �� �����.<br>
// ����� ��� ��������� ����. ���� �����������.<br>
// ������ �� ������ �����, ������, ����.<br>
// <font color=\"#ffffff\">
// ��� ����� ���������.</font></div>
// ";
// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
<title>Abandoned</title>
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
 <META NAME="Keywords" CONTENT="industrial, places, urban, decay, urbantrip, abandoned, plant, factory, zone, �����, ����, �����, ���������, �����������, �������������, ��������������">
 <META NAME="Description" CONTENT="Photographs of abandoned plants and factories, unfinished buildings, industrial sites">
<style type="text/css">
body { background-color: #000017; background-image: url("abg.png"); background-repeat: no-repeat; }
body { margin-top: 0em; }
hr { border: 1px solid #747687; }
div.key { font-size: 1px; color: #000017; }
.text { font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; text-decoration: none; }
.stext { font-family: Arial; font-size: 10pt; color: #cfcfcf; font-weight: bold; text-decoration: none; }
.snbtext { font-family: Arial; font-size: 9pt; color: #cfcfcf; text-decoration: none; }
.itext { font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; font-style: italic; text-decoration: none; }
.ctext { font-family: Verdana, Arial; font-size: 8pt; color: #a4b6c7; font-weight: bold; font-style: italic; text-decoration: none; }
.utext { font-family: Arial; font-size: 8pt; color: #a4b6c7; font-style: italic; text-decoration: none; }
.link { font-family: Verdana, Arial; font-size: 9pt; font-weight: bold; }
</style>
<link rel="icon" href="http://www.abandoned.ru/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://www.abandoned.ru/favicon.ico" type="image/x-icon"> 
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
<div class="key">Photographs of abandonned plants, unfinished buildings, industrial sites. ���������� ����������� �������, ������������� ������, �������������� ���. <br>unfinished factory industrial photo urban photo urbantrip industrial places urban abandoned base zone ����� ���� ������� ����� ��������� ����������� ������������� ���� �������������� ���������� ���� ����������</div>
<?php
// show epigraph corresponding to visitor language
echo $epigraph;
?>
<br>
<?php require ('menu.php');?>
<br>
        <!-- table with previews start  -->
<table align="center" border="0" cellpadding="0" cellspacing="0">
<colgroup>
<col width="230">
<col width="2">
<col width="230">
<col width="2">
<col width="230">
<col width="2">
<col width="230">
</colgroup>
<!--
<tr bgcolor="#747687" height="2">
<td colspan=7><img src="sp.gif" width="1" height="2" border="0"></td> -->
<?php
$rows=ceil($s_dbrows/4); //���������� ���������� ����� � �������
echo '<tr align="center">
';
for ($r=0; $r<=($rows-1); $r++){ //���� ��� ����� �������
   if ($r!=0) {
      echo '<tr bgcolor="#747687">
<td colspan=7 height="2"><img src="sp.gif" width="1" height="2" border="0"><tr>
';
      }

for ($c=0; $c<=3; $c++){ //���� ��� �������� �������
$x=$r*4+$c; //���������� ���������� ����� ������
echo '<td align="center" valign="top" class="stext">
';
   if (isset($directories[$x])) { //���� ��� ���� ������ � ����
   $query="SELECT * FROM glrs WHERE dir=$directories[$x]";
   $result=mysql_query($query, $dbid) or die ("<font color=#ff3333><b>Something wrong...</b></font>");
   $particular_row=mysql_fetch_array($result);
   $dir=$particular_row[0];
   $descr=$particular_row[1];
   $locat=$particular_row[2];
   $date=$particular_row[3];
   $file=$dir.'.jpg';
   $file_info=@getimagesize('thumb/'.$dir.'.jpg');
   $pic_size=$file_info[3]; //��� ������ �������� � ������� 'leight=xx widh=yy'
   echo '
   <table border="0" cellpadding="0" cellspacing="5">
      <tr>
      <td align="center" height="160" valign="middle">
      <a href="thumb.php?gal='.$dir.'">
      <img src="thumb/'.$dir.'.jpg" '.$pic_size.' border="0" alt="'.$descr.'"></a>
      <tr>
      <td align="center" valign="top" class="stext">
      '.$descr.'<br>'.$locat.'<br>';
      echo '
      <font class="utext">Added '.$date.'</font>
   </table>
';
   }
   else { echo '&nbsp;'; }
   if ($c<=2){
      if (isset($directories[$x])){ // ���� ���� ��� ������ � ����, ���������� �����������
      echo '<td bgcolor="#747687"><img src="sp.gif" width="1" height="1" border="0">';
      }
      else { echo '<td>';
      }
   }
}
}
echo '
</table>';
/*
 echo '<tr bgcolor="#747687" height="1">
 <td>
 <img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td>
 <img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td>
 <img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td>
 <img src="sp.gif" width="2" height="2" border="0"></td>
 </tr>';
echo '</table>
';
*/

// <!-- trips section -->

$query="SELECT * FROM glrs WHERE trip=1 ORDER BY dir";;
$result=mysql_query($query, $dbid);
$t_dbrows=mysql_num_rows($result);

echo '<!-- <hr width="90%" align="center"> --><br>
<table align="center" border=0 cellPadding=0 cellSpacing=5 width="70%">
  <tr>
    <td align="left" class="text" colspan=3>Trips:</td>
  </tr>
  <tr>
    <td bgcolor="#747687" colspan=3><img border=0 height=2 src="sp.gif" width=2></td>
  </tr>
';
   for ($r=0; $r<=$t_dbrows; $r++) {
   $particular_row=mysql_fetch_array($result);
      if ($particular_row) { //���� ��� ���� ������ � ����
      $dir=$particular_row[0];
      $descr=$particular_row[1];
      $date=$particular_row[3];
      echo '
 <tr>
	<td align="right" width="20%">
    <a class="link" href="thumb.php?gal='.$dir.'">Trip '.$date.'</a></td>';
if ($r==0) {
echo '
	<td bgcolor="#747687" rowspan="'.$t_dbrows.'"><img border=0 height=2 src="sp.gif" width=2></td>';
=======
error_reporting(E_ALL); //debug

// load pages only from index 
define("LAND_PAGE", TRUE);

// get 'do' from URL
$do = $_GET['do'] ?? 'none';

// include module/page, schosen by 'do' 
switch ($do)
{
        // case 'start' : include "main.php"; break;
		case 'about' : include "about.php"; break;
        case 'links' : include "linx.php"; break;
        case 'news' : include "news.php"; break;
		case 'pan' : include "pan.php"; break;
		case 'pic' : include "pic.php"; break;
		case 'texts' : include "texts.php"; break;
        case 'thanks' : include "thanx.php"; break;
        case 'thumb' : include "thumb.php"; break;
        case 'trips' : include "trips.php"; break;
        default : include "main.php";
>>>>>>> master
}
?>