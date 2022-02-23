<?php
error_reporting(E_ALL); //debug
if(!defined("IS_ADMIN")) die;

// counter for add string
$add_strings=1; 
  
?>
<html>
<head>
<title>Admin files, gallery <?php echo $glob_dir; ?></title>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="./admin.css" type="text/css"/>
</head>
<body>

<?php include "menu.php";
require "../db_ini_.php"; // debug db file
 ?>
 
<!-- form: select directory -->
<form method="post" action="./index.php?do=file">Select directory:
<select name="dir_id" class="inputbox">
<?php

// read galleries list and put in form dropdown selector
try {
    $dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT dir, descr FROM glrs ORDER BY dir";
    $galleries = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
    }

if (empty($_POST['dir_id'])) {
    if (empty($_GET['dir_id'])) {
        $dir_id = ($galleries [0]['dir']);
        }
    }

// list from glrs dir_id and names for dir selector
foreach ($galleries as $row_counter => $row_data) {
    if ($row_data['dir'] = $dir_id) {
        $selected_item = ' selected';
        }
        else { 
        $selected_item = '';            
	    }
    echo "<option value=\"".$row_data['dir']."\"".$selected_item.">".$row_data['dir']." - ".$row_data['descr']."</option>\n";
    }
?>
</select>
   <input type="submit" value="Select">
   </form>
<?php

// 5 cases: 
// 0.1 initial load
// 1. edit
// 2. delete
// 3. add

// initial load


// Edit section
if (isset($_POST['edit'])) {
    $id=$_POST['id'];
    $dir=$_POST['dir'];
    $file=$_POST['file'];
    $descr=$_POST['descr'];
    $descrm=$_POST['descrm'];
    $pan=$_POST['pan'];
   
    try {
        $dbh = new PDO('mysql:host='.$mysql_h.'; dbname='.$mysql_db, $mysql_u, $mysql_p);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE files SET fil = :file , descr = :descr , descrm = :descrm , pan = :pan WHERE id = :id";
        $params = [':id' => $id, ':file' => $file, ':descr' => $descr, ':descrm' => $descrm, ':pan' => $pan];
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);
        $stmt = null;
        $dbh = null;
        echo "<div class=\"notice\">Update successful</div><br/>\n"; // notice
        } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
		}

    echo "<b><font size=\"-1\" color=#558800>Changes has been saved</font></b>";
    }
    
// Delete section
if (isset($_GET["delete"])) {
    $delete_id=$_GET["delete"];
	
	try {
        $dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
// show what will be deleted
        $query = "SELECT * FROM files WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute([$delete_id]);
        $row = $stmt->fetch(PDO::FETCH_LAZY);
		
        echo '<div class="warning">Deleted!
        <table>
        <tr>
        <td>id:</td>
        <td>'.$row[0].'</td>
        </tr>
        <tr>
        <td>Dir:</td>
        <td>'.$row[1].'</td>
        </tr>
        <tr>
        <td>File:</td>
        <td>'.$row[2].'</td>
        </tr>
        <tr>
        <td>Description:</td>
        <td>'.$row[3].'</td>
        </tr>
		<tr>
        <td>Description more:</td>
        <td>'.$row[4].'</td>
        </tr>
        <tr>
        <td>Pan:</td>
        <td>'.$row[5].'</td>
        </tr>
        </table>
        </div>
        ';
		
// delete
        $query = "DELETE FROM files WHERE id = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute([$delete_id]);
        $stmt = null;
        $dbh = null;
        echo "<div class=\"notice\">Gallery ".$delete_id." has been deleted</div><br/>\n"; // notice
        } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
        }
    }


?>

<?php // new add section

// count rows in dir
try {
    $dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $files_in_db_count = $dbh->query('SELECT COUNT(*) FROM files WHERE dir = '.$dir_id)->fetchColumn(); 
	$dbh = null;
	} catch (PDOException $e) {
	print "Error!: " . $e->getMessage() . "<br/>";
	die();
	}

$add_files = $max_files - $files_in_db_count;

// if there space for new files show add files section
if ($add_files > 0) {
	
	echo "<form method=\"post\" action=\"./index.php?do=file\">";
	echo "<input type=\"hidden\" name=\"dir\" value=\"$dir_id\" size=\"5\">";
	echo "Add rows for files ($add_files):";
	echo "<input type=\"text\" name=\"new_slots\" size=\"2\">";
	echo "<input type=\"submit\" name=\"add\" value=\"-   Add   -\">";
    }


?>


<?php


