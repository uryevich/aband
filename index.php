<?php
error_reporting(E_ALL); //debug

// load pages only from index 
define("LAND_PAGE", TRUE);

// get 'do' from URL
$do = $_GET['do'] ?? 'none';

// include module/page, schosen by 'do' 
switch ($do)
{
        // case 'start' : include "main.php"; break;
		case 'about' : include "about.php"; break;
        case 'links' : include "linx.php"; break;
        case 'news' : include "news.php"; break;
		case 'pan' : include "pan.php"; break;
		case 'pic' : include "pic.php"; break;
		case 'texts' : include "texts.php"; break;
        case 'thanks' : include "thanx.php"; break;
        case 'thumb' : include "thumb.php"; break;
        case 'trips' : include "trips.php"; break;
        default : include "main.php";
}
?>