<?php
error_reporting(E_ALL); // debug
  
// if id given
if (isset ($_GET['id'])) {
   $id=$_GET['id'];
   }
   else { 
   header('Location: ./index.php?do=news');
   exit;
}

?>
<html>
<head>
<title>Edit news item</title>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="./admin.css" type="text/css"/>
</head>
<body>
<?php
include 'menu.php';
require '../db_ini_.php'; // debug db file

try {
	$dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	
	$query = "SELECT * FROM ab_news WHERE `id` = ?";
	$stmt = $dbh->prepare($query);
	$stmt->execute([$id]);
	$row = $stmt->fetch(PDO::FETCH_LAZY);
	$dbh = null;
	} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
	}
// drop if id not exist (just in case)
if (!isset ($row[0])) { 
	header('Location: ./index.php?do=news');
	exit;
}
?>
<form method="post" action="./index.php?do=news">
<table>
<tr class="tb_header">
<td>ID</td>
<td>Date</td>
<td>Description</td>
<td>Active</td>
</tr>
<?php
$id_e=$row[0];
$date_e=$row[1];
$descr_e=$row[2];
if ($row[3] == 1) { $active_e=" checked=\"yes\""; } else { $active_e=""; };

echo "<tr>\n";
echo "<td align=\"center\">$id_e\n";
echo "<input type=\"hidden\" name=\"id\" value=\"$id_e\"></td>\n";
echo "<td align=\"center\"><input type=\"text\" name=\"date\" value=\"$date_e\" size=\"10\"></td>\n";
echo "<td align=\"center\"><textarea name=\"descr\" cols=\"40\" rows=\"5\">$descr_e</textarea></td>\n";
echo "<td align=\"center\"><input type=\"checkbox\" name=\"active\"$active_e></td>\n";
echo "</tr>\n</table>";
?>
<input type="submit" name="edit" value="Edit">
<input type="submit" name="" value="Cancel">
</form>
</td></tr></table>
<?php echo "<div class=\"info\">$date_e</div> <div class=\"info\">$descr_e</div>" ?>
</body>
</html>