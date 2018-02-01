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
<title>Edit news item</title>
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
$query="SELECT * FROM ab_news WHERE id=$id";
echo "<br><pre>".$query."</pre><br>";
$result=mysql_query($query, $dbid);
?>
<table align="center" bgcolor="#dddddd" cellpadding="1" cellspacing="1"><tr><td>
<form method="post" action="<?php echo 'news_adm.php'; ?>">
<table bgcolor="#cccccc" border="1" cellpadding="0" cellspacing="2">
<tr bgcolor="#ffffdd">
<td><b>&nbsp;ID</b></td>
<td><b>&nbsp;Date</b></td>
<td><b>&nbsp;Description</b></td>
<td><b>&nbsp;Active&nbsp;</b></td>
</tr>
<?php
$x=0;
$row = mysql_fetch_array($result);

// echo "<br>-<br>";
// print_r ($row);
// echo "<br>-<br>";

$id_e=$row[0];
$date_e=$row[1];
$descr_e=$row[2];
if ((!empty($row[3])) OR ($row[3]==1)) { $active_e=" checked=\"yes\""; } else { $active_e=""; };
// $active_e=$row[9];
printf("<tr>
");
printf("<td align=\"center\">%s\n", $id_e);
printf("<input type=\"hidden\" name=\"id\" value=\"%s\"></td>\n", $id_e);
printf("<td align=\"center\"><input type=\"text\" name=\"date\" value=\"%s\" size=\"10\"></td>\n", $date_e);
printf("<td align=\"center\"><textarea name=\"descr\" cols=\"40\" rows=\"5\">%s</textarea></td>\n", $descr_e);
printf("<td align=\"center\"><input type=\"checkbox\" name=\"active\"%s></td>\n", $active_e);
printf("</tr>
</table>");
?>
<input type="submit" name="edit" value="-     Edit     -">
<input type="submit" name="" value="Cancel">
</form>
</td></tr></table>
<table align="center" border="1" cellpadding="10" cellspacing="1" width="600"><tr><td>
<p>
<?php echo $date_e." - ".$descr_e ?>
</p>
</td></tr></table>
</body>
</html>