// Add files in DB section
// If received 'add' flag prepare and insert in DB 
if (isset($_POST['add'])) {
    $dir=$_POST['dir']; // deprecated var
	$id=$_POST['id'];
    $file=$_POST['file'];
    $descr=$_POST['descr'];
    $descrm=$_POST['descrm'];
    $pan=$_POST['pan'];

// read 'files' db, get 'id' by 'dir' to db arr
    try {
		$dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$query = "SELECT id, fil FROM files WHERE dir = ?";
		$stmt = $dbh->prepare($query);
		$stmt->execute([$dir]);
		$files_in_db = $stmt->fetch(PDO::FETCH_LAZY);
		$dbh = null;
		} catch (PDOException $e) {
		print "Error!: " . $e->getMessage() . "<br/>";
		die();
		}

// add cycle start, read post arr
    for ($arr_counter=0; $arr_counter<$add_strings; $arr_counter++) {
        
		// check is 'file' not empty
        if ($file[$arr_counter] == true) {
			// search for same 'file' in DB
			$overlap_key = array_search($file [$arr_counter], array_column($files_in_db, 'fil')); 

			// compare given id to existing id in db (if equal then notice and go next arr item)
			if ($overlap_key == true) {				
				echo "<div class=\"warning\">File ".$file [$arr_counter]." (id ".$files_in_db [$overlap_key], ['id']." already exist in db $dir.</div>";
				} else {

				// INSERT items from post arr
				try {
                    $dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
                    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
					
					$query = "INSERT INTO files (id, dir, fil, descr, descrm, pan) VALUES (:id, :dir, :fil, :descr, :descrm, :pan)";
                    $params = [':id' => $id[$arr_counter],':dir' => $dir[$arr_counter],':fil' => $file[$arr_counter],':descr' => $descr[$arr_counter],':descrm' => htmlentities($descrm[$arr_counter]),':pan' => $pan[$arr_counter]];
                    $stmt = $dbh->prepare($query);
                    $stmt->execute($params);
					$stmt = null;
					$dbh = null;
					} catch (PDOException $e) {
					print "Error!: " . $e->getMessage() . "<br/>";
					die();
					}
				echo '<div class="notice">File '.$file[$arr_counter].'.jpg "'.$descr[$z].'" has been added in directory '.$dir[$z].'</font></b><br>';
				}
            }
        }
    }

// add form start
?>
<table>
<tr>
<td>
<table><tr><td>
<form method="post" action="./index.php?do=file">
<table>
<tr>
    <td>File</td>
    <td>ext</td>
    <td>Description</td>
    <td>Ext. description</td>
    <td>Pan-flag</td>
</tr>
<?php

// deprecated section: search for free id
// count id
$query="SELECT COUNT (*) FROM files";
$result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>Can't count rows!</b></font>" . mysql_error() . "<br />");
$arr=mysql_fetch_array($result);
$max_id=$arr[0];
// check for free id in files table
$not_match=0;
for ($i=0; $i<=($add_strings+$max_id-1); $i++) {
   $query="SELECT id FROM files WHERE id='$i'";
   if ($result=mysql_query($query)) {
      $row=mysql_fetch_array($result);
      $id_string=$row["id"];
      if ($id_string!=$i) {
         $new_id[$not_match]=$i;
         $not_match++;
        }
    }
}
   if ($glob_dir!=0) { // need put dir_id (glob_dir) outside of array
   // dir_id (glob_dir) should be defined at begining of this file
   
   for ($z=0; $z<=($add_strings-1); $z++)
         {
   printf("<tr>\n");
   printf("    <td><input type=\"hidden\" name=\"id[%s]\" value=\"%s\">\n", $z,$new_id[$z]);
   printf("<input type=\"hidden\" name=\"dir[%s]\" value=\"%s\" size=\"5\">\n", $z,$glob_dir); // put dir_id (glob_dir) outside of array 
   printf("<input type=\"text\" name=\"file[%s]\" size=\"5\"></td>\n", $z);
   printf("    <td>.jpg</td>");
   printf("    <td><input type=\"text\" name=\"descr[%s]\" size=\"20\"></td>\n", $z);
   printf("    <td><input type=\"text\" name=\"descrm[%s]\" size=\"40\"></td>\n", $z);
   printf("    <td><input type=\"text\" name=\"pan[%s]\" size=\"1\"></td>\n", $z);
   printf("</tr>\n");
         }
printf("<input type=\"hidden\" name=\"glob_dir\" value=\"%s\">\n", $glob_dir);
}
?>
</table>
<div align="right"><input type="submit" name="add" value="-   Add   -"></div>
</form>
</td></tr></table>
<!-- Form for adding end -->
<!-- Editing section start -->
<form method="post" action="fileadm.php">
<table bgcolor="#888888" border="0" cellpadding="2">
<tr bgcolor="#ffffdd">
<td align="right"><i>id</i>&nbsp;&nbsp;&nbsp;<b>File</b></td>
<td align="center"><b><font size="-2">ext</font></b></td>
<td align="center"><b>Description</b></td>
<td align="center"><b>Ext. description</b></td>
<td align="center"><b>Pan-flag</b><br />edit</td>
<td align="center"><b>Delete</b></td>
</tr>
<?php
$tbl_row=0; // fill rows in different colors
$counter=1;
$row_color1=' bgcolor=#ffffff';
$row_color2=' bgcolor=#eeeeee';

