<?php
error_reporting(E_ALL); //debug
if(!defined("IS_ADMIN")) die; // check call from index, not self
?>
<html>
<head>
<title>Admin galleryes</title>
<meta charset="UTF-8"/>
<link rel="stylesheet" href="./admin.css" type="text/css"/>
</head>
<body>
<?php
include "menu.php";
require "../db_ini_.php"; // debug db file

// 4 cases: 
// 1. edit
// 2. delete
// 3. first load
// 4. add

// Edit section
// If received 'edit' flag prepare and update DB
if (isset ($_POST['edit'])) {
    $dir_id=$_POST['dir_id'];
    $galname=$_POST['galname'];
    $locat=$_POST['locat'];
    $date=$_POST['date'];
    $trip=$_POST['trip'];
    
    try {
        $dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "UPDATE glrs SET descr = :galname , locat = :locat , dat = :date , trip = :trip WHERE dir = :dir_id";
        $params = [':galname' => $galname,':locat' => $locat,':date' => $date,':trip' => $trip,':dir_id' => $dir_id];
        $stmt = $dbh->prepare($query);
        $stmt->execute($params);
        $stmt = null;
        $dbh = null;
        echo "<div class=\"notice\">Update successful</div><br/>\n"; // notice
        } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
    }      
    echo "<div class=\"notice\">Changes has been saved</div><br>\n"; // notice
}
   
   
// delete section
// If received 'delete' flag prepare and delete in DB
if (isset($_GET["delete"])) {
    $delete_id=$_GET["delete"];
    
    try {
        $dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
// show what will be deleted
        $query = "SELECT * FROM glrs WHERE dir = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute([$delete_id]);
        $row = $stmt->fetch(PDO::FETCH_LAZY);
        echo '<div class="warning">Deleted!
        <table>
        <tr>
        <td>Dir:</td>
        <td>'.$row[0].'</td>
        </tr>
        <tr>
        <td>Description:</td>
        <td>'.$row[1].'</td>
        </tr>
        <tr>
        <td>Location:</td>
        <td>'.$row[2].'</td>
        </tr>
        <tr>
        <td>Date:</td>
        <td>'.$row[3].'</td>
        </tr>
        <tr>
        <td>Trip flag:</td>
        <td>'.$row[4].'</td>
        </tr>
        </table>
        </div>
        ';
// delete
        $query = "DELETE FROM glrs WHERE dir = ?";
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

// Add section
// If received 'add' flag prepare and insert in DB
if (isset ($_POST['add']) && !empty ($_POST['dir_id'])) {
   $dir_id=$_POST['dir_id'];
   $galname=$_POST['galname'];
   $locat=$_POST['locat'];
   $date=$_POST['date'];
   $trip=$_POST['trip'];
   
       try {
        $dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query = "SELECT * FROM glrs WHERE dir = ?";
        $stmt = $dbh->prepare($query);
        $stmt->execute([$dir_id]);
        $row = $stmt->fetch(PDO::FETCH_LAZY);
        
        $dir_in_db = $row['dir'];
        $descr_in_db = $row['descr'];
        echo "<br/>In db:$dir_in_db, $descr_in_db<br/>";
		
		// check if given dir_id already in DB
        if ($dir_id == $dir_in_db) { 
            echo "<div class=\"warning\">Directory coinsidence at row".$dir_in_db." with description ".$descr_in_db."</div><br />\n";
            }
            else {
            $query = "INSERT INTO glrs (dir, descr, locat, dat, trip) VALUES (:dir,:descr,:locat,:date,:trip)";
            $params = [':dir' => $dir_id,':descr' => $galname,':locat' => $locat, ':date' => $date, ':trip' => $trip];
            $stmt = $dbh->prepare($query);
            $stmt->execute($params);
            echo "<div class=\"notice\">Directory ".$dir." (".$descr.") has been added</div>"; // notice
            }
            
        $stmt = null;
        $dbh = null;
        } catch (PDOException $e) {
        print "Error!: " . $e->getMessage() . "<br/>";
        die();
        }
} // end of "add" condition

// form:
?>

<!-- 'add' form section -->
<form method="post" action="./index.php?do=gal">
<table>
<tr class="tb_header">
<td>Directory</td>
<td>Description</td>
<td>Location</td>
<td>Date (YYYY-MM-DD)</td>
<td>Trip flag</td>
</tr>
<tr>
<td><input type="text" name="dir_id" size="10"></td>
<td><input type="text" name="galname" size="30"></td>
<td><input type="text" name="locat" size="20"></td>
<td><input type="text" name="date" size="10"></td>
<td><select id="dropdown" name="trip">
	<option value="0">0</option>
	<option value="1">1</option>
	<option value="2" selected>2</option>
</select></td>
</tr>
</table>
<div><input type="submit" name="add" value="-     Add     -"></div>
</form>

<!-- 'edit' form section -->
<table>
<tr class="tb_header">
<td>Directory</td>
<td>Description</td>
<td>Location</td>
<td>Date</td>
<td>Trip flag</td>
<td>Edit</td>
<td>Delete</td>
</tr>

<?php
// edit section, table building
// fill galeries table
try {
    $dbh = new PDO('mysql:host='.$mysql_h.';dbname='.$mysql_db, $mysql_u, $mysql_p);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = "SELECT * FROM glrs ORDER BY dir";
    $galleries = $dbh->query($query)->fetchAll(PDO::FETCH_ASSOC);
    $dbh = null;
    } catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
    }
foreach ($galleries as $row_counter => $v){
    echo "<tr>\n";
    echo "<td class=\"normal\">".($row_counter+1)." / ".$v['dir']."</td>\n";
    echo "<td class=\"normal\"> ".$v['descr']."</td>\n";
    echo "<td class=\"normal\">".$v['locat']."</td>\n";
    echo "<td class=\"normal\">".$v['dat']."</td>\n";
    echo "<td class=\"normal\">".$v['trip']."</td>\n";
    echo "<td class=\"normal\"><span class=\"warning\"><a href=\"./index.php?do=galedit&dir_id=".$v['dir']."\">Edit</a></span> <span class=\"notice\"><a href=\"../index.php?do=thumb&dir=".$v['dir']." \" target=\"_new\">View</a></span></td>\n";
    echo "<td><a class=\"normal\" href=\"./index.php?do=gal&delete=".$v['dir']."\" alt=\"Delete\">x</a></td>\n</tr>\n";
}

?>
</table><p><?php echo $row_counter+1; ?> galleries.</p>
</body>
</html>