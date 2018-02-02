<?php
  error_reporting(0);
  session_start();
  if ($_SESSION["user_auth"] != true) { die ('<div align="center">access denied<br><a href="/">Log in</a></div>'); }
?>
<html>
<head>
  <title>::: New Table :::</title>
</head>
<body bgcolor="#eeeeee">
<br>
<?php

require 'db_ini.php';

$query="CREATE TABLE ab_links2 
(
id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
site_link VARCHAR (255),
link_name VARCHAR (255),
link_descr VARCHAR (255),
site_img VARCHAR (10),
cat1 SMALLINT,
cat2 SMALLINT,
cat3 SMALLINT,
cat4 SMALLINT,
active SMALLINT
)";

$result=mysql_query($query, $dbid); // or die ("Smth. wrong");
if($result == false)
{
   user_error("Query failed: " . mysql_error() . "<br />\n$query");
}
elseif(mysql_num_rows($result) == 0)
{
   echo "<p>Sorry, no rows were returned by your query.</p>\n";
}
else
{
   while($query_row = mysql_fetch_assoc($result))
   {
      foreach($query_row as $key => $value)
      {
         echo "$key: $value<br />\n";
      }
      echo "<br />\n";
   }
} 

print_r ($result);

print_r ($result);

echo "Table created";
mysql_close ($dbid);
?>
</body>