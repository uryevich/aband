<?php
/////////////////////////////////////////////////////////////////
// Database admin tool.                                        //
// Makes SELECT, DELETE, INSERT, UPDATE queries to any tables. //
/////////////////////////////////////////////////////////////////
  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('access denied <br> <a href="/">Log in</a>'); }
?>
<html>
<head>
<title>Admin base</title>
<meta name=content"text/html; charset=1251">
<style type="text/css">
<!--
body,td { font-family: Verdana, Arial; font-size : 12px;}
a:hover { color: #ff3300; }
-->
</style>
</head>
<body bgcolor="#eeeeee">
<!-- Menu -->
<p>This:
<a href="baseadm.php">Clear/Reload</a><br>
Menu:
 <a href="galadm.php">Galleryes admin</a> |
 <a href="fileadm.php">Files admin</a> |
 <a href="link_adm.php">Links admin</a> |
 <a href="news_adm.php">News admin</a> |
 <a href="baseadm.php">DB Admin</a> |
 <a href="log.php?logout=1">Logout</a></p>
<?php
require 'db_ini.php';

// $_POST variables:
$slc=$_POST[slc]; // what to select [select form]
$tbl=$_POST[tbl]; // table name [all forms]
$whr=$_POST[whr]; // 'where xx=nn' string [select form]
$select=$_POST[select]; // select form submit
$whr_d=$_POST[whr_d]; // 'where' string from [delete form]
$delete=$_POST[delete]; //delete form submit
$f_names=$_POST[f_names]; // field names in [insert form]
$values=$_POST[values]; // values in [insert form]
$insert=$_POST[insert]; // insert form submit
$set_val=$_POST[set_val]; // set value in [update form]
$whr_u=$_POST[whr_u]; // 'where' string in [update form]
$update=$_POST[update]; // update form submit

// list db tables available
// $query="";

$tables = mysql_list_tables($mysql_db);
if (!$tables) {
   print "DB Error, could not list tables\n";
   print 'MySQL Error: ' . mysql_error();
   exit;
   }
while ($row = mysql_fetch_row($tables)) { $table_list[]=$row[0]; }
// print_r($table_list);


 // proceed select action
if (isset($select)) {
   if ((!$slc) or (!$tbl)) die ("SELECT or FROM parameter missing");
   if ($whr!="") $whr_q=" WHERE ".$whr;

   $query="SELECT ".$slc." FROM ".$tbl.stripslashes($whr_q);
   echo "<br>".$query."<br>";
   echo '<b><pre>'.$query.'</pre></b><br><br>';
   $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not proceed query</b></font>");
   $tbl_row=0;
   echo '
   <table border=1 bgcolor=#dddddd cellpadding=2 rules=all>';
   $row_color=' bgcolor=#ffffff';
   $field=mysql_num_fields ($result);
   echo "<tr>\n";
   for ($f=0; $f<$field; $f++) {
      echo ' <td bgcolor=#eeeeee>&nbsp;<b><i>'.mysql_field_name($result, $f).'</i></b></td>
';
      }
   echo '</tr>
';
   while ($row=mysql_fetch_row($result)) {
      $tbl_row++;
      if (ceil($tbl_row/2)==($tbl_row/2)) { echo "<tr>\n"; } else { echo "<tr".$row_color.">\n";}
//      echo '<tr>';
      for ($x=0; $x<$field; $x++) {
         echo "   <td>".htmlspecialchars($row[$x])."</td>\n";
         }
      echo '</tr>
';
      }
   echo '</table>';
   }

 // proceed delete acton
if (isset($delete)) {
   if (!$tbl) die ("FROM parameter missing");
   if ($whr_d!="") $whr_q=" WHERE ".$whr_d;
   $query="DELETE FROM ".$tbl.stripslashes($whr_q);
   echo "<br><b><pre>".$query."</pre></b><br>";
   if (mysql_query($query, $dbid)) { echo '<b>success!</b>'; } else { echo '<br>error!<br>'; echo mysql_errno() . ": " . mysql_error(). "\n<br>"; }
    /*
   $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not proceed query</b></font>");
   */
//   echo '<b>'.$dlt.'</b> from <b>'.$frm.'</b> deleted<br>'.$result;
   }

if (isset($insert)) {
   if (!$tbl) die ("FROM parameter missing");
   if (!$f_names) die ("Names for rows not given");
   if (!$values) die ("Values for inserting not given");
   $query="INSERT INTO ".$tbl." (".$f_names.") VALUES (".stripslashes($values).")";
   echo "<br><b><pre>".$query."</pre></b><br>";
   if (mysql_query($query, $dbid)) { echo '<b>success!</b>'; } else { echo '<br>error!<br>'; echo mysql_errno() . ": " . mysql_error(). "\n<br>"; }
    /*
   $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not proceed query</b></font>");
   */
//   echo '<b>'.$values.'</b> to <b>'.$into.'</b> inserted<br>'.$result;
   }

if (isset($update)) {
   if (!$tbl) die ("Table name not specified");
   if (!$set_val) die ("SET parameter missing");
   if ($whr_u!="") $whr_q=" WHERE ".$whr_u;
   $query="UPDATE ".$tbl." SET ".stripslashes($set_val)." ".stripslashes($whr_q);
   echo "<br><b><pre>".$query."</pre></b><br>";
   if (mysql_query($query, $dbid)) { echo '<b>success!</b>'; } else { echo '<br>error!<br>'; echo mysql_errno() . ": " . mysql_error(). "\n<br>"; }
    /*
   $result=mysql_query($query, $dbid) or die("<font color=#bb0000><b>can not proceed query</b></font>");
   */
//   echo '<br><b>'.$set_val.'</b> to <b>'.$tabl.'</b> updated<br>'.$result;
   }
?>
<p>
<a href="log.php?logout=1">Logout</a> | <a href="baseadm.php">Clear</a>
|
Admin <a href="fileadm.php">files</a> or <a href="galadm.php">galleryes</a></p>
<!-- SELECT FROM TABLE form -->
<form method="post" action="baseadm.php">
 SELECT <input type="text" name="slc" size="10" value="<?php echo $slc;?>">
 FROM
<select name="tbl" class=inputbox>
<?php
reset($table_list);
while (list($key_arr,$table)=each($table_list)) {
   echo '<option value="'.$table.'"';
   if ($table==$tbl) echo ' selected';
   echo '>'.$table.'</option>
';
   $i++;
   }
?>
</select>
 WHERE <input type="text" name="whr" size="10" value="<?php echo stripslashes(htmlentities($whr))?>">
 <input type="submit" name="select" value="-  GO  -">
</form>

<!-- DELETE FROM Table form -->
<form method="post" action="baseadm.php">
 DELETE
 FROM
<select name="tbl" class=inputbox>
<?php
reset($table_list);
while (list($key_arr,$table)=each($table_list)) {
   echo '<option value="'.$table.'"';
   if ($table==$tbl) echo ' selected';
   echo '>'.$table.'</option>
';
   $i++;
   }
?>
</select>
 WHERE <input type="text" name="whr_d" size="10" value="<?php echo stripslashes(htmlentities($whr_d));?>">
 <input type="submit" name="delete" value="-  GO  -">
</form>

<!-- INSERT INTO Table form -->
<form method="post" action="baseadm.php">
 INSERT
 INTO
<select name="tbl" class=inputbox>
<?php
reset($table_list);
while (list($key_arr,$table)=each($table_list)) {
   echo '<option value="'.$table.'"';
   if ($table==$tbl) echo ' selected';
   echo '>'.$table.'</option>
';
   $i++;
   }
?>
</select>
 ( <input type="text" name="f_names" size="10" value="<?php echo $f_names;?>"> )
 VALUES ( <input type="text" name="values" size="10" value="<?php echo stripslashes($values);?>"> )
<input type="submit" name="insert" value="-  GO  -">
</form>

<!-- Update Table form -->
<form method="post" action="baseadm.php">
 UPDATE
<select name="tbl" class=inputbox>
<?php
reset($table_list);
while (list($key_arr,$table)=each($table_list)) {
   echo '<option value="'.$table.'"';
   if ($table==$tbl) echo ' selected';
   echo '>'.$table.'</option>
';
   $i++;
   }
?>
</select>
 SET <input type="text" name="set_val" size="10" value="<?php echo stripslashes($set_val);?>">
 WHERE <input type="text" name="whr_u" size="10" value="<?php echo stripslashes(htmlentities($whr_u));?>">
<input type="submit" name="update" value="-  GO  -">
</form>

</body>
</html>