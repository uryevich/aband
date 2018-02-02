<?php
//  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }

// check is something posted?
// print_r ($_GET["id"]);
if (isset ($_GET["id"])) {
   $id = $_GET["id"];
   }
   else { die ('<font color=#bb0000><b>No id given</b></font>'); }

?>
<html>
<head>
<title>Edit File</title>
<meta name=content charset=1251>
<link rel="stylesheet" type="text/css" href="edit_section.css">
</head>
<body bgcolor="#ffffff">
<?php
require 'db_ini.php';


$query = "SELECT files.dir, glrs.descr FROM files,glrs WHERE files.dir=glrs.dir AND id=".$id;
$result_dir = mysql_query($query, $dbid);
$row_dir = mysql_fetch_array($result_dir);

$query = "SELECT * FROM files WHERE id=".$id;
echo "\n<pre>".$query."</pre>\n";
$result = mysql_query($query, $dbid);
?>


<table align="center" cellpadding="10" bgcolor="#eeeeee"><tr><td colspan="2">

<?php echo "<p align=\"center\">Editing file info in directory ".$row_dir[0]."<br>
<b>".$row_dir[1]."</b></p>\n"; ?>
</td></tr>

<tr><td>
<form method="post" action="fileadm.php">
<table bgcolor="#cccccc" border="0" cellpadding="1" cellspacing="2">
<tr bgcolor="#ffffdd">
<td><b>&nbsp;ID</b></td>
<td><b>&nbsp;File</b></td>
<td><b>&nbsp;Description</b></td>
<td><b>&nbsp;Ext. description</b></td>
<td><b>&nbsp;Pan-flag</b></td>
</tr>
<?php
// $x = 0;
$row = mysql_fetch_array($result);

// echo "<br>-<br>";
// print_r ($row);
// echo "<br>-<br>";
$ide=$row[0];
$dire=$row[1];
$filee=$row[2];
$descre=$row[3];
$descrme=$row[4];
$pane=$row[5];	
printf("<tr>
");
printf("<td align=\"center\">%s\n", $ide);
printf("<input type=\"hidden\" name=\"id\" value=\"%s\">\n", $ide);
printf("<input type=\"hidden\" name=\"glob_dir\" value=\"%s\"></td>\n", $dire);
printf("<td align=\"center\"><input type=\"text\" name=\"file\" value=\"%s\" size=\"3\"></td>\n", $filee);
printf("<td align=\"center\"><input type=\"text\" name=\"descr\" value=\"%s\" size=\"30\"></td>\n", $descre);
printf("<td align=\"center\"><textarea name=\"descrm\" cols=\"25\" rows=\"3\">%s</textarea></td>\n", $descrme);
printf("<td align=\"center\"><input type=\"text\" name=\"pan\" value=\"%s\" size=\"2\"></td>\n", $pane);
printf("</tr>");
?>
</table>
<input type="submit" name="edit" value="-    Edit    -">
<input type="submit" name="" value="Cancel">
</form>
</td>
<td valign="top" align="center">
<?php // Pictureee!!
	$file_location = '../'$dire.'/s/'.$filee.'.jpg';
	$file_info = @getimagesize($file_location);
	$pic_size = $file_info[3];
	echo '<img src="'.$file_location.'" '.$pic_size.' border=0>
';
?>
</td>
</tr>
</table>

</body>
</html>