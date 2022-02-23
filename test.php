<?php
// if (!defined("LAND_PAGE")) { // check call from index, not self
// 	header('Location: ./index.php'); 
// 	exit; 
// }
error_reporting(E_ALL); //debug
// error_reporting(0);

if (!filter_input(INPUT_GET, "dir", FILTER_VALIDATE_INT)) {
    $dir=1;
} else {
    $dir=$_GET["dir"];
}

echo $dir; // debug
echo "<br>";
echo "<br>";
echo "<br>";

include 'db_ini.php';


$query="SELECT * FROM glrs WHERE dir=$dir";
$result=mysqli_query($mysqli, $query) or die ("
<font color=#bb0000><b>Can not select from database, wrong parameter used</b><//// font>");
$dir_data=mysqli_fetch_array($result);
print_r ($dir_data);
echo '<br>';




$dir_counter=0;
$trip_counter=0;
$counter=0;
$query="SELECT * FROM glrs ORDER BY dir";
$result = mysqli_query($mysqli, $query);

mysqli_close($mysqli);

foreach ($result as $row) {
	print_r ($row);
	echo "<br>";
	$counter++;
	echo "<br>CCC";
	echo $counter;
	if ($row['trip'] == 0) {
		$directories[$dir_counter]=$row;
		$dir_counter++;
		echo "<br>DDD";
		echo $dir_counter;
		echo "<br>";
		}
	if ($row['trip'] == 1) {
		$directory_trip[$trip_counter]=$row;
		$trip_counter++;
		echo "<br>TTT";
		echo $trip_counter;
		echo "<br>";		
		}
	}
echo "<br> directories - <br>";
print_r ($directories[18]['descr']);
echo "<br>";
print_r ($directories[18]['dat']);
echo "<br> directory_trip <br>";
print_r ($directory_trip[5]); 





/* $gal_counter=36;
$gal_counter++;
 */

$rows=ceil(($gal_counter-1)/4); //определяем количество строк в таблице обычных галерей

echo 'gals '.($gal_counter-1).'<br>';
echo 'rows '.$rows.'<br>';
for ($r=0; $r<$rows; $r++){ //цикл для строк таблицы галерей
	echo '<br>Row&nbsp;'.($r+1).'&nbsp;<br>';
	if ($r!=0) {
      // echo $r.'\n';
      }

	for ($c=0; $c<=3; $c++){ //цикл для столбцов таблицы
		$x=$r*4+$c; //определяем порядковый номер ячейки
		if ($x<($gal_counter-1)) {
			echo 'Ceil&nbsp;'.($x+1).'&nbsp;';
			echo 'Column&nbsp;'.($c+1).'&nbsp;|';
		} else {
			echo '|Ceil E&nbsp;'.($x+1).'&nbsp;';
		}
	}
}


?>