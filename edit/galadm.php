<?php
  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }
?>
<html>
<head>
<title>Admin galleryes</title>
<meta name=content charset=1251>
<link rel="stylesheet" type="text/css" href="edit_section.css">
</head>
<body>
<p>This:
<a href="galadm.php">Reload</a> |
<a href="../index.php" target="_new">Index</a><br>
Menu:
<a href="fileadm.php">File admin</a> |
<a href="links_adm.php">Links admin</a> |
<a href="news_adm.php">News admin</a> |
<a href="baseadm.php">DB admin</a> |
<a href="log.php?logout=1">Logout</a>
</p>
</p>
<?php
require 'db_ini.php';

// 4 cases on load: 
// 1. edit
// 2. delete
// 3. first load
// 4. add


// edit execute
if (isset ($_POST["edit"])) {

	$dire = $_POST["dire"];
	$dir = $_POST["dir"];
	$descr = $_POST["descr"];
	$locat = $_POST["locat"];
	$date = $_POST["date"];
	$trip = $_POST["trip"];

	$query = "UPDATE glrs SET descr='".addslashes($descr)."', locat='".addslashes($locat)."', dat='$date', trip='$trip' WHERE dir='$dir'";
    $result = mysql_query($query, $dbid) or die ("<font color=#bb0000><b>Can't update!</b></font>");
      
    
echo "<b><font size=\"-2\" color=#005500>Changes has been saved</font></b><br>
<pre>".$query."</pre><br>";
	}
// end edit execute 
   
// delete execute
if (isset($_GET["delete"])) {
	$delete_id = $_GET["delete"];
        $query = "DELETE FROM glrs WHERE dir='$delete_id'";
	$result = mysql_query($query, $dbid); // or die("<font color=#bb0000><b>Can't delete row!</b></font>");
        echo "<b><font size=\"-2\" color=#555500>Gallery ".$delete_id." has been deleted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
	}
// end delete execute

// add section execute
if (isset ($_POST["add"])) {
   $dir=$_POST["dir"];
   $descr=$_POST["descr"];
   $locat=$_POST["locat"];
   $date=$_POST["date"];
   $trip=$_POST["trip"];
    if (isset ($dir)) {
    $query = "SELECT * FROM glrs WHERE dir=$dir";
    $result = mysql_query($query, $dbid) or die("<font color=#bb0000><b>Can't read!</b></font>");
    $row = mysql_fetch_array($result);
    $dir_a = $row["dir"];
    // echo "<div class=\"debug\">dir_a".$dir_a."</div>";
    $descr_a = $row["descr"];
    // echo "<div class=\"debug\">descr_a".$descr_a."</div>";
		// check if directory name to add already exist
        if ($dir == $dir_a) { 
        echo "<div class=\"debug\" style=\"text:color=#bb0000\"> Directory coinsidence at row <b>".$dir_a."</b> with description <b>".$descr_a."</b></div>";
        }
        else {
        $query = "INSERT INTO glrs (dir,descr,locat,dat,trip) VALUES ('$dir','".addslashes($descr)."','$locat','$date','$trip')";
        $result = mysql_query($query, $dbid) or die ("<div style=\"text:color=#bb0000\"><b>can't insert new parameters</b></div>");
        echo "<b><div class=\"debug\" color=#005500>Directory ".$dir." (".$descr.") has been added</div></b>
<br />
<pre>".$query."</pre><br />
";
        }
    } //end of check of empty 'dir' param
} // end of "add" cycle

// end add execute

// form:
?>
<!-- // "add" section -->
<table bgcolor="#eeeeee" border="0" cellpadding="0"  cellspacing="1">
<tr><td>
<form method="post" action="<?php echo $_SERVER['SCRIPT_NAME']; ?>">
<table bgcolor="#888888" border="0" cellpadding="2"  cellspacing="1">
<tr bgcolor="#ffffdd">
<td><b>Directory</b></td>
<td><b>Description</b></td>
<td><b>Location</b></td>
<td><b>Date</b></td>
<td><b>Trip-flag</b></td>
</tr>
<tr>
<td style="text-align: center"><input type="text" name="dir" value="" size="10"></td>
<td style="text-align: center"><input type="text" name="descr" value="" size="30"></td>
<td style="text-align: center"><input type="text" name="locat" value="" size="20"></td>
<td style="text-align: center"><input type="text" name="date" value="" size="10"></td>
<td style="text-align: center"><input type="text" name="trip" value="" size="1"></td>
</tr>
</table>
<div style="text-align: right"><input type="submit" name="add" value="-     Add     -"></div>
</form>
</td></tr></table>
<br />


<!-- edit section (html) -->
<table bgcolor="#888888" border="0" cellpadding="2" cellspacing="1">
<tr bgcolor="#ffffdd">
<td><b>Directory</b><br />view</td>
<td><b>Description</b><br />edit</td>
<td><b>Location</b></td>
<td><b>Date</b></td>
<td><b>Trip-flag</b></td>
<td><b>Delete</b></td>
<td></td>
</tr>

<?php
// "edit" section
$even = true;
$counter = 1;
$row_color1 = ' bgcolor=#ffffff';
$row_color2 = ' bgcolor=#eeeeee';
$query = "SELECT * FROM glrs ORDER BY dir";
$result = mysql_query ($query, $dbid);
while ($row = mysql_fetch_row ($result))
        {
        $dire = $row[0];
        $descre = $row[1];
        $locate = $row[2];
        $datee = $row[3];
        $tripe = $row[4];

// fill rows in different colours
if ($even) { echo "<tr".$row_color1.">\n"; } else { echo "<tr".$row_color2.">\n"; }
$even = !$even;


printf("<td align=\"right\"><a href=\"../thumb.php?gal=%s\" target=\"_new\"> %s </a></td>\n", $dire,$dire);
printf("<td><a href=\"gal_edit.php?gal=%s\">%s</a></td>\n", $dire,$descre);
printf("<td>%s</td>\n", $locate);
printf("<td>%s</td>\n", $datee);
printf("<td align=\"center\">%s</td>\n", $tripe);
printf("<td align=\"center\"><a href=\"galadm.php?delete=%s\" alt=\"Delete\">X</a></td>\n", $dire);
printf("<td align=\"center\"><a href=fileadm.php?glob_dir=%s><font size=\"-2\">Edit<br />files</font></a></td>\n", $dire);
printf("</tr>");
        $counter++;
        }
printf("</table><p>%s galleries</p>\n", $counter-1);
?>
</body>
</html>