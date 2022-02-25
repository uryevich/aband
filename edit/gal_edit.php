<?php
error_reporting(E_ALL); // debug

// if dir_id given
print_r ($_GET["dir_id"]); // debug
if (isset ($_GET["dir_id"])) {
   $dir_id=$_GET["dir_id"];
   }
   else { 
   header('Location: ./index.php?do=gal');
   exit;   
}

?>
<html>
<head>
<title>Edit gallery</title>
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

	
	$query = "SELECT * FROM glrs WHERE `dir` = ?";
	$stmt = $dbh->prepare($query);
	$stmt->execute([$dir_id]);
	$row = $stmt->fetch(PDO::FETCH_LAZY);
	$dbh = null;
	} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
	}
// drop if dir_id not exist (just in case)
if (!isset ($row[0])) { 
	header('Location: ./index.php?do=gal');
	exit;
	}
?>
<form method="post" action="./index.php?do=gal">
<table>
<tr class="tb_header">
<td>Directory</td>
<td>Description</td>
<td>Location</td>
<td>Date</td>
<td>Trip</td>
</tr>
<?php
$dir_e=$row[0];
$descr_e=$row[1];
$locat_e=$row[2];
$date_e=$row[3];
$trip_e=$row[4];

echo "<tr>\n";
echo "<td>$dir_e\n";
echo " <input type=\"text\" name=\"dir_id\" value=\"$dir_e\" size=\"10\"></td>\n";
echo "<td><input type=\"text\" name=\"galname\" value=\"$descr_e\" size=\"45\"></td>\n";
echo "<td><input type=\"text\" name=\"locat\" value=\"$locat_e\" size=\"25\"></td>\n";
echo "<td><input type=\"text\" name=\"date\" value=\"$date_e\" size=\"10\"></td>\n";
echo "<td align=\"center\">";
// echo "<input type=\"text\" name=\"trip\" value=\"$trip_e\" size=\"2\">\n";
echo "
<select id=\"dropdown\" name=\"trip\">";
for ($val=0; $val<=2; $val++) {
	if ($val==$trip_e) {
		echo "<option value=\"$val\" selected>$val</option>";
	} else {
		echo "<option value=\"$val\">$val</option>";
	}
}
echo "<!--	<option value=\"0\">0</option>
	<option value=\"1\">1</option>
	<option value=\"2\" selected>2</option> -->
	</select>
	</td>
";
echo "</tr></table>";

?>
<div><input type="submit" name="edit" value="Edit">
<input type="submit" name="" value="Cancel"></div>
</form>
</body>
</html>