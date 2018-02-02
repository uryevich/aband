<?php
//  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }

// is something posted?
// print_r ($_GET["gal"]);
if (isset ($_GET["gal"])) {
   $id = $_GET["gal"];
   }
   else { die ('<font color=#bb0000><b>No gallery id given</b></font>'); }

?>
<html>
<head>
<title>Edit gallery</title>
<meta name=content charset=1251>
<link rel="stylesheet" type="text/css" href="edit_section.css">
</head>
<body bgcolor="#eeeeee">
<?php
require 'db_ini.php';

$query = "SELECT * FROM glrs WHERE dir=$id";
echo "<br><pre>".$query."</pre><br>";
$result = mysql_query($query, $dbid);

?>
<table bgcolor="#dddddd" cellpadding="1" cellspacing="1"><tr><td>
<form method="post" action="galadm.php">
<table bgcolor="#cccccc" border="0" cellpadding="0" cellspacing="2">
<tr bgcolor="#ffffdd">
<td><b>Directory</b></td>
<td><b>Description</b></td>
<td><b>Location</b></td>
<td><b>Date</b></td>
<td><b>Trip</b></td>
</tr>
<?php
$x=0;
$row = mysql_fetch_array($result);

// echo "<br>-<br>";
// print_r ($row);
// echo "<br>-<br>";

        $dir_e=$row[0];
        $descr_e=$row[1];
        $locat_e=$row[2];
        $date_e=$row[3];
        $trip_e=$row[4];


printf("<tr>
");
printf("<td align=\"center\">%s\n", $dir_e);
printf("<input type=\"text\" name=\"dir\" value=\"%s\" size=\"10\"></td>\n", $dir_e);
printf("<td align=\"center\"><input type=\"text\" name=\"descr\" value=\"%s\" size=\"45\"></td>\n", $descr_e);
printf("<td align=\"center\"><input type=\"text\" name=\"locat\" value=\"%s\" size=\"25\"></td>\n", $locat_e);
printf("<td align=\"center\"><input type=\"text\" name=\"date\" value=\"%s\" size=\"10\"></td>\n", $date_e);
printf("<td align=\"center\"><input type=\"text\" name=\"trip\" value=\"%s\" size=\"2\"></td>\n", $trip_e);
printf("</tr>
</table>");
?>
<div align="right"><input type="submit" name="edit" value="-     Edit     -">
<input type="submit" name="" value="Cancel"></div>
</form>
</td></tr></table>

</body>
</html>