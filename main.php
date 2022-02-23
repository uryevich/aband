<?php
if (!defined("LAND_PAGE")) { // check call from index, not self
	header('Location: ./index.php'); 
	exit; 
}
error_reporting(E_ALL); //debug
// error_reporting(0);

include 'db_ini.php';

// read directories data to array
$gal_counter=0;
$trip_counter=0;
$query="SELECT * FROM glrs ORDER BY dir";
$result = mysqli_query($mysqli, $query);

mysqli_close($mysqli);

foreach ($result as $row) {
	if ($row['trip'] == 0) {
		$gallery[$gal_counter]=$row;
		$gal_counter++;
		}
	if ($row['trip'] == 1) {
		$gallery_trip[$trip_counter]=$row;
		$trip_counter++;
		}
	}

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
//	$epigraph = "\n <div align=\"right\" class=\"text\">Будущее ждёт нас. Выветрившимися скелетами<br>
// или низкорослыми большеглазыми уродцами - не важно.<br>
// Важно что останется след. След цивилизации.<br>
// Никому не нужный бетон, металл, пыль.<br>
// <font color=\"#ffffff\">
// Они будут вечностью.</font></div>
// ";
// }
?>
<!DOCTYPE html>
<html>
<head>
<title>Abandoned</title>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta NAME="Keywords" CONTENT="industrial, places, urban, decay, urbantrip, abandoned, plant, factory, zone, завод, зона, место, брошенный, заброшенный, недостроенный, индустриальный">
 <meta NAME="Description" CONTENT="Photographs of abandoned plants and factories, unfinished buildings, industrial sites">
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
<link rel="icon" href="favicon.ico" type="image/x-icon">
<?php 
require ('gtag.js');
require ('adSence.js');
?>
</head>
<body text="#FFFFFF" link="#00b0f0" vlink="#00b0d0" alink="#ff2040">
<!-- <div class="key">Photographs of abandonned plants, unfinished buildings, industrial sites. Фотографии заброшенных заводов, недостроенных зданий, индустриальных зон. <br>unfinished factory industrial photo urban photo urbantrip industrial places urban abandoned base zone завод зона фабрика место брошенный заброшенный недостроенный база индустриальные фотографии фото индастриал</div> -->
<?php
// show epigraph corresponding to visitor language - deprecated
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
$rows=ceil(($gal_counter-1)/4); //определяем количество строк в таблице обычных галерей
echo "
	<tr>";
for ($r=0; $r<$rows; $r++){ //цикл для строк таблицы галерей
	if ($r!=0) { // separator but not above first row
	   echo "<tr bgcolor=\"#747687\"><td colspan=\"7\" height=\"2\"></td></tr>\n";
   }
	for ($c=0; $c<=3; $c++){ //цикл для столбцов таблицы
		$cell=$r*4+$c; //определяем порядковый номер ячейки
		echo '
	<td align="center" valign="top" class="stext">';
		if ($cell<($gal_counter-1)) {
			$dir=($gallery[$cell]['dir']);
			$descr=($gallery[$cell]['descr']);
			$locat=$gallery[$cell]['locat'];
			$date=$gallery[$cell]['dat'];
			$file=$dir.'.jpg';
			$file_info=@getimagesize('./images/thumb/'.$dir.'.jpg');
			$file_info[3] = isset($file_info[3]) ? $file_info[3] : 'width="150" height="150"';
			$pic_size=$file_info[3]; //это размер картинки в формате 'leight=xx widh=yy'
/*
		if (isset($directories[$x])) { //если ещё есть запись в базе
   
  // deprecated, old
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
    */
   
	echo '
		<table border="0" cellpadding="0" cellspacing="5">
			<tr>
				<td align="center" height="160" valign="middle">
				<a href="index.php?do=thumb&dir='.$dir.'">
				<img src="./images/thumb/'.$dir.'.jpg" '.$pic_size.' border="0" alt="'.$descr.'"></a>
				</td>
			</tr>
			<tr>
				<td align="center" valign="top" class="stext">'.$descr.'<br>'.$locat.'<br>';
	echo '
				<font class="utext">Added '.$date.'</font></td>
			</tr>
		</table>
	</td>';
			}
			else { 
			echo '&nbsp;'; 
			}
		if ($c<=2){
			if ($cell<($gal_counter-1)){ // if there is more data from db, put separator
			echo '<td bgcolor="#747687"><img src="sp.gif" width="1" height="1" border="0">';
			}
			else { 
			echo '<td></td>'; // ячейка разделителя
			}
		}
	echo "
					</td>\n";
	}
	echo "</tr>\n";
}
echo "
</table>\n";
/*
 echo '<tr bgcolor="#747687" height="1">
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 <td><img src="sp.gif" width="2" height="2" border="0"></td>
 </tr>';
echo '</table>
';
*/


// <!-- trips section -->

/* // deprecated
$query="SELECT * FROM glrs WHERE trip=1 ORDER BY dir";;
$result=mysql_query($query, $dbid);
$t_dbrows=mysql_num_rows($result);
 */

echo '<!-- <hr width="90%" align="center"> --><br>
<table align="center" border=0 cellPadding=0 cellSpacing=5 width="70%">
  <tr>
    <td align="left" class="text" colspan=3>Trips:</td>
  </tr>
  <tr>
    <td bgcolor="#747687" colspan=3 height=2></td>
  </tr>
';
	for ($r=0; $r<$trip_counter; $r++) {
	// $particular_row=mysql_fetch_array($result); // deprecated
	// 		$trip_counter++;
		//	$gallery_trip[$trip_counter]=$row;
      // if ($particular_row) { //если ещё есть запись в базе
		$dir=$gallery_trip[$r]['dir'];
		$descr=$gallery_trip[$r]['descr'];
		$date=$gallery_trip[$r]['dat'];
		echo '
 <tr>
	<td align="right" width="20%">
    <a class="link" href="index.php?do=thumb&dir='.$dir.'">Trip '.$date.'</a></td>';
		if ($r==0) {
			echo '
	<td bgcolor="#747687" rowspan="'.$trip_counter.'"><img border=0 height=2 src="sp.gif" width=2></td>';
		}
		echo '
	<td align="left" class="stext" width="80%">'.$descr.'</td>
 </tr>';
	}
// } //если ещё есть запись в базе END
?>
</table>
<br><br>
   <?php require ('menu.php'); ?>
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