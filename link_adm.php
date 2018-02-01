<?php
//  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }
?>
<html>
<head>
<title>Admin links</title>
<meta name=content charset=1251>
<style type="text/css">
<!--
body { font-family: Verdana, Arial; font-size : 12px; background-color : #eeeeee; }
td { font-family: Verdana, Arial; font-size : 12px; }
a:hover { color : #ff3300; }
-->
</style>
</head>
<body bgcolor="#eeeeee">
<p>This:
<a href="link_adm.php">Reload</a> |
<a href="linx.php" target="_new">Links page</a><br>
Menu:
<a href="galadm.php">Gallery admin</a> |
<a href="fileadm.php">File admin</a> |
<a href="news_adm.php">News admin</a> |
<a href="baseadm.php">DB Admin</a> |
<a href="redirect.php?link=\"htp://abandoned.ru\"">Logout</a>
</p>
<?php
require 'db_ini.php';

// echo "<br> -<br>";
// print_r ($_GET);
// echo "<br> -<br>";

// echo "<br> -<br>";
// print_r ($_POST);
// echo "<br> -<br>";

// 5 cases: 
// 1. edit
// 2. activate status
// 3. delete
// first load
// add

// edit section
if (isset($_POST["edit"])) {

   $id=$_POST["id"];
   $link=$_POST["link"];
   $name=$_POST["name"];
   $descr=$_POST["descr"];
   $img=$_POST["img"];
   $cat1=$_POST["cat1"];
   $cat2=$_POST["cat2"];
   $cat3=$_POST["cat3"];
   $cat4=$_POST["cat4"];
   if ((isset($_POST["active"])) && ($_POST["active"]=="on")) { $active=1; } else { $active=0; }
		
        $query = "UPDATE ab_links SET site_link='".addslashes($link)."', link_name='".addslashes($name)."', link_descr='".addslashes($descr)."', site_img='".addslashes($img)."', cat1='".$cat1."', cat2='".$cat2."', cat3='".$cat3."', cat4='".$cat4."', active='".$active."' WHERE id=".$id;
		
//echo "<br><pre>".$query."</pre><br>";

        $result = mysql_query($query, $dbid) or die ("<font color=#bb0000><b>Can't update!</b></font>");
echo "<b><font size=\"-2\" color=#005500>Changes has been saved.</font></b><br>";
        }
// activate section
if (isset($_GET["activate"])) {
	$activate_id=$_GET["activate"];
        $query="UPDATE ab_links SET active=1 WHERE id='$activate_id'";
	$result=mysql_query($query, $dbid); // or die("<font color=#bb0000><b>Can't delete row!</b></font>");
        echo "<b><font size=\"-2\" color=#005500>Link ".$activate_id." has been activated&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
	}

// deactivate section
if (isset($_GET["deactivate"])) {
	$deactivate_id=$_GET["deactivate"];
        $query="UPDATE ab_links SET active=0 WHERE id='$deactivate_id'";
	$result=mysql_query($query, $dbid); // or die("<font color=#bb0000><b>Can't delete row!</b></font>");
        echo "<b><font size=\"-2\" color=#005500>Link ".$deactivate_id." has been deactivated&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
	}

// delete section
if (isset($_GET["delete"])) {

	$delete_id=$_GET["delete"];
        $query="DELETE FROM ab_links WHERE id='$delete_id'";
	$result=mysql_query($query, $dbid); // or die("<font color=#bb0000><b>Can't delete row!</b></font>");
        echo "<b><font size=\"-2\" color=#005500>Link ".$delete_id." has been deleted&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font></b><br>\n";
	}

// add section
// if "add" button pressed
if (isset ($_POST["add"])) {
   if (!empty ($_POST["link"])) { $link=$_POST["link"]; } else { $link=0; };
   if (!empty ($_POST["name"])) { $name=$_POST["name"]; } else { $name=0; };
   if (!empty ($_POST["descr"])) { $descr=$_POST["descr"]; } else { $descr=0; };
   if (!empty ($_POST["img"])) { $img=$_POST["img"]; } else { $img=0; };
   if (!empty ($_POST["cat1"])) { $cat1=$_POST["cat1"]; } else { $cat1=0; };
   if (!empty ($_POST["cat2"])) { $cat2=$_POST["cat2"]; } else { $cat2=0; };
   if (!empty ($_POST["cat3"])) { $cat3=$_POST["cat3"]; } else { $cat3=0; };
   if (!empty ($_POST["cat4"])) { $cat4=$_POST["cat4"]; } else { $cat4=0; };
   // $active=$_POST["active"];

    if (!empty ($link)) {
    $query="SELECT * FROM ab_links WHERE site_link='".addslashes($link)."'";
    $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>Can't read!</b></font>");
    $row=mysql_fetch_array($result);
    $link_a=$row["site_link"];
    $name_a=$row["link_name"];
        if ($link==$link_a) {
        echo "<font color=#bb0000> Link <b>".$link_a."</b> already exist with description <b>".$name_a."</b></font>";
        }
        else {
        $query="INSERT INTO ab_links (site_link, link_name, link_descr, site_img, cat1, cat2, cat3, cat4) VALUES (
		'".addslashes($link)."',
		'".addslashes($name)."',
		'".addslashes($descr)."',
		'".addslashes($img)."',
		'".$cat1."',
		'".$cat2."',
		'".$cat3."',
		'".$cat4."')";
//		echo "<br><pre>".$query."</pre><br>";
        $result=mysql_query($query, $dbid) or die ("<font color=#bb0000><b>can't insert new parameters</b></font>");

        echo "<b><font size=\"-2\" color=#005500>Link ".$link." (".$name.") has been added</font></b>
<br>";
        }
    } //end of check of empty 'link' param
}
// form:
?>
<!-- // form, "add" section -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
<table bgcolor="#888888" border="0" cellpadding="2"  cellspacing="1">
<tr bgcolor="#ffffdd">
	<td><b>&nbsp;Link</b></td>
	<td><b>&nbsp;Name</b></td>
	<td><b>&nbsp;Description</b></td>
	<td><b>&nbsp;Image</b></td>
	<td><b>&nbsp;Cat1</b></td>
	<td><b>&nbsp;Cat2</b></td>
	<td><b>&nbsp;Cat3</b></td>
	<td><b>&nbsp;Rating</b></td>
</tr>
<tr>
	<td align=\"center\"><input type="text" name="link" size="15"></td>
	<td align=\"center\"><input type="text" name="name" size="30"></td>
	<td align=\"center\"><textarea name="descr" cols="30" rows="3"></textarea></td>
	<td align=\"center\"><input type="text" name="img" size="8"></td>
	<td align=\"center\"><input type="text" name="cat1" size="1"></td>
	<td align=\"center\"><input type="text" name="cat2" size="1"></td>
	<td align=\"center\"><input type="text" name="cat3" size="1"></td>
	<td align=\"center\"><input type="text" name="cat4" size="1"></td>
</tr>
</table><br>
&nbsp;&nbsp;<input type="submit" name="add" value="-     Add     -">
</form>
<table bgcolor="#888888" border="0" cellpadding="2" cellspacing="1">
<tr bgcolor="#ffffdd">
<td><b>ID</b></td>
<td><b>Link</b></td>
<td><b>Name</b><br>(click to edit)</td>
<td><b>Description</b></td>
<td><b>Image</b></td>
<td><b>Cat 1</b></td>
<td><b>Cat 2</b></td>
<td><b>Cat 3</b></td>
<td><b>Rating</b></td>
<td><b>Active</b></td>
<td><b>Delete</b></td>
</tr>
<?php
// "edit" section
$query="SELECT * FROM ab_links ORDER BY id";
$result=mysql_query($query, $dbid);
$tbl_row=0;
$counter=1;
$row_color1=' bgcolor=#ffffff';
$row_color2=' bgcolor=#eeeeee';
$row_color_nonact=' bgcolor=#ffeeee';
while ($row = mysql_fetch_row($result))
        {
        $id_e=$row[0];
        $link_e=$row[1];
        $name_e=$row[2];
        $descr_e=$row[3];
        $img_e=$row[4];
		$cat1_e=$row[5];
		$cat2_e=$row[6];
		$cat3_e=$row[7];
		$cat4_e=$row[8];
		$active_e=$row[9];

// fill rows in different colours
$tbl_row++;

if ($active_e==1) {
	if (ceil($tbl_row/2)==($tbl_row/2)) { echo "<tr".$row_color1.">\n"; } else { echo "<tr".$row_color2.">\n";}
} else { echo "<tr".$row_color_nonact.">\n"; }

printf("<td align=\"right\"><sub>%s</sub> %s</td>", $counter,$id_e);
printf("<td align=\"left\"><a href=redirect.php?link=%s target=\"_new\">%s</a></td>\n", $link_e,$link_e);
printf("<td align=\"left\"><a href=\"link_edit.php?id=%s\">%s</a></td>\n", $id_e,$name_e);
printf("<td align=\"left\">%s</td>\n", $descr_e);
printf("<td align=\"left\">%s</td>\n", $img_e);
printf("<td align=\"center\">%s</td>\n", $cat1_e);
printf("<td align=\"center\">%s</td>\n", $cat2_e);
printf("<td align=\"center\">%s</td>\n", $cat3_e);
printf("<td align=\"center\">%s</td>\n", $cat4_e);
	if ($active_e==1)
		// active 
		{
		printf("<td align=\"center\" bgcolor=\"#86F086\"><a href=\"link_adm.php?deactivate=%s\" alt=\"Deactivate\">yes</a></td>\n", $id_e); 
		}
	else
		// not active
		{
		printf("<td align=\"center\" bgcolor=\"#F08686\"><a href=\"link_adm.php?activate=%s\" alt=\"Activate\">NO</a></td>\n", $id_e); 
		}
printf("<td align=\"center\"><a href=\"link_adm.php?delete=%s\" alt=\"Delete\">X</a></td>\n", $id_e);
printf("</tr>");
        $counter++;
        }
?>
</table>

</body>
</html>