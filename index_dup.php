<?php
 error_reporting(0);
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
//	$epigraph = "\n <div align=\"right\" class=\"text\">Ѕудущее ждЄт нас. ¬ыветрившимис€ скелетами<br>
// или низкорослыми большеглазыми уродцами - не важно.<br>
// ¬ажно что останетс€ след. —лед цивилизации.<br>
// Ќикому не нужный бетон, металл, пыль.<br>
// <font color=\"#ffffff\">
// ќни будут вечностью.</font></div>
// ";
// }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
<title>Abandoned</title>
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
 <META NAME="Keywords" CONTENT="industrial, places, urban, decay, urbantrip, abandoned, plant, factory, zone, завод, зона, место, брошенный, заброшенный, недостроенный, индустриальный">
 <META NAME="Description" CONTENT="Photographs of abandoned plants and factories, unfinished buildings, industrial sites">
<style type="text/css">
body {
background-color: #000017;
background-image: url("abg.png");
background-repeat: no-repeat;
}
body { margin-top: 0em; }
hr { border: 1px solid #747687; }
div.key { font-size: 1px; color: #747687; }
.text { font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; text-decoration: none}
.stext { font-family: Arial; font-size: 10pt; color: #cfcfcf; font-weight: bold; text-decoration: none}
.snbtext { font-family: Arial; font-size: 9pt; color: #cfcfcf; text-decoration: none}
.itext { font-family: Verdana, Arial; font-size: 11pt; color: #dfdfdf; font-weight: bold; font-style: italic; text-decoration: none}
.ctext { font-family: Verdana, Arial; font-size: 8pt; color: #a4b6c7; font-weight: bold; font-style: italic; text-decoration: none}
.utext { font-family: Arial; font-size: 8pt; color: #a4b6c7; font-style: italic; text-decoration: none}
.link { font-family: Verdana, Arial; font-size: 9pt; font-weight: bold}
</style>
<link rel="icon" href="http://www.abandoned.ru/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="http://www.abandoned.ru/favicon.ico" type="image/x-icon"> 
</HEAD>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<div class="key">Photographs of abandonned plants, unfinished buildings, industrial sites. ‘отографии заброшенных заводов, недостроенных зданий, индустриальных зон. <br>unfinished factory industrial photo urban photo urbantrip industrial places urban abandoned base zone завод зона фабрика место брошенный заброшенный недостроенный база индустриальные фотографии фото индастриал</div>
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
$rows=ceil($s_dbrows/4); //определ€ем количество строк в таблице
echo '<tr align="center">
';
for ($r=0; $r<=($rows-1); $r++){ //цикл дл€ строк таблицы
   if ($r!=0) {
      echo '<tr bgcolor="#747687">
<td colspan=7 height="2"><img src="sp.gif" width="1" height="2" border="0"><tr>
';
      }

for ($c=0; $c<=3; $c++){ //цикл дл€ столбцов таблицы
$x=$r*4+$c; //определ€ем пор€дковый номер €чейки
echo '<td align="center" valign="top" class="stext">
';
   if (isset($directories[$x])) { //если ещЄ есть запись в базе
   $query="SELECT * FROM glrs WHERE dir=$directories[$x]";
   $result=mysql_query($query, $dbid) or die ("<font color=#ff3333><b>Something wrong...</b></font>");
   $particular_row=mysql_fetch_array($result);
   $dir=$particular_row[0];
   $descr=$particular_row[1];
   $locat=$particular_row[2];
   $date=$particular_row[3];
   $file=$dir.'.jpg';
   $file_info=@getimagesize('thumb/'.$dir.'.jpg');
   $pic_size=$file_info[3]; //это размер картинки в формате 'leight=xx widh=yy'
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
   else { echo '&nbsp'; }
   if ($c<=2){
      if (isset($directories[$x])){ // если есть ещЄ запись в базе, показываем разделитель
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
    <td align="left" class="text" colspan=3>Trips:</td></tr>
  <tr>
    <td bgcolor="#747687" colspan=3><IMG border=0 height=2 src="sp.gif" width=2></td></tr>
  <tr>
';
   for ($r=0; $r<=$t_dbrows; $r++) {
   $particular_row=mysql_fetch_array($result);
      if ($particular_row) { //если ещЄ есть запись в базе
      $dir=$particular_row[0];
      $descr=$particular_row[1];
      $date=$particular_row[3];
      echo '
    <td align="right" width="20%">
    <a class="link" href="thumb.php?gal='.$dir.'">Trip '.$date.'</a></td>';
if ($r==0) {
echo '
    <td bgcolor="#747687" rowspan="'.$t_dbrows.'"><img border=0 height=2 src="sp.gif" width=2></td>';
}
echo '
    <TD align="left" class="stext" width="80%">'.$descr.'</TD></TR>';
      }
   }
?>
</table>
<!-- <hr width="90%" align="center"> -->
<br><br>
   <?php require ('menu.php'); ?>
   <?php require ('copyright.php'); ?>
<!--
<table align="center" bgcolor="#484a54" cellpadding=5 class="ctext">
<tr><td>
</td></tr></table>
-->
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
<div align="right"><?php include 'hotlog.php'; ?></div>
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