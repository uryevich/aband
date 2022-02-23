<?php
// check call from index, not self
  if(!defined("IS_ADMIN")) die;
  error_reporting(E_ALL); //debug
?>
<html>
<head>
<title>Admin news</title>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="./admin.css" type="text/css"/>
</head>
<body>
<?php
include "menu.php";
require "../db_ini_.php"; // debug db file

// 5 cases: 
// 1. edit
// 2. change active status
// 3. delete
// first load
// add

// edit section
if (isset($_POST["edit"])) {
	$id=$_POST["id"];
	$date=$_POST["date"];
	$descr=$_POST["descr"];
	if ((isset($_POST["active"])) && ($_POST["active"]=="on")) { $active=1; } else { $active=0; }
	try {
		$dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "UPDATE ab_news SET dat = :date , descr = :descr , active = :active WHERE id = :id";
		$params = [':id' => $id,':date' => $date,':descr' => $descr,':active' => $active];
		$stmt = $dbh->prepare($query);
		$stmt->execute($params);
		$stmt = null;
		$dbh = null;
		echo "<div class=\"notice\">Update successful</div><br/>\n"; // notice
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

// activate section
if (isset($_GET["activate"])) {
	$activate_id=$_GET["activate"];
	try {
		$dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "UPDATE ab_news SET active = 1 WHERE id =?";
		$stmt = $dbh->prepare($query);
		$stmt->execute([$activate_id]);
		$stmt = null;
		$dbh = null;
		echo "<div class=\"notice\">News item ".$activate_id." has been activated</div><br/>\n"; // notice
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

// deactivate section
if (isset($_GET["deactivate"])) {
	$deactivate_id=$_GET["deactivate"];	
	try {
		$dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "UPDATE ab_news SET active = 0 WHERE id = ?";
		$stmt = $dbh->prepare($query);
		$stmt->execute([$deactivate_id]);
		$stmt = null;
		$dbh = null;
		echo "<div class=\"notice\">News item ".$deactivate_id." has been deactivated</div><br/>\n"; // notice
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

// delete section
if (isset($_GET["delete"])) {
	$delete_id=$_GET["delete"];
	try {
		$dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		// show what will be deleted
		$query = "SELECT * FROM ab_news WHERE id = ?";
		$stmt = $dbh->prepare($query);
		$stmt->execute([$delete_id]);
		$row = $stmt->fetch(PDO::FETCH_LAZY);
		echo '<div class="warning">Deleted!
		<table>
		<tr>
		<td>Id:</td>
		<td>'.$row[0].'</td>
		</tr>
		<tr>
		<td>Date:</td>
		<td>'.$row[1].'</td>
		</tr>
		<tr>
		<td>Description:</td>
		<td>'.htmlentities($row[2]).'</td>
		</tr>
		<tr>
		<td>Status:</td>
		<td>'.$row[3].'</td>
		</tr>
		</table>
		</div>\n';
// delete
		$query = "DELETE FROM ab_news WHERE `id` = ?";
		$stmt = $dbh->prepare($query);
		$stmt->execute([$delete_id]);
		$stmt = null;
		$dbh = null;
		echo "<div class=\"notice\">News item ".$delete_id." has been deleted</div><br/>\n"; // notice
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
}

// add section
if (isset ($_POST["add"])) {
   if (!empty ($_POST["date"])) { $date=$_POST["date"]; } else { $date=0; };
   if (!empty ($_POST["descr"])) { $descr=$_POST["descr"]; } else { $descr=0; };
	try {
		$dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query = "INSERT INTO ab_news (dat,descr,active) VALUES (:date,:descr,:active)";
		$params = [':date' => $date,':descr' => $descr,':active' => 0];
		$stmt = $dbh->prepare($query);
		$stmt->execute($params);
		$stmt = null;
		$dbh = null;
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
	}
	echo "<div class=\"notice\">News item <br/>".htmlentities($descr)."<br/>(dated ".$date.") has been added.</div>\n"; // notice		
}
?>
<!-- // form, "add" section -->
<form method="post" action="./index.php?do=news">
<table>
<tr class="tb_header">
	<td>Date<br/>YYYY-MM-DD</td>
	<td>Description</td>
</tr>
<tr>
	<td><input type="text" name="date" size="10"></td>
	<td><textarea name="descr" cols="50" rows="4"></textarea></td>
</tr>
</table>
<input type="submit" name="add" value="-     Add     -">
</form>
<table>
<tr class="tb_header">
<td># / ID</td>
<td>Date</td>
<td width="600">Description</td>
<td>Edit</td>
<td>Active</td>
<td>Delete</td>
</tr>
<?php
// "edit" section
try {
	$dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$query = "SELECT * FROM ab_news ORDER BY id DESC";
	$news_from_db = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
	$dbh = null;
	} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
	}
foreach ($news_from_db as $row_counter => $v){
	echo "<tr>\n";
	echo "<td>".($row_counter+1)." / ".$v['id']."</td>\n";
	echo "<td>".$v['dat']."</div></td>\n";
	echo "<td width=\"600\">&nbsp;".htmlentities($v['descr'])."</td>\n";
	echo "<td><span class=\"notice\"><a href=\"index.php?do=newsedit&id=".$v['id']."\">Edit</a></span></td>";

	switch ($v['active']) {
		case 1:
		echo "<td class=\"act\"><a href=\"./index.php?do=news&deactivate=".$v['id']."\" alt=\"Deactivate\">yes</a></td>\n";
		break;
		case NULL:
		echo "<td class =\"noact\"><a href=\"./index.php?do=news&activate=".$v['id']."\" alt=\"Activate\">no</a></td>\n";
		break;
		case 0:
		echo "<td class =\"noact\"><a href=\"./index.php?do=news&activate=".$v['id']."\" alt=\"Activate\">no</a></td>\n";
		break;
	}
	echo "<td><a href=\"./index.php?do=news&delete=".$v['id']."\" alt=\"Delete\">X</a></td>\n</tr>\n";
}
?>
</table>
<p><?php echo $row_counter; ?> entries.</p>
</body>
</html>
