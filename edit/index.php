<?php
// Allow execute files only from index page
define("IS_ADMIN", TRUE);

error_reporting(E_ALL); //debug


// check access
session_start();
	
// not authorised
if ($_SESSION ['user_auth'] != TRUE ) { 
	header('Location: log.php');
	exit; 
}
	
// session expire
$time_now = time();
$time_exp = (60*60); // in seconds (ie 60sec * 60min)

	// debug session expire
	echo '<div style="
	font-size: 0.7em;
	color: #005500;
	background-color: #dddddd;"'; 
/* 	echo 'Session '; 
	print_r ($_SESSION ['user_auth'] );
	echo '<br/>';
	echo 'Time now: ';
	echo $time_now;
	echo '<br/>';
	echo 'Sessinon duration set (sec): '; 
	echo $time_exp;
	echo '<br/>';
	echo 'Current count: ';
	echo ($time_now - $_SESSION['user_auth']['reg_time']);
	echo '<br/>'; */
	echo 'Session expire in: ';
	echo ($time_exp - ($time_now - $_SESSION['user_auth']['reg_time']));
	echo '</div>';

if (( $time_now - $_SESSION['user_auth']['reg_time'] ) > $time_exp) { 
    unset($_SESSION['user_auth']);
	header('Location: log.php');
	exit; 
}

// logout
if ( isset($_GET ['do']) && $_GET ['do'] == 'logout' ){
	$_SESSION ['user_auth'] = FALSE;
	session_destroy();
	header('Location: log.php');
	exit; 
} 

// Get 'do' from URL
$do = $_GET['do'] ?? 'start';

// Include module by 'do'
switch ($do)
{
        case 'start' : include "start.php"; break;
        case 'gal' : include "galadm.php"; break;
		case 'galedit' : include "gal_edit.php"; break;
        case 'file' : include "fileadm.php"; break;
		case 'fileedit' : include "file_edit.php"; break;
        case 'link' : include "link_adm.php"; break;
        case 'news' : include "news_adm.php"; break;
        case 'newsedit' : include "news_edit.php"; break;
//        case 'base' : include "baseadm.php"; break;
//		case 'login' : include "log.php"; break;
//		case 'testincl' : include "test_menu_incl.php"; break; // test
        default : include "start.php";
}
?>