$query="SELECT * FROM files WHERE dir='$glob_dir' ORDER BY fil";
$result=mysql_query($query, $dbid);
$sql_empty_check=mysql_num_rows($result);
if ($sql_empty_check>0) {
    while ($row = mysql_fetch_row($result)) {
        $ide=$row[0];
        $filee=$row[2];
        $descre=$row[3];
        $descrme=$row[4];
        $pane=$row[5];
        // fill rows in different colours
        $tbl_row++;
        if (ceil($tbl_row/2)==($tbl_row/2)) { echo "<tr".$row_color1.">\n"; } else { echo "<tr".$row_color2.">\n"; }
        printf("<td align=\"right\"><a href=\"pic.php?id=%s\" target=\"_blank\"><i> %s</i></a>\n", $ide,$ide);
        printf(" %s</td>\n", $filee);
        printf("<td>.jpg</td>\n");
        printf("<td><i>%s</td>\n", $descre);
        printf("<td>%s</td>\n", htmlspecialchars($descrme));
        printf("<td align=\"center\"><a href=\"file_edit.php?id=%s\">%s</a></td>\n", $ide,$pane);
        printf("<td align=\"center\"><a href=\"fileadm.php?delete=%s&glob_dir=%s\">X</a></td>\n", $ide,$glob_dir);
        printf("</tr>\n");
        }
    }
?>
</table>
</form>
<!-- Form for editing end -->
</td>
<td>

<table border="0" cellpadding="2" cellspasing="1" bgcolor="#ffffdd">
<tr valign="top">
<td align="right">
<?php
// check files section -> compare directory content and records in DB
// read DIR then DB
if (isset ($glob_dir) and ($glob_dir!=0))
   {
   $abase=0;
   $base=0;
   echo '<b>In Database:</b>
   <p align="left">
   Not exist:</p>
<font size="-1" color="#bb0000">';
   $handle = opendir($glob_dir);
    while (false !== ($dir_file = readdir($handle))) {
      if (($dir_file!=".") or ($dir_file!="s") or ($dir_file!="..")) {
    $dirfile_temp_arr=explode ('.', $dir_file);
    }
    else { $dirfile_temp_arr = array(0 => 0, 1 => 0); }
    $dirfile=$dirfile_temp_arr[0];
    $dirfile_ext=$dirfile_temp_arr[1];
    // echo '$dirfile_ext'.$dirfile_ext.'<br>';
        if ($dirfile_ext=="jpg")
        {
        $abase++;
        $query="SELECT * FROM files WHERE dir='$glob_dir' AND fil='$dirfile'";
        $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not read when search for file '$dirfile'</b></font>");
        $filerecord = mysql_fetch_row($result);
         if ($dirfile!=$filerecord[2])
         {
         $base++;
         echo 'File '.$dirfile.'.jpg<br>
         ';
         }
      if ($dirfile_ext !== "jpg" &&$dirfile_ext !== 0) { echo 'File '.$dirfile+$dirfile_ext.' not jpg!!'; }
        if (!file_exists($glob_dir.'/s/'.$dirfile.'.jpg') && $dirfile_ext=0) {
            echo 'Thumb of '.$dirfile.'.jpg not exist<br>
            ';
            }
        }
      }
   echo '</font><hr width="70%">'
   .$abase.' file(s) total in Dir,<br>'
   .$base.' file(s) absent.<br>';

// section 2
// read DB then DIR
   $adircont=0;
   $dircont=0;
   echo '</td>
   <td>&nbsp;&nbsp;</td><td align="right">
   <b>In Directory:</b>
   <p align="left">Not exist:</p>
<font size="-1" color="#bb0000">';
   $query="SELECT fil FROM files WHERE dir='$glob_dir' ORDER BY fil";
   $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not select 'file' from database</b></font>");
      while ($dbfile=mysql_fetch_array($result))
      {
      $adircont++;
         if (!file_exists ($glob_dir.'/'.$dbfile[0].'.jpg'))
         {
         $dircont++;
         echo 'File '.$dbfile[0].'.jpg<br>
         ';
         }
      }
   echo '</font><hr width="70%">'
   .$adircont.' file(s) total in DB,<br>'
   .$dircont.' file(s) absent.<br>';
   }
echo '</td>
</tr>
<tr>
<td colspan=3><hr>
';
// count files in directories
// $query="SELECT dir, COUNT(fil) FROM files GROUP BY dir ORDER BY dir";
// $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not count rows</b></font>");
// $mdir_tot=0;
// $mfile_tot=0;
// while ($arr=mysql_fetch_array($result)) {
//   $mdir=$arr[0];
//   $mfile=$arr[1];
//   echo '<font size="-1">directory '.$mdir.' content '.$mfile.' files.</font><br>
//   ';
//   $mdir_tot++;
//   $mfile_tot=$mfile_tot+$mfile;
//   }
// echo '<hr width="70%">'.$mdir_tot.' directories content '.$mfile_tot.' files total.';
?>
</td>
</tr>
</table>
</td>
</tr>
</table>
</body>
</html>