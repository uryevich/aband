<?php
  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }
?>
<html>
<head>
<?php

require 'db_ini.php';
// количество строк для новых записей
$add_strings=1; 

// счётчик строк в таблице директорий
$query="SELECT dir,descr FROM glrs ORDER BY dir";
$result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>Can't read!</b></font>");
$counter=0;
while ($row=mysql_fetch_array($result))
   {
   $dir_list[$counter]=$row["dir"];
   $dir_list_name[$counter]=$row["descr"];
   $counter++;
   }
if (isset($_POST["glob_dir"])) $glob_dir=$_POST["glob_dir"];
if (isset($_GET["glob_dir"])) $glob_dir=$_GET["glob_dir"];
if (!$glob_dir) $glob_dir=$dir_list[0];

// or !$_GET[glob_dir] ) { $glob_dir=$dir_list[0]; } else { $glob_dir=$_POST[glob_dir]; }

// проверка наличия строк в таблце
   //$query="SELECT dir FROM glrs";
   //$result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not read</b></font>");
   //$counter=0;
   
?>
<title>Admin files, gallery <?php echo $glob_dir; ?></title>
<meta name=content charset=1251>
<style type="text/css">
<!--
body,td { font-family: Verdana, Arial; font-size : 12px;}
a:hover { color : #ff3300; }
-->
</style>
</head>
<body bgcolor="#eeeeee">
<!-- Menu -->
<p>This:
<a href="fileadm.php?glob_dir=<?php echo $glob_dir; ?>">Reload</a> |
 <a href="thumb.php?gal=<?php echo $glob_dir; ?>" target="#new">Gallery index</a><br>
Menu:
 <a href="galadm.php">Galleryes admin</a> |
 <a href="link_adm.php">Links admin</a> |
 <a href="news_adm.php">News admin</a> |
 <a href="baseadm.php">DB Admin</a> |
 <a href="log.php?logout=1">Logout</a></p>
<!-- form for change directory -->
<form method="post" action="fileadm.php">select directory:
<select name="glob_dir" class=inputbox>
    <?php
    $counter=0;
      while (list($key_arr,$dir_a)=each($dir_list))
      {
      // $dir_a=$row[dir];
      echo '<option value="'.$dir_a.'"';
         if ($dir_a==$glob_dir) {
         echo ' selected';
         }
         else {
            if ($counter==0 and $glob_dir==0) {
            echo ' selected';
            }
         }
      echo '>'.$dir_a.' - '.$dir_list_name[$counter].'</option>
      ';
      $counter++;
      }
?>
</select>
   <input type="submit" value="-  Go!  -">
   </form>
<?php

// 4 cases: 
// 1. edit
// 2. delete
// 3. add

// Edit section
// если есть флаг "edit", то пишем данные в таблицу
// print_r ($_POST);

if (isset($_POST["edit"])) {
   $id=$_POST["id"];
   $dir=$_POST["dir"];
   $file=$_POST["file"];
   $descr=$_POST["descr"];
   $descrm=$_POST["descrm"];
   $pan=$_POST[pan];
   echo "<br /><br />Warning!!<br /><br />";
//   $del=$_POST[del];
//   $x=$_POST[x];
//    for ($z=0; $z<=$x; $z++) {
        $query="UPDATE files SET fil='".$file."',
        descr='".addslashes($descr)."',descrm='".addslashes($descrm)."',pan='".$pan."'
        WHERE id='".$id."'";
        $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>Can't update!</b></font>");
        
	echo "<br /><b><pre>".$query."</pre></b><br />";
	echo "<b><font size=\"-1\" color=#558800>Changes has been saved</font></b>";
	}
	
// Delete section
if (isset($_GET["delete"])) {
	$delete_id=$_GET["delete"];
        $query="DELETE FROM files WHERE id='".$delete_id."'";
        $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>Сan't delete row!</b></font>");
		echo "<br /><b><pre>".$query."</pre></b><br />";
        echo "<b><font size=\"-1\" color=#005500>File with ID ".$delete_id." has been deleted.&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
        }

// Add section		
// если есть флаг "add", то добавляем данные в таблицу
if (isset($_POST["add"])) {
   $id=$_POST["id"];
   $dir=$_POST["dir"];
   $file=$_POST["file"];
   $descr=$_POST["descr"];
   $descrm=$_POST["descrm"];
   $pan=$_POST["pan"];
//"add" cycle start
for ($z=0; $z<$add_strings; $z++) {
    if ($file[$z]==TRUE) {
    $query="SELECT * FROM files WHERE dir='$glob_dir' AND fil='$file[$z]'";
    $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>Сan't read (check part)!</b></font>");
    $row=mysql_fetch_array($result);
    $dir_b=$row["dir"];
    $file_b=$row["fil"];
        if (($glob_dir==$dir_b) and ($file[$z]==$file_b)) {
        echo "<p align=center><font color=#bb0000> File coinsidence at row <b>".$glob_dir.", ( ".$file_b." )</b></font></p>";
        }
        else {
        $query="INSERT INTO files (id,dir,fil,descr,descrm,pan) VALUES ('".$id[$z]."','".$dir[$z]."','".$file[$z]."','".addslashes($descr[$z])."','".addslashes($descrm[$z])."','".$pan[$z]."')";
        $result=mysql_query($query, $dbid) or die ("<font color=#bb0000><b>Can't insert new parameters</b></font>");
		echo "<br /><b><pre>".$query."</pre></b><br />";
        echo '<b><font size="-1" color=#005500>File '.$file[$z].'.jpg "'.$descr[$z].'" has been added in directory '.$dir[$z].'</font></b><br>
        ';
        }
    } //end of check of empty 'file' param
} // end of "add" cycle
} // end of add section

// count id
$query="SELECT COUNT(*) FROM files";
$result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>Can't count rows!</b></font>" . mysql_error() . "<br />");
$arr=mysql_fetch_array($result);
$max_id=$arr[0];
?>
<table border="1" cellpadding="2" cellspasing="1">
<tr valign="top">
<td>
<!-- Form for adding start -->
<!-- // "add" section -->
<table align="center" bgcolor="#eeeeee" cellspacing="1"><tr><td>
<form method="post" action="fileadm.php">
<table bgcolor="#888888" border="0" cellpadding="1" cellspacing="2">
<tr bgcolor="#ffffdd">
	<td><b>&nbsp;File</b></td>
	<td><b><font size="-2">ext</font></b></td>
	<td><b>&nbsp;Description</b></td>
	<td><b>&nbsp;Ext. description</b></td>
	<td><b>&nbsp;Pan-flag&nbsp;</b></td>
</tr>
<?php
// check for free id in files table
$not_match=0;
for ($i=0; $i<=($add_strings+$max_id-1); $i++) {
   $query="SELECT id FROM files WHERE id='$i'";
   if ($result=mysql_query($query)) {
      $row=mysql_fetch_array($result);
      $id_string=$row["id"];
      if ($id_string!=$i) {
         $new_id[$not_match]=$i;
         $not_match++;
      }
   }
}
   if ($glob_dir!=0) {
   for ($z=0; $z<=($add_strings-1); $z++)
         {
   printf("<tr>\n");
   printf("	<td><input type=\"hidden\" name=\"id[%s]\" value=\"%s\">\n", $z,$new_id[$z]);
   printf("<input type=\"hidden\" name=\"dir[%s]\" value=\"%s\" size=\"5\">\n", $z,$glob_dir);
   printf("<input type=\"text\" name=\"file[%s]\" size=\"5\"></td>\n", $z);
   printf("	<td>.jpg</td>");
   printf("	<td><input type=\"text\" name=\"descr[%s]\" size=\"20\"></td>\n", $z);
   printf("	<td><input type=\"text\" name=\"descrm[%s]\" size=\"40\"></td>\n", $z);
   printf("	<td><input type=\"text\" name=\"pan[%s]\" size=\"1\"></td>\n", $z);
   printf("</tr>\n");
         }
printf("<input type=\"hidden\" name=\"glob_dir\" value=\"%s\">\n", $glob_dir);
}
?>
</table>
<div align="right"><input type="submit" name="add" value="-   Add   -"></div>
</form>
</td></tr></table>
<!-- Form for adding end -->


<!-- Editing section start -->
<form method="post" action="fileadm.php">
<table bgcolor="#888888" border="0" cellpadding="2">
<tr bgcolor="#ffffdd">
<td align="right"><i>id</i>&nbsp;&nbsp;&nbsp;<b>File</b></td>
<td align="center"><b><font size="-2">ext</font></b></td>
<td align="center"><b>Description</b></td>
<td align="center"><b>Ext. description</b></td>
<td align="center"><b>Pan-flag</b><br />edit</td>
<td align="center"><b>Delete</b></td>
</tr>
<?php
$tbl_row=0; // fill rows in different colors
$counter=1;
$row_color1=' bgcolor=#ffffff';
$row_color2=' bgcolor=#eeeeee';

$query="SELECT * FROM files WHERE dir='$glob_dir' ORDER BY fil";
$result=mysql_query($query, $dbid);
$sql_empty_check=mysql_num_rows($result);
if ($sql_empty_check>0) {
	while ($row = mysql_fetch_row($result)) {
		$ide=$row[0];
		$filee=$row[2];
		$descre=$row[3];
		$descrme=$row[4];
		$pane=$row[5];
		// fill rows in different colours
		$tbl_row++;
		if (ceil($tbl_row/2)==($tbl_row/2)) { echo "<tr".$row_color1.">\n"; } else { echo "<tr".$row_color2.">\n"; }
		printf("<td align=\"right\"><a href=\"pic.php?id=%s\" target=\"_blank\"><i> %s</i></a>\n", $ide,$ide);
		printf(" %s</td>\n", $filee);
		printf("<td>.jpg</td>\n");
		printf("<td><i>%s</td>\n", $descre);
		printf("<td>%s</td>\n", htmlspecialchars($descrme));
		printf("<td align=\"center\"><a href=\"file_edit.php?id=%s\">%s</a></td>\n", $ide,$pane);
		printf("<td align=\"center\"><a href=\"fileadm.php?delete=%s&glob_dir=%s\">X</a></td>\n", $ide,$glob_dir);
		printf("</tr>\n");
		}
	}
?>
</table>
</form>
<!-- Form for editing end -->
</td>
<td>

<table border="0" cellpadding="2" cellspasing="1" bgcolor="#ffffdd">
<tr valign="top">
<td align="right">
<?php
// check files section -> compare directory content and records in DB
// read DIR then DB
if (isset ($glob_dir) and ($glob_dir!=0))
   {
   $abase=0;
   $base=0;
   echo '<b>In Database:</b>
   <p align="left">
   Not exist:</p>
<font size="-1" color="#bb0000">';
   $handle=opendir($glob_dir);
	while (false !== ($dir_file = readdir($handle))) {
      if (($dir_file!=".") or ($dir_file!="s") or ($dir_file!="..")) {
	$dirfile_temp_arr=explode ('.', $dir_file);
	}
	else { $dirfile_temp_arr = array(0 => 0, 1 => 0); }
	$dirfile=$dirfile_temp_arr[0];
	$dirfile_ext=$dirfile_temp_arr[1];
	// echo '$dirfile_ext'.$dirfile_ext.'<br>';
        if ($dirfile_ext=="jpg")
        {
        $abase++;
        $query="SELECT * FROM files WHERE dir='$glob_dir' AND fil='$dirfile'";
        $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not read when search for file '$dirfile'</b></font>");
        $filerecord = mysql_fetch_row($result);
         if ($dirfile!=$filerecord[2])
         {
         $base++;
         echo 'File '.$dirfile.'.jpg<br>
         ';
         }
	  if ($dirfile_ext !== "jpg" &&$dirfile_ext !== 0) { echo 'File '.$dirfile+$dirfile_ext.' not jpg!!'; }
        if (!file_exists($glob_dir.'/s/'.$dirfile.'.jpg') && $dirfile_ext=0) {
            echo 'Thumb of '.$dirfile.'.jpg not exist<br>
            ';
            }
        }
      }
   echo '</font><hr width="70%">'
   .$abase.' file(s) total in Dir,<br>'
   .$base.' file(s) absent.<br>';

// section 2
// read DB then DIR
   $adircont=0;
   $dircont=0;
   echo '</td>
   <td>&nbsp;&nbsp;</td><td align="right">
   <b>In Directory:</b>
   <p align="left">Not exist:</p>
<font size="-1" color="#bb0000">';
   $query="SELECT fil FROM files WHERE dir='$glob_dir' ORDER BY fil";
   $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not select 'file' from database</b></font>");
      while ($dbfile=mysql_fetch_array($result))
      {
      $adircont++;
         if (!file_exists ($glob_dir.'/'.$dbfile[0].'.jpg'))
         {
         $dircont++;
         echo 'File '.$dbfile[0].'.jpg<br>
         ';
         }
      }
   echo '</font><hr width="70%">'
   .$adircont.' file(s) total in DB,<br>'
   .$dircont.' file(s) absent.<br>';
   }
echo '</td>
</tr>
<tr>
<td colspan=3><hr>
';
// count files in directories
// $query="SELECT dir, COUNT(fil) FROM files GROUP BY dir ORDER BY dir";
// $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not count rows</b></font>");
// $mdir_tot=0;
// $mfile_tot=0;
// while ($arr=mysql_fetch_array($result)) {
//   $mdir=$arr[0];
//   $mfile=$arr[1];
//   echo '<font size="-1">directory '.$mdir.' content '.$mfile.' files.</font><br>
//   ';
//   $mdir_tot++;
//   $mfile_tot=$mfile_tot+$mfile;
//   }
// echo '<hr width="70%">'.$mdir_tot.' directories content '.$mfile_tot.' files total.';
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>