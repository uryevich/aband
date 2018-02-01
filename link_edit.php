<?php
//  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }

// if something posted
print_r ($_GET["id"]);
if (isset ($_GET["id"])) {
   $id=$_GET["id"];
   }
   else { die ('<font color=#bb0000><b>No id given</b></font>'); }

?>
<html>
<head>
<title>Edit link</title>
<meta name=content charset=1251>
<style type="text/css">
<!--
body,td { font-family: Verdana, Arial; font-size : 12px;}
a:hover { color : #ff3300; }
-->
</style>
</head>
<body bgcolor="#eeeeee">
<?php
require 'db_ini.php';
$query="SELECT * FROM ab_links WHERE id=$id";
echo "<br><pre>".$query."</pre><br>";
$result=mysql_query($query, $dbid);
?>
<table align="center" bgcolor="#dddddd" cellpadding="1" cellspacing="1"><tr><td>
<form method="post" action="<?php echo 'link_adm.php'; ?>">
<table bgcolor="#cccccc" border="1" cellpadding="0" cellspacing="2">
<tr bgcolor="#ffffdd">
<td><b>&nbsp;ID</b></td>
<td><b>&nbsp;Link</b></td>
<td><b>&nbsp;Name</b></td>
<td><b>&nbsp;Description</b></td>
<td><b>&nbsp;Image</b></td>
<td><b>&nbsp;Cat 1</b></td>
<td><b>&nbsp;Cat 2</b></td>
<td><b>&nbsp;Cat 3</b></td>
<td><b>&nbsp;Cat 4</b></td>
<td><b>&nbsp;Active&nbsp;</b></td>
<td><b>&nbsp;Delete&nbsp;</b></td>
</tr>
<?php
$x=0;
$row = mysql_fetch_array($result);

// echo "<br>-<br>";
// print_r ($row);
// echo "<br>-<br>";

$id_e=$row[0];
$link_e=$row[1];
$name_e=$row[2];
$descr_e=$row[3];
$img_e=$row[4];
$cat1_e=$row[5];
$cat2_e=$row[6];
$cat3_e=$row[7];
$cat4_e=$row[8];
if ((!empty($row[9])) OR ($row[9]==1)) { $active_e=" checked=\"yes\""; } else { $active_e=""; };
// $active_e=$row[9];
printf("<tr>
");
printf("<td align=\"center\">%s\n", $id_e);
printf("<input type=\"hidden\" name=\"id\" value=\"%s\"></td>\n", $id_e);
printf("<td align=\"center\"><input type=\"text\" name=\"link\" value=\"%s\" size=\"20\"></td>\n", $link_e);
printf("<td align=\"center\"><input type=\"text\" name=\"name\" value=\"%s\" size=\"30\"></td>\n", $name_e);
printf("<td align=\"center\"><textarea name=\"descr\" cols=\"20\" rows=\"3\">%s</textarea></td>\n", $descr_e);

printf("<td align=\"center\"><input type=\"text\" name=\"img\" value=\"%s\" size=\"8\"></td>\n", $img_e);
printf("<td align=\"center\"><input type=\"text\" name=\"cat1\" value=\"%s\" size=\"1\"></td>\n", $cat1_e);
printf("<td align=\"center\"><input type=\"text\" name=\"cat2\" value=\"%s\" size=\"1\"></td>\n", $cat2_e);
printf("<td align=\"center\"><input type=\"text\" name=\"cat3\" value=\"%s\" size=\"1\"></td>\n", $cat3_e);
printf("<td align=\"center\"><input type=\"text\" name=\"cat4\" value=\"%s\" size=\"1\"></td>\n", $cat4_e);
printf("<td align=\"center\"><input type=\"checkbox\" name=\"active\"%s></td>\n", $active_e);
printf("<td align=\"center\"><input type=\"checkbox\" name=\"del\"></td>\n");
// printf("<td align=\"center\"><a href=fileadm.php?glob_dir=%s><font size=\"-2\">Edit<br>links</font></a></td>\n", $dire);
printf("</tr>
</table>");
?>
<input type="submit" name="edit" value="-     Edit     -">
<input type="submit" name="" value="Cancel">
</form>
</td></tr></table>
</body>
</html>