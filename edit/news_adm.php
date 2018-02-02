<?php
//  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }
?>
<html>
<head>
<title>Admin news</title>
<meta name=content charset=1251>
<link rel="stylesheet" type="text/css" href="edit_section.css">
</head>
<body bgcolor="#eeeeee">
<p>This:
<a href="news_adm.php">Reload</a> |
<a href="../news.php" target="_new">News page</a><br>
Menu:
<a href="galadm.php">Gallery admin</a> |
<a href="fileadm.php">File admin</a> |
<a href="link_adm.php">Links admin</a> |
<a href="baseadm.php">DB admin</a> |
<a href="log.php?logout=1">Logout</a>
</p>
<?php
require 'db_ini.php';

// 5 cases: 
// 1. edit
// 2. active status
// 3. delete
// first load
// add

// edit section
if (isset($_POST["edit"])) {

   $id = $_POST["id"];
   $date = $_POST["date"];
   $descr = $_POST["descr"];
   if ((isset($_POST["active"])) && ($_POST["active"] == "on")) { $active = 1; } else { $active = 0; }
		
        $query = "UPDATE ab_news SET dat='".$date."', descr='".addslashes($descr)."',  active='".$active."' WHERE id=".$id;
        $result = mysql_query($query, $dbid) or die ("<font color=#bb0000><b>Can't update!</b></font>");
echo "<b><font size=\"-2\" color=#005500>Changes has been saved.</font></b><br>";
        }

// activate section
if (isset($_GET["activate"])) {
	$activate_id = $_GET["activate"];
        $query = "UPDATE ab_news SET active=1 WHERE id='$activate_id'";
	$result = mysql_query($query, $dbid);
        echo "<b><font size=\"-2\" color=#005500>News item ".$activate_id." has been activated&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
	}

// deactivate section
if (isset($_GET["deactivate"])) {
	$deactivate_id = $_GET["deactivate"];
        $query = "UPDATE ab_news SET active=0 WHERE id='$deactivate_id'";
	$result = mysql_query($query, $dbid);
        echo "<b><font size=\"-2\" color=#005500>News item ".$deactivate_id." has been deactivated&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
	}

// delete section
if (isset($_GET["delete"])) {
	$delete_id = $_GET["delete"];
        $query = "DELETE FROM ab_news WHERE id='$delete_id'";
	$result = mysql_query($query, $dbid); // or die("<font color=#bb0000><b>Can't delete row!</b></font>");
        echo "<b><font size=\"-2\" color=#005500>News item ".$delete_id." has been deleted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
	}

// add section
// check is "add" button pressed?
if (isset ($_POST["add"])) {
   if (!empty ($_POST["date"])) { $date_to_add = $_POST["date"]; } else { $date_to_add = 0; };
   if (!empty ($_POST["descr"])) { $descr_to_add = $_POST["descr"]; } else { $descr_to_add = 0; };
	// if !empty 'descr' then add data to db
    if (!empty ($descr_to_add)) {
    $query = "SELECT * FROM ab_news WHERE descr='".addslashes($descr_to_add)."'";
    $result = mysql_query($query, $dbid) or die("<font color=#bb0000><b>Can't read!</b></font>");
    $row = mysql_fetch_array($result);
    $descr_in_db = $row["descr"];
    $date_in_db = $row["dat"];
        if ($descr_to_add==$descr_in_db) {
        echo "<font color=#bb0000> News item <b>".$descr_in_db."</b> already exist (dated <b>".$date_in_db."</b></font>";
        }
        else {
        $query = "INSERT INTO ab_news (dat, descr) VALUES (
		'".$date_to_add."',
		'".addslashes($descr_to_add)."')";
        $result = mysql_query($query, $dbid) or die ("<font color=#bb0000><b>can't insert new parameters</b></font>");

        echo "<b><font size=\"-2\" color=#005500>News item ".$descr_to_add." (dated ".$date_to_add.") has been added</font></b>
<br>";
        }
    } //end of check of empty 'descr' param
}
// form:
?>
<!-- // form, "add" section -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table bgcolor="#888888" border="0" cellpadding="2"  cellspacing="1">
<tr bgcolor="#ffffdd">
	<td><b>&nbsp;Date</b></td>
	<td><b>&nbsp;Description</b></td>
</tr>
<tr>
	<td align="center"><input type="text" name="date" size="10"></td>
	<td align="center"><textarea name="descr" cols="50" rows="4"></textarea></td>
</tr>
</table><br>
&nbsp;&nbsp;<input type="submit" name="add" value="-     Add     -">
</form>
<table bgcolor="#888888" border="0" cellpadding="5" cellspacing="1">
<tr bgcolor="#ffffdd">
<td><b>#/ID</b></td>
<td><b>Date</b></td>
<td width="600"><b>Description</b></td>
<td><b>Active</b></td>
<td><b>Delete</b></td>
</tr>
<?php
// "edit" section
$query = "SELECT * FROM ab_news ORDER BY id DESC";
$result = mysql_query($query, $dbid);
$counter = 1;
$even = true;

$row_color1=' bgcolor=#ffffff';
$row_color2=' bgcolor=#eeeeee';
while ($row = mysql_fetch_row($result))
        {
        $id_e=$row[0];
        $date_e=$row[1];
        $descr_e=$row[2];
		$active_e=$row[3];

// fill rows in different colours
if ($even) { echo "<tr".$row_color1.">\n"; } else { echo "<tr".$row_color2.">\n";}
$even = !$even;

printf("<td align=\"right\"><sub>%s</sub> %s</td>", $counter,$id_e);
printf("<td align=\"left\">%s</td>\n", $date_e);
printf("<td align=\"left\">%s<div align=\"right\"><a href=\"news_edit.php?id=%s\">EDIT</a></div></td>\n",htmlspecialchars($descr_e),$id_e);
	if ($active_e==1)
		// active
		{
		printf("<td align=\"center\" bgcolor=\"#86F086\"><a href=\"news_adm.php?deactivate=%s\" alt=\"Deactivate\">yes</a></td>\n", $id_e); 
		}
	else
		// not active
		{
		printf("<td align=\"center\" bgcolor=\"#F08686\"><a href=\"news_adm.php?activate=%s\" alt=\"Activate\">NO</a></td>\n", $id_e); 
		}
printf("<td align=\"center\"><a href=\"news_adm.php?delete=%s\" alt=\"Delete\">X</a></td>\n", $id_e);
printf("</tr>");
        $counter++;
        }
?>
</table>
<?php echo "<p>".$counter." links</p>" ?>
</body>
</html>
