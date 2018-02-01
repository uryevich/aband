<?php
  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }
?>
<html>
<head>
<title>Admin galleryes</title>
<meta name=content charset=1251>
<style type="text/css">
<!--
body,td { font-family: Verdana, Arial; font-size : 12px;}
a:hover { color : #ff3300; }
-->
</style>
</head>
<body bgcolor="#eeeeee">
<p>
<a href="galadm.php">Reload</a> |
<a href="index.php" target="_new">Index</a> |
<a href="link_adm.php">Links Admin</a> |
<a href="baseadm.php">DB Admin</a> |
<a href="log.php?logout=1">Logout</a>

<p>This:
<a href="galadm.php">Reload</a> |
<a href="index.php" target="_new">Index</a><br>
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

// 4 cases: 
// 1. edit
// 2. delete
// 3. first load
// 4. add

// $add_lines_counter=1;

// Edit section
if (isset ($_POST["edit"])) {

	$dire=$_POST["dire"];
	$dir=$_POST["dir"];
// $x=$_POST["x"];
	$descr=$_POST["descr"];
	$locat=$_POST["locat"];
	$date=$_POST["date"];
	$trip=$_POST["trip"];
//	$del=$_POST["del"];

	$query = "UPDATE glrs SET descr='".addslashes($descr)."', locat='".addslashes($locat)."', dat='$date', trip='$trip' WHERE dir='$dir'";
    $result = mysql_query($query, $dbid) or die ("<font color=#bb0000><b>Can't update!</b></font>");
      
    
echo "<b><font size=\"-2\" color=#005500>Changes has been saved</font></b><br>
<pre>".$query."</pre><br>";
	}
   
   
// delete section
if (isset($_GET["delete"])) {
	$delete_id=$_GET["delete"];
        $query="DELETE FROM glrs WHERE dir='$delete_id'";
	$result=mysql_query($query, $dbid); // or die("<font color=#bb0000><b>Can't delete row!</b></font>");
        echo "<b><font size=\"-2\" color=#555500>Gallery ".$delete_id." has been deleted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
	}


// Add section
if (isset ($_POST["add"])) {
   $dir=$_POST["dir"];
   $descr=$_POST["descr"];
   $locat=$_POST["locat"];
   $date=$_POST["date"];
   $trip=$_POST["trip"];
    if (isset ($dir)) {
    $query="SELECT * FROM glrs WHERE dir=$dir";
    $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>Can't read!</b></font>");
    $row=mysql_fetch_array($result);
    $dir_a=$row["dir"];
    // echo "dir_a".$dir_a;
    $descr_a=$row["descr"];
    // echo "descr_a".$descr_a;
        if ($dir==$dir_a) {
        echo "<font color=#bb0000> Directory coinsidence at row <b>".$dir_a."</b> with description <b>".$descr_a."</b></font><br />";
        }
        else {
        $query="INSERT INTO glrs (dir,descr,locat,dat,trip) VALUES ('$dir','".addslashes($descr)."','$locat','$date','$trip')";
        $result=mysql_query($query, $dbid) or die ("<font color=#bb0000><b>can't insert new parameters</b></font>");
        echo "<b><font size=\"-2\" color=#005500>Directory ".$dir." (".$descr.") has been added</font></b>
<br />
<pre>".$query."</pre><br />
";
        }
    } //end of check of empty 'dir' param
} // end of "add" cycle

// form:
?>
<!-- // "add" section -->
<table bgcolor="#eeeeee" border="0" cellpadding="0"  cellspacing="1">
<tr><td>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table bgcolor="#888888" border="0" cellpadding="2"  cellspacing="1">
<tr bgcolor="#ffffdd">
<td><b>Directory</b></td>
<td><b>Description</b></td>
<td><b>Location</b></td>
<td><b>Date</b></td>
<td><b>Trip-flag</b><td>
</tr>
<tr>
<td align="center"><input type="text" name="dir" value="" size="10"></td>
<td align="center"><input type="text" name="descr" value="" size="30"></td>
<td align="center"><input type="text" name="locat" value="" size="20"></td>
<td align="center"><input type="text" name="date" value="" size="10"></td>
<td align="center"><input type="text" name="trip" value="" size="1"></td>
</tr>
</table>
<div align="right"><input type="submit" name="add" value="-     Add     -"></div>
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
$tbl_row=0;
$counter=1;
$row_color1=' bgcolor=#ffffff';
$row_color2=' bgcolor=#eeeeee';
$query="SELECT * FROM glrs ORDER BY dir";
$result=mysql_query($query, $dbid);
while ($row = mysql_fetch_row($result))
        {
        $dire=$row[0];
        $descre=$row[1];
        $locate=$row[2];
        $datee=$row[3];
        $tripe=$row[4];

// fill rows in different colours
$tbl_row++;
if (ceil($tbl_row/2)==($tbl_row/2)) { echo "<tr".$row_color1.">\n"; } else { echo "<tr".$row_color2.">\n";}		

printf("<td align=\"right\"><a href=\"thumb.php?gal=%s\" target=\"_new\"> %s </a></td>\n", $dire,$dire);
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