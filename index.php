<?php
error_reporting(E_ALL); //debug

// Разрешение на загрузку страниц только из index
define("LAND_PAGE", TRUE);

// Получаем действие do из URL
$do = $_GET['do'] ?? 'none';

// debug:
/* echo "<div style=\"font-size: 0.8em;color: #550000;background-color: #ffdddd;\">Index land debug<br>";
echo $do;
echo "<br>LAND_PAGE: ";
echo (LAND_PAGE);
echo "</div>";
 */

// Получаем параметр do из URL
$do = $_GET['do'] ?? 'start';

// Включаем модуль/page, определённый нам параметром do 
switch ($do)
{
        // case 'start' : include "main.php"; break;
		case 'about' : include "about.php"; break;
        case 'links' : include "linx.php"; break;
        case 'news' : include "news.php"; break;
		case 'pan' : include "pan.php"; break;
		case 'pic' : include "pic.php"; break;
		case 'texts' : include "texts.php"; break;
        case 'thanks' : include "thanks.php"; break;
        case 'thumb' : include "thumb.php"; break;
        case 'trips' : include "trips.php"; break;
		case 'testincl' : include "test_menu_incl.php"; break; // test
        default : include "main.php";
}
?>