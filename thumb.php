<?php // require 'stat/stat.php';
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">
<HTML>
<HEAD>
<?php

require 'db_ini.php';

// проверка значения полученного id на "спам"
if (!$_GET["gal"]){ $gal=1; } else { $gal=$_GET["gal"]; }
if (!preg_match("/^[0-9]+$/", $gal)) { $gal=1; }

$dir_data=select_gal($gal);
// $query="SELECT * FROM glrs WHERE dir=$gal";
// $result=mysql_query($query, $dbid) or die ("
// <font color=#bb0000><b>Can not select from database, wrong parameter used</b><//// font>");
// $dir_data=mysql_fetch_array($result);
   if ($dir_data == "") {
   $gal=1;
   $dir_data=select_gal($gal);
   }
$dir_descr=$dir_data["descr"];
$dir_locat=$dir_data["locat"];
$dir_date=$dir_data["dat"];

 $x=0;
 $query="SELECT * FROM files WHERE dir='$gal' ORDER BY fil";
 $result=mysql_query($query, $dbid);
    while ($file_data=mysql_fetch_array($result)) {
       if ($file_data["pan"]==1) {
       	$pan=$file_data["fil"];
       	$pan_id=$file_data["id"];
       	$pan_file=$gal.'/s/'.$pan.'.jpg';
		 	$pan_file_info=@getimagesize($pan_file);
		 	$pan_size=$pan_file_info[3];
       	}
       	else {
       	$id[$x]=$file_data["id"];
       	$pic[$x]=$file_data["fil"];
   		$descr[$x]=$file_data["descr"];
   		$file[$x]=$gal.'/s/'.$pic[$x].'.jpg';
   		$file_info=@getimagesize($file[$x]);
   		$pic_size[$x]=$file_info[3];
       	$x++;
       	}
    }
$s_dbrows=$x;

echo '<title>Abandoned - '.$dir_descr.'</title>';
?>
 <META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=windows-1251">
 <META NAME="Keywords" CONTENT="industrial, places, urban, abandoned, plant, base, zone, завод, зона, место, брошенные, заброшенные, недостроенный, база">
 <META NAME="Description" CONTENT="Photo base of abandonned plants, unfinished buildings, industrial sites. <?php echo $dir_descr ?>.">
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
<?php require ('menu.php') ?>
<?php
echo '<p align="right" class="stext">'.$dir_descr.' ('.$dir_locat.')<br>
<font class="utext">Added '.$dir_date.'</font>
<center>
<a href="/." class="link">Main page</a><hr width="20%">
';
// теперь строим таблицу
//определяем пременные для размеров таблицы
$rows=ceil($s_dbrows/5); //определяем количество строк в таблице
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
   if (isset($pan)){	echo '
	<tr>
		<td colspan=9 align="center">
			<table cellpadding=5><tr><td>
			<a href="pic.php?id='.$pan_id.'"><img src="'.$gal.'/s/'.$pan.'.jpg" '.$pan_size.' border=0 alt="Panorama"></a>
			</td></tr></table>
		</td>
	</tr>
	<tr>
		<td colspan=9 bgcolor="#747687" height=2><img src="sp.gif" border=0 width=1 height=2></td>
	</tr>
';
   }

for ($r=0; $r<=($rows-1); $r++){ //цикл для строк таблицы
echo '
<tr>';
   for ($c=0; $c<=4; $c++){ //цикл для столбцов таблицы
   $x=$r*5+$c; //определяем порялковый номер ячейки
      if (isset ($id[$x])){
   		// $query="SELECT * FROM files WHERE id='$id[$x]'";
   		// $result=mysql_query($query, $dbid);
   		// $file_data=mysql_fetch_array($result);
   		// $pic=$file_data["fil"];
   		// $descr=$file_data["descr"];
   		// $file=$gal.'/s/'.$pic.'.jpg';
   		// $file_info=@getimagesize($file);
   		// $pic_size=$file_info[3];
   		echo '
   	<td align="center">
		<table cellpadding=5><tr><td>
     	<a href="pic.php?id='.$id[$x].'">
     	<img src="'.$file[$x].'" '.$pic_size[$x].' border=0 alt="'.$descr[$x].'"></a></td></tr>
	  	</table>
	</td>';
      }
      else { echo '
	<td>&nbsp;</td>'; } //cell without image
      	if ($c<4) { //column divider
      		if (isset ($id[($x+1)])) {
      			echo '
	<td bgcolor="#747687"><img src="sp.gif" border=0 width=2 height=1></td>';
        	} else { echo '
	<td></td>'; } // very empty space (for divider)
      }
   }
echo '
</tr>
';
if ($r<>($rows-1)) echo '<tr><td bgcolor="#747687" colspan=9 height=2><img src="sp.gif" border=0 width=1 height=2></td></tr>'; //rows divider
}
?>
</table>
</center>
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
<?php function select_gal ($dir)
	{
    require 'db_ini.php';
    $query="SELECT * FROM glrs WHERE dir=$dir";
	$result=mysql_query($query, $dbid);
	$dir_data=mysql_fetch_array($result);
    return $dir_data;
    }
?>